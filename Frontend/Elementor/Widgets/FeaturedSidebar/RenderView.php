<?php
if (!defined('ABSPATH')) {
    exit;
}

$args = [
    'post_type' => 'post',
    'posts_per_page' => 5,
];

$query = new WP_Query($args);

?>
<?php if ($query->have_posts()) : ?>
    <div class="blogkit-featured-sidebar-widget">
        <div class="blogkit-featured-sidebar-grid">
            <?php $index = 0; while ($query->have_posts()) : $query->the_post(); $index++; ?>
                <div class="blogkit-featured-sidebar-item <?php echo $index === 1 ? 'is-featured' : 'is-sidebar'; ?>">
                    <a href="<?php the_permalink(); ?>" class="item-thumb">
                        <?php the_post_thumbnail($index === 1 ? 'large' : 'thumbnail'); ?>
                    </a>
                    <div class="item-content">
                        <?php
                        $cat = get_the_category();
                        if (!empty($cat)) {
                            echo '<span class="item-category">' . esc_html($cat[0]->name) . '</span>';
                        }
                        ?>
                        <h4 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <span class="item-date"><?php echo get_the_date(); ?></span>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>
