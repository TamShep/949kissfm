<?php
/**
 * Please be aware. This gist requires at least PHP 5.4 to run correctly.
 * Otherwise consider downgrading the $opts array code to the classic "array" syntax.
 */
function getMp3StreamTitle($streamingUrl, $interval, $offset = 0, $headers = true)
{
	$needle = 'StreamTitle=';
	$ua = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36';

	$opts = [
			'http' => [
			'method' => 'GET',
			'header' => 'Icy-MetaData: 1',
			'user_agent' => $ua
		]
	];

	if ($headers = get_headers($streamingUrl)) {
		foreach ($headers as $h) {
			if (strpos(strtolower($h), 'icy-metaint') !== false && ($interval = explode(':', $h)[1])) {
				break;
			}
		}
	}

	$context = stream_context_create($opts);

	if ($stream = fopen($streamingUrl, 'r', false, $context)) {
		$buffer = stream_get_contents($stream, $interval, $offset);
		fclose($stream);

		if (strpos($buffer, $needle) !== false) {
			$title = explode($needle, $buffer)[1];
			return substr($title, 1, strpos($title, ';') - 2);
		} else {
			return getMp3StreamTitle($streamingUrl, $interval, $offset + $interval, false);
		}
	} else {
		throw new Exception("Unable to open stream [{$streamingUrl}]");
	}
}

echo "\n\n";
?>

