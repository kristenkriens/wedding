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
         if (y >= $($(this).attr('href')).offset().top - (checkIfAboveViewportWidth(768) ? 65 : 55)) {
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

  function freshDot() {
    this.obj = document.createElement('div');
    this.obj.classList.add('dot');
    this.obj.style.top = (window.innerHeight * Math.random()) + 'px';
    this.obj.style.left = (window.innerWidth * Math.random()) + 'px';

    document.body.appendChild(this.obj);
  }

  function createDots() {
    var dot = [];
    for(var i = 0; i < 25; i++ ){
      dot.push(new freshDot());
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
    createDots();
  });

  $(window).on('load', function() {
    // Init window load functions
  });

  $(window).on('resize', function() {
    // Init window resize functions
    setWidthVariable();
  });
})(jQuery);
