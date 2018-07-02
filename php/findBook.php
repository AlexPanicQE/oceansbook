<?php
// header('Content-type: text/xml');
header("Content-Type: application/json; charset=utf-8");

$link = mysqli_connect("mysql.hostinger.gr","u598479912_alexp","alexpanic2008","u598479912_books");

if($link === false){
    die("ERROR: Could not connect. " . mysqli_error($link));
}

$keyword = $_GET['keyword'];

$query = "SELECT *
        FROM books
      WHERE MATCH (author, title, genre, price)
      AGAINST ('".$keyword."' IN BOOLEAN MODE)";
$queryResult = mysqli_query($link, $query);
if (!$queryResult) die( 'Invalid query: '. mysql_error() );

//If result arrray isn't empty
if ( mysqli_num_rows($queryResult) > 0 ) {

$myArray=array();

  while($row = $queryResult->fetch_array(MYSQL_ASSOC)) {
            $myArray[] = $row;
    }
    //smooth json format preview
    $json_string = json_encode($myArray, JSON_PRETTY_PRINT);

    echo $json_string;


} else {
  $response_arr['status'] = 'error';
  echo json_encode($response_arr);
}
mysqli_free_result($queryResult);
// close connection
mysqli_close($link);

?>
