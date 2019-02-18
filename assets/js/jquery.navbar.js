/**
 * Show/hide navbar on scroll
 */
var didScroll;
var lastScrollTop = 0;
var delta = 350;
var navbarHeight = jQuery( '.nav-scroll' ).outerHeight( true );

jQuery(window).scroll(function(event){
    didScroll = true;
});

setInterval(function() {
    if (didScroll) {
        hasScrolled();
        didScroll = false;
    }
}, 50);

function hasScrolled() {
    var st = jQuery(this).scrollTop();

    if (Math.abs(lastScrollTop - st) <= delta)
        return;

    if (st > lastScrollTop && st > navbarHeight){
        jQuery( '.nav' ).addClass( 'nav-up' );
    } else {
        if (st + jQuery(window).height() < jQuery(document).height()) {
            jQuery( '.nav' ).removeClass( 'nav-up' );
        }
    }
    lastScrollTop = st;
}

/**
 * Add "scrolled" class to nav bar
 */
jQuery(window).scroll(function() {
  var scroll = jQuery(window).scrollTop();

  if (scroll >= 50) {
    jQuery( '.nav' ).addClass( 'nav-scrolled' );
  } else {
    jQuery( '.nav' ).removeClass( 'nav-scrolled' );
  }
});

/*
 * Smooth scroll w/ hashtag replacement
 */
jQuery( 'a[href*="#"]:not([href="#"])' ).click(function() {
  if ( location.pathname.replace(/^\//, '' ) == this.pathname.replace( /^\//, '' ) && location.hostname == this.hostname ) {
  var target = jQuery(this.hash);
  target = target.length ? target : jQuery( '[name=' + this.hash.slice(1) + ']' );
    if ( target.length ) {
      jQuery( 'html, body' ).animate({
        scrollTop: target.offset().top
      }, 500);
      return false;
    }
  }
});


/*
 * Main menu toggle
 */
jQuery(document).ready(function() {
  jQuery( '#menu-toggle' ).click(function () {
    jQuery( '#main-menu, .nav, .menu-toggle' ).toggleClass( 'open' );
  });
  jQuery( '#main-menu li a' ).click(function () {
    jQuery( '#main-menu, .nav, .menu-toggle' ).removeClass( 'open' );
  });
});