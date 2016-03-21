<?php

defined('BASEPATH') OR exit('No direct script access allowed');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

/**
 * Description of Linkedin
 *
 * @author NUSTECH
 */
class Linkedin {

    protected $base_url = "http://api.linkedin.com";
    protected $secure_base_url = "https://api.linkedin.com";
    protected $oauth_callback;
    private $consumer_key;
    private $consumer_secret;
    protected $authorize_path;
    protected $access_token_path;
    protected $state;
    protected $scope;

    /**
     * @var string Prefix to use for session variables
     */
    private $sessionPrefix = 'LIRLH_';

    /**
     * @var boolean Toggle for PHP session status check
     */
    protected $checkForSessionStatus = true;
    protected $access_token;

    public function __construct()
    {
        // Load config
        $this->load->config('linkedin', TRUE);
        $this->consumer_key = $this->config->item('api_key', 'linkedin');
        $this->consumer_secret = $this->config->item('secret_key', 'linkedin');
        $this->oauth_callback = $this->config->item('callback_url', 'linkedin');
        $this->scope = $this->config->item('scope', 'linkedin');
        $this->authorize_path = "https://www.linkedin.com/uas/oauth2/authorization?";
        $this->access_token_path = "https://www.linkedin.com/uas/oauth2/accessToken";
    }

    public function login_url()
    {
        $this->state = $this->random(16);
        $this->storeState($this->state);
        $params = array(
            'response_type' => 'code',
            'client_id' => $this->consumer_key,
            'redirect_uri' => $this->oauth_callback,
            'state' => $this->state,
            'scope' => implode(' ', $this->scope)
        );

        return $this->authorize_path . http_build_query($params, null, '&');
    }

    public function getAccessToken()
    {
        if ($this->isValidRedirect()) {
            $params = array(
                'grant_type' => 'authorization_code',
                'client_id' => $this->consumer_key,
                'client_secret' => $this->consumer_secret,
                'code' => $this->getCode(),
                'redirect_uri' => $this->oauth_callback,
            );

            // Access Token request
            $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
            
            // Tell streams to make a POST request
            $context = stream_context_create(
                    array('http' =>
                        array('method' => 'POST',
                        )
                    )
            );

            // Retrieve access token information
            $response = file_get_contents($url, false, $context);

            // Native PHP object, please
            $token = json_decode($response);
            $this->access_token = $token->access_token; // guard this! 
//            print_r(time() + $token->expires_in); // absolute time
//            $response = $this->__callAPI('POST', $this->access_token_path, $params);
            return $token->access_token;
        }
        return null;
    }

    public function user()
    {
        $opts = array(
            'http' => array(
                'method' => 'GET',
                'header' => "Authorization: Bearer " . $this->access_token . "\r\n" . "x-li-format: json\r\n"
            )
        );

        // Need to use HTTPS
        $url = 'https://api.linkedin.com/v1/people/~:(firstName,lastName,email-address)?format=json';

        // Tell streams to make a (GET, POST, PUT, or DELETE) request
        // And use OAuth 2 access token as Authorization
        $context = stream_context_create($opts);

        // Hocus Pocus
        $response = file_get_contents($url, false, $context);

        // Native PHP object, please
        return json_decode($response);
    }

    /**
     * Return the code.
     *
     * @return string|null
     */
    protected function getCode()
    {
        return isset($_GET['code']) ? $_GET['code'] : null;
    }

    /**
     * Stores a state string in session storage for CSRF protection.
     * Developers should subclass and override this method if they want to store
     *   this state in a different location.
     *
     * @param string $state
     *
     * @throws LinkedinException
     */
    protected function storeState($state)
    {
        if ($this->checkForSessionStatus === true && session_status() !== PHP_SESSION_ACTIVE) {
            throw new LinkedinException(
            'Session not active, could not store state.', 720
            );
        }
        $_SESSION[$this->sessionPrefix . 'state'] = $state;
    }

    /**
     * Check if a redirect has a valid state.
     *
     * @return bool
     */
    protected function isValidRedirect()
    {
        $savedState = $this->loadState();
        if (!$this->getCode() || !isset($_GET['state'])) {
            return false;
        }
        $givenState = $_GET['state'];
        $savedLen = mb_strlen($savedState);
        $givenLen = mb_strlen($givenState);
        if ($savedLen !== $givenLen) {
            return false;
        }
        $result = 0;
        for ($i = 0; $i < $savedLen; $i++) {
            $result |= ord($savedState[$i]) ^ ord($givenState[$i]);
        }
        return $result === 0;
    }

    /**
     * Loads a state string from session storage for CSRF validation.  May return
     *   null if no object exists.  Developers should subclass and override this
     *   method if they want to load the state from a different location.
     *
     * @return string|null
     *
     * @throws LinkedinException
     */
    protected function loadState()
    {
        if ($this->checkForSessionStatus === true && session_status() !== PHP_SESSION_ACTIVE) {
            throw new LinkedinException(
            'Session not active, could not load state.', 721
            );
        }
        if (isset($_SESSION[$this->sessionPrefix . 'state'])) {
            $this->state = $_SESSION[$this->sessionPrefix . 'state'];
            return $this->state;
        }
        return null;
    }

    /**
     * Generate a cryptographically secure pseudrandom number
     * 
     * @param integer $bytes - number of bytes to return
     * 
     * @return string
     * 
     * @throws LinkedinException
     * 
     * @todo Support Windows platforms
     */
    public function random($bytes)
    {
        if (!is_numeric($bytes)) {
            throw new LinkedinException(
            'random() expects an integer'
            );
        }
        if ($bytes < 1) {
            throw new LinkedinException(
            'random() expects an integer greater than zero'
            );
        }
        $buf = '';
        // http://sockpuppet.org/blog/2014/02/25/safely-generate-random-numbers/
        if (!ini_get('open_basedir') && is_readable('/dev/urandom')) {
            $fp = fopen('/dev/urandom', 'rb');
            if ($fp !== FALSE) {
                $buf = fread($fp, $bytes);
                fclose($fp);
                if ($buf !== FALSE) {
                    return bin2hex($buf);
                }
            }
        }

        if (function_exists('mcrypt_create_iv')) {
            $buf = mcrypt_create_iv($bytes, MCRYPT_DEV_URANDOM);
            if ($buf !== FALSE) {
                return bin2hex($buf);
            }
        }

        while (strlen($buf) < $bytes) {
            $buf .= md5(uniqid(mt_rand(), true), true);
            // We are appending raw binary
        }
        return bin2hex(substr($buf, 0, $bytes));
    }

    // ------------------------------------------------------------------------

    /**
     * Enables the use of CI super-global without having to define an extra variable.
     * I can't remember where I first saw this, so thank you if you are the original author.
     *
     * Copied from the Ion Auth library
     *
     * @access  public
     * @param   $var
     * @return  mixed
     */
    public function __get($var)
    {
        return get_instance()->$var;
    }

}

/**
 * Class LinkedinException
 */
class LinkedinException extends \Exception {
    
}
