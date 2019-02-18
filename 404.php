<?php crypterio_get_header(); ?>
	<div class="page_404">
		<div class="bottom">
			<div class="container">
				<h1>404</h1>
			</div>
			<div class="bottom_wr">
				<div class="container">
					<div class="media">
						<div class="media-body media-middle">
							<h3><?php esc_html_e( 'The page you are looking for does not exist.', 'crypterio' ); ?></h3>
						</div>
						<div class="media-right media-middle">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button icon_right theme_style_3 bordered">
								<?php esc_html_e( 'homepage', 'crypterio' ); ?>
								<i class="fa fa-chevron-right"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
