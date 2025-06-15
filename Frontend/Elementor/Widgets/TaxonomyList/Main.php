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
        return 'blogkit-taxonomy blogkit-icon';
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

        // General Settings
        $this->start_controls_section(
            'blogkit_taxonomy_list_settings',
            [
                'label' => esc_html__('Taxonomy List', 'blogkit'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // get all taxonomies
        $taxonomies = get_taxonomies(['public' => true], 'objects');
        $options = [];
        // get all taxonomies and their post types
        foreach ($taxonomies as $taxonomy) {
            $post_types = $taxonomy->object_type;
            $post_type_labels = array_map(function ($pt) {
                $obj = get_post_type_object($pt);
                return $obj ? $obj->labels->singular_name : $pt;
            }, $post_types);

            $post_type_list = implode(', ', $post_type_labels);
            $label = sprintf('%s (%s)', $taxonomy->label, $post_type_list);
            $options[$taxonomy->name] = $label;
        }

        // taxonomy field
        $this->add_control(
            'selected_taxonomy',
            [
                'label' => esc_html__('Select Taxonomy', 'blogkit'),
                'type' => Controls_Manager::SELECT,
                'options' => $options,
                'default' => 'category', //add a default option for taxonomies field
                'label_block' => true,
            ]
        );

        $this->end_controls_section(); // End: General Settings


        // Box Style Settings
        $this->start_controls_section(
            'style_section_box',
            [
                'label' => esc_html__('Box Style', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // box padding
        $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__('Padding', 'blogkit'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-taxonomy-list-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // box margin
        $this->add_responsive_control(
            'box_margin',
            [
                'label' => esc_html__('Margin', 'blogkit'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-taxonomy-list-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // box background
        $this->add_control(
            'box_bg_color',
            [
                'label' => esc_html__('Background Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-taxonomy-list-area' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        // box border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'selector' => '{{WRAPPER}} .blogkit-taxonomy-list-area',
            ]
        );

        // box border radius
        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => esc_html__('Border Radius', 'blogkit'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-taxonomy-list-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // box box shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .blogkit-taxonomy-list-area',
            ]
        );

        $this->end_controls_section(); // End: Box Style Settings


        // Heading Styles
        $this->start_controls_section(
            'style_section_heading',
            [
                'label' => esc_html__('Heading', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // heading padding
        $this->add_responsive_control(
            'heading_padding',
            [
                'label' => esc_html__('Padding', 'blogkit'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-taxonomy-heading' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // heading color
        $this->add_control(
            'heading_color',
            [
                'label' => esc_html__('Heading Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-taxonomy-heading h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        // heading typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'heading_typography',
                'selector' => '{{WRAPPER}} .blogkit-taxonomy-heading h3',
            ]
        );
        $this->end_controls_section(); // End: Heading Styles

        // Taxonomy Item Styles
        $this->start_controls_section(
            'style_section_taxonomies',
            [
                'label' => esc_html__('Taxonomy Items', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // taxonomy item padding
        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__('Padding', 'blogkit'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .blogkit-single-taxonomy a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // taxonomy item background color
        $this->add_control(
            'item_bg_color',
            [
                'label' => esc_html__('Item Background', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-single-taxonomy,{{WRAPPER}} .blogkit-single-taxonomy a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        // taxonomy item Gap
        $this->add_control(
            'item_spacing',
            [
                'label' => esc_html__('Spacing Between Items', 'blogkit'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} blogkit-taxonomy-list' => 'gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        // taxonomy item border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .blogkit-single-taxonomy',
            ]
        );
        // taxonomy item border radius
        $this->add_responsive_control(
            'item_border_radius',
            [
                'label' => esc_html__('Border Radius', 'blogkit'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}}.blogkit-single-taxonomy' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // taxonomy item box shadow
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .blogkit-single-taxonomy',
            ]
        );
        $this->end_controls_section(); // End: Taxonomy Item Styles

        // Taxonomy Text Styles
        $this->start_controls_section(
            'style_section_text',
            [
                'label' => esc_html__('Text', 'blogkit'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // taxonomy text color
        $this->add_control(
            'term_color',
            [
                'label' => esc_html__('Name Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-taxonomy-name' => 'color: {{VALUE}}',
                ],
            ]
        );
        // taxonomy text typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'term_typography',
                'selector' => '{{WRAPPER}} .blogkit-taxonomy-name, {{WRAPPER}} .blogkit-taxonomy-count',
            ]
        );
        // taxonomy count color
        $this->add_control(
            'count_color',
            [
                'label' => esc_html__('Count Color', 'blogkit'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blogkit-taxonomy-count' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_section(); // End: Taxonomy Text Styles

    }

    /**
     * Render frontend output.
     */
    protected function render()
    {
        include 'RenderView.php';
    }
}