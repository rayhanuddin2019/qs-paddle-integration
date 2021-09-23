<?php

    /**************************** ***********
    * Qs Paddle Integration Elementor Plugin
    *
    * Elementor related function 
    * @since 1.0
    * @author Quomodosoft
    *
    ************** **************************/

    /**
    * optional parameter
    * Category name
    * return array element templates
    * @since 1.0
    */
    if( !function_exists('qs_paddle_intregration_get_elementor_saved_templates') ){

        function qs_paddle_intregration_get_elementor_saved_templates( $category = false ){

            static $_template_kits = null;
    
            if(is_null($_template_kits)) {
    
                $args = array(
                    'numberposts' => -1,
                    'post_type'   => 'elementor_library',
                    'post_status' => 'publish',
                    'orderby'     => 'title',
                    'order'       => 'ASC',
                );
                
                if($category){
    
                    $args['tax_query'][] =  array(
                        'taxonomy' => 'elementor_library_category',
                        'field'    => 'slug',
                        'terms'    => $category
                    ); 
    
                }
    
            $_template_kits = get_posts( $args ); 
            }
            
            return $_template_kits;
        }
    }

    
    /**
    * use in elementor widget
    * return array
    * @author quomodsoft.com
    */
    if( !function_exists('qs_paddle_intregration_get_elementor_templates_arr') ){

        function qs_paddle_intregration_get_elementor_templates_arr(){
        
            static $_template_kits = null;
    
            if( is_null( $_template_kits ) ){
                $_template_kits[''] = esc_html__('Select Template','qs-paddle-integration');
               $temp = qs_paddle_intregration_get_elementor_saved_templates();
    
               if(is_array($temp)){
                    foreach($temp as $item){
                        $_template_kits[$item->ID] = $item->post_name. ' - '.$item->ID;
                    }
               } 
         
            }
    
            return $_template_kits;
        }

    }
 

    /**
     * Helper function to return a setting.
     *
     * Saves 2 lines to get kit, then get setting. Also caches the kit and setting.
     * @since 1.0
     * @author quomodsoft.com
     * @param  string $setting_id
     * Plugin::$instance->kits_manager->get_active_kit_for_frontend()->get_settings_for_display('wr_login_redirect');
     * @return string|array same as the Elementor internal function does.
     */
    if( ! function_exists('qs_paddle_intregration_gl_get_setting') ){

        function qs_paddle_intregration_gl_get_setting( $setting_id, $default = '' ) {
            
            if(! did_action( 'elementor/loaded' )){
                return;
            }

            global $woo_ready_el_global_settings;
    
            $return = $default;
    
            if ( ! isset( $woo_ready_el_global_settings['kit_settings'] ) ) {
                $kit =  \Elementor\Plugin::$instance->documents->get( \Elementor\Plugin::$instance->kits_manager->get_active_id(), false );
                $woo_ready_el_global_settings['kit_settings'] = $kit->get_settings();
            }
    
            if ( isset( $woo_ready_el_global_settings['kit_settings'][ $setting_id ] ) ) {
                $return = $woo_ready_el_global_settings['kit_settings'][ $setting_id ];
            }
           
            return apply_filters( 'qs_paddle_intregration_el_global_' . $setting_id, $return );
        }

    }

    /**
     * Helper function to show/hide elements
     *
     * This works with switches control, if the setting ID that has been passed is toggled on, we'll return show, otherwise we'll return hide
     *
     * @param  string $setting_id
     * @return string|array same as the Elementor internal function does.
     */
    if( !function_exists('qs_paddle_intregration_show_or_hide') ){
        function qs_paddle_intregration_show_or_hide( $setting_id ) {
            return ( 'yes' === qs_paddle_intregration_gl_get_setting( $setting_id ) ? 'wr-show' : 'wr-hide' );
        }
    }
      
    if( !function_exists( 'qs_paddle_intregration_get_page_meta' ) ){

        function qs_paddle_intregration_get_page_meta( $key, $page_id = null ){
         
            try {

                    $id = get_the_ID();
                    if( is_numeric( $page_id ) ){
                        $id = $page_id;
                    } 
        
                    $current_doc = \Elementor\Plugin::instance()->documents->get( $id );
                    if($current_doc){
                      return $current_doc->get_settings( $key );
                    }
           

            } catch (\Exception $e) {
                return false;
            }

            return false;
        }

    }
  
    
    if( !function_exists('qs_paddle_intregration_is_elementor_mode') ){
        /**
         * Elementor Editor And Preview Mode Check
         * @since 1.0
         */
        function qs_paddle_intregration_is_elementor_mode(){

            if(\Elementor\Plugin::$instance->editor->is_edit_mode() ){ return true; }
            if(isset($_GET['preview_id']) && isset($_GET['preview']) && $_GET['preview_nonce']){
                return true;
            }
        }
    }

        
    if( !function_exists( 'qs_paddle_intregration_render_icons' ) ){
        
        function qs_paddle_intregration_render_icons( $content = array(), $class = '' ){

            if ( !is_array( $content ) ) {
                return false;
            }
              //elementor-icons-fa-

            if ( is_array( $content['value'] ) ) {
                $svg_icon = $content['value']['url'];
            }else{
                $font_icon = $content['value'];
            }
        
            if( !is_array( $content['value'] ) && $font_icon ){
                
                wp_enqueue_style('elementor-icons-'.$content['library']);
               
                if($class){
                    return '<i class="'.$class.' '.esc_attr( $font_icon ).'"></i>';
                }else{
                    return '<i class="'.esc_attr( $font_icon ).'"></i>';
                }
            }
        
            if ( $content['library'] == 'svg' ) {
                try{
                    $url_basename = basename( $svg_icon ); 
                    $svg_ext      = explode( '.',$url_basename )[1];
        
                    $svg_file     = wp_remote_get( $svg_icon );
                    $svg_file     = wp_remote_retrieve_body($svg_file );
                    $find_string  = '<svg';
                    $position     = strpos( $svg_file, $find_string );
                    $svg_file_new = substr( $svg_file, $position );
                    return $svg_file_new;
                }catch(\Exception $e) {
                    return false;
                }
            }
        }
    }

    
    if(!function_exists('qs_paddle_intregration_get_active_breakpoint')){

        function qs_paddle_intregration_get_active_breakpoint(){

                   $breakpoints       = \Elementor\Plugin::$instance->breakpoints->get_breakpoints();
            static $active_braekpoint = [];
        
            if( empty( $active_braekpoint ) ){

                foreach($breakpoints as $key => $brk){
                    
                    if($brk->is_enabled()){
                        $active_braekpoint[$key] = $brk;
                    }
                    
                }
            }

            return $active_braekpoint;
            
        }
    } 

    if ( !function_exists( 'qs_paddle_intregration_widgets_class_dir_list' ) ):

        function qs_paddle_intregration_widgets_class_dir_list( $dir ) {
    
            $classes     = [];
            $classes_dir = [];
    
            $finder = new \Symfony\Component\Finder\Finder();
            $finder->directories()->in( $dir )->depth( '== 0' );
            $found_dir = [];
    
            foreach ( $finder as $_dir ) {
    
                $finder_file = new \Symfony\Component\Finder\Finder();
                $finder_file->files()->in( $dir . '/' . basename( $_dir->getRealPath() ) )->contains( 'namespace' );
    
                foreach ( $finder_file as $__file ) {
    
                    $filePath                                      = $__file->getRealPath();
                    $classes_dir[basename( $_dir->getRealPath() )][] = strtok( basename( $filePath ), '.' );
                }
    
            }
    
            return $classes_dir;
        }
    
    endif;

    if ( !function_exists( 'qs_paddle_intregration_widgets_class_list' ) ):

        function qs_paddle_intregration_widgets_class_list( $dir ) {

            $classes = [];

            $finder = new \Symfony\Component\Finder\Finder();
            $finder->directories()->in( $dir )->depth( '== 1' );
            $finder->files()->in( $dir );
            $finder->files()->contains( 'namespace' );

            foreach ( $finder as $file ) {

                $absoluteFilePath = $file->getRealPath();
                if ( !is_null( basename( $absoluteFilePath ) ) ) {
                    $classes[] = strtok( basename( $absoluteFilePath ), '.' );
                }

            }

            return $classes;

        }

    endif;
    
    
   

  



    
   
    
   
   
 
    

