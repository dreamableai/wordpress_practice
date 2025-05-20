<?php
/**
 * Blog Grid Widget View for Elementor
 * Compatible with any theme, styled like abcblog theme
 */
$settings = $this->get_settings_for_display();
// Pagination setup
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = [
    'post_type' => 'post',
    'posts_per_page' => $settings['posts_per_page'],
    'orderby' => $settings['orderby'],
    'order' => $settings['order'],
    'paged' => $paged,
];

if (!empty($settings['category'])) {
    $args['category_name'] = implode(',', $settings['category']);
}

$query = new WP_Query($args);

if ($query->have_posts()) :
    echo '<div class="blogkit-blog-grid-wrapper blogkit-grid-columns">';

    while ($query->have_posts()) : $query->the_post();
        ?>
        <div class="blogkit-blog-grid-item blog-post-standard">
            <?php if (has_post_thumbnail()) : ?>
                <div class="sbthumb">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('large'); ?>
                    </a>
                </div>
            <?php endif; ?>

            <div class="sbcontents">
                <h3 class="blog-title-standard">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>

                <div class="postmeta">
                    <span class="posted-on">
                        <i class="fa fa-calendar"></i> <?php the_date(); ?>
                    </span>
                    <span class="posted-by">
                        <i class="fa fa-user"></i> <?php the_author(); ?>
                    </span>
                    <span class="comment-link">
                        <i class="fa fa-comments"></i> <?php comments_number(); ?>
                    </span>
                </div>

                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div>
            </div>
        </div>
        <?php
    endwhile;

    echo '</div>'; // .blogkit-blog-grid-wrapper

    // Pagination
    $big = 999999999; // need an unlikely integer
    $pagination_links = paginate_links([
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, $paged),
        'total' => $query->max_num_pages,
        'prev_text' => __('« Previous', 'blogkit'),
        'next_text' => __('Next »', 'blogkit'),
        'type' => 'list',
    ]);

    if ($pagination_links) {
        echo '<div class="blogkit-pagination">' . $pagination_links . '</div>';
    }

    wp_reset_postdata();
else :
    echo '<p>' . esc_html__('No posts found.', 'blogkit') . '</p>';
endif;