	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'archive-thumb' ); ?>
			<article class="large-3 columns vastgoed--home">
				<div class="vastgoed--hover">
				<p><i class="fa fa-arrow-down" aria-hidden="true"></i><br>LEES MEER</p>
				</div>
				<div class="vastgoed--featured-image" style="background-image: url('<?php echo $image[0]; ?>')"><a href="<?php the_permalink()?>" class="vastgoed--featured-image__overlay">&nbsp;</a></div>
				 <a href="<?php echo get_permalink(); ?>">
					<span class="vastgoed--subinfo">
						<h4 class="vastgoed--home__title"><?php echo get_the_title(); ?></h4>
						<p class="vastgoed--home__information"><?php echo get_field('subtitle'); ?></p>
					</span>
				</a>
			</article>