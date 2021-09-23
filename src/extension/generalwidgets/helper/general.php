<?php

/**
 * get widgets class list
 *
 * @since 1.0
 * @return array
 */


if(!function_exists( 'qs_paddle_intregration_get_paddle_products' )){

    function qs_paddle_intregration_get_paddle_products(){

        if ( false === ( $qs_paddle_integration_products_results = get_transient( 'qs_paddle_integration_products_results' ) ) ) {
            
                $url        = "https://vendors.paddle.com/api/2.0/product/get_products";
                $data       = qs_paddle_intregration_api_config()->all();
                $data_pluck = wp_list_pluck($data,'default');
            
                $refined_data = [
                    'vendor_id' => '',
                    'vendor_auth_code' => '',
                ];

                if(isset($data_pluck['vendor_id'])){
                    $refined_data['vendor_id'] = trim($data_pluck['vendor_id']);
                }

                if(isset($data_pluck['vendor_auth_code'])){
                    $refined_data['vendor_auth_code'] = trim($data_pluck['vendor_auth_code']);
                }
                
                $query_url = $url.'?'.http_build_query($refined_data);

                $response = wp_remote_get($query_url);

                if ( is_array( $response ) && ! is_wp_error( $response ) ) {

                    $headers                                = $response['headers'];  // array of http header lines
                    $qs_paddle_integration_products_results = $response['body'];     // use the content
                    set_transient( 'special_query_results', $qs_paddle_integration_products_results, 30 * MINUTE_IN_SECONDS );
            
                }
         
           }
           
           $options = [];  
           
           $data = json_decode($qs_paddle_integration_products_results);
           if(!isset($data->response)){
             return $options; 
           }
           $response = $data->response;
          
           if(isset($response->products)){
                foreach($response->products as $item){
                    $options[$item->id] = $item->name;
                }
           }
           
           return  $options;
           
    }
}


if( !function_exists('qs_paddle_intregration_wc_get_products') ){
    function qs_paddle_intregration_wc_get_products(){

        $options = [];
        $alls = get_posts( array(
               'post_type' => 'product',
               'numberposts' => -1,
               'post_status' => 'publish',
               
          ) );
          foreach ( $alls as $item ) {
              $options[$item->ID]  = $item->post_title;
            
        }
       return $options;
    }
}

