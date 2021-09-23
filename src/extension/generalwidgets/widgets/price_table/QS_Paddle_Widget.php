<?php

namespace QS_Paddle_Integration\extension\generalwidgets\widgets\price_table;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Modules\DynamicTags\Module as TagsModule;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class QS_Paddle_Widget extends \QS_Paddle_Integration\extension\generalwidgets\Widget_Base {
   

    public function content_layout_style() {
        return apply_filters( 'qs_paddle_integration_table_style_presets', [
            '1'  => esc_html__( 'Style One', 'qs-paddle-intregration' ),
            '2'  => esc_html__( 'Style Two', 'qs-paddle-intregration' ),
            '3'  => esc_html__( 'Style Three ', 'qs-paddle-intregration' ),
            '4'  => esc_html__( 'Style Four ', 'qs-paddle-intregration' ),
            '5'  => esc_html__( 'Style Five', 'qs-paddle-intregration' ),
            '6'  => esc_html__( 'Style Six ', 'qs-paddle-intregration' ),
            '7'  => esc_html__( 'Style Seven', 'qs-paddle-intregration' ),
            '8'  => esc_html__( 'Style Eight', 'qs-paddle-intregration' ),
            '9'  => esc_html__( 'Style Nine', 'qs-paddle-intregration' ),
            '10' => esc_html__( 'Style Ten ', 'qs-paddle-intregration' ),
            '11' => esc_html__( 'Style Eleven', 'qs-paddle-intregration' ),
            '12' => esc_html__( 'Style Twelve ', 'qs-paddle-intregration' ),
            '13' => esc_html__( 'Style Thirteen', 'qs-paddle-intregration' ),
        ]);
    }

