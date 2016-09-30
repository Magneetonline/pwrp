<?php 
	get_header(); 
	get_template_part('templates/post/head', 'archive' );
		
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<div class="container"><p id="breadcrumbs">U bent hier: ','</p></div>');
	}
	$count = 0;
	?>
		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			if($count == 0){
				echo '<div class="row">';
			}
			?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'archive-thumb' ); ?>
			<article class="large-4 columns blog--article">
				<a href="<?php echo get_permalink(); ?>">
					<span class="blog--subinfo">
						<h4 class="blog--article__title"><?php echo get_the_title(); ?></h4>
					</span>
				</a>
				<div class="blog--featured-image" style="background-image: url('<?php echo $image[0]; ?>')"><a href="<?php the_permalink()?>" class="blog--featured-image__overlay">&nbsp;</a></div>
				 <a href="<?php echo get_permalink(); ?>">
					<span class="blog--subinfo">
						<h6 class="blog--article__date"><?php echo get_the_date(); ?></h6>
						<p class="blog--article__information"><?php echo get_the_excerpt(); ?></p>
						<p class="blog--article__readmore">>> Lees meer</p>
					</span>
				</a>
			</article>
			<?php
			$count++;
			if($count == 3){
				$count = 0;
				echo '</div>';
			}
		endwhile; else : 
			get_template_part('templates/'. get_post_type() .'/notfound' );	
		endif;
		if($count < 3){
			echo '</div>';
		} 
		?>
	<?php
	get_footer(); ?>