$(document).ready(function (e) {
  $("#form").on('submit', (function (e) {
    e.preventDefault();
    $.ajax({
      url: "ajaxupload.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      beforeSend: function () {
        $("#preview").fadeIn();
        $("#err").fadeOut();
      },
      success: function (data) {
        if (data == 'invalid') {
          // invalid file format.
          $("#err").html("Invalid File !").fadeIn();
        } else {
          // view uploaded file.
          $("#preview").html(data).fadeOut();
          $("#form")[0].reset();
          windows.location.href = "main.php";
        }
      },
      error: function (e) {
        $("#err").html(e).fadeIn();
      }
    });
  }));
});