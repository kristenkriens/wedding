(function($) {
  function checkIfAboveViewportWidth(width) {
    if($(window).innerWidth() > width) {
      return true;
    }
  }

  function setWidthVariable() {
    var width = $('body').innerWidth();

    document.documentElement.style.setProperty('--width', width + 'px');
  }

  function isVisible(element) {
    var isVisible = false;
    var topOfElement = element.offset().top;
    var bottomOfElement = element.offset().top + element.outerHeight();
    var bottomOfScreen = $(window).scrollTop() + $(window).innerHeight();
    var topOfScreen = $(window).scrollTop();
    if ((bottomOfScreen > topOfElement) && (topOfScreen < bottomOfElement)) {
      isVisible = true;
    } else {
      isVisible = false;
    }
    return isVisible;
  }

  function lazyLoad() {
    if ($('.lazy-image').length) {
      var ua = navigator.userAgent;
      var $isChromeIOS = /CriOS/i.test(ua);

      if ($isChromeIOS) {
        $('.lazy-image').each(function() {
          var src = $(this).data('src');
          $(this).attr('src', src).closest('.image-wrapper').addClass('is-loaded');
        });
      } else {
        $('.lazy-image').Lazy({
          defaultImage: '',
          threshold: 0,
          visibleOnly: true,
          afterLoad: function afterLoad(element) {
            $(element).closest('.image-wrapper').addClass('is-loaded');
          }
        });
      }
    }
  }

  function smoothScroll() {
    $('a[href*="#"]:not([href="#"])').on('click', function() {
      if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
        if (target.length) {
          $('html, body').animate({
            scrollTop: target.offset().top - (checkIfAboveViewportWidth(768) ? 65 : 55)
          }, 750);
          return false;
        }
      }
    });
  }

  function setActiveHeaderItem() {
    $(window).on('scroll', function() {
      var y = $(this).scrollTop();

       $('nav li > a').each(function() {
         if (y >= $($(this).attr('href')).offset().top - (checkIfAboveViewportWidth(768) ? 66 : 56)) {
           $('nav li > a').not(this).removeClass('is-active');
           $(this).addClass('is-active');
         }
       });
     });
  }

  function closeHeader() {
    $('.header').removeClass('is-open');
  }

  function toggleHeader(that) {
    $('.header').toggleClass('is-open');
  }

  function handleHeaderToggle() {
    $('.header__toggle').on('click', function() {
      toggleHeader();
    });

    $('.header__overlay').on('click', function() {
      closeHeader();
    });

    $(document).on('keydown', function (event) {
      if (event.key == "Escape") {
        closeHeader();
      }
    });

    $(window).on('scroll', function() {
      if($(window).scrollTop() > 0) {
        $('.header').addClass('is-scrolled');
      } else {
        $('.header').removeClass('is-scrolled');
      }
    });
  }

  function closeHeaderOnItemClick() {
    $('.header nav a').on('click', function() {
      closeHeader();
    });
  }

  function heroSlider() {
    var sliderTrack = $('.hero__slider__track');

    if (sliderTrack.length) {
      sliderTrack.not('.slick-initialized').slick({
        autoplay: true,
        autoplaySpeed: 5000,
        speed: 1000,
        fade: true,
        cssEase: 'linear',
        prevArrow: '.hero__slider__arrow--left',
        nextArrow: '.hero__slider__arrow--right'
      });
    }
  }

  function timer($countdown, futureTime) {
    var currentTime = Date.now() / 1000;
    var timeRemaining = futureTime - currentTime;
    var minute = 60;
    var hour = 60 * 60;
    var day = 60 * 60 * 24;
    var dayFloor = Math.floor(timeRemaining / day);
    var hourFloor = Math.floor((timeRemaining - dayFloor * day) / hour);
    var minuteFloor = Math.floor((timeRemaining - dayFloor * day - hourFloor * hour) / minute);
    var secondFloor = Math.floor((timeRemaining - dayFloor * day - hourFloor * hour - minuteFloor * minute));

    if (secondFloor <= 0 && minuteFloor <= 0) {
      clearInterval(timer);
    } else {
      if (futureTime > currentTime) {
        $countdown.find('#days').text(dayFloor);
        $countdown.find('#hours').text(hourFloor);
        $countdown.find('#minutes').text(minuteFloor);
        $countdown.find('#seconds').text(secondFloor);
      }
    }
  }

  function countdown() {
    var $countdown = $('.countdown');
    if ($countdown.length) {
      var futureTime = $countdown.data('timestamp');

      setInterval(function() {
        timer($countdown, futureTime);
      }, 1000);
    }
  }

  function toggleFAQ() {
    $('.faqs__item button').on('click', function() {
      var item = $(this).closest('.faqs__item');

      item.find('.content').slideToggle();
      item.toggleClass('is-open');
    });
  }

  function particles() {
    particlesJS('particles-js', {
      'particles': {
        'number': {
          'value': checkIfAboveViewportWidth(768) ? 75 : 50,
          'density': false
        },
        'color': {
          'value': '#ffffff'
        },
        'opacity': {
          'value': 0.85,
          'random': false,
          'anim': false
        },
        'size': {
          'value': 5,
          'random': {
            'enable': true,
            'minimumValue': 2.5
          },
          'anim': false
        },
        'line_linked': {
          'enable': false
        },
        'move': {
          'enable': true,
          'speed': 0.15,
          'direction': 'bottom',
          'random': false,
          'straight': false,
          'out_mode': 'out',
          'bounce': false,
          'attract': false
        }
      },
      'interactivity': {
        'detect_on': 'window',
        'events': {
          'onhover': {
            'enable': true,
            'mode': 'repulse'
          },
          'resize': true
        },
        'modes': {
          'repulse': {
            'distance': 50,
            'duration': 1
          }
        }
      },
      'retina_detect': true
    });
  }

  function animations() {
    if($('.content').length) {
      $('.content > p, .content > ul li, .content > ol li').each(function() {
        $(this).attr('data-animation', 'fade-in-up');
      });
    }

    if($('[data-animation]').length) {
      // If Intersection Observer is not supported
      if (!'IntersectionObserver' in window && !'IntersectionObserverEntry' in window && !'intersectionRatio' in window.IntersectionObserverEntry.prototype) {
        $('[data-animation]').addClass('is-visible');
      }

    	// If Internet Explorer
    	if(navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > -1) {
    		$('[data-animation]').addClass('is-visible');
    	}

      setTimeout(function() {
        var elements = document.querySelectorAll('[data-animation]');

        var options = {
          rootMargin: '0px',
          threshold: 0
        };

        var observer = new IntersectionObserver(function(entries) {
  				for(var i = 0; i < entries.length; i++) {
  					if(entries[i].isIntersecting) {
              entries[i].target.classList.add('is-visible');
            }
  				}
        }, options);

  			for(var i = 0; i < elements.length; i++) {
  				observer.observe(elements[i]);
  			}
      }, 50);
    }
  }


  $(document).ready(function($) {
    // Init document ready functions
    $('body').addClass('ready');
    setWidthVariable();
    lazyLoad();
    smoothScroll();
    setActiveHeaderItem();
    handleHeaderToggle();
    closeHeaderOnItemClick();
    heroSlider();
    countdown();
    toggleFAQ();
    particles();
    animations();
  });

  $(window).on('load', function() {
    // Init window load functions
  });

  $(window).on('resize', function() {
    // Init window resize functions
    setWidthVariable();
  });
})(jQuery);
