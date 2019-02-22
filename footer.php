    </div> <!--.container-->
    </div> <!--#main-->
    </div> <!--.content_wrapper-->
	<?php
	$crypterio_config = crypterio_config();
	$logo_tmp = '';
	if (!empty($crypterio_config['layout']) && $crypterio_config['layout'] != 'layout_1' && $crypterio_config['layout'] != 'layout_12') {
		$logo_tmp = $crypterio_config['layout'] . '_';
	}
	$footer_style = get_theme_mod('footer_style', 'style_1');
	$socials = crypterio_get_socials('footer_socials');
	$page_ID = crypterio_page_id();
	$copyright_class = '';
	$copyright_border_top = get_post_meta($page_ID, 'separator_footer_copyright_border_t', true);

	if ($copyright_border_top) {
		$copyright_class .= ' border-top-hide';
	}

	$copyright = get_theme_mod('footer_copyright', wp_kses(__("Copyright &copy; 2012-2017 crypterio Theme by <a href='https://themeforest.net/item/crypterio-business-finance-wordpress-theme/14740561' target='_blank'>Stylemix Themes</a>. All rights reserved", 'crypterio'), array('a' => array('href' => array(), 'target' => array()))));
	$footer_class = '';
	$footer_class = ' ' . $footer_style;

	if (empty($copyright) || empty($socials) && $footer_style != 'style_1') {
		$footer_class .= ' no-copyright';
	}

	?>
	<?php if (!get_theme_mod('footer_show_hide', false)): ?>
        <footer id="footer" class="footer<?php echo esc_attr($footer_class); ?>">

			<?php if (get_theme_mod('footer_sidebar_count', 4) != 'disable'): ?>
                <div class="widgets_row">
                    <div class="container">
                        <div class="footer_widgets">
                            <div class="row">
								<?php
								$footer_sidebar_count = intval(get_theme_mod('footer_sidebar_count', 4));
								$col = 12 / $footer_sidebar_count;
								$socials_position = get_theme_mod('socials_position', 1);
								for ($count = 1; $count <= $footer_sidebar_count; $count++): ?>
                                    <div class="col-lg-<?php echo esc_attr($col); ?> col-md-<?php echo esc_attr($col); ?> col-sm-6 col-xs-12">
										<?php if ($count == 1): ?>
											<?php if (!get_theme_mod('footer_logo_show_hide', false)): ?>
												<?php if ($footer_logo = get_theme_mod('footer_logo', get_template_directory_uri() . '/assets/images/tmp/footer/logo_' . $logo_tmp . 'default.svg')): ?>
                                                    <div class="footer_logo">
                                                        <a href="<?php echo esc_url(home_url('/')) ?>">
                                                            <img src="<?php echo esc_url($footer_logo); ?>"
                                                                 alt="<?php echo esc_attr(get_bloginfo('name')); ?>"/>
                                                        </a>
                                                    </div>
												<?php endif; ?>
											<?php endif; ?>
											<?php if ($footer_text = get_theme_mod('footer_text', esc_html__('Fusce interdum ipsum egestas urna amet fringilla, et placerat ex venenatis. Aliquet luctus pharetra. Proin sed fringilla lectusar sit amet tellus in mollis. Proin nec egestas nibh, eget egestas urna. Phasellus sit amet vehicula nunc. In hac habitasse platea dictumst. ', 'crypterio'))): ?>
                                                <div class="footer_text">
                                                    <p><?php echo wp_kses_post($footer_text); ?></p>
                                                </div>
											<?php endif; ?>
										<?php endif; ?>
										<?php dynamic_sidebar('crypterio-footer-' . $count); ?>
										<?php if ($count == $socials_position && $socials && $footer_style == 'style_2'): ?>
                                            <div class="socials">
												<?php $labels = crypterio_socials_list(); ?>
                                                <ul>
													<?php foreach ($socials as $key => $val): ?>
                                                        <li>
                                                            <a href="<?php echo esc_url($val); ?>" target="_blank"
                                                               data-social="<?php echo (!empty($labels[$key])) ? $labels[$key] : ''; ?>"
                                                               class="social-<?php echo esc_attr($key); ?>">
                                                                <i class="fa fa-<?php echo esc_attr($key); ?>"></i>
                                                            </a>
                                                        </li>
													<?php endforeach; ?>
                                                </ul>
                                            </div>
										<?php endif; ?>
                                    </div>
								<?php endfor; ?>
                            </div>
                        </div>
                    </div>
                </div>
			<?php endif; ?>
      <?php echo'<div class="footer-copyright">Copyright © 2019 Arcadium</div>'?>
			<?php if (!empty($copyright) || !empty($socials) && $footer_style == 'style_1') : ?>
                <div class="copyright_row<?php echo esc_attr($copyright_class); ?><?php echo (get_theme_mod('footer_sidebar_count', 4) == 'disable') ? ' widgets_disabled' : ''; ?>">
                    <div class="container">
                        <div class="copyright_row_wr">
							<?php if (!empty($socials) && $footer_style == 'style_1'): ?>
                                <div class="socials">
                                    <ul>
										<?php foreach ($socials as $key => $val): ?>
                                            <li>
                                                <a href="<?php echo esc_url($val); ?>" target="_blank"
                                                   class="social-<?php echo esc_attr($key); ?>">
                                                    <i class="fa fa-<?php echo esc_attr($key); ?>"></i>
                                                </a>
                                            </li>
										<?php endforeach; ?>
                                    </ul>
                                </div>
							<?php endif; ?>
							<?php if (!empty($copyright)): ?>
                                <div class="copyright">
									<?php echo wp_kses($copyright, array('a' => array('href' => array(), 'target' => array()))); ?>
                                </div>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
			<?php endif; ?>
        </footer>
	<?php endif; ?>
    </div> <!--#wrapper-->
<?php
if (get_theme_mod('frontend_customizer', false)) {
	//get_template_part( 'partials/frontend_customizer' );
}

do_action('blockchain_before_footer_end');

?>
<?php wp_footer();

?>
</body>
</html>
