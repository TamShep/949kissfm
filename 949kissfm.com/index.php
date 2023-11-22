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
		<title>103.7 KISS FM - Home</title>
		<meta name="description" content="103.7 KISS FM Norfolk - All Your Favorites 2K to Today - Hampton Roads #1 Hit Music Station - WXKJ Virginia Beach / WDNR HD2 Norfolk">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta property="og:site_name" content="103.7 KISS FM">
		<meta property="og:url" content="https://kissfmva.com/">
		<meta property="og:title" content="103.7 KISS FM - Home">
		<meta property="og:type" content="article">
		<meta property="og:image" content="https://kissfmva.com/metadata.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<meta property="og:image:type" content="image/png">
		<meta name="theme-color" content="#c28a88">
		<meta name="author" content="@kissfmva">
		<meta name="twitter:card" content="summary_large_image">
		
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
				
		 <!-- QT MENUBAR TOP ================================ -->
		<div class="qt-menubar-top  qt-content-primary hide-on-large-and-down">
			<ul>
				<li><a href="https://newtoncommunications.org/"><i class="dripicons-chevron-right"></i>About US</a></li>
				<li><a href="mailto:wxkjpublic@newtoncommunications.org"><i class="dripicons-chevron-right"></i>Contacts</a></li>
				<li class="right"><a href="https://twitter.com/kissfmva"><i class="qticon-twitter qt-socialicon"></i></a></li>
			</ul>
		</div>
		<!-- QT MENUBAR  ================================ -->
		<nav class="qt-menubar nav-wrapper qt-content-primary ">
			<!-- desktop menu  HIDDEN IN MOBILE AND TABLETS -->
			<ul class="qt-desktopmenu hide-on-xl-and-down">
				<li class="qt-logo-link"><a href="./" class="brand-logo qt-logo-text"><img src="imagestemplate/WXKJ.png" alt="Featured image" width="137.1" height="67.8667"></img></a></li>
				<li class="right"><a href="page-popup.php" class="qt-popupwindow" data-name="Music Player" data-width="320" data-height="500"><i class="icon dripicons-duplicate"></i> Popup</a></li>
				<li class="right"><a href="#!" class="button-playlistswitch" data-activates="channelslist"><i class="icon dripicons-media-play"></i> Listen</a></li>
			</ul>
			<!-- mobile menu icon and logo VISIBLE ONLY TABLET AND MOBILE-->
			<ul class="qt-desktopmenu hide-on-xl-only ">
				<li><a href="#" data-activates="qt-mobile-menu" class="button-collapse qt-menu-switch qt-btn qt-btn-primary qt-btn-m"><i class="dripicons-menu"></i></a></li>
				<li><a href="#!" class="brand-logo qt-logo-text">103.7 KISS FM</a></li>
			</ul>
		</nav>
		<!-- mobile menu -->
		<div id="qt-mobile-menu" class="side-nav qt-content-primary">
			<ul class=" qt-side-nav">
				<li><a href="#">Home</a></li>
			</ul>
		</div>
		<!-- mobile toolbar -->
		<ul class="qt-mobile-toolbar qt-content-primary-dark qt-content-aside hide-on-large-only">
			<li><a href="page-popup.php" class="qt-popupwindow" data-name="Music Player" data-width="320" data-height="500"><i class="icon dripicons-duplicate"></i></a></li>
			<li><a href="#!" class="button-playlistswitch" data-activates="channelslist"><i class="icon dripicons-media-play"></i></a></li>
		</ul>
		<div id="maincontent" class="qt-main">
			<!-- ======================= SLIDESHOW SECTION ======================= -->
			<!-- SLIDESHOW FULLSCREEN ================================================== -->
			<div class="qt-slickslider-container">
				<div class="qt-slickslider qt-slickslider-single qt-text-shadow qt-black-bg" data-variablewidth="true" data-arrows="true" data-dots="true" data-infinite="true" data-centermode="true" data-pauseonhover="true" data-autoplay="true" data-arrowsmobile="true" data-centermodemobile="true" data-dotsmobile="false" data-variablewidthmobile="true">
					<!-- SLIDESHOW ITEM -->
					<div class="qt-slick-opacity-fx qt-item">
						<!-- POST HERO ITEM ========================= -->
						<div class="qt-part-archive-item qt-part-item-post-hero">
							<div class="qt-item-header">
								<div class="qt-header-top">
									<div class="qt-feedback">
										<a>0<i class="dripicons-message"></i></a><a>1<i class="dripicons-heart"></i></a>
									</div>
								</div>
								<div class="qt-header-mid qt-vc">
									<div class="qt-vi">
										<ul class="qt-tags">
											<li><a href="#">News</a></li>
										</ul>
										<h2 class="qt-title">
											<a href="#read" class="qt-text-shadow">
												103.7 KISS FM, Hampton Roads #1 Hit Music Station
											</a>
										</h2>
										<div class="qt-the-content qt-spacer-s small hide-on-med-and-down ">
											<p class="qt-spacer-s qt-text-shadow">
												Your home for all your favorites 2K to today.
											</p>
											<p><a href="#read" class="qt-btn qt-btn-l qt-btn-primary "><i class="dripicons-align-justify"></i></a></p>
										</div>
									</div>
								</div>
								<div class="qt-header-bg" data-bgimage="imagestemplate/news1.jpg">
									<img src="imagestemplate/news1.jpg" alt="Featured image" width="1170" height="512">
								</div>
							</div>
						</div>
						<!-- POST HERO ITEM END ========================= -->
					</div>
				</div>
			</div>
			<!-- SLIDESHOW FULLSCREEN END ================================================== -->
			<!-- ======================= UPCOMING SHOWS  SECTION ======================= -->
			<div class="qt-vertical-padding-m qt-content-primary-light qt-negative">
				<div class="qt-container">
				<a id="upcoming_shows">
					<h5 class="qt-caption-small"><span>Upcoming shows</span></h5>
					<hr class="qt-spacer-s">
					<!-- SLIDESHOW UPCOMING SHOWS ================================================== -->
					<div class="qt-slickslider-container qt-slickslider-externalarrows">
						<div class="row">
							<div class="qt-slickslider qt-slickslider-multiple qt-slickslider-podcast" data-slidestoshow="3" data-variablewidth="false" data-arrows="true" data-dots="false" data-infinite="true" data-centermode="false" data-pauseonhover="true" data-autoplay="false" data-arrowsmobile="false" data-centermodemobile="true" data-dotsmobile="false" data-slidestoshowmobile="1" data-variablewidthmobile="true" data-infinitemobile="false">
								<!-- SLIDESHOW ITEM -->
								<div class="qt-item">
									<!-- SHOW UPCOMING ITEM ========================= -->
									<div class="qt-part-archive-item qt-part-archive-item-show qt-negative">
										<div class="qt-item-header">
											<div class="qt-header-top">
												<ul class="qt-tags">
													<li><a href="#">Morning Show</a></li>
												</ul>
											</div>
											<div class="qt-header-mid qt-vc">
												<div class="qt-vi">
													<h5 class="qt-time">Weekdays 06:00am-10:00am</h5>
													<h3 class="qt-ellipsis qt-t qt-title">
														<a href="https://www.streetzmorningtakeover.com/" class="qt-text-shadow">Streetz Morning Takeover</a>
													</h3>
													<p class="qt-small qt-ellipsis">(866)-YUNG-JOC</p>
												</div>
											</div>
											<div class="qt-header-bottom">
												<a href="https://www.streetzmorningtakeover.com/" class="qt-btn qt-btn-primary qt-readmore"><i class="dripicons-headset"></i></a>
											</div>
											<div class="qt-header-bg" data-bgimage="https://i.postimg.cc/mD0rRG1K/smt0-730x400.jpg">
												<img src="https://i.postimg.cc/mD0rRG1K/smt0-730x400.jpg" alt="Featured image" width="690" height="302">
											</div>
										</div>
									</div>
									<!-- SHOW UPCOMING ITEM END ========================= -->
								</div>
								<!-- SLIDESHOW ITEM -->
								<div class="qt-item">
									<!-- SHOW UPCOMING ITEM ========================= -->
									<div class="qt-part-archive-item qt-part-archive-item-show qt-negative">
										<div class="qt-item-header">
											<div class="qt-header-top">
												<ul class="qt-tags">
													<li><a href="#">Top 40</a></li>
												</ul>
											</div>
											<div class="qt-header-mid qt-vc">
												<div class="qt-vi">
													<h5 class="qt-time">Sundays 3:00pm</h5>
													<h3 class="qt-ellipsis qt-t qt-title">
														<a href="https://www.airplay40.com/" class="qt-text-shadow">Airplay 40</a>
													</h3>
													<p class="qt-small qt-ellipsis">With Spencer James</p>
												</div>
											</div>
											<div class="qt-header-bottom">
												<a href="https://www.airplay40.com/" class="qt-btn qt-btn-primary qt-readmore"><i class="dripicons-headset"></i></a>
											</div>
											<div class="qt-header-bg" data-bgimage="https://www.airplay40.com/wp-content/uploads/2021/06/airplay-40-2021-blank-768x270.png">
												<img src="https://www.airplay40.com/wp-content/uploads/2021/06/airplay-40-2021-blank-768x270.png" alt="Featured image" width="690" height="302">
											</div>
										</div>
									</div>
									<!-- SHOW UPCOMING ITEM END ========================= -->
								</div>
								<div class="qt-item">
									<!-- SHOW UPCOMING ITEM ========================= -->
									<div class="qt-part-archive-item qt-part-archive-item-show qt-negative">
										<div class="qt-item-header">
											<div class="qt-header-top">
												<ul class="qt-tags">
													<li><a href="#">Hip Hop</a></li>
												</ul>
											</div>
											<div class="qt-header-mid qt-vc">
												<div class="qt-vi">
													<h5 class="qt-time">Saturdays 12:00pm</h5>
													<h3 class="qt-ellipsis qt-t qt-title">
														<a href="https://theloudmix.com/" class="qt-text-shadow">The Loud Mix</a>
													</h3>
													<p class="qt-small qt-ellipsis">With DJ Grooves</p>
												</div>
											</div>
											<div class="qt-header-bottom">
												<a href="https://theloudmix.com/" class="qt-btn qt-btn-primary qt-readmore"><i class="dripicons-headset"></i></a>
											</div>
											<div class="qt-header-bg" data-bgimage="https://theloudmix.com/wp-content/uploads/2022/01/LOUDMIX.png">
												<img src="https://theloudmix.com/wp-content/uploads/2022/01/LOUDMIX.png" alt="Featured image" width="690" height="302">
											</div>
										</div>
									</div>
									<!-- SHOW UPCOMING ITEM END ========================= -->
								</div>
								<!-- SLIDESHOW ITEM -->
								<div class="qt-item">
									<!-- SHOW UPCOMING ITEM ========================= -->
									<div class="qt-part-archive-item qt-part-archive-item-show qt-negative">
										<div class="qt-item-header">
											<div class="qt-header-top">
												<ul class="qt-tags">
													<li><a href="#">Variety</a></li>
												</ul>
											</div>
											<div class="qt-header-mid qt-vc">
												<div class="qt-vi">
													<h5 class="qt-time">Mondays 03:00pm</h5>
													<h3 class="qt-ellipsis qt-t qt-title">
														<a href="https://clearingthestatic.blogspot.com/" class="qt-text-shadow">Radio Serena Show</a>
													</h3>
													<p class="qt-small qt-ellipsis">With Serena</p>
												</div>
											</div>
											<div class="qt-header-bottom">
												<a href="https://clearingthestatic.blogspot.com/" class="qt-btn qt-btn-primary qt-readmore"><i class="dripicons-headset"></i></a>
											</div>
											<div class="qt-header-bg" data-bgimage="https://i.postimg.cc/0NfJ1yS2/image.png">
												<img src="https://i.postimg.cc/0NfJ1yS2/image.png" alt="Featured image" width="690" height="302">
											</div>
										</div>
									</div>
									<!-- SHOW UPCOMING ITEM END ========================= -->
								</div>
								<div class="qt-item">
									<!-- SHOW UPCOMING ITEM ========================= -->
									<div class="qt-part-archive-item qt-part-archive-item-show qt-negative">
										<div class="qt-item-header">
											<div class="qt-header-top">
												<ul class="qt-tags">
													<li><a href="#">EDM</a></li>
												</ul>
											</div>
											<div class="qt-header-mid qt-vc">
												<div class="qt-vi">
													<h5 class="qt-time">Fridays 04:00pm-07:00pm</h5>
													<h3 class="qt-ellipsis qt-t qt-title">
														<a href="https://linktr.ee/stevenesso" class="qt-text-shadow">The Steven Esso Show</a>
													</h3>
													<p class="qt-small qt-ellipsis">The Best EDM Tracks to Turn Up The Weekend</p>
												</div>
											</div>
											<div class="qt-header-bottom">
												<a href="https://linktr.ee/stevenesso" class="qt-btn qt-btn-primary qt-readmore"><i class="dripicons-headset"></i></a>
											</div>
											<div class="qt-header-bg" data-bgimage="https://i.postimg.cc/Bvq5tXkL/My-project-1.png">
												<img src="https://i.postimg.cc/Bvq5tXkL/My-project-1.png" alt="Featured image" width="690" height="302">
											</div>
										</div>
									</div>
									<!-- SHOW UPCOMING ITEM END ========================= -->
								</div>
							</div>
						</div>
					</div>
					<!-- SLIDESHOW UPCOMING SHOWS END ================================================== -->
				</a>
				</div>
			</div>
			<!-- ======================= HERO POST SECTION ======================= -->
			<!-- <div class="qt-container qt-spacer-m qt-section">
				<h3 class="qt-caption-med"><span>Blog highlights</span></h3>
				<hr class="qt-spacer-s"> -->
				<!-- POST HERO ITEM ========================= -->
				<!-- <div class="qt-part-archive-item qt-part-item-post-hero">
					<div class="qt-item-header">
						<div class="qt-header-top">
							<div class="qt-feedback">
								<a>17<i class="dripicons-message"></i></a><a>34<i class="dripicons-heart"></i></a>
							</div>
						</div>
						<div class="qt-header-mid qt-vc">
							<div class="qt-vi">
								<ul class="qt-tags">
									<li><a href="#">News</a></li>
								</ul>
								<h2 class="qt-title">
							<a href="#read" class="qt-text-shadow">
								Joe Biden becomes the 46th President.
							</a>
						</h2>
								<div class="qt-the-content qt-spacer-s small hide-on-med-and-down ">
									<p class="qt-spacer-s qt-text-shadow">
										WASHINGTON (AP) — Joe Biden swears the oath of office at noon Wednesday to become the 46th president of the United States, taking the helm of a deeply divided nation and inheriting a confluence of crises arguably greater than any faced by his predecessors.
									</p>
									<p><a href="#read" class="qt-btn qt-btn-l qt-btn-primary "><i class="dripicons-align-justify"></i></a></p>
								</div>
							</div>
						</div>
						<div class="qt-header-bg" data-bgimage="imagestemplate/news3.jpg">
							<img src="imagestemplate/news3.jpg" alt="Featured image" width="1170" height="512">
						</div>
					</div>
				</div> -->
				<!-- POST HERO ITEM END ========================= -->
			<!-- </div> -->
			<hr class="qt-spacer-m">
			<!-- ======================= CHART SECTION ======================= -->
			<div class="qt-vertical-padding-l qt-content-primary-dark qt-section">
				<div class="qt-container qt-negative">
					<h3 class="qt-caption-med"><span>Music Chart</span></h3>
					<ul class="collapsible qt-chart-tracklist qt-spacer-m" data-collapsible="accordion">
						<!-- CHART TRACK ========================= -->
						<iframe src="https://embeds.muzooka.com/iheart-charts/H1" scrolling="no" marginheight="0" allowfullscreen="allowfullscreen" allow="autoplay; fullscreen" width="100%" height="4504px" frameborder="0"></iframe>
						<!-- CHART TRACK END ========================= -->
					</ul>
					<p class="aligncenter qt-spacer-m">
						<a href="https://news.iheart.com/featured/charts/top-40/" class="qt-btn qt-btn qt-btn-l qt-btn-primary">View full chart</a>
					</p>
				</div>
				<div class="qt-header-bg" data-bgimage="imagestemplate/footer2.png">
					<img src="imagestemplate/footer2.png" alt="Featured image" width="690" height="302">
				</div>
			</div>
			<!-- ======================= SPONSORS ======================= -->
			<div class="qt-vertical-padding-m qt-sponsors qt-section">
				<h3 class="qt-caption-med"><span>SPONSORS</span></h3>
				<hr class="qt-spacer-m">
				<!-- SLIDESHOW SPONSORS ================================================== -->
				<div class="qt-slickslider-container qt-slickslider-externalarrows qt-slickslider-fullscreen">
					<div class="row">
						<div class="qt-slickslider qt-slickslider-multiple qt-text-shadow " data-slidestoshow="6" data-slidestoshowipad="3" data-variablewidth="false" data-arrows="true" data-dots="false" data-infinite="true" data-centermode="false" data-pauseonhover="true" data-autoplay="true" data-arrowsmobile="false" data-centermodemobile="true" data-dotsmobile="false" data-slidestoshowmobile="1" data-variablewidthmobile="true" data-infinitemobile="false">
							<!-- SLIDESHOW ITEM -->
							<div class="qt-item">
								<a href="https://drivingbigbillhells.com" target="_blank" rel="nofollow" class="qt-sponsor">
									<img src="imagestemplate/big_bill_hells.png" width="235" height="132" alt="sponsor" class="qt-image-responsive">
								</a>
							</div>
							<!-- SLIDESHOW ITEM -->
							<div class="qt-item">
								<a href="https://www.nexusfox.net/" target="_blank" rel="nofollow" class="qt-sponsor">
									<img src="https://www.nexusfox.net/images/nflogo.png" width="235" height="132" alt="sponsor" class="qt-image-responsive">
								</a>
							</div>
							<!-- SLIDESHOW ITEM -->
							<div class="qt-item">
								<a href="https://matra.site" target="_blank" rel="nofollow" class="qt-sponsor">
									<img src="https://matra.site/images/logosvgwhite.png" width="235" height="132" alt="sponsor" class="qt-image-responsive">
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- SLIDESHOW SPONSORS END ================================================== -->
				<hr class="qt-spacer-s">
			</div>
		</div>
		<!-- .qt-main end -->
		<div class="qt-footer qt-footerwidgets">
			<div class="qt-section qt-footer-widgets qt-content-primary-light">
				<div class="qt-container">
					<h2 class="qt-footer-logo"><a href="./" class="brand-logo qt-logo-text"><img src="imagestemplate/WXKJ.png" width="137.1" height="67.8667" style="margin-left: auto; margin-right: auto;"></img></a></h2>
					<div class="qt-widgets qt-widgets-footer qt-negative qt-spacer-m row">
						<div class="col s12 m3 l3">
							<div class="qt-widget">
								<h5 class="qt-caption-small"><span>Contacts</span></h5>
								<div class="qt-widget-contacts">
									<p>
										<i class="qticon-home"></i><a href="https://goo.gl/maps/JDX4to7yTsjx9nuQ6">3003 Grey Fox Ln, Virginia Beach, VA 23456</a>
									</p>
									<p>
										<i class="qticon-home"></i><a href="https://newtoncommunications.org">newtoncommunications.org</a>
									</p>
									<p>
										<i class="qticon-at-sign"></i><a href="mailto:wxkjpublic@newtoncommunications.org">wxkjpublic@newtoncommunications.org</a>
									</p>
									<p>
										<i class="qticon-phone"></i><a href="tel:1-707-854-7736">1-707-8-KISSFM</a>
									</p>
									<p>
										<i class="qticon-power"></i><a href="https://publicfiles.fcc.gov/fm-profile/wxkj">WXKJ-FM Public File</a>
									</p>
								</div>
							</div>
						</div>
						<div class="col s12 m3 l3">
							<div class="qt-widget">
								<h5 class="qt-caption-small"><span>103.7 KISS FM</span></h5>
								<div class="qt-widget-about">
									<p>
										Hampton Roads #1 Hit Music Station
									</p>
								</div>
							</div>
						</div>
						<div class="col s12 m3 l3">
							<div class="qt-widget">
								<h5 class="qt-caption-small"><span>Main links</span></h5>
								<ul class="qt-widget-menu qt-list-chevron">
									<li>
										<a href="https://kissfmva.com">Home page</a>
									</li>
									<li>
										<a href="https://newtoncommunications.org">Newton Communications</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="qt-header-bg" data-bgimage="imagestemplate/footer1.png">
					<img src="imagestemplate/footer1.png" alt="Featured image" width="690" height="302">
				</div>
			</div>
			<div class="qt-footer-bottom qt-content-primary-dark">
				<div class="qt-container">
					<div class="row">
						<div class="col s12 m12 l8">
							Copyright 2022 <a href="https://newtoncommunications.org">Newton Communications Ltd.</a> | All Rights Reserved
								<ul class="qt-menu-footer qt-small qt-list-chevron ">
								<li><a href="https://kissfmva.com">Home</a></li>
							</ul>
						</div>
						<div class="col s12 m12 l4">
							<ul class="qt-menu-social">
								<li class="right"><a href="https://twitter.com/kissfmva"><i class="qticon-twitter"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		</div>
		<!-- PLAYER SIDEBAR ========================= -->
		<div id="channelslist" class="side-nav qt-content-primary qt-right-sidebar">
			<a href="#" class="qt-btn qt-btn-secondary button-playlistswitch-close qt-close-sidebar-right" data-activates="channelslist"><i class="icon dripicons-cross"></i></a>
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

					<script src="http://code.jquery.com/jquery-latest.js"></script>
					
					<script>
						$(document).ready(function(){
							setInterval(function() {
								$("#qtFeedPlayerTrack").load("metadata.php");
							}, 2000);
						});

					</script>
					<div class="qt-playercontainer-data qt-container qt-text-shadow small">
						<h6 class="qt-inline-textdeco">
							<span>Current track</span>
						</h6>
						<div class="qt-t qt-current-track">
							<h5 id="qtFeedPlayerTrack"></h5>
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
				<ul class="qt-content-aside qt-channelslist qt-negative">
					<li class="qt-channel">
						<a href="#!" class="qt-ellipsis" data-title="103.7 KISS FM" data-subtitle="Hampton Roads #1 Hit Music Station" data-background="imagestemplate/photo-squared-500-500.jpg" data-logo="imagestemplate/radio-logo.png" data-playtrack="https://ice1.newtoncommunications.org/radio/wxkjmain.mp3" data-host="ice1.newtoncommunications.org" data-port="80" data-stats_path="" data-played_path="" data-channel="">
							<img src="imagestemplate/radio-logo.png" alt="logo" class="qt-radiologo dripicons-media-play" width="80" height="80">
							<i class="dripicons-media-play"></i> 103.7 KISS FM
						</a>
					</li>
				</ul>
			</div>
			<!-- CHANNELS LIST END ========================= -->
		</div>
		<!-- PLAYER SIDEBAR END ========================= -->   

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
