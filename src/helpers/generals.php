<?php

    
    
    /**
     * Safe load variables from an file
     * Use this function to not include files directly and to not give access to current context variables (like $this)
     *
     * @param string $file_path
     * @param array $_extract_variables Extract these from file array('variable_name' => 'default_value')
     * @param array $_set_variables Set these to be available in file (like variables in view)
     *
     * @return array
     */

    function qs_paddle_intregration_get_variables_from_file( $file_path, array $_extract_variables, array $_set_variables = array() ) {
        extract( $_set_variables, EXTR_REFS );
        unset( $_set_variables );

        require $file_path;

        foreach ( $_extract_variables as $variable_name => $default_value ) {
            if ( isset( $$variable_name ) ) {
                $_extract_variables[ $variable_name ] = $$variable_name;
            }
        }

        return $_extract_variables;
    }

    /**
	 * Safe render a view and return html
	 * In view will be accessible only passed variables
	 * Use this function to not include files directly and to not give access to current context variables (like $this)
	 *
	 * @param string $file_path
	 * @param array $view_variables
	 * @param bool $return In some cases, for memory saving reasons, you can disable the use of output buffering
	 *
	 * @return string HTML
	 */

	function qs_paddle_intregration_render_view( $file_path, $view_variables = array(), $return = true ) {

		if ( ! is_file( $file_path ) ) {
			return '';
		}

		extract( $view_variables, EXTR_REFS );
		unset( $view_variables );

		if ( $return ) {
			ob_start();
			require $file_path;

			return ob_get_clean();
		} else {
			require $file_path;
		}

		return '';
    }
    
     /**
     * Generate html tag
     *
     * @param string $tag Tag name
     * @param array $attr Tag attributes
     * @param bool|string $end Append closing tag. Also accepts body content
     *
     * @return string The tag's html
     */

    function qs_paddle_intregration_html_tag( $tag, $attr = array(), $end = false ) {
        $html = '<' . $tag . ' ' . qs_paddle_intregration_attr_to_html( $attr );

        if ( $end === true ) {
            # <script></script>
            $html .= '></' . $tag . '>';
        } else if ( $end === false ) {
            # <br/>
            $html .= '/>';
        } else {
            # <div>content</div>
            $html .= '>' . $end . '</' . $tag . '>';
        }
        
        return $html;
    }

    /**
     * Convert to Unix style directory separators
     *  @param string $path url
     */
    function qs_paddle_intregration_fix_path( $path ) {

        $windows_network_path = isset( $_SERVER['windir'] ) && in_array( substr( $path, 0, 2 ),
                array( '//', '\\\\' ),
                true );
        $fixed_path           = untrailingslashit( str_replace( array( '//', '\\' ), array( '/', '/' ), $path ) );

        if ( empty( $fixed_path ) && ! empty( $path ) ) {
            $fixed_path = '/';
        }

        if ( $windows_network_path ) {
            $fixed_path = '//' . ltrim( $fixed_path, '/' );
        }

        return $fixed_path;
    }

    
    /**
     * Strip slashes from values, and from keys if magic_quotes_gpc = On
     */
    function qs_paddle_intregration_stripslashes_deep_keys( $value ) {
        static $magic_quotes = null;
        if ( $magic_quotes === null ) {
            $magic_quotes = false; //https://www.php.net/manual/en/function.get-magic-quotes-gpc.php - always returns FALSE as of PHP 5.4.0. false fixes https://github.com/ThemeFuse/Unyson/issues/3915
        }

        if ( is_array( $value ) ) {
            if ( $magic_quotes ) {
                $new_value = array();
                foreach ( $value as $key => $val ) {
                    $new_value[ is_string( $key ) ? stripslashes( $key ) : $key ] = qs_paddle_intregration_stripslashes_deep_keys( $val );
                }
                $value = $new_value;
                unset( $new_value );
            } else {
                $value = array_map( 'qs_paddle_intregration_stripslashes_deep_keys', $value );
            }
        } elseif ( is_object( $value ) ) {
            $vars = get_object_vars( $value );
            foreach ( $vars as $key => $data ) {
                $value->{$key} = qs_paddle_intregration_stripslashes_deep_keys( $data );
            }
        } elseif ( is_string( $value ) ) {
            $value = stripslashes( $value );
        }

        return $value;
    }

    if(!function_exists('qs_paddle_intregration_heading_camelize')){
        function qs_paddle_intregration_heading_camelize($input, $separator = '_')
        {
            return strtolower(str_replace($separator, '', ucwords($input, $separator)));
        }
    }

    if(!function_exists('qs_paddle_intregration_load_wc')){
        
        function qs_paddle_intregration_load_wc(){
            
            include_once WC_ABSPATH . 'includes/wc-cart-functions.php';
            include_once WC_ABSPATH . 'includes/class-wc-cart.php';
            if ( is_null( WC()->cart ) ) {
                wc_load_cart();
            }
        }
    } 

    /**
     * Add slashes to values, and to keys if magic_quotes_gpc = On
     */
    function qs_paddle_intregration_addslashes_deep_keys( $value ) {
        static $magic_quotes = null;
        if ( $magic_quotes === null ) {
            $magic_quotes = get_magic_quotes_gpc();
        }

        if ( is_array( $value ) ) {
            if ( $magic_quotes ) {
                $new_value = array();
                foreach ( $value as $key => $value ) {
                    $new_value[ is_string( $key ) ? addslashes( $key ) : $key ] = qs_paddle_intregration_addslashes_deep_keys( $value );
                }
                $value = $new_value;
                unset( $new_value );
            } else {
                $value = array_map( 'qs_paddle_intregration_addslashes_deep_keys', $value );
            }
        } elseif ( is_object( $value ) ) {
            $vars = get_object_vars( $value );
            foreach ( $vars as $key => $data ) {
                $value->{$key} = qs_paddle_intregration_addslashes_deep_keys( $data );
            }
        } elseif ( is_string( $value ) ) {
            $value = addslashes( $value );
        }

        return $value;
    }

    /**
     * Use this id do not want to enter every time same last two parameters
     * Info: Cannot use default parameters because in php 5.2 encoding is not UTF-8 by default
     *
     * @param string $string
     *
     * @return string
     */
    function qs_paddle_intregration_htmlspecialchars( $string ) {
        return htmlspecialchars( $string, ENT_QUOTES, 'UTF-8' );
    }

    /**
     * Generate attributes string for html tag
     *
     * @param array $attr_array array('href' => '/', 'title' => 'Test')
     *
     * @return string 'href="/" title="Test"'
     */
    function qs_paddle_intregration_attr_to_html( array $attr_array ) {
        $html_attr = '';

        foreach ( $attr_array as $attr_name => $attr_val ) {
            if ( $attr_val === false ) {
                continue;
            }

            $html_attr .= $attr_name . '="' . qs_paddle_intregration_htmlspecialchars( $attr_val ) . '" ';
        }

        return $html_attr;
    }

     /**
     * Generate attributes string for shortcode tag
     *
     * @param array $attr_array array('col' => '3', 'title' => 'Test')
     *	$att = [
	 *		'column' => '3',
	 *		'ids' => [12,344,44]
	 *	];
	 *	$array = qs_paddle_intregration_attr_to_shortcode($att);
     */
    function qs_paddle_intregration_attr_to_shortcode( array $attr_array ) {
        $shortcode_attr = '';

        foreach ( $attr_array as $attr_name => $attr_val ) {

            if ( $attr_val === false ) {
                continue;
            }
            
            if(is_array( $attr_val) ){
                $shortcode_attr .= $attr_name . '="' .  qs_paddle_intregration_convert_arr($attr_val)  . '" ';
            }else{
                $shortcode_attr .= $attr_name . '="' .  sanitize_text_field($attr_val)  . '" ';
            }
           
        }

        return $shortcode_attr;
    }
    /**
     * Generate attributes string for shortcode tag
     * nested array not allowed
     * @param array $attr_array array('products','Test')
     *
     */
    if(!function_exists('qs_paddle_intregration_convert_arr')){

        function qs_paddle_intregration_convert_arr($attr){

            $return_arr = '[';  
            $store_value = '';
     
            foreach($attr as $value){
     
                if(!is_array($value)){
                 $store_value .= $value.',';   
                }
            
            }
     
            $store_value = trim($store_value,',');
            $return_arr .= $store_value.']';
     
            return $return_arr;
         }
    }
  

    /**
     * Download file from remote
     *
     * @param string $url 
     *
     * @return string $destination path
     */

    if(!function_exists('qs_paddle_intregration_download_file')){
        
        function qs_paddle_intregration_download_file($url, $destination) {
            echo 'downloading ' . $destination . "\n";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt( $ch, CURLOPT_ENCODING, "UTF-8" );
        
            $data = curl_exec ($ch);
            $error = curl_error($ch);
        
            curl_close ($ch);
        
            $file = fopen($destination, "w+");
            fputs($file, $data);
            fclose($file);
        }
    }

  
    
  

   

    /* 
    * Admin Dashboard Notice plugin check
    * @since 1.0
    * parameter plugin path
    * @return url string
    */
    
    function qs_paddle_intregration_plugin_activation_link_url( $plugin='woocommerce/woocommerce.php' )
	{
		// the plugin might be located in the plugin folder directly

		$activateUrl = sprintf(admin_url('plugins.php?action=activate&plugin=%s&plugin_status=all&paged=1&s'), $plugin);

		// change the plugin request to the plugin to pass the nonce check
		$_REQUEST['plugin'] = $plugin;
		$activateUrl = wp_nonce_url($activateUrl, 'activate-plugin_' . $plugin);

		return $activateUrl;
	}

    if( !function_exists('qs_paddle_intregration_get_current_user_role') ){

        function qs_paddle_intregration_get_current_user_role() {
	
            if( is_user_logged_in() ) { // check if there is a logged in user 
                
                $user = wp_get_current_user(); // getting & setting the current user 
                $roles = ( array ) $user->roles; // obtaining the role 
                   return $roles; // return the role for the current user 
                } else {
                   return array(); // if there is no logged in user return empty array  
            }
        }

    }

 

    function qs_paddle_intregration_get_transform_options($options = [], $key = false){

        if( !is_array($options) || $key == false ){
            return $options;
        }

        $db_option      = get_option( $key );
       
        $return_options = $options;

        foreach( $options as $key => $value ){

            if( isset($db_option[$key]) ){
                $return_options[$key]['default'] = 1; 
            }else{
                $return_options[$key]['default'] = 0;    
            }  
        
        }

        return $return_options; 
    }
    
    /*
    * Config File Write 
    * Param2 array config
    * param1 string  file path
    * @since 1.0
    * @qumodosoft
    */
    function qs_paddle_intregration_core_config_file_write( $file_path , $content_array ){
      
        global $wp_filesystem;

        $errors = new \WP_Error();

        if ( !is_array( $content_array ) ){

            $errors->add(1,esc_html__('Content should be array'));
        }

        if ( !file_exists( $file_path ) ){
            $errors->add(2,esc_html__('File Path should be valid'));
        }

        if ( $errors->get_error_code() ){
          
            return $errors; 
        }

        if ( empty( $wp_filesystem ) ) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        $data          = var_export( $content_array, 1 );
        $file_contents = "<?php\n return $data; ";
         
        if ( ! $wp_filesystem->put_contents( $file_path, $file_contents , FS_CHMOD_FILE ) ){
            $errors->add(503,esc_html__('File can not write'));
            return $errors;
        }

        return true;
     
    }

    
    if( !function_exists('qs_paddle_intregration_wc_is_endpoint') ){
 
        /**
         * WooCommerce Notice Shortcode
         * WC Endpont Validation
         * @param endpoint_name string
         * @return bool
         */
        function qs_paddle_intregration_wc_is_endpoint($endpoint_name){

            if ( is_wc_endpoint_url() && ( $endpoint_name == WC()->query->get_current_endpoint() ) ) { 
               return true;
            } 

            return true;
        }
    }

    
    if( !function_exists('qs_paddle_intregration_wc_get_current_endpoint') ){

        /**
         * WC Endpont Validation
         * @param endpoint_name string
         */
        function qs_paddle_intregration_wc_get_current_endpoint(){

           return WC()->query->get_current_endpoint();
        }
    }

    if( !function_exists('qs_paddle_intregration_is_checkout_endpoint') ){

        /**
         * WC Checkout Endpont Validation
         * @return bool
         */
        function qs_paddle_intregration_is_checkout_endpoint() {
            return is_wc_endpoint_url( 'order-pay' ) || is_wc_endpoint_url( 'order-received' );
        }
    }

    if( !function_exists( 'qs_paddle_intregration_locate_tpl' ) ){

        /**
         * Locate template.
         *
         * Locate the called template.
         * Search Order:
         * 1. /themes/theme/woo-ready/$template_name
         * 2. /templates/$template_name.
         * @param   string  $template_name          Template to load.
         * @param   string  $string $template_path  Path to templates.
         * @param   string  $default_path           Default path to template files.
         * @return  string                          Path to the template file.
         */
        function qs_paddle_intregration_locate_tpl( $template_name, $template_path = '', $default_path = '' ) {

            
            if ( ! $template_path ) :
                $template_path = 'woo-ready/';
            endif;
        
        
            if ( ! $default_path ) :
            $default_path = QS_PADDLE_INTEGRATION_DIR_PATH . 'templates/'; 
            endif;
        
            
            $template = locate_template( array(
            $template_path . $template_name,
            $template_name
            ) );
        
        
            if ( ! $template ) :
            $template = $default_path . $template_name;
            endif;
        
            return apply_filters( 'qs_paddle_intregration_locate_tpl', $template, $template_name, $template_path, $default_path );
        
        }
    }
    
    if( !function_exists( 'qs_paddle_intregration_get_template' ) ){

        /**
         * Search for the template and include the file.
         * @param string  $template_name          Template to load.
         * @param array   $args                   Args passed for the template file.
         * @param string  $string $template_path  Path to templates.
         * @param string  $default_path           Default path to template files.
         */
        function qs_paddle_intregration_get_template( $template_name, $args = array(), $tempate_path = '', $default_path = '' ) {

        if ( is_array( $args ) && isset( $args ) ) :
            extract( $args );
        endif;
    
        $template_file = qs_paddle_intregration_locate_tpl( $template_name, $tempate_path, $default_path );
    
        if ( ! file_exists( $template_file ) ) :
            _doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
        return;
        endif;
    
        include $template_file;
    
        }
    }
    
  

    
    if( !function_exists( 'qs_paddle_intregration_html_tags_options' ) ){
        function qs_paddle_intregration_html_tags_options(){
        
            return apply_filters( 'qs_paddle_intregration_html_tags_options', [

                'h1'     => 'H1',
                'h2'     => 'H2',
                'h3'     => 'H3',
                'h4'     => 'H4',
                'h5'     => 'H5',
                'h6'     => 'H6',
                'div'    => 'DIV',
                'p'      => 'p',
                'span'   => 'span',
                'b'      => 'span',
                'b'      => 'B',
                'strong' => 'Strong',
                'pre'    => 'Strong',
         
            ] );
        }
    }

  
    if( !function_exists( 'qs_paddle_intregration_get_latest_products_id' ) ){

        /**
        * Get WooCommerce Latest Product
        * @arg $count default 1
        * @return array
        */ 
        function qs_paddle_intregration_get_latest_products_id($count = 1){

            $key = 'wready_get_latest_products_id_'.$count;
    
            $product_object = wp_cache_get( $key );
            if ( false === $product_object ) {
                $args = array(
                    'post_type'   => 'product',
                    'stock'       => 1,
                    'numberposts' => $count,
                    'orderby'     => 'date',
                    'order'       => 'DESC',
                    
                );
                
                $products = get_posts($args);
                
                foreach($products as $product){
                    $product_object[$product->ID] = $product->post_title;
                }
               
               
                wp_cache_set( $key , $product_object );
            } 

          
            return $product_object;
    
        }

    }

    if( !function_exists( 'qs_paddle_intregration_get_single_product_key' ) ){
        /**
         * Usagte in elementor control
         * @return string product id 
         */
        function qs_paddle_intregration_get_single_product_key(){

            $product_object = qs_paddle_intregration_get_latest_products_id(1); 
            if(!is_array($product_object)){
                return '';
            }
          
            return key($product_object);
        }
    }
    if( !function_exists( 'qs_paddle_intregration_get_page_list' ) ){

        function qs_paddle_intregration_get_page_list(){

           static $return_pages = [];

           if( empty($return_pages) ){

                $pages = get_pages(
                    array (
                        'parent'  => 0,
                    )
                );
            
                foreach($pages as $item){
                   
                    $return_pages[$item->ID] = $item->post_name;
                }
           }
           return $return_pages;
           
        }
    }



    if(!function_exists('qs_paddle_intregration_get_dashboard_url')){
        /**
         * Dashboard page url
         * @param page slug
         * @return url string
         */
        function qs_paddle_intregration_get_dashboard_url($slug = null){

            if(is_null($slug)){
                
                return admin_url('admin.php?page='.QS_PADDLE_INTEGRATION_SETTING_PATH);
            }

            return admin_url('admin.php?page='.$slug);
        }
    }


    /**
     * Get all elementor page templates
     *
     * @param  null  $type
     *
     * @return array
     */
    if(!function_exists('qs_paddle_intregration_get_elementor_templates')){
        function qs_paddle_intregration_get_elementor_templates($type = null){
            $options = [];

            if ($type) {
                $args = [
                    'post_type' => 'elementor_library',
                    'posts_per_page' => -1,
                ];
                $args['tax_query'] = [
                    [
                        'taxonomy' => 'elementor_library_type',
                        'field' => 'slug',
                        'terms' => $type,
                    ],
                ];

                $page_templates = get_posts($args);

                if (!empty($page_templates) && !is_wp_error($page_templates)) {
                    foreach ($page_templates as $post) {
                        $options[$post->ID] = $post->post_title;
                    }
                }
            } else {
                $options = qs_paddle_intregration_get_query_post_list('elementor_library');
            }

            return $options;
        }
    }


    if(!function_exists('qs_paddle_intregration_get_query_post_list')){

        function qs_paddle_intregration_get_query_post_list($post_type = 'any', $limit = -1, $search = ''){
            global $wpdb;
            $where = '';
            $data = [];

            if (-1 == $limit) {
                $limit = '';
            } elseif (0 == $limit) {
                $limit = "limit 0,1";
            } else {
                $limit = $wpdb->prepare(" limit 0,%d", esc_sql($limit));
            }

            if ('any' === $post_type) {
                $in_search_post_types = get_post_types(['exclude_from_search' => false]);
                if (empty($in_search_post_types)) {
                    $where .= ' AND 1=0 ';
                } else {
                    $where .= " AND {$wpdb->posts}.post_type IN ('" . join("', '",
                        array_map('esc_sql', $in_search_post_types)) . "')";
                }
            } elseif (!empty($post_type)) {
                $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_type = %s", esc_sql($post_type));
            }

            if (!empty($search)) {
                $where .= $wpdb->prepare(" AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql($search) . '%');
            }

            $query = "select post_title,ID  from $wpdb->posts where post_status = 'publish' $where $limit";
            $results = $wpdb->get_results($query);
            if (!empty($results)) {
                foreach ($results as $row) {
                    $data[$row->ID] = $row->post_title;
                }
            }
            return $data;
        }
        
    }
  
    
    if(!function_exists('qs_paddle_intregration_get_product_category_name_from_id')){

        function qs_paddle_intregration_get_product_category_name_from_id( $category_id ) {
            $term = get_term_by( 'id', $category_id, 'product_cat', 'ARRAY_A' );
            return $term['name'];
        }

    }

    
   

  
  
   
   

   

   
 

   

   
  
  
  



