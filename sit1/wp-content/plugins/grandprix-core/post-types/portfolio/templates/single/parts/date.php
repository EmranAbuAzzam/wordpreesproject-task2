<?php if(grandprix_mikado_options()->getOptionValue('portfolio_single_hide_date') === 'yes') : ?>
    <div class="mkdf-ps-info-item mkdf-ps-date">
	    <?php grandprix_core_get_cpt_single_module_template_part('templates/single/parts/info-title', 'portfolio', '', array( 'title' => esc_attr__('Date:', 'grandprix-core') ) ); ?>
        <p itemprop="dateCreated" class="mkdf-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(grandprix_mikado_get_page_id()); ?>"/>
    </div>
<?php endif; ?>