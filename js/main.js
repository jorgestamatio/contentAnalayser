$(document).ready(new function() {

  var loading = $('#loading'),
      search = $('#search'),
      analysis = $('#analysis'),
      postIds = [],
      messages = '',
      countIds = 0,
      progress = 0,
      today = Math.round(+new Date()/1000);
      limitPast = '',
      hitLimit = false,
      baseUrl = 'https://graph.facebook.com/',
      queryDataType = '/posts/'
      queryParameters = '?fields=id,message,likes,comments,shares,type,caption,name&limit=50&date_format=U&access_token=';


// Capture filter click events.
$('#getAnalysis').click(function(e){
  e.preventDefault();
  var page = $('#page').val(),
      token = $('#token').val(),
      days = $('#days').val(),
      url = baseUrl+page+queryDataType+queryParameters+token;

  if(page === '' || token === ''){
    return;
  }else{
    showLoading();
    getRange(days);
    getIds(url);
  }


});

$('#getLink').click(function(e){
  e.preventDefault();
  var page = $('#page').val(),
      token = $('#token').val(),
      days = $('#days').val(),
      url = baseUrl+page+queryDataType+queryParameters+token;

  if(page == '' || token == ''){
    return;
  }else{
    getRange(days);
    $('.link').html('<div class="well"><a href="'+url+'" target="_blank">'+url+'</a></div>')
  }


});


function getIds (url) {
  showStatus('Getting ids...');
  progress += 10;
  setProgress(progress);
  $.get(
    url,
    function(data) {
      parseIds(data);
    }
  );
}


function parseIds(json){
  $.each(json.data, function(i, post){
    if(post.created_time > limitPast){

      if(post.type == 'link'){
        //post.name; //Name of the link
        //post.caption; //pointing site
      }

      if(post.type == 'photo'){
        //nothing special
      }

      postIds.push(post.id);

      progress++;
      setProgress(progress);
    }else{
      hitLimit = true;
    }
  });


  if(hitLimit === false){
    var nextPage = json.paging.next;
    getIds(nextPage);
  }else{
    showStatus('Done!');
    setProgress('100');
    done();
    //getPostData(postIds);
  }
}




function getRange (days) {
  limitPast = today - (days*86400);
}


function setProgress(percent){
  $('.progress .bar').width(percent+'%');
}

function showStatus(status){
  $('.loadingText').html(status);
}

function showLoading(){
  showStatus('Loading...');
  search.hide();
  loading.show();
  analysis.slideUp();
}

function done(){
  for (var i = 0; i < postIds.length; i++) {
    analysis.append('<li>'+postIds[i]+'</li>');
  }
  //analysis.html(messages);
  loading.hide();
  search.show();
  analysis.slideDown();

}

});

FB.api('/me', function(response) {
  alert('Your name is ' + response.name);
});
