<?php 
    /*
    Plugin Name: Soap Calculator
    Description: Plugin for Managing Content for Soap Calculation
    Author: Himanshu
    Version: 1.0
    Author URI: http://www.skyzoneinfotech.com
    */

function soap_calc_manager() {
    echo include('soap_calc_manager.php');
}

function soap_calc_admin_actions() {
    add_menu_page("Soap Calaculator", "Soap Calaculator", 1, "soap_calc_manager", "soap_calc_manager");
    add_submenu_page('soap_calc_manager', 'Settings', 'Settings', 1, "soap_calc_manager", "soap_calc_manager");
}

function soap_calc_api() {
    include_once('soap_calc_api.php');
    $soapObject = new SoapCalcApi();
    $content = $soapObject->getSoapData("front");
    return $content;        
}

//function update_coin()
//{
//    $data = $_POST['params'];
//    include_once('coin_market_api.php');
//    $cryptoObject = new CoinMarketCapApi();
//    $content = $cryptoObject->updateCoin($data);
//    return $content;
//}

function soap_calc_load_scripts($hook) {

    // create my own version codes
    $coin_market_js_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'assets/js/soap-calc-admin.js' ));
    $coin_market_css_ver = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'assets/css/soap-calc-admin.css' ));
     
    wp_register_script( 'soap_calc_js', plugins_url( 'assets/js/soap-calc-admin.js', __FILE__ ), array(), $coin_market_js_ver );
    wp_enqueue_script('soap_calc_js');
    wp_register_style( 'coin_market_css',    plugins_url( 'assets/css/soap-calc-admin.css',    __FILE__ ), false,   $coin_market_css_ver );
    wp_enqueue_style ( 'soap_calc_css' );
}

add_action('admin_enqueue_scripts', 'soap_calc_load_scripts');

add_action('admin_menu', 'soap_calc_admin_actions');

add_action( 'wp_ajax_update_coin', 'update_coin');
?>