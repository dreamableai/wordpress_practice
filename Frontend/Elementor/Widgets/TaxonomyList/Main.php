<?php
namespace BlogKit\Frontend\Elementor\Widgets\TaxonomyList;

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
        return 'blogkit-TaxonomyList';
    }

    public function get_title()
    {
        return esc_html__('Taxonomy List', 'blogkit');
    }

    public function get_icon()
    {
        return 'blogkit-icon-calendar blogkit-icon';
    }

    public function get_categories()
    {
        return ['blogkit'];
    }

    public function get_keywords()
    {
        return ['taxonomy', 'categories list', 'tags list', 'blogkit'];
    }

    public function get_style_depends()
    {
        return ['blogkit-style-2'];
    }

    /**
     * Register controls.
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'blogkit_taxonomy_list_settings',
            [
                'label' => esc_html__('Taxonomy List', 'blogkit'),
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