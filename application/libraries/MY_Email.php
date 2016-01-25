<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

  class MY_Email extends CI_Email {

      public function __construct($config = array())
      {
          parent::__construct($config);
      }

      // this will allow us to add headers whenever we need them
      /*
       * @header array key value pair of mail header
       */
      public function header($header)
      {
          foreach ($header as $key => $value) {
              $this->_set_header($key, $value);
          }
      }

  }