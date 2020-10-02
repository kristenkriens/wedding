		</main>
		<footer class="footer" role="contentinfo">
			<div class="row">
				<div class="column small-12">
					<span class="h3">
						<?php $couple = get_field('couple', 'options'); ?>
						<span data-animation="fade-in-up"><?php echo $couple[0]['first_name']; ?> <?php echo $couple[0]['last_name']; ?></span>
						<svg data-animation="fade-in" data-animation-delay="500" class="heart"><use xlink:href="#heart"></use></svg>
						<span data-animation="fade-in-up" data-animation-delay="1000"><?php echo $couple[1]['first_name']; ?> <?php echo  $couple[1]['last_name']; ?></span>
					</span>
					<span data-animation="fade-in-large" data-animation-delay="1500" class="h5">Made with love by <a href="https://kristenkriens.com" target="_blank">Kristen Kriens</a> in Toronto</span>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
