/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbar = [
	{ name: 'all', items: [ 'Source', '-', 'Bold', 'Italic', 'Underline', '-', 'JustifyRight', 'JustifyCenter', 'JustifyLeft','-', 'Image', 'Link', 'Unlink', 'FontSize', 'FontColor', 'Smiley'] },
	{ name: 'insert', items: ['Smiley'] },
	{ name: 'insert', items: ['font'] },
	{ name: 'others', items: [ '-' ] }
];
	
	
	// Remove some buttons, provided by the standard plugins, which we don't
	// need to have in the Standard(s) toolbar.
	config.removeButtons = 'Subscript,Superscript';

	// Se the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';
	
	 config.extraPlugins = 'justify', 'Smiley', 'colorbutton'; 

	// Make dialogs simpler.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
