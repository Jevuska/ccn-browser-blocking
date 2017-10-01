<?php
/*
Plugin Name: CCNINJA Browser Blocking
Plugin URI:  https://www.jevuska.com/2017/09/30/mengalihkan-halaman-web-uc-browser/
Description: Simple browser blocking and redirect to another one for your WordPress, i.e UC Browser to Chrome. No setup needed, install and you are ready to go.
Version: 1.0.0
Author: Jevuska
Author URI: https://www.jevuska.com
License: GPLv2
Domain Path: /languages
Text Domain: bbccn

/*
 * Redirect browser visitors, i.e UC Browser to Chrome browser
 * Change user agent "ubrowser|ucbrowser" to another one, separate by "|"
 * Use filter `args_variable_js_bbccn` to change value of js variable, i. e user-agent, text and url redirection
 * 
 * @package CCNINJA Browser Blocking
 * @category Core
 * @author Jevuska
 * @version 1.0
 * @since 1.0
 *
 */

add_action( 'plugins_loaded', function() {
	load_plugin_textdomain( 'bbccn', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
} );

add_action( 'wp_footer', function() {
	//set user agent i.e 'ubrowser|ucbrowser'
	//argument variable in js
	$args = [
		'text'      => [
			'button' => __( 'Download Now', 'bbccn' ),
			'title'  => __( 'This page is best viewed with Chrome browser', 'bbccn' )
		],
		'url'       => [
			'icon'    => '//lh3.googleusercontent.com/nYhPnY2I-e9rpqnid9u9aAODz4C04OycEGxqHG5vxFnA35OGmLMrrUmhM9eaHKJ7liB-=w20',
			'mobile'  => 'googlechrome://navigate?url=',
			'android' => '//play.google.com/store/apps/details?id=com.android.chrome',
			'ios'     => '//itunes.apple.com/us/app/chrome/id535886823',
			'desktop' => '//www.google.com/chrome/'
		],
		'userAgent' => 'ubrowser|ucbrowser'
	];
	
	//add filter to change value of js variables
	$args = apply_filters( 'args_variable_js_bbccn', $args );
	
	printf( "<script type='text/javascript'>\n/* <![CDATA[ */\nvar jvL10n=%s\n/* ]]> */\n</script>\n", json_encode( $args ) );
	?><script type='text/javascript'>var checkUA=function(){var d=new RegExp(jvL10n.userAgent),a=(navigator.userAgent||navigator.vendor||window.opera).toLowerCase(),e=jvL10n.url.mobile+window.location.href;d.test(a)&&(/android/i.test(a)&&(window.location.href=e),setTimeout(function(){var f=document.createElement("div"),b=f.cloneNode(!0),g=document.createElement("h3"),c=document.createElement("button"),d=document.createTextNode(jvL10n.text.title),e=document.createTextNode(jvL10n.text.button);g.appendChild(d);c.setAttribute("style","background:#800000 url("+jvL10n.url.icon+") left 5% center no-repeat;color:#ffffff;padding-left:33px");c.appendChild(e);b.setAttribute("style","background:#ffffff;opacity:0.8;width:50%;border:1px solid #efefef;padding:50px;position:fixed;z-index:1002;top:50%;left:50%;transform: translate(-50%, -50%);text-align:center");f.setAttribute("style","opacity:0.85;background:#000000;width:100%;height:100%;position:fixed;z-index:99;top:0");b.appendChild(g);b.appendChild(c);document.documentElement.style.overflow="hidden";document.body.appendChild(f);document.body.appendChild(b);var h=/android/i.test(a)?jvL10n.url.android:/ipad|iphone|ipod/.test(a)&&!window.MSStream?jvL10n.url.ios:jvL10n.url.desktop;c.addEventListener("click",function(){window.open(h)},!0)},2500))};document.addEventListener("DOMContentLoaded",checkUA,!0);</script><?php echo "\n";
}, 1000 );