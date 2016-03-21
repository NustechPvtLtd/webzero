<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class template_model extends CI_Model {

    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('file');
    }
    /*
     * create site template
     */
   
    public function get_templates(){
        $sql="SELECT template_id,`template_name`,`visibility`, `preview` ,`user_id`,`created_time`,category_name, concat(IFNULL(u.first_name,''),' ',IFNULL(u.last_name,'')) as name, `profile` FROM `template` t, `template_category` c , `users` u WHERE u.id=t.user_id AND t.category_id=c.category_id";
        $query=$this->db->query($sql);
        if($query->result()){
            return $query->result();
        }else {
            return FALSE;
        }       
    }
   
    public function update_visibility($template_id, $visibility){       
        if($visibility=='show')
            $visibility=1;
        else
            $visibility=0;       
        $this->db->where('template_id',$template_id);
        if($this->db->update('template', array('visibility'=>$visibility))){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function getTemplate($template_id){
        
        $this->db->where('template_id',$template_id);
        $query=$this->db->get('template_elements');
        
        if ($query->num_rows() == 0) {

            return false;
        }
        $res = $query->result();
        $siteArray = [];
        $siteArray['template']=$template_id;
        $pageFrames = [];
        foreach ($res as $element) {

           $pageFrames[$element->template_element_id]= $element->content;
        }
        $siteArray['elements'] = $pageFrames;       
        return $siteArray;
    }
    
  
}
