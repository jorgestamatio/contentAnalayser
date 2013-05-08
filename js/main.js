  $(document).ready(new function() {
      // This filter is later used as the selector for which grid items to show.
      var loading = $('#loading');
      var search = $('#search');

      // Capture filter click events.
      $('#getAnalysis').click(function(e){
        e.preventDefault();
          var page = $('#page').val();
          var token = $('#token').val();
          $('#analysis').slideUp();
          search.hide();
          loading.show();
          var dataString = 'page=' + page + '&tk=' + token;
            $.ajax({
                type: "POST",
                data: dataString,
                url: "get_analysis.php",
                success: function (data) {
                    $('#analysis').html(data);
                    $('#analysis').slideDown();
                    loading.hide();
                    search.show();
                  }
        
            }); //ajax drop    
          
      });

     




});
