<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

    $settings = $this->get_settings_for_display();
    $taxonomy = $settings['selected_taxonomy'];

    if (!taxonomy_exists($taxonomy)) {
        echo '<p>' . esc_html__('Selected taxonomy does not exist.', 'blogkit') . '</p>';
        return;
    }

    $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => false,
    ]);

    if (empty($terms) || is_wp_error($terms)) {
        echo '<p>' . esc_html__('No terms found for the selected taxonomy.', 'blogkit') . '</p>';
        return;
    }

    ?>
    <!-- Taxonomy List Area -->
    <div class="blogkit-taxonomy-list-area">
        <!-- Taxonomy Heading -->
        <div class="blogkit-taxonomy-heading">
            <h3><?php echo esc_html(get_taxonomy($taxonomy)->labels->name); ?></h3>
        </div><!-- / Taxonomy Heading -->
        <!-- Taxonomy List -->
        <div class="blogkit-taxonomy-list">
            <?php foreach ($terms as $term): ?>
                <!-- Single Taxonomy -->
                <div class="blogkit-single-taxonomy">
                    <a href="<?php echo esc_url(get_term_link($term)); ?>">
                        <span class="blogkit-taxonomy-name"><?php echo esc_html($term->name); ?></span>
                        <span class="blogkit-taxonomy-count"><?php echo esc_html($term->count); ?></span>
                    </a>
                </div><!--/ Single Taxonomy -->
            <?php endforeach; ?>
        </div><!--/ Taxonomy List -->
    </div><!--/ Taxonomy List Area -->