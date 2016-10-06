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
							<a class="footer-btn">Lees klantenbeoordeling</a>
						</div>
						<div class="large-3 large-push-1 columns">
							<p>Plaats hier uw reactie</p>
							<a class="footer-btn">Plaats een review</a>
						</div>
						<div class="large-3 large-push-1 columns">
							<a href="/"><i class="m-icon icon--ui__feedback_company_logo"><svg><use xlink:href="/wp-content/themes/comfort/media/images/sprites/ui.svg#feedback_company_logo" xmlns:xlink="http://www.w3.org/1999/xlink"></use></svg></i></a>
						</div>
					</div>
				</div>
			</section>
			<section class="bottom-bar">
				<div class="row">
					<p class="footer--copy">&copy; <?php echo date('Y') ?> | <?php echo bloginfo('name'); ?> - <?php echo bloginfo('description') ?></p>
				</div>
			</section>
		</footer>
		</div>
        <!-- <script async src="<?php echo get_template_directory_uri() ?>/media/javascripts/svg4everybody.js"></script>
        <script async src="<?php echo get_template_directory_uri() ?>/media/javascripts/jquery.stickykit.min.js"></script>
        <script async src="<?php echo get_template_directory_uri() ?>/media/javascripts/photoswipe-ui-default.min.js"></script>
        <script async src="<?php echo get_template_directory_uri() ?>/media/javascripts/photoswipe.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="/media/javascripts/jquery.js"><\/script>')</script>
        <script async src="<?php echo get_template_directory_uri() ?>/media/javascripts/app.js"></script> -->
        <?php wp_footer() ?>
    </body>
</html>
