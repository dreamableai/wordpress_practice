<?php
/**
 * Render View file for blog classic grid Widget.
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$settings = $this->get_settings_for_display();

$query_args = [
    'post_type' => 'post',
    'posts_per_page' => $settings['posts_per_page'] ?? 6,
    'orderby' => $settings['orderby'] ?? 'date',
    'order' => $settings['order'] ?? 'DESC',
];

if (!empty($settings['category'])) {
    $query_args['category_name'] = implode(',', $settings['category']);
}

$query = new \WP_Query($query_args);

if ($query->have_posts()) {
    echo '<div class="blogkit-classic-grid columns-' . esc_attr($settings['columns'] ?? '3') . '">';
    while ($query->have_posts()) {
        $query->the_post();
        $post_format = get_post_format() ?: 'standard';
        
        // Load the appropriate template based on post format
        $template_path = __DIR__ . '/grid/content' . ($post_format !== 'standard' ? '-' . $post_format : '') . '.php';
        if (file_exists($template_path)) {
            include $template_path;
        } else {
            include __DIR__ . '/grid/content.php';
        }
    }
    echo '</div>';
    wp_reset_postdata();
} else {
    echo '<p>' . esc_html__('No posts found.', 'blogkit') . '</p>';
}