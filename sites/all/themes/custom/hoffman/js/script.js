/**
 * @file
 * A JavaScript file for the theme.
 *
 * In order for this JavaScript to be loaded on pages, see the instructions in
 * the README.txt next to this file.
 */

// JavaScript should be made compatible with libraries other than jQuery by
// wrapping it with an "anonymous closure". See:
// - https://drupal.org/node/1446420
// - http://www.adequatelygood.com/2010/3/JavaScript-Module-Pattern-In-Depth
(function ($, Drupal, window, document, undefined) {


// To understand behaviors, see https://drupal.org/node/756722#behaviors
Drupal.behaviors.my_custom_behavior = {
  attach: function(context, settings) {

    // Place your code here.

  }
};
function setBackgroundPos() {
	var sampleLi = $("#block-system-main-menu .menu li.first");
	var backgroundPos = sampleLi.offset().left + sampleLi.width();
	$("body").css({"background-position-x":backgroundPos + "px"});
}
$(function() {
	setBackgroundPos();
});//document.ready

$(window).resize(setBackgroundPos);


})(jQuery, Drupal, this, this.document);
