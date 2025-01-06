<div id="post-<?php the_ID(); ?>" class=" <?php get_post_class() ?> wp-block wp-block-kubio-query-layout  position-relative wp-block-kubio-query-layout__outer vireo-single__k__single-lAFSH8Xo9x-outer vireo-local-711-outer d-flex h-section-global-spacing align-items-lg-center align-items-md-center align-items-center" data-kubio="kubio/query-layout" id="blog-layout">
	<div class="position-relative wp-block-kubio-query-layout__inner vireo-single__k__single-lAFSH8Xo9x-inner vireo-local-711-inner h-section-grid-container h-section-boxed-container">
		<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container vireo-single__k__single-baLWB4dRKjp-container vireo-local-712-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-0 gutters-row-0 gutters-row-v-0" data-kubio="kubio/row">
			<div class="position-relative wp-block-kubio-row__inner vireo-single__k__single-baLWB4dRKjp-inner vireo-local-712-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-0 gutters-col-0 gutters-col-v-0">
				<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container vireo-single__k__single-kxeqsSpdy-n-container vireo-local-713-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
					<div class="position-relative wp-block-kubio-column__inner vireo-single__k__single-kxeqsSpdy-n-inner vireo-local-713-inner d-flex h-flex-basis h-px-lg-3 v-inner-lg-0 h-px-md-3 v-inner-md-0 h-px-3 v-inner-0">
						<div class="position-relative wp-block-kubio-column__align vireo-single__k__single-kxeqsSpdy-n-align vireo-local-713-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
							<figure class="wp-block wp-block-kubio-post-featured-image  position-relative wp-block-kubio-post-featured-image__container vireo-single__k__single-rlYTEhTMib-container vireo-local-714-container h-aspect-ratio--4-3 <?php vireo_post_missing_featured_image_class(); ?>" data-kubio="kubio/post-featured-image" data-kubio-settings="{{kubio_settings_value}}">
								<?php if(has_post_thumbnail()): ?>
								<img class='position-relative wp-block-kubio-post-featured-image__image vireo-single__k__single-rlYTEhTMib-image vireo-local--image' src='<?php echo esc_url(get_the_post_thumbnail_url());?>' />
								<?php endif; ?>
								<div class="position-relative wp-block-kubio-post-featured-image__inner vireo-single__k__single-rlYTEhTMib-inner vireo-local-714-inner">
									<div class="position-relative wp-block-kubio-post-featured-image__align vireo-single__k__single-rlYTEhTMib-align vireo-local-714-align h-y-container align-self-lg-end align-self-md-end align-self-end"></div>
								</div>
							</figure>
							<div class="wp-block wp-block-kubio-post-meta  position-relative wp-block-kubio-post-meta__metaDataContainer vireo-single__k__KGesgqe_P-metaDataContainer vireo-local-715-metaDataContainer h-blog-meta" data-kubio="kubio/post-meta" id="post-metadata">
								<span class="metadata-item">
									<span class="metadata-prefix">
										<?php esc_html_e('by', 'vireo'); ?>
									</span>
									<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta("ID"))); ?>">
										<?php echo esc_html(get_the_author_meta("display_name",get_post_field("post_author"))); ?>
									</a>
								</span>
								<span class="metadata-separator">
									-
								</span>
								<span class="metadata-item">
									<span class="metadata-prefix">
										<?php esc_html_e('on', 'vireo'); ?>
									</span>
									<a href="<?php echo esc_url(get_day_link(get_post_time( 'Y' ),get_post_time( 'm' ),get_post_time( 'j' ))); ?>">
										<?php echo esc_html(get_the_date('F j, Y')); ?>
									</a>
								</span>
							</div>
							<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container vireo-single__k__single-SbdKxHs2YI-container vireo-local-716-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-0 gutters-row-0 gutters-row-v-0" data-kubio="kubio/row">
								<div class="position-relative wp-block-kubio-row__inner vireo-single__k__single-SbdKxHs2YI-inner vireo-local-716-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-0 gutters-col-0 gutters-col-v-0">
									<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container vireo-single__k__single-3VGwAjm9cX-container vireo-local-717-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
										<div class="position-relative wp-block-kubio-column__inner vireo-single__k__single-3VGwAjm9cX-inner vireo-local-717-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-0 h-px-md-0 v-inner-md-0 h-px-0 v-inner-0">
											<div class="position-relative wp-block-kubio-column__align vireo-single__k__single-3VGwAjm9cX-align vireo-local-717-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
												<?php the_content(); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container vireo-single__k__oBH0ABWoeL-container vireo-local-718-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-0 gutters-row-0 gutters-row-v-0" data-kubio="kubio/row">
								<div class="position-relative wp-block-kubio-row__inner vireo-single__k__oBH0ABWoeL-inner vireo-local-718-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-0 gutters-col-0 gutters-col-v-0">
									<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container vireo-single__k__wETEbWZUNc-container vireo-local-719-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
										<div class="position-relative wp-block-kubio-column__inner vireo-single__k__wETEbWZUNc-inner vireo-local-719-inner d-flex h-flex-basis h-px-lg-3 v-inner-lg-3 h-px-md-3 v-inner-md-3 h-px-3 v-inner-3">
											<div class="position-relative wp-block-kubio-column__align vireo-single__k__wETEbWZUNc-align vireo-local-719-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
												<p class="wp-block wp-block-kubio-text  position-relative wp-block-kubio-text__text vireo-single__k__single-1pwRcGAnh-text vireo-local-720-text" data-kubio="kubio/text">
													<?php esc_html_e('CATEGORIES:', 'vireo'); ?>
												</p>
												<div class="wp-block wp-block-kubio-post-categories  position-relative wp-block-kubio-post-categories__container vireo-single__k__up5pQ_Cww-container vireo-local-721-container kubio-post-categories-container" data-kubio="kubio/post-categories">
													<div class="position-relative wp-block-kubio-post-categories__placeholder vireo-single__k__up5pQ_Cww-placeholder vireo-local-721-placeholder kubio-post-categories-placeholder"></div>
													<div class="position-relative wp-block-kubio-post-categories__tags vireo-single__k__up5pQ_Cww-tags vireo-local-721-tags">
														<?php vireo_categories_list(__('No category', 'vireo')); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container vireo-single__k__single-1uGRU27HVz-container vireo-local-722-container gutters-row-lg-0 gutters-row-v-lg-1 gutters-row-md-0 gutters-row-v-md-1 gutters-row-0 gutters-row-v-1" data-kubio="kubio/row">
								<div class="position-relative wp-block-kubio-row__inner vireo-single__k__single-1uGRU27HVz-inner vireo-local-722-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-start justify-content-md-start justify-content-start gutters-col-lg-0 gutters-col-v-lg-1 gutters-col-md-0 gutters-col-v-md-1 gutters-col-0 gutters-col-v-1">
									<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container vireo-single__k__single-K4Akm2YNqS-container vireo-local-723-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
										<div class="position-relative wp-block-kubio-column__inner vireo-single__k__single-K4Akm2YNqS-inner vireo-local-723-inner d-flex h-flex-basis h-px-lg-3 v-inner-lg-3 h-px-md-3 v-inner-md-3 h-px-3 v-inner-3">
											<div class="position-relative wp-block-kubio-column__align vireo-single__k__single-K4Akm2YNqS-align vireo-local-723-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
												<p class="wp-block wp-block-kubio-text  position-relative wp-block-kubio-text__text vireo-single__k__xaVGlforg-text vireo-local-724-text" data-kubio="kubio/text">
													<?php esc_html_e('Tags:', 'vireo'); ?>
												</p>
												<div class="wp-block wp-block-kubio-post-tags  position-relative wp-block-kubio-post-tags__container vireo-single__k__single-tlSt_AyBi-container vireo-local-725-container kubio-post-tags-container" data-kubio="kubio/post-tags">
													<div class="position-relative wp-block-kubio-post-tags__placeholder vireo-single__k__single-tlSt_AyBi-placeholder vireo-local-725-placeholder kubio-post-tags-placeholder"></div>
													<div class="position-relative wp-block-kubio-post-tags__tags vireo-single__k__single-tlSt_AyBi-tags vireo-local-725-tags">
														<?php vireo_tags_list(__('No tags', 'vireo')); ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php if(vireo_has_pagination()): ?>
							<div class="wp-block wp-block-kubio-query-pagination  position-relative wp-block-kubio-query-pagination__container vireo-single__k__single-nqLiVZCaYo-container vireo-local-726-container gutters-row-lg-0 gutters-row-v-lg-0 gutters-row-md-0 gutters-row-v-md-0 gutters-row-0 gutters-row-v-0" data-kubio="kubio/query-pagination">
								<div class="position-relative wp-block-kubio-query-pagination__inner vireo-single__k__single-nqLiVZCaYo-inner vireo-local-726-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-0 gutters-col-v-lg-0 gutters-col-md-0 gutters-col-v-md-0 gutters-col-0 gutters-col-v-0">
									<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container vireo-single__k__single-3ndM77FkZV-container vireo-local-727-container d-flex h-col-lg h-col-md h-col-auto" data-kubio="kubio/column">
										<div class="position-relative wp-block-kubio-column__inner vireo-single__k__single-3ndM77FkZV-inner vireo-local-727-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-2 h-px-md-0 v-inner-md-2 h-px-0 v-inner-2">
											<div class="position-relative wp-block-kubio-column__align vireo-single__k__single-3ndM77FkZV-align vireo-local-727-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
												<?php if(vireo_has_pagination_button(true)): ?>
												<div class="position-relative wp-block-kubio-pagination-nav-button__spacing vireo-single__k__single-ELgmeRXRD--spacing vireo-local-728-spacing">
													<span class="wp-block wp-block-kubio-pagination-nav-button  position-relative wp-block-kubio-pagination-nav-button__outer vireo-single__k__single-ELgmeRXRD--outer vireo-local-728-outer kubio-button-container" data-kubio="kubio/pagination-nav-button">
														<a class="position-relative wp-block-kubio-pagination-nav-button__link vireo-single__k__single-ELgmeRXRD--link vireo-local-728-link h-w-100 h-global-transition" href="<?php vireo_get_navigation_button_link(true); ?>">
															<span class="position-relative wp-block-kubio-pagination-nav-button__text vireo-single__k__single-ELgmeRXRD--text vireo-local-728-text kubio-inherit-typography">
																<?php esc_html_e('Previous', 'vireo'); ?>
															</span>
														</a>
													</span>
												</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
									<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container vireo-single__k__single-mMPMCQqWfs-container vireo-local-729-container d-flex h-col-lg h-col-md h-col-auto" data-kubio="kubio/column">
										<div class="position-relative wp-block-kubio-column__inner vireo-single__k__single-mMPMCQqWfs-inner vireo-local-729-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-2 h-px-md-0 v-inner-md-2 h-px-0 v-inner-2">
											<div class="position-relative wp-block-kubio-column__align vireo-single__k__single-mMPMCQqWfs-align vireo-local-729-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
												<?php if(vireo_has_pagination_button()): ?>
												<div class="position-relative wp-block-kubio-pagination-nav-button__spacing vireo-single__k__single-ELgmeRXRD--spacing vireo-local-730-spacing">
													<span class="wp-block wp-block-kubio-pagination-nav-button  position-relative wp-block-kubio-pagination-nav-button__outer vireo-single__k__single-ELgmeRXRD--outer vireo-local-730-outer kubio-button-container" data-kubio="kubio/pagination-nav-button">
														<a class="position-relative wp-block-kubio-pagination-nav-button__link vireo-single__k__single-ELgmeRXRD--link vireo-local-730-link h-w-100 h-global-transition" href="<?php vireo_get_navigation_button_link(); ?>">
															<span class="position-relative wp-block-kubio-pagination-nav-button__text vireo-single__k__single-ELgmeRXRD--text vireo-local-730-text kubio-inherit-typography">
																<?php esc_html_e('Next', 'vireo'); ?>
															</span>
														</a>
													</span>
												</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php endif; ?>
							<div class="wp-block wp-block-kubio-post-comments kubio-migration--1 position-relative wp-block-kubio-post-comments__commentsContainer vireo-single__k__single-s5UQRGEAN-commentsContainer vireo-local-731-commentsContainer" data-kubio="kubio/post-comments">
								<?php vireo_post_comments(array (
  'none' => __('No responses yet', 'vireo'),
  'one' => __('One response', 'vireo'),
  'multiple' => __('{COMMENTS-COUNT} Responses', 'vireo'),
  'disabled' => __('Comments are closed', 'vireo'),
  'avatar_size' => __('32', 'vireo'),
)); ?>
							</div>
							<div class="wp-block wp-block-kubio-post-comments-form  position-relative wp-block-kubio-post-comments-form__container vireo-single__k__single-oXoikmHxB-container vireo-local-732-container" data-kubio="kubio/post-comments-form">
								<?php comment_form(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
