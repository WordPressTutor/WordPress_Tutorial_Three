jQuery(document).ready(function($) {
    var currentPage = 1;
    var maxPages = custom_test_vars.max_pages;
    $('#see-more-btn').on('click', function() {

        if (currentPage < maxPages) {
            currentPage++;
            $.ajax({
                url: custom_test_vars.ajaxurl,
                type: 'POST',
                data: {
                    action: 'load_more_posts',
                    page: currentPage
                },
                success: function(response) {
                    $('.projcard-container').append(response);
                },
                error: function(error) {
                }
            });
        } else {
            console.log("Max pages reached. No more posts to load."); // Debugging line
        }
    });
});
