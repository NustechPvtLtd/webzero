<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Plans_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    function get_plans($id = '')
    {
        $this->db->select('price_plan.plan_id,price_plan.name AS plan_name,price_plan.description as plan_desc,price_plan.price,price_plan.discount_type,price_plan.discount,price_plan.expiration_type,price_plan.expiration,price_plan.recommended,price_plan.status,price_plan.visitor_count,price_plan.premium_domain,price_plan.no_of_sites,price_plan.date_added,price_plan.last_updated,groups.name as grp_name,groups.description as grp_desc,groups.id as grp_id');
        $this->db->join('plans_group', 'plans_group.plan_id = price_plan.plan_id');
        $this->db->join('groups', 'plans_group.group_id = groups.id');
        if ($id) {
            $this->db->where('price_plan.plan_id', $id);
        }
        $this->db->where('deleted', 0);
        $this->db->order_by('plan_name', 'asc');
        $query = $this->db->get('price_plan');
        if ($query->result()) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function get_plan_name($id)
    {
        $this->db->select('name');
        $this->db->where('plan_id', $id);
        $query = $this->db->get('price_plan')->result();

        return $query[0]->name;
    }

    public function get_plan_group($id)
    {
        $this->db->select('group_id');
        $this->db->where('plan_id', $id);
        $query = $this->db->get('plans_group')->result();

        return $query[0]->group_id;
    }

    public function get_plans_by_id($plan_id)
    {
        $this->db->select();
        $this->db->where('plan_id', $plan_id);
//        $this->db->where('deleted', 0);
        $query = $this->db->get('price_plan');
        if ($query->result()) {
            $return = $query->result();
            return $return[0];
        } else {
            return FALSE;
        }
    }

    public function create_plan($data)
    {
        if ($this->db->insert('price_plan', $data)) {
            $plan_id = $this->db->insert_id();
            return $plan_id;
        } else {
            return FALSE;
        }
    }

    public function update_plan($data)
    {
        if (isset($data['plan_id'])) {
            $this->db->where('plan_id', $data['plan_id']);
        }
        if ($this->db->update('price_plan', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_plan($plan_id)
    {
        $this->db->where('plan_id', $plan_id);
        if ($this->db->update('price_plan', array('deleted' => 1))) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update_plan_group($plan_id, $group_id)
    {
        $this->db->select();
        $this->db->where('plan_id', $plan_id);
        $query = $this->db->get('plans_group')->result();
        if (!empty($query)) {
            $this->db->where('plan_id', $plan_id);
            $this->db->update('plans_group', array('group_id' => $group_id));
            return TRUE;
        } else {
            $this->db->insert('plans_group', array('group_id' => $group_id, 'plan_id' => $plan_id));
            return TRUE;
        }
        return FALSE;
    }

}
