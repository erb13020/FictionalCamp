import $ from 'jquery';

class Like {
    constructor() {
        this.events();
    }

    events() {
        $(".like-box").on("click", this.clickDispatcher.bind(this));
    }

    // methods
    clickDispatcher(e) {

        var currentHeart = $(e.target).closest(".like-box");
        var heartIcon = $(e.target).closest(".fa");
        var heartBox = $(e.target).find(".fa");
        var likeCountSpan = $(e.target).parent().find(".fa");


        if ($(currentHeart).attr('data-exists') == 'unliked') {
            this.createLike(currentHeart, heartIcon, heartBox, likeCountSpan);
        } else {
            this.deleteLike(currentHeart, heartIcon, heartBox, likeCountSpan);
        }
    }

    createLike(currentHeart, heartIcon, heartBox, likeCountSpan) {

        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', campData.nonce);
            },
            url: campData.root_url + '/wp-json/camp/v1/manageLike',
            type: 'POST',
            data: {'counselorId': currentHeart.data('counselor')},
            success: (response) => {
                currentHeart.attr('data-exists', 'liked');

                heartIcon.removeClass("fa-heart-o");
                heartIcon.addClass("fa-heart");
                heartBox.removeClass("fa-heart-o");
                heartBox.addClass("fa-heart");
                likeCountSpan.removeClass("fa-heart-o");
                likeCountSpan.addClass("fa-heart");

                let likeCount = parseInt(currentHeart.find(".like-count").html(), 10);
                likeCount++;

                currentHeart.find(".like-count").html(likeCount);
                currentHeart.find(".like-count").attr("data-like", response);
                currentHeart.attr("data-like", response);
                console.log(response);
            },
            error: (response) => {
                console.log(response);
                alert(response.responseText);
            }
        })
    }

    deleteLike(currentHeart, heartIcon, heartBox, likeCountSpan) {
        $.ajax({
            beforeSend: (xhr) => {
                xhr.setRequestHeader('X-WP-Nonce', campData.nonce);
            },
            url: campData.root_url + '/wp-json/camp/v1/manageLike',
            data: {
                "like": parseInt(currentHeart.find(".like-count").attr("data-like"), 10)
            },
            type: 'DELETE',
            success: (response) => {
                currentHeart.attr('data-exists', 'unliked');

                heartIcon.removeClass("fa-heart");
                heartIcon.addClass("fa-heart-o");
                heartBox.removeClass("fa-heart");
                heartBox.addClass("fa-heart-o");
                likeCountSpan.removeClass("fa-heart");
                likeCountSpan.addClass("fa-heart-o");

                var likeCount = parseInt(currentHeart.find(".like-count").html(), 10);
                likeCount--;
                currentHeart.find(".like-count").html(likeCount);
                currentHeart.attr("data-like", '');
                console.log(response);
            },
            error: (response) => {
                console.log(response);
            }
        })
    }
}

export default Like;