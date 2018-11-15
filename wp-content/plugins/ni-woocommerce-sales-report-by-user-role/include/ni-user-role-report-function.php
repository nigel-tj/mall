<?php
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'Ni_User_Role_Report_Function' ) ) { 
	class Ni_User_Role_Report_Function{
		function __construct() {
		}
		function get_user_list($user_id =NULL){
			global $wpdb;
			
			$sales_person_option = get_option('ic-sales-agent-option');
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
				
			if ($user_id !=NULL){
				$query .= " AND  users.ID = '{$user_id }'";
			}
			$query .= "  ORDER BY first_name.meta_value ASC";
			
			
			$row = $wpdb->get_results($query);
			//$this->print_data($row);
			return $row;
		}
		function get_user_role($formated="N"){
			$sales_person_option = get_option('ic-sales-agent-option');
			$role =  $sales_person_option["ic-sales-agent-option"]["user_role"];
			if ($formated="Y"){
				$role =ucwords (str_replace("_"," ",$role));
			}
			return $role ;
			
		}
		function print_data($data){
			print "<pre>";
			print_r($data);
			print "</pre>";
		}
		function get_country_name($code)
		{	$name = "";
			if ($code){
				$name= WC()->countries->countries[ $code];	
				$name  = isset($name) ? $name : $code;
			}
			
			
			return $name;
		}
	}
}
?>