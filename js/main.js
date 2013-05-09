$(document).ready(new function() {

  var loading = $('#loading'),
      search = $('#search'),
      analysis = $('#analysis'),
      postIds = [],
      countIds = 0;
      
// Capture filter click events.
$('#getAnalysis').click(function(e){
  e.preventDefault();
  showLoading();
  var page = $('#page').val(),
      token = $('#token').val(),
      url = "https://graph.facebook.com/"+page+"/posts?access_token="+token+"";

  getIds(url);

});


function getIds (url) {
  $.get(
    url,
    function(data) {
      parseIds(data);
    }              
  );
}

     
function parseIds(json){
  $.each(json.data, function(i, post){
    postIds.push(post.id);
  });

  countIds = postIds.length;
  console.log(postIds);
  setProgress(countIds);
  if(countIds <= 100){
    var nextPage = json.paging.next;
    getIds(nextPage);
  }else{
    done();
  }
}





function setProgress(percent){
    $('.progress .bar').width(percent+'%');
}

function showLoading(){
  search.hide();
  loading.show();
  analysis.slideUp();
}

function done(){
  for (var i = 0; i < postIds.length; i++) {
    analysis.append('<li>'+postIds[i]+'</li>');
  }
  loading.hide();
  search.show();
  analysis.slideDown();

}

});


