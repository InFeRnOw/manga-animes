$(document).ready(function () {
    function lightNovel() {
      $("#adaptedTitleOne").html('<p><span style="font-weight: 700;"><u>Volume&nbsp;<span style="background-color: rgb(156, 156, 148);">?</span>&nbsp;of the light novel<br></p>');
      $("#adaptedTitleTwo").html('<p><span style="font-weight: 700;"><u>Volume&nbsp;<span style="background-color: rgb(156, 156, 148);">?</span>&nbsp;of the light novel<br></p>');
      $("#adaptedTitleThree").html('<p><span style="font-weight: 700;"><u>Volume&nbsp;<span style="background-color: rgb(156, 156, 148);">?</span>&nbsp;of the light novel<br></p>');
    }
    function manga() {
      $("#adaptedTitleOne").html('<p><span style="text-decoration-line: underline; font-weight: bold;">Tome&nbsp;<span style="background-color: rgb(156, 156, 148);">?</span>&nbsp;of manga</span><br></p>');
      $("#adaptedTitleTwo").html('<p><span style="text-decoration-line: underline; font-weight: bold;">Tome&nbsp;<span style="background-color: rgb(156, 156, 148);">?</span>&nbsp;of manga</span><br></p>');
      $("#adaptedTitleThree").html('<p><span style="text-decoration-line: underline; font-weight: bold;">Tome&nbsp;<span style="background-color: rgb(156, 156, 148);">?</span>&nbsp;of manga</span><br></p>');
    }
    $('#adaptSelector').on('change', function() {
      if ( $('#adaptSelector').val() == 'LightNovel' ) lightNovel();
      else if ( $('#adaptSelector').val() == 'Manga' ) manga();
    });
});
