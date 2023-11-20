<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
    var_dump($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
<div>
    Postcode: <input name="postcode" required>
    </div>

<div>
    email: <input type="email" name="email" required >
</div>

<div>
    url:<input type="url" name="url" required>
    </div>

    <div>
    number:<input type="number" name="count" min="10" max="25">
    </div>
    <button>Send</button>

    </form>

</body>
</html>