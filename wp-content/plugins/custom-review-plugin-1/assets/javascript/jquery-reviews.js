//Modal Open Window
function openModal() {
    document.getElementById('myModal').style.display = 'block';
}

// Close the modal
function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}

// Close the modal if the user clicks outside of it
window.onclick = function (event) {
    var modal = document.getElementById('myModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}

$('#tabImage').click(function () {
    $(".grid-container").addClass("gl-image");
    $(".grid-container").removeClass("rl-reply");
    $("#tabImage").addClass("active");
    $("#tabReplies").removeClass("active");
});

$('#tabReplies').click(function () {
    $(".grid-container").addClass("rl-reply");
    $(".grid-container").removeClass("gl-image");
    $("#tabImage").removeClass("active");
    $("#tabReplies").addClass("active");
});

//Country Flag
jQuery(document).ready(function($) {
    $.getJSON('http://ip-api.com/json/?callback=?', function(data) {
        var country_code = data.countryCode.toLowerCase();
        var flag_class = 'flag-icon-' + country_code;

        // Append the flag icon to the specified container
        $('.aurthor-country-flag').html('<i class="flag-icon ' + flag_class + '"></i>');
    });
});



// load-more-reviews.js
jQuery(document).ready(function ($) {
    var page = 2; // Initial page number
    var loading = false;
    var container = $('#comments-container');
    var button = $('#main_button');

    button.on('click', function () {
        if (!loading) {
            loading = true;
            button.find('.btn-text').hide();
            button.find('.loading-spinner').show();

            $.ajax({
                url: ajaxurl,
                type: 'post',
                data: {
                    action: 'load_more_reviews',
                    page: page,
                },
                success: function (response) {
                    if (response) {
                        container.append(response);
                        page++;
                        loading = false;
                        button.find('.loading-spinner').hide();
                        button.find('.btn-text').show();
                    } else {
                        button.prop('disabled', true); // Disable the button if no more reviews
                        button.find('.loading-spinner').hide();
                        button.find('.btn-text').show();
                    }
                },
            });
        }
    });
});

//ASC and DESC Order short
jQuery(document).ready(function ($) {
    $("#order-select").on("change", function () {
        var selectedOrder = $(this).val();

        $.ajax({
            url: ajaxurl,
            type: "GET",
            data: { order: selectedOrder },
            success: function (data) {
                $("#comments-container").html($(data).find("#comments-container").html());
            },
            error: function (error) {
                console.error("Error changing order:", error);
            }
        });
    });
});

//Stars
$(document).ready(function() {
    $('.filled-star, .half-filled-star').css('color', 'gold !important'); // Change 'orange' to the desired color for half-filled stars
    $('.filled-star').css('color', 'gold'); // Change 'gold' to the desired color for filled stars
    $('.empty-star').css('color', 'lightgray'); // Change 'lightgray' to the desired color for empty stars
});



function openModal(commentId) {
    // Make an AJAX request to get the comment data
    $.ajax({
        url: ajaxurl, 
        type: 'POST',
        data: {
            action: 'get_comment_data',
            comment_id: commentId
        },
        success: function(response) {
            // Set modal content with the received data
            $('#modal-comment-content').html(response);

            // Display the modal
            $('#myModal').show();
        },
        error: function(error) {
            console.error('Error fetching comment data', error);
        }
    });
}

var swiper = new Swiper(".mySwiper", {
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });


  $(document).ready(function() {
    var swiper = new Swiper('.mySwiper', {
        // Your Swiper configuration options
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        on: {
            slideChange: function () {
                // Get the index of the active slide
                var activeIndex = swiper.realIndex;

                // Remove the 'active' class from all thumbnails
                $('.image-thumbnail').removeClass('active');

                // Add the 'active' class to the corresponding thumbnail
                $('.image-thumbnail').eq(activeIndex).addClass('active');
            }
        }
    });

    // Handle thumbnail click event
    $('.image-thumbnail').on('click', function() {
        // Get the index of the clicked thumbnail
        var thumbIndex = $(this).index();

        // Update the Swiper to the clicked thumbnail
        swiper.slideTo(thumbIndex);
    });
});