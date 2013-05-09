<?php 

date_default_timezone_set('Europe/Berlin');
setlocale(LC_TIME, "fr_FR");

$access_token = $_POST['tk'];
$page = $_POST['page'];

$result = '';
$csv = '';
//$access_token = $params['access_token'];


//$access_token = 'CAAHUqTfdENsBADqx4TBSCapATANfa1jkdvoZAWgfH1B4ZAcUGGXb5LE1U3RGfeZBcxVeythNb00qb3MHkoOmZCzxw92ChgkVGYwjChIAx6f5TfQNFUtA3vxQRv9ZAICfm5ZCaPTe1iiy2mYh6JjHaOwKnZCnLTt1ZAqdyVzUUbeyVwZDZD';
        
$graph_url = "https://graph.facebook.com/".$page."/posts?access_token=". $access_token;



//$page_posts = json_decode(file_get_contents($graph_url), true);

$page_posts = file_get_contents($graph_url);

//print_r ($page_posts);



echo $page_posts;
//echo $csv;
 ?>
