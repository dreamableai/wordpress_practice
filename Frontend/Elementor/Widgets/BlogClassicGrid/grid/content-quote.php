<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <h2 class="blog-title-standard"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('includes/templates/post/post-meta'); ?>

    <?php if (has_post_thumbnail()): ?>
        <div class="sbthumb">
            <figure><a href="<?php the_permalink(); ?>"
                    title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('abcblog_blog_grid_thumb'); ?></a>
            </figure>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                <div class="post-icon"><i class="fa fa-quote-left" aria-hidden="true"></i></div>
            </a>
            <?php
            if (is_sticky()) { ?>
                <span class="sticky-post"><?php esc_html_e('Featured', 'abcblog'); ?></span>
            <?php } else { ?>
            <?php } ?>
        </div>

    <?php else: ?>

        <?php
        if (is_sticky()) { ?>
            <div class="sticky-post-text"><?php esc_html_e('Featured', 'abcblog'); ?></div>
        <?php } else { ?>
        <?php } ?>

    <?php endif; ?>

    <div class="sbcontents">
        <?php if (!has_excerpt()) { ?>
            <p><?php echo get_excerpt(250); ?>..</p>
        <?php } else { ?>
            <?php the_excerpt(); ?>
        <?php } ?>
    </div>

    <footer class="stndard-blog-footer">
        <?php get_template_part('includes/templates/social-share-icons'); ?>
        <div class="blogmore-standard"><a href="<?php the_permalink(); ?>"
                title="<?php the_title_attribute(); ?>"><?php esc_html_e('Read More', 'abcblog'); ?></a> </div>
        <div class="clearfix"></div>
    </footer>

</article>