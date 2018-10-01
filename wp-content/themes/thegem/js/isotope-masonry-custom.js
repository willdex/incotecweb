/*!
 * Masonry layout mode
 * sub-classes Masonry
 * http://masonry.desandro.com
 */

( function( window, factory ) {
  'use strict';
  // universal module definition
  if ( typeof define == 'function' && define.amd ) {
    // AMD
    define( [
        '../layout-mode',
        'masonry/masonry'
      ],
      factory );
  } else if ( typeof exports == 'object' ) {
    // CommonJS
    module.exports = factory(
      require('../layout-mode'),
      require('masonry-layout')
    );
  } else {
    // browser global
    factory(
      window.Isotope.LayoutMode,
      window.Masonry
    );
  }

}( window, function factory( LayoutMode, Masonry ) {
'use strict';

// -------------------------- helpers -------------------------- //

// extend objects
function extend( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
}

// -------------------------- masonryDefinition -------------------------- //

  // create an Outlayer layout class
  var MasonryMode = LayoutMode.create('masonry-custom');

  // save on to these methods
  var _getElementOffset = MasonryMode.prototype._getElementOffset;
  var layout = MasonryMode.prototype.layout;
  var _getMeasurement = MasonryMode.prototype._getMeasurement;

  // sub-class Masonry
  extend( MasonryMode.prototype, Masonry.prototype );

  // set back, as it was overwritten by Masonry
  MasonryMode.prototype._getElementOffset = _getElementOffset;
  MasonryMode.prototype.layout = layout;
  MasonryMode.prototype._getMeasurement = _getMeasurement;

  var measureColumns = MasonryMode.prototype.measureColumns;
  MasonryMode.prototype.measureColumns = function() {
    // set items, used if measuring first item
    this.items = this.isotope.filteredItems;
    measureColumns.call( this );
  };

  // HACK copy over isOriginLeft/Top options
  var _manageStamp = MasonryMode.prototype._manageStamp;
  MasonryMode.prototype._manageStamp = function() {
    this.options.isOriginLeft = this.isotope.options.isOriginLeft;
    this.options.isOriginTop = this.isotope.options.isOriginTop;
    _manageStamp.apply( this, arguments );
  };

  function getStyle(elem) {
      return window.getComputedStyle ? getComputedStyle(elem, "") : elem.currentStyle;
  }

  MasonryMode.prototype.fix_images_height = function() {
      var self = this;
      var $ = jQuery;
      var container = this.options.isFitWidth ? this.element.parentNode : this.element;
      var $set = $(container);

      var max_heigth = 0;
      var padding = parseInt($(self.isotope.options.itemSelector, $set).not('.double-item').first().css('padding-top'));

      var caption = 0;
      if (self.isotope.options.itemSelector == '.portfolio-item') {
          if ($(self.isotope.options.itemSelector, $set).not('.double-item').first().find('.wrap > .caption').is(':visible')) {
              caption = parseInt($(self.isotope.options.itemSelector, $set).not('.double-item').first().find('.wrap > .caption').outerHeight());
          }
      }

      var fix_caption = false;
      $(self.isotope.options.itemSelector, $set).not('.double-item').each(function() {
          var height = parseFloat(getStyle($(self.isotope.options.itemImageWrapperSelector, this)[0]).height);
          var diff = height - parseInt(height);

          if ( diff < 0.5 ) {
              height = parseInt(height);
          }

          if ( (height - parseInt(height)) > 0.5 ) {
              height = parseInt(height + 0.5);
              fix_caption = true;
          }

          if (height > max_heigth) {
              max_heigth = height;
          }
      });

      if (caption > 0 && fix_caption) {
          caption -= 1;
      }

      $(self.isotope.options.itemSelector + '.double-item-horizontal ' + self.isotope.options.itemImageWrapperSelector + ', ' + self.isotope.options.itemSelector + '.double-item-vertical ' + self.isotope.options.itemImageWrapperSelector, $set).css('height', '');

      $(self.isotope.options.itemSelector + '.double-item-horizontal', $set).each(function() {
          var height = $(self.isotope.options.itemImageWrapperSelector, this).height();
          if (height > max_heigth) {
              $(self.isotope.options.itemImageWrapperSelector, this).height(max_heigth);
          }
      });

      $(self.isotope.options.itemSelector + '.double-item-vertical', $set).each(function() {
          var height = $(self.isotope.options.itemImageWrapperSelector, this).height();
          var calc_height = 2 * (max_heigth + padding) + caption;
          if (height > calc_height) {
              $(self.isotope.options.itemImageWrapperSelector, this).height(calc_height);
          }
      });
  }

  var _resetLayout = MasonryMode.prototype._resetLayout;
  MasonryMode.prototype._resetLayout = function() {
      if (this.isotope.options.fixHeightDoubleItems) {
          this.fix_images_height();
      }

      _resetLayout.apply( this, arguments );
  };

  return MasonryMode;

}));
