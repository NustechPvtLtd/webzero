<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of invoices_model
 *
 * @author NUSTECH
 */
class Invoices_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        
        $this->load->database();
    }
    
    public function getInvoices()
    {
        return $this->db->select()->get()->result();
    }
    
    public function getInvoiceByUser($user_id)
    {
        $query = $this->db->query("select `invoice_id`, `invoices`.`transaction_id`, `invoice_date`, `due_date`, `total_amount`, `invoices`.`status` FROM invoices JOIN customer_orders ON `invoices`.`transaction_id` = `customer_orders`.`transaction_id` JOIN users_products ON `customer_orders`.`product_id` = `users_products`.`product_id` WHERE `users_products`.`user_id` = {$user_id} GROUP BY invoice_id");
        return $query->result();
    }
}
