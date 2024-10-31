function embeddedvideo_insert() {
	if(window.tinyMCE) {
		var postnumber = document.getElementById('post_ID').value;
		
		tinyMCE.activeEditor.windowManager.open( {
			url : tinyMCE.activeEditor.documentBaseURI + '../../../wp-content/plugins/screencastcom-video-embedder/sccomvideo.php?post='+postnumber,
			width : 440,
			height : 220,
			resizable : 'no',
			scrollbars : 'no',
			inline : 'yes'
	       }, { /* Custom junk could go here.. */ }
		);
		return true;
	} else {
		window.alert('This function is only available in the Visual Mode');
		return true;
	}
}

function sc_insertVideoCode( scUrl, scWidth, scHeight) {
	var text = (scUrl == '') ? ('[screencast' 'url=' + scUrl + '' + 'width=' + scWidth + ' ' + 'height=' + scHeight + ']');
	if(window.tinyMCE) {
		var ed = tinyMCE.activeEditor;
		ed.execCommand('mceInsertContent', false, '<p>' + text + '</p>');
		ed.execCommand('mceCleanup');
	}
	return true;
}

function sc_checkData(formObj) {
	if (formObj.scUrl.value != '') sc_insertCode(formObj);
}

function sc_insertCode(formObj) {
	var scUrl = formObj.scUrl.value;
	var scWidth = formObj.scWidth.value;
	var scHeight = formObj.scHeight.value;
	
	sc_insertVideoCode(scUrl, scWidth, scHeight);
	tinyMCEPopup.close();
}

function init() {
	tinyMCEPopup.resizeToInnerSize();
}