<?php

namespace QS_Paddle_Integration\extension\generalwidgets\deps;

/** 
* @since 1.0 
* WooCommerce Checkout 
* @author quomodosoft.com 
*/

class Checkout {
  
    public function register(){

        
        add_action( 'wp_ajax_qs_paddle_woocommerce_checkout_success', [$this,'on_test'] );
        add_action( 'wp_ajax_qs_paddle_woocommerce_checkout_success', [$this,'on_test'] );
        add_action( 'user_register', [$this,'order_update'], 9999, 2 );

    }

    function order_update( $user_id , $userdata) {
        
        $email = $userdata[ 'user_email' ];
       
        $args = array(
            'customer' => $email,
        );

        $orders = wc_get_orders( $args );
    
        foreach($orders as $order){
            update_post_meta( $order->get_id(), '_customer_user', $user_id);    
        }
      
     }

    public function on_new_order_success() {
       
        if( isset($_REQUEST['domain']) && $_REQUEST['domain'] == $this->get_api_data_by_key() ){
           
             global $woocommerce;
             $paddle_incomming_price = isset($_REQUEST['data']['order']['total']) ? $_REQUEST['data']['order']['total'] : 0;
             $message                = '';
             $product_id             = $_REQUEST['product_id'];
             $email                  = $_REQUEST['email'];
             $wc_product_id          = $_REQUEST['wc_product_id'];
             $completed_status       = isset($_REQUEST['completed'])?$_REQUEST['completed']:false;
             $_status                = isset($_REQUEST['status'])?$_REQUEST['status']:'completed';
            
             WC()->cart->empty_cart();
         
             $cart = WC()->cart;
             $cart->add_to_cart($wc_product_id);
             $cart_c = WC()->cart->get_cart();
             
             foreach( $cart_c as $key => $value ) {
                 $value['data']->set_price($paddle_incomming_price); // Set the per unit price, so, it match when cart sub total is calculated
             }
             
             WC()->cart->set_session();
             WC()->cart->maybe_set_cart_cookies();
             WC()->cart->calculate_totals();
             
             // step 2 checkout
             $checkout = WC()->checkout();
             $order_id = $checkout->create_order(array('payment_method' => 'By Paddle','billing_email'=> $email , 'qs_paddle_wc_target_product_id' => $wc_product_id ));
             $order = new \WC_Order($order_id);
             $order->update_status( 'completed' ); 
             $order->save();
         
             $cart->empty_cart();
             
            $return = array(
                 'message'  => __( 'Order Created successfully', 'qs-paddle-intregration' ),
                 'ID'       => $product_id,
                 'order_id' => $order_id
             );
             
             $order_k = wc_get_order($order_id);
   
             if ($order_k && !is_wp_error($order_k)) {
             
                 $return['order_id']          = $order_id;
                 $return['order_key']          = $order_k->get_order_key();
                 $return['get_view_order_url'] = $order_k->get_view_order_url();
             }
                
             wp_send_json_success( $return );
             wp_die(); 
        }
       
    }

    public function get_api_data_by_key($key='domain'){

        $data       = qs_paddle_intregration_api_config()->all();
        $pluck_list = wp_list_pluck($data,'default');

        if(isset($pluck_list[$key])){
           return $pluck_list[$key];  
        }
         
        return false;
    }

    
}