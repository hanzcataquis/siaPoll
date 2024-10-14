<?php
include '../config/db.php';

$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$category = $_POST['category'];
$product = $_POST['product'];
$size = $_POST['size'];

$query = "INSERT INTO survey_responses (name, age, gender, category, product, size, created_at) 
          VALUES ('$name', '$age', '$gender', '$category', '$product', '$size', NOW())";

if ($conn->query($query) === TRUE) {
    echo "Survey submitted successfully!";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
