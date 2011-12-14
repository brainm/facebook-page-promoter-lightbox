<?php
/*
 * This class contains all optoins and option pages!
 */
class arevico_facebook_opt{
/*______ CHANGE_______*/
var $defaults;
var $option_group="arv_prm_opt";
var $option_name="arv_fb24_opt";

var $setting_slug="arv_fb";
var $setting_title="Facebook Lightbox";
var $menu_title="Facebook Lightbox";

var $global_slug="arevico_settings";
/*______________________*/

function __construct(){
	/*______ DEFAULT OPTIONS________*/
	$this->defaults = array('extracss'=>'','overlayop'=>'0.3','overlaycolor'=>'#666666','display_on_homepage'=>'1' , 'fancybox'=>'-1','fb_id' => '287663154583826','display_on_page' => '1','display_on_post' => '1','show_once' => '0','delay' => '1000','width'=>'400','height' => '255');
	/*__________________________________________________________________*/
	add_action('admin_init', array(&$this,'options_init'));
	add_action('admin_menu', array(&$this,'options_add_page'));
	/*__________________________________________________________________*/

}
	function getOption(){
		return get_option($this->option_name,$this->defaults);
	}
	// Init plugin options to white list our options
	function options_init(){
		global $current_loc;
		register_setting( $this->option_group, $this->option_name, array(&$this,'options_val'));

		wp_register_style('simple_tabsjs', $current_loc . 'css/tabber.css');
		wp_enqueue_style( 'simple_tabsjs');

		wp_register_script( 'simple_tabscss', $current_loc . "js/tabber-minimized.js");
		wp_enqueue_script(  'simple_tabscss' );
	}


	// Add menu page
	function options_add_page() {
		global $submenu;
		add_menu_page('Arevico Settings', 'Arevico Settings', 'manage_options', $this->global_slug, array(&$this,'tld_page'));
		add_submenu_page( $this->global_slug, $this->page_title, $this->menu_title, 'manage_options', $this->setting_slug, array(&$this,'options_do_page'));

			/* Remove sublevel menu*/
		if (isset($submenu[$this->global_slug][0]) && (array_search($this->global_slug,$submenu[$this->global_slug][0]))!=false) {
			unset($submenu[$this->global_slug][0]);
		}
}
	function tld_page(){

	}
	function options_do_page() {
?>
	<div class="wrap">
	<?php if( isset($_GET['settings-updated']) ) { ?>
    <div id="message" class="updated">
        <p><strong><?php _e('Settings saved.') ?></strong></p>
    </div>
	<?php } ?>

		<div class="updated settings-error">
		</p>
		<strong>Do more with Social Media: &nbsp;&nbsp;&nbsp;<a href="http://b0e48wu1-gmc2tae-3j1k1k74y.hop.clickbank.net/">Check Hyper Facebook Traffic. It will greatly help your social media presence And ultimately increase your traffic.</a><br><a href="http://b0e48wu1-gmc2tae-3j1k1k74y.hop.clickbank.net/"><img src="http://arevico.com/ad/banner.php" style="border-style: none;"></a></strong>
		</p>
		</div>


	<h2>Options</h2>

		<form method="post" action="options.php" id="fl">
		<?php settings_fields($this->option_group); ?>
		<?php $options=$this->getOption(); ?>

		<div class="tabber">
	    <div class="tabbertab">
	  <h2>General Options</h2>
				<table class="form-table">
				<tr valign="top"><th scope="row">Facebook Fan Page Numeric ID: <sup><a href="http://arevico.com/retrieving-the-facebook-fanpage-id/">(?)</a></sup></th>
					<td><input type="text" name="<?php echo($this->option_name); ?>[fb_id]" value="<?php echo $options['fb_id']; ?>" /></td>
					</td>
				</tr>
				<tr valign="top"><th scope="row">Show on:</th>
					<td>
					<input name="<?php echo($this->option_name); ?>[display_on_page]" type="checkbox" value="1" <?php checked('1', $options['display_on_page']); ?> /> On Page &nbsp;&nbsp;&nbsp;&nbsp;
					<input name="<?php echo($this->option_name); ?>[display_on_post]" type="checkbox" value="1" <?php checked('1', $options['display_on_post']); ?> /> On Post &nbsp;&nbsp;&nbsp;&nbsp;
					<input name="<?php echo($this->option_name); ?>[display_on_homepage]" type="checkbox" value="1" <?php checked('1', $options['display_on_homepage']); ?> /> On HomePage &nbsp;&nbsp;&nbsp;&nbsp;

					</td>
				</tr>
				<tr valign="top"><th scope="row">Show Once Every x days (0 = on each pageload):</th>
					<td><input type="text" name="<?php echo($this->option_name); ?>[show_once]" value="<?php echo $options['show_once']; ?>" /></td>
				</tr>

				<tr valign="top"><th scope="row">Delay (miliseconds):</th>
					<td><input type="text" name="<?php echo($this->option_name); ?>[delay]" value="<?php echo $options['delay']; ?>" /></td>
				</tr>

				<tr valign="top"><th scope="row">Disable Fancybox Load (when already being loaded)</th>
					<td>
					<input name="<?php echo($this->option_name); ?>[fancybox]" type="checkbox" value="1" <?php checked('1', $options['fancybox']); ?> />
					</td>
				</tr>

			</table>
     </div>
</div>


		<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />

			</p>

		</form>
	</div>
	<?php
}

function options_val($input) {
	return $input;
}

}
?>