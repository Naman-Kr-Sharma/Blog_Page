<?php 
include('Database.php'); // Include database connection

// Check if the blog post ID is set and valid
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convert the ID to integer for safety
    // Prepare the SQL query to fetch the blog post by ID
    $sql = "SELECT * FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql); // Prepare statement to prevent SQL injection
    $stmt->bind_param("i", $id);  // Bind the ID parameter as an integer
    $stmt->execute(); // Execute the query
    $result = $stmt->get_result(); // Get the result set

    // Check if the result has any rows
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); // Fetch the blog post details
        // Sanitize and assign values to variables
        $title = htmlspecialchars($row['title']);
        $content = htmlspecialchars($row['content']);
        $createdAt = htmlspecialchars($row['created_at']);
    } else {
        // Handle the case where the blog post is not found
        die("Blog post not found.");
    }

    // Close the statement
    $stmt->close();
} else {
    die("Invalid blog post ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $title; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="index.php">My Blog</a>
    </div>
  </nav>

  <!-- Blog Post Content -->
  <div class="container mt-4">
    <h1><?php echo $title; ?></h1>
    <p class="text-muted"><em>Posted on: <?php echo $createdAt; ?></em></p>
    <p><?php echo nl2br($content); ?></p>
    <!-- Back to Home Button -->
    <a href="index.php" class="btn btn-outline-primary mt-3">Back to Home</a>
    <!-- Button to trigger the edit blog modal -->
    <button class="btn btn-outline-secondary mt-3" data-bs-toggle="modal" data-bs-target="#editBlogModal">Edit Blog</button>
  </div>

  <!-- Edit Blog Modal -->
  <div class="modal fade" id="editBlogModal" tabindex="-1" aria-labelledby="editBlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editBlogModalLabel">Edit Blog Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Form for editing blog -->
          <form method="POST" action="edit_blog.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="mb-3">
              <label for="editBlogTitle" class="form-label">Title</label>
              <input type="text" class="form-control" id="editBlogTitle" name="title" value="<?php echo $title; ?>" required>
            </div>
            <div class="mb-3">
              <label for="editBlogContent" class="form-label">Content</label>
              <textarea class="form-control" id="editBlogContent" name="content" rows="6" required><?php echo $content; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
