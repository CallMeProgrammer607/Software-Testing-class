<?php

/**
 * Get the database connection
 * @return object connection to a mysql server
 */
$errors =[];
$title = '';
$content = '';
$published_at = '';

 require 'database.php'; 
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $tiltle = $_POST['title'];
    $content = $_POST['content'];
    $published_at = $_POST['published_at'];
    
    if ($tiltle == '') {
        $errors[] = 'Title is required';
    }
    

    if($content == ''){
     $errors[] ='Please the content area can not be be empty';
    }

    if ($published_at != '') {
        $date_time = date_create_from_format('Y-m-d\TH:i', $published_at);
        if ($date_time === false) {
            $errors[] = "Invalid date and time";
        } else {
            $date_errors = date_get_last_errors();
            if ($date_errors !== false && $date_errors['warning_count'] > 0) {
                $errors[] = "Invalid date and time";
            }
        }
    }
    
    
 if(empty($errors)){

     $conn =getDB();

    $sql = "INSERT INTO  article (title, content, published_at)
    VALUES(?, ?,?)";

    $stmt = mysqli_prepare($conn, $sql);
    
    if($stmt === false){
        echo mysqli_error($conn) ; 
    }
    else{
     if($published_at ==''){
        $published_at=null;
     }
        
        mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

    if(mysqli_stmt_execute($stmt)){
       $id = mysqli_insert_id($conn);
       echo "Inserted record with ID: $id";
    }
    else{
        echo mysqli_stmt_error($stmt);
    }
}
}
}


?>
<?php require 'header.php'; ?>
<div class="navbar bg-base-100">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl">New Article</a>
  </div>
  <div class="flex-none">
    <button class="btn btn-square btn-ghost">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"></path></svg>
    </button>
  </div>
</div><?php if(!empty($errors)): ?>
    <ul>
        <?php foreach($errors as $errors): ?>
            <li><?= $errors ?></li>
            <?php endforeach ?>
    </ul>
<?php endif ?>
<form method="post" class="grid justify-center items-center">
    
<div class="my-2">
    <div>

        <label form="title">Title</label>
    </div>
    <div>

        <input class="input input-bordered" type="text" id="title" name="title" placeholder="Article Title" value="<?= htmlspecialchars($title); ?>" >
    </div>
</div>

<div class="my-2">
    <div>

        <label for="content">Content</label>
    </div>

    <div>

        <textarea class="textarea textarea-bordered" name="content" id="content" cols="40" rows="4" placeholder="Article content"<?= htmlspecialchars($content); ?> ></textarea>
    </div>
</div>

<div class="my-2">
    <div>

        <label for="published_at">Publication date and time</label>
    </div>

    <div>

        <input class="input input-bordered" type="datetime-local" name="published_at" id="published_at" value="<?= htmlspecialchars($published_at); ?>">
    </div>
</div>
<button class="btn btn-primary self-center mx-12 mt-5">Add</button>

</form>

<?php require 'footer.php'; ?>