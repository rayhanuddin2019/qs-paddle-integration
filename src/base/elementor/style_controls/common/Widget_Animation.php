<?php
/**
 * @package QS Paddle Intregration
 */
namespace QS_Paddle_Integration\base\elementor\style_controls\common;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;

trait Widget_Animation {

    // usage
    // echo '<div class="' . $settings['hover_animation'] . '"> .. </div>';
    public function animate($atts){

        $atts_variable = shortcode_atts(
            array(
                'title'           => esc_html__('Animation','qs-paddle-integration'),
                'slug'            => 'entrance_animation',
                'hover'    => false
                
           
            ), $atts );

        extract($atts_variable);

        $widget = $this->get_name().'_'.qs_paddle_intregration_heading_camelize($slug);
        $this->start_controls_section(
            $widget.'_style_after_before_section',
			[
				'label' => $title,
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			$slug.'_entrance_animation',
			[
				'label' => __( 'Entrance Animation', 'qs-paddle-integration' ),
				'type' => \Elementor\Controls_Manager::ANIMATION,
				'prefix_class' => 'animated ',
			]
		);

        if($hover){

            $this->add_control(
                $slug.'_hover_animation',
                [
                    'label' => __( 'Hover Animation', 'qs-paddle-integration' ),
                    'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
                    'prefix_class' => 'elementor-animation-',
                ]
            );
        }
    
		$this->end_controls_section();
    } 
    
  
  }