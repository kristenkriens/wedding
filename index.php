<?php $bodyClasses = 'home'; ?>
<?php include('header.php'); ?>

<?php $backgroundPattern = get_field('background_pattern', 'options'); ?>

<section id="home" class="hero has-background-image">
  <div class="hero__slider">
    <?php $heroImages = get_field('hero_images', 'options'); ?>
    <button class="hero__slider__arrow hero__slider__arrow--left">
      <svg class="arrow-left"><use xlink:href="#arrow-left"></use></svg>
    </button>
    <div class="hero__slider__track">
      <?php foreach ($heroImages as $image): ?>
          <?php echo get_lazy_image($image['image'], '2000x1000f', 'cover' . ($image['zoom_direction'] ? ' zoom-' . $image['zoom_direction'] : '')); ?>
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
          <div class="h2 date"><?php echo $weddingDate; ?></div>
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
  <section id="countdown" class="countdown" data-timestamp="<?php echo $unixWeddingDateTime; ?>">
  	<div class="row">
  		<div class="countdown__title column small-12 large-4">
        <h2>
          <span class="h4">Days Until</span>
          The Wedding
        </h2>
      </div>
      <div class="countdown__content column small-12 large-8">
        <div class="row">
          <div class="countdown__item column small-6 medium-3">
            <span id="days" class="h2">0</span>
            <span class="h3">Days</span>
          </div>
          <div class="countdown__item column small-6 medium-3">
            <span id="hours" class="h2">0</span>
            <span class="h3">Hours</span>
          </div>
          <div class="countdown__item column small-6 medium-3">
            <span id="minutes" class="h2">0</span>
            <span class="h3">Mins</span>
          </div>
          <div class="countdown__item column small-6 medium-3">
            <span id="seconds" class="h2">0</span>
            <span class="h3">Secs</span>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php $couple = get_field('couple', 'options'); ?>
<?php if ($couple): ?>
  <section id="couple" class="couple">
    <div class="row">
      <?php foreach ($couple as $person): ?>
        <?php $personFirstName = $person['first_name']; ?>
        <?php $personLastName = $person['last_name']; ?>
        <?php $personType = $person['type']; ?>
        <?php $personContent = $person['content']; ?>
        <div class="column small-12 medium-10 large-6 xxlarge-5">
          <div class="card card--bordered">
            <div class="title">
              <h2><?php echo $personFirstName; ?> <?php echo $personLastName; ?></h2>
              <h3><?php echo $personType; ?></h3>
            </div>
            <div class="content">
              <?php echo $personContent; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
<?php endif; ?>

<?php $howWeMet = get_field('how_we_met', 'options'); ?>
<?php if ($howWeMet): ?>
  <?php $howWeMetTitle = $howWeMet['title']; ?>
  <?php $howWeMetSubtitle = $howWeMet['subtitle']; ?>
  <?php $howWeMetContent = $howWeMet['content']; ?>
  <section class="how-we-met has-background-pattern">
    <?php echo get_lazy_bg_image($backgroundPattern, '2000x1000f', 'cover'); ?>
    <div class="row">
      <div class="column small-12 medium-10 large-8">
        <div class="card">
          <div class="title">
            <h2><?php echo $howWeMetTitle; ?></h2>
            <?php if ($howWeMetSubtitle): ?>
              <h3><?php echo $howWeMetSubtitle; ?></h3>
            <?php endif; ?>
          </div>
          <?php if ($howWeMetContent): ?>
            <div class="content"><?php echo $howWeMetContent; ?></div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>
<?php endif; ?>

<?php $venue = get_field('venue', 'options'); ?>
<?php if ($venue): ?>
  <?php $venueImage = $venue['image']; ?>
  <?php $venueTitle = $venue['title']; ?>
  <?php $venueSubtitle = $venue['subtitle']; ?>
  <?php $venueContent = $venue['content']; ?>
  <?php $venueCTA = $venue['cta']; ?>
  <section id="venue" class="venue <?php echo $showFullSite ? 'dark' : null; ?>">
    <div class="row">
      <div class="venue__image full-left column small-12 large-6">
        <div class="has-background-image">
          <?php echo get_lazy_image($venueImage, '1000x750f', 'cover'); ?>
        </div>
      </div>
      <div class="venue__content column small-12 large-6">
        <div class="title">
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
    </div>
  </section>
<?php endif; ?>

<?php if ($showFullSite): ?>
  <section id="program" class="program"></section>

  <section id="faqs" class="faqs"></section>

  <section id="registry" class="registry"></section>

  <section id="rsvp" class="rsvp"></section>
<?php endif; ?>

<?php get_footer(); ?>
