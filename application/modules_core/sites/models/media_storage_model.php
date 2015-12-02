<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media_storage_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
        
    }
    
    public function insertMedia($data)
    {
        if($this->db->insert('amazon_media_storage', $data)){
            return $newSiteID = $this->db->insert_id();
        }else{
            return FALSE;
        }
    }
    
    public function getMediaByUser($user_id)
    {
        $this->db->from('amazon_media_storage');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }

        $res = $query->result();
        
        return $res;
    }
    
    public function getUserMediaByType($user_id, $type)
    {
        $this->db->from('amazon_media_storage');
        $this->db->where('user_id', $user_id);
        $this->db->where('type', $type);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }

        $res = $query->result();
        
        return $res;
    }
    
    public function getBucketByType($user_id, $type)
    {
        $this->db->select('bucket_name');
        $this->db->from('amazon_media_storage');
        $this->db->where('user_id', $user_id);
        $this->db->where('type', $type);
        $this->db->group_by('bucket_name'); 
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }

        $res = $query->result();

        $bucket = $res[0];
        
        return $bucket;
    }
    
    public function getUriByType($user_id, $type)
    {
        $this->db->select('uri');
        $this->db->from('amazon_media_storage');
        $this->db->where('user_id', $user_id);
        $this->db->where('type', $type);
        $this->db->group_by('uri'); 
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }

        $res = $query->result();

        $uri = $res[0];
        
        return $uri;
    }
}