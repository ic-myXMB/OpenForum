// id for post_text

var id = 'FormControlTextareaPostText';

// start editor

function startEditor(id) {
	tinymce.init({
		selector: "#"+id,
        plugins: 'advlist autolink lists link image preview code fullscreen media code help codesample emoticons',
		toolbar: 'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify numlist bullist | forecolor fontsize fontfamily | emoticons  image media link code codesample| preview fullscreen help',
        mobile: {
          plugins: 'advlist autolink lists link image preview code fullscreen media code help codesample emoticons',
          toolbar: 'undo redo | forecolor emoticons image media link code'
        },
		menubar: false,
		statusbar: false,
		branding: false,
        browser_spellcheck: true,
        contextmenu: false,		
		content_style: ".mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
		height: 200,
	
	// fix for broken required so apply on change

    setup: function (editor) {
        editor.on('change', function (e) {
            editor.save();
        });

        // fix for required hidden styling so apply similar styling

        editor.on('change', () => {
            editor.getContainer().style.boxShadow="0 0 0 .3rem rgba(25, 135, 84, .25)",
            editor.getContainer().style.borderColor="#198754",
            editor.getContainer().style.borderWidth=".1rem"
        });
        editor.on('init', () => {
            editor.getContainer().style.transition="border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out",
            editor.getContainer().style.boxShadow="0 0 0 .3rem rgba(220, 53, 69, .25)",
            editor.getContainer().style.borderColor="#dc3545",
            editor.getContainer().style.borderWidth=".1rem"
        });
        editor.on('focus', () => {
            editor.getContainer().style.boxShadow="0 0 0 .3rem rgba(0, 123, 255, .25)",
            editor.getContainer().style.borderColor="#80BDFF"
            editor.getContainer().style.borderWidth=".1rem"
        });
        editor.on('blur', () => {
            editor.getContainer().style.boxShadow="",
            editor.getContainer().style.borderColor="",
            editor.getContainer().style.borderWidth=""            
        }); 
    }

  }); 

}

// init editor

startEditor(id);
