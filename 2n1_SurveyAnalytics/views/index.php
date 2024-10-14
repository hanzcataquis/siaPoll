<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2N1 Cafe Corp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
    body {
        background-image: url('../uploads/2n1bg.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white;
    }

    .navbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        background-color: rgba(0, 0, 0, 0.8); 
    }

    h1, h2, h3, p {
        color: white;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.1);
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card img {
        width: 200px; 
        height: auto;
        object-fit: contain;
        margin: auto; 
        display: block;
        padding: 10px;
    }

    .card-body {
        text-align: center;
        padding: 15px;
    }

    .modal-dialog {
        max-width: 400px; 
    }

    .modal-content {
        background-color: rgba(0, 0, 0, 0.7); 
        color: white;
    }

    .modal-header {
        border-bottom: 1px solid #ccc; 
        padding: 1rem; 
    }

    .modal-title {
        font-weight: 600; 
    }

    .modal-body {
        padding: 1.5rem; 
    }

    .modal-footer {
        border-top: 1px solid #ccc; 
        padding: 1rem; 
    }

    .btn-primary {
        background-color: #007bff; 
        border-color: #007bff; 
    }

    .btn-primary:hover {
        background-color: #0056b3; 
        border-color: #0056b3;
    }

    .selected-product-card {
        border: 2px solid #007bff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
    }

    .product-image {
        cursor: pointer; 
        border: 2px solid transparent; 
        transition: border-color 0.3s; 
    }

    .product-image:hover {
        border-color: #007bff; 
    }

    .selected-image {
        max-width: 100%; 
        height: auto; 
    }

    footer {
        background-color: rgba(0, 0, 0, 0.8);
        padding: 20px;
        color: white;
        text-align: center;
    }
</style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">2N1 Cafe Corp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Products</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#Iced-Coffee">Iced Coffee</a></li>
                        <li><a class="dropdown-item" href="#Non-Coffee">Non Coffee</a></li>
                        <li><a class="dropdown-item" href="#Frappe">Frappe</a></li>
                        <li><a class="dropdown-item" href="#Float">Float</a></li>
                        <li><a class="dropdown-item" href="#Milktea">Milktea</a></li>
                        <li><a class="dropdown-item" href="#Fruit-Yogurt">Fruit Yogurt</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#surveyModal">Survey</a></li>
                <li class="nav-item"><a class="nav-link" href="login.php">Admin Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<section id="home" class="container mt-5">
    <h1>Welcome to 2N1 Cafe Corp</h1>
    <p>Your favorite coffee shop with a twist!</p>
</section>

<section id="products" class="container mt-5">
    <h2>Our Products</h2>

    <?php
    include '../config/db.php';
    
    $categoryQuery = "SELECT DISTINCT category FROM shop_products ORDER BY category";
    $categoryResult = $conn->query($categoryQuery);

    if ($categoryResult->num_rows > 0) {
        while ($categoryRow = $categoryResult->fetch_assoc()) {
            $category = $categoryRow['category'];

            echo "<h3 id='".str_replace(" ", "-", $category)."'>$category</h3>";
            echo "<div class='row'>";
            
            $productQuery = "SELECT * FROM shop_products WHERE category = '$category'";
            $productResult = $conn->query($productQuery);

            while ($productRow = $productResult->fetch_assoc()) {
                echo "<div class='col-md-4'>
                        <div class='card mb-4'>
                            <img src='../uploads/{$productRow['image']}' class='card-img-top' alt='{$productRow['name']}'>
                            <div class='card-body'>
                                <h5 class='card-title'>{$productRow['name']}</h5>
                            </div>
                        </div>
                      </div>";
            }

            echo "</div>";  
        }
    } else {
        echo "<p>No products available at the moment.</p>";
    }
    ?>
</section>

<div class="modal fade" id="surveyModal" tabindex="-1" aria-labelledby="surveyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="surveyModalLabel">Customer Survey</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="surveyForm">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="age" class="form-label">Age</label>
            <input type="number" class="form-control" id="age" name="age" required>
          </div>
          <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" id="gender" name="gender" required>
              <option value="">Select Gender</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
              <option value="Other">Other</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="category" class="form-label">Which category do you mostly purchase?</label>
            <select class="form-select" id="category" name="category" required onchange="loadProducts(this.value)">
              <option value="">Select Category</option>
              <option value="Iced Coffee">Iced Coffee</option>
              <option value="Non Coffee">Non Coffee</option>
              <option value="Frappe">Frappe</option>
              <option value="Float">Float</option>
              <option value="Milktea">Milktea</option>
              <option value="Fruit Yogurt">Fruit Yogurt</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="product" class="form-label">Choose a product</label>
            <div class="row" id="product-container">
              <p>Select a category to see products.</p>
            </div>
            <input type="hidden" id="selected-product-name" name="product" required>
            <div id="selected-product" class="text-center mt-3"></div>
          </div>
          <div class="mb-3">
            <label for="size" class="form-label">Choose a size</label>
            <select class="form-select" id="size" name="size" required>
              <option value="Small">Small</option>
              <option value="Medium">Medium</option>
              <option value="Large">Large</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit Survey</button>
        </form>
      </div>
    </div>
  </div>
</div>

<footer class="text-white text-center py-3 mt-5">
    <p>2N1 Cafe Corp © 2024. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/scripts.js"></script>
</body>
</html>
