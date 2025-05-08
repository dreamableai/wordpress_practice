<?php 
use BlogKit\Admin\Assets\SVG;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blogkit-article'); ?>>
    <h2 class="blogkit-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    
    <div class="blogkit-meta">
        <span class="blogkit-date"><?php the_date(); ?></span>
        <span class="blogkit-author"><?php echo esc_html__('By', 'blogkit'); ?> <?php the_author_posts_link(); ?></span>
        <?php 
        $categories = get_the_category();
        if (!empty($categories)) {
            echo '<span class="blogkit-category">' . esc_html__('In', 'blogkit') . ' ';
            $output = array();
            foreach ($categories as $category) {
                $output[] = '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
            }
            echo wp_kses_post(implode(', ', $output));
        	echo '</span>';
        }
        ?>
    </div>

    <?php if (has_post_thumbnail()): ?>
        <div class="blogkit-thumb">
            <figure>
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail('medium'); ?>
                </a>
            </figure>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <div class="blogkit-post-icon">
                <?php 
                /* translators: SVG icon, safe output. */
                /* phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped */
                echo SVG::Image();  
                ?></div>
            </a>
            <?php if (is_sticky()): ?>
                <span class="blogkit-sticky-post"><?php esc_html_e('Featured', 'blogkit'); ?></span>
            <?php endif; ?>
        </div>
    <?php elseif (is_sticky()): ?>
        <div class="blogkit-sticky-text"><?php esc_html_e('Featured', 'blogkit'); ?></div>
    <?php endif; ?>

    <div class="blogkit-content">
        <?php 
        if (has_excerpt()) {
            the_excerpt();
        } else {
            echo wp_kses_post(wp_trim_words(get_the_content(), 25, '...'));
        }
        ?>
    </div>

    <footer class="blogkit-footer">
        <a href="<?php the_permalink(); ?>" class="blogkit-readmore"><?php esc_html_e('Read More', 'blogkit'); ?></a>
    </footer>
</article>