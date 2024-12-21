<?php
include 'includes/header.php';
require 'config/database.php';

$sql = "SELECT * FROM blogs ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h1>Recent Blogs</h1>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</p>
                    <a href="blog.php?id=<?= $row['id'] ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