<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>103.7 KISS FM - Player</title>
        <meta name="description" content="103.7 KISS FM Norfolk - All Your Favorites 2K to Today - Hampton Roads #1 Hit Music Station - WXKJ Virginia Beach / WDNR HD2 Norfolk">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        
        <!-- icons -->
        <link href='fonts/dripicons/webfont.css' rel='stylesheet' type='text/css'>
        <link href='fonts/qticons/qticons.css' rel='stylesheet' type='text/css'>
        
        <!-- slick slider -->
        <link href='components/slick/slick.css' rel='stylesheet' type='text/css'>
        
        <!-- swipebox -->
        <link href='components/swipebox/src/css/swipebox.min.css' rel='stylesheet' type='text/css'>
        
        <!-- countdown component -->
        <link rel="stylesheet" type="text/css" href="components/countdown/css/jquery.classycountdown.css" />

        <!-- QT 360 PLAYER component -->
        <link rel="stylesheet" type="text/css" href="components/soundmanager/templates/qtradio-player/css/flashblock.css" />
        <link rel="stylesheet" type="text/css" href="components/soundmanager/templates/qtradio-player/css/qt-360player-volume.css" />

        
        <!-- Main css file -->
        <link rel="stylesheet" href="css/qt-main.css"><!-- INCLUDES THE CHOSEN FRAMEWORK VIA #IMPORT AND SASS -->
        
        <!-- Custom typography settings and google fonts -->
        <link rel="stylesheet" href="css/qt-typography.css">
    </head>
    <body>
    <!-- QT HEADER END ================================ -->
    <div class="qt-parentcontainer">
		        
		<!-- PLAYER ========================= -->
		<div id="qtplayercontainer" data-playervolume="true" data-accentcolor="#dd0e34" data-accentcolordark="#ff0442" data-textcolor="#ffffff" data-soundmanagerurl="./components/soundmanager/swf/" class="qt-playercontainer qt-playervolume qt-clearfix qt-content-primary">
			<div class="qt-playercontainer-content qt-vertical-padding-m">
				<div class="qt-playercontainer-header">
					<h5 class="qt-text-shadow small">Now on</h5>
					<h3 id="qtradiotitle" class="qt-text-shadow">103.7 KISS FM</h3>
					<h4 id="qtradiosubtitle" class="qt-thin qt-text-shadow small">Hampton Roads #1 Hit Music Station</h4>
				</div>
				<div class="qt-playercontainer-musicplayer" id="qtmusicplayer">
					<div class="qt-musicplayer">
						<div class="ui360 ui360-vis qt-ui360">
							<a id="playerlink" href="https://ice1.newtoncommunications.org/radio/wxkjmain.mp3"></a>
						</div>
					</div>
				</div>
				<div class="qt-playercontainer-data qt-container qt-text-shadow small">
					<h6 class="qt-inline-textdeco">
						<span>Current track</span>
					</h6>
					<div class="qt-t qt-current-track">
						<h5 id="qtFeedPlayerTrack"><?php echo getMp3StreamTitle('https://ice1.newtoncommunications.org/radio/wxkjmain.mp3', 19200);?></h5>
					</div>
					<hr class="qt-inline-textdeco">
				</div>
			</div>
			<div id="playerimage" class="qt-header-bg" data-bgimage="imagestemplate/full-1600-700.jpg">
				<img src="imagestemplate/full-1600-700.jpg" alt="Featured image" width="690" height="302">
			</div>
		</div>
		<!-- this is for xml radio feed -->
		<div id="qtShoutcastFeedData" class="hidden" data-style="" data-channel="1" data-host="ice1.newtoncommunications.org" data-port="80"></div>
		<!-- PLAYER END ========================= -->
		<!-- CHANNELS LIST ========================= -->
		<div class="qt-part-channels-list">
			<ul class="qt-content-aside qt-channelslist qt-negative qt-content-primary">
				<li class="qt-channel">
					<a href="#!" class="qt-ellipsis" data-title="103.7 KISS FM" data-subtitle="Hampton Roads #1 Hit Music Station" data-background="imagestemplate/photo-squared-500-500.jpg" data-logo="imagestemplate/radio-logo.png" data-playtrack="https://ice1.newtoncommunications.org/radio/wxkjmain.mp3" data-host="ice1.newtoncommunications.org" data-port="80" data-stats_path="" data-played_path="" data-channel="">
						<img src="imagestemplate/radio-logo.png" alt="logo" class="qt-radiologo dripicons-media-play" width="80" height="80">
						<i class="dripicons-media-play"></i> 	103.7 KISS FM
					</a>
				</li>
			</ul>
		</div>
		<!-- CHANNELS LIST END ========================= -->

        </div>        
        <!-- QT BODY END ================================ -->

        <!-- QT FOOTER SCRIPTS ================================ -->
        <script src="js/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <script src="js/jquery.js"></script><!--  JQUERY VERSION MUST MATCH WORDPRESS ACTUAL VERSION (NOW 1.12) -->
        <script src="js/jquery-migrate.min.js"></script><!--  JQUERY VERSION MUST MATCH WORDPRESS ACTUAL VERSION (NOW 1.12) -->
       
        <!-- Framework -->
        <script src="js/materializecss/bin/materialize.min.js"></script>

        <!-- Cookies for player -->
        <script src="js/jquerycookie.js"></script>

         <!-- Slick carousel and skrollr -->
        <script src="components/slick/slick.min.js"></script>
        <script src="components/skrollr/skrollr.min.js"></script>
        
        <!-- Swipebox -->
        <script src="components/swipebox/lib/ios-orientationchange-fix.js"></script>
        <script src="components/swipebox/src/js/jquery.swipebox.min.js"></script>

        <!-- Countdown -->
        <script src="components/countdown/js/jquery.knob.js"></script>
        <script src="components/countdown/js/jquery.throttle.js"></script>
        <script src="components/countdown/js/jquery.classycountdown.min.js"></script>

        <!-- Soundmanager2 -->
        <!--[if IE]><script src="components/soundmanager/script/excanvas.js"></script><![endif]-->
        <script src="components/soundmanager/script/berniecode-animator.js"></script>
        <script src="components/soundmanager/script/soundmanager2-nodebug.js"></script>
        <!-- <script src="components/soundmanager/script/shoutcast.js"></script> -->
        <script src="components/soundmanager/templates/qtradio-player/script/qt-360player-volumecontroller.js"></script>

        <!-- Popup -->
        <script src="components/popup/popup.js"></script>


        <!-- MAIN JAVASCRIPT FILE ================================ -->
        <script src="js/qt-main.js"></script>

    </body>
</html>
