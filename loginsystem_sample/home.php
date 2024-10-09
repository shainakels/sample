<?php
session_start();
include("db.php");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['content'])){
    $username=$_SESSION['username'];
    $content=$_POST['content'];

    $sql="INSERT INTO posts (username,content) VALUES('$username','$content')";

    if($conn->query($sql)===TRUE){
        $message="POSTING SUCCESS";
    }
}

$postsql="SELECT * FROM posts";
$postresults=$conn->query($postsql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>
    <h1>POSTS</h1>
    <?php if(isset($message)): ?>
        <h1><?php echo $message ?></h1>
    <?php endif; ?>
    <form method="post" action="home.php">
        Post Content:<input type="text" name="content"required>
        <input type="submit" value="Create Post">
    </form>
    <form method="post" action="logout.php">
        <input type="submit" value="LOGOUT">
    </form>

    <?php while($post=$postresults->fetch_assoc()): ?>
        <p>
            <b><?php echo $post['username'] ?></b><br><?php echo $post['content']?>
        </p>
    <?php endwhile; ?>
</body>
</html>