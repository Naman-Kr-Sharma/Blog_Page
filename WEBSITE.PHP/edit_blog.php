<?php
// Include database connection
include('Database.php');

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input
    $id = intval($_POST['id']); // Sanitize the ID
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);

    // Basic validation
    if (empty($title) || empty($content)) {
        die("Title and content cannot be empty.");
    }

    // Update the blog post
    $sql = "UPDATE blogs SET title = ?, content = ?, updated_at = NOW() WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $content, $id);

    if ($stmt->execute()) {
        // Redirect back to the blog post after a successful update
        header("Location: blog.php?id=$id");
        exit;
    } else {
        // Error handling
        echo "Error updating the blog post: " . $stmt->error;
    }
    $stmt->close();
} else {
    // Redirect if accessed without POST
    header("Location: index.php");
    exit;
}
?>
