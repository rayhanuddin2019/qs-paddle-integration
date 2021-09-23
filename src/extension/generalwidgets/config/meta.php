<?php

/************************** ***************** 
* 
* all Widgets Meta and category settings 
* since 1.0
* Registerd Widget Category for Widget Config
*
***********************************************/
return [

    //  Extension Config
    'meta' => [
      'name'        => esc_html__(' Paddle Widgets','qs-paddle-integration'),
      'description' => esc_html__('ELementor Widget Extension to use basic meta and category config','qs-paddle-integration'),
      'author'      => 'quomodosoft'
    ],

    'categories' => [
        
        'wgenerel' => [
            'name' => esc_html__('Qs Paddle Integration Elements','qs-paddle-integration'),
            'icon'  => 'fa fa-plug'
        ],
  
    ],
  
    
];