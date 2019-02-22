jQuery(document).ready( function($){

  var mediaUploader;
  
  $('#rula_pb_iframe-select_watermark_button').on('click',function(e) {
    e.preventDefault();
    
    if( mediaUploader ){
      mediaUploader.open();
      return;
    }
    
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Select an image',
      button: {
        text: 'Select image'
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