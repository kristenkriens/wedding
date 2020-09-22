<?php $bodyClasses = 'home'; ?>
<?php include('header.php'); ?>

<section id="home" class="hero has-white-outline">
  <div class="hero__slider">
    <?php $heroImages = get_field('hero_images', 'options'); ?>
    <button class="hero__slider__arrow hero__slider__arrow--left">
      <svg class="arrow-left"><use xlink:href="#arrow-left"></use></svg>
    </button>
    <div class="hero__slider__track">
      <?php foreach ($heroImages as $image): ?>
          <?php echo get_lazy_image($image['image'], '2000x1000f', ($image['zoom_direction'] ? ' zoom-' . $image['zoom_direction'] : '')); ?>
      <?php endforeach; ?>
    </div>
    <button class="hero__slider__arrow hero__slider__arrow--right">
      <svg class="arrow-right"><use xlink:href="#arrow-right"></use></svg>
    </button>
  </div>
  <div class="hero__content">
    <div class="row">
      <div class="column small-12">
        <?php $couple = get_field('couple', 'options'); ?>
        <h1>
          <?php echo $couple[0]['first_name']; ?>
          <span>&</span>
          <?php echo $couple[1]['first_name']; ?>
        </h1>
        <?php $weddingDateTime = get_field('wedding_date_time', 'options'); ?>
        <?php if ($weddingDateTime): ?>
          <?php $weddingDate = date('F jS, Y', strtotime($weddingDateTime)); ?>
          <div class="h2"><?php echo $weddingDate; ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php if ($weddingDateTime): ?>
  <?php $currentDateTime = new DateTime(); ?>
  <?php $unixCurrentDateTime = $currentDateTime->getTimestamp(); ?>
  <?php $unixWeddingDateTime = strtotime($weddingDateTime . ' ' . get_option('timezone_string')); ?>
  <?php $remainingTime = abs($unixWeddingDateTime - $unixCurrentDateTime); ?>
  <section id="countdown" class="countdown colour-blocks" data-timestamp="<?php echo $unixWeddingDateTime; ?>">
  	<div class="row">
  		<div class="colour-blocks__title bg-grey column small-12 large-4">
        <div class="title">
          <h2>
            <span class="h4">Days Until</span>
            The Wedding
          </h2>
        </div>
      </div>
      <div class="colour-blocks__items column small-12 large-8">
        <div class="colour-blocks__item">
          <span id="days" class="h2">0</span>
          <span class="h3">Days</span>
        </div>
        <div class="colour-blocks__item">
          <span id="hours" class="h2">0</span>
          <span class="h3">Hours</span>
        </div>
        <div class="colour-blocks__item">
          <span id="minutes" class="h2">0</span>
          <span class="h3">Mins</span>
        </div>
        <div class="colour-blocks__item">
          <span id="seconds" class="h2">0</span>
          <span class="h3">Secs</span>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($showFullSite): ?>
  <?php $program = get_field('program', 'options'); ?>
  <?php if ($program): ?>
    <?php $programTitle = $program['title']; ?>
    <?php $programSubtitle = $program['subtitle']; ?>
    <?php $programImage = $program['image']; ?>
    <?php $programItems = $program['items']; ?>
    <section id="program" class="program">
      <div class="row">
        <div class="program__title column small-12">
          <div class="title title--has-line title--centered">
            <h2><?php echo $programTitle; ?></h2>
            <?php if ($programSubtitle): ?>
              <h3><?php echo $programSubtitle; ?></h3>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="program__image column small-12 large-6">
          <div class="has-white-outline">
            <?php echo get_lazy_image($programImage, '615x450'); ?>
          </div>
        </div>
        <div class="program__items column small-12 large-6">
          <?php foreach ($programItems as $item): ?>
            <div class="program__item">
              <div class="program__item__left">
                <span class="h4"><?php echo $item['time']; ?></span>
              </div>
              <div class="program__item__right">
                <h4 class="h3"><?php echo $item['title']; ?></h4>
                <?php if ($item['content']): ?>
                  <div class="content">
                    <?php echo $item['content']; ?>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>

