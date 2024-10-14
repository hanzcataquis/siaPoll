<?php
include '../config/db.php';

if (isset($_GET['category'])) {
    $category = $_GET['category'];

    $stmt = $conn->prepare("SELECT name, image FROM shop_products WHERE category = ?");
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
}
?>
