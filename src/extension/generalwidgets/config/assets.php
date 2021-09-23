<?php

return [

    // Elementor
    // handle name will be converted to - hyphen 
    'css' => [

        [
            'handle_name' => 'qs-paddle-intregration-extra-widgets-base',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/extension/generalwidgets/assets/css/core.css',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/extension/generalwidgets/assets/css/core.css',
            'minimize'    => false,
            'public'      => true,
            'media'=> 'all',
            'deps' => [

            ]
        ]
 

    ],
    
    'js' => [

        [
            'handle_name' => 'qs-paddle-intregration-extra-widgets',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/extension/generalwidgets/assets/js/pro.js',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/extension/generalwidgets/assets/js/pro.js',
            'minimize'    => false,
            'public'      => true, // will load in_admin panel
            'in_footer'   => false,
            'media'=> 'all',
            'deps' => [
                'jquery'
            ]
        ], 
   
    ],
    
];

