<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
use BlogKit\Admin\Assets\SVG;
use Elementor\Icons_Manager;
/**
 * Blog Grid Widget View for Elementor
 * Compatible with any theme, styled like abcblog theme
 */

$settings = $this->get_settings_for_display();

// Pagination setup
$paged = 1;
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
    $paged = get_query_var('page');
}


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



if ($query->have_posts()):
    echo '<div class="blogkit-card-grid-wrapper blogkit-grid-columns">';

    while ($query->have_posts()):
        $query->the_post();
        ?>
        <div class="card">
            <div class="card-header">
                <?php if (has_post_thumbnail()): ?>
                    <div class="sbthumb">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('large'); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php
                if ( 'yes' === $settings['show_category'] ) {

                    $categories = get_the_category();
                if ($categories && !is_wp_error($categories)) {
                    $first_category = $categories[0];
                    $category_link = get_category_link($first_category->term_id);
                    echo '<a href="' . esc_url($category_link) . '" class="category">' . esc_html($first_category->name) . '</a>';
                }
		}


                
                ?>


            </div>
            <div class="card-body">
                <div class="meta">
                    <span class="meta-author-name"><?php echo get_avatar(get_the_author_meta('ID')); ?>
                        <?php the_author(); ?></span>
                    <span class="meta-date"><?php echo SVG::Calender();
                    echo get_the_date('M j, Y'); ?> </span>
                    <span class="meta-comments">
                        <?php echo SVG::Comments();
                        comments_number('No Comments', '1', '%'); ?></span>
                </div>
                <!-- Title -->
                <?php
                if ('yes' === $settings['show_title']) {
                    $title_tag = $settings['title_tag'];
                    echo '<a href="' . get_the_permalink() . '"><' . $title_tag . ' class="card-title">' . get_the_title() . '</' . $title_tag . '></a>';
                }
                ?>


                <?php
                if ('yes' === $settings['show_excerpt']) {
                    echo '<p class="card-excerpt">' . get_the_excerpt() . '</p>';
                }



                if ('yes' === $settings['show_read_more'] && !empty($settings['read_more_text'])) {
                    echo '<a href="' . get_the_permalink() . '" class="card-more-link">' . $settings['read_more_text'] . '</a>';
                }
                ?>


            </div>
        </div>
        <?php
    endwhile;

    echo '</div>'; // .blogkit-card-grid-wrapper

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
        echo '<div class="blogkit-pagination">' . wp_kses_post($pagination_links) . '</div>';
    }

    wp_reset_postdata();
else:
    echo '<p>' . esc_html__('No posts found.', 'blogkit') . '</p>';
endif;



?>