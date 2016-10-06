		<div class="container clearfix">
			<main class="main-page__sidebar">
				<article class="post">
					<header>
						<h2 class="post--title"><?php echo get_the_title() ?></h2>
						<p class="post--date"><?php echo get_the_date(); ?></p>
						<?php if (has_post_thumbnail( get_the_ID() ) ): ?>
							<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'single-post-thumbnail' ); ?>
							<div class="post--featured-image" style="background-image: url('<?php echo $image[0]; ?>')">
							</div>
							<?php endif; ?>
						<?php get_template_part('gallery') ?>
					</header>
					<?php the_content(); ?>	
				</article>		
			</main>
			<aside class="main-sidebar">
				<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar' ); ?>
				<?php endif; ?>
			</aside>
		</div>
