$(document).ready(function () {
  $("html,body").stop().animate({ scrollTop: $("html,body")[0].scrollHeight}, 1000);
  $("#postBox").stop().animate({ scrollTop: $("#postBox")[0].scrollHeight}, 1000);
  setInterval(function(){
    $('#postBox').load('INCLUDES/chatTextInsert-inc.php');
  }, 1000);
    var timeout, clicker = $(document);

    clicker.mouseup(function(){
        timeout = setInterval(function(){
          $("#postBox").stop().animate({ scrollTop: $("#postBox")[0].scrollHeight}, 1000);
        }, 1000);
    });

    clicker.mousedown(function(){
        clearInterval(timeout);
    });

    // $('#postBox').bind('scroll',chk_scroll);
    //
    // function chk_scroll(e)
    // {
    //     var elem = $(e.currentTarget);
    //     if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight())
    //     {
    //         alert("bottom");
    //     }
    //
    // }

    $('html, body').bind('scroll mousedown wheel DOMMouseScroll mousewheel keyup', function(e){
      if ( e.which > 0 || e.type == "mousedown" || e.type == "mousewheel"){
        $("#postBox").stop();
        clearInterval(timeout);
      }
      });

      $(function () {

        $('#chatForm').on('submit', function (e) {

          e.preventDefault();

              var friend = $("#chat-friend").val();
              var chatRoom = $("#chat-room").val();
              var chatText = $("#chat-text").val();
              var submit = $(".chat-submit").val();
              var dataString = friend + chatRoom + chatText;

          $.ajax({
            type: 'POST',
            url: 'INCLUDES/chatSend-inc.php',
            data: {friend: friend, chatroom: chatRoom, chatText: chatText, submit: submit},
            success: function () {
              setTimeout(function () {
                $("#postBox").stop().animate({ scrollTop: $("#postBox")[0].scrollHeight}, 1000);
                $("#chat-text").val("");
                $('#postBox').load('INCLUDES/chatTextInsert-inc.php');
              }, 1000);

            }
          });

        });

      });

});
