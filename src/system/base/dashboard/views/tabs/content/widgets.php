<?php

/* 
* Widget Component
* @since 1.0
*/

    $settings_id      = 'qs_paddle_intregration_components';
    $switch_js_target = $settings_id.'_widgets';
    $nonce_field_val  = '_qs_paddle_intregration_components';
    $action_key       = 'qs_paddle_intregration_components_options';
    $option_key       = 'qs_paddle_intregration_components';
    $label_identifier = 'quomodo-components-';
    $heading          = esc_html__( 'Widgets','qs-paddle-integration' );
    
    $components_settings = qs_paddle_intregration_get_transform_options(qs_paddle_intregration_widgets_config()->all(),$settings_id);
    $components_settings = apply_filters( 'qs_paddle_intregration_widgets_dashboard_options', $components_settings );
    $total_widgets = is_array($components_settings) ? count($components_settings) : 0;
   
?>
    <!-- Widgets Swicher  -->
    <form id="woo-ready-admin-component-form" class="qs-paddle-intregration-components-action quomodo-component-data" action="<?php echo admin_url('admin-post.php') ?>" method="post">
        <div class="quomodo-container-wrapper">
            <div class="quomodo-row-wrapper">
                <div class="woo-ready-component-form-wrapper components">
                    <div class="qs-paddle-intregration-components-topbar">
                        <div class="qs-paddle-intregration-title">
                            <h3 class="title"><i class="dashicons dashicons-editor-alignleft qs-paddle-intregration-offcanvas"></i> <?php echo esc_html( $heading ); echo '( '.$total_widgets .' )'; ?></h3> 
                        </div>
                        <div class="qs-paddle-intregration-savechanges">
                            <div class="qs-paddle-intregration-admin-search">
                            <input data-target="<?php echo esc_attr($switch_js_target); ?>" placeholder="<?php echo esc_attr__( 'Search here', 'qs-paddle-integration' ) ?>" class="quomodo_text woo-ready-element-search" id="woo-ready-widgets-search" type="search">
                            </div>
                            <div class="qs-paddle-intregration-check-all">
                                <div class="quomodo_switch_common qs-paddle-intregration-common">
                                    <div data-target="<?php echo esc_attr($switch_js_target); ?>" class="quomodo_sm_switch woo-ready-enable-all-switch">
                                        <strong>
                                            <?php echo esc_html__('Enable All','qs-paddle-integration'); ?>  
                                        </strong>
                                    </div>
                                </div>
                            </div>
                            <div class="qs-paddle-intregration-check-all">
                                <div class="quomodo_switch_common qs-paddle-intregration-common">
                                    <div data-target="<?php echo esc_attr($switch_js_target); ?>" class="quomodo_sm_switch qs-paddle-intregration-disable-all-switch" id="quomodo-components-all-disable">
                                        <strong>
                                            <?php echo esc_html__('Disable All','qs-paddle-integration'); ?>  
                                        </strong>
                                        
                                        <label for="quomodo-components-<?php echo esc_attr__('all-disable'); ?>"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="qs-paddle-intregration-admin-button">
                                <button type="submit" class="qs-paddle-intregration-component-submit button qs-paddle-intregration-submit-btn">
                                    <i class="dashicons dashicons-yes"></i>
                                    <?php echo esc_html__('Save Change','qs-paddle-integration'); ?>
                                </button>
                            </div>

                        </div>
                    </div>
                    <div class="quomodo-container">
                        <div class="quomodo-row qs-paddle-intregration-component-row">
                           
                            <?php if( is_array( $components_settings ) ): ?>
                            <?php foreach($components_settings as $item_key => $item): ?>
                
                            <div class="qs-paddle-intregration-col quomodo-col-xl-3 quomodo-col-lg-3 quomodo-col-md-5 <?php echo esc_attr(isset($item['is_pro']) && $item['is_pro']) ? 'shop-ready-pro-order' : ''; ?>">
                                <div class="quomodo_switch_common qs-paddle-intregration-common <?php echo esc_attr($item['is_pro'] ? 'woo-ready-pro woo-ready-dash-modal-open-btn':''); ?>">
                                
                                    <div data-targetee="<?php echo esc_attr($switch_js_target); ?>" class="quomodo_sm_switch">
                                        <?php if(isset($item['demo_link']) && $item['demo_link'] !=''): ?>
                                        <a target="_blank" href="<?php echo esc_url($item['demo_link']); ?>" class="qs-paddle-data-tooltip"><?php echo esc_html__('view demo','qs-paddle-integration'); ?></a>
                                        <?php endif; ?>
                                        <strong><?php echo esc_html($item['title']); ?>
                                            <?php if(isset($item['is_pro']) && $item['is_pro']): ?>
                                                <span> <?php echo esc_html__( 'PRO', 'qs-paddle-integration' ) ?> </span>
                                            <?php endif; ?>    
                                        </strong>
                                        <input <?php echo esc_attr($item['is_pro']?'readonly disabled':''); ?> <?php echo esc_attr($item['default']==1?'checked':''); ?> name="<?php echo esc_attr( $option_key ); ?>[<?php echo esc_attr($item_key); ?>]" class="quomodo_switch <?php echo esc_attr($item_key); ?>" id="<?php echo esc_attr($label_identifier); ?><?php echo esc_attr($item_key); ?>" type="checkbox">
                                        <label for="<?php echo esc_attr($label_identifier); ?><?php echo esc_attr($item_key); ?>"></label>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="action" value="<?php echo esc_attr($action_key); ?>">
                <?php echo wp_nonce_field($action_key, $nonce_field_val); ?>
            </div>
        </div> <!-- container end -->
    </form>
    <!-- Widget swicher form end -->