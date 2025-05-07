<?php
namespace BlogKit\Frontend\Elementor\Widgets\BlogGrid;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

class Main extends Widget_Base
{
    public function get_name()
    {
        return 'blogkit-blog-grid';
    }

    public function get_title()
    {
        return esc_html__('Blog Grid', 'BlogKit');
    }

    public function get_icon()
    {
        return 'eicon-posts-grid blogkit-icon';
    }

    public function get_categories()
    {
        return ['BlogKit'];
    }

    public function get_keywords()
    {
        return ['blog', 'grid', 'posts', 'BlogKit'];
    }

    public function get_style_depends()
    {
        return ['blogkit-blog-grid'];
    }

    /**
     * Register controls.
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'blogkit_blog_grid_settings',
            [
                'label' => esc_html__('Query', 'BlogKit'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Posts Per Page', 'BlogKit'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'BlogKit'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => esc_html__('2 Columns', 'BlogKit'),
                    '3' => esc_html__('3 Columns', 'BlogKit'),
                    '4' => esc_html__('4 Columns', 'BlogKit'),
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'BlogKit'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Date', 'BlogKit'),
                    'title' => esc_html__('Title', 'BlogKit'),
                    'rand' => esc_html__('Random', 'BlogKit'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'BlogKit'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => esc_html__('Descending', 'BlogKit'),
                    'ASC' => esc_html__('Ascending', 'BlogKit'),
                ],
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => esc_html__('Category', 'BlogKit'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_blogkit_categories(),
                'multiple' => true,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        /**
         * Style section: Grid Item
         */
        $this->start_controls_section(
            'blogkit_blog_grid_item_style',
            [
                'label' => esc_html__('Grid Item', 'BlogKit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_padding',
            [
                'label' => esc_html__('Item Padding', 'BlogKit'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-blog-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .blogkit-blog-grid-item',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .blogkit-blog-grid-item',
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