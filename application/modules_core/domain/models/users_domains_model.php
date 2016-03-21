<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of addon_domain_model
 *
 * @author NUSTECH
 */
class Users_domains_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function create($site_id, $user_id, $domain, $url_option)
    {
        $data = array(
            'domain' => $domain,
            'user_id' => $user_id,
            'site_id' => $site_id,
            'domain_publish' => 0,
            'url_option' => $url_option,
            'active' => 1
        );

//        if ($this->exist($site_id)) {
        $this->deactivateDomain($site_id);
//        }

        if ($this->exist($site_id, $url_option)) {
            $this->db->where('site_id', $site_id);
            $this->db->where('url_option', $url_option);
            $this->db->update('users_domains', $data);
            $query = $this->getDomain($site_id);
            $domainID = $query->id;
        } else {
            $this->db->insert('users_domains', $data);
            $domainID = $this->db->insert_id();
        }

        if ($url_option == 'freeUrl') {
            $remote_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $domain;
        } else {
            $remote_url = 'http://' . $domain;
        }
        $this->db->where('sites_id', $site_id)->update('sites', array('domain_ok' => 1, 'remote_url' => $remote_url));
        return $domainID;
    }

    public function getDomain($siteId)
    {
        $query = $this->db->from('users_domains')->where('site_id', $siteId)->get();

        if ($query->num_rows() > 0) {
            $res = $query->result();
            return $res[0];
        } else {
            return FALSE;
        }
    }

    public function exist($site_id, $url_option)
    {
        $query = null;

        $condition = array(
            'site_id' => $site_id,
            'url_option' => $url_option
        );

        $query = $this->db->get_where('users_domains', $condition);

        $count = $query->num_rows(); //counting result from query
        if ($count === 0) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function domain_publish($site_id)
    {
        if ($this->db->where(array('site_id' => $site_id, 'active' => 1))->update('users_domains', array('domain_publish' => 1))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deactivateDomain($site_id)
    {
        $this->db->update('users_domains', array('active' => 0, 'domain_publish' => 0), array('site_id' => $site_id));
    }

    public function inative_domain($site_id)
    {
        $condition = array(
            'site_id' => $site_id,
            'active' => 0
        );

        $query = $this->db->get_where('users_domains', $condition);

        $count = $query->num_rows(); //counting result from query
        if ($count === 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

}
