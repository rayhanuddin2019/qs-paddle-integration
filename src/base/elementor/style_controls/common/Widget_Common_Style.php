<?php
/**
 * @package QS Paddle Intregration
 */
namespace QS_Paddle_Integration\base\elementor\style_controls\common;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

trait Widget_Common_Style {

    public function element_before_psudocode( $atts ) {

        $atts_variable = shortcode_atts(
            [
                'title'           => esc_html__( 'Separate', 'qs-paddle-integration' ),
                'slug'            => '_meta_after_before_style',
                'element_name'    => 'after__quomodosoft__',
                'selector'        => '{{WRAPPER}} ',
                'selector_parent' => '',
                'condition'       => '',
            ], $atts );

        extract( $atts_variable );

        $widget = $this->get_name() . '_' . qs_paddle_intregration_heading_camelize( $slug );

        /*----------------------------
        ELEMENT__STYLE
        -----------------------------*/
        $tab_start_section_args = [
            'label' => $title,
            'tab'   => Controls_Manager::TAB_STYLE,
        ];

        if ( is_array( $condition ) ) {
            $tab_start_section_args['condition'] = $condition;
        }

        $this->start_controls_section(
            $widget . '_style_after_before_section',
            $tab_start_section_args
        );


        $this->add_control(
            'psdu_' . $element_name . '_color',
            [
                'label'     => esc_html__( 'Color', 'qs-paddle-integration' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    $selector => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            $widget . 'main_section_' . $element_name . 'psudud_opacity_color',
            [
                'label'      => esc_html__( 'Opacity', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1,
                        'step' => 0.1,
                    ],

                ],

                'selectors'  => [
                    $selector_parent => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => $widget . 'main_section_' . $element_name . 'psudud_border_gp_',
                'label'    => esc_html__( 'Border', 'qs-paddle-integration' ),
                'selector' => $selector,
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_size_transform',
            [
                'label'      => esc_html__( 'Transform', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],

                ],

                'selectors'  => [
                    $selector => 'transform: translateY(-50%) rotate({{SIZE}}deg);',
                ],
            ]
        );

        if ( $selector_parent != '' ) {
            $this->add_responsive_control(
                $widget . 'psudu_padding',
                [
                    'label'      => esc_html__( 'Padding', 'qs-paddle-integration' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors'  => [
                        $selector_parent => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
        }

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_psudu_size_width',
            [
                'label'      => esc_html__( 'Width', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 2100,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . 'psudud_size_height',
            [
                'label'      => esc_html__( 'Height', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 2100,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . 'psudud_position_left_',
            [
                'label'      => esc_html__( 'Position Left', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -2700,
                        'max'  => 2700,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . 'psudud_position_top_',
            [
                'label'      => esc_html__( 'Position Top', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -2700,
                        'max'  => 2700,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . '_section__psudu_section_show_hide_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Display', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'block' => esc_html__( 'Block', 'qs-paddle-integration' ),
                    'none'  => esc_html__( 'None', 'qs-paddle-integration' ),
                    ''      => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],
                'selectors' => [
                    $selector => 'display: {{VALUE}};',
                ],
            ]

        );

        $this->end_controls_section();
    }

    public function element_size( $atts ) {

        $atts_variable = shortcode_atts(
            [
                'title'        => esc_html__( 'Size Style', 'qs-paddle-integration' ),
                'slug'         => '_size_style',
                'element_name' => '__quomodosoft__',
                'selector'     => '{{WRAPPER}} ',
                'condition'    => '',
            ], $atts );

        extract( $atts_variable );

        $widget = $this->get_name() . '_' . qs_paddle_intregration_heading_camelize( $slug );

        /*----------------------------
        ELEMENT__STYLE
        -----------------------------*/
        $tab_start_section_args = [
            'label' => $title,
            'tab'   => Controls_Manager::TAB_STYLE,
        ];

        if ( is_array( $condition ) ) {
            $tab_start_section_args['condition'] = $condition;
        }

        $this->start_controls_section(
            $widget . '_style_section',
            $tab_start_section_args
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_size_width',
            [
                'label'      => esc_html__( 'Width', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 2100,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_size_max_width',
            [
                'label'      => esc_html__( 'Max Width', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 2100,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_size_height',
            [
                'label'      => esc_html__( 'Height', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 2100,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_size_max_height',
            [
                'label'      => esc_html__( 'Max Height', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 2100,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'max-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => $widget . 'size_border',
                'label'    => esc_html__( 'Border', 'qs-paddle-integration' ),
                'selector' => $selector,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name'     => $widget . 'main_section_' . $element_name . '_r_box_shadow',
                'label'    => __( 'Box Shadow', 'qs-paddle-integration' ),
                'selector' => $selector,
            ]
        );

        // Radius
        $this->add_responsive_control(
            $widget . 'seze_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function text_css( $atts ) {

        $atts_variable = shortcode_atts(
            [
                'title'          => esc_html__( 'Text Style', 'qs-paddle-integration' ),
                'slug'           => '_text_style',
                'element_name'   => '__woo_ready__',
                'selector'       => '{{WRAPPER}} ',
                'hover_selector' => '{{WRAPPER}} ',
                'condition'      => '',
            ], $atts );

        extract( $atts_variable );

        $widget = $this->get_name() . '_' . qs_paddle_intregration_heading_camelize( $slug );

        /*----------------------------
        ELEMENT__STYLE
        -----------------------------*/
        $tab_start_section_args = [
            'label' => $title,
            'tab'   => Controls_Manager::TAB_STYLE,
        ];

        if ( is_array( $condition ) ) {
            $tab_start_section_args['condition'] = $condition;
        }

        $this->start_controls_section(
            $widget . '_style_section',
            $tab_start_section_args
        );

        

        $this->start_controls_tabs( $widget . '_tabs_style' );

        
        $this->start_controls_tab(
            $widget . '_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'qs-paddle-integration' ),
            ]
        );



        // Typgraphy
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => $widget . '_typography',
                'selector' => $selector,
            ]
        );

        // Icon Color
        $this->add_control(
            $widget . '_text_color',
            [
                'label'     => esc_html__( 'Color', 'qs-paddle-integration' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    $selector => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name'     => $widget . 'text_shadow_',
                'label'    => esc_html__( 'Text Shadow', 'qs-paddle-integration' ),
                'selector' => $selector,
            ]
        );

        // Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => $widget . 'text_background',
                'label'    => esc_html__( 'Background', 'qs-paddle-integration' ),
                'types'    => ['classic', 'gradient', 'video'],
                'selector' => $selector,
            ]
        );

        // Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => $widget . '_border',
                'label'    => esc_html__( 'Border', 'qs-paddle-integration' ),
                'selector' => $selector,
            ]
        );

        // Radius
        $this->add_responsive_control(
            $widget . '_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => $widget . 'normal_shadow',
                'selector' => $selector,
            ]
        );

        // Margin
        $this->add_responsive_control(
            $widget . '_margin',
            [
                'label'      => esc_html__( 'Margin', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            $widget . '_padding',
            [
                'label'      => esc_html__( 'Padding', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            $widget . 'ele_box_transition',
            [
                'label'      => esc_html__( 'Transition', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0.1,
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 0.5,
                ],
                'selectors'  => [
                    $selector => 'transition: {{SIZE}}s;',

                ],
            ]
        );


        $this->end_controls_tab();
        
        if ( $hover_selector != false || $hover_selector != '' ) {

            $this->start_controls_tab(
                $widget . '_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'qs-paddle-integration' ),
                ]
            );

            //Hover Color
            $this->add_control(
                'hover_' . $element_name . '_color',
                [
                    'label'     => esc_html__( 'Color', 'qs-paddle-integration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $hover_selector => 'color: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Text_Shadow::get_type(),
                [
                    'name'     => $widget . 'text_shadow_hover_',
                    'label'    => esc_html__( 'Text Shadow', 'qs-paddle-integration' ),
                    'selector' => $hover_selector,
                ]
            );

            // Hover Background
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'hover_' . $element_name . '_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-integration' ),
                    'types'    => ['classic', 'gradient'],
                    'selector' => $hover_selector,
                ]
            );

            // Border
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'hover_' . $element_name . '_border',
                    'label'    => esc_html__( 'Border', 'qs-paddle-integration' ),
                    'selector' => $hover_selector,
                ]
            );

            // Radius
            $this->add_responsive_control(
                'hover_' . $element_name . '_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'qs-paddle-integration' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors'  => [
                        $hover_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Shadow
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'hover_' . $element_name . '_shadow',
                    'selector' => $hover_selector,
                ]
            );

            $this->end_controls_tab();

            $this->start_controls_tab(
                $widget . '_position_tab',
                [
                    'label' => esc_html__( 'Position', 'qs-paddle-integration' ),
                ]
            ); 
    
                $this->add_responsive_control(
                    $widget . '_section__' . $element_name . '_position_type',
                    [
                        'label'     => esc_html__( 'Position', 'qs-paddle-integration' ),
                        'type'      => \Elementor\Controls_Manager::SELECT,
                        'default'   => '',
                        'options'   => [
                            'fixed'    => esc_html__( 'Fixed', 'qs-paddle-integration' ),
                            'absolute' => esc_html__( 'Absolute', 'qs-paddle-integration' ),
                            'relative' => esc_html__( 'Relative', 'qs-paddle-integration' ),
                            'sticky'   => esc_html__( 'Sticky', 'qs-paddle-integration' ),
                            'static'   => esc_html__( 'Static', 'qs-paddle-integration' ),
                            'inherit'  => esc_html__( 'inherit', 'qs-paddle-integration' ),
                            ''         => esc_html__( 'none', 'qs-paddle-integration' ),
                        ],
                        'selectors' => [
                            $selector => 'position: {{VALUE}};',
                        ],
    
                    ]
                );
    
                $this->add_responsive_control(
                    $widget . 'main_section_' . $element_name . '_position_left',
                    [
                        'label'      => esc_html__( 'Position Left', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%'],
                        'range'      => [
                            'px' => [
                                'min'  => -1600,
                                'max'  => 1600,
                                'step' => 5,
                            ],
                            '%'  => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
    
                        'selectors'  => [
                            $selector => 'left: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
    
                $this->add_responsive_control(
                    $widget . 'main_section_' . $element_name . '_r_position_top',
                    [
                        'label'      => esc_html__( 'Position Top', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%'],
                        'range'      => [
                            'px' => [
                                'min'  => -1600,
                                'max'  => 1600,
                                'step' => 5,
                            ],
                            '%'  => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
    
                        'selectors'  => [
                            $selector => 'top: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
    
                $this->add_responsive_control(
                    $widget . 'main_section_' . $element_name . '_r_position_bottom',
                    [
                        'label'      => esc_html__( 'Position Bottom', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%'],
                        'range'      => [
                            'px' => [
                                'min'  => -1600,
                                'max'  => 1600,
                                'step' => 5,
                            ],
                            '%'  => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
    
                        'selectors'  => [
                            $selector => 'bottom: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    $widget . 'main_section_' . $element_name . '_r_position_right',
                    [
                        'label'      => esc_html__( 'Position Right', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%'],
                        'range'      => [
                            'px' => [
                                'min'  => -1600,
                                'max'  => 1600,
                                'step' => 5,
                            ],
                            '%'  => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
    
                        'selectors'  => [
                            $selector => 'right: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab(
                $widget . '_size_tab',
                [
                    'label' => esc_html__( 'Size', 'qs-paddle-integration' ),
                ]
            ); 
    
                $this->add_responsive_control(
                    $widget . 'main_section_' . $element_name . '_r_itemdsd_el__width',
                    [
                        'label'      => esc_html__( 'Width', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%'],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 3000,
                                'step' => 5,
                            ],
                            '%'  => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
    
                        'selectors'  => [
                            $selector => 'width: {{SIZE}}{{UNIT}};',
    
                        ],
                    ]
                );
    
                $this->add_responsive_control(
                    $widget . 'main_section_' . $element_name . '_r_item_dsd_maxel__width',
                    [
                        'label'      => esc_html__( 'Max Width', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%'],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 3000,
                                'step' => 5,
                            ],
                            '%'  => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
    
                        'selectors'  => [
                            $selector => 'max-width: {{SIZE}}{{UNIT}};',
    
                        ],
                    ]
                );
    
                $this->add_responsive_control(
                    $widget . 'main_section_' . $element_name . '_r_item_errt_min_el__width',
                    [
                        'label'      => esc_html__( 'Min Width', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%'],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 3000,
                                'step' => 5,
                            ],
                            '%'  => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
    
                        'selectors'  => [
                            $selector => 'min-width: {{SIZE}}{{UNIT}};',
    
                        ],
                    ]
                );

                $this->add_responsive_control(
                    $widget . 'main_section_' . $element_name . '_r_item_errt_min_el__height',
                    [
                        'label'      => esc_html__( 'Height', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%'],
                        'range'      => [
                            'px' => [
                                'min'  => 0,
                                'max'  => 500,
                                'step' => 5,
                            ],
                            '%'  => [
                                'min' => 0,
                                'max' => 100,
                            ],
                        ],
    
                        'selectors'  => [
                            $selector => 'height: {{SIZE}}{{UNIT}};',
    
                        ],
                    ]
                );
    
    
            $this->end_controls_tab();

            do_action('custom_tab_'.$widget);
        } // hover_select check end
        $this->end_controls_tabs();

        $this->add_responsive_control(
            $widget . '_section___section_show_hide_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Display', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'flex'         => esc_html__( 'Flex', 'qs-paddle-integration' ),
                    'inline-flex'  => esc_html__( 'Inline Flex', 'qs-paddle-integration' ),
                    'block'        => esc_html__( 'Block', 'qs-paddle-integration' ),
                    'inline-block' => esc_html__( 'Inline Block', 'qs-paddle-integration' ),
                    'grid'         => esc_html__( 'Grid', 'qs-paddle-integration' ),
                    'none'         => esc_html__( 'None', 'qs-paddle-integration' ),
                    ''             => esc_html__( 'Default', 'qs-paddle-integration' ),
                ],
                'selectors' => [
                    $selector => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . '_section___section_flex_direction_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Flex Direction', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'column'         => esc_html__( 'Column', 'qs-paddle-integration' ),
                    'row'            => esc_html__( 'Row', 'qs-paddle-integration' ),
                    'column-reverse' => esc_html__( 'Column Reverse', 'qs-paddle-integration' ),
                    'row-reverse'    => esc_html__( 'Row Reverse', 'qs-paddle-integration' ),
                    'revert'         => esc_html__( 'Revert', 'qs-paddle-integration' ),
                    'none'           => esc_html__( 'None', 'qs-paddle-integration' ),
                    ''               => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],
                'selectors' => [
                    $selector => 'flex-direction: {{VALUE}};',
                ],
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
            ]

        );

        $this->add_responsive_control(
            $widget . 'txt_wr_section_' . $element_name . '_flex_gap',
            [
                'label'      => esc_html__( 'Gap', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 800,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'gap: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . '_section__s_section_flex_wrap_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Flex Wrap', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'wrap'         => esc_html__( 'Wrap', 'qs-paddle-integration' ),
                    'wrap-reverse' => esc_html__( 'Wrap Reverse', 'qs-paddle-integration' ),
                    'nowrap'       => esc_html__( 'No Wrap', 'qs-paddle-integration' ),
                    'unset'        => esc_html__( 'Unset', 'qs-paddle-integration' ),
                    'normal'       => esc_html__( 'None', 'qs-paddle-integration' ),
                    'inherit'      => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],
                'selectors' => [
                    $selector => 'flex-wrap: {{VALUE}};',
                ],
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
            ]

        );

        $this->add_responsive_control(
            $widget . '_alignment', [
                'label'     => esc_html__( 'Alignment', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::CHOOSE,
                'options'   => [

                    'left'    => [

                        'title' => esc_html__( 'Left', 'qs-paddle-integration' ),
                        'icon'  => 'fa fa-align-left',

                    ],
                    'center'  => [

                        'title' => esc_html__( 'Center', 'qs-paddle-integration' ),
                        'icon'  => 'fa fa-align-center',

                    ],
                    'right'   => [

                        'title' => esc_html__( 'Right', 'qs-paddle-integration' ),
                        'icon'  => 'fa fa-align-right',

                    ],

                    'justify' => [

                        'title' => esc_html__( 'Justified', 'qs-paddle-integration' ),
                        'icon'  => 'fa fa-align-justify',

                    ],
                ],

                'selectors' => [
                    $selector => 'text-align: {{VALUE}};',
                ],
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['block', 'inline-block']],
            ]
        ); //Responsive control end

        $this->add_responsive_control(
            $widget . '_section_align_sessction_e_' . $element_name . '_flex_align',
            [
                'label'     => esc_html__( 'Alignment', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'flex-start'    => esc_html__( 'Left', 'qs-paddle-integration' ),
                    'flex-end'      => esc_html__( 'Right', 'qs-paddle-integration' ),
                    'center'        => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'space-around'  => esc_html__( 'Space Around', 'qs-paddle-integration' ),
                    'space-between' => esc_html__( 'Space Between', 'qs-paddle-integration' ),
                    'space-evenly'  => esc_html__( 'Space Evenly', 'qs-paddle-integration' ),
                    ''              => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],

                'selectors' => [
                    $selector => 'justify-content: {{VALUE}};',
                ],
            ]

        );

        $this->add_responsive_control(
            $widget . 'er_section_align_items_ssection_e_' . $element_name . '_flex_align',
            [
                'label'     => esc_html__( 'Align Items', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'flex-start' => esc_html__( 'Left', 'qs-paddle-integration' ),
                    'flex-end'   => esc_html__( 'Right', 'qs-paddle-integration' ),
                    'center'     => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'baseline'   => esc_html__( 'Baseline', 'qs-paddle-integration' ),
                    ''           => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],

                'selectors' => [
                    $selector => 'align-items: {{VALUE}};',
                ],
            ]

        );
 

        $this->end_controls_section();
        /*----------------------------
    ELEMENT__STYLE END
    -----------------------------*/
    }

    public function text_wrapper_css( $atts ) {

        $atts_variable = shortcode_atts(
            [
                'title'          => esc_html__( 'Text Style', 'qs-paddle-integration' ),
                'slug'           => '_text_style',
                'element_name'   => '__quomodosoft__',
                'selector'       => '{{WRAPPER}} ',
                'hover_selector' => '{{WRAPPER}} ',
                'condition'      => '',
            ], $atts );

        extract( $atts_variable );

        $widget = $this->get_name() . '_' . qs_paddle_intregration_heading_camelize( $slug );

        /*----------------------------
        ELEMENT__STYLE
        -----------------------------*/
        $tab_start_section_args = [
            'label' => $title,
            'tab'   => Controls_Manager::TAB_STYLE,
        ];

        if ( is_array( $condition ) ) {
            $tab_start_section_args['condition'] = $condition;
        }

        $this->start_controls_section(
            $widget . '_style_section',
            $tab_start_section_args
        );

        $this->start_controls_tabs( $widget . '_tabs_style' );

        do_action('custom_tab_'.$widget);
        $this->start_controls_tab(
            $widget . '_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'qs-paddle-integration' ),
            ]
        );

        do_action('custom_'.$widget);
        // Typgraphy
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => $widget . '_typography',
                'selector' => $selector,
            ]
        );

        // Icon Color
        $this->add_control(
            $widget . '_text_color',
            [
                'label'     => esc_html__( 'Color', 'qs-paddle-integration' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    $selector => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name'     => $widget . 'text_shadow_',
                'label'    => esc_html__( 'Text Shadow', 'qs-paddle-integration' ),
                'selector' => $selector,
            ]
        );

        // Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => $widget . 'text_background',
                'label'    => esc_html__( 'Background', 'qs-paddle-integration' ),
                'types'    => ['classic', 'gradient', 'video'],
                'selector' => $selector,
            ]
        );

        // Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => $widget . '_border',
                'label'    => esc_html__( 'Border', 'qs-paddle-integration' ),
                'selector' => $selector,
            ]
        );

        // Radius
        $this->add_responsive_control(
            $widget . '_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => $widget . 'normal_shadow',
                'selector' => $selector,
            ]
        );

        // Margin
        $this->add_responsive_control(
            $widget . '_margin',
            [
                'label'      => esc_html__( 'Margin', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            $widget . '_padding',
            [
                'label'      => esc_html__( 'Padding', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

      


        $this->add_control(
            $widget . 'ele_box_transition',
            [
                'label'      => esc_html__( 'Transition', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0.1,
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 0.5,
                ],
                'selectors'  => [
                    $selector => 'transition: {{SIZE}}s;',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_item_el__width',
            [
                'label'      => esc_html__( 'Width', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 3000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'width: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_item__maxel__width',
            [
                'label'      => esc_html__( 'Max Width', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 3000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'max-width: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_item__min_el__width',
            [
                'label'      => esc_html__( 'Min Width', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 3000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'min-width: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->end_controls_tab();
        if ( $hover_selector != false || $hover_selector != '' ) {

            $this->start_controls_tab(
                $widget . '_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'qs-paddle-integration' ),
                ]
            );

            //Hover Color
            $this->add_control(
                'hover_' . $element_name . '_color',
                [
                    'label'     => esc_html__( 'Color', 'qs-paddle-integration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        $hover_selector => 'color: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Text_Shadow::get_type(),
                [
                    'name'     => $widget . 'text_shadow_hover_',
                    'label'    => esc_html__( 'Text Shadow', 'qs-paddle-integration' ),
                    'selector' => $hover_selector,
                ]
            );

            // Hover Background
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'hover_' . $element_name . '_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-integration' ),
                    'types'    => ['classic', 'gradient'],
                    'selector' => $hover_selector,
                ]
            );

            // Border
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'hover_' . $element_name . '_border',
                    'label'    => esc_html__( 'Border', 'qs-paddle-integration' ),
                    'selector' => $hover_selector,
                ]
            );

            // Radius
            $this->add_responsive_control(
                'hover_' . $element_name . '_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'qs-paddle-integration' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors'  => [
                        $hover_selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            // Shadow
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'hover_' . $element_name . '_shadow',
                    'selector' => $hover_selector,
                ]
            );


            $this->end_controls_tab();
        } // hover_select check end
        $this->end_controls_tabs();

        $this->add_responsive_control(
            $widget . '_section___section_show_hide_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Layout', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'flex'         => esc_html__( 'Flex Layout', 'qs-paddle-integration' ),
                    'inline-flex'  => esc_html__( 'Inline Flex Layout', 'qs-paddle-integration' ),
                    'block'        => esc_html__( 'Block layout', 'qs-paddle-integration' ),
                    'inline-block' => esc_html__( 'Inline Layout', 'qs-paddle-integration' ),
                    'grid'         => esc_html__( 'Grid layout', 'qs-paddle-integration' ),
                    'grid'         => esc_html__( 'Flow Layout', 'qs-paddle-integration' ),
                    'none'         => esc_html__( 'Hide', 'qs-paddle-integration' ),
                    ''             => esc_html__( 'Default', 'qs-paddle-integration' ),
                ],
                'selectors' => [
                    $selector => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . '_section___section_flex_direction_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Flex Direction', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'column'         => esc_html__( 'Column', 'qs-paddle-integration' ),
                    'row'            => esc_html__( 'Row', 'qs-paddle-integration' ),
                    'column-reverse' => esc_html__( 'Column Reverse', 'qs-paddle-integration' ),
                    'row-reverse'    => esc_html__( 'Row Reverse', 'qs-paddle-integration' ),
                    'revert'         => esc_html__( 'Revert', 'qs-paddle-integration' ),
                    'none'           => esc_html__( 'None', 'qs-paddle-integration' ),
                    ''               => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],
                'selectors' => [
                    $selector => 'flex-direction: {{VALUE}};',
                ],
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
            ]

        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_flex_basis',
            [
                'label'      => esc_html__( 'Item Width', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 800,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'flex-basis: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_flex_grow',
            [
                'label'      => esc_html__( 'Item Grow', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 800,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'flex-grow: {{SIZE}}',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_flex_shrink',
            [
                'label'      => esc_html__( 'Item Shrink', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 800,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'flex-shrink: {{SIZE}}',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_flex_order',
            [
                'label'      => esc_html__( 'Item Order', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 800,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'order: {{SIZE}}',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'text_section_' . $element_name . '_flexs_gap',
            [
                'label'      => esc_html__( 'Gap', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 800,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'gap: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . '_section__s_section_flexr_wrap_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Flex Wrap', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'wrap'         => esc_html__( 'Wrap', 'qs-paddle-integration' ),
                    'wrap-reverse' => esc_html__( 'Wrap Reverse', 'qs-paddle-integration' ),
                    'nowrap'       => esc_html__( 'No Wrap', 'qs-paddle-integration' ),
                    'unset'        => esc_html__( 'Unset', 'qs-paddle-integration' ),
                    'normal'       => esc_html__( 'None', 'qs-paddle-integration' ),
                    'inherit'      => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],
                'selectors' => [
                    $selector => 'flex-wrap: {{VALUE}};',
                ],
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
            ]

        );

        $this->add_responsive_control(
            $widget . '_section_align_sessctionr_e_' . $element_name . '_flex_align',
            [
                'label'     => esc_html__( 'Alignment', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'flex-start'    => esc_html__( 'Left', 'qs-paddle-integration' ),
                    'flex-end'      => esc_html__( 'Right', 'qs-paddle-integration' ),
                    'center'        => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'space-around'  => esc_html__( 'Space Around', 'qs-paddle-integration' ),
                    'space-between' => esc_html__( 'Space Between', 'qs-paddle-integration' ),
                    'space-evenly'  => esc_html__( 'Space Evenly', 'qs-paddle-integration' ),
                    ''              => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],

                'selectors' => [
                    $selector => 'justify-content: {{VALUE}};',
                ],
            ]

        );

        $this->add_responsive_control(
            $widget . 'er_section_align_items_rssection_e_' . $element_name . '_flex_align',
            [
                'label'     => esc_html__( 'Align Items', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'flex-start' => esc_html__( 'Left', 'qs-paddle-integration' ),
                    'flex-end'   => esc_html__( 'Right', 'qs-paddle-integration' ),
                    'center'     => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'baseline'   => esc_html__( 'Baseline', 'qs-paddle-integration' ),
                    ''           => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],

                'selectors' => [
                    $selector => 'align-items: {{VALUE}};',
                ],
            ]

        );

        $this->add_control(
            $widget . '_section___section_popover_' . $element_name . '_position',
            [
                'label'        => esc_html__( 'Position', 'qs-paddle-integration' ),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => esc_html__( 'Default', 'qs-paddle-integration' ),
                'label_on'     => esc_html__( 'Custom', 'qs-paddle-integration' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();
        $this->add_responsive_control(
            $widget . '_section__' . $element_name . '_position_type',
            [
                'label'     => esc_html__( 'Position', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'fixed'    => esc_html__( 'Fixed', 'qs-paddle-integration' ),
                    'absolute' => esc_html__( 'Absolute', 'qs-paddle-integration' ),
                    'relative' => esc_html__( 'Relative', 'qs-paddle-integration' ),
                    'sticky'   => esc_html__( 'Sticky', 'qs-paddle-integration' ),
                    'static'   => esc_html__( 'Static', 'qs-paddle-integration' ),
                    'inherit'  => esc_html__( 'inherit', 'qs-paddle-integration' ),
                    ''         => esc_html__( 'none', 'qs-paddle-integration' ),
                ],
                'selectors' => [
                    $selector => 'position: {{VALUE}};',
                ],

            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_position_left',
            [
                'label'      => esc_html__( 'Position Left', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1600,
                        'max'  => 1600,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_position_top',
            [
                'label'      => esc_html__( 'Position Top', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1600,
                        'max'  => 1600,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_position_bottom',
            [
                'label'      => esc_html__( 'Position Bottom', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1600,
                        'max'  => 1600,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_position_right',
            [
                'label'      => esc_html__( 'Position Right', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1600,
                        'max'  => 1600,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_popover();

        $this->end_controls_section();
        /*----------------------------
    ELEMENT__STYLE END
    -----------------------------*/
    }
    public function text_minimum_css( $atts ) {

        $atts_variable = shortcode_atts(
            [
                'title'          => esc_html__( 'Text Style', 'qs-paddle-integration' ),
                'slug'           => '_text_style',
                'element_name'   => '__quomodosoft__',
                'selector'       => '{{WRAPPER}} ',
                'hover_selector' => '{{WRAPPER}} ',
                'condition'      => '',
                'tab'            => Controls_Manager::TAB_STYLE,
            ], $atts );

        extract( $atts_variable );

        $widget = $this->get_name() . '_' . qs_paddle_intregration_heading_camelize( $slug );

        /*----------------------------
        ELEMENT__STYLE
        -----------------------------*/

        $tab_start_section_args = [
            'label' => $title,
            'tab'   => $tab,
        ];

        if ( is_array( $condition ) ) {
            $tab_start_section_args['condition'] = $condition;
        }

        $this->start_controls_section(
            $widget . '_style_section',
            $tab_start_section_args
        );

        $this->start_controls_tabs( $widget . '_tabs_style' );
       
        do_action('custom_tab_'.$widget);
        $this->start_controls_tab(
            $widget . '_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'qs-paddle-integration' ),
            ]
        );
    
        do_action('custom_'.$widget);
        // Typgraphy
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => $widget . '_stypography',
                'selector' => $selector,
            ]
        );

        // Icon Color
        $this->add_control(
            $widget . '_text_color',
            [
                'label'     => esc_html__( 'Color', 'qs-paddle-integration' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    $selector => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        //  Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'gens_' . $element_name . '_background',
                'label'    => esc_html__( 'Background', 'qs-paddle-integration' ),
                'types'    => ['classic', 'gradient'],
                'selector' => $selector,
            ]
        );

        // Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'gens_' . $element_name . '_border',
                'label'    => esc_html__( 'Border', 'qs-paddle-integration' ),
                'selector' => $selector,
            ]
        );

        $this->add_responsive_control(
            $widget . '_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    $selector => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin
        $this->add_responsive_control(
            $widget . '_smargin',
            [
                'label'      => esc_html__( 'Margin', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding
        $this->add_responsive_control(
            $widget . '_padding',
            [
                'label'      => esc_html__( 'Padding', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            $widget . '_section___section_show_hide_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Display', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'flex'         => esc_html__( 'Flex', 'qs-paddle-integration' ),
                    'inline-flex'  => esc_html__( 'Inline Flex', 'qs-paddle-integration' ),
                    'block'        => esc_html__( 'Block', 'qs-paddle-integration' ),
                    'inline-block' => esc_html__( 'Inline Block', 'qs-paddle-integration' ),
                    'none'         => esc_html__( 'None', 'qs-paddle-integration' ),
                    ''             => esc_html__( 'Default', 'qs-paddle-integration' ),
                ],
                'selectors' => [
                    $selector => 'display: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            $widget . 'ele_box_transition',
            [
                'label'      => esc_html__( 'Transition', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => 0.1,
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 0.5,
                ],
                'selectors'  => [
                    $selector => 'transition: {{SIZE}}s;',

                ],
            ]
        );

        $this->end_controls_tab();
        // Hover selector
        if ( $hover_selector != false || $hover_selector != '' ) {

            $this->start_controls_tab(
                $widget . '_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'qs-paddle-integration' ),
                ]
            );

            // Icon Color
            $this->add_control(
                $widget . 'hover_text_color',
                [
                    'label'     => esc_html__( 'Color', 'qs-paddle-integration' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '',
                    'selectors' => [
                        $hover_selector => 'color: {{VALUE}} !important;',
                    ],
                ]
            );

            // Hover Background
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'hovers_' . $element_name . '_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-integration' ),
                    'types'    => ['classic', 'gradient'],
                    'selector' => $hover_selector,
                ]
            );

            // Border
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'     => 'hovers_' . $element_name . '_border',
                    'label'    => esc_html__( 'Border', 'qs-paddle-integration' ),
                    'selector' => $hover_selector,
                ]
            );

            $this->end_controls_tab();
        } // hover_select check end
        $this->end_controls_tabs();

        $this->end_controls_section();
        /*----------------------------
    ELEMENT__STYLE END
    -----------------------------*/
    }

}