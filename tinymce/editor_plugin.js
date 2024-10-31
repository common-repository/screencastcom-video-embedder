(function() {
    tinymce.create('tinymce.plugins.screencast', {
        init : function(ed, url) {
			// Register commands
			// ed.addCommand('sccomVideo', t._embeddedvideo, t);	
            ed.addButton('screencast', {
                title : 'Add a Screencast.com Video',
                image : url+'/sc-com.png',
				onclick : function() {  
	                ed.selection.setContent('[screencast url="" width="" height=""' + ed.selection.getContent() + ']');  

                }
            });
        },

		getInfo : function() {
			return {
				longname : "Screencast Video Embedder",
				author : "TechSmith Corporation",
				authorurl : 'http://screencast.com',
				inforurl : 'http://screencast.com',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		},
		
		// Private Method
		_embeddedvideo : function() {
			embeddedvideo_insert();
			return true;
		}
    });
	// Register plugin
    tinymce.PluginManager.add('screencast', tinymce.plugins.screencast);
})();
