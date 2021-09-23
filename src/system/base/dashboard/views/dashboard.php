 
        <!-- Dashboard -->
      
        <?php do_action('qs_paddle_intregration_admin_message'); ?> 
       
        <div class="qs-paddle-intregration-admin-dashboard-container <?php echo esc_attr(apply_filters( 'qs_paddle_intregration_dashboard_container_class', 'qs-paddle-intregration-admin-dashboard-container' )); ?>"> <!--Wrapper Container -->
            <div class="qs-paddle-intregration-admin-dashboard-inner-content <?php echo esc_attr(apply_filters( 'qs_paddle_intregration_dashboard_inner_class', 'qs-paddle-intregration-admin-dashboard-inner-content' )); ?>">
                <div class="qs-paddle-intregration-menu-tab <?php echo esc_attr(apply_filters( 'qs_paddle_intregration_dashboard_tab_menu_class', 'qs-paddle-intregration-menu-tab' )); ?>">
                    <?php do_action('qs_paddle_intregration_tab_item'); ?>
                </div>
                <div class="qs-paddle-tab-content-container">    
                    <?php do_action('qs_paddle_intregration_tab_content'); ?>
                </div> 
            </div> <!-- dashboard-inner-content end -->
        </div> <!--Wrapper Container end -->
        <!-- Notification -->
        <div id="qs-paddle-intregration-admin-notification"></div>
   
