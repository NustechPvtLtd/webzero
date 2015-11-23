<?php  defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Description of api_key_model
 *
 * @author NUSTECH
 */
class Api_key_model extends CI_Model{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_key($user_id)
    {
        $this->db->select('key');
        $this->db->from('api_keys');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();

        if ($query->num_rows() == 0) {
            return FALSE;
        }

        $res = $query->result();

        $keys = $res[0];
        return $keys->key;
    }
    
    public function key_exists($key)
    {
        $query = $this->db->from('api_keys')->where('key', $key)->get();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function insert_key($data)
    {
        if(!$this->get_key($data['user_id'])){
            return $this->db->insert('api_keys', $data)?TRUE:FALSE;
        }else{
            return $this->db->update('api_keys', $data, array('user_id' => $data['user_id']))?TRUE:FALSE;
        }
    }
    
    public function delete($key)
    {
        $this->db->where('key', $key);
        if($this->db->delete('api_keys')){
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
