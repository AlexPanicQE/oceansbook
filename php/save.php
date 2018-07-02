<?php
// header('Content-type: text/xml');
header("Content-Type: application/json; charset=utf-8");

$link = mysqli_connect("mysql.hostinger.gr","u598479912_alexp","alexpanic2008","u598479912_books");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_error($link));
}


// build a PHP variable from JSON sent using POST method
// $v = json_decode(stripslashes(file_get_contents("php://input")));
$v=file_get_contents('php://input');
//convert json object to php associative array
$obj = json_decode($v,true);

/* insert data into DB */
$author = $obj['author'];
$title = $obj['title'];
$genre = $obj['genre'];
$price = $obj['price'];

// attempt insert query execution
$sql = "INSERT INTO books(author, title, genre, price) VALUES ('$author', '$title', '$genre', '$price')";

if(mysqli_query($link, $sql)){
  $response_array['status'] = 'success';

  echo json_encode($response_array);


} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    $response_array['status'] = 'error';
    echo json_encode($response_array);
}

// close connection
mysqli_close($link);

?>
