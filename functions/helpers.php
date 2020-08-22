<?php
  function hex_to_rgb($hex) {
    $noHashtag = str_replace('#','',$hex);
    $string = str_split($noHashtag, 2);
    $r = hexdec($string[0]);
    $g = hexdec($string[1]);
    $b = hexdec($string[2]);
    return $r . ', ' . $g . ', ' . $b;
  }

  function get_primary_cat($post, $type = 'category') {
    $postID = $post->ID;
    $primaryCategory = get_post_meta($postID, '_yoast_wpseo_primary_' . $type, true);

    if($primaryCategory) {
      $category = get_term($primaryCategory);

      if(!$category) {
        $category = get_the_terms($postID, $cat);

        if(!$category) {
          return false;
        }

        $category = $category[0];
      }
    } else {
      $category = get_the_terms($postID, $cat);

      if(!$category) {
        return false;
      }

      $category = $category[0];
    }

    return $category;
  }

  function getTimeDifference($date2, $date1) {
    // Formulate the Difference between two dates
    $diff = abs($date2 - $date1);

    // To get the year divide the resultant date into
    // total seconds in a year (365*60*60*24)
    $years = floor($diff / (365*60*60*24));

    // To get the month, subtract it with years and
    // divide the resultant date into
    // total seconds in a month (30*60*60*24)
    $months = floor(($diff - $years * 365*60*60*24)
                                   / (30*60*60*24));

    // To get the day, subtract it with years and
    // months and divide the resultant date into
    // total seconds in a days (60*60*24)
    $days = floor(($diff - $years * 365*60*60*24 -
                 $months*30*60*60*24)/ (60*60*24));

    // To get the hour, subtract it with years,
    // months & seconds and divide the resultant
    // date into total seconds in a hours (60*60)
    $hours = floor(($diff - $years * 365*60*60*24
           - $months*30*60*60*24 - $days*60*60*24)
                                       / (60*60));

    // To get the minutes, subtract it with years,
    // months, seconds and hours and divide the
    // resultant date into total seconds i.e. 60
    $minutes = floor(($diff - $years * 365*60*60*24
             - $months*30*60*60*24 - $days*60*60*24
                              - $hours*60*60)/ 60);

    // To get the minutes, subtract it with years,
    // months, seconds, hours and minutes
    $seconds = floor(($diff - $years * 365*60*60*24
             - $months*30*60*60*24 - $days*60*60*24
                    - $hours*60*60 - $minutes*60));
  }
