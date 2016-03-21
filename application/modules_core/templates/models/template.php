<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class template extends MY_Model {

    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('file');
    }
    /*
     * create site template
     */
   
    public function create($template_Name, $category_id)
    {

        $user = $this->ion_auth->user()->row();

        $userID = $user->id;
        //

        $data = [
            'user_id' => $userID,
            'template_name'=>$template_Name,
            'category_id'=>$category_id
        ];

        $this->db->insert('template', $data);

        $templateID = $this->db->insert_id();

        return $templateID;
    }
    public function delete_template_element($template_id){
        $this->db->where('template_id', $template_id);
        $this->db->delete('template_elements'); 
    }
    public function create_template_element($template_id, $template_element){
        
        foreach ($template_element as $frames) {
            
            foreach ($frames as $frameData) {

                $frameContent = $frameData['frameContent'];
                if (stristr($frameContent, '<link href="' . base_url('elements'))) {
                    $frameContent = str_replace('<link href="' . base_url('elements') . '/', '<link href="', $frameContent);
                }
                if (stristr($frameContent, '<script src="' . base_url('elements'))) {
                    $frameContent = str_replace('<script src="' . base_url('elements') . '/', '<script src="', $frameContent);
                }
                if (stristr($frameContent, 'src="' . base_url('elements') . '/images')) {
                    $frameContent = str_replace('src="' . base_url('elements') . '/images', 'src="images', $frameContent);
                }
                $data = [                    
                    'content' => $frameContent,
                    'template_id'=>$template_id,
                    'content_timestamp' => time()
                ];

                $this->db->insert('template_elements', $data);
            }
        }
    }
    public function check_category_template_name($template_name, $category_id){
        $this->db->where('template_name', $template_name);
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('template');
        if($query->num_rows()>0){
            return true;
        }else{
            return false;
        }
    }
    public function get_all_category(){
        $query= $this->db->get('template_category');
        return $query->result();
    }
}
