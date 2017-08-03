$(document).ready(function() {
  get(1);

  $("body").on('click', ".send-button",function(event){
    var postID = $(this).attr('id');
    var email = $(this).attr('email');
    $("#email-list-table").html("");
    $.ajax({
      url: 'auth.php',
      type: 'POST',
      dataType: 'html',
      data: {act: 'resend', id:postID, email:email}
    })
    .done(function(result) {
      console.log("success");
      console.log(result);
      $("#info").html(result);
      get(1);
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  });

  $("#start").click(function(event) {
    setInterval("autoSend()", 1000 * 360); //1000为1秒钟
  });

});

function get(page) {
  $("#info").html("");
  $.ajax({
    url: 'auth.php',
    type: 'POST',
    dataType: 'json',
    data: {act:"getemail", page:page}
  })
  .done(function(result) {
    console.log("success");
    console.log(result);
    outputEmail(result);
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
}

function autoSend() {
  $.ajax({
    url: 'auth.php',
    timeout : 999999,
    type: 'POST',
    dataType: 'html',
    data: {act: 'start'}
  })
  .done(function(result) {
    console.log("success");
    console.log(result);
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
    console.log("执行完毕！");
  });
}

function outputEmail(result) {
  $("#email-list-table").html("");
  $("<tr>").attr('id', 'email-title').appendTo('#email-list-table');
  $("<th>").text("昵称").appendTo('#email-title');
  $("<th>").text("对谁").appendTo('#email-title');
  $("<th>").text("内容").appendTo('#email-title');
  $("<th>").text("邮箱地址").appendTo('#email-title');
  $("<th>").text("修改时间").appendTo('#email-title');
  $("<th>").text("发送").appendTo('#email-title');
  $.each(result, function(index, val) {
    var id = val[0];
    var nickName = val[1];
    var toWho = val[2];
    var contents = val[3];
    var email = val[4];
    var ip = val[5];
    var mtime = val[6];

    $("<tr>").attr('id', 'email-'+id).appendTo('#email-list-table');
    $("<td>").text(id).appendTo('#email-'+id);
    $("<td>").text(nickName).appendTo('#email-'+id);
    $("<td>").text(toWho).appendTo('#email-'+id);
    $("<td>").text(contents).appendTo('#email-'+id);
    $("<td>").text(email).appendTo('#email-'+id);
    $("<td>").text(ip).appendTo('#email-'+id);
    $("<td>").text(mtime).appendTo('#email-'+id);
    $("<td>").attr('id', 'button-'+id).appendTo('#email-'+id);
    $("<button>").addClass('send-button').text('发送').attr('id', id).attr('email', email).appendTo('#button-'+id);
  });
}
