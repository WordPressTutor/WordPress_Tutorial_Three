<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Document</title>
</head>

<body>
    <!----------------------------------------------------------------Upper Section------------------------------------------------->
    <div class="review-section">
        <?php
        global $product;
        if (is_product() && $product->get_rating_count() >= 1) {
            $average_rating = $product->get_average_rating();
            $total_ratings = $product->get_rating_count();
        ?>
            <div class="review-rating-box">
                <div class="review-container-row">
                    <div class="average-rating">
                        <span class="review-label">Average rating</span>
                        <span class="review-number"><?php echo $average_rating; ?></span>
                        <div class="review-average-wrap">
                            <div class="review-icon">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    $filled_star = $i <= $average_rating ? '★' : '☆';
                                    $percentage = ($product->get_rating_count($i) / $total_ratings) * 100;
                                ?>
                                    <span class="star-' . $filled_star . '"><?php echo $filled_star; ?></span>
                                <?php } ?>
                            </div>
                            <div class="total-review-number">
                                <?php echo $total_ratings; ?>
                            </div>
                        </div>
                    </div>
                    <div class="vertical-line"></div>
                    <div class="review-percents">
                        <?php
                        for ($i = 5; $i >= 1; $i--) {

                            $percentage = ($product->get_rating_count($i) / $total_ratings) * 100;
                        ?>
                            <div class="prg-percent-style1 star-and-number">
                                <div class="percent-row">
                                    <span class="prg-star-icon1"><span class="prg---star--s1 active">
                                            <strong class="prg-axrFhx"><?php echo $i . '★'; ?></strong>
                                            <span class="prg-star-wpp">
                                                <!-- <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="star" class="svg-inline--fa fa-star fa-w-18" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                <path fill="currentColor" d="M259.3 17.8L194 150.2 47.9 171.5c-26.2 3.8-36.7 36.1-17.7 54.6l105.7 103-25 145.5c-4.5 26.3 23.2 46 46.4 33.7L288 439.6l130.7 68.7c23.2 12.2 50.9-7.4 46.4-33.7l-25-145.5 105.7-103c19-18.5 8.5-50.8-17.7-54.6L382 150.2 316.7 17.8c-11.7-23.6-45.6-23.9-57.4 0z">
                                                </path>
                                            </svg> -->

                                            </span>
                                        </span>
                                    </span>
                                    <div role="progressbar" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100" aria-label="<?php echo $percentage; ?>%" class="prg-progress prg-progress--line">
                                        <div class="prg-progress-bar">
                                            <div class="prg-progress-bar__outer">
                                                <div class="prg-progress-bar__inner" style="width: <?php echo $percentage; ?>%; background-color: rgb(8, 8, 8);"><!----></div>
                                            </div>
                                        </div>
                                        <div class="prg-progress__text"><?php echo (number_format($percentage, 0)); ?>% </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="add-review-box">
                        <!--<p class='motivation-text'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum voluptatum nobis fuga vel exercitationem corrupti quidem? Alias ipsa quidem ullam?</p>-->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Write A Review
                        </button>
                    </div>
                </div>
            </div><br>
            <div class="a2-showing"><span>Showing <?php echo $total_ratings . '/' . $total_ratings ?> reviews</span></div>
            <div class="sorting-dropdown">
                <label for="order">Sort Order:</label>
                <select name="order" id="order">
                    <option value="DESC" <?php selected('DESC', $_GET['order']); ?>>Descending</option>
                    <option value="ASC" <?php selected('ASC', $_GET['order']); ?>>Ascending</option>
                </select>
            </div>
        <?php } else {
        ?>
            <div class="review-rating-box">
                <div class="review-container-row">
                    <div class="average-rating">
                        <span class="review-label">Average rating</span>
                        <span class="review-number"><?php echo '0.00'; ?></span>
                        <div class="review-average-wrap">
                            <div class="review-icon">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    $filled_star = '☆';
                                    // $percentage = '0';
                                ?>
                                    <span class="star-' . $filled_star . '"><?php echo $filled_star; ?></span>
                                <?php } ?>
                            </div>
                            <div class="total-review-number">
                                <?php echo '0'; ?>
                            </div>
                        </div>
                    </div>
                    <div class="vertical-line"></div>
                    <div class="review-percents">
                        <?php
                        for ($i = 5; $i >= 1; $i--) {

                            $percentage = "0";
                        ?>
                            <div class="prg-percent-style1 star-and-number">
                                <div class="percent-row">
                                    <span class="prg-star-icon1"><span class="prg---star--s1 active">
                                            <strong class="prg-axrFhx"><?php echo $i . '★'; ?></strong>
                                            <span class="prg-star-wpp">

                                            </span>
                                        </span>
                                    </span>
                                    <div role="progressbar" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100" aria-label="<?php echo $percentage; ?>%" class="prg-progress prg-progress--line">
                                        <div class="prg-progress-bar">
                                            <div class="prg-progress-bar__outer">
                                                <div class="prg-progress-bar__inner" style="width: <?php echo $percentage; ?>%; background-color: rgb(8, 8, 8);"><!----></div>
                                            </div>
                                        </div>
                                        <div class="prg-progress__text"><?php echo $percentage; ?>% </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="add-review-box">
                        <p class='motivation-text'>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum voluptatum nobis fuga vel exercitationem corrupti quidem? Alias ipsa quidem ullam?</p>
                        <!-- <a class="write-review-btn" href="#">Write A Review</a> -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Write A Review
                        </button>
                    </div>
                </div>
            </div>
            <div class="a2-showing"><span>Showing <?php echo $total_ratings . '/' . $total_ratings ?> reviews</span></div>
            <div class="sorting-dropdown">
                <label for="order">Sort Order:</label>
                <select name="order" id="order">
                    <option value="DESC">Descending</option>
                    <option value="ASC">Ascending</option>
                </select>
            </div>
        <?php
        }
        ?>
        <!-------------------------------------------------------------------Reviews Form Modal--------------------------------------------------------------------------->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Write a review</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="review-form-wrapper">
                            <form method="post" enctype="multipart/form-data">

                                <div class="review-form-section">
                                    <div class="review-form-label">
                                        <label>Rating</label>
                                    </div>
                                    <div class="review-form-input-box">
                                        <div class="rating">
                                            <input type="radio" id="star5" name="rating" value="5" />
                                            <label class="star" for="star5" title="Awesome" aria-hidden="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"></path>
                                                </svg>
                                            </label>
                                            <input type="radio" id="star4" name="rating" value="4" />
                                            <label class="star" for="star4" title="Great" aria-hidden="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"></path>
                                                </svg>
                                            </label>
                                            <input type="radio" id="star3" name="rating" value="3" />
                                            <label class="star" for="star3" title="Very good" aria-hidden="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"></path>
                                                </svg>
                                            </label>
                                            <input type="radio" id="star2" name="rating" value="2" />
                                            <label class="star" for="star2" title="Good" aria-hidden="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"></path>
                                                </svg>
                                            </label>
                                            <input type="radio" id="star1" name="rating" value="1" />
                                            <label class="star" for="star1" title="Bad" aria-hidden="true">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"></path>
                                                </svg>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-form-section">
                                    <div class="review-form-label">
                                        <label>Author</label>
                                    </div>
                                    <div class="review-form-input-box">
                                        <input class="review-form-input" name="author" type="text" placeholder="Author" />
                                    </div>
                                </div>
                                <div class="review-form-section">
                                    <div class="review-form-label">
                                        <label>Email</label>
                                    </div>
                                    <div class="review-form-input-box">
                                        <input class="review-form-input" name="email" type="email" placeholder="Author" />
                                    </div>
                                </div>
                                <div class="review-form-section">
                                    <div class="review-form-label">
                                        <label>Content</label>
                                    </div>
                                    <div class="review-form-input-box">
                                        <textarea class="review-form-input" rows="5" placeholder="Enter your comment" name="content"></textarea>
                                    </div>
                                </div>
                                <div class="review-form-section">
                                    <div class="review-form-label">
                                        <label>Media</label>
                                    </div>
                                    <div class="review-form-input-box">
                                        <div class="upload-section-wrapper">
                                            <div class="upload-section">
                                                <input type="file" id="file-input" name="file-input[]" class="upload" multiple="multiple"></input>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M9.82843 5L7.82843 7H4V19H20V7H16.1716L14.1716 5H9.82843ZM9 3H15L17 5H21C21.5523 5 22 5.44772 22 6V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V6C2 5.44772 2.44772 5 3 5H7L9 3ZM12 18C8.96243 18 6.5 15.5376 6.5 12.5C6.5 9.46243 8.96243 7 12 7C15.0376 7 17.5 9.46243 17.5 12.5C17.5 15.5376 15.0376 18 12 18ZM12 16C13.933 16 15.5 14.433 15.5 12.5C15.5 10.567 13.933 9 12 9C10.067 9 8.5 10.567 8.5 12.5C8.5 14.433 10.067 16 12 16Z"></path>
                                                </svg>
                                            </div>
                                            <div class="upload-section-image" style="display:flex;">

                                            </div>
                                            <div class="upload-section">
                                                <input type="file" id="vid" name="vid[]" class="upload" multiple="multiple" accept="video/*"></input>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M17 9.2L22.2133 5.55071C22.4395 5.39235 22.7513 5.44737 22.9096 5.6736C22.9684 5.75764 23 5.85774 23 5.96033V18.0397C23 18.3158 22.7761 18.5397 22.5 18.5397C22.3974 18.5397 22.2973 18.5081 22.2133 18.4493L17 14.8V19C17 19.5523 16.5523 20 16 20H2C1.44772 20 1 19.5523 1 19V5C1 4.44772 1.44772 4 2 4H16C16.5523 4 17 4.44772 17 5V9.2ZM17 12.3587L21 15.1587V8.84131L17 11.6413V12.3587ZM3 6V18H15V6H3ZM5 8H7V10H5V8Z"></path>
                                                </svg>
                                            </div>
                                            <div class="upload-section-video" style="display:flex;">

                                            </div>
                                        </div>
                                        <small><i><b>.jpg, .png, .webp files with a size less than 6Mb. Support video type mp4, avi, mov, flv, mpeg files with a size less than 200мь</b></i></small>
                                    </div>
                                </div>
                                <div class="review-form-button-section">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <!-- Add a hidden input field to store the product ID -->
                                    <input type="hidden" name="product_id" value="<?php echo $product->get_id(); ?>">

                                    <button type="submit" class="btn btn-primary" id="modal_submit">Save changes</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-------------------------------------------------------------Reviews Card-------------------------------------------------------------->
        <div class="line"></div>
        <div class="container">
            <div class="cards-container" id="comments-container">
                <?php
                //$comments_per_page = 5;
                $product_id = $product->get_id();
                //$page_number = get_query_var('cpage') ? get_query_var('cpage') : 1;
                $order = isset($_GET['order']) ? sanitize_text_field($_GET['order']) : 'DESC';

                $comment_ids = get_comments([
                    'post_id' => $product_id,
                    'status' => 'approve',
                    'type' => 'review',
                    'orderby' => 'comment_date',
                    'order' => $order,
                    // 'number' => $comments_per_page,
                    // 'paged' => $page_number,
                ]);
                foreach ($comment_ids as $comment_id) {
                    $comment_data = get_comment($comment_id->comment_ID);
                    $rating = get_comment_meta($comment_id->comment_ID, 'rating', true);
                    $comment_author = get_comment_author($comment_id);
                    $review_images = get_comment_meta($comment_id->comment_ID, 'reviews-images', true);
                ?>
                    <div class="card" onclick="openModal(<?php echo $comment_id->comment_ID; ?>)">
                        <div class="card-img-container">
                            <?php
                            if (!empty($review_images)) {
                                foreach ($review_images as $image_id) {
                                    $image_url = wp_get_attachment_url($image_id);
                                    echo '<img src="' . esc_url($image_url) . '" alt="Review Image">';
                                }
                            }
                            ?>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M5 11.1005L7 9.1005L12.5 14.6005L16 11.1005L19 14.1005V5H5V11.1005ZM4 3H20C20.5523 3 21 3.44772 21 4V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM15.5 10C14.6716 10 14 9.32843 14 8.5C14 7.67157 14.6716 7 15.5 7C16.3284 7 17 7.67157 17 8.5C17 9.32843 16.3284 10 15.5 10Z"></path>
                            </svg>
                        </div>
                        <div class="card-body">
                            <div class="review-info">
                                <div class="customer-rating">
                                    <div class="customer-avatar-wrapper">
                                        <div class="customer-avatar">
                                            <div class="text-avatar">
                                                A
                                            </div>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM11.0026 16L18.0737 8.92893L16.6595 7.51472L11.0026 13.1716L8.17421 10.3431L6.75999 11.7574L11.0026 16Z"></path>
                                            </svg>
                                        </div>
                                        <div class="aurthor-block">
                                            <div class="aurthor-name"><!--A***--><?php echo $comment_author; ?></div>
                                            <div class="aurthor-country-flag"></div>
                                        </div>
                                    </div>
                                    <div class="start-ratings">
                                        <?php
                                        for ($i = 1; $i <= $rating; $i++) {
                                            echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z"></path></svg>';
                                        }
                                        ?>
                                    </div>
                                    <div class="date-months">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M9 1V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9ZM20 11H4V19H20V11ZM8 13V15H6V13H8ZM13 13V15H11V13H13ZM18 13V15H16V13H18ZM7 5H4V9H20V5H17V7H15V5H9V7H7V5Z"></path>
                                        </svg>
                                        <span class="month"><?php echo esc_html(human_time_diff(strtotime($comment_data->comment_date_gmt), current_time('timestamp'))) . ' ago'; ?></span>
                                    </div>
                                </div>
                                <div class="para-content">
                                    <p><?php echo esc_html($comment_data->comment_content); ?></p>
                                </div>
                                <div class="review-footer">
                                    <div class="like">
                                        <span class="like-btn">
                                            <svg width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="" d="M128 447.1V223.1c0-17.67-14.33-31.1-32-31.1H32c-17.67 0-32 14.33-32 31.1v223.1c0 17.67 14.33 31.1 32 31.1h64C113.7 479.1 128 465.6 128 447.1zM512 224.1c0-26.5-21.48-47.98-48-47.98h-146.5c22.77-37.91 34.52-80.88 34.52-96.02C352 56.52 333.5 32 302.5 32c-63.13 0-26.36 76.15-108.2 141.6L178 186.6C166.2 196.1 160.2 210 160.1 224c-.0234 .0234 0 0 0 0L160 384c0 15.1 7.113 29.33 19.2 38.39l34.14 25.59C241 468.8 274.7 480 309.3 480H368c26.52 0 48-21.47 48-47.98c0-3.635-.4805-7.143-1.246-10.55C434 415.2 448 397.4 448 376c0-9.148-2.697-17.61-7.139-24.88C463.1 347 480 327.5 480 304.1c0-12.5-4.893-23.78-12.72-32.32C492.2 270.1 512 249.5 512 224.1z"></path>
                                            </svg>
                                            <span class="count">
                                                Like &nbsp;(1)
                                            </span>
                                        </span>
                                    </div>
                                    <div class="reply">
                                        <span class="like-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 16px;">
                                                <path fill="" d="M256 32C114.6 32 .0272 125.1 .0272 240c0 49.63 21.35 94.98 56.97 130.7c-12.5 50.37-54.27 95.27-54.77 95.77c-2.25 2.25-2.875 5.734-1.5 8.734C1.979 478.2 4.75 480 8 480c66.25 0 115.1-31.76 140.6-51.39C181.2 440.9 217.6 448 256 448c141.4 0 255.1-93.13 255.1-208S397.4 32 256 32z"></path>
                                            </svg>
                                            <span class="count">
                                                Reply &nbsp;(1)
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
        <button type="button" class="pro-btn btn-alt btn-pill" id="main_button">
            <span class="btn-text" data-category_name="" id="see_more_data">See more</span>
            <span class="loading-spinner" style="display: none;">
                <i class="fa fa-circle-o-notch fa-spin "></i>
            </span>
        </button>
        <!---------------------------------------------------------------Reviews Modal Card-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="product-modal-custom">
                <span class="close-btn" onclick="closeModal()">&times;</span>
                <!-- Picture side -->
                <div class="grid-container">
                    <div class="mobile-tabs"><button type="button" id="tabImage" class="active"><!---->
                            <i class="el-icon-picture"></i>
                            <span>Images</span></button>
                        <button type="button" id="tabReplies">
                            <!----><i class="el-icon-chat-line-square"></i>
                            <span>Replies</span>
                        </button>
                    </div>
                    <div class="product-image-gallery">
                        <div class="picture-side">
                            <!-- Add your picture or image here -->
                            <!-- <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" alt="Profile Picture" class="img-big"> -->
                            <div class="swiper mySwiper">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide"> <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" alt="Profile Picture" class="img-big"></div>
                                    <div class="swiper-slide"> <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" alt="Profile Picture" class="img-big"></div>
                                    <div class="swiper-slide"> <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" alt="Profile Picture" class="img-big"></div>
                                    <div class="swiper-slide"> <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" alt="Profile Picture" class="img-big"></div>
                                    <div class="swiper-slide"> <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" alt="Profile Picture" class="img-big"></div>
                                    <div class="swiper-slide"> <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" alt="Profile Picture" class="img-big"></div>
                                    <div class="swiper-slide"> <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" alt="Profile Picture" class="img-big"></div>
                                    <div class="swiper-slide"> <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" alt="Profile Picture" class="img-big"></div>
                                    <div class="swiper-slide"> <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" alt="Profile Picture" class="img-big"></div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                            <div class="product-image-thumbnail">
                                <div class="image-thumbnail active">
                                    <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" class="small" alt="">
                                </div>

                                <div class="image-thumbnail">
                                    <img src="https://gvawood.com/cdn/shop/products/O1CN01IqfvIW1nJeQ7Gm32Q__1105025069.jpg?v=1669709883&width=776" class="small" alt="">
                                </div>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                                <path d="M450.29 112H142c-34 0-62 27.51-62 61.33v245.34c0 33.82 28 61.33 62 61.33h308c34 0 62-26.18 62-60V173.33c0-33.82-27.68-61.33-61.71-61.33zm-77.15 61.34a46 46 0 11-46.28 46 46.19 46.19 0 0146.28-46.01zm-231.55 276c-17 0-29.86-13.75-29.86-30.66v-64.83l90.46-80.79a46.54 46.54 0 0163.44 1.83L328.27 337l-113 112.33zM480 418.67a30.67 30.67 0 01-30.71 30.66H259L376.08 333a46.24 46.24 0 0159.44-.16L480 370.59z" />
                                <path d="M384 32H64A64 64 0 000 96v256a64.11 64.11 0 0048 62V152a72 72 0 0172-72h326a64.11 64.11 0 00-62-48z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Profile review and chat side -->
                    <div class="aside-chat">
                        <div class="profile-chat-side">
                            <div class="user-reviews">
                                <div class="content">
                                    <div class="user-avatar">
                                        <img src="/card-img.jpg" alt="">
                                    </div>
                                    <div class="name-container">
                                        <div class="user-content">
                                            <h2>A***</h2>
                                            <img src="/flag.webp" alt>
                                        </div>
                                        <div class="date-months">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M9 1V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9ZM20 11H4V19H20V11ZM8 13V15H6V13H8ZM13 13V15H11V13H13ZM18 13V15H16V13H18ZM7 5H4V9H20V5H17V7H15V5H9V7H7V5Z">
                                                </path>
                                            </svg>
                                            <span class="month"><?php  ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="start-ratings">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z">
                                        </path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z">
                                        </path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z">
                                        </path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z">
                                        </path>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12.0006 18.26L4.94715 22.2082L6.52248 14.2799L0.587891 8.7918L8.61493 7.84006L12.0006 0.5L15.3862 7.84006L23.4132 8.7918L17.4787 14.2799L19.054 22.2082L12.0006 18.26Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="para">
                                    <p><?php  ?></p>
                                </div>
                                <div class="review-footer">
                                    <div class="like">
                                        <span class="like-btn">
                                            <svg width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path fill="" d="M128 447.1V223.1c0-17.67-14.33-31.1-32-31.1H32c-17.67 0-32 14.33-32 31.1v223.1c0 17.67 14.33 31.1 32 31.1h64C113.7 479.1 128 465.6 128 447.1zM512 224.1c0-26.5-21.48-47.98-48-47.98h-146.5c22.77-37.91 34.52-80.88 34.52-96.02C352 56.52 333.5 32 302.5 32c-63.13 0-26.36 76.15-108.2 141.6L178 186.6C166.2 196.1 160.2 210 160.1 224c-.0234 .0234 0 0 0 0L160 384c0 15.1 7.113 29.33 19.2 38.39l34.14 25.59C241 468.8 274.7 480 309.3 480H368c26.52 0 48-21.47 48-47.98c0-3.635-.4805-7.143-1.246-10.55C434 415.2 448 397.4 448 376c0-9.148-2.697-17.61-7.139-24.88C463.1 347 480 327.5 480 304.1c0-12.5-4.893-23.78-12.72-32.32C492.2 270.1 512 249.5 512 224.1z">
                                                </path>
                                            </svg>
                                            <span class="count">
                                                Like &nbsp;(1)

                                            </span>
                                        </span>
                                    </div>
                                    <div class="reply">
                                        <span class="like-btn">
                                            <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 16px;"><path fill="" d="M256 32C114.6 32 .0272 125.1 .0272 240c0 49.63 21.35 94.98 56.97 130.7c-12.5 50.37-54.27 95.27-54.77 95.77c-2.25 2.25-2.875 5.734-1.5 8.734C1.979 478.2 4.75 480 8 480c66.25 0 115.1-31.76 140.6-51.39C181.2 440.9 217.6 448 256 448c141.4 0 255.1-93.13 255.1-208S397.4 32 256 32z"></path></svg> -->
                                            <span class="count">
                                                No reply yet

                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div class="a2-reply-info">
                                    <div class="a2-reply-list"> <!---->
                                        <p class="no-more-reply">No more reply</p>
                                    </div>
                                </div>
                            </div>
                            <div class="message-box">
                                <!-- Add chat functionality here -->
                                <div class="avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12 2C17.52 2 22 6.48 22 12C22 17.52 17.52 22 12 22C6.48 22 2 17.52 2 12C2 6.48 6.48 2 12 2ZM6.02332 15.4163C7.49083 17.6069 9.69511 19 12.1597 19C14.6243 19 16.8286 17.6069 18.2961 15.4163C16.6885 13.9172 14.5312 13 12.1597 13C9.78821 13 7.63095 13.9172 6.02332 15.4163ZM12 11C13.6569 11 15 9.65685 15 8C15 6.34315 13.6569 5 12 5C10.3431 5 9 6.34315 9 8C9 9.65685 10.3431 11 12 11Z">
                                        </path>
                                    </svg>
                                </div>
                                <div class="textarea-container">

                                    <textarea placeholder="Type your message..." rows="1"></textarea>
                                </div>
                                <button>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M21.7267 2.95694L16.2734 22.0432C16.1225 22.5716 15.7979 22.5956 15.5563 22.1126L11 13L1.9229 9.36919C1.41322 9.16532 1.41953 8.86022 1.95695 8.68108L21.0432 2.31901C21.5716 2.14285 21.8747 2.43866 21.7267 2.95694ZM19.0353 5.09647L6.81221 9.17085L12.4488 11.4255L15.4895 17.5068L19.0353 5.09647Z">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>