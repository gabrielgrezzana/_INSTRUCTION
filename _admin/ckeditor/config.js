/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	config.language = 'en';
	// config.uiColor = '#AADC6E';
	config.height = 500;        // 500 pixels high.
	config.height = 'calc(100vh - 400px)';     // CSS unit (em).
	config.editorplaceholder = 'Start typing here...';
	config.extraPlugins = 'imageresize,simage,uploadimage,uploadwidget,image2,codemirror,pre,collapsibleItem';
	config.imageUploadURL = '../_admin/upload.img.php';
	config.image2_alignClasses = [ 'image-left', 'image-center', 'image-right' ];
	config.image2_captionedClass = 'image-captioned';
	// config.contentsCss = [ '../assets/css/bootstrap.css', '../assets/css/style.css', './ckeditor/styles/override.css' ];
	config.codemirror = {
		theme: 'cobalt',
	}
};
