/**
 * Mule jQuery/javascript theme functions
 */

/*
 * Fade out loading screen
 */
jQuery(window).load(function() {
  jQuery( '.page-loader' ).fadeOut( 350 );
});

/*
 * Tooltipster
 */
jQuery(document).ready(function() {

  jQuery( '.tooltipster' ).tooltipster({
    delay             : 0,
    animationDuration : 150,
    distance          : 0
  });

  jQuery( '.social-menu li a' ).tooltipster({
    theme             : 'social-nav-tooltipster',
    side              : 'top',
    delay             : 0,
    animationDuration : 150,
    distance          : 30
  });

});


/**
 * Apply Fancybox to all image links
 */
var pixelRatio = window.devicePixelRatio || 1;
if (window.innerWidth/pixelRatio < 769 ) {

jQuery(document).ready(function() {
  jQuery( "a[href$='.jpg'], a[href$='.jpeg'], a[href$='.png'], a[href$='.gif']" ).attr( 'rel', 'gallery' ).fancybox({
    padding     : 0,
    openEffect  : 'elastic',
    closeClick  : false,
        arrows      : false,
    helpers     : {
      overlay : {
        closeClick: false
      },
      title   : false
    },
    afterShow: function() {
      jQuery( '.fancybox-wrap' ).swipe({
        swipe : function(event, direction) {
          if ( direction === 'left' || direction === 'up' ) {
            jQuery.fancybox.prev( direction );
            } else {
            jQuery.fancybox.next( direction );
          }
        }
      });
        },
        afterLoad : function() {
        }
  });
});

} else {

jQuery(document).ready(function() {
  jQuery( "a[href$='.jpg'], a[href$='.jpeg'], a[href$='.png'], a[href$='.gif']" ).attr( 'rel', 'gallery' ).fancybox({
    padding     : 0,
    openEffect  : 'elastic',
    closeClick  : false,
    helpers     : {
      overlay : {
        closeClick: true
      },
    },
  });
});

}