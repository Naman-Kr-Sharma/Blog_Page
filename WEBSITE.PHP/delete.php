<?php
include 'Database.php';
include 'Blog.php';

$db = new Database();
$blog = new Blog($db->conn);

if (isset($_GET['id'])) {
    if ($blog->delete($_GET['id'])) {
        echo "Blog post deleted successfully.";
        header("Location: index.php");
    } else {
        echo "Error deleting blog post.";
    }
}
?>
