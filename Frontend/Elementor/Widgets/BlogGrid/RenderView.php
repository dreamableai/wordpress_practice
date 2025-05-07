<?php
/**
 * Render View file for blog grid Widget.
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

$settings = $this->get_settings_for_display();

$query_args = [
    'post_type' => 'post',
    'posts_per_page' => $settings['posts_per_page'],
    'orderby' => $settings['orderby'],
    'order' => $settings['order'],
];

if (!empty($settings['category'])) {
    $query_args['category_name'] = implode(',', $settings['category']);
}

$query = new \WP_Query($query_args);

if ($query->have_posts()) {
    echo '<div class="blogkit-blog-grid columns-' . esc_attr($settings['columns']) . '">';
    while ($query->have_posts()) {
        $query->the_post();
        ?>
        <div class="blogkit-blog-grid-item">
            <div class="blogkit-blog-grid-thumb">
                <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
            </div>
            <div class="blogkit-blog-grid-content">
                <h3 class="blogkit-blog-grid-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="blogkit-blog-grid-excerpt">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </div>
        <?php
    }
    echo '</div>';
    wp_reset_postdata();
} else {
    echo '<p>' . esc_html__('No posts found.', 'BlogKit') . '</p>';
}