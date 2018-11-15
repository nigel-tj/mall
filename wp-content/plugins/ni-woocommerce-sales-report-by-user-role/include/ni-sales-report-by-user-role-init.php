<?php
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'Ni_Sales_Report_By_User_Role_Init' ) ) {
	class Ni_Sales_Report_By_User_Role_Init {
		var $ni_constant = array();  
		function __construct($ni_constant = array()) {
			
			$this->ni_constant = $ni_constant; 
			//$this->get_menu();
			add_action( 'add_meta_boxes',	array($this,'add_sales_agent_metaboxes'), 10, 2 );
			add_action('admin_init', 		array($this,'admin_init'));
			add_action('admin_menu', 		array($this,'admin_menu'));	
			add_action( 'admin_enqueue_scripts',  array(&$this,'admin_enqueue_scripts' ));
			add_action( 'wp_ajax_user_role_report',  array(&$this,'ajax_user_role_report' )); /*used in form field name="action" value="my_action"*/
			
			add_filter( 'admin_footer_text',  array(&$this,'admin_footer_text' ),101);
			$this->add_setting_page();
			//print_r($ni_constant);	
			//echo $this->ni_constant["menu"];	
		}
		function admin_menu(){
			add_menu_page( 'User Role Report', 'User Role Report', $this->ni_constant['manage_options'], $this->ni_constant['menu'], array( $this, 'add_page'), 'dashicons-groups', "42.636" );
			add_submenu_page($this->ni_constant["menu"],"Dashboard","Dashboard", $this->ni_constant['manage_options'],'ni-dashboard-user-role', array( $this, 'add_page'));
			add_submenu_page($this->ni_constant["menu"],"Sales Product Report","Sales Product Report",  $this->ni_constant['manage_options'],'ni-sales-order-by-user-role', array( $this, 'add_page'));
			
			add_submenu_page($this->ni_constant["menu"],"Agent Report","Agent Report",  $this->ni_constant['manage_options'],'ni-sales-agent-report', array( $this, 'add_page'));
			
			do_action("ni_sales_agent_report_menu",$this->ni_constant);
			
	
		}
		function add_setting_page(){
			include("ni-user-role-setting.php");
			$obj = new Ni_User_Role_Setting($this->ni_constant);
		}
		function settings_page(){
			//echo "dsa";
		}
		function add_page(){
			if (isset($_REQUEST["page"])){
				$page = $_REQUEST["page"];
				if ($page == "ni-dashboard-user-role"){
					include_once("ni-dashboard-user-role.php");
					$obj = new Ni_Dashboard_User_Role();
					$obj->init();
					
				}
				if ($page == "ni-sales-order-by-user-role"){
					include_once("ni-sales-order-report-by-user-role.php");
					$obj =  new Ni_Sales_Order_Report_By_User_Role();
					$obj->init();
					
				}
				if ($page =="ni-sales-agent-report"){
					include_once("ni-sales-agent-report.php");
					$obj =  new Ni_Sales_Agent_Report();
					$obj->init();
				}
			}	
		}
		function add_sales_agent_metaboxes() {
			add_meta_box('ni_sales_agent_metaboxes', 'Select Sales Agent',  array( $this,  'ni_display_meta_box'), 'shop_order', 'side', 'default');
		}
		function admin_init(){
			if (isset($_REQUEST["post_type"])){
				if ($_REQUEST["post_type"] == "shop_order"){
					if(isset($_REQUEST["post_ID"])){
						$post_id =  $_REQUEST["post_ID"];
						$user_id =  isset($_REQUEST["ic_user_role"])?$_REQUEST["ic_user_role"]:'-1';
						update_post_meta($post_id, '_ic_sales_agent_user_id', $user_id);
					}
				}
			
			}
			//echo json_encode($_REQUEST);
			//die;
		}
		function ni_display_meta_box(){
			global $wpdb;
			global $post;
			$sales_person_option = get_option('ic-sales-agent-option');
			/*
			print "<pre>";
			print_r($sales_person_option["ic-sales-person-option"]["user_role"]);
			print "</pre>";
			*/
			$role =  $sales_person_option["ic-sales-agent-option"]["user_role"];
			$query=  "";
			//$role = "ic_salesperson";
			
			$query = " SELECT ";
			$query .= " users.ID as user_id  ";
			$query .= " ,users.user_email as user_email  ";
			$query .= " ,first_name.meta_value as first_name  ";
			$query .= " ,last_name.meta_value as last_name  ";
			
			$query .= " FROM	{$wpdb->prefix}users as users  ";
			
			
			$query .= " LEFT JOIN {$wpdb->prefix}usermeta  role ON role.user_id=users.ID ";
			$query .= " LEFT JOIN {$wpdb->prefix}usermeta  first_name ON first_name.user_id=users.ID ";
			$query .= " LEFT JOIN {$wpdb->prefix}usermeta  last_name ON last_name.user_id=users.ID ";
			
			$query .= " WHERE 1 = 1 ";
			$query .= " AND   role.meta_key='{$wpdb->prefix}capabilities'";
			$query .= " AND  role.meta_value   LIKE '%\"{$role}\"%' ";
			
			$query .= " AND   first_name.meta_key='first_name'";
			$query .= " AND   last_name.meta_key='last_name'";
				
			
			
			
			
			$data = $wpdb->get_results($query);
			$user_id = get_post_meta($post->ID, '_ic_sales_agent_user_id', true);
			?>
			<select  name="ic_user_role" id="ic_user_role">
		   <option selected="selected" value="-1">Select Sales Agent</option>
			<?php 
			foreach($data as $k=>$v){
				if ($user_id == $v->user_id){
					?>
					<option selected="selected" value="<?php echo $v->user_id ; ?>"> <?php echo  $v->first_name ." ". $v->last_name  ; ?></option>
					<?php	
				}else{
					?>
					<option value="<?php echo $v->user_id ; ?>"> <?php echo  $v->first_name ." ". $v->last_name  ; ?></option>
					<?php	
				}
			}
			?>
			</select>
			<?php
			/*
			global $wp_roles;
			$roles = $wp_roles->get_names();
			print "<pre>";
			print_r($roles );
			print "</pre>";
			//echo "dsadsa";
			foreach($roles as $k=>$v) {
				echo $v;
				echo $k;
				echo "<br>";		
			}
			*/
		}
		function get_menu(){
			$menu = array();
			//$menu = 	array('ni-sales-order-by-user-role','ni-dashboard-user-role','ni-user-role-setting','ni-sales-agent-report');
			$menu[] ='ni-sales-order-by-user-role';
			$menu[] ='ni-dashboard-user-role';
			$menu[] ='ni-user-role-setting';
			$menu[] ='ni-sales-agent-report';
			//$menu[] ='ni-agent-sales-order-report';
			
			//do_action("ni_sales_agent_menu_name",$menu);
			return $menu;
		}
		function admin_enqueue_scripts(){
			if (isset($_REQUEST["page"])){
				$page = $_REQUEST["page"];
				$menu = $this->get_menu();
				//print_r($menu);
				if (in_array($page, $menu)) {
					wp_enqueue_script( 'ni-ajax-script-user-role-report', plugins_url( '../assets/js/script.js', __FILE__ ), array('jquery') );
					wp_enqueue_script( 'ni-sales-order-by-user-role-script', plugins_url( '../assets/js/ni-sales-order-report-by-user-role.js', __FILE__ ) );
					wp_localize_script( 'ni-ajax-script-user-role-report','user_role_report_ajax_object',
						array('ni_sales_report_user_role_ajaxurl'=>admin_url('admin-ajax.php') ) );
					if($page  == "ni-dashboard-user-role"){	
						wp_register_style( 'ni-sales-report-summary-css', plugins_url( '../assets/css/ni-sales-report-summary.css', __FILE__ ));
						wp_enqueue_style( 'ni-sales-report-summary-css' );		
						
						wp_register_style( 'ni-font-awesome-css', plugins_url( '../assets/css/font-awesome.css', __FILE__ ));
						wp_enqueue_style( 'ni-font-awesome-css' );
					}
					if(($page  == "ni-sales-order-by-user-role") || ($page  == "ni-sales-agent-report")){
					wp_register_style( 'ni-sales-order-report-by-user-role-css', plugins_url( '../assets/css/ni-sales-order-report-by-user-role.css', __FILE__ ));
						wp_enqueue_style( 'ni-sales-order-report-by-user-role-css' );
					}
				}
			}
		}
		function ajax_user_role_report(){
			if (isset($_REQUEST['sub_action'])){
				$sub_action = $_REQUEST['sub_action'];
				do_action("add_ni_ajax_user_role_report",$sub_action);
				if ($sub_action =="ni_user_role_sales_order"){
					//echo json_encode($_REQUEST);
					include_once("ni-sales-order-report-by-user-role.php");
					$obj = new Ni_Sales_Order_Report_By_User_Role();
					$obj->get_sales_order_list();
				
				}
				if ($sub_action =="ni_sales_agent_report"){
					//echo json_encode($_REQUEST);
					include_once("ni-sales-agent-report.php");
					$obj = new Ni_Sales_Agent_Report();
					$obj->get_sales_order_list();
				}
				die;
			}
			
		}
		function admin_footer_text($text){
		
			 if (isset($_REQUEST["page"])){
				 $page = $_REQUEST["page"]; 
					if ($page == "ni-dashboard-user-role" || $page  =="ni-sales-order-by-user-role" || $page =="ni-user-role-setting"){
					$text = sprintf( __( 'Thank you for using our plugins <a href="%s" target="_blank">naziinfotech</a>    Email at: <a href="%s" target="_top">support@naziinfotech.com</a>' ), 
					__( 'http://naziinfotech.com/' ) , __( 'mailto:support@naziinfotech.com' ));
					$text = "<span id=\"footer-thankyou\">". $text ."</span>"	 ;
				}
			 }
			return $text ; 
		}
	}
}
//$obj = new  ic_sales_report_by_salesperson();
?>