
 if($.cookie("css")) {
    $("link").attr("href",$.cookie("css"));
  }
$(document).ready(function() {

  $("#nav li a").click(function() {

    $("link").attr("href",$(this).attr('rel'));
    $.cookie("css",$(this).attr('rel'), {expires: 365, path: '/'});
    location.reload();
    return false;

  });
});
$(document).ready(function(){
  $("#hide").click(function(){
    $("#feed").hide();
  });
  $("#show").click(function(){
    $("#feed").show();
  });
});

// $(document).ready(function() {
//        $.support.cors = true;
//       $("#login").click(function() {
//         username = $("[name='username']").val();
//         password = $("[name='password']").val();
//         if(username=="") {
//           $("#messages").html("Please enter a username.");
//           return false;
//         }
//         if(password=="") {
//           $("#messages").html("Please enter a password.");
//           return false;
//         }
//         $.ajax({
//           beforeSend: function() {
//             $("#loading").show();
//           },
//           complete: function() {
//             $("#loading").hide();
//           },
//           type: 'GET',
//           dataType: "jsonp",
//           jsonp: "callback",
//           url: "localhost/WebflixHub/mng_user.php?action=login&l_username=" + username + "&l_password=" + password,
//           success: function(data) {
//             responseString="";
//             $.each(data, function (index, item) {
//                 // Use item in here
//                 responseString = item;
//             });
//             if(responseString.indexOf("LOGGEDIN")>-1) {
//               //get rest of data after prefix (LOGGEDIN:)
//               //the number is the character position to start from, we cut off the prefix
//               userid = responseString.substring(9);
//               location.href="subscriptions.html?userid=" + userid;
//             }
//             if(responseString.indexOf("NOTFOUND")>-1) {
//               //get rest of data after prefix (NOTFOUND:)
//               //the number is the character position to start from, we cut off the prefix
//               message = responseString.substring(9);
//               $("#messages").html(message);
//             }
//             if(responseString.indexOf("INVALID")>-1) {
//               //get rest of data after prefix (INVALID:)
//               //the number is the character position to start from, we cut off the prefix
//               message = responseString.substring(8);
//               $("#messages").html(message);
//             }
//           },
//           error: function (jqXHR, textStatus, errorThrown) {
//             if (jqXHR.status == 500) {
//                       $("#messages").html('Internal error: ' + jqXHR.responseText);
//                   } else {
//                       $("#messages").html('Unexpected error.');
//                   }
//           }
//         });
//       });
//     });
