$(document).ready(function () {
    var textRowLN = '<div class="adaptedTitle"><p><span style="font-weight: 700;"><u>Volume&nbsp;<span style="background-color: rgb(156, 156, 148);">?</span>&nbsp;of the light novel<br></p></div>';
    var textRowM = '<div class="adaptedTitle"><p><span style="text-decoration-line: underline; font-weight: bold;">Volume&nbsp;<span style="background-color: rgb(156, 156, 148);">?</span>&nbsp;of manga</span><br></p></div>';
    var textRowCommon = '<div class="adaptedTitle"><p><b><u>Volume <span style="background-color: rgb(156, 156, 148);">?</span> of the light novel <span style="color: rgb(206, 0, 0);">OR </span></u></b><span style="font-weight: bold; text-decoration-line: underline;">Volume <span style="background-color: rgb(156, 156, 148);">?</span> of manga</span></p></div>';
    var textRowBoth = '<div class="adaptedTitle"><p><span style="font-weight: 700;"><u>Volume&nbsp;<span style="background-color: rgb(156, 156, 148);">?</span>&nbsp;of the light novel</u><br></p><p>- <span style="font-family: Arial;">Chapters...</span></p><p><span style="text-decoration-line: underline; font-weight: bold;">Volume&nbsp;<span style="background-color: rgb(156, 156, 148);">?</span>&nbsp;of manga</span><br></p></div>';

    function lightNovel() {
      $(".adaptedTitle").html(textRowLN);
      textRowCommon = textRowLN;
    }

    function manga() {
      $(".adaptedTitle").html(textRowM);
      textRowCommon = textRowM;
    }

    function both() {
      $(".adaptedTitle").html(textRowBoth);
      textRowCommon = textRowBoth;
    }

    $('#adaptSelector').on('change', function() {
      if ( $('#adaptSelector').val() == 'LightNovel' ) lightNovel();
      else if ( $('#adaptSelector').val() == 'Manga' ) manga();
      else if ( $('#adaptSelector').val() == 'Both' ) both();
    });

    var numOfEpisodes = 0;
    var count = 0;
    var arcCount = 0;
    var rowId = 1;

    $('#episodes').bind('input', function() {
        numOfEpisodes = $("#episodes").val();
        console.log("Input changed");
        console.log('number of episodes: ' + numOfEpisodes);
        if (count !== numOfEpisodes) {
          while (count !== numOfEpisodes && count < numOfEpisodes || count > numOfEpisodes) {
             if (count == numOfEpisodes) {
                console.log('Stoped posting');
             }
             else if (count < numOfEpisodes) {
                 count += 1;
                 $(".animeTable").append('<tr id="tableRow'+count+'"><td><p style="text-align: center;"><b><u>Episode '+count+'</u></b></p><p style="text-align: center;"><span style="font-family: Arial;">"Japanese" ("Rōmaji")</span></p><p style="text-align: center;"><span style="font-family: Arial;">"English"</span></p></td><td>'+ textRowCommon +'<p>- <span style="font-family: Arial;">Chapters...</span></p></td></tr>');
                 // $(".table").append('<tr id="tableRow'+count+'"><td><p style="text-align: center;"><b><u>Episode '+count+'</u></b></p><p style="text-align: center;">"<span style="background-color: rgb(156, 156, 148);">Title</span>"</p></td><td>'+ textRowCommon +'<p>- <span style="background-color: rgb(156, 156, 148);">Chapters...</span></p></td></tr>');
             }
             else if (numOfEpisodes < count) {
                 $("#tableRow"+count+"").remove();
                 count -= 1;
             }
          }
        }
        // else if (numOfEpisodes == 5) {
        //   console.log('else if statement for deleting');
        //   // while (count !== numOfEpisodes && count > numOfEpisodes) {
        //   //    if (count == numOfEpisodes) {
        //   //       console.log('Stoped deleting');
        //   //    }
        //   //    else {
        //   //      $("#test").remove()
        //   //      console.log('Posting');
        //   //      count -= 1;
        //   //      console.log('variable count: ' + count);
        //   //    }
        //   // }
        // }
    });

    $('#arcs').bind('input', function() {
        numOfArcs = $("#arcs").val();
        console.log("Input changed");
        console.log('number of arcs: ' + numOfArcs);
        if (arcCount !== numOfArcs) {
          while (arcCount !== numOfArcs && arcCount < numOfArcs || arcCount > numOfArcs) {
             if (arcCount == numOfArcs) {
                console.log('Stoped posting');
             }
             else if (arcCount < numOfArcs) {
                 arcCount += 1;
                 // for(i=0;i<arcCount;i++) {
                 //   $(".arcSelector").append("<option value='LightNovel'>Adapted from light novel</option>");
                 // }
                 // // $(".arcTable").append('<div id="arcTableRow'+arcCount+'"><div class="col-md-6"><p style="text-align: center;"><b>Arc '+arcCount+'</b></p></div><div class="col-md-6">test</div></div>');
                 $(".arcTable").append('<tr id="arcTableRow'+arcCount+'"><td><p style="text-align: center;"><b><u>Arc '+arcCount+' (Episodes xx-xx)</u></b></p><p style="text-align: center;"><span style="font-family: Arial;">"Japanese" ("Rōmaji")</span></p><p style="text-align: center;"><span style="font-family: Arial;">"English"</span></p></td><td>'+ textRowCommon +'<p>- <span style="font-family: Arial;">Chapters...</span></p></td></tr>');
                 // $(".table").append('<tr id="tableRow'+arcCount+'"><td><p style="text-align: center;"><b><u>Episode '+arcCount+'</u></b></p><p style="text-align: center;">"<span style="background-color: rgb(156, 156, 148);">Title</span>"</p></td><td>'+ textRowCommon +'<p>- <span style="background-color: rgb(156, 156, 148);">Chapters...</span></p></td></tr>');
             }
             else if (numOfArcs < arcCount) {
                 $("#arcTableRow"+arcCount+"").remove();
                 arcCount -= 1;
             }
          }
        }
        // else if (numOfEpisodes == 5) {
        //   console.log('else if statement for deleting');
        //   // while (count !== numOfEpisodes && count > numOfEpisodes) {
        //   //    if (count == numOfEpisodes) {
        //   //       console.log('Stoped deleting');
        //   //    }
        //   //    else {
        //   //      $("#test").remove()
        //   //      console.log('Posting');
        //   //      count -= 1;
        //   //      console.log('variable count: ' + count);
        //   //    }
        //   // }
        // }
    });


  $('#numberArcsCenter').bind('input', function() {
        numOfArcs = $("#numberArcsCenter").val();
        console.log("Input changed");
        console.log('number of arcs: ' + numOfArcs);
        if (arcCount !== numOfArcs) {
          while (arcCount !== numOfArcs && arcCount < numOfArcs || arcCount > numOfArcs) {
             if (arcCount == numOfArcs) {
                console.log('Stoped posting');
             }
             else if (arcCount < numOfArcs) {
                 arcCount += 1;
                 // for(i=0;i<arcCount;i++) {
                 //   $(".arcSelector").append("<option value='LightNovel'>Adapted from light novel</option>");
                 // }
                 // // $(".arcTable").append('<div id="arcTableRow'+arcCount+'"><div class="col-md-6"><p style="text-align: center;"><b>Arc '+arcCount+'</b></p></div><div class="col-md-6">test</div></div>');
                 $(".arcTable").append('<tr id="arcTableRow'+arcCount+'"><td><p style="text-align: center;"><b><u>Arc '+arcCount+' (Episodes xx-xx)</u></b></p><p style="text-align: center;"><span style="font-family: Arial;">"Japanese" ("Rōmaji")</span></p><p style="text-align: center;"><span style="font-family: Arial;">"English"</span></p></td><td>'+ textRowCommon +'<p>- <span style="font-family: Arial;">Chapters...</span></p></td></tr>');
                 // $(".table").append('<tr id="tableRow'+arcCount+'"><td><p style="text-align: center;"><b><u>Episode '+arcCount+'</u></b></p><p style="text-align: center;">"<span style="background-color: rgb(156, 156, 148);">Title</span>"</p></td><td>'+ textRowCommon +'<p>- <span style="background-color: rgb(156, 156, 148);">Chapters...</span></p></td></tr>');
             }
             else if (numOfArcs < arcCount) {
                 $("#arcTableRow"+arcCount+"").remove();
                 arcCount -= 1;
             }
          }
        }
        // else if (numOfEpisodes == 5) {
        //   console.log('else if statement for deleting');
        //   // while (count !== numOfEpisodes && count > numOfEpisodes) {
        //   //    if (count == numOfEpisodes) {
        //   //       console.log('Stoped deleting');
        //   //    }
        //   //    else {
        //   //      $("#test").remove()
        //   //      console.log('Posting');
        //   //      count -= 1;
        //   //      console.log('variable count: ' + count);
        //   //    }
        //   // }
        // }
    });
});