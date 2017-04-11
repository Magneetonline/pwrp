		<footer class="page-footer">
			<section class="main-bar">
				<div class="container">
					<div class="row">
						<div class="large-5 columns">
							<?php if ( is_active_sidebar( 'footer' ) ) : ?>
									<?php dynamic_sidebar( 'footer' ); ?>
							<?php endif; ?>
						</div>
						<div class="large-3 columns">
							<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
									<?php dynamic_sidebar( 'footer-2' ); ?>
							<?php endif; ?>
						</div>
						<div class="large-3 columns">
							<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
									<?php dynamic_sidebar( 'footer-3' ); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
			<section class="review-bar">
				<div class="container">
					<div class="row">
						<div class="large-2 columns review-stars__centered">
							<span class="review-total"><?php echo klantenvertellen_cijfer(true) ?></span><br>
							<span class="review-stars"><?php echo klantenvertellen_stars() ?></span>
						</div>
						<div class="large-3 large-push-1 columns">
							<p>Klantenbeoordelingen (<?php echo klantenvertellen_total() ?>)</p>
							<a class="footer-btn" href="/reviews/">Lees klantenbeoordeling</a>
						</div>
						<div class="large-3 large-push-1 columns">
							<p>Plaats hier uw reactie</p>
							<a class="footer-btn" href="https://www.klantenvertellen.nl/enquete/comfort_bouwer" target="_blank">Plaats een review</a>
						</div>
						<div class="large-3 large-push-1 columns">
							<a href="/reviews"><i class="m-icon icon--ui__klanten_vertellen_logo_light"><svg><use xlink:href="/wp-content/themes/comfort/media/images/sprites/ui.svg#klanten_vertellen_logo_light" xmlns:xlink="http://www.w3.org/1999/xlink"></use></svg></i></a>
						</div>
					</div>
				</div>
			</section>
			<section class="bottom-bar">
				<div class="row">
					<p class="footer--copy">&copy; <?php echo date('Y') ?> | <?php echo bloginfo('name'); ?> v.o.f. - <?php echo bloginfo('description') ?></p><p class="footer--credit">Ontwerp & realisatie Qompassie</p>
				</div>
			</section>
		</footer>
		</div>
        <?php wp_footer() ?>
    </body>
</html>
