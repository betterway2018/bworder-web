
Skip to content

    All gists
    GitHub

Instantly share code, notes, and snippets.

72

    25

@nateps nateps/gist:1172490
Created 5 years ago
Code
Revisions 1
Stars 72
Forks 25
Hide the address bar in a fullscreen iPhone or Android web app
gistfile1.html
<!DOCTYPE html>
<meta charset=utf-8>
<meta name=viewport content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name=apple-mobile-web-app-capable content=yes>
<meta name=apple-mobile-web-app-status-bar-style content=black>
<title>Test fullscreen</title>
<style>
html, body {
  margin: 0;
  padding: 0;
}
#page {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  border: 8px solid #f00;
}
</style>

<div id=page></div>

<script>
var page = document.getElementById('page'),
    ua = navigator.userAgent,
    iphone = ~ua.indexOf('iPhone') || ~ua.indexOf('iPod'),
    ipad = ~ua.indexOf('iPad'),
    ios = iphone || ipad,
    // Detect if this is running as a fullscreen app from the homescreen
    fullscreen = window.navigator.standalone,
    android = ~ua.indexOf('Android'),
    lastWidth = 0;
if (android) {
  // Android's browser adds the scroll position to the innerHeight, just to
  // make this really fucking difficult. Thus, once we are scrolled, the
  // page height value needs to be corrected in case the page is loaded
  // when already scrolled down. The pageYOffset is of no use, since it always
  // returns 0 while the address bar is displayed.
  window.onscroll = function() {
    page.style.height = window.innerHeight + 'px'
  } 
}
var setupScroll = window.onload = function() {
  // Start out by adding the height of the location bar to the width, so that
  // we can scroll past it
  if (ios) {
    // iOS reliably returns the innerWindow size for documentElement.clientHeight
    // but window.innerHeight is sometimes the wrong value after rotating
    // the orientation
    var height = document.documentElement.clientHeight;
    // Only add extra padding to the height on iphone / ipod, since the ipad
    // browser doesn't scroll off the location bar.
    if (iphone && !fullscreen) height += 60;
    page.style.height = height + 'px';
  } else if (android) {
    // The stock Android browser has a location bar height of 56 pixels, but
    // this very likely could be broken in other Android browsers.
    page.style.height = (window.innerHeight + 56) + 'px'
  }
  // Scroll after a timeout, since iOS will scroll to the top of the page
  // after it fires the onload event
  setTimeout(scrollTo, 0, 0, 1);
};
(window.onresize = function() {
  var pageWidth = page.offsetWidth;
  // Android doesn't support orientation change, so check for when the width
  // changes to figure out when the orientation changes
  if (lastWidth == pageWidth) return;
  lastWidth = pageWidth;
  setupScroll();
})();
</script>
@wndr
wndr commented on 5 Jan 2012

Use the following to combine full-screen with vertical scrolling of one part of the page. Requires iscroll-lite.js in the subdir js.

<!DOCTYPE html>
<meta charset=utf-8>
<meta name=viewport content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name=apple-mobile-web-app-capable content=yes>
<meta name=apple-mobile-web-app-status-bar-style content=black>
<title>Test fullscreen + vertical scroll</title>
<style>
html, body {
  margin: 0;
  padding: 0;
}
#page {
  position: absolute;
  width: 100%;
  height: 100%;
}
#header {
    position:absolute; z-index:2;
    top:0; left:0;
    width:100%;
    height:45px;
    background-color:#333;
    font-size:20px;
    text-align:center;
}
#wrapper {
    position:absolute; z-index:1;
    top:45px; bottom:0px; left:0;
    width:100%;
    background:#fff;
    overflow:auto;
}

#scroller {
    position:absolute; z-index:1;
/*  -webkit-touch-callout:none;*/
    -webkit-tap-highlight-color:rgba(0,0,0,0);
    width:100%;
    padding:0;
}
</style>

<div id="page">

<div id="header"></div>

    <div id="wrapper">

        <div id="scroller">

            a<br>b<br>c<br>d<br>e<br>f<br>a<br>b<br>c<br>d<br>e<br>f<br>a<br>b<br>c<br>d<br>e<br>f<br>a<br>b<br>c<br>d<br>e<br>f<br>a<br>b<br>c<br>d<br>e<br>f<br>a<br>b<br>c<br>d<br>e<br>f<br>        </div>
    </div>

</div>

<script type="text/javascript" src="js/iscroll-lite.js"></script>


<script>

var myScroll;
function loaded() {
    myScroll = new iScroll('wrapper');
}

document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);

</script>


