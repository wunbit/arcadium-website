<?php $vc_status = get_post_meta( get_the_ID() , '_wpb_vc_js_status', true); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
	<div class="stm_post_info">
		<div class="stm_post_details clearfix">
			<ul class="clearfix">
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
	<div class="entry-content">
		<?php if ( $vc_status != 'false' && $vc_status == true ): ?>
            <?php
            if ( is_singular('stm_event') ) {
                echo '<div class="event_content">';
                the_content();
                echo '</div>';
            } else {
                the_content();
            }
            ?>
						<?php if ( comments_open() || get_comments_number() ) : ?>
								<div class="stm_post_comments">
										<?php comments_template(); ?>
								</div>
						<?php endif; ?>
		<?php else: ?>
            <?php if ( is_singular('stm_event') ) : ?>
                <?php
                $sidebar_type = get_theme_mod( 'event_sidebar_type', 'wp' );
                if ( $sidebar_type == 'wp' ) {
                    $sidebar_id = get_theme_mod( 'event_wp_sidebar', 'crypterio-right-sidebar' );
                } else {
                    $sidebar_id = get_theme_mod( 'event_vc_sidebar' );
                }
                if ( ! empty( $_GET['sidebar_id'] ) ) {
                    $sidebar_id =  $_GET['sidebar_id'];
                }
                $structure = crypterio_get_structure( $sidebar_id, $sidebar_type, get_theme_mod( 'blog_sidebar_position', 'right' ), get_theme_mod( 'blog_layout' ) ); ?>
                <?php echo crypterio_sanitize_text_field($structure['content_before']); ?>
                <div class="without_vc">
                    <div class="event_content">
                        <?php get_template_part( 'partials/content', 'event-info' ); ?>
                        <?php the_content(); ?>
                        <?php get_template_part( 'partials/content', 'event-form' ); ?>
                    </div>
                </div>
                <?php echo crypterio_sanitize_text_field($structure['content_after']); ?>
                <?php echo crypterio_sanitize_text_field($structure['sidebar_before']); ?>
                <?php
                if ( $sidebar_id ) {
                    if ( $sidebar_type == 'wp' ) {
                        $sidebar = true;
                    } else {
                        $sidebar = get_post( $sidebar_id );
                    }
                }
                if ( isset( $sidebar ) ) {
                    if ( $sidebar_type == 'vc' ) { ?>
                        <style type="text/css" scoped>
                            <?php echo get_post_meta( $sidebar_id, '_wpb_shortcodes_custom_css', true ); ?>
                        </style>
                        <div class="sidebar-area stm_sidebar">
                            <?php echo apply_filters( 'the_content', $sidebar->post_content ); ?>
                        </div>
                    <?php } else { ?>
                        <div class="sidebar-area default_widgets">
                            <?php dynamic_sidebar( $sidebar_id ); ?>
                        </div>
                    <?php }
                }
                ?>
                <?php echo crypterio_sanitize_text_field($structure['sidebar_after']); ?>
            <?php else: ?>
                <?php
                $sidebar_type = get_theme_mod( 'blog_sidebar_type', 'wp' );
                if ( $sidebar_type == 'wp' ) {
                    $sidebar_id = get_theme_mod( 'blog_wp_sidebar', 'crypterio-right-sidebar' );
                } else {
                    $sidebar_id = get_theme_mod( 'blog_vc_sidebar' );
                }
                if ( ! empty( $_GET['sidebar_id'] ) ) {
                    $sidebar_id =  $_GET['sidebar_id'];
                }
                $structure = crypterio_get_structure( $sidebar_id, $sidebar_type, get_theme_mod( 'blog_sidebar_position', 'right' ), get_theme_mod( 'blog_layout' ) ); ?>
                <?php echo crypterio_sanitize_text_field($structure['content_before']); ?>
                <div class="without_vc">
                    <?php if ( get_post_meta( get_the_ID(), 'disable_title', true ) ): ?>
                        <?php the_title( '<h1 class="h2 no_stripe page_title_2">', '</h1>' ); ?>
                    <?php endif; ?>
                    <div class="post_details_wr">
                        <?php get_template_part( 'partials/content', 'post_details' ); ?>
                    </div>
                    <div class="wpb_text_column">
                        <?php the_content(); ?>
                    </div>
                    <br/>
                    <br/>
                    <?php get_template_part( 'partials/content', 'post_bottom' ); ?>
                    <?php get_template_part( 'partials/content', 'about_author' ); ?>
                    <?php
                    wp_link_pages( array(
                        'before'      => '<div class="page-links"><label>' . esc_html__( 'Pages:', 'crypterio' ) . '</label>',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                        'pagelink'    => '%',
                        'separator'   => '',
                    ) );
                    ?>
                    <?php if ( comments_open() || get_comments_number() ) : ?>
                        <div class="stm_post_comments">
                            <?php comments_template(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php echo crypterio_sanitize_text_field($structure['content_after']); ?>
                <?php echo crypterio_sanitize_text_field($structure['sidebar_before']); ?>
                <?php
                if ( $sidebar_id ) {
                    if ( $sidebar_type == 'wp' ) {
                        $sidebar = true;
                    } else {
                        $sidebar = get_post( $sidebar_id );
                    }
                }
                if ( isset( $sidebar ) ) {
                    if ( $sidebar_type == 'vc' ) { ?>
                        <style type="text/css" scoped>
                            <?php echo get_post_meta( $sidebar_id, '_wpb_shortcodes_custom_css', true ); ?>
                        </style>
                        <div class="sidebar-area stm_sidebar">
                            <?php echo apply_filters( 'the_content', $sidebar->post_content ); ?>
                        </div>
                    <?php } else { ?>
                        <div class="sidebar-area default_widgets">
                            <?php dynamic_sidebar( $sidebar_id ); ?>
                        </div>
                    <?php }
                }
                ?>
                <?php echo crypterio_sanitize_text_field($structure['sidebar_after']); ?>
            <?php endif; ?>
		<?php endif; ?>
	</div>
</article> <!-- #post-## -->
