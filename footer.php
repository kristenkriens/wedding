		</main>
		<footer class="footer dark" role="contentinfo">
			<div class="row">
				<div class="column small-12">
					<span class="h3">
						<?php $couple = get_field('couple', 'options'); ?>
						<?php echo $couple[0]['first_name']; ?> <?php echo $couple[0]['last_name']; ?>
						<svg class="heart"><use xlink:href="#heart"></use></svg>
						<?php echo $couple[1]['first_name']; ?> <?php echo  $couple[1]['last_name']; ?>
					</span>
					<span class="h5">Made with love by <a href="https://kristenkriens.com" target="_blank">Kristen Kriens</a> in Toronto</span>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
