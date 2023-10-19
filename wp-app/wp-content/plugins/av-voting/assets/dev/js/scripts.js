jQuery(document).ready(($) => {
    const isVoted = false;
    const userVote = 1; // 1 means positive, 0 means negative
    const nonce = window.avVoting.nonce;
    const url = window.avVoting.url;

    getView();

    function getView() {
        const url = window.location.origin + '/wp-json/av-voting/v1/get-view';

        fetch(url, {
            method: 'GET',
            credentials: 'same-origin',
            headers: {
                'Content-Type': 'application/json',
                'X-WP-Nonce': nonce,
            },
        })
            .then(response => response.json())
            .then((response) => {
                if(response.success){
                    $('.av-voting-wrap').html(response.html);
                } else {
                    alert('Something went wrong');
                }
            });
    }
});
