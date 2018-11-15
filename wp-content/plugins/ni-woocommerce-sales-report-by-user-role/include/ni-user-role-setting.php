<?php
if ( ! defined( 'ABSPATH' ) ) { exit;}
if( !class_exists( 'Ni_User_Role_Setting' ) ) {
	class Ni_User_Role_Setting{
			var $ni_constant = array();  
		public function __construct($ni_constant = array()){
			$this->ni_constant = $ni_constant; 
			add_action( 'admin_menu', array( $this, 'add_setting_page' ) );
			add_action( 'admin_init', array( $this, 'admin_init' ) );
			add_action( 'admin_init', array( $this, 'admin_init_save' ),10 );
		}
		function add_setting_page(){
			$option["role"] = "manage_options";
			add_submenu_page($this->ni_constant["menu"], 'Setting', 'Setting', $this->ni_constant["manage_options"] , 'ni-user-role-setting', array( $this, 'setting_page' ) );
		}
		function admin_init_save(){
			//echo json_encode($_REQUEST);
			if(isset($_REQUEST['ic-sales-agent-option'])){
				update_option("ic-sales-agent-option",$_REQUEST);
				//echo "dsad";
			}
			//die;
		}
		function admin_init(){
			
			
			register_setting(
				'ic-sales-agent-option-group', // Option group
				'ic-sales-agent-option', // Option name
				array( $this, 'sanitize' ) // Sanitize
			);
			
			add_settings_section(
				'setting_section_id', // ID
				'Sales Agent Settings', // Title
				array( $this, 'print_section_info' ), // Callback
				'ic-sales-agent-setting-admin' // Page
			);
			
			add_settings_field(
				'user_role', 
				'Select User Role', 
				array( $this, 'display_user_role' ), 
				'ic-sales-agent-setting-admin', 
				'setting_section_id'
			); 
		}
		function setting_page(){
			$this->options = get_option('ic-sales-agent-option');
			?>
			<div class="wrap">
				<?php //screen_icon(); ?>
				<form method="post">
				<div class="ic_commerce_settings">
				<?php
					// This prints out all hidden setting fields
					settings_fields('ic-sales-agent-option-group');   
					do_settings_sections('ic-sales-agent-setting-admin');
					submit_button(); 
				?>
				</div>
				</form>
			</div>
			<?php
		}
		function print_section_info(){
		}
		function display_user_role(){
		//echo json_encode($this->options);
		//echo "<br>";
		//echo json_encode( $this->options['ic-sales-person-option']["user_role"]);
		//	echo "<br>";
		$roles =  $this->get_user_role();
		?>
		<select name="ic-sales-agent-option[user_role]">
		<?php
		foreach($roles as $k=>$v) {
			//$this->options['user_role'] == $k
			$selected_user_role = isset($this->options['ic-sales-agent-option']["user_role"])?$this->options['ic-sales-agent-option']["user_role"]:'';
			if ($selected_user_role == $k){
			?>
			<option selected="selected" value="<?php echo $k; ?>"><?php echo $v; ?></option>
			<?php		
			}else{
			?>
			<option value="<?php echo $k; ?>"><?php echo $v; ?></option>
			<?php	
			}
		}
		?>
		</select>
		<?php	
		}
		function get_user_role(){
			global $wp_roles;
			$roles = $wp_roles->get_names();
		
			return $roles;
		}
	}
}
?>