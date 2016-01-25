<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Ecomreport extends MY_Controller {
    
    public $data = array();
    public $_salt;
    public $_url;
    public $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library( 'template');
		$this->load->library('ion_auth');
		$this->load->library('PayUMoney');
        $this->data['title'] = ucfirst($this->router->fetch_class());
		$this->load->model('ecomreport/ecomreportmodel');
		$this->load->model('login/ion_auth_model');
        $this->data['pageMetaDescription'] = ucfirst($this->router->fetch_class().'-'.$this->router->fetch_method());

	}
	
	function index()
	{
		if(!$this->ion_auth->is_admin())
		{
			$uid=$this->ion_auth->get_user_id();
			$this->data['pageHeading'] = 'All Products';
        }
		else
		{
			 $uid=$this->uri->segment(3);
			 $uname=$this->ion_auth_model->get_user_name($uid);
			 $this->data['pageHeading'] =$uname."'s Products";
		}
		
        $this->data['message'] = '';
        $this->data['css'] = array(
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.responsive.css" type="text/css" rel="stylesheet">',
            '<style>td.child{text-align:left !important}</style>'
        );
        $this->data['js'] = array(
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/jquery.dataTables.min.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.bootstrap.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.responsive.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/js/readmore.min.js"></script>',
            '<script>
			$(".plan_description").readmore({
			speed: 75,
			maxHeight: 0,
			collapsedHeight:50,
			moreLink: \'<a href="#">Read More</a>\',
			lessLink: \'<a href="#">Less</a>\',
			startOpen: false,
			
			});
			</script>'
        );
		
		$this->data['uid']=$uid;
		
		$this->data['result']=$this->ecomreportmodel->getallproducts($uid);	

        $this->template->load('main', 'ecomreport', 'index', $this->data);	
	}
    
	function getdescription()
	{
		    $id=$_POST['id'];
			
			$query=$this->db->query("select * from users_products where id='".$id."' ")or die(mysql_error());
			$res=$query->result();
			
			foreach($res as $res) 
			{
				echo $desc=$res->description; 
		    }
		 ?>
				<span class="moretext" onclick="hidedesc(<?php echo $id;?>)" style="float:right;">Back < </span>
	  <?php 
	}
	
	function hidedescription()
	{
		    $id=$_POST['id'];

			$query=$this->db->query("select * from users_products where id='".$id."' ")or die(mysql_error());
			$res=$query->result();
			$desc="";
			foreach($res as $res) 
			{
				 $desc=$res->description; 
		    }
				
		
			$strlen=strlen($desc);  
			if ($strlen > 530) 
			{ 
				echo substr($desc,0,530);?>
				..........<span class="moretext" onclick="getdesc(<?php echo $id; ?>)">More ></span>
	   <?php          
			} 
			else 
			{
				echo $result->description; 
			}
	}
	
	public function sellingreport()
	{
	    $prid=$this->uri->segment(3);
		
		$uid=$this->uri->segment(4);
		
		$prname=$this->ecomreportmodel->getproductname($prid);	
	   
	    $this->data['pageHeading'] = $prname.' Selling Report';
        $this->data['message'] = '';
        $this->data['css'] = array(
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.responsive.css" type="text/css" rel="stylesheet">',
            '<style>td.child{text-align:left !important}</style>'
        );
        $this->data['js'] = array(
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/jquery.dataTables.min.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.bootstrap.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.responsive.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/js/readmore.min.js"></script>',
            '<script>
			$(".plan_description").readmore({
			speed: 75,
			maxHeight: 0,
			collapsedHeight:50,
			moreLink: \'<a href="#">Read More</a>\',
			lessLink: \'<a href="#">Less</a>\',
			startOpen: false,
			
			});
			</script>'
        );
		
		$this->data['uid']=$uid;
		
		$this->data['result']=$this->ecomreportmodel->getsellingreport($prid);	

        $this->template->load('main', 'ecomreport', 'sellingreport', $this->data);
	}
	
	public function allbuyers()
	{
		if(!$this->ion_auth->is_admin()){
            redirect('/','refresh');
        }
		
		$this->data['pageHeading'] = 'Sellers List';
        $this->data['message'] = '';
        $this->data['css'] = array(
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.responsive.css" type="text/css" rel="stylesheet">',
            '<style>td.child{text-align:left !important}</style>'
        );
        $this->data['js'] = array(
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/jquery.dataTables.min.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.bootstrap.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.responsive.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/js/readmore.min.js"></script>',
            '<script>
			$(".plan_description").readmore({
			speed: 75,
			maxHeight: 0,
			collapsedHeight:50,
			moreLink: \'<a href="#">Read More</a>\',
			lessLink: \'<a href="#">Less</a>\',
			startOpen: false,
			
			});
			</script>'
        );
		
		$this->data['results']=$this->ecomreportmodel->getbuyers();	

        $this->template->load('main', 'ecomreport', 'allbuyers', $this->data);
	}
    
    public function invoices()
    {
		$this->data['pageHeading'] = 'My Invoices';
        $this->data['message'] = '';
        $this->load->model('products/invoices_model');
        $this->data['css'] = array(
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.responsive.css" type="text/css" rel="stylesheet">',
            '<style>td.child{text-align:justify !important}</style>'
        );
        $this->data['js'] = array(
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/jquery.dataTables.min.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.bootstrap.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.responsive.js"></script>',
            '<script type="text/javascript" src="' . base_url() . 'assets/js/readmore.min.js"></script>',
        );
        
        $this->data['results']=$this->invoices_model->getInvoiceByUser(userdata('user_id'));	

        $this->template->load('main', 'ecomreport', 'invoices', $this->data);
    }

}