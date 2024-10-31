(function() {
    tinymce.create('tinymce.plugins.screencast', {
        init : function(ed, url) {
			var t = this;
			t.editor = ed;
			// Register commands
			ed.addCommand('sccomVideo', t._embeddedvideo, t);	
            ed.addButton('screencast', {
                title : 'Add a Screencast.com Video',
				cmd : 'sccomVideo',
                image : url+'/sc-com.png',
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
