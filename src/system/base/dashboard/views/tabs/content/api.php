<?php

/* 
* Data Api
* @since 1.0
*/

    $settings_id       = 'qs_paddle_intregration_data_api';
    $option_switch_key = 'qs_paddle_intregration_data_api_switch';
    $switch_js_target  = $settings_id.'_data_api';

    $nonce_field_val     = '_qs_paddle_intregration_data_api';
    $action_key          = 'qs_paddle_intregration_data_api_options';
    $option_key          = 'qs_paddle_intregration_data_api';
    $label_identifier    = 'quomodo-data-api-';
    $heading             = esc_html__( 'Api','qs-paddle-integration' );
  
    
?>
    <!-- Widgets Swicher  -->
    <form id="qs-paddle-intregration-admin-module-form" class="qs-paddle-intregration-components-action quomodo-api-data" action="<?php echo admin_url('admin-post.php') ?>" method="post">
        <div class="quomodo-container-wrapper">
            <div class="quomodo-row-wrapper">
                <div class="woo-ready-component-form-wrapper api">
                    <div class="qs-paddle-intregration-components-topbar">
                        <div class="qs-paddle-intregration-title">
                            <h3 class="title"><i class="dashicons dashicons-editor-alignleft qs-paddle-intregration-offcanvas"></i> <?php echo esc_html($heading); ?></h3>
                        </div>
                        <div class="qs-paddle-intregration-savechanges">
                       
                            <div class="qs-paddle-intregration-admin-button">
                                <button type="submit" class="qs-paddle-intregration-component-submit button qs-paddle-intregration-submit-btn">
                                    <i class="dashicons dashicons-yes"></i>
                                    <?php echo esc_html__('Save Change','qs-paddle-integration'); ?>
                                </button>
                            </div>
 
                        </div>
                    </div>
                    <div class="quomodo-container"> 
                        <?php $api_settings = qs_paddle_intregration_api_config()->all(); ?>
                        
                        <?php if( is_array( $api_settings ) ): ?>
                     
                            <?php foreach( $api_settings as $item_key => $item): ?>
                                    <div class="quomodo-row qs-paddle-data-row">
                                   
                                        <div class="qs-paddle-intregration-col qs-paddle-data-api-col quomodo-col-md-11 ">
                                            <div class="qs-paddle-data">
                                                
                                                <strong><?php echo esc_html($item['title']); ?></strong>
                                                <?php if(isset($item['demo_link']) && $item['demo_link'] !=''): ?>
                                                    <a target="_blank" href="<?php echo esc_url($item['demo_link']); ?>" class="qs-paddle-data-tooltip"><?php echo esc_html__('view doc','qs-paddle-integration'); ?></a>
                                                <?php endif; ?>
                                                <input value="<?php echo esc_attr($item['default']); ?>" name="<?php echo esc_attr( $option_key ); ?>[<?php echo esc_attr($item_key); ?>]" class="quomodo_text <?php echo esc_attr($item_key); ?>" id="<?php echo esc_attr($label_identifier); ?><?php echo esc_attr($item_key); ?>" type="<?php echo esc_attr($item['type']); ?>">
                                                <label for="<?php echo esc_attr($label_identifier); ?><?php echo esc_attr($item_key); ?>"></label>
                                                
                                            </div>  
                                        </div>
                                    </div>
                            <?php endforeach; ?>
                         
                        <?php endif; ?>
                    </div>
                </div>
                <input type="hidden" name="action" value="<?php echo esc_attr($action_key); ?>">
                <?php echo wp_nonce_field($action_key, $nonce_field_val); ?>
            </div>
        </div> <!-- container end -->
    </form>
    <!-- Widget swicher form end -->