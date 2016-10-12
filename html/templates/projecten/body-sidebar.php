		<div class="container clearfix">
			<main class="main-page__sidebar">
				<?php if (has_post_thumbnail( get_the_ID() ) ): ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
					<div class="vastgoed--featured-image" style="background-image: url('<?php echo $image[0]; ?>')">
					</div>
					<?php endif; ?>
				<?php get_template_part('gallery') ?>
				<?php the_content(); ?>		
				<a class="btn btn__primary btn__bold" href="/contact">DIRECT CONTACT</a>	
			</main>
			<aside class="main-sidebar">
				<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar' ); ?>
				<?php endif; ?>
			</aside>
		</div>
