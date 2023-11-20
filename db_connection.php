<?php
include'databse.php';

$sql ="SELECT *
FROM article
ORDER BY published_at; " ;
$results = mysqli_query($conn, $sql) ;

if($results === false){
    echo mysqli_error($conn) ; 
}
else{
    $articles= mysqli_fetch_all($results, MYSQLI_ASSOC);
var_dump($articles);
}
     





 ?>

