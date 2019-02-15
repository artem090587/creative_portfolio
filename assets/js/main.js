var codebean=codebean||{};

;(function( $ ) {
    "use strict";

    var win = $(window);

    var target = false;
	if (location.hash) {
		target = window.location.hash;
		window.location.hash = "";
	}

    $( document ).on( 'ready', function() {

        var $anchors   = $( '.section > .section-anchor' ),
			$menus     = $( '.menu-item > a' ),
			offset     = 90,
			HTMLOffset = parseInt( $( 'html' ).css( 'marginTop' ) ) + 1;

		$('.hero-section').css('height', $('.hero-section').css('height'));
		$('body').css('height', 'auto');

        window.clickAnchorLink = function( $a, e ) {
            var url = $a.attr( 'href' ),
                hash = url.indexOf( '#' ),
                $target = ( hash == -1 ) ? null : $( url.substring( hash ) );

            if ( $target && $target.length > 0 ) {
                e.preventDefault();

                var top = $target.offset().top;

                if ( top <= $( '#main-wrap' ).offset().top ) {
                    offset = 70;
                } else {
                    offset = 70;
                }

                $( 'body, html' ).animate({ scrollTop: top - offset - HTMLOffset }, 1000 );
            };
        };

        $( 'body' ).on( 'click', '.js-anchor-link', function( e ) {
            clickAnchorLink( $( this ), e );
        });

        $menus.on( 'click', function( e ) {
            clickAnchorLink( $( this ), e );
        });

        var headerOffset = $("#header").outerHeight();

        $anchors.waypoint(function(direction) {
            var $this = $(this),
                anchor   = $this.attr( 'data-anchor' ),
                $section = $( $this.data( 'section' ) );

            if ( $section.length < 1 ) return;

            var id       = $section.attr( 'id' ),
                $a       = $menus.filter( '[href$="#' + id + '"]' );

            if ( anchor == 'top' && direction == 'down' ) {
                $menus.removeClass( 'is-active' );
                $a.addClass( 'is-active' );
            }

            else if ( anchor == 'bottom' && direction == 'up' ) {
                $menus.removeClass( 'is-active' );
                $a.addClass( 'is-active' );
            }

            else {
                $menus.removeClass( 'is-active' );
            }

        }, {
            offset: headerOffset + 1 + "px"
        });


		// Preloader
		if ( $.fn.jpreLoader ) {
			var $preloader = $( '.js-preloader' );

			$preloader.jpreLoader({
				// showPercentage: false,
			}, function() {
				$preloader.addClass( 'preloader-done' );
				$( 'body' ).trigger( 'preloader-done' );
				$( window ).trigger( 'resize' );
				if(target) {
					$('a[href$="' + target + '"]').on('click');
					window.location.hash = target;
				}
			});
		} else {
			if(target) {
				$('a[href$="' + target + '"]').on('click');
				window.location.hash = target;
			}
		};

		// Fixed Header
		$(".header-site").sticky({ 
			topSpacing: 0, 
			className: 'is-sticky', 
			zIndex: '9999',
			wrapperClassName: 'main-menu-wrapper' 
		});

		$(".mobile-header").sticky({
			topSpacing: 0,
			className: 'is-sticky',
			zIndex: '9999',
			wrapperClassName: 'mobile-menu-wrapper'
		})

		// Superfish
		if ( $.fn.superfish ) {
			$( '.js-superfish' ).superfish({
				speed: 300,
				speedOut: 300,
				delay: 0,
            });
		};

		// Mobile Menu
		$('.mobile-toggle-icon').on('click', function(ev) {

			ev.preventDefault();

			$('.mobile-menu').toggle();
			$(this).toggleClass('active');

		});

		mobileMenu();

		function mobileMenu() {			
			$('.mobile-menu li:has(> ul)').each(function(i, el) {
				var $li  	= $(el),
					$a      = $li.children('a'),
					$sub    = $li.children('ul');
				
				$a.append('<span class="submenu-expander"><i class="fa fa-angle-down"></i></span>');
			
				var $sub_i = $a.find('.submenu-expander');

				$sub_i.on('click', function(ev) {
					
					ev.preventDefault();

					$sub.slideToggle();

				});
			
			});

			
			$('.mobile-menu a[href*=#]').on('click', function(ev) {
				ev.preventDefault;
	
				$('.mobile-menu').slideUp();
			});
		}

		// Portfolio Masonry
		function masonryLayout() {
            if (typeof($.fn.isotope) == 'undefined' || typeof($.fn.imagesLoaded) == 'undefined') return;
            var $container = $('.masonry-wrapper');

            $container.imagesLoaded(function() {
            	$container.isotope({
					gutter: 0,
					itemSelector: '.masonry-item',
				});
			});

            $('.portfolio-filters').on('click', 'a', function(e) {
            	e.preventDefault();
                $('.portfolio-filters').find('.active').removeClass('active');
                $(this).addClass('active');
                var filterValue = $(this).attr('data-filter');
                $container.isotope({
                    filter: filterValue
                });
			});
		}

		masonryLayout();

		// Portfolio Gallery Lightbox
		$('.single-gallery-holder, .portfolio-main-image').each(function () {
			$(this).magnificPopup({
				type: 'image',
                delegate: 'a.lightbox-gallery',
				gallery: {
					enabled: true,
                    navigateByImgClick: true,
                    preload: [0, 1]
				},
                zoom: {
                    enabled: true,
                    opener: function(element) {
                        return element.find('img');
                    }
                },
                removalDelay: 300,
                mainClass: 'mfp-fade',
                fixedContentPos: false
			});
        });

		// Portfolio Gallery Carousel
		$('.portfolio-images-carousel').owlCarousel({
			items: 1,
			autoplay: true,
			dots: true,
			nav: false,
            navText:false,
			loop: true,
            onRefreshed: function() {
                $(window).resize();
            }
		});


		// Parallax
		if ( $.fn.parallax && codebean.is_mobile_or_tablet == 'false' ) {
			$( window ).on( 'load', function() {
				$( '.js-parallax' ).parallax( '50%', 0.5 );
			});
		};


		if ( $.fn.isotope ) {
			$( '.js-isotope-grid' ).each(function() {

				var $el = $( this ),
					$filter = $el.find( '.portfolio-filters > li > a' ),
					$loop = $el.find( '.layout-type-masonry' );
				
				$loop.isotope({ sortBy : 'original-order', layoutMode: 'moduloColumns' });

				$loop.imagesLoaded(function() {
					$loop.isotope( 'layout' );
				});

				if ( $filter.length > 0 ) {
					
					$filter.on( 'click', function( e ) {
						e.preventDefault();

						$loop.children().addClass( 'wpb_disable_animation' );

						var $a = $(this);
						$filter.removeClass( 'active' );
						$a.addClass( 'active' );
						$loop.isotope({ filter: $a.data( 'filter' ) });
					});
				};
			});
		}

		// Portfolio Items Load More
		$( '.wpb_patch_portfolio_grid' ).each(function( i, el ) {

			var $el					= $( el ),
				id					= $( el ).attr( 'id' ),
				$load_more_button	= $el.find( '.portfolio-button' ),
				$load_more_link   	= $load_more_button.find( '> a' ),
				$icon             = $load_more_button.find( '.glyphicon-refresh' ),
				$loop             = $el.find( '.layout-type-masonry' );

			$load_more_button.on( 'click', function( e ) {
				e.preventDefault();

				var ajaxurl			= $load_more_link.attr( 'href' ),
					$new_archive	= $( '<div/>' );
				
				$icon.addClass( 'fa-spin' );

				$new_archive.load( ajaxurl + ' #' + id + ':first', undefined, function() {

					$new_archive   = $new_archive.find( '.wpb_patch_portfolio_grid' );
					var $new_items = $new_archive.find( '.portfolio-item' );

					$new_items.css( 'visibility', 'hidden' );
					$new_items.css( 'height', 0 );
					// visual composer animation effect fix
					$new_items.addClass( 'wpb_start_animation' );
					$loop.append( $new_items );

					// re-apply magnificPopup
					$new_items.imagesLoaded(function() {
						$new_items.css( 'visibility', '' );
						$new_items.css( 'height', '' );
						if ( $.fn.isotope ) {
							$loop.isotope( 'appended', $new_items );
						};
						$icon.removeClass( 'fa-spin' );
						if ( ! $new_archive.data( 'next' ) ) {
							$load_more_button.stop().fadeOut( 1000 );
						};
					});

					$el.data( 'loading', $new_archive.data( 'loading' ) );
					if ( $new_archive.data( 'loading' ) ) {
						$load_more_link.attr( 'href', $new_archive.data( 'loading' ) );
					};
				});
			});
		});

		// Skill Bar
		$( '.js-skill-bar' ).each(function( i, el ) {
			var $el = $( el ),
				value = $el.data( 'percentage' ),
				percentageNumber = $el.find( '.skill-bar-value' ),
			    $bar = $el.find( '.progress-track' );

			$bar.css( 'width', 0 );
			$el.waypoint(function( direction ) {
				if ( ! $el.data( 'animated' ) ) {
					$({ progress: 0 }).animate({ progress: value }, {
						duration: 1000,
						step: function( now, tween ) {
							$bar.css( 'width', now + '%' );
						},
					});
					$el.data( 'animated', true );
				};
				percentageNumber.addClass('visible');
			}, { offset: 'bottom-in-view' });

		});

        function cdbAnimatedCounter() {

            var counters = $('.js-milestone-number');

            if (counters.length) {
                counters.each(function () {
                    var counter = $(this);
                    counter.waypoint(function( direction ) {
                        counter.parent().css({'opacity': 1});

                        //Counter zero type
                        var max = parseFloat(counter.text());
                        counter.countTo({
                            from: 0,
                            to: max,
                            speed: 1500,
                            refreshInterval: 100
                        });

                    }, { offset: 'bottom-in-view' });
                });
            }

        }

        cdbAnimatedCounter();

		// Patch Testimonials
		$(".js-testimonials").owlCarousel({
			autoHeight : true,
			singleItem : true,
			autoPlay: 8000,
			navigation:true,
			pagination: false,
			navigationText : ["<span class='arrow -left'><i class='ti-angle-left'></i></span>","<span class='arrow -right'><i class='ti-angle-right'></i></span>"],
			slideSpeed : 1000,
			afterAction: testimonialItemsCount
		});
	
		function testimonialItemsCount(){
			$('.testimonials-slider-track').text(""+(this.owl.currentItem+1)+" / " + this.owl.owlItems.length+"");
		}

		// Patch Portfolio Slider
		$(".js-portfolioslider").owlCarousel({
			autoHeight: true,
			singleItem: true,
			autoPlay: 8000,
			pagination: true,
			navigation: true,
			navigationText : ["<span class='arrow -left'><i class='ti-angle-left'></i></span>","<span class='arrow -right'><i class='ti-angle-right'></i></span>"],
			slideSpeed: 1000,
		});

		// Go top button
		var gotop_offset = 500,
			$back_to_top = $('.go-top-button');
			
		jQuery(window).scroll(function() {
			(jQuery(this).scrollTop() > gotop_offset) ? $back_to_top.addClass('is-visible') : $back_to_top.removeClass('is-visible');
		})
		$back_to_top.on('click', function() {
			jQuery('html, body').animate({
				scrollTop: 0
			}, 700);
			return false;
		});

    });

})( jQuery );