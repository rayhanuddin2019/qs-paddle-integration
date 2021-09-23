<?php

return [

    'dashboard_tab' => [
  
       
        [
            'menu_id'           => 'qs_paddle_intregration_components',
            'attr_class'        => 'qs-paddle-integration-dash-widgets',
            'active' => true,
            'menu_title'        => esc_html__( 'Widgets', 'qs-paddle-integration' ),
            'content_view_path' => QS_PADDLE_INTEGRATION_DIR_PATH . 'src/system/base/dashboard/views/tabs/content/widgets.php',
        ],

        [
            'menu_id'           => 'qs_paddle_intregration_modules',
            'attr_class'        => 'qs-paddle-integration-dash-modules',
            'menu_title'        => esc_html__( 'Modules', 'qs-paddle-integration' ),
            'content_view_path' => QS_PADDLE_INTEGRATION_DIR_PATH . 'src/system/base/dashboard/views/tabs/content/modules.php',
        ],
  
        [
            'menu_id'           => 'qs_paddle_intregration_data_api',
            'attr_class'        => 'qs-paddle-integration-dash-data-api',
            'menu_title'        => esc_html__( 'Api', 'qs-paddle-integration' ),
            'content_view_path' => QS_PADDLE_INTEGRATION_DIR_PATH . 'src/system/base/dashboard/views/tabs/content/api.php',
        ]

    ],
   
];