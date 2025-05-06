<?php
namespace BlogKit\Frontend\Elementor\Widgets\BlogClassicGrid;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'blogkit-blog-classic-grid';
    }
    public function get_title()
    {
        return esc_html__('Blog Classic Grid', 'blogkit');
    }
    public function get_icon()
    {
        return 'eicon-posts-grid blogkit-icon';
    }
    public function get_keywords()
    {
        return ['blog', 'grid', 'posts', 'blogkit'];
    }
    public function get_categories()
    {
        return ['blogkit'];
    }

    /**
     * Register controls.
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'basic_grid_settings',
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

        $this->add_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'blogkit'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => esc_html__('2 Columns', 'blogkit'),
                    '3' => esc_html__('3 Columns', 'blogkit'),
                    '4' => esc_html__('4 Columns', 'blogkit'),
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

        // Grid Item Style
        $this->start_controls_section(
            'section_grid_style',
            [
                'label' => esc_html__('Grid Item', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'grid_bg_color',
            [
                'label' => esc_html__('Background Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-article' => 'background-color: {{VALUE}};',
                ],
                'default' => '#ffffff',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'grid_border',
                'selector' => '{{WRAPPER}} .blogkit-article',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'grid_box_shadow',
                'selector' => '{{WRAPPER}} .blogkit-article',
            ]
        );

        $this->add_control(
            'grid_border_radius',
            [
                'label' => esc_html__('Border Radius', 'blogkit'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-article' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Title Style
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .blogkit-title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Meta Style
        $this->start_controls_section(
            'section_meta_style',
            [
                'label' => esc_html__('Meta', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'selector' => '{{WRAPPER}} .blogkit-meta',
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__('Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-meta' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'meta_link_color',
            [
                'label' => esc_html__('Link Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-meta a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Content Style
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__('Content', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .blogkit-content',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Read More Button Style
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__('Read More Button', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('button_style_tabs');

        $this->start_controls_tab(
            'button_normal_tab',
            [
                'label' => esc_html__('Normal', 'blogkit'),
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => esc_html__('Background Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-readmore' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Text Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-readmore' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => esc_html__('Hover', 'blogkit'),
            ]
        );

        $this->add_control(
            'button_bg_hover_color',
            [
                'label' => esc_html__('Background Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-readmore:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_hover_color',
            [
                'label' => esc_html__('Text Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-readmore:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'blogkit'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

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

    protected function render()
    {
        include 'RenderView.php';
    }
}