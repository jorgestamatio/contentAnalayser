$(document).ready(new function() {

  var loading = $('#loading'),
      search = $('#search'),
      analysisContainer = $('#analysisContainer'),
      analysis = $('#analysis'),
      postIds = [],
      totalLikes = 0,
      comments = [],
      likes = [],
      pageTitle = '',
      csv = '',
      progress = 0,
      today = Math.round(+new Date()/1000);
      limitPast = '',
      hitLimit = false,
      baseUrl = 'https://graph.facebook.com/',
      queryDataType = '/posts/'
      queryParameters = '?fields=id,message,likes,comments,shares,type,caption,name&limit=50&date_format=U&access_token=',
      links = 0,
      photos = 0,
      videos = 0,
      statuses = 0,
      other = 0,
      graphsWidth = $('#graphs').width(),
      likesGraphWidth = (0.6*graphsWidth)-20,
      typesGraphWidth = (0.4*graphsWidth)-20;

$('#likesGraph').css({'width':likesGraphWidth});
$('#typesGraph').css({'width':typesGraphWidth});



// Capture filter click events.
$('#getAnalysis').click(function(e){
  e.preventDefault();
  var page = $('#page').val(),
      token = $('#token').val(),
      days = $('#days').val(),
      url = baseUrl+page+queryDataType+queryParameters+token;

      pageTitle = page;
  if(page === '' || token === ''){
    return;
  }else{
    showLoading();
    getRange(days);
    getPosts(url);
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


function getPosts (url) {
  showStatus('Getting posts...');
  progress += 10;
  setProgress(progress);
  $.get(
    url,
    function(data) {
      parsePosts(data);
    }
  );
}


function parsePosts(json){

  var createdDate = '',
        postType = '',
        postName = 'none';
        likesCount = 0,
        sharesCount = 0,
        commentCount = 0,
        commentsCount = 0,
        message = 'none',
        hashtags = '',
        messageLength = 0;

  showStatus('Analysing posts...');
  $.each(json.data, function(i, post){
    if(post.created_time > limitPast){
      postIds.push(post.id);
      //console.log(post.id);
      //Id
      //csv += post.id+'|';

      //Type
      postType = post.type;


      //Created_time
      createdDate = new Date(post.created_time * 1000);
      createdDate = createdDate.format('d.m.y');

      //likes
      if(post.likes){
          if(post.likes.count){
            likesCount = post.likes.count;
            likes.push(post.likes.count);
            totalLikes += post.likes.count;
          }else{
            likesCount = 0;
            likes.push('0');
          }
      }else{
            likesCount = 0;
            likes.push('0');
      }


      //Shares
      if(post.shares){
        if(post.shares.count){
          sharesCount = post.shares.count;
        }
      }else{
        sharesCount = 0;
      }


      //comments
      if(post.comments){
        $.each(post.comments.data,function(i,comment){
          if(comment.id){
            commentCount++;
          }
        });
        comments.push(commentCount);
      }else{
        comments.push(commentCount);
      }
      
   
      //If Link get Name
      if(post.type == 'link'){
        links++;
        //csv += post.name + '|'; //Name of the link
        postName = post.name;
        //csv += post.caption + '|'; //pointing site
      }else{
        //csv += 'none|'; //Name of the link
        postName = 'none';
        //csv += 'none|'; //pointing site
      }


      if(post.type == 'link'){
        links++;
      }else if(post.type == 'photo'){
        photos++;
      }else if(post.type == 'status'){
        statuses++;
      }else if(post.type == 'video'){
        videos++;
      }else{
        other++;
      }



      if(post.message){
        message = post.message;
        message = message.replace(/(\r\n|\n|\r)/gm,"");
        messageLength = message.length;
      }else{
        message = 'none';
        messageLength = 0;
      }



      //Hashtags
      var hashtagCount = message.split("#").length - 1;
      if(hashtagCount>0){
        hashtags = '1';
      }
      else{
        hashtags = '0';
      }

      //Link in message
      var linkMsgCount = message.split('http').length - 1;
      if(linkMsgCount > 0){
        linkInMsg = '1';
      }else{
        linkInMsg = '0';
      }



      //CSV
      csv += pageTitle+'|';
      csv += createdDate+'|';
      csv += messageLength+'|';
      csv += likesCount+'|';
      csv += sharesCount+'|';
      csv += commentCount+'|';
      csv += postType+'|';
      //pointing link
      csv += hashtags+'|';
      csv += linkInMsg+'|';
      csv += postName+'|';
      csv += message+'|';



      //New csv line
      csv += "\r\n";
      //csv += "<br>";

      progress+=5;
      setProgress(progress);
    }else{
      hitLimit = true;
    }
  });


  if(hitLimit === false){
    var nextPage = json.paging.next;
    getPosts(nextPage);
  }else{
    showStatus('Done!');
    setProgress('100');
    done();
    //getPostData(postIds);
  }
}


function showInfo () {
  $('#numberPosts').html(postIds.length);
  $('#totalLikes').html(totalLikes);
  $('#info').show();
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
  analysisContainer.slideUp();
}

function done(){
  // for (var i = 0; i < postIds.length; i++) {
  //   //analysis.append('<li>'+postIds[i]+'</li>');
  // }
  analysis.val(csv);
  loading.hide();
  search.show();
  //analysis.slideDown();
  graphLikes(likes,comments,likesGraphWidth);
  graphTypes(links,photos,videos,statuses,other,typesGraphWidth);
  showInfo();
  //$('#graphs').show();
  $('#showCsv').show();
  $('#getAnalysis').hide();
  $('#newAnalysis').show();
}

$('#showCsv').click(function(){
  analysisContainer.slideToggle();
})

});










