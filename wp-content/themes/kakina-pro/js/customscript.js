// menu dropdown link clickable
jQuery( document ).ready( function ( $ ) {
    $( '.navbar .dropdown > a, .dropdown-menu > li > a, .navbar .dropdown-submenu > a, .widget-menu .dropdown > a, .widget-menu .dropdown-submenu > a' ).click( function () {
        location.href = this.href;
    } );
} );

// scroll to top button
jQuery( document ).ready( function ( $ ) {
    $( "#back-top" ).hide();
    $( function () {
        $( window ).scroll( function () {
            if ( $( this ).scrollTop() > 100 ) {
                $( '#back-top' ).fadeIn();
            } else {
                $( '#back-top' ).fadeOut();
            }
        } );

        // scroll body to 0px on click
        $( '#back-top a' ).click( function () {
            $( 'body,html' ).animate( {
                scrollTop: 0
            }, 800 );
            return false;
        } );
    } );
} );
// Tooltip
jQuery( document ).ready( function ( $ ) {
    $( function () {
        $( '[data-toggle="tooltip"]' ).tooltip()
    } )
} );
// Tooltip to compare
jQuery( document ).ready( function ( $ ) {
    $( ".compare.button" ).attr( 'data-toggle', 'tooltip' );
    $( ".compare.button" ).attr( 'title', objectL10n.compare );
} );
// Popover
jQuery( document ).ready( function ( $ ) {
    $( function () {
        $( '[data-toggle="popover"]' ).popover( { html: true } )
    } )
} );
// Wishlist count ajax update
jQuery( document ).ready( function ( $ ) {
    $( 'body' ).on( 'added_to_wishlist', function () {
        $( '.top-wishlist .count' ).load( yith_wcwl_l10n.ajax_url + ' .top-wishlist span', { action: 'yith_wcwl_update_single_product_list' } );
    } );
} );

// FlexSlider Carousel
jQuery( document ).ready( function ( $ ) {
    $( '.carousel-row' ).each( function () {
        var $aSelected = $( this ).find( 'ul' );
        if ( $aSelected.hasClass( 'products' ) ) {
            var id = $( this ).attr( 'data-container' ),
                columns = $( '#carousel-' + id ).data( 'columns' ),
                $window = $( window ),
                flexslider = { vars: { } };
            // tiny helper function to add breakpoints
            function getGridSize() {
                return ( window.innerWidth < 520 ) ? 1 :
                    ( window.innerWidth < 768 ) ? 2 : columns;
            }
            $( window ).load( function () {
                $( '#carousel-' + id ).flexslider( {
                    animation: "slide",
                    controlNav: false,
                    selector: ".products > li",
                    animationLoop: false,
                    slideshow: true,
                    itemWidth: 124,
                    itemMargin: 20,
                    prevText: "",
                    nextText: "",
                    minItems: getGridSize(),
                    maxItems: getGridSize(),
                    start: function ( slider ) {
                        flexslider = slider;
                        slider.removeClass( 'loading-hide' );
                        slider.resize();
                    }
                } );
            } );
            $( window ).resize( function () {
                var gridSize = getGridSize();

                flexslider.vars.minItems = gridSize;
                flexslider.vars.maxItems = gridSize;

            } );
            // set the timeout for the slider resize
            $( function () {
                var resizeEnd;
                $( window ).on( 'resize', function () {
                    clearTimeout( resizeEnd );
                    resizeEnd = setTimeout( function () {
                        flexsliderResize();
                    }, 100 );
                } );
            } );
            function flexsliderResize() {
                if ( $( '#carousel-' + id ).length > 0 ) {
                    $( '#carousel-' + id ).data( 'flexslider' ).resize();
                }
            }
        }
    } );
} );

