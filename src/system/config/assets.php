<?php

return [

    // admin and public 
    // handle name will be converted to - hyphen 
    'css' => [

        [
            'handle_name' => 'qs-paddle-intregration-admin-base',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/system/base/assets/css/admin-base.css',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/system/base/assets/css/admin-base.css',
            'minimize'    => false,
            'public'      => false,
            'media'=> 'all',
            'deps' => [

            ]
        ],

        [
            'handle_name' => 'qs-paddle-intregration-admin-notice',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/system/base/assets/css/admin-notice.css',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/system/base/assets/css/admin-notice.css',
            'minimize'    => false,
            'public'      => false,
            'media'=> 'all',
            'deps' => [

            ]
        ],

     

        [
            'handle_name' => 'qs-paddle-integration-public-base',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/system/base/assets/css/public-base.css',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/system/base/assets/css/public-base.css',
            'minimize'    => false,
            'public'      => true,
            'media'=> 'all',
            'deps' => [
             
            ]
          
        ], 
        
       

        [
            'handle_name' => 'qs-paddle-intregration-admin-grid',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/system/base/assets/css/admin-grid.css',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/system/base/assets/css/admin-grid.css',
            'minimize'    => false,
            'public'      => false,
            'media'=> 'all',
            'deps' => [

            ]
        ],
      
        
        [
            'handle_name' => 'fontawesome',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/system/base/assets/css/font-awesome.min.css',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/system/base/assets/css/font-awesome.min.css',
            'minimize' => false,
            'public'   => true,
            'media'    => 'all',
            'deps'     => [

            ]
        ],
 
        [
            'handle_name' => 'nice-select',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/system/base/assets/css/nice-select.css',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/system/base/assets/css/nice-select.css',
            'minimize' => true,
            'public'   => true,
            'media'    => 'all',
            'deps'     => [
                
            ]
        ],

        

    ],
    
    'js' => [

        [
            'handle_name' => 'qs-paddle-integration-admin-base',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/system/base/assets/js/admin-base.js',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/system/base/assets/js/admin-base.js',
            'minimize'    => false,
            'public'      => false, // will load in_admin panel
            'in_footer'   => false,
            'media'=> 'all',
            'deps' => [
                 
            ]
        ],

        [
            'handle_name' => 'qs-paddle-integration-public-base',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/system/base/assets/js/public-base.js',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/system/base/assets/js/public-base.js',
            'minimize'    => false,
            'public'      => true, // will load in_admin panel
            'in_footer'   => true,
            'media'=> 'all',
            'deps' => [
                'jquery','wp-util'
            ]
        ],
        
        [
            'handle_name' => 'paddle',
            'src'         => 'https://cdn.paddle.com/paddle/paddle.js',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/system/base/assets/js/public-base.js',
            'minimize'    => false,
            'public'      => true, // will load in_admin panel
            'in_footer'   => true,
            'media'=> 'all',
            'deps' => [
                'jquery','wp-util'
            ]
        ], 
        
        [
            'handle_name' => 'paddle-bootstrap',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/system/base/assets/js/paddle-bootstrap.js',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/system/base/assets/js/paddle-bootstrap.js',
            'minimize'    => false,
            'public'      => true, // will load in_admin panel
            'in_footer'   => true,
            'media'=> 'all',
            'deps' => [
                'paddle'
            ]
        ],
         
        [
            'handle_name' => 'nice-select',
            'src'         => QS_PADDLE_INTEGRATION_URL.'src/system/base/assets/js/jquery.nice-select.min.js',
            'file'        => QS_PADDLE_INTEGRATION_DIR_PATH.'src/system/base/assets/js/jquery.nice-select.min.js',
            'minimize'    => false,
            'public'      => true, // will load frontend panel
            'in_footer'   => false,
            'media'=> 'all',
            'deps' => [
              'jquery'   
            ]
        ], 
      
    ],
    
];