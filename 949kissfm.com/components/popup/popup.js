
/**
 *	EXTERNAL LIBRARY FOR POPUP PLAYER
 * http://rip747.github.io/popupwindow/
 * Popup windows
 * Used in the popup player
 * 
 */


(function($){

$.fn.popupwindow = function(p)
{



	$("body").on("click", ".qt-popupwindow", function(e){
		e.preventDefault();
		



		var settings, parameters, mysettings, b, a, winObj;
		
		// for overrideing the default settings

		var btn = $(this),
			destination = btn.attr("href"),
			name = btn.attr("data-name"),
			width= btn.attr("data-width"),
			height= btn.attr("data-height");
			
		settings = {
			height:600, // sets the height in pixels of the window.
			width:600, // sets the width in pixels of the window.
			toolbar:0, // determines whether a toolbar (includes the forward and back buttons) is displayed {1 (YES) or 0 (NO)}.
			scrollbars:0, // determines whether scrollbars appear on the window {1 (YES) or 0 (NO)}.
			status:0, // whether a status line appears at the bottom of the window {1 (YES) or 0 (NO)}.
			resizable:1, // whether the window can be resized {1 (YES) or 0 (NO)}. Can also be overloaded using resizable.
			left:0, // left position when the window appears.
			top:0, // top position when the window appears.
			center:0, // should we center the window? {1 (YES) or 0 (NO)}. overrides top and left
			createnew:1, // should we create a new window for each occurance {1 (YES) or 0 (NO)}.
			location:0, // determines whether the address bar is displayed {1 (YES) or 0 (NO)}.
			menubar:0, // determines whether the menu bar is displayed {1 (YES) or 0 (NO)}.
			onUnload:null // function to call when the window is closed
		};

		if(width) {
			settings.width = width;
		}
		if(height) {
			settings.height = height;
		}

		// center the window
		if (settings.center == 1)
		{
			settings.top = (screen.height-(settings.height + 110))/2;
			settings.left = (screen.width-settings.width)/2;
		}
		
		parameters = "location=" + settings.location + ",menubar=" + settings.menubar + ",height=" + settings.height + ",width=" + settings.width + ",toolbar=" + settings.toolbar + ",scrollbars=" + settings.scrollbars  + ",status=" + settings.status + ",resizable=" + settings.resizable + ",left=" + settings.left  + ",screenX=" + settings.left + ",top=" + settings.top  + ",screenY=" + settings.top;
		/*
		Main popup opening function
		 */
		winObj = window.open(destination, name, parameters);

		
		if (settings.onUnload) {
			// Incremental check for window status
			// Attaching directly to window.onunlaod event causes invoke when document within window is reloaded
			// (i.e. an inner refresh)
			unloadInterval = setInterval(function() {
				if (!winObj || winObj.closed) {
					clearInterval(unloadInterval);	
					settings.onUnload.call($(this));
				}
			},500);
		}
		
		
		return false;
	});
};
})(jQuery);