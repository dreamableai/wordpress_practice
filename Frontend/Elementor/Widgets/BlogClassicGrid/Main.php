<?php
namespace BlogKit\Frontend\Elementor\Widgets\BlogClassicGrid;

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


        $this->end_controls_section();
    }
    /**
     * Render frontend output.
     */
    protected function render()
    {
        include 'RenderView.php';
    }
}