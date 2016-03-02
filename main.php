<?php
/**
 * Plugin Name: nmpl custom login page 
 * Plugin URI: www.google.com
 * Description: This plugin adds Dynamic Logo for your site.
 * Versi!~on: 1.0.0
 * Author: Arpan Gupta
 * Author URI: www.google.com
 
 */

/* Adding js and css files for admin section*/
add_action( 'admin_enqueue_scripts', 'nomagic_resources' );
function nomagic_resources(){
wp_enqueue_media();
wp_enqueue_style( 'nmpl-style', plugin_dir_url( __FILE__ ) . 'css/nmplstyle.css' );
wp_enqueue_style( 'icon-lib', 'http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css' );

wp_enqueue_script( 'jquery_lib', plugin_dir_url( __FILE__ ) . 'js/jquery.min.js' );
wp_enqueue_script( 'nmpl_custom_script', plugin_dir_url( __FILE__ ) . 'js/myscript.js' );
}

/* Adding menu*/
add_action( 'admin_menu', 'nmpl_menu' );
function nmpl_menu() {
	add_menu_page( 'Nomagic Plugin Page', 'Nomagic Plugin', 'manage_options', 'nmpl_page', 'nmpl_options' );
	
}
/* option page which displays plugin options*/
function nmpl_options() {

	echo '<form method="post" action="options.php" enctype="multipart/form-data" >';
	settings_fields( 'nmpl_option_group' );
	do_settings_sections( 'nmpl_option_group' );?>
	
	<?php submit_button( 'Save Settings', 'primary', 'nmpl_sub_btn' );
	echo '<form>';
}

/* Registering options/settings for plugin */
add_action( 'admin_init', 'nmpl_settings' );

function nmpl_settings(){
	 register_setting( 'nmpl_option_group', 'nmpl_option_name'); 
	 
	 add_settings_section('nmpl_stng_sec_id', 'Nomagic plugin Settings Section', 'nmpl_stng_sec_call_fun', 'nmpl_option_group' );
	 
	 add_settings_field( 'nmpl_stng_id_status', 'Enable', 'nmpl_status_cl_bck_fun', 'nmpl_option_group', 'nmpl_stng_sec_id');
	 add_settings_field( 'nmpl_stng_id_logo_img', 'Logo Image', 'nmpl_logo_img_prv_cl_bck_fun', 'nmpl_option_group', 'nmpl_stng_sec_id');
	 add_settings_field( 'nmpl_stng_id_bg_img', 'Background Image', 'nmpl_bg_img_prv_cl_bck_fun', 'nmpl_option_group', 'nmpl_stng_sec_id');
	 add_settings_field( 'nmpl_stng_id_logo_title', 'Logo Title', 'nmpl_logo_title_cl_bck_fun', 'nmpl_option_group', 'nmpl_stng_sec_id');
	 add_settings_field( 'nmpl_stng_id_logo_url', 'Logo Url', 'nmpl_logo_url_cl_bck_fun', 'nmpl_option_group', 'nmpl_stng_sec_id');
}

