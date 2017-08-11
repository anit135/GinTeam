$(document).ready(function() {

  //scroll begin
  $(".nav > li a.q1").click(function() {
     $.scrollTo("#home", {duration: 1000, axis:"y"});
     return false;
  });

  $(".nav > li a.q2").click(function() {
     $.scrollTo("#services", {duration: 1000, axis:"y"});
     return false;
  });

   $(".nav > li a.q3").click(function() {
     $.scrollTo("#contacts", {duration: 1000, axis:"y"});
     return false;
  });


    //scroll default
  $.scrollTo("#home", {duration: 0, axis:"y"});

});

window["_GOOG_TRANS_EXT_VER"] = "1";