// FlexSlider
jQuery( document ).ready( function ( $ ) {
    $( '.product-slider' ).each( function () {
        var id = $( this ).attr( 'data-container' );
        $( window ).load( function () {
            $( '#single-slider-' + id ).flexslider( {
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: true,
                start: function ( slider ) {
                    flexslider = slider;
                    slider.removeClass( 'loading-hide' );
                }
            } );
        } );
    } );
} );

// FlexSlider homepage
jQuery( document ).ready( function ( $ ) {
    $( '#slider' ).flexslider( {
        animation: "slide",
        itemWidth: 855,
        controlNav: false,
        animationLoop: false,
        slideshow: true,
    } );
} );

// Shop by category menu
jQuery( document ).ready( function ( $ ) {
    function mobileViewUpdate() {
        var viewportWidth = $( window ).width();
        if ( viewportWidth < 991 ) {
            $( '#collapseOne.opened' ).removeClass( 'in' );
            $( '#collapseOne.opened' ).removeClass( 'mobile-display' );
        } else {
            $( '#collapseOne.opened' ).addClass( 'in' );
            $( '#collapseOne.opened' ).removeClass( 'mobile-display' );
        }
    }
    ;
    $( window ).load( mobileViewUpdate );
    // $( window ).resize( mobileViewUpdate );
} );

// Shop by category button more
jQuery( document ).ready( function ( $ ) {
    if ( $( "#collapseOne" ).hasClass( "panel-collapse" ) ) {
        var h = $( '#collapseOne' )[0].scrollHeight + 37;
        var hs = $( '#collapseOne' ).outerHeight();
        var catemidx = 1;
        var windowWidth = $( window ).width();
        $( '#menu-more' ).click( function ( e ) {
            e.stopPropagation();
            $( '#collapseOne' ).animate( {
                'height': h
            } )
            jQuery( '.cat-menu > li.menu-item' ).css( 'display', 'block' );
            jQuery( '#menu-more' ).css( 'display', 'none' );
            jQuery( '#menu-less' ).css( 'display', 'block' );
        } );
        $( '#menu-less' ).click( function () {
            $( '#collapseOne' ).animate( {
                'height': hs
            } )
            jQuery( '.cat-menu > li.menu-item.mhide' ).css( 'display', 'none' );
            jQuery( '#menu-more' ).css( 'display', 'block' );
            jQuery( '#menu-less' ).css( 'display', 'none' );
        } );
        //Hide button if number of menu is not bigger then number menu in options
        if ( ( jQuery( '.cat-menu > li.menu-item' ).length < 13 && windowWidth > 1200 ) || windowWidth < 991 || ( jQuery( '.cat-menu > li.menu-item' ).length < 10 && windowWidth > 991 && windowWidth < 1200 ) || $( "#collapseOne" ).hasClass( "closed" ) ) {
            jQuery( '.slider-menu-more' ).css( 'display', 'none' );
            jQuery( '.slider-menu-more' ).addClass( 'alwayshide' );
        }
        jQuery( '.cat-menu > li.menu-item' ).each( function () {
            if ( catemidx > 9 && windowWidth > 991 && windowWidth < 1201 && $( "#collapseOne" ).hasClass( "opened" ) ) {
                jQuery( this ).css( 'display', 'none' );
                jQuery( this ).addClass( 'mhide' );
            } else if ( catemidx > 12 && windowWidth > 1200 && $( "#collapseOne" ).hasClass( "opened" ) ) {
                jQuery( this ).css( 'display', 'none' );
                jQuery( this ).addClass( 'mhide' );
            }
            catemidx++;
        } );
    }
} );

// Add to cart button
function resizecartbutton() {
    var width = jQuery( '.woocommerce ul.products li.product' ).innerWidth();
    if ( width < 180 ) {
        jQuery( '.woocommerce ul.products li.product .button' ).addClass( 'shopping-button' );
    } else {
        jQuery( '.woocommerce ul.products li.product .button' ).removeClass( 'shopping-button' );
    }
}
jQuery(document).ready(resizecartbutton);
jQuery(window).resize(resizecartbutton);