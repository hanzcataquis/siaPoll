<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            background-image: url('../uploads/2n1bg.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            color: white;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.7); 
            color: white;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.9); 
        }

        .card-header {
            background-color: rgba(0, 123, 255, 0.8); 
        }

        .btn {
            background-color: rgba(255, 255, 255, 0.3); 
            color: white;
            border: 1px solid white;
        }

        .btn:hover {
            background-color: rgba(255, 255, 255, 0.6); 
            color: black;
        }

        footer {
            background-color: rgba(0, 0, 0, 0.8); 
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            color: white;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#">2N1 Cafe Corp</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="add_product.php">Add New Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="analytics.php">View Analytics</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white text-center">
                    <h2>Welcome, Admin!</h2>
                </div>
                <div class="card-body text-center">
                    <p class="lead">Manage your cafe products and view survey analytics here.</p>
                    <a href="add_product.php" class="btn btn-success mb-3">Add New Product</a><br>
                    <a href="analytics.php" class="btn btn-info mb-3">View Survey Analytics</a><br>
                    <a href="logout.php" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-white text-center py-3 mt-5">
    <p>2N1 Cafe Corp © 2024. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
