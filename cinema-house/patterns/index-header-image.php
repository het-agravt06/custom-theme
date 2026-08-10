<?php
/**
 * Title: Index Header Image
 * Slug: cinema-house/index-header-image
 * Categories: cinema-house, index-header-image
 */
?>

<!-- wp:group {"className":"inner-banner-wrap","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|70","bottom":"0"}},"border":{"radius":"13px"}},"layout":{"type":"default"}} -->
<div class="wp-block-group inner-banner-wrap" style="border-radius:13px;margin-top:var(--wp--preset--spacing--70);margin-bottom:0;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:cover {"url":"<?php echo esc_url( get_template_directory_uri() . '/images/inner-banner.png'); ?>","id":6,"dimRatio":30,"minHeight":300,"className":"inner-cover-img","style":{"border":{"radius":"13px"}},"layout":{"type":"default"}} -->
<div class="wp-block-cover inner-cover-img" style="border-radius:13px;min-height:300px"><img class="wp-block-cover__image-background wp-image-6" alt="" src="<?php echo esc_url( get_template_directory_uri() . '/images/inner-banner.png'); ?>" data-object-fit="cover"/><span aria-hidden="true" class="wp-block-cover__background has-background-dim-30 has-background-dim"></span><div class="wp-block-cover__inner-container"><!-- wp:heading {"textAlign":"center","style":{"typography":{"textTransform":"uppercase"}}} -->
<h2 class="wp-block-heading has-text-align-center" style="text-transform:uppercase"><?php echo esc_html__('blog','cinema-house'); ?></h2>
<!-- /wp:heading --></div></div>
<!-- /wp:cover --></div>
<!-- /wp:group -->