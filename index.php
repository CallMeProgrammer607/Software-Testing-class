<?php
include 'databse.php';


$sql ="SELECT *
FROM article
ORDER BY published_at; " ;
$results = mysqli_query($conn, $sql) ;

if($results === false){
    echo mysqli_error($conn) ; 
}
else{
    $articles= mysqli_fetch_all($results, MYSQLI_ASSOC);
}
     





 ?>
<?php include 'header.php'; ?>
            <?php if(empty($articles)): ?>

                <p>No articles found.</p>
                <?php else: ?>
            <ul>
                <?php foreach ($articles as $article): ?>
                <li>
                    <article>
                        <h2> <?php echo $article['title']; ?></h2>
                        <p><?php echo $article["content"]?></p>
                    </article>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
   <?php include 'footer.php'; ?>