/*! Parts from jQuery UI - v1.10.4 - 2014-03-02
* http://jqueryui.com
* Includes: 
* Copyright 2014 jQuery Foundation and other contributors; Licensed MIT */

(function( $, undefined ) {

var uuid = 0,
runiqueId = /^ui-id-\d+$/;

// plugins
$.fn.extend({
	uniqueId: function() {
		return this.each(function() {
			if ( !this.id ) {
				this.id = "ui-id-" + (++uuid);
			}
		});
	},

	removeUniqueId: function() {
		return this.each(function() {
			if ( runiqueId.test( this.id ) ) {
				$( this ).removeAttr( "id" );
			}
		});
	}
});
});