<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class templatemodel extends CI_Model {

    function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->helper('file');
    }

    /*
     * create site template
     */

    public function create($template_Name, $category_id, $img_url, $profile)
    {

        $user = $this->ion_auth->user()->row();

        $userID = $user->id;
        //

        $data = [
            'user_id' => $userID,
            'template_name' => $template_Name,
            'category_id' => $category_id,
            'preview' => $img_url,
            'profile' => $profile
        ];
        // print_r($data);

        $this->db->insert('template', $data);

        $templateID = $this->db->insert_id();

        return $templateID;
    }

    //show all template depend upon the user has created
    public function show_all_template($user_id)
    {
        $sql = "SELECT `template_id`,`category_name`,`template_name`,`user_id`,`created_time`,`visibility`,`preview`, `profile` FROM `template` t ,`template_category` c WHERE `user_id`='$user_id' AND t.category_id=c.category_id";
        $query = $this->db->query($sql);
        if ($query->result()) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function delete_template_element($template_id)
    {
        $this->db->where('template_id', $template_id);
        $this->db->delete('template_elements');
    }

    public function create_template_element($template_id, $template_element)
    {

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
                    'template_id' => $template_id,
                    'content_timestamp' => time()
                ];

                $this->db->insert('template_elements', $data);
            }
        }
    }

    public function check_category_template_name($template_name, $category_id)
    {
        $this->db->where('template_name', $template_name);
        $this->db->where('category_id', $category_id);
        $query = $this->db->get('template');
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all_category()
    {
        $query = $this->db->get('template_category');
        return $query->result();
    }

    public function get_all_template($profile = NULL)
    {
        $this->db->where('visibility', 1);
        if ($profile) {
            $this->db->where('profile', $profile);
        }
        $query = $this->db->get('template');
        $res = $query->result();
        $template_array['elements']['Templates'] = [];
        foreach ($res as $i => $temp_data) {
            $template_array['elements']['Templates'][$i] = array('url' => 'sites/getTempElements', 'thumbnail' => $temp_data->preview);
            $this->db->where('template_id', $temp_data->template_id);

            $query = $this->db->get('template_elements');
            $res_temp = $query->result();
            foreach ($res_temp as $templ_ele) {
                if (isset($templ_ele->template_element_id)) {
                    $template_array['elements']['Templates'][$i]['sequence'][] = array('url' => site_url('sites/get_elements/' . $templ_ele->template_element_id), 'id' => $templ_ele->template_element_id);
                }
            }
        }
        $json = json_encode($template_array);
        return $json;
    }

    public function getSingleElement($template_element_id)
    {

        $this->db->where('template_element_id', $template_element_id);
        $query = $this->db->get('template_elements');

        if ($query->num_rows() == 0) {
            return false;
        }
        $res = $query->result();
        foreach ($res as $tempdata) {
            $template_content = $tempdata->content;
        }
        return $template_content;
    }

    public function getTemplate($template_id)
    {
        $this->db->where('template_id', $template_id);
        $query = $this->db->get('template');
        if ($query->num_rows() == 0) {

            return false;
        }

        $res = $query->result();

        $site = $res[0];

        $siteArray = [];
        $siteArray['site'] = $site;
        $pageFrames = [];
        $this->db->where('template_id', $template_id);
        $query = $this->db->get('template_elements');

        if ($query->num_rows() == 0) {

            return false;
        }
        $pageFrames['index'] = $query->result();
        $siteArray['pages'] = $pageFrames;
//        $res = $query->result();
//        $siteArray = [];
//        $siteArray['template']=$template_id;
//        $pageFrames = [];
//        foreach ($res as $element) {
//
//           $pageFrames[$element->template_element_id]= $element->content;
//        }
//        $siteArray['elements'] = $pageFrames;       
//        return $siteArray;

        return $siteArray;
    }

    public function updateImg($template_id, $img)
    {
        $data = [
            'preview' => $img
        ];
        $this->db->where('template_id', $template_id);
        $this->db->update('template', $data);
    }

}
