<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $image = $_FILES['image']['name'];
    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($image);

    $sql = "INSERT INTO shop_products (name, category, image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $category, $image);

    if ($stmt->execute() && move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        echo "<script>alert('Product added successfully!');</script>";
    } else {
        echo "<script>alert('Error adding product.');</script>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            background-color: #f8f9fa; 
        }
        .container {
            max-width: 600px;
        }
        #imagePreview {
            max-width: 100%; 
            height: auto; 
            display: none; 
            margin-top: 15px; 
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">2N1 Cafe Corp</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="admin_dashboard.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="analytics.php">View Analytics</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Add New Product</h2>
    <form action="add_product.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category" required>
                <option value="Iced Coffee">Iced Coffee</option>
                <option value="Non Coffee">Non Coffee</option>
                <option value="Frappe">Frappe</option>
                <option value="Float">Float</option>
                <option value="Milktea">Milktea</option>
                <option value="Fruit Yogurt">Fruit Yogurt</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" class="form-control" name="image" accept="image/*" required onchange="previewImage(event)">
        </div>
        <img id="imagePreview" src="" alt="Image Preview">
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function previewImage(event) {
        const preview = document.getElementById('imagePreview');
        preview.src = URL.createObjectURL(event.target.files[0]);
        preview.style.display = 'block'; 
    }
</script>
</body>
</html>
