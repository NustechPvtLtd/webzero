<?php
	(defined('BASEPATH')) OR exit('No direct script access allowed');
	class Studentsearch extends MY_Controller
	{
		public $data = array();
		
		function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->library( 'template');
			$this->load->library('ion_auth');
			
			$this->data['title'] = ucfirst($this->router->fetch_class());
			$this->load->model('studentsearch/studentsearchmodel');
			$this->load->model('login/ion_auth_model');
			$this->data['pageMetaDescription'] = $this->router->fetch_class().'-'.$this->router->fetch_method();
	
		}
		
		function index()
		{
            $this->data['pageHeading'] = 'Search Students';
			
			if(!empty($_POST['gensearch']))
			{
				$this->data['result']=$this->studentsearchmodel->searchstudents();
				$this->data['is_search']="yes";
			}
			else if(!empty($_POST['advsearch']))
			{
				$this->data['result']=$this->studentsearchmodel->searchstudentsadv();
				$this->data['is_search']="yes";
			}
			else
			{
				$this->data['result']=array();
				$this->data['is_search']="";
			}
			
		    $this->data['css'] = array(
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.bootstrap.css" type="text/css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/datatable/css/dataTables.responsive.css" type="text/css" rel="stylesheet">',
            '<link href="' . base_url() . 'assets/redactor/redactor.css" type="text/css" rel="stylesheet">',
            '<style>td.child{text-align:left !important}</style>'
            );
		   
			$this->data['js'] = array(
				'<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/jquery.dataTables.min.js"></script>',
				'<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.bootstrap.js"></script>',
				'<script type="text/javascript" src="' . base_url() . 'assets/datatable/js/dataTables.responsive.js"></script>',
				'<script type="text/javascript" src="' . base_url() . 'assets/js/readmore.min.js"></script>',
				'<script type="text/javascript" src="' . base_url() . 'assets/redactor/redactor.min.js"></script>',
				'<script>
					$(".plan_description").readmore({
						speed: 75,
						maxHeight: 0,
						collapsedHeight:50,
						moreLink: \'<a href="#">Read More</a>\',
						lessLink: \'<a href="#">Less</a>\',
						startOpen: false,
					});
					$("#emailcontents").redactor({
						buttons:["format","bold", "italic","underline","deleted","horizontalrule","lists","link"]
					});
				</script>'
			);
			
		   $this->template->load('main', 'studentsearch', 'index', $this->data);
		}
		
		function sendemail()
		{
			$allids=$_POST['allids'];	
			$emailcnt=$_POST['emailcnt'];
			$emailsub=$_POST['emailsub'];
			$this->studentsearchmodel->sendemail($allids,$emailcnt,$emailsub);
		}
	}

?>