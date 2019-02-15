<?php
$vc_status = get_post_meta( get_the_ID(), '_wpb_vc_js_status', true );
$is_shop   = false;
if ( ( function_exists( 'is_cart' ) && is_cart() ) || ( function_exists( 'is_shop' ) && is_shop() ) || ( function_exists( 'is_product' ) && is_product() ) || ( function_exists( 'is_account_page' ) && is_account_page() ) || ( function_exists( 'is_checkout' ) && is_checkout() ) ) {
	$is_shop = true;
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( has_post_thumbnail() ) { ?>
					<div class="post_thumbnail">
						<?php the_post_thumbnail( 'crypterio-image-1110x550-croped' ); ?>
					</div>
				<?php } ?>
	<div class="entry-content">
		<?php if ( $vc_status != 'false' && $vc_status == true || $is_shop ) { ?>
			<?php the_content(); ?>
		<?php } else { ?>
			<div class="text_block wpb_text_column clearfix">
				<?php the_content(); ?>
			</div>
		<?php } ?>
		<?php
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'crypterio' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'crypterio' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div>
	<?php
	if ( comments_open() || get_comments_number() ) {
		comments_template();
	}
	?>

</article>
