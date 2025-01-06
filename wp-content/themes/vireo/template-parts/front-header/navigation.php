<?php $component = \ColibriWP\Theme\View::getData( 'component' ); ?>
<div class="wp-block wp-block-kubio-navigation  position-relative wp-block-kubio-navigation__outer <?php echo $component->printNavigationClasses(); ?> vireo-front-header__k__QJ_pm8mx0K-outer vireo-local-89-outer h-navigation_overlap" data-kubio="kubio/navigation" data-kubio-component="overlap" data-kubio-settings="true" id="navigation">
	<?php vireo_theme()->get('front-top-bar')->render(); ?>
	<div class="wp-block wp-block-kubio-navigation-section  position-relative wp-block-kubio-navigation-section__nav vireo-front-header__k__92rAVDGxxV-nav vireo-local-106-nav h-section h-navigation" data-kubio="kubio/navigation-section" data-kubio-component="navigation" data-kubio-settings="{&quot;sticky&quot;:{&quot;startAfterNode&quot;:{&quot;enabled&quot;:false},&quot;animations&quot;:{&quot;enabled&quot;:false,&quot;duration&quot;:0,&quot;name&quot;:&quot;slideDown&quot;}},&quot;overlap&quot;:true}">
		<div class="position-relative wp-block-kubio-navigation-section__nav-section vireo-front-header__k__92rAVDGxxV-nav-section vireo-local-106-nav-section    <?php echo $component->printContainerClasses(); ?>">
			<div class="wp-block wp-block-kubio-navigation-items  position-relative wp-block-kubio-navigation-items__outer vireo-front-header__k__cjI7W3eEyp-outer vireo-local-107-outer" data-kubio="kubio/navigation-items" data-nav-normal="true">
				<div class="wp-block wp-block-kubio-row  position-relative wp-block-kubio-row__container vireo-front-header__k__Os6fgGCmhM-container vireo-local-108-container gutters-row-lg-3 gutters-row-v-lg-0 gutters-row-md-3 gutters-row-v-md-0 gutters-row-3 gutters-row-v-3" data-kubio="kubio/row">
					<div class="position-relative wp-block-kubio-row__inner vireo-front-header__k__Os6fgGCmhM-inner vireo-local-108-inner h-row align-items-lg-stretch align-items-md-stretch align-items-stretch justify-content-lg-center justify-content-md-center justify-content-center gutters-col-lg-3 gutters-col-v-lg-0 gutters-col-md-3 gutters-col-v-md-0 gutters-col-3 gutters-col-v-3">
						<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container vireo-front-header__k__qT9wMAynJ9V-container vireo-local-109-container d-flex h-col-lg-auto h-col-md-auto h-col" data-kubio="kubio/column">
							<div class="position-relative wp-block-kubio-column__inner vireo-front-header__k__qT9wMAynJ9V-inner vireo-local-109-inner d-flex h-flex-basis h-px-lg-2 v-inner-lg-0 h-px-md-2 v-inner-md-0 h-px-3 v-inner-0">
								<div class="position-relative wp-block-kubio-column__align vireo-front-header__k__qT9wMAynJ9V-align vireo-local-109-align h-y-container h-column__content h-column__v-align flex-basis-auto align-self-lg-center align-self-md-center align-self-center">
									<?php vireo_theme()->get('logo')->render(array (
  'wrapper_class' => 'wp-block wp-block-kubio-logo position-relative wp-block-kubio-logo__container  kubio-logo-direction-row vireo-front-header__k__LwT2TIsawds-container vireo-local--container',
  'logo_image_class' => 'position-relative wp-block-kubio-logo__image  kubio-logo-image  vireo-front-header__k__LwT2TIsawds-image vireo-local--image',
  'alt_logo_image_class' => 'position-relative wp-block-kubio-logo__alternateImage kubio-logo-image kubio-alternate-logo-image   vireo-front-header__k__LwT2TIsawds-alternateImage vireo-local--alternateImage',
  'logo_text_class' => 'position-relative wp-block-kubio-logo__text  vireo-front-header__k__LwT2TIsawds-text vireo-local--text',
)); ?>
								</div>
							</div>
						</div>
						<div class="wp-block wp-block-kubio-column  kubio-hide-on-mobile position-relative wp-block-kubio-column__container vireo-front-header__k__9rfhWmnLA2n-container vireo-local-111-container d-flex h-col-lg h-col-md h-col-auto" data-kubio="kubio/column">
							<div class="position-relative wp-block-kubio-column__inner vireo-front-header__k__9rfhWmnLA2n-inner vireo-local-111-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-0 h-px-md-0 v-inner-md-0 h-px-0 v-inner-0">
								<div class="position-relative wp-block-kubio-column__align vireo-front-header__k__9rfhWmnLA2n-align vireo-local-111-align h-y-container h-column__content h-column__v-align flex-basis-100 align-self-lg-center align-self-md-center align-self-center">
									<div class="wp-block wp-block-kubio-spacer  position-relative wp-block-kubio-spacer__container vireo-front-header__k__tEPOoKfKzz2-container vireo-local-112-container" data-kubio="kubio/spacer"></div>
								</div>
							</div>
						</div>
						<div class="wp-block wp-block-kubio-column  position-relative wp-block-kubio-column__container vireo-front-header__k__t1gO6w0QdXY-container vireo-local-113-container d-flex h-col-lg-auto h-col-md-auto h-col-auto" data-kubio="kubio/column">
							<div class="position-relative wp-block-kubio-column__inner vireo-front-header__k__t1gO6w0QdXY-inner vireo-local-113-inner d-flex h-flex-basis h-px-lg-0 v-inner-lg-0 h-px-md-0 v-inner-md-0 h-px-3 v-inner-2">
								<div class="position-relative wp-block-kubio-column__align vireo-front-header__k__t1gO6w0QdXY-align vireo-local-113-align h-y-container h-column__content h-column__v-align flex-basis-auto align-self-lg-center align-self-md-center align-self-center">
									<?php vireo_theme()->get('header-menu')->render(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