<?php $venue = get_field('venue', 'options'); ?>
<?php if ($venue): ?>
  <?php $venueTitle = $venue['title']; ?>
  <?php $venueSubtitle = $venue['subtitle']; ?>
  <?php $venueContent = $venue['content']; ?>
  <?php $venueCTA = $venue['cta']; ?>
  <?php $venueImage = $venue['image']; ?>
  <section id="venue" class="venue bg-accent">
    <div class="row">
      <div class="venue__content column small-12 large-6">
        <div class="title title--has-line">
          <h2><?php echo $venueTitle; ?></h2>
          <?php if ($venueSubtitle): ?>
            <h3><?php echo $venueSubtitle; ?></h3>
          <?php endif; ?>
        </div>
        <?php if ($venueContent): ?>
          <div class="content"><?php echo $venueContent; ?></div>
        <?php endif; ?>
        <?php $button = $venueCTA; ?>
        <?php include( locate_template( 'parts/components/button.php' ) ); ?>
      </div>
      <div class="venue__image column small-12 large-6">
        <div class="full-right has-background-image has-white-outline">
          <?php echo get_lazy_image($venueImage, '1000x750f'); ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php if ($showFullSite): ?>
  <?php $faqs = get_field('faqs', 'options'); ?>
  <?php if ($faqs): ?>
    <?php $faqsTitle = $faqs['title']; ?>
    <?php $faqsSubtitle = $faqs['subtitle']; ?>
    <?php $faqsItems = $faqs['items']; ?>
    <section id="faqs" class="faqs">
      <div class="row">
        <div class="column">
          <div class="card card--outlined">
            <div class="title title--has-line title--centered">
              <h2><?php echo $faqsTitle; ?></h2>
              <?php if ($faqsSubtitle): ?>
                <h3><?php echo $faqsSubtitle; ?></h3>
              <?php endif; ?>
            </div>
            <div class="faqs__items">
              <?php foreach ($faqsItems as $index => $item): ?>
                <div class="faqs__item <?php echo $index == 0 ? 'is-open' : null; ?>">
                  <button class="h3"><?php echo $item['question']; ?></button>
                  <div class="content">
                    <?php echo $item['answer']; ?>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  <?php endif; ?>

  <?php $registry = get_field('registry', 'options'); ?>
  <?php if ($registry): ?>
    <?php $registryTitle = $registry['title']; ?>
    <?php $registryItems = $registry['items']; ?>
    <section id="registry" class="registry colour-blocks">
    	<div class="row">
    		<div class="colour-blocks__title bg-grey column small-12 large-4">
          <div class="title">
            <h2><?php echo $registryTitle; ?></h2>
          </div>
        </div>
        <div class="colour-blocks__items column small-12 large-8">
          <?php foreach ($registryItems as $item): ?>
            <div class="colour-blocks__item">
              <a href="<?php echo $item['link']; ?>" target="_blank">
                <?php echo get_lazy_image($item['logo'], '400x250f'); ?>
              </a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>
  <?php endif; ?>
<?php endif; ?>

<?php $form = get_field('form', 'options'); ?>
<?php if ($form): ?>
  <?php $formTitle = $form['title']; ?>
  <?php $formSubtitle = $form['subtitle']; ?>
  <?php $formContent = $form['content']; ?>
  <?php $formId = $form['form_id']; ?>
  <section id="form" class="form bg-accent-5">
    <div class="row">
      <div class="column">
        <div class="card card--outlined">
          <div class="title title--has-line title--centered">
            <h2><?php echo $formTitle ?></h2>
            <?php if ($formSubtitle): ?>
              <h3><?php echo $formSubtitle; ?></h3>
            <?php endif; ?>
          </div>
          <?php if ($formContent): ?>
            <div class="content"><?php echo $formContent; ?></div>
          <?php endif; ?>
          <?php echo do_shortcode('[fluentform id="' . $formId . '"]'); ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php get_footer(); ?>
