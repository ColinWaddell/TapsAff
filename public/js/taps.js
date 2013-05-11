
$(document).ready(function(){
	
    $("#more-info").hover(
      function(){
        $("div#more-info > #more-info-link").hide();
        $("div#more-info > .more-info-expand").fadeIn(100);
      },

      function(){
        $("div#more-info > .more-info-expand").fadeOut(100,
          function(){
            $("div#more-info > #more-info-link").show();
          });
      });

});
