<?php 
	get_header(); 
	get_template_part('templates/'. get_post_type() .'/head', 'archive' );
		
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb('<div class="container"><p id="breadcrumbs">','</p></div>');
	}
	$count = 0;
	?>
		<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
			if($count == 0){
				echo '<div class="row">';
			}
			get_template_part('templates/'. get_post_type() .'/archive', 'sidebar' );
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
		<div class="pagination row">
			<div class="twelve columns">
			<?php
				$args = array(
									'prev_next'          => false,
									'type'               => 'plain'
								);
				echo paginate_links($args);
			?>
			</div>
		</div>
	<?php
	get_footer(); ?>