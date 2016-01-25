<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Media_storage_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function insertMedia($data)
    {
        if ($this->db->insert('amazon_media_storage', $data)) {
            (!empty($data['type']))?$this->deleteEmptyRow($data['user_id'], $data['type']):$this->deleteEmptyRow($data['user_id']);
            $newSiteID = $this->db->insert_id();
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function insertUri($data)
    {
        if ($this->db->insert('amazon_media_storage', $data)) {
            return $newSiteID = $this->db->insert_id();
        } else {
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

    public function getBucket($user_id, $type = FALSE)
    {
        $this->db->select('bucket_name');
        $this->db->from('amazon_media_storage');
        $this->db->where('user_id', $user_id);
        if($type){
            $this->db->where('type', $type);
        }
        $this->db->group_by('bucket_name');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }

        $res = $query->result();

        $bucket = $res[0];

        return $bucket;
    }
    
    public function getUri($user_id, $type = FALSE)
    {
        $this->db->select('uri');
        $this->db->from('amazon_media_storage');
        $this->db->where('user_id', $user_id);
        if($type){
            $this->db->where('type', $type);
        }
        $this->db->group_by('uri');
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return false;
        }

        $res = $query->result();

        $uri = $res[0];

        return $uri;
    }

    public function deleteMedia($media_name, $user_id)
    {
        $data = array(
            'media_name' => '',
        );

        $this->db->where('media_name', $media_name);
        $this->db->where('user_id', $user_id);
        $this->db->update('amazon_media_storage', $data);
    }

    public function deleteEmptyRow($user_id, $type=NULL)
    {
        $this->db->where('user_id', $user_id);
        $this->db->where('media_name', '');
        if($type){$this->db->where('type', $type);}
        if($this->db->delete('amazon_media_storage')){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function genrate_unique_name()
    {
        return strtoupper(substr(hash('sha256', mt_rand() . microtime()), 0, 10));
    }

}
