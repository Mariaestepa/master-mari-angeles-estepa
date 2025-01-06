<div class="<?php vireo_print_archive_entry_class('wp-block wp-block-kubio-query-loop-item  position-relative wp-block-kubio-query-loop-item__container vireo-search__k__5Q_NbI2oz49-container vireo-local-586-container d-flex   '); ?>"" data-kubio="kubio/query-loop-item">
	<div class="position-relative wp-block-kubio-query-loop-item__inner vireo-search__k__5Q_NbI2oz49-inner vireo-local-586-inner d-flex h-flex-basis h-px-lg-2 v-inner-lg-2 h-px-md-2 v-inner-md-2 h-px-2 v-inner-2">
		<div class="position-relative wp-block-kubio-query-loop-item__align vireo-search__k__5Q_NbI2oz49-align vireo-local-586-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
			<figure class="wp-block wp-block-kubio-post-featured-image  position-relative wp-block-kubio-post-featured-image__container vireo-search__k__UWCiBNhdxOK-container vireo-local-587-container h-aspect-ratio--4-3 <?php vireo_post_missing_featured_image_class(); ?>" data-kubio="kubio/post-featured-image" data-kubio-settings="{{kubio_settings_value}}">
				<?php if(has_post_thumbnail()): ?>
				<img class='position-relative wp-block-kubio-post-featured-image__image vireo-search__k__UWCiBNhdxOK-image vireo-local--image' src='<?php echo esc_url(get_the_post_thumbnail_url());?>' />
				<?php endif; ?>
				<div class="position-relative wp-block-kubio-post-featured-image__inner vireo-search__k__UWCiBNhdxOK-inner vireo-local-587-inner">
					<div class="position-relative wp-block-kubio-post-featured-image__align vireo-search__k__UWCiBNhdxOK-align vireo-local-587-align h-y-container align-self-lg-center align-self-md-center align-self-center"></div>
				</div>
			</figure>
			<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container vireo-search__k__ZSlEFRPgt5-container vireo-local-588-container gutters-row-lg-2 gutters-row-v-lg-2 gutters-row-md-2 gutters-row-v-md-2 gutters-row-0 gutters-row-v-2" data-kubio="kubio/row">
				<div class="position-relative wp-block-kubio-row__inner vireo-search__k__ZSlEFRPgt5-inner vireo-local-588-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-2 gutters-col-v-lg-2 gutters-col-md-2 gutters-col-v-md-2 gutters-col-0 gutters-col-v-2">
					<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container vireo-search__k__vdDLmhEY9E-container vireo-local-589-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
						<div class="position-relative wp-block-kubio-column__inner vireo-search__k__vdDLmhEY9E-inner vireo-local-589-inner d-flex h-flex-basis h-px-lg-2 v-inner-lg-2 h-px-md-2 v-inner-md-2 h-px-2 v-inner-2">
							<div class="position-relative wp-block-kubio-column__align vireo-search__k__vdDLmhEY9E-align vireo-local-589-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-start align-self-md-start align-self-start">
								<a class="position-relative wp-block-kubio-post-title__link vireo-search__k__yndIzn0LAb-link vireo-local-590-link d-block" href="<?php echo esc_url(get_the_permalink()); ?>">
									<h3 class="wp-block wp-block-kubio-post-title  position-relative wp-block-kubio-post-title__container vireo-search__k__yndIzn0LAb-container vireo-local-590-container" data-kubio="kubio/post-title">
										<?php the_title(); ?>
									</h3>
								</a>
								<div class="wp-block wp-block-kubio-post-meta  position-relative wp-block-kubio-post-meta__metaDataContainer vireo-search__k__mMF5ROLoGaV-metaDataContainer vireo-local-591-metaDataContainer h-blog-meta" data-kubio="kubio/post-meta">
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
								<p class="wp-block wp-block-kubio-post-excerpt  position-relative wp-block-kubio-post-excerpt__text vireo-search__k__fVTtKcA3Zp-text vireo-local-592-text" data-kubio="kubio/post-excerpt">
									<?php vireo_post_excerpt(array (
  'max_length' => 16,
)); ?>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
