<div class="review--top">
	<div class="row">
		<div class="large-push-1 large-4 column">
			<p class="review--amount">Klantenbeoordelingen (<?php echo klantenvertellen_total() ?>)</p>
			<a class="btn btn__primary">PLAATS EEN REVIEW</a>
		</div>
		<div class="large-push-1 large-3 column review__centered">
			<span class="review-total"><?php echo klantenvertellen_cijfer(true) ?></span><br>
			<span class="review-stars"><?php echo klantenvertellen_stars() ?></span>
		</div>
		<div class="large-push-1 large-3 column review__centered">
			<a href="/"><i class="m-icon icon--ui__feedback_company_logo"><svg><use xlink:href="/wp-content/themes/comfort/media/images/sprites/ui.svg#feedback_company_logo" xmlns:xlink="http://www.w3.org/1999/xlink"></use></svg></i></a>
		</div>
	</div>
</div>

<?php
	global $wp_query;
	$vars 			= $wp_query->query_vars;
	$reviews 		= get_detail_reviews();
	setlocale(LC_TIME, 'NL_nl');
	$page 			= ! empty( $vars['page'] ) ? (int) $vars['page'] : 1;
	$total 			= count( $reviews );
	$limit			= 5; //per page
	$totalPages 	= ceil( $total/ $limit ); //calculate total pages
	$page 			= max($page, 1);
	$page 			= min($page, $totalPages);
	$offset 		= ($page - 1) * $limit;
	$offset_max 	= $offset + $limit;
	$count 			= 1;
	?>
	<div class="row">
		<div class="large-push-1 large-3 columns"><p class="results">> Resultaat <?php echo $offset ?>-<?php echo $offset_max ?> van <?php echo $total ?></p></div>
		<div class="large-push-5 large-3 columns"><?php echo get_pagination($total, $limit, $page); ?></div>
	</div>
	<?php
	
	foreach ($reviews as $review){
		if($count >= $offset && $count < $offset_max){
		?>
<article class="review--detail">
	<div class="row">
		<div class="large-push-1 large-2 columns review-stars__centered">
			<p class="review--date"><?php echo strftime('%e %B %Y',strtotime((string)$review->antwoord[0])); ?></p>
			<span class="review-total"><?php echo klantenvertellen_cijfer(true, get_content_by_attr($review->antwoord, "Totaal oordeel")) ?></span><br>
			<span class="review-stars"><?php echo klantenvertellen_stars(get_content_by_attr($review->antwoord, "Totaal oordeel")) ?></span>
		</div>
		<div class="large-push-3 large-6 columns">
			<div class="row">
				<div class="large-1 small-2 column">
					<p class="review--type">Bedrijf</p>
					<p class="review--type">Reactie</p>
				</div>
				<div class="large-push-1 large-11 small-10 columns">
					<p class="review--value"><?php echo get_content_by_attr($review->antwoord, "Voornaam:") ?> uit <?php echo get_content_by_attr($review->antwoord, "uit:") ?></p>
					<p class="review--value"><?php echo get_content_by_attr($review->antwoord, "Positieve ervaring:") ?> <?php get_content_by_attr($review->antwoord, "Verbeterpunten/ tips:") ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="push-1 large-10 columns">
			<ul class="score-list">
				<li class="score-list--item">Klantvriendelijkheid <span><?php echo get_content_by_attr($review->antwoord, "Klantvriendelijkheid") ?></span></li>
				<li class="score-list--item">Afspraken nakomen <span><?php echo get_content_by_attr($review->antwoord, "Afspraken nakomen") ?></span></li>
				<li class="score-list--item">Betrokkenheid <span><?php echo get_content_by_attr($review->antwoord, "Betrokkenheid") ?></span></li>
				<li class="score-list--item">Deskundigheid <span><?php echo get_content_by_attr($review->antwoord, "Deskundigheid") ?></span></li>
				<li class="score-list--item__total">Totaal Oordeel <span><?php echo get_content_by_attr($review->antwoord, "Gemiddelde") ?></span></li>
				<li class="score-list--item__recommend">Aanbeveling: <span><?php echo get_content_by_attr($review->antwoord, "Aanbeveling:") ?></span></li>
		</div>
	</div>
</article>
	<?php
		}else{
		?><!-- Number <?php echo $count ?> omitted -->
		
		<?php
		}
		$count++;
	}
	?>
	<div class="row bottom-results">
		<div class="large-push-1 large-3 columns"><p class="results">> Resultaat <?php echo $offset ?>-<?php echo $offset_max ?> van <?php echo $total ?></p></div>
		<div class="large-push-5 large-3 columns"><?php echo get_pagination($total, $limit, $page); ?></div>
	</div>