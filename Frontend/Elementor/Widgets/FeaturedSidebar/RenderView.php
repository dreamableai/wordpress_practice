<?php
if (!defined('ABSPATH')) {
    exit;
}

// Featured Post Query
$featured_query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 1
]);

// Sidebar Posts Query
$sidebar_query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 4,
    'offset' => 1
]);
?>

<div class="blogkit-fs-widget">
    <div class="blogkit-fs-grid">
        <!-- Featured Post -->
        <div class="blogkit-fs-featured">
            <?php if ($featured_query->have_posts()) : while ($featured_query->have_posts()) : $featured_query->the_post(); ?>
                <a href="<?php the_permalink(); ?>" class="blogkit-fs-featured-thumb">
                    <?php the_post_thumbnail('large'); ?>
                </a>
                <div class="blogkit-fs-featured-content">
                    <?php
                    $cat = get_the_category();
                    if (!empty($cat)) {
                        echo '<span class="blogkit-fs-category">' . esc_html($cat[0]->name) . '</span>';
                    }
                    ?>
                    <h2 class="blogkit-fs-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="blogkit-fs-meta">
                        <span class="blogkit-fs-author">BY <?php the_author(); ?></span>
                        <span class="blogkit-fs-date"><?php echo get_the_date(); ?></span>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>

        <!-- Sidebar Posts -->
        <div class="blogkit-fs-sidebar">
            <?php if ($sidebar_query->have_posts()) : while ($sidebar_query->have_posts()) : $sidebar_query->the_post(); ?>
                <div class="blogkit-fs-sidebar-item">
                    <a href="<?php the_permalink(); ?>" class="blogkit-fs-sidebar-thumb">
                        <?php the_post_thumbnail('thumbnail'); ?>
                    </a>
                    <div class="blogkit-fs-sidebar-content">
                        <h4 class="blogkit-fs-sidebar-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        <div class="blogkit-fs-sidebar-meta">
                            <?php
                            $cat = get_the_category();
                            if (!empty($cat)) {
                                echo '<span class="blogkit-fs-badge">' . esc_html($cat[0]->name) . '</span>';
                            }
                            ?>
                            <span class="blogkit-fs-sidebar-date"><?php echo get_the_date(); ?></span>
                        </div>
                    </div>
                </div>
            <?php endwhile; wp_reset_postdata(); endif; ?>
        </div>
    </div>
</div>