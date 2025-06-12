<?php
namespace BlogKit\Frontend\Elementor\Widgets\CardGrid;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'blogkit-card-grid';
    }

    public function get_title()
    {
        return esc_html__('Card Grid', 'blogkit');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid blogkit-icon';
    }

    public function get_categories()
    {
        return ['blogkit'];
    }

    public function get_keywords()
    {
        return ['blog', 'card', 'grid', 'posts', 'blogkit'];
    }


    /**
     * Register controls.
     */
    protected function register_controls()
    {



        // Query Tab 
        $this->start_controls_section(
            'blogkit_card_grid_settings',
            [
                'label' => esc_html__('Query', 'blogkit'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'blogkit'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'blogkit'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '1' => esc_html__('1 Column', 'blogkit'),
                    '2' => esc_html__('2 Columns', 'blogkit'),
                    '3' => esc_html__('3 Columns', 'blogkit'),
                    '4' => esc_html__('4 Columns', 'blogkit'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper' => 'grid-template-columns: repeat({{VALUE}}, 1fr);',
                ],
            ]
        );


        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'blogkit'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Date', 'blogkit'),
                    'title' => esc_html__('Title', 'blogkit'),
                    'rand' => esc_html__('Random', 'blogkit'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'blogkit'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => esc_html__('Descending', 'blogkit'),
                    'ASC' => esc_html__('Ascending', 'blogkit'),
                ],
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Category', 'blogkit'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_blogkit_categories(),
                'multiple' => true,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Layout Tab 
        $this->start_controls_section(
            'blogkit_card_grid_layout',
            [
                'label' => esc_html__('Layout', 'blogkit'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        // Category switch control
        $this->add_control(
            'show_category',
            [
                'label' => esc_html__('Category', 'blogkit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'blogkit'),
                'label_off' => esc_html__('Hide', 'blogkit'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'after',
            ]
        );


        // Title switch control
        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Title', 'blogkit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'blogkit'),
                'label_off' => esc_html__('Hide', 'blogkit'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        // Title tag control 
        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('Title HTML Tag', 'blogkit'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
                'condition' => [
                    'show_title' => 'yes',
                ],
                'separator' => 'after',
            ]
        );


        // Excerpt switch control
        $this->add_control(
            'show_excerpt',
            [
                'label' => esc_html__('Excerpt', 'blogkit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'blogkit'),
                'label_off' => esc_html__('Hide', 'blogkit'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        // Excerpt line 
        $this->add_responsive_control(
            'excerpt_line_length',
            [
                'label' => esc_html__('Excerpt Line Length', 'blogkit'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 10,
                'step' => 1,
                'default' => 2,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-body .card-excerpt' => '-webkit-line-clamp: {{VALUE}} !important;',
                ],
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );


        // Read more switch control
        $this->add_control(
            'show_read_more',
            [
                'label' => esc_html__('Read More', 'blogkit'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'blogkit'),
                'label_off' => esc_html__('Hide', 'blogkit'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        // Read More Text
        $this->add_control(
            'read_more_text',
            [
                'label' => esc_html__('Read More Text', 'blogkit'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('More Details', 'blogkit'),
                'condition' => [
                    'show_read_more' => 'yes',
                ],

            ]
        );

        $this->end_controls_section();

        /**
         * Style section: Grid Item
         */
        $this->start_controls_section(
            'blogkit_card_grid_item_style',
            [
                'label' => esc_html__('Grid Item', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Columns Gap

        $this->add_responsive_control(
            'columns-gap',
            [
                'label' => esc_html__('Columns Gap', 'blogkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 100]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper' => 'column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Rows Gap

        $this->add_responsive_control(
            'rows-gap',
            [
                'label' => esc_html__('Rows Gap', 'blogkit'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 100]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper' => 'row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Border control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .blogkit-card-grid-wrapper .card',
            ]
        );

        //Border Radius
        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => esc_html__('Item Border Radius', 'blogkit'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', 'rem', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        //Background Color
        $this->add_control(
            'item_background_color',
            [
                'label' => esc_html__('Item Background Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        //Box Shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .blogkit-card-grid-wrapper .card',
            ]
        );

        $this->end_controls_section();
        /**
         * Style section: Thumbnail
         */
        $this->start_controls_section(
            'blogkit_card_grid_thumb_style',
            [
                'label' => esc_html__('Thumbnail', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'thumb_border_radius',
            [
                'label' => esc_html__('Border Radius', 'blogkit'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-header img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Style section: Category
         */
        $this->start_controls_section(
            'blogkit_card_grid_category_style',
            [
                'label' => esc_html__('Category', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'selector' => '{{WRAPPER}} .blogkit-card-grid-wrapper .category',
            ]
        );


        // Padding 
        $this->add_responsive_control(
            'category_padding',
            [
                'label' => esc_html__('Padding', 'blogkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'default' => [
                    'top' => 5,
                    'right' => 5,
                    'bottom' => 5,
                    'left' => 5,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'category_radius',
            [
                'label' => esc_html__('Border Radius', 'blogkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'default' => [
                    'top' => 5,
                    'right' => 5,
                    'bottom' => 5,
                    'left' => 5,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs(
            'category_style_tabs'
        );

        $this->start_controls_tab(
            'category_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'blogkit'),
            ]
        );


        // Text Color
        $this->add_control(
            'category_text_color',
            [
                'label' => esc_html__('Text Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .category' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Background Color
        $this->add_control(
            'category_bg_color',
            [
                'label' => esc_html__('Background Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .category' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'category_style_hover_tab',
            [
                'label' => esc_html__('Normal', 'blogkit'),
            ]
        );

        // Hover & Current Text Color
        $this->add_control(
            'category_hover_text_color',
            [
                'label' => esc_html__('Text Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .category:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Hover & Active Background
        $this->add_control(
            'category_hover_bg',
            [
                'label' => esc_html__('Background Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .category:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->end_controls_section();


        /**
         * Style section: Meta
         */
        $this->start_controls_section(
            'blogkit_card_grid_meta_style',
            [
                'label' => esc_html__('Meta Info', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'meta_text_color',
            [
                'label' => esc_html__('Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-body .meta' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-body .meta svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'selector' => '{{WRAPPER}} .blogkit-card-grid-wrapper .card-body .meta',
            ]
        );

        $this->end_controls_section();

        /**
         * Style section: Heading
         */
        $this->start_controls_section(
            'blogkit_card_grid_title_style',
            [
                'label' => esc_html__('Heading', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .blogkit-card-grid-wrapper .card-title',
            ]
        );



        $this->start_controls_tabs(
            'color-tabs'
        );

        $this->start_controls_tab(
            'style_normal_color',
            [
                'label' => esc_html__('Normal', 'blogkit'),
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Text Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'style_hover_color',
            [
                'label' => esc_html__('Hover', 'blogkit'),
            ]
        );

        $this->add_control(
            'heading_hover_color',
            [
                'label' => esc_html__('Text Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();


        /**
         * Style section: Content
         */
        $this->start_controls_section(
            'blogkit_card_grid_excerpt_style',
            [
                'label' => esc_html__('Excerpt', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'excerpt_text_color',
            [
                'label' => esc_html__('Text Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-body .card-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'selector' => '{{WRAPPER}} .blogkit-card-grid-wrapper .card-body .card-excerpt',
            ]
        );

        $this->end_controls_section();

        /**
         * Style section: Read More button
         */
        $this->start_controls_section(
            'blogkit_card_grid_read_more_style',
            [
                'label' => esc_html__('Read More', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .blogkit-card-grid-wrapper .card-more-link',
            ]
        );

        $this->start_controls_tabs(
            'button_style_tabs'
        );

        $this->start_controls_tab(
            'button_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'blogkit'),
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'blogkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-more-link' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'types' => ['classic', 'gradient',],
                'selector' => '{{WRAPPER}} .blogkit-card-grid-wrapper .card-more-link',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'blogkit'),
            ]
        );

        $this->add_control(
            'hover_text_color',
            [
                'label' => esc_html__('Text Color', 'blogkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-more-link:hover' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hover_background',
                'types' => ['classic', 'gradient',],
                'selector' => '{{WRAPPER}} .blogkit-card-grid-wrapper .card-more-link:hover',
            ]
        );

        $this->add_control(
            'btn_border_hover_color',
            [
                'label' => esc_html__('Border Color', 'blogkit'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-more-link:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        // Border 
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'btn_border',
                'selector' => '{{WRAPPER}} .blogkit-card-grid-wrapper .card-more-link',
                'separator' => 'before',
            ]
        );

        // Border Radius
        $this->add_responsive_control(
            'btn_border_radius',
            [
                'label' => esc_html__('Border Radius', 'blogkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'default' => [
                    'top' => 5,
                    'right' => 5,
                    'bottom' => 5,
                    'left' => 5,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-more-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        // Padding 
        $this->add_responsive_control(
            'btn_padding',
            [
                'label' => esc_html__('Padding', 'blogkit'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'default' => [
                    'top' => 5,
                    'right' => 5,
                    'bottom' => 5,
                    'left' => 5,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-card-grid-wrapper .card-more-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );



        $this->end_controls_section();

        /**
         * Style section: Pagination
         */
        $this->start_controls_section(
            'blogkit_card_grid_pagination_style',
            [
                'label' => esc_html__('Pagination', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Spacing 
        $this->add_responsive_control(
            'pagination_spacing',
            [
                'label' => esc_html__('Spacing', 'blogkit'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-pagination' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'pagination_typography',
                'selector' => '{{WRAPPER}} .blogkit-pagination ul li a, {{WRAPPER}} .blogkit-pagination .page-numbers.current',
            ]
        );



        $this->start_controls_tabs(
            'pagination_style_tabs'
        );

        $this->start_controls_tab(
            'pagination_style_normal_tab',
            [
                'label' => esc_html__('Normal', 'blogkit'),
            ]
        );

        // Text Color
        $this->add_control(
            'pagination_text_color',
            [
                'label' => esc_html__('Text Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-pagination ul li a, {{WRAPPER}} .blogkit-pagination .page-numbers.current' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Background Color
        $this->add_control(
            'pagination_bg_color',
            [
                'label' => esc_html__('Background Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-pagination ul' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'pagination_style_hover_tab',
            [
                'label' => esc_html__('Hover', 'blogkit'),
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        // Border Radius
        $this->add_responsive_control(
            'pagination_border_radius',
            [
                'label' => esc_html__('Border Radius', 'blogkit'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-pagination ul li a, {{WRAPPER}} .blogkit-pagination .page-numbers.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


    }

    /**
     * Helper: Get all categories.
     */
    private function get_blogkit_categories()
    {
        $categories = get_categories(['hide_empty' => false]);
        $cats = [];
        if ($categories) {
            foreach ($categories as $category) {
                $cats[$category->slug] = $category->name;
            }
        }
        return $cats;
    }

    /**
     * Render frontend output.
     */
    protected function render()
    {
        include 'RenderView.php';
    }
}
