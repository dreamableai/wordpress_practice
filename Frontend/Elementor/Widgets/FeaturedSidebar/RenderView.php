<?php
if (!defined('ABSPATH')) {
    exit;
}

$featured_args = [
    'post_type' => 'post',
    'posts_per_page' => 1,
];

$featured_query = new WP_Query($featured_args);

$sidebar_args = [
    'post_type' => 'post',
    'posts_per_page' => 4,
    'offset' => 1,
];

$sidebar_query = new WP_Query($sidebar_args);
?>

<div class="blogkit-featured-sidebar-widget">
    <div class="blogkit-featured-sidebar-grid">

        <!-- Featured Left Post -->
        <?php if ($featured_query->have_posts()): ?>
            <?php while ($featured_query->have_posts()):
                $featured_query->the_post(); ?>
                <div class="blogkit-featured-sidebar-featured">
                    <a href="<?php the_permalink(); ?>" class="blogkit-featured-sidebar-featured-thumb">
                        <?php the_post_thumbnail('large'); ?>
                    </a>
                    <div class="blogkit-featured-sidebar-featured-content">
                        <div class="blogkit-featured-sidebar-category">
                            <?php
                            $cat = get_the_category();
                            if (!empty($cat)) {
                                echo '<a href="' . esc_url(get_category_link($cat[0]->term_id)) . '" class="blogkit-featured-sidebar-category-link">' . esc_html($cat[0]->name) . '</a>';
                            }
                            ?>
                        </div>
                        <h3 class="blogkit-featured-sidebar-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h3>
                        <div class="blogkit-featured-sidebar-meta">
                            <span class="blogkit-featured-sidebar-author">BY <?php the_author(); ?></span>
                            <span class="blogkit-featured-sidebar-date">— <?php echo get_the_date(); ?></span>
                        </div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        <?php endif; ?>

        <!-- Sidebar Right Posts -->
        <div class="blogkit-featured-sidebar-list">
            <?php if ($sidebar_query->have_posts()): ?>
                <?php while ($sidebar_query->have_posts()):
                    $sidebar_query->the_post(); ?>
                    <div class="blogkit-featured-sidebar-item">
                        <a href="<?php the_permalink(); ?>" class="blogkit-featured-sidebar-item-thumb">
                            <?php the_post_thumbnail('thumbnail'); ?>
                        </a>
                        <div class="blogkit-featured-sidebar-item-content">
                            <h4 class="blogkit-featured-sidebar-item-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <div class="blogkit-featured-sidebar-item-meta">
                                <?php
                                $cat = get_the_category();
                                if (!empty($cat)) {
                                    echo '<span class="blogkit-featured-sidebar-item-category blogkit-cat-' . esc_attr(strtolower($cat[0]->slug)) . '">' . esc_html($cat[0]->name) . '</span>';
                                }
                                ?>
                                <span class="blogkit-featured-sidebar-item-date"><?php echo get_the_date(); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>

    </div>
</div>