<?php
/**
 * @package QS Paddle Intregration
 */
namespace QS_Paddle_Integration\base\elementor\style_controls\box;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

trait Widget_Box_Style {

    public function box_minimum_css( $atts ) {

        $atts_variable = shortcode_atts(
            [
                'title'        => esc_html__( 'Box Style', 'qs-paddle-integration' ),
                'slug'         => 'mini_box_style',
                'element_name' => '__quomodosoft__',
                'selector'     => '{{WRAPPER}} ',
                'condition'    => '',
                'tab'          => Controls_Manager::TAB_STYLE,

            ], $atts );

        extract( $atts_variable );

        $widget = $this->get_name() . '_' . qs_paddle_intregration_heading_camelize( $slug );

        $tab_start_section_args = [
            'label' => $title,
            'tab'   => $tab,
        ];

        if ( is_array( $condition ) ) {
            $tab_start_section_args['condition'] = $condition;
        }

        /*----------------------------
        ELEMENT__STYLE
        -----------------------------*/
        $this->start_controls_section(
            $widget . '_style_section',
            $tab_start_section_args
        );

        $this->start_controls_tabs( $widget . '_tabs_style' );
        $this->start_controls_tab(
            $widget . '_normal_tab',
            [
                'label' => esc_html__( 'Style', 'qs-paddle-integration' ),
            ]
        );

        // Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => $widget . '_background',
                'label'    => esc_html__( 'Background', 'qs-paddle-integration' ),
                'types'    => ['classic', 'gradient'],
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

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            $widget . '_section___section_show_hide_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Display', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'flex'         => esc_html__( 'Flex Layout', 'qs-paddle-integration' ),
                    'block'        => esc_html__( 'Block Layout', 'qs-paddle-integration' ),
                    'inline-block' => esc_html__( 'Inline Layout', 'qs-paddle-integration' ),
                    'none'         => esc_html__( 'None', 'qs-paddle-integration' ),
                    ''             => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],
                'selectors' => [
                    $selector => 'display: {{VALUE}};',
                ],
            ]

        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_flex_basis',
            [
                'label'      => esc_html__( 'Item Width', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['inherit']],
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
            $widget . 'main_section_' . $element_name . '_flex_order',
            [
                'label'      => esc_html__( 'Item Order', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex', 'inherit', 'initial', 'grid']],
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

        $this->end_controls_section();
        /*----------------------------
    ELEMENT__STYLE END
    -----------------------------*/
    }
    public function box_css( $atts ) {

        $atts_variable = shortcode_atts(
            [
                'title'        => esc_html__( 'Box Style', 'qs-paddle-integration' ),
                'slug'         => '_box_style',
                'element_name' => 'woo_ready__',
                'selector'     => '{{WRAPPER}} ',
                'condition'    => '',
                'tab'          => Controls_Manager::TAB_STYLE,

            ], $atts );

        extract( $atts_variable );

        $widget = $this->get_name() . '_' . qs_paddle_intregration_heading_camelize( $slug );

        $tab_start_section_args = [
            'label' => $title,
            'tab'   => $tab,
        ];

        if ( is_array( $condition ) ) {
            $tab_start_section_args['condition'] = $condition;
        }

        /*----------------------------
        ELEMENT__STYLE
        -----------------------------*/
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

        do_action('custom_'.$widget);
        // Background
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => $widget . '_background',
                'label'    => esc_html__( 'Background', 'qs-paddle-integration' ),
                'types'    => ['classic', 'gradient'],
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
                'name'     => $widget . '_shadow',
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

        $this->end_controls_tab();


        $this->start_controls_tab(
            $widget . '_positionl_tab',
            [
                'label' => esc_html__( 'Position', 'qs-paddle-integration' ),
            ]
        );

        $this->add_responsive_control(
            $widget.'_section__' . $element_name . '_position_type',
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
            $widget.'wrain_section_'.$element_name.'_position_left',
            [
                'label'      => esc_html__( 'Position Left', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -3000,
                        'max'  => 3000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],

                'selectors'  => [
                    $selector => 'left: {{SIZE}}{{UNIT}};'

                ],
            ]
        );

        $this->add_responsive_control(
            $widget.'main_section_' . $element_name . '_r_position_top',
            [
                'label'      => esc_html__( 'Position Top', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -3000,
                        'max'  => 3000,
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
            $widget.'main_section_' . $element_name . '_r_position_bottom',
            [
                'label'      => esc_html__( 'Position Bottom', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -2100,
                        'max'  => 3000,
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
            $widget.'main_section_' . $element_name . '_r_position_right',
            [
                'label'      => esc_html__( 'Position Right', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1600,
                        'max'  => 3000,
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
                    $widget . 'main_section_' . $element_name . '_r_section__width',
                    [
                        'label'      => esc_html__( 'Width', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%', 'vw'],
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
                    $widget . 'main_section_' . $element_name . '_r_container_height',
                    [
                        'label'      => esc_html__( 'Height', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%', 'vh'],
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
                            $selector => 'height: {{SIZE}}{{UNIT}};',

                        ],
                    ]
                );

                $this->add_responsive_control(
                    $widget . 'main_section_' . $element_name . '_r_section_min__width',
                    [
                        'label'      => esc_html__( 'Min Width', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%', 'vw'],
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
                    $widget . 'main_section_' . $element_name . '_r_section_max__width',
                    [
                        'label'      => esc_html__( 'Max Width', 'qs-paddle-integration' ),
                        'type'       => Controls_Manager::SLIDER,
                        'size_units' => ['px', '%', 'vh'],
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

        $this->end_controls_tab();
        do_action('custom_tab_'.$widget);
      
        $this->end_controls_tabs();

        $this->add_responsive_control(
            $widget . '_section___section_show_hide_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Display', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'flex'          => esc_html__( 'Flex Layout', 'qs-paddle-integration' ),
                    'inherit'       => esc_html__( 'Flex Child Layout', 'qs-paddle-integration' ),
                    'inline-flex'   => esc_html__( 'Inline Flex Layout', 'qs-paddle-integration' ),
                    'block'         => esc_html__( 'Block Layout', 'qs-paddle-integration' ),
                    'inline-block'  => esc_html__( 'Inline Layout', 'qs-paddle-integration' ),
                    'grid'          => esc_html__( 'Grid Layout', 'qs-paddle-integration' ),
                    'inline-grid'   => esc_html__( 'Grid Inline Layout', 'qs-paddle-integration' ),
                    'initial'       => esc_html__( 'Grid Child Layout', 'qs-paddle-integration' ),
                    'table-caption' => esc_html__( 'Table Layout', 'qs-paddle-integration' ),
                    'flow-root'     => esc_html__( 'Flow Layout', 'qs-paddle-integration' ),
                    'none'          => esc_html__( 'None', 'qs-paddle-integration' ),
                    ''              => esc_html__( 'inherit', 'qs-paddle-integration' ),
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
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['inherit']],
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
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex', 'inherit']],
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
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex', 'inherit']],
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
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex', 'inherit', 'initial', 'grid']],
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
            $widget . 'main_section_' . $element_name . '_flex_gap',
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
            $widget . '_section___section_flex_wrap_' . $element_name . '_display',
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
            $widget . '_section_align_section_e_' . $element_name . '_flex_align',
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
            $widget . '_section_align_items_section_e_' . $element_name . '_flex_align',
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

        // grid

        $this->add_responsive_control(
            $widget . '_section_align_items_section_e_' . $element_name . '_grid_align_items',
            [
                'label'     => esc_html__( 'Place Items', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'left',
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['grid', 'inline-grid']],
                'options'   => [
                    'start'                => esc_html__( 'Left/ Start', 'qs-paddle-integration' ),
                    'end'                  => esc_html__( 'Right / End', 'qs-paddle-integration' ),
                    'center'               => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'center start'         => esc_html__( 'center Left', 'qs-paddle-integration' ),
                    'center end'           => esc_html__( 'center end', 'qs-paddle-integration' ),
                    'center stretch'       => esc_html__( 'center stretch', 'qs-paddle-integration' ),
                    'end space-between'    => esc_html__( 'end space-between', 'qs-paddle-integration' ),
                    'start space-between'  => esc_html__( 'left space-between', 'qs-paddle-integration' ),
                    'center space-between' => esc_html__( 'center space-between', 'qs-paddle-integration' ),
                    'center space-evenly'  => esc_html__( 'center space-evenly', 'qs-paddle-integration' ),
                    'start space-evenly'   => esc_html__( 'start space-evenly', 'qs-paddle-integration' ),
                    'end space-evenly'     => esc_html__( 'end space-evenly', 'qs-paddle-integration' ),

                    ''                     => esc_html__( 'default', 'qs-paddle-integration' ),
                ],

                'selectors' => [
                    $selector => 'place-items: {{VALUE}};',
                ],
            ]

        );

        $this->add_responsive_control(
            $widget . '_section_align_items_section_e_' . $element_name . '_grid_align_place_content',
            [
                'label'     => esc_html__( 'Place Content', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'center',
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['grid', 'inline-grid']],
                'options'   => [
                    'start'                => esc_html__( 'Start / Left', 'qs-paddle-integration' ),
                    'end'                  => esc_html__( 'Right / End', 'qs-paddle-integration' ),
                    'center'               => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'center start'         => esc_html__( 'center Left', 'qs-paddle-integration' ),
                    'center end'           => esc_html__( 'center end', 'qs-paddle-integration' ),
                    'center stretch'       => esc_html__( 'center stretch', 'qs-paddle-integration' ),
                    'end space-between'    => esc_html__( 'end space-between', 'qs-paddle-integration' ),
                    'start space-between'  => esc_html__( 'left space-between', 'qs-paddle-integration' ),
                    'center space-between' => esc_html__( 'center space-between', 'qs-paddle-integration' ),
                    'center space-evenly'  => esc_html__( 'center space-evenly', 'qs-paddle-integration' ),
                    'start space-evenly'   => esc_html__( 'start space-evenly', 'qs-paddle-integration' ),
                    'end space-evenly'     => esc_html__( 'end space-evenly', 'qs-paddle-integration' ),

                    ''                     => esc_html__( 'default', 'qs-paddle-integration' ),
                ],

                'selectors' => [
                    $selector => 'place-content: {{VALUE}};',
                ],
            ]

        );

        $this->add_responsive_control(
            $widget . '_section_align_items_section_e_' . $element_name . '_grid_justify_items_align',
            [
                'label'     => esc_html__( 'Place Self Column', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'left',
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['inline-grid', 'initial']],
                'options'   => [
                    'start auto'           => esc_html__( 'Start / Left', 'qs-paddle-integration' ),
                    'end normal'           => esc_html__( 'End / Right', 'qs-paddle-integration' ),
                    'center normal'        => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'baseline normal'      => esc_html__( 'Baseline', 'qs-paddle-integration' ),
                    'stretch auto'         => esc_html__( 'Stretch', 'qs-paddle-integration' ),
                    'first baseline auto'  => esc_html__( 'First Base', 'qs-paddle-integration' ),
                    'last baseline normal' => esc_html__( 'last baseline normal', 'qs-paddle-integration' ),
                    'space-between'        => esc_html__( 'space-between', 'qs-paddle-integration' ),
                    ''                     => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],

                'selectors' => [
                    $selector => 'place-self: {{VALUE}};',
                ],
            ]

        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_grid_cols_gap',
            [
                'label'      => esc_html__( 'Columns Gap', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['grid', 'inline-grid']],
                'size_units' => ['px'],
                'range'      => [

                    'px' => [
                        'min'  => 0,
                        'max'  => 800,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'column-gap: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_grid_row_gap',
            [
                'label'      => esc_html__( 'Row Gap', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['grid', 'inline-grid']],
                'size_units' => ['px'],
                'range'      => [

                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'row-gap: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_grid_col',
            [
                'label'      => esc_html__( 'Column', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['grid', 'inline-grid']],
                'size_units' => ['px'],
                'range'      => [

                    'px' => [
                        'min'  => 0,
                        'max'  => 10,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'grid-template-columns: repeat( {{SIZE}}, 1fr);',

                ],
            ]
        );


        $this->end_controls_section();
        /*----------------------------
    ELEMENT__STYLE END
    -----------------------------*/
    }

    public function box_layout( $atts ) {

        $atts_variable = shortcode_atts(
            [
                'title'        => esc_html__( 'Box Layout', 'qs-paddle-integration' ),
                'slug'         => '_layout_style',
                'element_name' => '__mangocube__',
                'selector'     => '{{WRAPPER}} ',
                'condition'    => '',

            ], $atts );

        extract( $atts_variable );

        $widget = $this->get_name() . '_' . qs_paddle_intregration_heading_camelize( $slug );

        $tab_start_section_args = [
            'label' => $title,
            'tab'   => Controls_Manager::TAB_LAYOUT,
        ];

        if ( is_array( $condition ) ) {
            $tab_start_section_args['condition'] = $condition;
        }

        /*----------------------------
        ELEMENT__STYLE
        -----------------------------*/
        $this->start_controls_section(
            $widget . '_style_section',
            $tab_start_section_args
        );

        $this->add_responsive_control(
            $widget . '_section___section_show_hide_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Display', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '',
                'options'   => [
                    'flex'          => esc_html__( 'Flex Layout', 'qs-paddle-integration' ),
                    'inherit'       => esc_html__( 'Flex Child Layout', 'qs-paddle-integration' ),
                    'inline-flex'   => esc_html__( 'Inline Flex Layout', 'qs-paddle-integration' ),
                    'block'         => esc_html__( 'Block Layout', 'qs-paddle-integration' ),
                    'inline-block'  => esc_html__( 'Inline Layout', 'qs-paddle-integration' ),
                    'grid'          => esc_html__( 'Grid Layout', 'qs-paddle-integration' ),
                    'inline-grid'   => esc_html__( 'Grid Inline Layout', 'qs-paddle-integration' ),
                    'initial'       => esc_html__( 'Grid Child Layout', 'qs-paddle-integration' ),
                    'table-caption' => esc_html__( 'Table Layout', 'qs-paddle-integration' ),
                    'flow-root'     => esc_html__( 'Flow Layout', 'qs-paddle-integration' ),
                    'none'          => esc_html__( 'None', 'qs-paddle-integration' ),
                    ''              => esc_html__( 'inherit', 'qs-paddle-integration' ),
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
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
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

            ]

        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_flex_basis',
            [
                'label'      => esc_html__( 'Item Width', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['inherit']],
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
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex', 'inherit']],
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
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex', 'inherit']],
                'size_units' => ['px'],
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
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['inherit']],
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -30,
                        'max'  => 100,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'order: {{SIZE}}',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_flex_gap',
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
            $widget . '_section___section_flex_wrap_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Flex Wrap', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'wrap',
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
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

            ]

        );

        $this->add_responsive_control(
            $widget . '_section_align_section_e_' . $element_name . '_flex_align',
            [
                'label'     => esc_html__( 'Alignment', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'flex-start',
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
                'options'   => [
                    'flex-start'    => esc_html__( 'Left', 'qs-paddle-integration' ),
                    'flex-end'      => esc_html__( 'Right', 'qs-paddle-integration' ),
                    'center'        => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'space-around'  => esc_html__( 'Space Around', 'qs-paddle-integration' ),
                    'space-between' => esc_html__( 'Space Between', 'qs-paddle-integration' ),
                    'space-evenly'  => esc_html__( 'Space Evenly', 'qs-paddle-integration' ),
                    ''              => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],

                'selectors' => [
                    $selector => 'justify-content: {{VALUE}};',
                ],
            ]

        );

        $this->add_responsive_control(
            $widget . '_section_align_items_section_e_' . $element_name . '_flex_align',
            [
                'label'     => esc_html__( 'Align Items', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'left',
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
                'options'   => [
                    'flex-start' => esc_html__( 'Left', 'qs-paddle-integration' ),
                    'flex-end'   => esc_html__( 'Right', 'qs-paddle-integration' ),
                    'center'     => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'baseline'   => esc_html__( 'Baseline', 'qs-paddle-integration' ),
                    ''           => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],

                'selectors' => [
                    $selector => 'align-items: {{VALUE}};',
                ],
            ]

        );
        // grid

        $this->add_responsive_control(
            $widget . '_section_al_items_section_e_' . $element_name . '_grid_align_items',
            [
                'label'     => esc_html__( 'Place Items', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'left',
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['grid', 'inline-grid']],
                'options'   => [
                    'start'                => esc_html__( 'Left/ Start', 'qs-paddle-integration' ),
                    'end'                  => esc_html__( 'Right / End', 'qs-paddle-integration' ),
                    'center'               => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'center start'         => esc_html__( 'center Left', 'qs-paddle-integration' ),
                    'center end'           => esc_html__( 'center end', 'qs-paddle-integration' ),
                    'center stretch'       => esc_html__( 'center stretch', 'qs-paddle-integration' ),
                    'end space-between'    => esc_html__( 'end space-between', 'qs-paddle-integration' ),
                    'start space-between'  => esc_html__( 'left space-between', 'qs-paddle-integration' ),
                    'center space-between' => esc_html__( 'center space-between', 'qs-paddle-integration' ),
                    'center space-evenly'  => esc_html__( 'center space-evenly', 'qs-paddle-integration' ),
                    'start space-evenly'   => esc_html__( 'start space-evenly', 'qs-paddle-integration' ),
                    'end space-evenly'     => esc_html__( 'end space-evenly', 'qs-paddle-integration' ),

                    ''                     => esc_html__( 'default', 'qs-paddle-integration' ),
                ],

                'selectors' => [
                    $selector => 'place-items: {{VALUE}};',
                ],
            ]

        );

        $this->add_responsive_control(
            $widget . '_section_al_items_section_e_' . $element_name . '_grid_align_place_content',
            [
                'label'     => esc_html__( 'Place Content', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'center',
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['grid', 'inline-grid']],
                'options'   => [
                    'start'                => esc_html__( 'Start / Left', 'qs-paddle-integration' ),
                    'end'                  => esc_html__( 'Right / End', 'qs-paddle-integration' ),
                    'center'               => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'center start'         => esc_html__( 'center Left', 'qs-paddle-integration' ),
                    'center end'           => esc_html__( 'center end', 'qs-paddle-integration' ),
                    'center stretch'       => esc_html__( 'center stretch', 'qs-paddle-integration' ),
                    'end space-between'    => esc_html__( 'end space-between', 'qs-paddle-integration' ),
                    'start space-between'  => esc_html__( 'left space-between', 'qs-paddle-integration' ),
                    'center space-between' => esc_html__( 'center space-between', 'qs-paddle-integration' ),
                    'center space-evenly'  => esc_html__( 'center space-evenly', 'qs-paddle-integration' ),
                    'start space-evenly'   => esc_html__( 'start space-evenly', 'qs-paddle-integration' ),
                    'end space-evenly'     => esc_html__( 'end space-evenly', 'qs-paddle-integration' ),

                    ''                     => esc_html__( 'default', 'qs-paddle-integration' ),
                ],

                'selectors' => [
                    $selector => 'place-content: {{VALUE}};',
                ],
            ]

        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_grid_cols_gap',
            [
                'label'      => esc_html__( 'Column Gap', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['initial', 'grid', 'inline-grid']],
                'size_units' => ['px'],
                'range'      => [

                    'px' => [
                        'min'  => 0,
                        'max'  => 800,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'column-gap: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_grid_row_gap',
            [
                'label'      => esc_html__( 'Row Gap', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['grid', 'inline-grid']],
                'size_units' => ['px'],
                'range'      => [

                    'px' => [
                        'min'  => 0,
                        'max'  => 500,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'row-gap: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_grid_col',
            [
                'label'      => esc_html__( 'Column', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['grid', 'inline-grid', 'initial']],
                'size_units' => ['px'],
                'range'      => [

                    'px' => [
                        'min'  => 0,
                        'max'  => 10,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'grid-template-columns: repeat( {{SIZE}}, 1fr);',

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
                        'min'  => -5000,
                        'max'  => 3000,
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
                        'min'  => -3000,
                        'max'  => 3000,
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
                        'min'  => -2500,
                        'max'  => 3000,
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
                        'min'  => -2600,
                        'max'  => 3000,
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

        $this->add_control(
            $widget . 'main_section_' . $element_name . '_rbox_popover_section_sizen',
            [
                'label'        => esc_html__( 'Box Size', 'qs-paddle-integration' ),
                'type'         => \Elementor\Controls_Manager::POPOVER_TOGGLE,
                'label_off'    => esc_html__( 'Default', 'qs-paddle-integration' ),
                'label_on'     => esc_html__( 'Custom', 'qs-paddle-integration' ),
                'return_value' => 'yes',

            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_r_section__width',
            [
                'label'      => esc_html__( 'Width', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
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
            $widget . 'main_section_' . $element_name . '_r_container_height',
            [
                'label'      => esc_html__( 'Height', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
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
                    $selector => 'height: {{SIZE}}{{UNIT}};',

                ],
            ]
        );

        $this->end_popover();

        $this->end_controls_section();
        /*----------------------------
    ELEMENT__STYLE END
    -----------------------------*/
    }
    public function box_layout_child( $atts ) {

        $atts_variable = shortcode_atts(
            [
                'title'        => esc_html__( 'Box Layout', 'qs-paddle-integration' ),
                'slug'         => '_layout_style',
                'element_name' => '__mangocube__',
                'selector'     => '{{WRAPPER}} ',
                'condition'    => '',

            ], $atts );

        extract( $atts_variable );

        $widget = $this->get_name() . '_' . qs_paddle_intregration_heading_camelize( $slug );

        $tab_start_section_args = [
            'label' => $title,
            'tab'   => Controls_Manager::TAB_LAYOUT,
        ];

        if ( is_array( $condition ) ) {
            $tab_start_section_args['condition'] = $condition;
        }

        /*----------------------------
        ELEMENT__STYLE
        -----------------------------*/
        $this->start_controls_section(
            $widget . '_style_section',
            $tab_start_section_args
        );

        $this->add_responsive_control(
            $widget . '_section___section_show_hide_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Display', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'inherit',
                'options'   => [
                    'inherit'      => esc_html__( 'Flex Child Layout', 'qs-paddle-integration' ),
                    'flex'         => esc_html__( 'Flex Layout', 'qs-paddle-integration' ),
                    'inline-flex'  => esc_html__( 'Inline Flex Layout', 'qs-paddle-integration' ),
                    'block'        => esc_html__( 'Block Layout', 'qs-paddle-integration' ),
                    'inline-block' => esc_html__( 'Inline Layout', 'qs-paddle-integration' ),
                    'none'         => esc_html__( 'None', 'qs-paddle-integration' ),
                    ''             => esc_html__( 'inherit', 'qs-paddle-integration' ),
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
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
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

            ]

        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_flex_basis',
            [
                'label'      => esc_html__( 'Item Width', 'qs-paddle-integration' ),
                'type'       => Controls_Manager::SLIDER,
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['inherit']],
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
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex', 'inherit']],
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
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex', 'inherit']],
                'size_units' => ['px'],
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
                'condition'  => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['inherit']],
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min'  => -30,
                        'max'  => 100,
                        'step' => 1,
                    ],

                ],

                'selectors'  => [
                    $selector => 'order: {{SIZE}}',

                ],
            ]
        );

        $this->add_responsive_control(
            $widget . 'main_section_' . $element_name . '_flex_gap',
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
            $widget . '_section___section_flex_wrap_' . $element_name . '_display',
            [
                'label'     => esc_html__( 'Flex Wrap', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'wrap',
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
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

            ]

        );

        $this->add_responsive_control(
            $widget . '_section_align_section_e_' . $element_name . '_flex_align',
            [
                'label'     => esc_html__( 'Alignment', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'flex-start',
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
                'options'   => [
                    'flex-start'    => esc_html__( 'Left', 'qs-paddle-integration' ),
                    'flex-end'      => esc_html__( 'Right', 'qs-paddle-integration' ),
                    'center'        => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'space-around'  => esc_html__( 'Space Around', 'qs-paddle-integration' ),
                    'space-between' => esc_html__( 'Space Between', 'qs-paddle-integration' ),
                    'space-evenly'  => esc_html__( 'Space Evenly', 'qs-paddle-integration' ),
                    ''              => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],

                'selectors' => [
                    $selector => 'justify-content: {{VALUE}};',
                ],
            ]

        );

        $this->add_responsive_control(
            $widget . '_section_align_items_section_e_' . $element_name . '_flex_align',
            [
                'label'     => esc_html__( 'Align Items', 'qs-paddle-integration' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => 'left',
                'condition' => [$widget . '_section___section_show_hide_' . $element_name . '_display' => ['flex', 'inline-flex']],
                'options'   => [
                    'flex-start' => esc_html__( 'Left', 'qs-paddle-integration' ),
                    'flex-end'   => esc_html__( 'Right', 'qs-paddle-integration' ),
                    'center'     => esc_html__( 'Center', 'qs-paddle-integration' ),
                    'baseline'   => esc_html__( 'Baseline', 'qs-paddle-integration' ),
                    ''           => esc_html__( 'inherit', 'qs-paddle-integration' ),
                ],

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

}