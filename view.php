<?php
include 'Database.php';
include 'Blog.php';

$db = new Database();
$blog = new Blog($db->conn);

if (isset($_GET['id'])) {
    $post = $blog->readOne($_GET['id']);
}
?>

<h1><?php echo $post['title']; ?></h1>
<p><?php echo $post['content']; ?></p>
<a href="index.php">Back to Home</a>
