<?php
namespace BlogKit\Frontend\Elementor\Assets;

use BlogKit\Admin\Assets\SVG;

if (!defined('ABSPATH')) {
    exit;
}

class CustomIcons
{
    public function __construct()
    {
        add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_icons']);
    }

    public function enqueue_icons()
    {
        $icons = [
            'blogkit-icon-image'    => SVG::Image(),
            'blogkit-icon-audio'    => SVG::Audio(),
            'blogkit-icon-quote'    => SVG::Quote(),
            'blogkit-icon-gallery'  => SVG::Gallery(),
            'blogkit-icon-video'    => SVG::Video(),
            'blogkit-icon-comments' => SVG::Comments(),
            'blogkit-icon-calendar' => SVG::Calender(),
            'blogkit-icon-link'     => SVG::Link(),
            'blogkit-taxonomy'     => SVG::Taxonomy(),
        ];

        $styles = [];

        foreach ($icons as $class => $svg) {
            $styles[] = $this->generate_widget_icon_css($class, $svg);
        }

        $final_css = implode("\n", $styles);
       
        wp_add_inline_style('elementor-editor', $final_css);
    }

    protected function generate_widget_icon_css($class, $svg)
    {
        $clean = preg_replace('/\s+/', ' ', $svg);
        $encoded = rawurlencode($clean);

        return ".{$class}:before {
            content: '';
            display: inline-block;
            width: 20px;
            height: 20px;
            background-image: url(\"data:image/svg+xml;utf8,{$encoded}\");
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            filter: brightness(0) invert(1); 
        }";
    }
}