<script>
var page = document.getElementById('page'),
    ua = navigator.userAgent,
    iphone = ~ua.indexOf('iPhone') || ~ua.indexOf('iPod'),
    ipad = ~ua.indexOf('iPad'),
    ios = iphone || ipad,
    // Detect if this is running as a fullscreen app from the homescreen
    fullscreen = window.navigator.standalone,
    android = ~ua.indexOf('Android'),
    lastWidth = 0;

if (android) {
  // Android's browser adds the scroll position to the innerHeight, just to
  // make this really fucking difficult. Thus, once we are scrolled, the
  // page height value needs to be corrected in case the page is loaded
  // when already scrolled down. The pageYOffset is of no use, since it always
  // returns 0 while the address bar is displayed.
  window.onscroll = function() {
    page.style.height = window.innerHeight + 'px'
  } 
}
var setupScroll = window.onload = function() {
  // Start out by adding the height of the location bar to the width, so that
  // we can scroll past it
  if (ios) {
    // iOS reliably returns the innerWindow size for documentElement.clientHeight
    // but window.innerHeight is sometimes the wrong value after rotating
    // the orientation
    var height = document.documentElement.clientHeight;
    // Only add extra padding to the height on iphone / ipod, since the ipad
    // browser doesn't scroll off the location bar.
    if (iphone && !fullscreen) height += 60;
    page.style.height = height + 'px';
  } else if (android) {
    // The stock Android browser has a location bar height of 56 pixels, but
    // this very likely could be broken in other Android browsers.
    page.style.height = (window.innerHeight + 56) + 'px'
  }
  // Scroll after a timeout, since iOS will scroll to the top of the page
  // after it fires the onload event
  setTimeout(scrollTo, 0, 0, 1);
};
(window.onresize = function() {
  var pageWidth = page.offsetWidth;
  // Android doesn't support orientation change, so check for when the width
  // changes to figure out when the orientation changes
  if (lastWidth == pageWidth) return;
  lastWidth = pageWidth;
  setupScroll();
})();
</script>

@onigetoc
onigetoc commented on 17 Mar 2012

Good, you find a solution who work great for Iphone.

But i had strange behavior with all script i tested for Android.

For Android, i got problems, sometime it work, sometime not. and i user a navigation with history, when i do ajax call with history, i.e. like #home or #section, i lost the fullscreen mode (the adress bar is showing). if i return to my first page like #home, it will return full screen.

I tryed something like that for Android but with the exact same problem

function hideAddressBar()
{
if(!window.location.hash)
{
if(document.height < window.outerHeight)
{
document.body.style.height = (window.outerHeight + 50) + 'px';
}
setTimeout( function(){ window.scrollTo(0, 1); }, 100 );
}
}
window.addEventListener("load", function(){ if(!window.pageYOffset){ hideAddressBar(); } } );
window.addEventListener("orientationchange", hideAddressBar );
@onigetoc
onigetoc commented on 20 Mar 2012

For ajax history navigation, i found something who work, but adress bar show and hide at each hash change.
Adding this to your current script at the end but need jQuery or Zepto

$(window).bind('hashchange', function() {
setupScroll();
});
@maustyle
maustyle commented on 18 Jun 2012

I have an error showing up, says Cannot read property 'offsetWidth' of null?
@jonwingfield
jonwingfield commented on 29 Oct 2012

@maustyle Just freaking LOL at people copy-pasting without thinking, then asking questions without thinking.
@MrSlayer
MrSlayer commented on 5 Mar 2013

I have a project where this came in very handy, thanks. In my project, I needed to set have a fixed viewport width, which wouldn't allow me to use the "initial-scale" and "maximum-scale" parameters in the meta tag. Because the scale was not 100%, the address bar in iOS would only scroll up halfway, due to the calculation using document.documentElement.clientHeight. I was able to remedy this by using screen.height instead.
@vsok
vsok commented on 1 Apr 2013

For Android, i got problems, sometime it work, sometime not. i have created website not refresh page just show and hide element. Iphone it working fine except Android
@goinnn
goinnn commented on 8 Apr 2013

This does not work in Google Chrome to Android.
@yckart
yckart commented on 20 May 2013

I've refactored this a bit: https://gist.github.com/yckart/5609969
@wtcwerner
wtcwerner commented on 13 Jan

Hi guys i am using your Code in my 360 panorama but on the iphone 6 and android large screens it brakes @ the bottom of the screen
Here is a Example of a fullscreen 360 http://webbox.mobilemall.nl

i can only edit the HTML Index file
to join this conversation on GitHub. Already have an account? Sign in to comment

    Contact GitHub API Training Shop Blog About 

    © 2016 GitHub, Inc. Terms Privacy Security Status Help 