function nmpl_stng_sec_call_fun(){
	echo ''; //Setting section call back function
}
/* Status call back function*/
function nmpl_status_cl_bck_fun(){
	$options= get_option('nmpl_option_name');
	$nmpl_status=$options['nmpl_stng_id_status'];
	?><input type="checkbox" name="nmpl_option_name[nmpl_stng_id_status]" value="1" <?php checked($nmpl_status,1); ?>><?php
}
/* Logo Url call back function*/
function nmpl_logo_url_cl_bck_fun(){
	$options = get_option( 'nmpl_option_name' );
	$logo_url=$options['nmpl_stng_id_logo_url'];
	?><input type="text" name="nmpl_option_name[nmpl_stng_id_logo_url]" value="<?php if(!isset($logo_url)||empty($logo_url)){
	$blog_url=get_bloginfo('url');
	echo $blog_url;
	}
	else{
	echo $logo_url;
	} ?>"><?php
}
/* Logo Title call back function*/
function nmpl_logo_title_cl_bck_fun(){
	$options = get_option( 'nmpl_option_name' );
	$logo_title=$options['nmpl_stng_id_logo_title'];
	?><input type="text" name="nmpl_option_name[nmpl_stng_id_logo_title]" value="<?php if(!isset($logo_title)||empty($logo_title)){
		$blog_name=get_bloginfo('name');
		echo $blog_name;
	}
	else{
		echo $logo_title;
	}?>"><?php
}
/* background image preview call back function*/
function nmpl_bg_img_prv_cl_bck_fun(){
	$options = get_option( 'nmpl_option_name' );
	$bg_img_attachment_id=$options["nmpl_stng_id_bg_img"];
	$bg_img_path= wp_get_attachment_url( $bg_img_attachment_id );
	if(isset($bg_img_attachment_id)&&!empty($bg_img_attachment_id)){
		echo '<div class="bg-img_con">
				<image width="150px" height="150px" src="'.$bg_img_path.'" class="nmpl_bg_img_preview" >
				<div class="bg-edit-delete"><a href="#"><i class="fa fa-pencil fa-lg bg-edit-icon"></i></a>
					<a href="#"><i class="fa fa-times fa-lg bg-delete-icon"></i></a>
				</div>
			</div>
		';
	}
	else {
		echo '<div class="bg-img_con">
		<image width="150px" height="150px" src="" class="nmpl_bg_img_preview" style="display:none">
		<div class="bg-edit-delete"><a href="#"><i class="fa fa-pencil fa-lg bg-edit-icon"></i></a>
			<a href="#"><i class="fa fa-times fa-lg bg-delete-icon"></i></a>
		</div>
		</div>
		';
	}
	?>
	<div class="nmpl_bg_img_div">
	<button id="bg_btn" type="button" class="button button-primary" >upload image</button>
	</div>
	<?php ?>
	<input type="hidden" name='nmpl_option_name[nmpl_stng_id_bg_img]' id="nmpl_bg_img_hid_input" value='<?php echo $options["nmpl_stng_id_bg_img"]; ?>'>
	<?php 
}
/* logo image preview call back function*/
function nmpl_logo_img_prv_cl_bck_fun(){
	$options = get_option( 'nmpl_option_name' );
	$logo_img_attachment_id=$options["nmpl_stng_id_logo_img"];
	$logo_img_path= wp_get_attachment_url( $logo_img_attachment_id );
	if(isset($logo_img_attachment_id)&&!empty($logo_img_attachment_id)){
		echo '<div class="lg-img-con">
		<image width="150px" height="150px" src="'.$logo_img_path.'" class="nomagic_logo_preview" >
		<div class="lg-edit-delete"><a href="#"><i class="fa fa-pencil fa-lg lg-edit-icon"></i></a>
			<a href="#"><i class="fa fa-times fa-lg lg-delete-icon"></i></a>
		</div>
		</div>';
	}
	else {
		echo '<div class="lg-img-con">
		<image width="150px" height="150px" src="" class="nomagic_logo_preview" style="display:none">
		<div class="lg-edit-delete"><a href="#"><i class="fa fa-pencil fa-lg lg-edit-icon"></i></a>
			<a href="#"><i class="fa fa-times fa-lg lg-delete-icon"></i></a>
		</div>
		</div>
		';
	}
	?>
	<div class="nomagic_logo_img_div">
	<button id="btn" type="button" class="button button-primary" >upload image</button>
	</div>
	<?php ?>
	<input type="hidden" name='nmpl_option_name[nmpl_stng_id_logo_img]' id="nomagic_hid_input" value='<?php echo $options["nmpl_stng_id_logo_img"]; ?>'>
	<?php 
}
/* logo image change call back function*/
function nmpl_login_logo() { 
	$options = get_option( 'nmpl_option_name' );
	$nmpl_status=$options['nmpl_stng_id_status'];
	$logo_img_attachment_id=$options["nmpl_stng_id_logo_img"];
	$logo_img_path= wp_get_attachment_url( $logo_img_attachment_id );
	$bg_img_attachment_id=$options["nmpl_stng_id_bg_img"];
	$bg_img_path= wp_get_attachment_url( $bg_img_attachment_id );
	if($nmpl_status){
		if($logo_img_path){?>
			<style type="text/css">
			.login h1 a {
				background-image: url(<?php echo $logo_img_path;?>);
				padding-bottom: 30px;
			}
		</style>
		<?php 
		}
		if($bg_img_path){?>
			<style type="text/css">
			body.login {
			background: #fbfbfb url('<?php echo $bg_img_path;?>') no-repeat fixed center;
			}
		
		</style>
		<?php
		} ?>
		
	<?php
	}
}
add_action( 'login_enqueue_scripts', 'nmpl_login_logo' );

/* logo url change call back function*/
function nmpl_logo_url() {
	$options = get_option( 'nmpl_option_name' );
	$nmpl_status=$options['nmpl_stng_id_status'];
	$logo_url=$options['nmpl_stng_id_logo_url'];
	if($nmpl_status){
		if($logo_url){
			return $logo_url;
		}
	}
    
}
add_filter( 'login_headerurl', 'nmpl_logo_url' );

/* logo title change call back function*/
function nmpl_login_logo_url_title() {
	$options = get_option( 'nmpl_option_name' );
	$nmpl_status=$options['nmpl_stng_id_status'];
	$logo_title=$options['nmpl_stng_id_logo_title'];
	if($nmpl_status){
		
		return $logo_title;
	}
    
}
/* un-install call back function*/
add_filter( 'login_headertitle', 'nmpl_login_logo_url_title' );
$file=plugin_dir_url( __FILE__ ).'uninsatll.php';
function nmpl_delete_options(){
}
register_uninstall_hook($file, 'nmpl_delete_options');