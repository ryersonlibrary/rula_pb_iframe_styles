jQuery(document).ready( function($){
  console.log("HELLO");
  var mediaUploader;
  
  $('#rula_pb_iframe-upload_watermark_button').on('click',function(e) {
    e.preventDefault();
    
    if( mediaUploader ){
      mediaUploader.open();
      return;
    }
    
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Select a Picture',
      button: {
        text: 'Select Picture'
      },
      multiple: false
    });
    
    mediaUploader.on('select', function(){
      attachment = mediaUploader.state().get('selection').first().toJSON();
      $('#rula_pb_iframe-watermark').val(attachment.url);
      $('#rula_pb_iframe-watermark_preview').css('background-image','url(' + attachment.url + ')');
    });
    
    mediaUploader.open();
    
  });
  
});