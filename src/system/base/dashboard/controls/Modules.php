<?php
namespace QS_Paddle_Integration\system\base\dashboard\controls;
use QS_Paddle_Integration\system\base\dashboard\Form;

class Modules extends Form{
  
    public $action_key = 'qs_paddle_intregration_modules_options';
    public $option_key = 'qs_paddle_intregration_modules';
    public $nonce = '_qs_paddle_intregration_modules';

    public function register(){
        
       add_action( 'admin_post_'.$this->action_key , [ $this,'_qs_paddle_components_options'] ); 
       add_action( 'qs_paddle_intregration_admin_message', [ $this ,'admin_notice__success' ],20 );
    }

    function admin_notice__success() {

        if ( isset($_SESSION['qs_paddle_intregration_dash_message'])  ) {
        
        ?>
            <div class="notice notice-success is-dismissible">
                <p><?php echo esc_html($_SESSION['qs_paddle_intregration_dash_message']); ?></p>
            </div>
        <?php
        }

        unset($_SESSION['qs_paddle_intregration_dash_message']);
    }

    function _qs_paddle_components_options(){
       
        // Verify if the nonce is valid
        if ( !isset($_POST[$this->nonce]) || !wp_verify_nonce($_POST[$this->nonce], $this->action_key)) {
            wp_redirect($_SERVER["HTTP_REFERER"]);
        }
       
        if( !array_key_exists($this->option_key,$_POST) ){
            $_SESSION['qs_paddle_intregration_dash_message'] = esc_html__('Somethings Wrong','qs-paddle-integration');
            wp_redirect($_SERVER["HTTP_REFERER"]); 
            return;
        }
    
        $validate_options = $this->validate_options( $_POST[$this->option_key] );
       
        update_option($this->option_key , $validate_options );
       
        if ( wp_doing_ajax() ){
            
            wp_die();
        }else{

            $url        = $_SERVER["HTTP_REFERER"];
            $return_url = add_query_arg( array(
                'nav' => $this->option_key,
            ), $url );
           
            $_SESSION['qs_paddle_intregration_dash_message'] = esc_html__('Modules Settings updated','qs-paddle-integration');
           
            wp_redirect($return_url);
        }
        
    } 
  
}