<?php
/*
Plugin Name: Listings for Reverb.com
Plugin URI: https://wordpress.org/plugins/listings-for-reverb
Version: 1.0.0
Description: Embed Reverb.com listings and search bar on Wordpress
Author: James Low, Gear Tube
Author URI: http://www.geartube.net
*/

class ReverbPlugin {
	function addHooks() {
		add_action('admin_menu', array(ReverbPlugin, 'adminMenu'));
		add_action('wp_enqueue_scripts', array(ReverbPlugin, 'loadScripts'));
		add_shortcode('reverb-listings', array(ReverbPlugin, 'listingsShortcode'));
		add_shortcode('reverb-search', array(ReverbPlugin, 'searchShortcode'));
	}
	function adminMenu() {
		add_options_page('Reverb.com Settings', 'Reverb.com', 'edit_posts', 'reverb-settings', array(ReverbPlugin, 'optionsPage'));
	}
	function optionsPage() {
	
	}
	function loadScripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_script('reverb-dot-com-js', plugins_url(null,__FILE__).'/reverb.js');
		wp_enqueue_style('reverb-dot-com-css', plugins_url(null,__FILE__).'/reverb.css');
	}
	function listingsShortcode($atts) {
		$a = shortcode_atts(array(
			'embed' => 'listings', //affiliate, listings, handpicked
			'aid' => 'geartube',
			'currency' => 'USD',
			'search-shop' => '', //cme
			'search-per-page' => '25',
			'search-product-type' => '',
			'price-max' => '',
			'price-min' => '',
			'year-max' => '',
			'year-min' => '',
			'make' => '',
			'mode' => '',
			'collection-name' => ''
		), $atts);
		$result = '<div data-reverb-embed-'.$a['embed'];
		foreach ($a as $key => $value) {
			$value = trim($value);
			if ($value != null && $value != '' && $key != 'embed') {
				$result .= ' data-reverb-'.$key.'="'.$value.'"';
			}
		}
		
		$result .= '></div>';
		return $result;
	}
	function searchShortcode($atts) {
		$a = shortcode_atts(array(
			'model' => '',
			'aid' => 'geartube',
		));
		$model = trim($a['model']);
			return '<form action="https://reverb.com">
	<input type="hidden" name="_aid" value="'.$a['aid'].'">'.($model != null && $model != '' ? '
	<input type="hidden" name="model" value="'.$model.'">' : '').'
	<input name="query" style="font-size: 1.10em; border: 1px solid #d2d2d2; background-color: #f2f2f0; padding: 0.42857rem 0.85714rem; -webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px; width: 400px;" placeholder="Find Gear on Reverb">
	<input type="image" alt="Submit Search" src="http://i.imgur.com/Xqd1zPL.png?1" style="height: 32px; margin-bottom: -10px">
</form>';
	}
}

ReverbPlugin::addHooks();