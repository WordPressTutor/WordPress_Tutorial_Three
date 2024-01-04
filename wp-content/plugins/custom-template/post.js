jQuery(document).ready(function(){
    // console.log('Post JS Loaded');

    jQuery('#submit').click(function(e){
        e.preventDefault();
        // console.log('Submit button clicked');
        var postData = {
            title: jQuery('#title').val(),
            content: jQuery('#content').val(),
            category: jQuery('#post-category').val(), // Make sure to use the correct ID
            author: jQuery('#author').val(),
            location: jQuery('#location').val(),
            external_link: jQuery('#external_link').val(),
        };
      
        
        jQuery.ajax({
            url:custom_post_data.ajax_url,
            type: 'post',
            data: {
                action: 'add_post_ajax',
                post_data: postData,
            },
            success: function(response){
                console.log(response);
                exit();
                if(response.success){
                    alert('Post inserted successfully');
                    loadpost();
                    jQuery('#post-form')[0].reset();
                }else{
                    alert('Post not inserted');
                }
            },

        });


    })
})