    protected function _register_controls() {

        /*---------------------------
            PRICE LAYOUT
        -----------------------------*/
        $this->start_controls_section(
            'element_ready_pricing_layout',
            [
                'label' => esc_html__( 'Layout', 'qs-paddle-intregration' ),
            ]
        );
            $this->add_control(
                'content_layout_style',
                [
                    'label'   => esc_html__( 'Style', 'qs-paddle-intregration' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => $this->content_layout_style(),
                ]
            );
            $this->add_control(
                'element_ready_show_features_icon',
                [
                    'label'        => esc_html__( 'Show Features Icon', 'qs-paddle-intregration' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'separator'   => 'before',
                ]
            );
            $this->add_control(
                'element_ready_active_price',
                [
                    'label'        => esc_html__( 'Active Price Plan', 'qs-paddle-intregration' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default'      => 'no',
                    'separator'   => 'before',
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            LAYOUT TAB END
        -----------------------------*/

        /*----------------------------
            PRICE RIBBON
        -----------------------------*/
        $this->start_controls_section(
            'element_ready_pricing_ribbon',
            [
                'label' => esc_html__( 'Ribbon', 'qs-paddle-intregration' ),
            ]
        );
            $this->add_control(
                'element_ready_ribon_pricing_table',
                [
                    'label'        => esc_html__( 'Ribon', 'qs-paddle-intregration' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                ]
            );
            $this->add_control(
                'ribon_type',
                [
                    'label'   => esc_html__('Ribon Type','qs-paddle-intregration'),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'text' =>[
                            'title' => esc_html__('Text','qs-paddle-intregration'),
                            'icon'  => 'fa fa-font',
                        ],
                        'img' =>[
                            'title' => esc_html__('Image','qs-paddle-intregration'),
                            'icon'  => 'fa fa-picture-o',
                        ],
                        'font' =>[
                            'title' => esc_html__('Font Icon','qs-paddle-intregration'),
                            'icon'  => 'fa fa-info',
                        ],
                    ],
                    'default'   => 'text',
                    'condition' => [
                        'element_ready_ribon_pricing_table' => 'yes'
                    ]
                ]
            );
            $this->add_control(
                'ribon_font_icon',
                [
                    'label'     => esc_html__( 'Font Icons', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::ICON,
                    'label_block' => true,
                    'default'   => 'fa fa-star',
                    'condition' => [
                        'ribon_type' => 'font',
                        'element_ready_ribon_pricing_table' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'ribon_image_icon',
                [
                    'label'   => esc_html__( 'Image Icon / Image', 'qs-paddle-intregration' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'ribon_type' => 'img',
                        'element_ready_ribon_pricing_table' => 'yes',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name'      => 'ribon_image_size',
                    'default'   => 'thumbnail',
                    'condition' => [
                        'ribon_type' => 'img',
                        'element_ready_ribon_pricing_table' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'ribon_text_icon',
                [
                    'label'       => esc_html__( 'Ribon Text', 'qs-paddle-intregration' ),
                    'type'        => Controls_Manager::TEXT,
                    'condition'   => [
                        'ribon_type' => 'text',
                        'element_ready_ribon_pricing_table' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'element_ready_ribon_position',
                [
                    'label'   => esc_html__('Ribon Position','qs-paddle-intregration'),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' =>[
                            'title' => esc_html__('left','qs-paddle-intregration'),
                            'icon'  => 'fa fa-align-left',
                        ],
                        'center' =>[
                            'title' => esc_html__('Center','qs-paddle-intregration'),
                            'icon'  => 'fa fa-align-center',
                        ],
                        'right' =>[
                            'title' => esc_html__('Right','qs-paddle-intregration'),
                            'icon'  => 'fa fa-align-right',
                        ]
                    ],
                    'default'   => '',
                    'condition' => [
                        'element_ready_ribon_pricing_table' => 'yes'
                    ],
                    'separator'   => 'before',
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            RIBBON TAB END
        ------------------------------*/

        /*----------------------------
            HEADER FIELDS TAB START
        ------------------------------*/
        $this->start_controls_section(
            'element_ready_pricing_header',
            [
                'label' => esc_html__( 'Header', 'qs-paddle-intregration' ),
            ]
        );
        
            $this->add_control(
                'pricing_title',
                [
                    'label'       => esc_html__( 'Title', 'qs-paddle-intregration' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Standard', 'qs-paddle-intregration' ),
                    'default'     => esc_html__( 'Standard', 'qs-paddle-intregration' ),
                    'title'       => esc_html__( 'Enter your service title', 'qs-paddle-intregration' ),
                ]
            );
            $this->add_control(
                'subtitle',
                [
                    'label'       => esc_html__( 'Subtitle', 'qs-paddle-intregration' ),
                    'type'        => Controls_Manager::TEXT,
                    'placeholder' => esc_html__( 'Subtitle', 'qs-paddle-intregration' ),
                    'separator'   => 'before',
                ]
            );
            $this->add_control(
                'subtitle_position',
                [
                    'label'   => esc_html__( 'Subtitle Position', 'qs-paddle-intregration' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'after_title',
                    'options' => [
                        'before_title' => esc_html__( 'Before title', 'qs-paddle-intregration' ),
                        'after_title'  => esc_html__( 'After Title', 'qs-paddle-intregration' ),
                    ],
                    'condition' => [
                        'subtitle!' => '',
                    ]
                ]
            );

            $this->add_control(
                'element_ready_header_icon_type',
                [
                    'label'   => esc_html__('Image or Icon','qs-paddle-intregration'),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'img' =>[
                            'title' => esc_html__('Image','qs-paddle-intregration'),
                            'icon'  => 'fa fa-picture-o',
                        ],
                        'icon' =>[
                            'title' => esc_html__('Icon','qs-paddle-intregration'),
                            'icon'  => 'fa fa-info',
                        ]
                    ],
                    'default'   => 'img',
                    'condition' => [
                        'content_layout_style' => ['2','13'],
                    ]
                ]
            );

            $this->add_control(
                'headerimage',
                [
                    'label'   => esc_html__('Image','qs-paddle-intregration'),
                    'type'    => Controls_Manager::MEDIA,
                    'dynamic' => [
                        'active' => true,
                    ],
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    
                    'condition' => [
                        'content_layout_style'    => ['2','13'],
                        'element_ready_header_icon_type' => 'img',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size:: get_type(),
                [
                    'name'      => 'headerimagesize',
                    'default'   => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'content_layout_style'    => ['2','13'],
                        'element_ready_header_icon_type' => 'img',
                    ]
                ]
            );

            $this->add_control(
                'headericon',
                [
                    'label'     => esc_html__('Icon','qs-paddle-intregration'),
                    'type'      => Controls_Manager::ICON,
                    'label_block' => true,
                    'default'   => 'fa fa-pencil',
                    'condition' => [
                        'content_layout_style'    => ['2','13'],
                        'element_ready_header_icon_type' => 'icon',
                    ]
                ]
            );

        $this->end_controls_section();
        /*---------------------------
            HEADER FIELDS TAB END
        ------------------------------*/

        /*----------------------------
           PRICING FIELDS TAB START
        ------------------------------*/
        $this->box_css(
            array(
               'title' => esc_html__('Inner Box','qs-paddle-intregration'),
               'slug' => 'item_tab_wrapper_box_style',
               'element_name' => 'item_wrapper_element_ready_',
               'selector' => '{{WRAPPER}} .single__price',
               'condition' => [
                   'content_layout_style' => ['11']
               ]
               
            )
        );

        $this->start_controls_section(
            'element_ready_price_column_order__section',
            [
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
                'label' => esc_html__( 'Item Order', 'qs-paddle-intregration' ),
                'condition' => [
                    'content_layout_style' => ['11']
                ]
            ]
        );
      
            $this->add_responsive_control(
              'element_raedy_column_rate_widget_order_',
              [
                'label' => esc_html__( 'Price rate Order', 'qs-paddle-intregration' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                  'px' => [
                    'min'  => -100,
                    'max'  => 100,
                    'step' => 1,
                  ],
                  
                ],
                
                'selectors' => [
                  '{{WRAPPER}} .price__rate' => 'order: {{SIZE}};',
                ],
              ]
            ); 
            
            $this->add_responsive_control(
              'element_raedy_single__price__header_widget_order_',
              [
                'label' => esc_html__( 'title Order', 'qs-paddle-intregration' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                  'px' => [
                    'min'  => -100,
                    'max'  => 100,
                    'step' => 1,
                  ],
                  
                ],
                
                'selectors' => [
                  '{{WRAPPER}} .single__price__header' => 'order: {{SIZE}};',
                ],
              ]
            );
            
            $this->add_responsive_control(
              'element_raedy_single__price__bodyheader_widget_order_',
              [
                'label' => esc_html__( 'Body Order', 'qs-paddle-intregration' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                  'px' => [
                    'min'  => -100,
                    'max'  => 100,
                    'step' => 1,
                  ],
                  
                ],
                
                'selectors' => [
                  '{{WRAPPER}} .single__price__body' => 'order: {{SIZE}};',
                ],
              ]
            );
            
            $this->add_responsive_control(
              'element_raedy_single__price__footer_widget_order_',
              [
                'label' => esc_html__( 'Footer Order', 'qs-paddle-intregration' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                  'px' => [
                    'min'  => -100,
                    'max'  => 100,
                    'step' => 1,
                  ],
                  
                ],
                
                'selectors' => [
                  '{{WRAPPER}} .single__price__footer' => 'order: {{SIZE}};',
                ],
              ]
            );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'element_ready_pricing_price',
            [
                'label' => esc_html__( 'Pricing', 'qs-paddle-intregration' ),
            ]
        );
            
            $this->add_control(
                'element_ready_custom_product_id',
                [
                    'label'   => esc_html__( 'Custom Product id (optional)', 'qs-paddle-intregration' ),
                    'type'    => Controls_Manager::TEXT,
                ]
            );

            $this->add_control(
                'price_woocommerce_product_id',
                [
                    'label'         => esc_html__( 'Woocommerce Product id', 'qs-paddle-intregration' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                    'multiple' => false,
                    
                    'default' => '',
                    'options' => qs_paddle_intregration_wc_get_products()
                ]
            );
                         
            $this->add_control(
                'paddle_product',
                [
                    'label' => __( 'Paddle Product', 'qs-paddle-intregration' ),
                    'type' => \Elementor\Controls_Manager::SELECT2,
                    'multiple' => false,
                    'description'=> 'paddle product cache will update in 1 hour',
                    'default' => '',
                    'options' => qs_paddle_intregration_get_paddle_products()
                ]
            );

            $this->add_control(
                'element_ready_price',
                [
                    'label'    => esc_html__( 'Price', 'qs-paddle-intregration' ),
                    'type'     => Controls_Manager::TEXT,
                    'default'  => '35.50',
                    'separtor' => 'before',
                ]
            );

            $this->add_control(
                'element_ready_offer_price',
                [
                    'label'        => esc_html__( 'Offer', 'qs-paddle-intregration' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                ]
            );

            $this->add_control(
                'element_ready_original_price',
                [
                    'label'     => esc_html__( 'Original Price', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::NUMBER,
                    'default'   => '49',
                    'condition' => [
                        'element_ready_offer_price' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'element_ready_currency_symbol',
                [
                    'label'   => esc_html__( 'Currency Symbol', 'qs-paddle-intregration' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        ''             => esc_html__( 'None', 'qs-paddle-intregration' ),
                        'dollar'       => '&#36; ' . esc_html__( 'Dollar', 'qs-paddle-intregration' ),
                        'euro'         => '&#128; ' . esc_html__( 'Euro', 'qs-paddle-intregration' ),
                        'baht'         => '&#3647; ' . esc_html__( 'Baht', 'qs-paddle-intregration' ),
                        'franc'        => '&#8355; ' . esc_html__( 'Franc', 'qs-paddle-intregration' ),
                        'guilder'      => '&fnof; ' . esc_html__( 'Guilder', 'qs-paddle-intregration' ),
                        'krona'        => 'kr ' . esc_html__( 'Krona', 'qs-paddle-intregration' ),
                        'lira'         => '&#8356; ' . esc_html__( 'Lira', 'qs-paddle-intregration' ),
                        'peseta'       => '&#8359 ' . esc_html__( 'Peseta', 'qs-paddle-intregration' ),
                        'peso'         => '&#8369; ' . esc_html__( 'Peso', 'qs-paddle-intregration' ),
                        'pound'        => '&#163; ' . esc_html__( 'Pound Sterling', 'qs-paddle-intregration' ),
                        'real'         => 'R$ ' . esc_html__( 'Real', 'qs-paddle-intregration' ),
                        'ruble'        => '&#8381; ' . esc_html__( 'Ruble', 'qs-paddle-intregration' ),
                        'rupee'        => '&#8360; ' . esc_html__( 'Rupee', 'qs-paddle-intregration' ),
                        'indian_rupee' => '&#8377; ' . esc_html__( 'Rupee (Indian)', 'qs-paddle-intregration' ),
                        'shekel'       => '&#8362; ' . esc_html__( 'Shekel', 'qs-paddle-intregration' ),
                        'yen'          => '&#165; ' . esc_html__( 'Yen/Yuan', 'qs-paddle-intregration' ),
                        'won'          => '&#8361; ' . esc_html__( 'Won', 'qs-paddle-intregration' ),
                        'custom'       => esc_html__( 'Custom', 'qs-paddle-intregration' ),
                    ],
                    'default' => 'dollar',
                ]
            );

            $this->add_control(
                'element_ready_currency_position',
                [
                    'label'   => esc_html__( 'Currency Position', 'qs-paddle-intregration' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        'left'  => esc_html__( 'Left', 'qs-paddle-intregration' ),
                        'right' => esc_html__( 'Right', 'qs-paddle-intregration' ),
                    ],
                    'default' => 'left',
                ]
            );

            $this->add_control(
                'element_ready_currency_symbol_custom',
                [
                    'label'     => esc_html__( 'Custom Symbol', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::TEXT,
                    'condition' => [
                        'element_ready_currency_symbol' => 'custom',
                    ],
                ]
            );

            $this->add_control(
                'element_ready_period',
                [
                    'label'   => esc_html__( 'Period', 'qs-paddle-intregration' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__( '/Monthly', 'qs-paddle-intregration' ),
                ]
            );

        $this->end_controls_section();
        /*----------------------------
           PRICING FIELDS TAB END
        ------------------------------*/
        
        /*---------------------------
            PRICE DESCRIPTION
        -----------------------------*/
        $this->start_controls_section(
            'element_ready_pricing_desc',
            [
                'label' => esc_html__( 'Description', 'qs-paddle-intregration' ),
            ]
        );
            $this->add_control(
                'pricing_desc',
                [
                    'label' => esc_html__( 'Price Description', 'qs-paddle-intregration' ),
                    'type'  => Controls_Manager::WYSIWYG,
                ]
            );
        $this->end_controls_section();
        /*----------------------------
            DESCRIPTION TAB END
        -----------------------------*/

        /*----------------------------
           FEATURES TAB START
        ------------------------------*/
        $this->start_controls_section(
            'element_ready_pricing_features',
            [
                'label' => esc_html__( 'Features', 'qs-paddle-intregration' ),
            ]
        );

            $repeater = new Repeater();

            $repeater->add_control(
                'element_ready_features_title',
                [
                    'label'       => esc_html__( 'Title', 'qs-paddle-intregration' ),
                    'type'        => Controls_Manager::TEXTAREA,
                    'default'     => esc_html__( 'Features Tilte', 'qs-paddle-intregration' ),
                    'description' => sprintf( esc_html__( 'If you want to bold content just use %s in before and use %s after the word. and if you want to border use %s before the word use %s after the word. and if you want content right use %s before the word and use %s after the word.', 'qs-paddle-intregration' ),'<mark>[</mark>','<mark>]</mark>','<mark>{</mark>','<mark>}</mark>','<mark>(RIGHT)</mark>','<mark>(/RIGHTEND)</mark>' ),
                ]
            );

            $repeater->add_control(
                'element_ready_old_features',
                [
                    'label'        => esc_html__( 'Old Features', 'qs-paddle-intregration' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                ]
            );

            $repeater->add_control(
                'features_icon_type',
                [
                    'label'   => esc_html__('Add Features Icon','qs-paddle-intregration'),
                    'type'    => Controls_Manager::CHOOSE,
                    'options' => [
                        'img' =>[
                            'title' => esc_html__('Image Icon','qs-paddle-intregration'),
                            'icon'  => 'fa fa-picture-o',
                        ],
                        'font' =>[
                            'title' => esc_html__('SVG / Font Icon','qs-paddle-intregration'),
                            'icon'  => 'fa fa-info',
                        ],
                    ],
                    'default'   => 'font',
                ]
            );

            $repeater->add_control(
                'element_ready_features_icon',
                [
                    'label'       => esc_html__( 'SVG / Font Icon', 'qs-paddle-intregration' ),
                    'type'        => Controls_Manager::ICONS,
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-star',
                        'library' => 'solid',
                    ],
                    'condition'   => [
                        'features_icon_type' => 'font',
                    ],
                ]
            );
            $repeater->add_control(
                'features_image_icon',
                [
                    'label'   => esc_html__( 'Image Icon / SVG', 'qs-paddle-intregration' ),
                    'type'    => Controls_Manager::MEDIA,
                    'default' => [
                        'url' => Utils::get_placeholder_image_src(),
                    ],
                    'condition' => [
                        'features_icon_type' => 'img',
                    ],
                ]
            );

            $repeater->add_control(
                'element_ready_features_icon_color',
                [
                    'label'     => esc_html__( 'Icon Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__price {{CURRENT_ITEM}} i' => 'color: {{VALUE}}',
                    ],
                    'condition' => [
                        'element_ready_features_icon!' => '',
                    ]
                ]
            );

            $this->add_control(
                'element_ready_features_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => $repeater->get_controls(),
                    'default' => [
                        [
                            'element_ready_features_title'   => esc_html__( 'Features Title One', 'qs-paddle-intregration' ),
                            'element_ready_features_icon' => 'fa fa-angle-double-right',
                        ],

                        [
                            'element_ready_features_title'   => esc_html__( 'Features Title Two', 'qs-paddle-intregration' ),
                            'element_ready_features_icon' => 'fa fa-angle-double-right',
                        ],

                        [
                            'element_ready_features_title'   => esc_html__( 'Features Title Three', 'qs-paddle-intregration' ),
                            'element_ready_features_icon' => 'fa fa-angle-double-right',
                        ],
                    ],
                    'title_field' => '{{{ element_ready_features_title }}}',
                ]
            );

        $this->end_controls_section();
        /*----------------------------
           FEATURES FIELDS TAB END
        ------------------------------*/

        /*----------------------------
            FOOTER TAB START
        ------------------------------*/
        $this->start_controls_section(
            'element_ready_pricing_footer',
            [
                'label' => esc_html__( 'Footer', 'qs-paddle-intregration' ),
            ]
        );

            $this->add_control(
                'element_ready_price_button',
                [
                    'label'        => esc_html__( 'Show Price Button', 'qs-paddle-intregration' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'default'      => 'yes',
                    'return_value' => 'yes',
                ]
            );
            
            $this->add_control(
                'element_ready_button_text',
                [
                    'label'     => esc_html__( 'Button Text', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::TEXT,
                    'default'   => esc_html__( 'Purchase Now', 'qs-paddle-intregration' ),
                    'condition' => [
                        'element_ready_price_button' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'element_ready_button_link',
                [
                    'label'       => esc_html__( 'Link', 'qs-paddle-intregration' ),
                    'type'        => Controls_Manager::URL,
                    'placeholder' => 'http://your-link.com',
                    'default'     => [
                        'url' => '#',
                    ],
                    'condition'=> [
                        'element_ready_price_button' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'element_ready_button_icon',
                [
                    'label'     => esc_html__( 'Button Icon', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::ICONS,
                    'label_block' => true,
                    'condition' => [
                        'element_ready_price_button' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'element_ready_button_icon_alignment',
                [
                    'label'   => esc_html__( 'Icon Position', 'qs-paddle-intregration' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'left',
                    'options' => [
                        'left'  => esc_html__( 'Before', 'qs-paddle-intregration' ),
                        'right' => esc_html__( 'After', 'qs-paddle-intregration' ),
                    ],
                    'condition' => [
                        'element_ready_button_icon!' => '',
                        'element_ready_price_button' => 'yes',
                    ],
                ]
            );

            $this->add_control(
                'element_ready_button_icon_indent',
                [
                    'label' => esc_html__( 'Icon Spacing', 'qs-paddle-intregration' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'max' => 60,
                        ],
                    ],
                    'condition' => [
                        'element_ready_button_icon!' => '',
                        'element_ready_price_button' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .price_btn i.price_btn_icon_left'  => 'margin-right: {{SIZE}}px;',
                        '{{WRAPPER}} .price_btn i.price_btn_icon_right' => 'margin-left: {{SIZE}}px;',
                    ],
                ]
            );

        $this->end_controls_section();
        /*------------------------------
            FOOTER FIELDS TAB END
        -------------------------------*/

        /*-------------------------------
            HEADER STYLE TAB START
        --------------------------------*/
        $this->start_controls_section(
            'element_ready_header_style',
            [
                'label' => esc_html__( 'Header', 'qs-paddle-intregration' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_control(
                'pricing_header_area_style',
                [
                    'label'     => esc_html__( 'Header Area', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                ]
            );
            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'pricing_header_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .single__price__header',
                ]
            );
            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'pricing_header_border',
                    'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                    'selector' => '{{WRAPPER}} .single__price__header',
                ]
            );

            $this->add_responsive_control(
                'pricing_header_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pricing_header_padding',
                [
                    'label'      => esc_html__( 'Padding', 'qs-paddle-intregration' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__price__header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'pricing_header_margin',
                [
                    'label'      => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__price__header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'pricing_header_hover_heading_title',
                [
                    'label'     => esc_html__( 'Header Area Hover Background', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'pricing_header_hover_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'separator' => 'before',
                    'selector' => '{{WRAPPER}} .single__price:hover .single__price__header',
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'pricing_header_hover_border',
                    'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                    'selector' => '{{WRAPPER}} .single__price:hover .single__price__header',
                ]
            );

            $this->add_responsive_control(
                'pricing_header_hover_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price:hover .single__price__header' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_control(
                'pricing_header_heading_title',
                [
                    'label'     => esc_html__( 'Title', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'pricing_header_title_color',
                [
                    'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .price__title h3' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_control(
                'pricing_header_title_hover_color',
                [
                    'label'     => esc_html__( 'Hover Title Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__price:hover .price__title h3' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'pricing_header_title_typography',
                    'selector' => '{{WRAPPER}} .single__price__header .price__title h3',
                    
                ]
            );

            $this->add_responsive_control(
                'pricing_header_title_margin',
                [
                    'label'     => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .price__title h3' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_control(
                'pricing_header_subheading_title',
                [
                    'label'     => esc_html__( 'Subtitle', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'pricing_header_subtitle_color',
                [
                    'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .price__subtitle' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_control(
                'pricing_header_subtitle_hover_color',
                [
                    'label'     => esc_html__( 'Hover Title Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__price:hover .price__subtitle' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'pricing_header_subtitle_typography',
                    'selector' => '{{WRAPPER}} .single__price__header .price__subtitle',
                    
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'pricing_header_subtitle_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .single__price__header .price__subtitle',
                ]
            );

            $this->add_responsive_control(
                'pricing_header_subtitle_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .price__subtitle' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pricing_header_subtitle_margin',
                [
                    'label'     => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .price__subtitle' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pricing_header_subtitle_padding',
                [
                    'label'     => esc_html__( 'Padding', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .price__subtitle' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_control(
                'pricing_header_heading_price',
                [
                    'label'     => esc_html__( 'Price', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'pricing_header_price_color',
                [
                    'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .new__price' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .single__price__style__11 .new__price' => 'color: {{VALUE}}',
                    ]
                ]
            );
            $this->add_control(
                'pricing_header_price_hover_color',
                [
                    'label'     => esc_html__( 'Price Hover Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__price:hover .new__price' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .single__price__style__11 .new__price:hover' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'pricing_header_price_typography',
                    'selector' => '{{WRAPPER}} .single__price__header .new__price,{{WRAPPER}} .single__price__style__11 .new__price',
                    
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'pricing_header_price_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .single__price__header .new__price,{{WRAPPER}} .single__price__style__11 .new__price,',
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'pricing_header_price_border',
                    'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                    'selector' => '{{WRAPPER}} .single__price__header .new__price,{{WRAPPER}} .single__price__style__11 .new__price,',
                ]
            );

            $this->add_responsive_control(
                'pricing_header_price_radius',
                [
                    'label'     => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .new__price' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .single__price__style__11 .new__price' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pricing_header_price_margin',
                [
                    'label'     => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .price__rate h3' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .single__price__style__11 .price__rate h3' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            /*-------------------------
                OFFER PRICE
            --------------------------*/
            $this->add_control(
                'pricing_offer_heading_price',
                [
                    'label'     => esc_html__( 'Offer Price', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'pricing_header_offer_price_color',
                [
                    'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .old__price' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .single__price__style__11 .old__price' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_control(
                'pricing_header_offer_price_hover_color',
                [
                    'label'     => esc_html__( 'Hover Offer Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__price:hover .old__price' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .single__price__style__11 .old__price:hover' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'pricing_header_offer_price_typography',
                    'selector' => '{{WRAPPER}} .single__price__header .old__price,{{WRAPPER}} .single__price__style__11 .old__price',
                    
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'pricing_header_offer_price_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .single__price__header .old__price,{{WRAPPER}} .single__price__style__11 .old__price',
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'pricing_header_offer_price_border',
                    'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                    'selector' => '{{WRAPPER}} .single__price__header .old__price,{{WRAPPER}} .single__price__style__11 .old__price',
                ]
            );

            $this->add_responsive_control(
                'pricing_header_offer_price_margin',
                [
                    'label'     => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .old__price' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .single__price__style__11 .old__price' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            /*---------------------------
                PRICE CURRENCY
            ----------------------------*/
            $this->add_control(
                'pricing_currency_heading_title',
                [
                    'label'     => esc_html__( 'Currency', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'pricing_currency_title_color',
                [
                    'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .price__currency' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .single__price__style__11 .price__currency' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_control(
                'pricing_currency_title_hover_color',
                [
                    'label'     => esc_html__( 'Hover Currency Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__price:hover .price__currency' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .single__price__style__11 .price__currency:hover' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'pricing_currency_title_typography',
                    'selector' => '{{WRAPPER}} .single__price__header .price__currency,{{WRAPPER}} .single__price__style__11 .price__currency',
                    
                ]
            );

            $this->add_responsive_control(
                'pricing_currency_title_margin',
                [
                    'label'     => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .price__currency' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .single__price__style__11 .price__currency' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            /*---------------------------
                PERIOD STYLE
            ----------------------------*/
            $this->add_control(
                'pricing_period_heading_title',
                [
                    'label'     => esc_html__( 'Period', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'pricing_period_title_color',
                [
                    'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'separator' => 'before',
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .period__price' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .single__price__style__11 .period__price' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_control(
                'pricing_period_title_hover_color',
                [
                    'label'     => esc_html__( 'Hover Preiord Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__price:hover .period__price' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .single__price__style__11 .period__price:hover' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'pricing_period_title_typography',
                    'selector' => '{{WRAPPER}} .single__price__header .period__price,{{WRAPPER}} .single__price__style__11 .period__price',
                    
                ]
            );

            $this->add_responsive_control(
                'pricing_period__display',
                [
                    'label'   => esc_html__( 'Display', 'qs-paddle-intregration' ),
                    'type'    => Controls_Manager::SELECT,
                    'default' => 'initial',
                    'options' => [
                        'initial'      => esc_html__( 'Initial', 'qs-paddle-intregration' ),
                        'block'        => esc_html__( 'Block', 'qs-paddle-intregration' ),
                        'inline-block' => esc_html__( 'Inline Block', 'qs-paddle-intregration' ),
                        'flex'         => esc_html__( 'Flex', 'qs-paddle-intregration' ),
                        'inline-flex'  => esc_html__( 'Inline Flex', 'qs-paddle-intregration' ),
                        'none'         => esc_html__( 'none', 'qs-paddle-intregration' ),
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .period__price' => 'display: {{VALUE}};',
                        '{{WRAPPER}} .single__price__style__11 .period__price' => 'display: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pricing_period_title_margin',
                [
                    'label'     => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__header .period__price' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                        '{{WRAPPER}} .single__price__style__11 .period__price' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

        $this->end_controls_section();
        /*---------------------------
            HEADER STYLE TAB END
        -----------------------------*/

        /*-------------------------------
            HEADER RIBON START
        --------------------------------*/
        $this->start_controls_section(
            'ribon_style_section',
            [
                'label' => esc_html__( 'Ribon Style', 'qs-paddle-intregration' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'element_ready_ribon_pricing_table' => 'yes'
                ],
            ]
        );
            $this->start_controls_tabs(
                'ribon_style_tabs'
            );
                $this->start_controls_tab(
                    'ribon_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'qs-paddle-intregration' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'      => 'ribon_typography',
                            'selector'  => '{{WRAPPER}} .single__price__ribon',
                            'condition' => [
                                'ribon_type' => ['font','text']
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'ribon_image_width',
                        [
                            'label'      => esc_html__( 'Image Width', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon img' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'ribon_type' => ['img']
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'ribon_image_height',
                        [
                            'label'      => esc_html__( 'Image Height', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon img' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'ribon_type' => ['img']
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Css_Filter:: get_type(),
                        [
                            'name'      => 'ribon_image_filters',
                            'label'        => esc_html__( 'Image Filter', 'qs-paddle-intregration' ),
                            'selector'  => '{{WRAPPER}} .single__price__ribon img',
                            'condition' => [
                                'ribon_type' => ['img']
                            ],
                        ]
                    );
                    $this->add_control(
                        'ribon_color',
                        [
                            'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'ribon_background',
                            'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__price__ribon',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'ribon_border',
                            'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                            'selector' => '{{WRAPPER}} .single__price__ribon',
                            'separator'  => 'before',
                        ]
                    );
                    $this->add_control(
                        'ribon_radius',
                        [
                            'label'      => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price__ribon, {{WRAPPER}} .single__price__ribon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'ribon_shadow',
                            'selector' => '{{WRAPPER}} .single__price__ribon',
                        ]
                    );
                    $this->add_control(
                        'ribon_width',
                        [
                            'label'      => esc_html__( 'Width', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px','vw','%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                'vw' => [
                                    'min'  => -100,
                                    'max'  => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'separator'  => 'before',
                        ]
                    );
                    $this->add_control(
                        'ribon_height',
                        [
                            'label'      => esc_html__( 'Height', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'ribon_display',
                        [
                            'label'   => esc_html__( 'Display', 'qs-paddle-intregration' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                'initial'      => esc_html__( 'Initial', 'qs-paddle-intregration' ),
                                'block'        => esc_html__( 'Block', 'qs-paddle-intregration' ),
                                'inline-block' => esc_html__( 'Inline Block', 'qs-paddle-intregration' ),
                                'flex'         => esc_html__( 'Flex', 'qs-paddle-intregration' ),
                                'inline-flex'  => esc_html__( 'Inline Flex', 'qs-paddle-intregration' ),
                                'none'         => esc_html__( 'none', 'qs-paddle-intregration' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'display: {{VALUE}};',
                            ],
                            'separator'  => 'before',
                        ]
                    );
                    $this->add_control(
                        'ribon_align',
                        [
                            'label'   => esc_html__( 'Alignment', 'qs-paddle-intregration' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => esc_html__( 'Justify', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'text-align: {{VALUE}};',
                            ],
                            'default' => '',
                        ]
                    );
                    $this->add_responsive_control(
                        'ribon_position',
                        [
                            'label'   => esc_html__( 'Position', 'qs-paddle-intregration' ),
                            'type'    => Controls_Manager::SELECT,              
                            'options' => [
                                'inherit'  => esc_html__( 'Inherit', 'qs-paddle-intregration' ),
                                'initial'  => esc_html__( 'Initial', 'qs-paddle-intregration' ),
                                'absolute' => esc_html__( 'Absulute', 'qs-paddle-intregration' ),
                                'relative' => esc_html__( 'Relative', 'qs-paddle-intregration' ),
                                'static'   => esc_html__( 'Static', 'qs-paddle-intregration' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'position: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'ribon_position_from_left',
                        [
                            'label'      => esc_html__( 'From Left Offset', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', 'vw','%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -2000,
                                    'max'  => 2000,
                                    'step' => 1,
                                ],
                                'vw' => [
                                    'min'  => -100,
                                    'max'  => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'separator'  => 'before',
                            'condition' => [
                                'ribon_position!' => ['inherit','initial','static']
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'ribon_position_from_right',
                        [
                            'label'      => esc_html__( 'From Right Offset', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', 'vw','%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -2000,
                                    'max'  => 2000,
                                    'step' => 1,
                                ],
                                'vw' => [
                                    'min'  => -100,
                                    'max'  => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'ribon_position!' => ['inherit','initial','static']
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'ribon_position_from_top',
                        [
                            'label'      => esc_html__( 'From Top Offset', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', 'vw','%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -2000,
                                    'max'  => 2000,
                                    'step' => 1,
                                ],
                                'vw' => [
                                    'min'  => -100,
                                    'max'  => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'ribon_position!' => ['inherit','initial','static']
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'ribon_position_from_bottom',
                        [
                            'label'      => esc_html__( 'From Bottom Offset', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', 'vw','%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -2000,
                                    'max'  => 2000,
                                    'step' => 1,
                                ],
                                'vw' => [
                                    'min'  => -100,
                                    'max'  => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => -100,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'ribon_position!' => ['inherit','initial','static']
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'ribon_zindex',
                        [
                            'label'     => esc_html__( 'Z-Index', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::NUMBER,
                            'min'       => -99,
                            'max'       => 99,
                            'step'      => 1,
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'z-index: {{SIZE}};',
                            ],
                            'separator'  => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'ribon_opacity',
                        [
                            'label' => esc_html__( 'Opacity', 'qs-paddle-intregration' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max'  => 1,
                                    'min'  => 0.10,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__ribon' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'ribon_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price__ribon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator'  => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'ribon_padding',
                        [
                            'label'      => esc_html__( 'Padding', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price__ribon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
                $this->start_controls_tab(
                    'ribon_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'qs-paddle-intregration' ),
                    ]
                );
                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'      => 'hover_ribon_typography',
                            'selector'  => '{{WRAPPER}} .single__price:hover .single__price__ribon',
                            'condition' => [
                                'ribon_type' => ['font','text']
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Css_Filter:: get_type(),
                        [
                            'name'      => 'hover_ribon_image_filters',
                            'label'        => esc_html__( 'Image Filter', 'qs-paddle-intregration' ),
                            'selector'  => '{{WRAPPER}} .single__price:hover .single__price__ribon img',
                            'condition' => [
                                'ribon_type' => ['img']
                            ],
                        ]
                    );
                    $this->add_control(
                        'hover_ribon_color',
                        [
                            'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::COLOR,
                            'default'   => '',
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover .single__price__ribon' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_ribon_background',
                            'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__price:hover .single__price__ribon',
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'hover_ribon_border',
                            'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                            'selector' => '{{WRAPPER}} .single__price:hover .single__price__ribon',
                            'separator'  => 'before',
                        ]
                    );
                    $this->add_control(
                        'hover_ribon_radius',
                        [
                            'label'      => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price:hover .single__price__ribon, {{WRAPPER}} .single__price:hover .single__price__ribon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'hover_ribon_shadow',
                            'selector' => '{{WRAPPER}} .single__price:hover .single__price__ribon',
                        ]
                    );
                    $this->add_responsive_control(
                        'hover_ribon_zindex',
                        [
                            'label'     => esc_html__( 'Z-Index', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::NUMBER,
                            'min'       => -99,
                            'max'       => 99,
                            'step'      => 1,
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover .single__price__ribon' => 'z-index: {{SIZE}};',
                            ],
                            'separator'  => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'hover_ribon_opacity',
                        [
                            'label' => esc_html__( 'Opacity', 'qs-paddle-intregration' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max'  => 1,
                                    'min'  => 0.10,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover .single__price__ribon' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*-------------------------------
            HEADER RIBON END
        --------------------------------*/

        /*---------------------------
            FEATURES STYLE TAB START
        -----------------------------*/
        $this->start_controls_section(
            'element_ready_features_style',
            [
                'label' => esc_html__( 'Features', 'qs-paddle-intregration' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

          
            $this->add_responsive_control(
                'main_section_element_ready_yu_custom_css',
                [
                    'label'     => esc_html__( 'Custom CSS', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::CODE,
                    'rows'      => 20,
                    'language'  => 'css',
                    'selectors' => [
                        '{{WRAPPER}} .single__price__body' => '{{VALUE}};',
                    
                    ],
                    'separator' => 'before',
                ]
            );
            
            $this->add_control(
                'pricing_features_area_heading_title',
                [
                    'label'     => esc_html__( 'Features Area', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'pricing_features_area_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .single__price__body',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'eler_feature_box_border',
                    'label'    => __( 'Border', 'qs-paddle-intregration' ),
                    'selector' => '{{WRAPPER}} .single__price__body',
                ]
            );

            $this->add_responsive_control(
                'pricing_features_area_margin',
                [
                    'label'      => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__price__body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'pricing_features_area_padding',
                [
                    'label'      => esc_html__( 'Padding', 'qs-paddle-intregration' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__price__body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'pricing_features_area_hover_heading_title',
                [
                    'label'     => esc_html__( 'Features Area Hover Background', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'pricing_features_hover_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'separator' => 'before',
                    'selector' => '{{WRAPPER}} .single__price:hover .single__price__body',
                ]
            );

            $this->add_control(
                'pricing_features_heading_title',
                [
                    'label'     => esc_html__( 'Features Items', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
            'features_hr',
                [
                    'type' => Controls_Manager::DIVIDER,
                ]
            );

            $this->add_group_control(
                Group_Control_Typography:: get_type(),
                [
                    'name'     => 'pricing_features_item_typography',
                    'selector' => '{{WRAPPER}} .single__price__body ul li',
                    
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'pricing_features_item_color',
                [
                    'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__body ul li' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_responsive_control(
                'pricing_features_item_margin',
                [
                    'label'      => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__price__body ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_responsive_control(
                'pricing_features_item_padding',
                [
                    'label'      => esc_html__( 'Padding', 'qs-paddle-intregration' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__price__body ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ]
                ]
            );

            $this->add_control(
                'pricing_features_icon_title',
                [
                    'label'     => esc_html__( 'Features Icon Style', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'pricing_features_icon_color',
                [
                    'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__body ul li i' => 'color: {{VALUE}}',
                    ],
                    'separator' => 'before',
                ]
            );
            $this->add_control(
                'pricing_features_icon_hover_color',
                [
                    'label'     => esc_html__( 'Hover Color', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .single__price:hover .single__price__body ul li i' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_responsive_control(
                'pricing_features_icon_margin',
                [
                    'label'      => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors'  => [
                        '{{WRAPPER}} .single__price__body ul li i,{{WRAPPER}} .single__price__body ul li img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
        /*---------------------------
            FEATURES STYLE TAB END
        ----------------------------*/
        
        /*---------------------------
            FOOTER STYLE TAB START
        -----------------------------*/
        $this->start_controls_section(
            'element_ready_pricing_footer_style',
            [
                'label' => esc_html__( 'Footer', 'qs-paddle-intregration' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'pricing_footer_heading_title',
                [
                    'label'     => esc_html__( 'Footer Area', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'pricing_footer_wrap_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .single__price__footer',
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Border:: get_type(),
                [
                    'name'     => 'footer_areabox_border',
                    'label'    => __( 'Border', 'qs-paddle-intregration' ),
                    'selector' => '{{WRAPPER}} .single__price__footer',
                ]
            );

            $this->add_responsive_control(
                'pricing_footer_wrap_margin',
                [
                    'label'     => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__footer' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'pricing_footer_wrap_padding',
                [
                    'label'     => esc_html__( 'Padding', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .single__price__footer' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_control(
                'pricing_footer_hover_heading_title',
                [
                    'label'     => esc_html__( 'Footer Area Hover Background', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_group_control(
                Group_Control_Background:: get_type(),
                [
                    'name'     => 'pricing_footer_wrap_hover_background',
                    'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                    'types'    => [ 'classic', 'gradient' ],
                    'separator' => 'before',
                    'selector' => '{{WRAPPER}} .single__price:hover .single__price__footer',
                ]
            );

            $this->add_control(
                'pricing_footer_button_heading_title',
                [
                    'label'     => esc_html__( 'Button', 'qs-paddle-intregration' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

                $this->start_controls_tabs( 
                    'pricing_footer_style_tabs',
                    [
                        'separator' => 'before',
                    ]
                );

                // Pricing Normal tab start
                $this->start_controls_tab(
                    'style_pricing_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'qs-paddle-intregration' ),
                        'separator' => 'after',
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Typography:: get_type(),
                        [
                            'name'     => 'pricing_footer_typography',
                            'selector' => '{{WRAPPER}} .single__price__footer a.price_btn',
                            
                        ]
                    );

                    $this->add_control(
                        'pricing_footer_color',
                        [
                            'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__price__footer a.price_btn' => 'color: {{VALUE}}',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'pricing_footer_background',
                            'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__price__footer a.price_btn',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'pricing_footer_border',
                            'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                            'selector' => '{{WRAPPER}} .single__price__footer a.price_btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'pricing_footer_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__price__footer a.price_btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_control(
                        'pricing_footer_width',
                        [
                            'label'      => esc_html__( 'Width', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                'vw' => [
                                    'min'  => -100,
                                    'max'  => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__footer a.price_btn' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'separator'  => 'before',
                        ]
                    );
                    $this->add_control(
                        'pricing_footer_height',
                        [
                            'label'      => esc_html__( 'Height', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__footer a.price_btn' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'pricing_footer_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price__footer a.price_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator'  => 'before',
                        ]
                    );
                    $this->add_responsive_control(
                        'pricing_footer_padding',
                        [
                            'label'      => esc_html__( 'Padding', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price__footer a.price_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ]
                        ]
                    );
                    $this->add_responsive_control(
                        'pricing_footer_padding_alignment',
                        [
                            'label'   => esc_html__( 'Alignment', 'qs-paddle-intregration' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => esc_html__( 'Justified', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price__footer a.price_btn' => 'text-align: {{VALUE}};',
                            ],
                            'separator'  => 'before',
                        ]
                    );
                $this->end_controls_tab();
                /*------------------------
                    PRICING NORMAL TAB END
                --------------------------*/

                /*-------------------------
                    PRICING HOVER TAB START
                ---------------------------*/
                $this->start_controls_tab(
                    'style_pricing_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'qs-paddle-intregration' ),
                    ]
                );

                    $this->add_control(
                        'pricing_footer_hover_color',
                        [
                            'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__price__footer a.price_btn:hover' => 'color: {{VALUE}}',
                                '{{WRAPPER}} .price__active .single__price__footer a.price_btn' => 'color: {{VALUE}}',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name'     => 'pricing_footer_hover_background',
                            'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__price__footer a.price_btn:hover,{{WRAPPER}} .price__active .single__price__footer a.price_btn',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'pricing_footer_hover_border',
                            'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                            'selector' => '{{WRAPPER}} .single__price__footer a.price_btn:hover,{{WRAPPER}} .price__active .single__price__footer a.price_btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'pricing_footer_hover_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__price__footer a.price_btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .price__active .single__price__footer a.price_btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                /*-----------------------
                    PRICING HOVER TAB END
                -------------------------*/

            $this->end_controls_tabs();

        $this->end_controls_section();
        /*---------------------------
            FOOTER STYLE TAB END
        ----------------------------*/

        /*---------------------------
            STYLE TAB SECTION START
        ----------------------------*/
        $this->start_controls_section(
            'pricing_style_section',
            [
                'label' => esc_html__( 'Box', 'qs-paddle-intregration' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->start_controls_tabs(
                'box_style_tabs'
            );
                $this->start_controls_tab(
                    'box_style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'qs-paddle-intregration' ),
                    ]
                );

                    $this->add_control(
                        'pricing_table_color',
                        [
                            'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__price' => 'color: {{VALUE}}',
                            ]
                        ]
                    );

                    $this->add_responsive_control(
                        'element_ready_price_text_align',
                        [
                            'label'   => esc_html__( 'Alignment', 'qs-paddle-intregration' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => esc_html__( 'Justified', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price' => 'text-align: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'pricing_table_background',
                            'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__price',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'pricing_table_box_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'qs-paddle-intregration' ),
                            'selector' => '{{WRAPPER}} .single__price',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'pricing_table_border',
                            'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                            'selector' => '{{WRAPPER}} .single__price',
                        ]
                    );

                    $this->add_responsive_control(
                        'pricing_table_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__price' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'pricing_table_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                    $this->add_responsive_control(
                        'pricing_table_padding',
                        [
                            'label'      => esc_html__( 'Padding', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' => 'before',
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'box_style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'qs-paddle-intregration' ),
                    ]
                );
                    $this->add_control(
                        'pricing_table_hover_color',
                        [
                            'label'     => esc_html__( 'Color', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover' => 'color: {{VALUE}}',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'pricing_table_hover_background',
                            'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__price:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'pricing_table_hover_box_shadow',
                            'label'    => esc_html__( 'Box Shadow', 'qs-paddle-intregration' ),
                            'selector' => '{{WRAPPER}} .single__price:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'pricing_table_hover_border',
                            'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                            'selector' => '{{WRAPPER}} .single__price:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'pricing_table_hover_radius',
                        [
                            'label'     => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab();
            $this->end_controls_tabs();

        $this->end_controls_section();
        /*-----------------------------
            STYLE TAB SECTION END 
        ------------------------------*/

        /*----------------------------
            BOX BEFORE / AFTER
        -----------------------------*/
        $this->start_controls_section(
            'box_before_after_style_section',
            [
                'label' => esc_html__( 'Before / After', 'qs-paddle-intregration' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs( 'before_after_tab_style' );
                $this->start_controls_tab(
                    'before_tab',
                    [
                        'label' => esc_html__( 'BEFORE', 'qs-paddle-intregration' ),
                    ]
                );

                    // Before Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'before_background',
                            'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__price:before',
                        ]
                    );

                    // Before Display;
                    $this->add_responsive_control(
                        'before_display',
                        [
                            'label'   => esc_html__( 'Display', 'qs-paddle-intregration' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                'initial'      => esc_html__( 'Initial', 'qs-paddle-intregration' ),
                                'block'        => esc_html__( 'Block', 'qs-paddle-intregration' ),
                                'inline-block' => esc_html__( 'Inline Block', 'qs-paddle-intregration' ),
                                'flex'         => esc_html__( 'Flex', 'qs-paddle-intregration' ),
                                'inline-flex'  => esc_html__( 'Inline Flex', 'qs-paddle-intregration' ),
                                'none'         => esc_html__( 'none', 'qs-paddle-intregration' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'display: {{VALUE}};',
                            ],
                        ]
                    );

                    // Before Postion
                    $this->add_responsive_control(
                        'before_position',
                        [
                            'label'   => esc_html__( 'Position', 'qs-paddle-intregration' ),
                            'type'    => Controls_Manager::SELECT,              
                            'options' => [
                                'inherit'  => esc_html__( 'Inherit', 'qs-paddle-intregration' ),
                                'initial'  => esc_html__( 'Initial', 'qs-paddle-intregration' ),
                                'absolute' => esc_html__( 'Absulute', 'qs-paddle-intregration' ),
                                'relative' => esc_html__( 'Relative', 'qs-paddle-intregration' ),
                                'static'   => esc_html__( 'Static', 'qs-paddle-intregration' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'position: {{VALUE}};',
                            ],
                        ]
                    );

                    // Postion From Left
                    $this->add_responsive_control(
                        'before_position_from_left',
                        [
                            'label'      => esc_html__( 'From Left', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'before_position!' => ['initial','static']
                            ],
                        ]
                    );

                    // Postion From Right
                    $this->add_responsive_control(
                        'before_position_from_right',
                        [
                            'label'      => esc_html__( 'From Right', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'before_position!' => ['initial','static']
                            ],
                        ]
                    );

                    // Postion From Top
                    $this->add_responsive_control(
                        'before_position_from_top',
                        [
                            'label'      => esc_html__( 'From Top', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'before_position!' => ['initial','static']
                            ],
                        ]
                    );

                    // Postion From Bottom
                    $this->add_responsive_control(
                        'before_position_from_bottom',
                        [
                            'label'      => esc_html__( 'From Bottom', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'before_position!' => ['initial','static']
                            ],
                        ]
                    );

                    // Before Align
                    $this->add_responsive_control(
                        'before_align',
                        [
                            'label'   => esc_html__( 'Alignment', 'qs-paddle-intregration' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'text-align:left' => [
                                    'title' => esc_html__( 'Left', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'margin: 0 auto' => [
                                    'title' => esc_html__( 'Center', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'float:right' => [
                                    'title' => esc_html__( 'Right', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                                'text-align:justify' => [
                                    'title' => esc_html__( 'Justify', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => '{{VALUE}};',
                            ],
                            'default' => 'text-align:left',
                        ]
                    );

                    // Before Width
                    $this->add_responsive_control(
                        'before_width',
                        [
                            'label'      => esc_html__( 'Width', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Before Height
                    $this->add_responsive_control(
                        'before_height',
                        [
                            'label'      => esc_html__( 'Height', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Before Opacity
                    $this->add_control(
                        'before_opacity',
                        [
                            'label' => esc_html__( 'Opacity', 'qs-paddle-intregration' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max'  => 1,
                                    'min'  => 0.10,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'before_border',
                            'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                            'selector' => '{{WRAPPER}} .single__price:before',
                        ]
                    );
                    $this->add_control(
                        'before_radius',
                        [
                            'label'      => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'before_shadow',
                            'selector' => '{{WRAPPER}} .single__price:before',
                        ]
                    );

                    // Before Z-Index
                    $this->add_control(
                        'before_zindex',
                        [
                            'label'     => esc_html__( 'Z-Index', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::NUMBER,
                            'min'       => -99,
                            'max'       => 99,
                            'step'      => 1,
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'z-index: {{SIZE}};',
                            ],
                        ]
                    );

                    // Before Margin
                    $this->add_responsive_control(
                        'before_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price:before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Transition
                    $this->add_control(
                        'before_transition',
                        [
                            'label'      => esc_html__( 'Transition', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0.1,
                                    'max'  => 5,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 0.3,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'before_popover_toggle',
                        [
                            'label' => esc_html__( 'Transform', 'qs-paddle-intregration' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                        ]
                    );

                    $this->start_popover();

                    // Scale
                    $this->add_control(
                        'before_scale',
                        [
                            'label'      => esc_html__( 'Scale', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 20,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                        ]
                    );

                    // Rotate
                    $this->add_control(
                        'before_rotate',
                        [
                            'label'      => esc_html__( 'Rotate', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -360,
                                    'max'  => 360,
                                    'step' => 1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 0,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{before_scale.SIZE || 1}});',
                            ],
                        ]
                    );
                    $this->end_popover();

                    /*----------------
                        BEFORE HOVER
                    -------------------*/
                    $this->add_control(
                        'before_hr',
                        [
                            'type' => Controls_Manager::DIVIDER,
                        ]
                    );
                    $this->add_control(
                        'before_hover_hr',
                        [
                            'label'     => esc_html__( 'Before Hover', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                        ]
                    );

                    // Before Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_before_background',
                            'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__price:hover:before',
                        ]
                    );

                    // Before Width
                    $this->add_responsive_control(
                        'hover_before_width',
                        [
                            'label'      => esc_html__( 'Width', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover:before' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Before Height
                    $this->add_responsive_control(
                        'hover_before_height',
                        [
                            'label'      => esc_html__( 'Height', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover:before' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Before Opacity
                    $this->add_control(
                        'hover_before_opacity',
                        [
                            'label' => esc_html__( 'Opacity', 'qs-paddle-intregration' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max'  => 1,
                                    'min'  => 0.10,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover:before' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'hover_before_radius',
                        [
                            'label'      => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price:hover:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'before_hover_popover_toggle',
                        [
                            'label' => esc_html__( 'Transform', 'qs-paddle-intregration' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                        ]
                    );

                    $this->start_popover();
                    // Scale
                    $this->add_control(
                        'hover_before_scale',
                        [
                            'label'      => esc_html__( 'Scale', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 20,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover:before' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                        ]
                    );

                    // Rotate
                    $this->add_control(
                        'hover_before_rotate',
                        [
                            'label'      => esc_html__( 'Rotate', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -360,
                                    'max'  => 360,
                                    'step' => 1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 0,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover:before' => 'transform: rotate({{SIZE || 0}}deg) scale({{before_scale.SIZE || 1}});',
                            ],
                        ]
                    );
                    $this->end_popover();

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'after_tab',
                    [
                        'label' => esc_html__( 'AFTER', 'qs-paddle-intregration' ),
                    ]
                );

                    // After Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'after_background',
                            'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__price:after',
                        ]
                    );

                    // After Display;
                    $this->add_responsive_control(
                        'after_display',
                        [
                            'label'   => esc_html__( 'Display', 'qs-paddle-intregration' ),
                            'type'    => Controls_Manager::SELECT,
                            'default' => '',
                            'options' => [
                                'initial'      => esc_html__( 'Initial', 'qs-paddle-intregration' ),
                                'block'        => esc_html__( 'Block', 'qs-paddle-intregration' ),
                                'inline-block' => esc_html__( 'Inline Block', 'qs-paddle-intregration' ),
                                'flex'         => esc_html__( 'Flex', 'qs-paddle-intregration' ),
                                'inline-flex'  => esc_html__( 'Inline Flex', 'qs-paddle-intregration' ),
                                'none'         => esc_html__( 'none', 'qs-paddle-intregration' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'display: {{VALUE}};',
                            ],
                        ]
                    );

                    // After Postion
                    $this->add_responsive_control(
                        'after_position',
                        [
                            'label'   => esc_html__( 'Position', 'qs-paddle-intregration' ),
                            'type'    => Controls_Manager::SELECT,
                            'options' => [
                                'initial'  => esc_html__( 'Initial', 'qs-paddle-intregration' ),
                                'absolute' => esc_html__( 'Absulute', 'qs-paddle-intregration' ),
                                'relative' => esc_html__( 'Relative', 'qs-paddle-intregration' ),
                                'static'   => esc_html__( 'Static', 'qs-paddle-intregration' ),
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'position: {{VALUE}};',
                            ],
                        ]
                    );

                    // Postion From Left
                    $this->add_responsive_control(
                        'after_position_from_left',
                        [
                            'label'      => esc_html__( 'From Left', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'left: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'after_position!' => ['initial','static']
                            ],
                        ]
                    );

                    // Postion From Right
                    $this->add_responsive_control(
                        'after_position_from_right',
                        [
                            'label'      => esc_html__( 'From Right', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'right: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'after_position!' => ['initial','static']
                            ],
                        ]
                    );

                    // Postion From Top
                    $this->add_responsive_control(
                        'after_position_from_top',
                        [
                            'label'      => esc_html__( 'From Top', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'after_position!' => ['initial','static']
                            ],
                        ]
                    );

                    // Postion From Bottom
                    $this->add_responsive_control(
                        'after_position_from_bottom',
                        [
                            'label'      => esc_html__( 'From Bottom', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'after_position!' => ['initial','static']
                            ],
                        ]
                    );

                    // After Align
                    $this->add_responsive_control(
                        'after_align',
                        [
                            'label'   => esc_html__( 'Alignment', 'qs-paddle-intregration' ),
                            'type'    => Controls_Manager::CHOOSE,
                            'options' => [
                                'text-align:left' => [
                                    'title' => esc_html__( 'Left', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-left',
                                ],
                                'margin: 0 auto' => [
                                    'title' => esc_html__( 'Center', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-center',
                                ],
                                'float:right' => [
                                    'title' => esc_html__( 'Right', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-right',
                                ],
                                'text-align:justify' => [
                                    'title' => esc_html__( 'Justify', 'qs-paddle-intregration' ),
                                    'icon'  => 'fa fa-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => '{{VALUE}};',
                            ],
                            'default' => 'text-align:left',
                        ]
                    );

                    // After Width
                    $this->add_responsive_control(
                        'after_width',
                        [
                            'label'      => esc_html__( 'Width', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // After Height
                    $this->add_responsive_control(
                        'after_height',
                        [
                            'label'      => esc_html__( 'Height', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // After Opacity
                    $this->add_control(
                        'after_opacity',
                        [
                            'label' => esc_html__( 'Opacity', 'qs-paddle-intregration' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max'  => 1,
                                    'min'  => 0.10,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border:: get_type(),
                        [
                            'name'     => 'after_border',
                            'label'    => esc_html__( 'Border', 'qs-paddle-intregration' ),
                            'selector' => '{{WRAPPER}} .single__price:after',
                        ]
                    );

                    $this->add_control(
                        'after_radius',
                        [
                            'label'      => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );
                    
                    $this->add_group_control(
                        Group_Control_Box_Shadow:: get_type(),
                        [
                            'name'     => 'after_shadow',
                            'selector' => '{{WRAPPER}} .single__price:after',
                        ]
                    );

                    // After Z-Index
                    $this->add_control(
                        'after_zindex',
                        [
                            'label'     => esc_html__( 'Z-Index', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::NUMBER,
                            'min'       => -99,
                            'max'       => 99,
                            'step'      => 1,
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'z-index: {{SIZE}};',
                            ],
                        ]
                    );

                    // After Margin
                    $this->add_responsive_control(
                        'after_margin',
                        [
                            'label'      => esc_html__( 'Margin', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price:after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    // Transition
                    $this->add_control(
                        'after_transition',
                        [
                            'label'      => esc_html__( 'Transition', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0.1,
                                    'max'  => 5,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 0.3,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'transition: {{SIZE}}s;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'after_popover_toggle',
                        [
                            'label' => esc_html__( 'Transform', 'qs-paddle-intregration' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                        ]
                    );

                    $this->start_popover();

                    // Scale
                    $this->add_control(
                        'after_scale',
                        [
                            'label'      => esc_html__( 'Scale', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 20,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                        ]
                    );

                    // Rotate
                    $this->add_control(
                        'after_rotate',
                        [
                            'label'      => esc_html__( 'Rotate', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -360,
                                    'max'  => 360,
                                    'step' => 1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 0,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{after_scale.SIZE || 1}});',
                            ],
                        ]
                    );
                    $this->end_popover();

                    /*----------------
                        AFTER HOVER
                    -------------------*/
                    $this->add_control(
                        'after_hr',
                        [
                            'type' => Controls_Manager::DIVIDER,
                        ]
                    );
                    $this->add_control(
                        'after_hover_hr',
                        [
                            'label'     => esc_html__( 'After Hover', 'qs-paddle-intregration' ),
                            'type'      => Controls_Manager::HEADING,
                            'separator' => 'after',
                        ]
                    );

                    // After Background
                    $this->add_group_control(
                        Group_Control_Background:: get_type(),
                        [
                            'name'     => 'hover_after_background',
                            'label'    => esc_html__( 'Background', 'qs-paddle-intregration' ),
                            'types'    => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .single__price:hover:after',
                        ]
                    );

                    // after Width
                    $this->add_responsive_control(
                        'hover_after_width',
                        [
                            'label'      => esc_html__( 'Width', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover:after' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // after Height
                    $this->add_responsive_control(
                        'hover_after_height',
                        [
                            'label'      => esc_html__( 'Height', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover:after' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    // after Opacity
                    $this->add_control(
                        'hover_after_opacity',
                        [
                            'label' => esc_html__( 'Opacity', 'qs-paddle-intregration' ),
                            'type'  => Controls_Manager::SLIDER,
                            'range' => [
                                'px' => [
                                    'max'  => 1,
                                    'min'  => 0.10,
                                    'step' => 0.01,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover:after' => 'opacity: {{SIZE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'hover_after_radius',
                        [
                            'label'      => esc_html__( 'Border Radius', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors'  => [
                                '{{WRAPPER}} .single__price:hover:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'after_hover_popover_toggle',
                        [
                            'label' => esc_html__( 'Transform', 'qs-paddle-intregration' ),
                            'type' => Controls_Manager::POPOVER_TOGGLE,
                        ]
                    );

                    $this->start_popover();
                    // Scale
                    $this->add_control(
                        'hover_after_scale',
                        [
                            'label'      => esc_html__( 'Scale', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'min'  => 0,
                                    'max'  => 20,
                                    'step' => 0.1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 1,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover:after' => 'transform: scale({{SIZE}}{{UNIT}});',
                            ],
                        ]
                    );

                    // Rotate
                    $this->add_control(
                        'hover_after_rotate',
                        [
                            'label'      => esc_html__( 'Rotate', 'qs-paddle-intregration' ),
                            'type'       => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range'      => [
                                'px' => [
                                    'min'  => -360,
                                    'max'  => 360,
                                    'step' => 1,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 0,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .single__price:hover:after' => 'transform: rotate({{SIZE || 0}}deg) scale({{after_scale.SIZE || 1}});',
                            ],
                        ]
                    );
                    $this->end_popover();
                $this->end_controls_tab();
            $this->end_controls_tabs();
        $this->end_controls_section();
        /*----------------------------
            BOX BEFORE / AFTER END
        -----------------------------*/

    }

    public function er_paddle_get_product($procuct_id='644180'){

        $key = 'paddle_query_results_'.$procuct_id;
        if ( false === ( $query_results = get_transient( $key ) ) ) {
            // It wasn't there, so regenerate the data and save the transient
            $url = add_query_arg( 
                array( 
                    'product_ids' => $procuct_id,
                    'customer_country' => 'US',
                 ), 
                'https://checkout.paddle.com/api/2.0/prices'
            );

            $response = wp_remote_get( $url ,
                array(
                    'timeout'     => 120,
                )
            );

            try {
                $json = json_decode( $response['body'] );
                if(isset($json->success) && $json->success ==true ){
                  $query_results = json_encode($json->response->products[0]);
               
                }
              } catch ( Exception $ex ) {
                $json = null;
              }

            set_transient( $key, $query_results, 1 * HOUR_IN_SECONDS );
        }
       
        return json_decode($query_results);
    }

    protected function html( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
       
        $this->add_render_attribute( 'pricing_area_attr', 'class', 'single__price' );
        $this->add_render_attribute( 'pricing_area_attr', 'class', 'single__price__style__'.$settings['content_layout_style'] );
        if( $settings['element_ready_active_price'] == 'yes' ){
            $this->add_render_attribute( 'pricing_area_attr', 'class', 'price__active' );
        }
        if( $settings['element_ready_ribon_pricing_table'] == 'yes' ){
            $this->add_render_attribute( 'pricing_area_attr', 'class', 'price__ribon' );
        }
       
        ?>
            <div <?php echo $this->get_render_attribute_string( 'pricing_area_attr' ); ?> >

                <?php if( $settings['content_layout_style'] == 2 ): ?>
                    
                    <?php $this->qs_paddle_ready_price_ribon(); ?>
                    <div class="single__price__header">
                        <?php $this->qs_paddle_ready_price_icon(); ?>
                        <?php $this->qs_paddle_ready_price_title(); ?>
                        <?php $this->qs_paddle_price_rate(); ?>
                    </div>
                    <?php $this->qs_paddle_ready_price_features(); ?>
                    <?php $this->qs_paddle_ready_price_footer(); ?>

                <?php elseif( $settings['content_layout_style'] == 5 ) : ?>

                    <div class="single__price__header">
                        <?php $this->qs_paddle_price_rate(); ?>
                        <div class="price__title__with__ribbon">
                            <?php $this->qs_paddle_ready_price_single_title(); ?>
                            <?php $this->qs_paddle_ready_price_ribon(); ?>
                        </div>
                        <?php $this->qs_paddle_ready_price_single_subtitle(); ?>
                    </div>
                    <?php $this->qs_paddle_ready_price_features(); ?>
                    <?php $this->qs_paddle_ready_price_footer(); ?>

                <?php elseif( $settings['content_layout_style'] == 6 || $settings['content_layout_style'] == 9 ) : ?>

                    <?php $this->qs_paddle_ready_price_ribon(); ?>
                    <div class="single__price__header">
                        <?php $this->qs_paddle_price_rate(); ?>
                        <?php $this->qs_paddle_ready_price_title(); ?>
                    </div>
                    <?php $this->qs_paddle_ready_price_description(); ?>
                    <?php $this->qs_paddle_ready_price_features(); ?>
                    <?php $this->qs_paddle_ready_price_footer(); ?>
                
                <?php elseif( $settings['content_layout_style'] == 10 ) : ?>
                
                    <?php $this->qs_paddle_ready_price_ribon(); ?>
                    <div class="single__price__header">
                        <?php $this->qs_paddle_ready_price_title(); ?>
                    </div>                    
                    <?php $this->qs_paddle_ready_price_features(); ?>
                    <?php $this->qs_paddle_ready_price_description(); ?>
                    <?php $this->qs_paddle_price_rate(); ?>
                    <?php $this->qs_paddle_ready_price_footer(); ?>
                <?php elseif( $settings['content_layout_style'] == 11 ) : ?>

                    <?php $this->qs_paddle_ready_price_ribon(); ?>
                    <?php $this->qs_paddle_price_rate(); ?>
                    <div class="single__price__header">
                        <?php $this->qs_paddle_ready_price_title(); ?>
                    </div>
                    <?php $this->qs_paddle_ready_price_description(); ?>
                    <?php $this->qs_paddle_ready_price_features(); ?>
                    <?php $this->qs_paddle_ready_price_footer(); ?>

                <?php elseif( $settings['content_layout_style'] == 12 ) : ?>

                    <?php $this->qs_paddle_ready_price_ribon(); ?>
                    <div class="single__price__header">
                        <?php $this->qs_paddle_ready_price_title(); ?>
                    </div>
                    <?php $this->qs_paddle_price_rate(); ?>
                    <?php $this->qs_paddle_ready_price_description(); ?>
                    <?php $this->qs_paddle_ready_price_footer(); ?>      
                    <?php $this->qs_paddle_ready_price_features(); ?>

                <?php elseif( $settings['content_layout_style'] == 13 ) : ?>

                    <?php $this->qs_paddle_ready_price_ribon(); ?>
                    <?php $this->qs_paddle_ready_price_icon(); ?>
                    <div class="single__price__header">
                        <?php $this->qs_paddle_ready_price_title(); ?>
                    </div>
                    <?php $this->qs_paddle_ready_price_features(); ?>
                    <?php $this->qs_paddle_ready_price_description(); ?>
                    <?php $this->qs_paddle_price_rate(); ?>
                    <?php $this->qs_paddle_ready_price_footer(); ?>      

                <?php else: ?>

                    <?php $this->qs_paddle_ready_price_ribon(); ?>
                    <div class="single__price__header">
                        <?php $this->qs_paddle_ready_price_title(); ?>
                        <?php $this->qs_paddle_price_rate(); ?>
                    </div>
                    <?php $this->qs_paddle_ready_price_features(); ?>
                    <?php $this->qs_paddle_ready_price_footer(); ?>

                <?php endif; ?>
            </div>
        <?php
    }

    public function qs_paddle_ready_price_icon(){
        $settings = $this->get_settings_for_display(); ?>
        <div class="price__icon">
            <?php
                if( $settings['element_ready_header_icon_type'] == 'img' ){  
                    echo Group_Control_Image_Size:: get_attachment_image_html( $settings, 'headerimagesize', 'headerimage' );
                }else{
                    echo '<i class="'.$settings['headericon'].'"></i>';
                }
            ?>
        </div>
        <?php
    }

    

    public function qs_paddle_ready_price_ribon(){
        $settings = $this->get_settings_for_display();

        if ( 'font' == $settings['ribon_type'] && !empty( $settings['ribon_font_icon'] ) ) {
            $element = '<div class="single__price__ribon"><i class="'.esc_attr( $settings['ribon_font_icon'] ).'"></i></div>';
        }elseif( 'img' == $settings['ribon_type'] && !empty( $settings['ribon_image_icon'] ) ){
            $element_ready_array = $settings['ribon_image_icon'];
            $element_ready_link  = wp_get_attachment_image_url( $element_ready_array['id'], 'thumbnail' );
            $image         = Group_Control_Image_Size::get_attachment_image_html( $settings, 'ribon_image_size', 'ribon_image_icon');
            $element       = '<div class="single__price__ribon">'.$image.'</div>';
        }elseif ( 'text' == $settings['ribon_type'] && !empty( $settings['ribon_text_icon'] ) ) {
            $element = '<div class="single__price__ribon">'.esc_html( $settings['ribon_text_icon'] ).'</div>';
        }else{
            $element = '';
        }
        echo wp_kses_post( $element );
    }

    public function qs_paddle_ready_price_title(){
        $settings = $this->get_settings_for_display();

        /*---------------------------
            TITLE
        ----------------------------*/
        if( !empty($settings['pricing_title']) ){
            $title = '<div class="price__title"><h3>'.esc_html( $settings['pricing_title'] ).'</h3></div>';
        }else{
            $title = '';
        }

        /*----------------------------
            Subtitle
        -----------------------------*/
        if ( !empty( $settings['subtitle'] ) ) {
            $subtitle = '<div class="price__subtitle">'.esc_html( $settings['subtitle'] ).'</div>';
        }else{
            $subtitle = '';
        }

        /*----------------------------
            TITLE CONDITION
        ------------------------------*/
        if ( !empty($settings['subtitle_position']) ) {
            if ( 'before_title' == $settings['subtitle_position'] ) {
                $title_subtitle = $subtitle . $title;
            }elseif( 'after_title' == $settings['subtitle_position'] ){
                $title_subtitle = $title . $subtitle;
            }elseif( empty($settings['subtitle']) ){
                $title_subtitle = $title . $subtitle;
            }
        }else{
            $title_subtitle = $title . $subtitle;
        }
        echo wp_kses_post( $title_subtitle );
    }

    public function qs_paddle_ready_price_single_title(){
        $settings = $this->get_settings_for_display();
        /*---------------------------
            TITLE
        ----------------------------*/
        if( !empty($settings['pricing_title']) ){
            echo '<div class="price__title"><h3>'.esc_html( $settings['pricing_title'] ).'</h3></div>';
        }
    }

    public function qs_paddle_ready_price_single_subtitle(){
        $settings = $this->get_settings_for_display();
        /*----------------------------
            Subtitle
        -----------------------------*/
        if ( !empty( $settings['subtitle'] ) ) {
            echo '<div class="price__subtitle">'.esc_html( $settings['subtitle'] ).'</div>';
        }
    }

    public function qs_paddle_ready_price_description(){
        $settings = $this->get_settings_for_display();
        /*---------------------------
            TITLE
        ----------------------------*/
        if( !empty($settings['pricing_desc']) ){
            echo '<div class="price__desc">'.wp_kses( $settings['pricing_desc'], wp_kses_allowed_html( 'post' ) ).'</div>';
        }
    }

    private function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'dollar'       => '&#36;',
            'baht'         => '&#3647;',
            'euro'         => '&#128;',
            'franc'        => '&#8355;',
            'guilder'      => '&fnof;',
            'indian_rupee' => '&#8377;',
            'krona'        => 'kr',
            'lira'         => '&#8356;',
            'peseta'       => '&#8359',
            'peso'         => '&#8369;',
            'pound'        => '&#163;',
            'real'         => 'R$',
            'ruble'        => '&#8381;',
            'rupee'        => '&#8360;',
            'shekel'       => '&#8362;',
            'won'          => '&#8361;',
            'yen'          => '&#165;',
        ];
        return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ]: '';
    }

    public function qs_paddle_price_rate(){

        $settings = $this->get_settings_for_display();
        
        if(isset($settings['paddle_product']) && $settings['paddle_product'] !='' && method_exists($this,'er_paddle_get_product')){
            $paddle = qs_paddle_intregration_get_paddle_products($settings['paddle_product']);

            if( isset($paddle->list_price->net)){
                $settings['element_ready_original_price'] = $paddle->list_price->net;
            }

            if( isset($paddle->price->net)){
                $settings['element_ready_price']  = $paddle->price->net;
            }
            
        }
        
      
        // Currency symbol
        $currencysymbol = '';
        if ( ! empty( $settings['element_ready_currency_symbol'] ) ) {
            if ( $settings['element_ready_currency_symbol'] != 'custom' ) {
                $currencysymbol = '<span class="price__currency">'.$this->get_currency_symbol( $settings['element_ready_currency_symbol'] ).'</span>';
            } else {
                $currencysymbol = '<span class="price__currency">'.$settings['element_ready_currency_symbol_custom'].'</span>';
            }
        } ?>
        <div class="price__rate">
            <?php
                if( $settings['element_ready_offer_price'] == 'yes' && !empty( $settings['element_ready_original_price'] ) ){

                    if ( 'left' == $settings['element_ready_currency_position'] ) {
                        echo '<h3><span class="old__price">'.$currencysymbol.'<del>'.esc_attr__( $settings['element_ready_original_price'],'qs-paddle-intregration' ).'</del></span><span class="new__price">'.$currencysymbol.esc_attr__( $settings['element_ready_price'],'qs-paddle-intregration' ).'</span> <span class="period__price">'.esc_attr__( $settings['element_ready_period'],'qs-paddle-intregration' ).'</span></h3>';
                    }elseif ( 'right' == $settings['element_ready_currency_position'] ) {
                        echo '<h3><span class="old__price">'.'<del>'.esc_attr__( $settings['element_ready_original_price'],'qs-paddle-intregration' ).$currencysymbol.'</del></span><span class="new__price">'.esc_attr__( $settings['element_ready_price'],'qs-paddle-intregration' ).$currencysymbol.'</span> <span class="period__price">'.esc_attr__( $settings['element_ready_period'],'qs-paddle-intregration' ).'</span></h3>';
                    }
                }else{
                    if( !empty($settings['element_ready_price']) ){
                        if ( 'left' == $settings['element_ready_currency_position'] ) {
                            echo '<h3><span class="new__price">'.$currencysymbol.esc_attr__( $settings['element_ready_price'],'qs-paddle-intregration' ).'</span> <span class="period__price">'.esc_attr__( $settings['element_ready_period'],'qs-paddle-intregration' ).'</span></h3>';
                        }elseif ( 'right' == $settings['element_ready_currency_position'] ) {
                            echo '<h3><span class="new__price">'.esc_attr__( $settings['element_ready_price'],'qs-paddle-intregration' ).$currencysymbol.'</span> <span class="period__price">'.esc_attr__( $settings['element_ready_period'],'qs-paddle-intregration' ).'</span></h3>';
                        }
                    }
                }
            ?>
        </div>
    <?php 
    }

    public function qs_paddle_ready_price_features(){
        $settings = $this->get_settings_for_display(); ?>

        <?php if( $settings['element_ready_features_list'] ): ?>
            <div class="single__price__body">
            <ul  class="price__features">
                    <?php foreach ( $settings['element_ready_features_list'] as $features ): ?>
                        <li class="<?php if( $features['element_ready_old_features'] == 'yes' ){ echo 'off'; }?> elementor-repeater-item-<?php echo $features['_id']; ?>" >
                            <?php $features_txt  = str_replace( ['{', '}', '[', ']','(RIGHT)','(/RIGHTEND)'], ['<span class="content__span">', '</span>','<b>', '</b>','<span style="float:right;">', '</span>'], $features['element_ready_features_title']); ?>
                            <?php
                                if( 'yes' == $settings['element_ready_show_features_icon'] ){
                                    
                                    if( !empty( $features['features_image_icon'] ) &&  'img' == $features['features_icon_type'] ){  
                                        echo Group_Control_Image_Size:: get_attachment_image_html( $features, 'full', 'features_image_icon' );
                                    }elseif( !empty( $features['element_ready_features_icon'] ) &&  'font' == $features['features_icon_type'] ){
                                        echo qs_paddle_intregration_render_icons( $features['element_ready_features_icon'] );
                                    }
                                }

                                echo wp_kses_post( $features_txt );
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif;
    }

    public function qs_paddle_ready_price_footer(){

        $settings = $this->get_settings_for_display();
     
        if ( ! empty( $settings['element_ready_button_link']['url'] ) ) {
            
            $this->add_render_attribute( 'url', 'class', 'price_btn' );
            
            if(isset($settings['element_ready_button_link']['custom_attributes'])){
                $this->add_render_attribute( 'url', 'class', $settings['element_ready_button_link']['custom_attributes']);   
            }
            
            if(isset($settings['price_woocommerce_product_id']) && $settings['price_woocommerce_product_id'] !='') {
                $this->add_render_attribute( 'url', 'data-wcid', $settings['price_woocommerce_product_id']);     
            }

            if(isset($settings['paddle_product']) && $settings['paddle_product'] !=''){
                $this->add_render_attribute( 'url', 'data-productid', $settings['paddle_product']); 
                $this->add_render_attribute( 'url', 'href', 'javascript:void(0)' );  
                $this->add_render_attribute( 'url', 'class', 'qs-paddle-integration-buy' );  
            }
           
            if($settings['element_ready_custom_product_id'] !=''){
                $this->add_render_attribute( 'url', 'data-product-id', $settings['element_ready_custom_product_id']);   
            }
           

            if(isset($settings['paddle_product']) && $settings['element_ready_button_link']['url'] =='#' && $settings['element_ready_custom_product_id'] !=''){
                $this->add_render_attribute( 'url', 'href', 'javascript:void(0)' );  
            }else{
                $this->add_render_attribute( 'url', 'href', $settings['element_ready_button_link']['url'] );
            }
            

            if ( $settings['element_ready_button_link']['is_external'] ) {
                $this->add_render_attribute( 'url', 'target', '_blank' );
            }

            if ( ! empty( $settings['element_ready_button_link']['nofollow'] ) ) {
                $this->add_render_attribute( 'url', 'rel', 'nofollow' );
            }
        }

        if ( 'yes' == $settings['element_ready_price_button'] ) {

                if( is_array($settings['element_ready_button_icon']['value']) ){
                    $icons_data = $settings['element_ready_button_icon']['value']['url'];
                }elseif($settings['element_ready_button_icon']['value']){
                    $icons_data = $settings['element_ready_button_icon']['value'];
                }

                if ( !empty( $icons_data ) ) {

                    if ( 'left'  == $settings['element_ready_button_icon_alignment'] ) {
                        echo '<div class="single__price__footer">'.sprintf( '<a %1$s>%2$s %3$s</a>', $this->get_render_attribute_string( 'url' ), qs_paddle_intregration_render_icons( $settings['element_ready_button_icon'], 'price_btn_icon_left' ), $settings['element_ready_button_text'] ).'</div>';
                    }elseif ( 'right'  == $settings['element_ready_button_icon_alignment'] ) {
                        echo '<div class="single__price__footer">'.sprintf( '<a %1$s>%2$s %3$s</a>', $this->get_render_attribute_string( 'url' ), $settings['element_ready_button_text'], qs_paddle_intregration_render_icons( $settings['element_ready_button_icon'], 'price_btn_icon_right' ) ).'</div>';
                    }
                }else{
                    echo '<div class="single__price__footer">'.sprintf( '<a %1$s>%2$s</a>', $this->get_render_attribute_string( 'url' ), $settings['element_ready_button_text'] ).'</div>';
                }
        }
    }
}