$(document).ready(function() {
  // $("li a").removeClass('ui-btn-icon-top');
  var guess_post_id = "";
  var page = parseInt($("#pages").attr('page'));
  var mode = parseInt($("#pages").attr('mode'));
  getPage(page, mode);
  var max = parseInt($("#pages").attr('max'));
  $("#previous").click(function(event) {
    page = parseInt($("#pages").attr('page'));
    max = parseInt($("#pages").attr('max'));
    if (page - 1 > 0) {
      $("<img>").attr('src', 'images/icon/heart.gif').addClass('loading').appendTo('#main');
      getPage(page - 1, mode);
      $("#pages").attr('page', page - 1);
      // $('body,html').animate({scrollTop:200},500);

    } else {

    }
  });

  $("#next").click(function(event) {
    page = parseInt($("#pages").attr('page'));
    max = parseInt($("#pages").attr('max'));
    if (page + 1 > max) {

    } else {
      $("<img>").attr('src', 'images/icon/heart.gif').addClass('loading').appendTo('#main');
      getPage(page + 1, mode);
      $("#pages").attr('page', page + 1);
      // $('body,html').animate({scrollTop:200},500);
      // $('body,html').scrollTop(200);
    }
  });

  $("#main").on('click', ".ui-icon-like",function(event){
    // console.log($(this).attr('post'));
    var postID = $(this).attr('post');
    $.ajax({
      url: 'php/action.php',
      type: 'POST',
      dataType: 'html',
      data: {act: 'liked', post_id:postID}
    })
    .done(function(result) {
      console.log("success");
      // console.log(result);
      if (result != "") {
        $(event.target).html(result).addClass('ui-icon-liked').fadeIn(300);
      }
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  });

  $("#main").on('click', ".ui-icon-guess",function(event){
    // console.log($(this).attr('post'));
    var postID = $(this).attr('post');
    var proportion = $(this).text();
    var num = proportion.split("/");
    $("#guess_all").text(num[1]);
    $("#guess_right").text(num[0]);
    guess_post_id = $(this).attr('post');
    $("#guess-hint").text("");
  });

  $("#guess-submit").click(function(event) {
    var guessName = $("#guess-input").val();
    if (guessName != "") {
      $.ajax({
        url: 'php/action.php',
        type: 'POST',
        dataType: 'html',
        data: {act: 'guess', guessName:guessName, post_id:guess_post_id}
      })
      .done(function(result) {
        console.log("success");
        // console.log(result);
        $("#guess-hint").text(result);
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
        $("#guess-input").val("");
      });
    } else {

    }
  });

  //评论
  $("#main").on('click', ".ui-icon-comment",function(event){
    var postID = $(this).attr('post');
    $("#comment-submit").attr('post', postID);
    $("#comment-lists-ul").html("");
    $.ajax({
      url: 'php/action.php',
      type: 'POST',
      dataType: 'json',
      data: {act: 'getComment', post_id:postID}
    })
    .done(function(result) {
      console.log("success");
      console.log(result);
      commentOutput(result);
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  });

  $("#comment-submit").click(function(event) {
    var comment = $("#comment-Popup input").val();
    var postID = $(this).attr('post');
    // console.log(comment+"\n"+postID);
    if (comment != "") {
      $.ajax({
        url: 'php/action.php',
        type: 'POST',
        dataType: 'html',
        data: {act: 'comment', comment:comment, post_id:postID}
      })
      .done(function(result) {
        console.log("success");
        console.log(result);
        $("#comment-hint").text("评论成功！");
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
        $("#comment-Popup input").val("");
      });

    } else {

    }
  });

  //分享
  $("#main").on('click', ".ui-icon-share",function(event){
    var postID = $(this).attr('post');
    // console.log(postID);
    $("#link").html("");
    $("<a>").attr('target', '_blank').attr('href', 'https://pingxonline.com/app/sust/share.php?id='+postID).text("https://pingxonline.com/app/sust/share.php?id="+postID).appendTo('#link');
  });

  $("#returnTop").click(function () {
     $('body,html').animate({scrollTop:0},500);
   });

   $("#new-posts").click(function(event) {
     var page = 1;
     var mode = 1;
     getPage(page, mode);
     $("#pages").attr('page', page).attr('mode', mode);
   });

   $("#old-posts").click(function(event) {
     var page = 1;
     var mode = 4;
     getPage(page, mode);
     $("#pages").attr('page', page).attr('mode', mode);
   });

   $("#most-liked").click(function(event) {
     var page = 1;
     var mode = 0;
     getPage(page, mode);
     $("#pages").attr('page', page).attr('mode', mode);
   });

   $("#less-liked").click(function(event) {
     var page = 1;
     var mode = 3;
     getPage(page, mode);
     $("#pages").attr('page', page).attr('mode', mode);
   });

   $("#random-posts").click(function(event) {
     var page = 1;
     var mode = 2;
     getPage(page, mode);
     $("#pages").attr('page', page).attr('mode', mode);
   });

});



function getPage(page, mode) {
  $.ajax({
    url: 'php/action.php',
    type: 'POST',
    dataType: 'json',
    data: {act: "load", page: page, mode:mode}
  })
  .done(function(result) {
    console.log("success");
    // console.log(result);
    output(result);
    var page = $("#pages").attr('page');
    var max = $("#pages").attr('max');
    var total = $("#pages").attr('total');
    $("#pageNum").text('第'+page+'页，共'+max+'页，共'+total+'条表白');
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
    $('body,html').scrollTop(200);
  });
}

function output(result) {
  $("#main").html("");
  var total_page = "";
  var total = "";
  $.each(result, function(index, val) {
    var id = val[0];
    var nickName = val[1];
    var toWho = val[2];
    var contents = val[3];
    var love = val[4];
    var guessCount = val[5];
    var commentsCount = val[6];
    var time = val[7];
    total_page = val[8] + 1;
    var guessCount_all = val[9];
    var gender = val[10];
    var itsGender = val[11];
    total = val[12];
    $("<div>").addClass('post').addClass('post-'+id).appendTo('#main');
    $("<div>").addClass('post-title').addClass('post-title-'+id).appendTo('.post-'+id);
    $("<ul>").html('<li class="'+gender+'">'+nickName+'</li><li><img src="images/icon/to.png" alt="" /></li><li class="'+itsGender+'">'+toWho+'</li>').appendTo('.post-title-'+id);
    $("<div>").addClass('post-body').addClass('post-body-'+id).appendTo('.post-'+id);
    $("<p>").addClass('post-body-content').text(contents).appendTo('.post-body-'+id);
    $("<p>").addClass('post-body-time').text(time).appendTo('.post-body-'+id);
    $("<div>").addClass('post-actions action ui-navbar').addClass('post-actions-'+id).attr('data-role', 'navbar').attr('role', 'navigation').appendTo('.post-'+id);
    $("<ul>").addClass('ui-grid-c').addClass('post-actions-ul-'+id).appendTo('.post-actions-'+id);
    if ( getCookie(id) == id) {
      $("<li>").addClass('ui-block-a').html('<a class="ui-link ui-btn ui-icon-like ui-btn-icon-left ui-icon-liked" href="#" post="'+id+'" data-icon="like">'+love+'</a>').appendTo('.post-actions-ul-'+id);
    } else {
      $("<li>").addClass('ui-block-a').html('<a class="ui-link ui-btn ui-icon-like ui-btn-icon-left " href="#" post="'+id+'" data-icon="like">'+love+'</a>').appendTo('.post-actions-ul-'+id);
    }
    $("<li>").addClass('ui-block-b').html('<a class="ui-link ui-btn ui-icon-guess ui-btn-icon-left " href="#guess-Name-Popup"  data-rel="popup" data-position-to="window"	data-transition="pop" post="'+id+'" data-icon="guess">'+guessCount+'/'+guessCount_all+'</a>').appendTo('.post-actions-ul-'+id);
    $("<li>").addClass('ui-block-c').html('<a class="ui-link ui-btn ui-icon-comment ui-btn-icon-left " href="#comment-Popup" data-rel="popup" data-position-to="window"	data-transition="pop" post="'+id+'" data-icon="comment">'+commentsCount+'</a>').appendTo('.post-actions-ul-'+id);
    $("<li>").addClass('ui-block-d').html('<a class="ui-link ui-btn ui-icon-share ui-btn-icon-left " href="#share-Popup" data-rel="popup" data-position-to="window"	data-transition="pop" post="'+id+'" data-icon="share">分享</a>').appendTo('.post-actions-ul-'+id);
  });
  $("#pages").attr('max', total_page).attr('total', total);
}

function commentOutput(result) {
  $("#comment-lists-ul").html("");
  if (result == "") {
    $("#comment-lists-ul").text("快来抢沙发吧！");
  } else {
    $.each(result, function(index, val) {
      $("<li>").html('<span class="comment-floor">'+(index+1)+'楼</span><span class="comment-ip">'+val[2]+'</span><span class="comment-time">'+val[0]+'</span><p>'+val[1]+'</p>').appendTo('#comment-lists-ul');
    });
  }
}

function getCookie(c_name)
{
  if (document.cookie.length>0){
    c_start=document.cookie.indexOf(c_name + "=");
    if (c_start!=-1)
      {
      c_start=c_start + c_name.length+1;
      c_end=document.cookie.indexOf(";",c_start);
      if (c_end==-1) c_end=document.cookie.length;
      return unescape(document.cookie.substring(c_start,c_end));
      }
    }
return "";
}
