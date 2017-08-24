$( document ).ready(function() {
    console.log( "ready!" );
    
    $(function() {
    $("input:checkbox").click(function() {
    $.post(
      "/subjects/update-status/?id="+$(this).attr("data-modelid"), { 
          status : $(this).is(':checked')
      },
        function(response) {
            $("#" + response.id).attr('checked', response.checkval); 
        },
      "json"
    );
    });
});

   

  
});