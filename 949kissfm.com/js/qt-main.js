/**
 *
 *
 *
 *  Main Script File
 *  
 **/


(function($) {

	"use strict";


	/**====================================================================
	 *
	 *
	 * 	Helpers
	 *
	 * 
	 ====================================================================*/


	// =================================================================
	//  Check mobile devices
	// =================================================================
	$.fn.mobilecheck = function() {
		var check = false;
		(function(a) {
			if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))) check = true
		})(navigator.userAgent || navigator.vendor || window.opera);
		return check;
	}
	if (true === $.fn.mobilecheck()) {
		$("html").addClass("qt_is_mobile");
	}


	// =================================================================
	// Helper: safe way to define callbacks
	// =================================================================
	$.fn.executeFunctionByName = function(functionName, context) {
		var args = [].slice.call(arguments).splice(2);
		var namespaces = functionName.split(".");
		var func = namespaces.pop();
		for (var i = 0; i < namespaces.length; i++) {
			context = context[namespaces[i]];
		}
		return context[func].apply(this, args);
	}


	// =================================================================
	// ImagesLoaded
	// to check when the images in a certain DIV are loaded
	// Example: $("#mydiv").imagesLoaded().then(function(){ alert(Pictures loaded); });
	// =================================================================
	$.fn.imagesLoaded = function() {
		// get all the images (excluding those with no src attribute)
		var $imgs = this.find('img[src!=""]');
		// if there's no images, just return an already resolved promise
		if (!$imgs.length) {
			return $.Deferred().resolve().promise();
		}
		// for each image, add a deferred object to the array which resolves when the image is loaded (or if loading fails)
		var dfds = [];
		$imgs.each(function() {
			var dfd = $.Deferred();
			dfds.push(dfd);
			var img = new Image();
			img.onload = function() {
				dfd.resolve();
			}
			img.onerror = function() {
				dfd.resolve();
			}
			img.src = this.src;
		});
		// return a master promise object which will resolve when all the deferred objects have resolved
		// IE - when all the images are loaded
		return $.when.apply($, dfds);
	}



	/**====================================================================
	 *
	 * 
	 *	12. Mobile navigation
	 *	
	 * 
	 ====================================================================*/
	$.fn.qtMobileNav = function() {
		$(".side-nav").on("click", "li.menu-item-has-children > a", function(e) {
			var that = $(this).parent();
			console.log("click");
			e.preventDefault();
			if (that.hasClass("open")) {
				that.removeClass("open");
			} else {
				that.addClass("open");
			}
			return true;
		});
		return true;
	}


	


	/**====================================================================
	*
	* 
	*  	Slick gallery
	*  
	* 
	====================================================================*/

	$.fn.slickGallery = function() {
		$('.qt-slickslider, .qt-slick').each(function(i, c) {

			var that = $(this),
				slidesToShow = that.attr("data-slidestoshow"),
				slidestoshowMobile = that.attr("data-slidestoshowmobile"),
				slidestoshowIpad = that.attr("data-slidestoshowipad"),
				appendArrows = that.attr("data-appendArrows");

			if (slidesToShow === undefined || slidesToShow === "") {
				slidesToShow = 1;
			}
			if (slidestoshowMobile === undefined || slidestoshowMobile === "") {
				slidestoshowMobile = 1;
			}
			if (slidestoshowIpad === undefined || slidestoshowIpad === "") {
				slidestoshowIpad = slidesToShow;
			}

			if (appendArrows === undefined || appendArrows === "") {
				appendArrows = that; // append the arrows to the same container
			} else {
				appendArrows = that.closest(appendArrows); // or append arrows to other divs
			}


			that.slick({
				// lazyLoad: 'progressive',
				slidesToScroll: 1,
				pauseOnHover: that.attr("data-pauseonhover") === "true",
				infinite: that.attr("data-infinite") === "true",
				autoplay: that.attr("data-autoplay") === "true",
				autoplaySpeed: 4000,
				centerPadding: 0,
				slide: ".qt-item",
				dots: that.attr("data-dots") === "true",
				variableWidth: that.attr("data-variablewidth") === "true",
				arrows: that.attr("data-arrows") === "true",
				centerMode: that.attr("data-centermode") === "true",
				slidesToShow: slidesToShow,
				appendArrows: appendArrows,
				responsive: [

					{
						breakpoint: 480,
						settings: {
							arrows: that.attr("data-arrowsmobile") === "true",
							centerMode: that.attr("data-centermodemobile") === "true",
							centerPadding: 0,
							variableWidth: that.attr("data-variablewidthmobile") === "true",
							variableHeight: false,
							dots: that.attr("data-dotsmobile") === "true",
							slidesToShow: slidestoshowMobile,
							draggable: false,
							swipe: true,
							touchMove: true,
							infinite: that.attr("data-infinitemobile") === "true",
						}
					}, {
						breakpoint: 800,
						settings: {
							slidesToShow: slidestoshowIpad,
							arrows: slidestoshowIpad === 1,
							dots: slidestoshowIpad > 1
						}
					}
				]
			});
		});



	}


	/**====================================================================
	 *
	 * 
	 *	Generic class switcher (toggle class or toggleclass)
	 *	
	 * 
	 ====================================================================*/
	$.fn.qtQtSwitch = function() {
		$("body").on("click", "[data-qtswitch]", function(e) {
			var that = $(this);
			e.preventDefault();
			$(that.attr("data-target")).toggleClass(that.attr("data-qtswitch"));
		});

		$("[data-expandable]").each(function(i, c) {
			var that = $(c),
				selector = that.attr("data-expandable"),
				target = $(selector);

			if (selector !== "") {
				if (target.hasClass("open")) {
					console.log("Auto expansion: " + selector);
					target.velocity({
						properties: {
							height: target.find(".qt-expandable-inner").height() + "px"
						},
						options: {
							duration: 50

						}
					});
				}
			}

		});


		$("body").on("click", "[data-expandable]", function(e) {
			e.preventDefault();
			var btn = $(this);
			var that = $(btn.attr("data-expandable"));
			console.log("-> EXPANDING " + btn.attr("data-expandable"));
			if (!that.hasClass("open")) {
				that.addClass("open");
				that.velocity({
					properties: {
						height: that.find(".qt-expandable-inner").height() + "px"
					},
					options: {
						duration: 300

					}
				});
			} else {
				that.removeClass("open");
				// that.height(0);
				that.velocity({
					properties: {
						height: 0
					},
					options: {
						duration: 300
					}
				});
			}
		});



	}


	/**====================================================================
	 *
	 * 
	 *  17. Dynamic backgrounds
	 *  
	 * 
	 ====================================================================*/

	$.fn.dynamicBackgrounds = function(targetContainer) {
		if (undefined === targetContainer) {
			targetContainer = "body";
		}
		$(targetContainer + " [data-bgimage]").each(function(i, c) {
			var that = $(this),
				bg = that.attr("data-bgimage"),
				bgattachment = that.attr("data-bgattachment");
			if (bgattachment == undefined) {
				bgattachment = "static";
			}
			if (bg !== '') {
				that.css({
					"background-image": "url(" + bg + ")",
					"background-attachment": bgattachment
				});
			}
		});
		$(targetContainer + " [data-bgcolor]").each(function(i, c) {
			var that = $(this),
				bgcolor = that.attr("data-bgcolor");
			if (bgcolor !== "") {
				if (that.attr("data-bgopacity")) {
					var bgopacity = that.attr("data-bgopacity");
					var bgcolor = "rgba(" + hexToRgb2(bgcolor) + "," + (bgopacity / 100) + ")";
				}
				that.find(".fp-tableCell, .qw-fixedcontents-layer2, .qw-gbcolorlayer").css({
					"background-color": bgcolor
				});
			}
		});
	}



	/* Sidebars collapsible 
	===================================================*/
	$(".button-collapse").sideNav();

	// Channels list
	$('.button-playlistswitch').sideNav({
		menuWidth: 280, // Default is 240
		edge: 'right', // Choose the horizontal origin
		closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
		draggable: false // Choose whether you can drag to open on touch screens
	});



	$("body").on("click", ".button-playlistswitch-close", function(e) {
		$('.button-playlistswitch').sideNav('hide');
	});

	$("body").on("click", ".qt-scrolltop", function(e) {
		$("html, body").animate({
			scrollTop: 0
		}, "slow");
	});


	$.fn.qtMobileNav();
	$.fn.slickGallery();
	$.fn.qtQtSwitch();
	$.fn.dynamicBackgrounds();

	/* Pushpin */
	if ($(window).width() > 1280 && $('.qt-pushpin').length > 0) {
		$('.qt-pushpin').css({
			"width": $('.qt-pushpin').width()
		});
		$('.qt-pushpin').pushpin({
			top: $('.qt-pushpin-container').offset().top,
			bottom: $('.qt-pushpin-container').parent().height()
		});
	}


	/* Event countdown (component) */
	$.each($('.qt-countdown'), function(i, c) {
		var that = $(c),
			date = that.attr("data-end");
		if (date !== undefined && date !== "") {
			var eventdate = new Date(date),
				nowdate = (new Date),
				eventtime = eventdate.getTime(),
				nowtime = nowdate.getTime(),
				difference = eventtime - nowtime;
			$(c).ClassyCountdown({
				theme: "white-wide",
				end: $.now() + (difference / 1000)
			});
		}
	});

	/* Popup player (requires library component) 
	===================================================*/
	$.fn.popupwindow();



	/* Function to go back in history 
	===================================================*/
	window.goBack = function(e) {
		var defaultLocation = "http://www.mysite.com";
		var oldHash = window.location.hash;

		history.back(); // Try to go back

		var newHash = window.location.hash;

		/* If the previous page hasn't been loaded in a given time (in this case
		 * 1000ms) the user is redirected to the default location given above.
		 * This enables you to redirect the user to another page.
		 *
		 * However, you should check whether there was a referrer to the current
		 * site. This is a good indicator for a previous entry in the history
		 * session.
		 *
		 * Also you should check whether the old location differs only in the hash,
		 * e.g. /index.html#top --> /index.html# shouldn't redirect to the default
		 * location.
		 */

		if (
			newHash === oldHash &&
			(typeof(document.referrer) !== "string" || document.referrer === "")
		) {
			window.setTimeout(function() {
				// redirect to default location
				window.location.href = defaultLocation;
			}, 1000); // set timeout in ms
		}
		if (e) {
			if (e.preventDefault)
				e.preventDefault();
			if (e.preventPropagation)
				e.preventPropagation();
		}
		return false; // stop event propagation and browser default event
	}


	/**====================================================================
	 *
	 * 
	 *  Share link
	 *  
	 * 
	 ====================================================================*/

	$.fn.qtSharelink = function() {
		$(".qt-sharelink").each(function(i,c){
			var that = $(this),
				urlencoded = escape(window.location.href) /* Get page URL here and encode it */, // window.location.href
				descriptionencoded = "New bookmark"/* Get page description here */,
				sharetype = that.attr("data-sharetype"),
				finalurl = '';
			switch (sharetype) {
				case "facebook":
					finalurl = 'https://www.facebook.com/sharer/sharer.php?u='+urlencoded;
				break;
				case "twitter":
					finalurl = 'https://twitter.com/home?status='+urlencoded;
				break;
				case "google":
					finalurl = 'https://plus.google.com/share?url='+urlencoded;
				break;
				case "pinterest":
					finalurl = 'https://pinterest.com/pin/create/bookmarklet/?url='+urlencoded;
				break;
			}
			that.attr("href",finalurl);
		});
	}
	$.fn.qtSharelink();



	/* Disable debug console output */
	var console = {};
	console.log = function() {};
	window.console = console;


})(jQuery);