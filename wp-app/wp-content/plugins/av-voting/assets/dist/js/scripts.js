"use strict";

jQuery(document).ready(function ($) {
  var isVoted = false;
  var userVote = 1; // 1 means positive, 0 means negative
  var nonce = window.avVoting.nonce;
  var url = window.avVoting.url;
  getView();
  function getView() {
    var url = window.location.origin + '/wp-json/av-voting/v1/get-view';
    fetch(url, {
      method: 'GET',
      credentials: 'same-origin',
      headers: {
        'Content-Type': 'application/json',
        'X-WP-Nonce': nonce
      }
    }).then(function (response) {
      return response.json();
    }).then(function (response) {
      if (response.success) {
        $('.av-voting-wrap').html(response.html);
      } else {
        alert('Something went wrong');
      }
    });
  }
});