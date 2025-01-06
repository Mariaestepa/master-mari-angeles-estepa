<div class="<?php vireo_print_archive_entry_class('wp-block wp-block-kubio-query-loop-item  position-relative wp-block-kubio-query-loop-item__container vireo-index__k__fx1L_l5Ny--container vireo-local-372-container d-flex   '); ?>"" data-kubio="kubio/query-loop-item">
	<div class="position-relative wp-block-kubio-query-loop-item__inner vireo-index__k__fx1L_l5Ny--inner vireo-local-372-inner d-flex h-flex-basis h-px-lg-2 v-inner-lg-0 h-px-md-2 v-inner-md-0 h-px-2 v-inner-0">
		<div class="position-relative wp-block-kubio-query-loop-item__align vireo-index__k__fx1L_l5Ny--align vireo-local-372-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
			<figure class="wp-block wp-block-kubio-post-featured-image  position-relative wp-block-kubio-post-featured-image__container vireo-index__k__6duco09NdG-container vireo-local-373-container h-aspect-ratio--4-3 <?php vireo_post_missing_featured_image_class(); ?>" data-kubio="kubio/post-featured-image" data-kubio-settings="{{kubio_settings_value}}">
				<?php if(has_post_thumbnail()): ?>
				<img class='position-relative wp-block-kubio-post-featured-image__image vireo-index__k__6duco09NdG-image vireo-local--image' src='<?php echo esc_url(get_the_post_thumbnail_url());?>' />
				<?php endif; ?>
				<div class="position-relative wp-block-kubio-post-featured-image__inner vireo-index__k__6duco09NdG-inner vireo-local-373-inner">
					<div class="position-relative wp-block-kubio-post-featured-image__align vireo-index__k__6duco09NdG-align vireo-local-373-align h-y-container align-self-lg-center align-self-md-center align-self-center"></div>
				</div>
			</figure>
			<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container vireo-index__k__AFdKdtAfPj-container vireo-local-374-container gutters-row-lg-2 gutters-row-v-lg-2 gutters-row-md-2 gutters-row-v-md-2 gutters-row-2 gutters-row-v-2" data-kubio="kubio/row">
				<div class="position-relative wp-block-kubio-row__inner vireo-index__k__AFdKdtAfPj-inner vireo-local-374-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-2 gutters-col-v-lg-2 gutters-col-md-2 gutters-col-v-md-2 gutters-col-2 gutters-col-v-2">
					<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container vireo-index__k__j02skHJOi_-container vireo-local-375-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
						<div class="position-relative wp-block-kubio-column__inner vireo-index__k__j02skHJOi_-inner vireo-local-375-inner d-flex h-flex-basis h-px-lg-2 v-inner-lg-2 h-px-md-2 v-inner-md-2 h-px-2 v-inner-2">
							<div class="position-relative wp-block-kubio-column__align vireo-index__k__j02skHJOi_-align vireo-local-375-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
								<a class="position-relative wp-block-kubio-post-title__link vireo-index__k__yndIzn0LAb-link vireo-local-376-link d-block" href="<?php echo esc_url(get_the_permalink()); ?>">
									<h3 class="wp-block wp-block-kubio-post-title  position-relative wp-block-kubio-post-title__container vireo-index__k__yndIzn0LAb-container vireo-local-376-container" data-kubio="kubio/post-title">
										<?php the_title(); ?>
									</h3>
								</a>
								<div class="wp-block wp-block-kubio-post-meta  position-relative wp-block-kubio-post-meta__metaDataContainer vireo-index__k__T2yqalWyM-metaDataContainer vireo-local-377-metaDataContainer h-blog-meta" data-kubio="kubio/post-meta" id="post-metadata">
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
								<p class="wp-block wp-block-kubio-post-excerpt  position-relative wp-block-kubio-post-excerpt__text vireo-index__k__fVTtKcA3Zp-text vireo-local-378-text" data-kubio="kubio/post-excerpt">
									<?php vireo_post_excerpt(array (
  'max_length' => 16,
)); ?>
								</p>
								<div class="position-relative wp-block-kubio-read-more-button__spacing vireo-index__k__pLoJzF7eQn-spacing vireo-local-379-spacing">
									<span class="wp-block wp-block-kubio-read-more-button  position-relative wp-block-kubio-read-more-button__outer vireo-index__k__pLoJzF7eQn-outer vireo-local-379-outer kubio-button-container" data-kubio="kubio/read-more-button">
										<a class="position-relative wp-block-kubio-read-more-button__link vireo-index__k__pLoJzF7eQn-link vireo-local-379-link h-w-100 h-global-transition" href="<?php echo esc_url(get_the_permalink()); ?>">
											<span class="position-relative wp-block-kubio-read-more-button__text vireo-index__k__pLoJzF7eQn-text vireo-local-379-text kubio-inherit-typography">
												<?php esc_html_e('Read more', 'vireo'); ?>
											</span>
											<span class="h-svg-icon wp-block-kubio-read-more-button__icon vireo-index__k__pLoJzF7eQn-icon vireo-local-379-icon" name="icons8-line-awesome/arrow-right">
												<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="arrow-right" viewBox="0 0 512 545.5">
													<path d="M299.5 140.5l136 136 11 11.5-11 11.5-136 136-23-23L385 304H64v-32h321L276.5 163.5z"/></svg>
												</span>
											</a>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
