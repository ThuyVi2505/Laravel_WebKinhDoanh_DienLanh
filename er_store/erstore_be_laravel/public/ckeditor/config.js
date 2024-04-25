/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function (config) {
	// Define changes to default configuration here. For example:
	config.language = 'en';
	config.uiColor = '#AEAFAC';
	
	config.removePlugins = '\
		save,\
		print,\
		newpage,\
		exportpdf,\
		cut,\
		coppy,\
		table,\
		tableselection,\
		tabletools,\
		smiley,\
		pastefromgdocs,\
		pastefromlibreoffice,\
		pastefromword,\
		pastetext,\
		showblocks,\
		about,\
		div,\
		specialchar,\
		iframe,\
		anchor,\
		forms,\
		language,\
		link,\
		image,\
		showborders,\
		stylescombo,\
		pagebreak,\
		scayt,\
		floatingspace,\
	';
};
