<?php 

date_default_timezone_set('Europe/Berlin');
setlocale(LC_TIME, "fr_FR");

$access_token = $_POST['tk'];
$page = $_POST['page'];

$result = '';
$csv = '';
//$access_token = $params['access_token'];


//$access_token = 'CAAHUqTfdENsBADqx4TBSCapATANfa1jkdvoZAWgfH1B4ZAcUGGXb5LE1U3RGfeZBcxVeythNb00qb3MHkoOmZCzxw92ChgkVGYwjChIAx6f5TfQNFUtA3vxQRv9ZAICfm5ZCaPTe1iiy2mYh6JjHaOwKnZCnLTt1ZAqdyVzUUbeyVwZDZD';
        
$graph_url = "https://graph.facebook.com/".$page."/posts?limit=10&access_token=". $access_token;



$page_posts = json_decode(file_get_contents($graph_url), true);

//print_r ($page_posts);


foreach($page_posts['data'] as $post){

    $result .= '<div class="well">';

    // Post variables /////////////////////////
    $post_id = $post['id']; 
    $link = $post['link']; 
    $message = $post['message'];
    $post_time = $post['updated_time'];
    $post_time = strtotime($post_time);
    $post_date = date("d-m-Y", $post_time);
    $post_hour = date("g:i a", $post_time);
    $object_id = $post['object_id'];
    $comments = $post['comments'];
    $likes = $post['likes']; 
    $type = $post['type'];
    $result .= '<h2>'. $post_date .'</h2>';
    $result .= '<h4>'.$message.'</h4>';
    $result .= '<h4>post type: '.$type.'</h4>';
    // END Post variables /////////////////////////
    // Post messsage /////////////////////////
    $message_words = str_word_count_utf8($message);
    $message_characters = strlen($message);
    $result .= '<h4>words: '.$message_words.'</h4>';
    $result .= '<h4>words: '.$message_characters.'</h4>';
    // END Post messsage /////////////////////////
    // Mentions /////////////////////////    
    if($post['to']){
        $post_mentions = $post['to'];
        foreach($post_mentions['data'] as $mention){
            $mentions .= $mention['name'] . ' '; 
        }
    }else{
        $mentions = 'none';
    }

    $result .= '<h4>mentions: ' . $mentions . '</h4>';
    // END Mentions /////////////////////////
    //Likes ///////////////////////////////////
    $totalLikes = $likes['count'];
    $result .= '<h4>likes: ' . $totalLikes . '</h4>';
    if($totalLikes > 0){
        foreach($likes['data'] as $like){
            $name = $post['name'];
            //$result .= '<li>' . $name . ' said ' . $message . '</li>';
        }
    }  
    // END Likes ///////////////////////////////////
   
    // Shares //////////////////////////////////
    //
    //
    if($post['shares']){
        $post_shares = $post['shares']['count'];
        $result .= '<h4>Post shares:' . $post_shares . '</h4>';
    }
    // 
    //
    if($post['type'] == 'link'){
        $sharesUrl = 'http://graph.facebook.com/?id='.$link; 
        $link_shares = json_decode(file_get_contents($sharesUrl), true);

        $result .= '<h4>Link shares:' . $link_shares['shares'] . '</h4>';
    }
    // END Shares //////////////////////////////////

    // Comments //////////////////////////////
    $totalComments = count($comments);
    if($totalComments > 0){
    $result .= '<h4>comments:</h4><ul>';
        foreach($comments['data'] as $comment){
            $name = $comment['from']['name'];
            $message = $comment['message'];
            
            
            $result .= '<li>' . $name . ' said ' . $message . '</li>';
        }
    $result .= '</ul>';
    }
        
    // Comments //////////////////////////////


    $csv .= $post_date . '|';
    $csv .= $post['type'] . '|';
    $csv .= $message_words . '|';
    $csv .= $message_characters . '|';
    $csv .= $totalLikes . '|';
    $csv .= $post_shares . '|';
    $csv .= $totalComments . '|';

    $csv .='\r\n';


    $result .= '</div>';
}   

//functions
  function str_word_count_utf8($str) {
        return count(preg_split('~[^\p{L}\p{N}\']+~u',$str));
    } 

echo $result;
 ?>
