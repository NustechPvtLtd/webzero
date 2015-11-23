<?php  

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ecomreportmodel extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
    }
	
	public function getallproducts($uid)
    {
		$query=$this->db->query("select * from users_products where user_id='".$uid."' ")or die(mysql_error());
		return $query->result();
	} 
	
	public function getsellingreport($prid)
	{
		$query=$this->db->query("select * from customer_orders where product_id='".$prid."' and response='success' ")or die(mysql_error());
		return $query->result();
	}
	
	public function getproductname($prid)
	{
		$query=$this->db->query("select name from users_products where product_id='".$prid."' ")or die(mysql_error());
		$res=$query->result();
		
		return $res[0]->name;
	}
	
	public function getbuyers()
    {
		//$uid=$this->ion_auth->get_user_id();
		
		$query=$this->db->query("select * from users inner join users_products on users.id=users_products.user_id group by users_products.user_id")or die(mysql_error());
		return $query->result();
	}

}

?>