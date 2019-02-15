<div class="stm_post_info">
	<div class="stm_post_details clearfix">
		<ul class="clearfix">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="post_thumbnail">
					<?php the_post_thumbnail( 'crypterio-image-1110x550-croped' ); ?>
				</div>
			<?php } ?>
			<li class="post_date">
				<i class="fa fa fa-clock-o"></i>
				<?php echo get_the_date(); ?>
			</li>
			<li class="post_by"><?php esc_html_e( 'Posted by:', 'crypterio' ); ?>
				<span><?php the_author(); ?></span>
			</li>
			<li class="post_cat"><?php esc_html_e( 'Category:', 'crypterio' ); ?>
				<span><?php echo implode( ', ', wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ) ) ?></span>
			</li>
		</ul>
		<div class="comments_num">
			<a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i><?php comments_number(); ?> </a>
		</div>
	</div>
</div>
