<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Plans_orders_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    /*
     * Get all plans orders
     */

    function get_orders()
    {
        $query = $this->db->query('SELECT * FROM price_plan_order;');
        if ($query->result()) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    /*
     * Get plans orders by id
     */

    function get_orders_by_id($orders_id)
    {
        $this->db->select();
        $this->db->where('order_id', $orders_id);
        $query = $this->db->get('price_plan_order');
        if ($query->result()) {
            $return = $query->result();
            return $return[0];
        } else {
            return FALSE;
        }
    }

    /*
     * Insert plans orders
     */

    function create_plan_orders($data)
    {
        if ($this->db->insert('price_plan_order', $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        } else {
            return FALSE;
        }
    }

    /*
     * Update plans orders
     */

    function update_plan($data)
    {
        $this->db->where('order_id', $data['order_id']);
        if ($this->db->update('price_plan_order', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function plan_selling_reports()
    {
        $sql = "SELECT `order_id`,concat(IFNULL(u.first_name,''),' ',IFNULL(u.last_name,'')) as name,`customer_id`,pp.name as plan_name,`total`,p.status,p.last_updated FROM `price_plan_order` p ,`users` u,`price_plan` pp WHERE p.plan_id= pp.plan_id AND p.customer_id=u.id ORDER by last_updated DESC";
        $query = $this->db->query($sql);
        if ($query->result()) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

}
