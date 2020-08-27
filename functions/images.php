<?php
  add_image_size( '2000x1000f', 2000, 1000, false );
  add_image_size( '1000x750f', 1000, 750, false );
  add_image_size( '615x450', 615, 450, true );
  add_image_size( '400x250f', 400, 250, false );

  function get_lazy_image($imageId, $imageSize, $additionalClasses = '') {
    $html = null;

    if ($imageId && $imageSize) {
      $imageSrc = wp_get_attachment_image_url($imageId, $imageSize);
      $imageRetina = wr2x_get_retina_from_url($imageSrc);
      $imageAlt = get_post_meta($imageId, '_wp_attachment_image_alt', true);

      $isFalseCrop = strpos($imageSize, 'f') !== false;
      if ($isFalseCrop) {
        $imageSizeTrueCrop = str_replace('f', '', $imageSize);
      }

      $imageSize = explode('x', $imageSize ? $imageSize : $imageSizeTrueCrop);

      if(!$isFalseCrop) {
        $paddingBottom = ($imageSize[1] / $imageSize[0]) * 100;
      } else {
        $imageSize = wp_get_attachment_image_src($imageId, $imageSize);
        $paddingBottom = ($imageSize[2] / $imageSize[1]) * 100;
      }

      $html = '<div class="image-wrapper ' . $additionalClasses . '">';
      $html .= '<div class="image-placeholder" style="padding-bottom: ' . $paddingBottom . '%;">';
      $html .= '<img data-src="' . $imageSrc . '" data-retina="' . $imageRetina . '" alt="' . $imageAlt . '" class="lazy-image" />';
      $html .= '</div>';
      $html .= '</div>';
    }

    return $html;
  }

  function get_lazy_bg_image($imageId, $imageSize, $additionalClasses = '') {
    $html = null;

    if ($imageId && $imageSize) {
      $imageSrc = wp_get_attachment_image_url($imageId, $imageSize);
      $imageRetina = wr2x_get_retina_from_url($imageSrc);

      $html = '<div class="image-wrapper ">';
      $html .= '<div data-src="' . $imageSrc . '" data-retina="' . $imageRetina . '" class="lazy-image background-image"></div>';
      $html .= '</div>';
    }

    return $html;
  }
