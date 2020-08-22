<?php $bodyClasses = 'page'; ?>
<?php include('header.php'); ?>

<section>
	<div class="row">
		<div class="column small-12">
      <h1><?php the_title(); ?></h1>
		</div>
	</div>
</section>

<section>
	<div class="row">
		<div class="column small-12">
      <div class="gutenberg">
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
