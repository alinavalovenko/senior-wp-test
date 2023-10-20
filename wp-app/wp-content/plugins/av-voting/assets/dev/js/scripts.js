jQuery(document).ready(($) => {
    const isVoted = localStorage.getItem('av_is_voted') || false;
    const ajaxurl = window.avVoting.url;
    const $container = $('.av-voting-wrap');
    const id = $container.attr('data-post-id');

    initView();

    function setActiveButton() {
        const userVote = window.localStorage.getItem('user_vote'); // 1 means positive, 0 means negative

        if (isVoted) {
            if (userVote == 1) {
                $container.find('.avv-form__positive').addClass('active');
            } else {
                $container.find('.avv-form__negative').addClass('active');
            }
        }
    }

    function initView() {
        let viewUrl = window.location.origin + '/wp-json/av-voting/v1/get-stat?id=' + id;
        if (!isVoted) {
            viewUrl = window.location.origin + '/wp-json/av-voting/v1/get-form';
        }

        fetch(viewUrl, {
            method: 'GET',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': window.avVoting.nonce,
            },
        })
            .then(response => response.json())
            .then((response) => {
                if (response.success) {
                    $('.av-voting-wrap').html(response.html);
                    setActiveButton();
                } else {
                    alert('Something went wrong');
                }
            });
    }

    $(document).on('click', '#avv-form .avv-form__button', (e) => {
        const vote = $(e.target).closest('.avv-form__button').attr('data-value');
        localStorage.setItem('av_is_voted', 'true');
        localStorage.setItem('user_vote', vote);

        $.post(ajaxurl, {
            action: 'av_save_vote',
            value: vote,
            nonce: window.avVoting.formnonce,
            id: id
        }, (response) => {
            if (response.success) {
                $container.html(response.html);
                if (window.localStorage.getItem('user_vote') == 1) {
                    $container.find('.avv-form__positive').addClass('active');
                } else {
                    $container.find('.avv-form__negative').addClass('active');
                }            }
            console.log(response);
        });

    });
});
