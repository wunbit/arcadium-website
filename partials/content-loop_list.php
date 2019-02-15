<li id="post-<?php the_ID(); ?>" <?php post_class( 'stm_post_info' ); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
		<div class="post_thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
	<?php } ?>
<div class="post-content">
	<?php if( get_the_title() ): ?>
		<h4 class="stripe_2"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
</h4>
	<?php endif; ?>
	<div class="stm_post_details clearfix">
		<ul class="clearfix">
			<li class="post_date">
				<i class="fa fa fa-clock-o"></i>
				<?php echo get_the_date(); ?>
			</li>
			<li class="post_by"><?php esc_html_e( 'Posted by:', 'crypterio' ); ?> <span><?php the_author(); ?></span></li>
			<li class="post_cat"><?php esc_html_e( 'Category:', 'crypterio' ); ?>
				<span><?php echo implode( ', ', wp_get_post_categories( get_the_ID(), array( 'fields' => 'names' ) ) ) ?></span>
			</li>
		</ul>
		<div class="comments_num">
			<a href="<?php comments_link(); ?>"><i class="fa fa-comment-o"></i><?php comments_number(); ?> </a>
		</div>
	</div>
	<div class="post_excerpt">
		<?php the_excerpt(); ?>
	</div>
	<div class="post_read_more">
		<a class="button bordered icon_right" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'read more', 'crypterio' ); ?>
			<i class="fa fa-chevron-right"></i>
		</a>
	</div>
</div>
</li>
