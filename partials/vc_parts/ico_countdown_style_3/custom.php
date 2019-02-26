<?php
wp_enqueue_script( 'kinetic' );
wp_enqueue_script( 'final_countdown' );

$attributes = '';
if (!empty($ico_bg_image)) {
	$ico_bg_image = crypterio_get_image_url($ico_bg_image);
	$attributes = "style='background-image: url(\"{$ico_bg_image}\")'";
}

$link = vc_build_link($link);
if (empty($link['target'])) {
	$link['target'] = '_self';
}

$wp_link = vc_build_link($wp_link);
if (empty($wp_link['target'])) {
	$wp_link['target'] = '_self';
}

if (!empty($custom_links)) {
	$custom_links = vc_value_from_safe($custom_links);
	$custom_links = explode(',', $custom_links);
}

if (!empty($payments)) $payments = explode(',', $payments);

$currencies = crypterio_get_user_crypto();
$currencies_info = crypterio_get_cmc_data();

?>

<div class="stm_ico_countdown <?php echo esc_attr($css_class); ?> <?php echo esc_attr($style);  ?> " id="buy_tokens">
    <div class="stm_countdown_wrap">
        <div class="stm_left_countdown">
            <?php if (!empty($title)): ?>
                <div class="stm_ico_countdown__title_wrap">
                    <h4 class="stm_ico_countdown__title">
                        <?php echo $title; ?>
                    </h4>
                </div>
            <?php endif; ?>

            <?php if (!empty($countdown)):
                $count = rand(0, 999999);
                ?>
                <div class="countdown_box">

                    <div id="countdown<?php echo $count; ?>" class="container countdown-wrap">
                        <div class="clock row">
                            <div class="clock-item clock-days countdown-time-value col-xs-3">
                                <div class="wrap">
                                    <div class="inner">
                                        <div id="canvas-days" class="clock-canvas"></div>

                                        <div class="text">
                                            <p class="val">0</p>
                                            <p class="type-days type-time"><?php echo esc_html('days', 'crypterio'); ?></p>
                                        </div><!-- /.text -->
                                    </div><!-- /.inner -->
                                </div><!-- /.wrap -->
                            </div><!-- /.clock-item -->

                            <div class="clock-item clock-hours countdown-time-value col-xs-3">
                                <div class="wrap">
                                    <div class="inner">
                                        <div id="canvas-hours" class="clock-canvas"></div>

                                        <div class="text">
                                            <p class="val">0</p>
                                            <p class="type-hours type-time"><?php echo esc_html('hours', 'crypterio'); ?></p>
                                        </div><!-- /.text -->
                                    </div><!-- /.inner -->
                                </div><!-- /.wrap -->
                            </div><!-- /.clock-item -->

                            <div class="clock-item clock-minutes countdown-time-value col-xs-3">
                                <div class="wrap">
                                    <div class="inner">
                                        <div id="canvas-minutes" class="clock-canvas"></div>

                                        <div class="text">
                                            <p class="val">0</p>
                                            <p class="type-minutes type-time"><?php echo esc_html('minutes', 'crypterio'); ?></p>
                                        </div><!-- /.text -->
                                    </div><!-- /.inner -->
                                </div><!-- /.wrap -->
                            </div><!-- /.clock-item -->

                            <div class="clock-item clock-seconds countdown-time-value col-xs-3">
                                <div class="wrap">
                                    <div class="inner">
                                        <div id="canvas-seconds" class="clock-canvas"></div>

                                        <div class="text">
                                            <p class="val">0</p>
                                            <p class="type-seconds type-time"><?php echo esc_html('seconds', 'crypterio'); ?></p>
                                        </div><!-- /.text -->
                                    </div><!-- /.inner -->
                                </div><!-- /.wrap -->
                            </div><!-- /.clock-item -->
                        </div><!-- /.clock -->
                    </div><!-- /.countdown-wrapper -->


                        <script type="text/javascript">
                            var clock;

                            jQuery(document).ready(function () {
                                var $ = jQuery;
                                var clock;

                                var flash = false;
                                var ts = <?php echo strtotime($countdown) * 1000; ?>;
                                var currentTime = <?php echo strtotime(current_time('mysql')); ?>;
                                if((new Date()) < ts){
                                    setTimeout(function () {
                                        $('#countdown<?php echo $count; ?>').final_countdown({
                                            'start': (ts / 1000) - 8553600,
                                            'end': ts / 1000,
                                            'now': currentTime,
                                            seconds: {
                                                borderColor: '#34bbff',
                                                borderWidth: '3'
                                            },
                                            minutes: {
                                                borderColor: '#34bbff',
                                                borderWidth: '3'
                                            },
                                            hours: {
                                                borderColor: '#34bbff',
                                                borderWidth: '3'
                                            },
                                            days: {
                                                borderColor: '#34bbff',
                                                borderWidth: '3'
                                            }
                                        });
                                    }, 300)

                                } else {
                                    $('#countdown_<?php echo esc_attr($count); ?>').html('<div class="countdown_ended h2"><?php esc_html__("Time is up, sorry!", "crypterio"); ?></div>');
                                }

                            });
                        </script>
                </div>
            <?php endif; ?>

						<?php if (!empty($hardcap) and !empty($price_num)):
								$current_procent = round(($price_num * 100) / $hardcap, 2);
								if($current_procent > 100) $current_procent = 100;
								$current_style = "style='width: {$current_procent}%'";
								?>
								<div class="stm_ico_countdown__progress">
										<div class="inner">
												<?php if (!empty($softcap) or !empty($softcap_label)):
														$softcap_procent = round(($softcap * 100) / $hardcap, 2);
														$softcap_style = "style='left: {$softcap_procent}%'";
														$left_time = '';
														if (!empty($softcap_countdown)) {
																$softcap_date = new DateTime($softcap_countdown);
																$now = new DateTime();
																$interval = $now->diff($softcap_date);
																if ($interval->format('%R') !== '-') {
																		if ($interval->days > 1) {
																				$left_time = sprintf(esc_html__('in %s days', 'crypterio'), $interval->days);
																		} elseif ($interval->h > 0) {
																				$left_time = sprintf(esc_html__('in just %s hours', 'crypterio'), $interval->h);
																		}
																}
														}
														?>
														<div class="stm_ico_countdown__softcap" <?php echo sanitize_text_field($softcap_style); ?>>
																<div class="stm_ico_countdown__softcap_label">
																		<?php echo sanitize_text_field($softcap_label); ?>
																</div>
																<div class="stm_ico_countdown__progress_holder"></div>
																<div class="stm_ico_countdown__softcap_label_2">
																		<?php echo sanitize_text_field($softcap_label_2); ?>
																		<?php if (!empty($left_time)): ?>
																				<span><?php echo sanitize_text_field($left_time); ?></span>
																		<?php endif; ?>
																</div>
														</div>

												<?php endif; ?>
												<div class="stm_ico_countdown__progress_bar">
														<div class="stm_ico_countdown__progress_completed" <?php echo sanitize_text_field($current_style); ?>></div>
												</div>
												<?php if (!empty($hardcap) or !empty($hardcap_label)): ?>
														<div class="stm_ico_countdown__hardcap">
																<div class="stm_ico_countdown__hardcap_label">
																		<?php echo sanitize_text_field($hardcap_label); ?>
																</div>
																<div class="stm_ico_countdown__progress_holder"></div>
																<div class="stm_ico_countdown__hardcap_label_2">
																		<?php echo sanitize_text_field($hardcap_label_2); ?>
																</div>
														</div>
												<?php endif; ?>
										</div>
								</div>
						<?php endif; ?>

            <?php if (!empty($price_1) or !empty($price_2)): ?>
                <div class="stm_ico_countdown__prices">

                    <div class="stm_ico_countdown__price stm_ico_countdown__price_1">
                        <?php if (!empty($price_1)): ?>
                            <h4><?php echo esc_attr($price_1); ?></h4>
                        <?php endif; ?>
                        <?php if (!empty($price_label_1)): ?>
                            <span><?php echo esc_attr($price_label_1); ?></span>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($price_2)): ?>
                        <div class="stm_ico_countdown__price stm_ico_countdown__price_2">
                            <h4><?php echo esc_attr($price_2); ?></h4>
                            <?php if (!empty($price_label_2)): ?>
                                <span><?php echo esc_attr($price_label_2); ?></span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="stm_right_countdown">

            <?php if (!empty($show_popup) and $show_popup == 'show'):
                $popup_link = vc_build_link($popup_link);
                if (empty($popup_link['target'])) {
                    $popup_link['target'] = '_self';
                }

                ?>
                <div class="stm_ico_countdown__popup_overlay"></div>
                <div class="stm_ico_countdown__popup">
                    <div class="stm_ico_countdown__popup_inner">
                        <div class="stm_ico_countdown__popup_close"></div>
                        <?php if (!empty($popup_title)): ?>
                            <div class="stm_ico_countdown__popup_title h3">
                                <?php echo sanitize_text_field($popup_title); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($popup_address)): ?>
                            <div class="stm_ico_countdown__popup_address h5">
                                <?php echo sanitize_text_field($popup_address); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($popup_desc)): ?>
                            <p class="stm_ico_countdown__popup_desc">
                                <?php echo sanitize_text_field($popup_desc); ?>
                            </p>
                        <?php endif; ?>

                        <div class="row">
                            <div class="col-md-6">
                                <a href="#"
                                   class="stm_ico_countdown__button stm_ico_countdown__button_copy"
                                   onclick="stmCopyToClipboard('.stm_ico_countdown__popup_address')">
                                    <?php esc_html_e('Copy address', 'crypterio'); ?>
                                </a>
                            </div>
                            <div class="col-md-6">
                                <?php if (!empty($popup_link['url']) and !empty($popup_link['title'])): ?>
                                    <a href="<?php echo esc_url($popup_link['url']) ?>"
                                       target="<?php echo esc_attr($popup_link['target']) ?>"
                                       class="stm_ico_countdown__button"
                                       title="<?php echo esc_attr($popup_link['title']) ?>">
                                        <?php echo esc_attr($popup_link['title']) ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="stm_ico_countdown__links">

                    <div class="stm_countdown_top_part">

												<?php echo do_shortcode( '[easy-profiles template="flat" size="medium" networks="facebook,twitter,dribbble,instgram,youtube,github,forrst,telegram]' ); ?>

                        <?php
                        $eth = $currencies_info['Ethereum'];
                        $currencie_1 = $currencies_info[$cur_name];
                        $currencie_2 = $currencies_info[$cur_name_2];

                        $eth_sum = $price_num / $eth['price_usd'];
                        $currencie_1_sum = $price_num / $currencie_1['price_usd'];
                        $currencie_2_sum = $price_num / $currencie_2['price_usd'];
                        ?>
                        <div class="stm_raised_currencies">
                            <?php crypterio_display_currency_image('Ethereum'); ?>
                            <div class="stm_raised_val"><?php echo round($eth_sum, 2); ?></div>
                            <div class="stm_raised_text"><?php echo esc_html('ETH raised', 'crypterio'); ?></div>
                        </div>
                        <div class="stm_raised_currencies">
                            <?php crypterio_display_currency_image($cur_name); ?>
                            <div class="stm_raised_val"><?php echo round($currencie_1_sum, 2); ?></div>
                            <div class="stm_raised_text"><?php echo $currencie_1['code'] . ' ' . esc_html('raised', 'crypterio'); ?></div>
                        </div>
                        <div class="stm_raised_currencies">
                            <?php crypterio_display_currency_image($cur_name_2); ?>
                            <div class="stm_raised_val"><?php echo round($currencie_2_sum, 2); ?></div>
                            <div class="stm_raised_text"><?php echo $currencie_2['code'] . ' ' . esc_html('raised', 'crypterio'); ?></div>
                        </div>
                    </div>

                    <div class="stm_countdown_bot_part">
                        <?php if(!empty($price_description)): ?>
                            <div class="price_description"><?php echo esc_attr($price_description); ?></div>
                        <?php endif; ?>
                        <?php if (!empty($show_popup) and $show_popup == 'show'): ?>
                        <?php if (!empty($link['url']) and !empty($link['title'])
                            or !empty($wp_link['url']) and !empty($wp_link['title'])):

                            if (!empty($link['url']) and !empty($link['title'])): ?>
                                <a href="<?php echo esc_url($link['url']) ?>"
                                   target="<?php echo esc_attr($link['target']) ?>"
                                   class="stm_ico_countdown__button popmake-5301"
                                   title="<?php echo esc_attr($link['title']) ?>">
                                    <?php echo esc_attr($link['title']) ?>
                                    <i class="stm-stm-right-long-arrow"></i>
                                </a>
                            <?php endif;

                            if (!empty($wp_link['url']) and !empty($wp_link['title'])): ?>
                                <a href="<?php echo esc_url($wp_link['url']) ?>"
                                   target="<?php echo esc_attr($wp_link['target']) ?>"
                                   class="stm_ico_countdown__button stm_ico_countdown__button_wp"
                                   title="<?php echo esc_attr($wp_link['title']) ?>">
                                    <?php echo esc_attr($wp_link['title']) ?>
                                </a>
                            <?php endif; ?>

                        <?php endif; ?>
                        <?php endif; ?>
                    </div>

                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        var $ = jQuery;
                        var selectors = '.stm_ico_countdown__popup, .stm_ico_countdown__popup_overlay';
                        var closers = '.stm_ico_countdown__popup_close, .stm_ico_countdown__popup_overlay';
                        $('.stm_ico_countdown__button__popup').on('click', function (e) {
                            e.preventDefault();
                            $(selectors).addClass('active');
                        });
                        $(closers).on('click', function () {
                            $(selectors).removeClass('active');
                        });
                    });
                </script>


        </div>
    </div>
</div>
