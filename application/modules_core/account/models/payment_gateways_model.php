<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of payment_gateways_model
 *
 * @author NUSTECH
 */
class Payment_gateways_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_payment_gateways($user_id)
    {
        $this->db->select();
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('payment_gateways');
        $res = $query->result();
        if (!empty($res)) {
            return $res[0];
        } else {
            return FALSE;
        }
    }

    function set_payment_gateways($data)
    {
        if ($this->db->insert('payment_gateways', $data)) {
            $gateway_id = $this->db->insert_id();
            return $gateway_id;
        } else {
            return FALSE;
        }
    }

    function update_payment_gateways($data)
    {
        if ($this->db->update('payment_gateways', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
