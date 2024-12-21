<?php
include 'includes/header.php';
require 'config/database.php';

if (isset($_GET['id'])) {
    $blog_id = $_GET['id'];

    // Prepare and execute the query to fetch the specific blog post
    $stmt = $conn->prepare("SELECT * FROM blogs WHERE id = ?");
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $blog = $stmt->get_result()->fetch_assoc();

    if (!$blog) {
        echo "<div class='container mt-5'><h1>Blog not found</h1></div>";
        include 'includes/footer.php';
        exit;
    }
} else {
    header('Location: index.php'); // Redirect to homepage if no ID is provided
    exit;
}
?>

<div class="container mt-5">
    <h1><?= htmlspecialchars($blog['title']) ?></h1>
    <p><small>Published on <?= htmlspecialchars($blog['created_at']) ?></small></p>
    <div>
        <p><?= nl2br(htmlspecialchars($blog['content'])) ?></p>
    </div>
    <div>
        <a href="index.php" class="btn btn-secondary mt-3">Back to Blogs</a>
        <button id="printButton" class="btn btn-success mt-3">Print as PDF</button>
    </div>
</div>


<?php include 'includes/footer.php'; ?>

<script>
    document.getElementById('printButton').addEventListener('click', function () {
        window.print();
    });
</script>

