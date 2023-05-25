<?php
/** * Plugin Name: JCCB WP_CONTACT V1
 * Plugin URI: https://jccbweb.com/
 * Description: WP LIST TABLE CONTACT
 * Version: 0.1
 * Author: JCC
 * Author URI: https://jccbweb.com/
 **/

defined( 'ABSPATH' ) or die( 'Hey, what are you doing here? You silly human!' );


 


if ( !class_exists( 'JccbwebContacts' ) ) {

   
    class JccbwebContacts extends 
    {

        public $plugin;

        function __construct()
        {
            $this->plugin = plugin_basename(__FILE__);
        }

        function register()
        {
            // add scripts
            add_action('admin_enqueue_scripts', array($this, 'enqueue'));
           // admin main manu
            add_action('admin_menu', array($this, 'add_admin_pages'));
            // add submenu
            //add_action('admin_sub_menu', array($this, 'submenu_pages'));
            // filter Link
            add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
        }

        public function settings_link($links)
        {
            $settings_link = '<a href="admin.php?page=jccbweb_plugin">Settings</a>';
            array_push($links, $settings_link);
            return $links;
        }




        protected function create_post_type()
        {
            add_action('init', array($this, 'custom_post_type'));
        }

        function custom_post_type()
        {
            register_post_type('book', ['public' => true, 'label' => 'Books']);
        }

        function enqueue()
        {
            // enqueue all our scripts
            wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
            wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js', __FILE__));
        }

        function activate()
        {
            require_once plugin_dir_path(__FILE__) . 'inc/jccbweb-contacts-activate.php';
            JccbwebActivate::activate();
        }

        function deactivate()
        {
            require_once plugin_dir_path(__FILE__) . 'inc/jccbweb-contacts-deactivate.php';
            JccbwebDeactivate::deactivate();
        }

        public function add_admin_pages()
        {
            add_menu_page('JCCBWeb Plugin','Vegan Contact ','manage_options','jccbweb_plugin', array($this, 'admin_index'),'dashicons-store',70 );
            add_submenu_page('jccbweb_plugin','JCCBWeb Plugin','Add Contact','manage_options','jccb-plugin-submenu',array($this, 'admin_submenu') );
        }

        public function admin_submenu(){
            echo "Show sub menu plugin";
        }

        public function admin_index()
        {    
            echo "show index plugin";
        }

        // here are all the functions for the wp_list_table

        function prepar_items(){
            echo "prepare items";
        }











    }

    $jccbweb = new JccbwebContacts();
    $jccbweb->register();

    // activation
    register_activation_hook(__FILE__, array($jccbweb, 'activate'));
 
}

