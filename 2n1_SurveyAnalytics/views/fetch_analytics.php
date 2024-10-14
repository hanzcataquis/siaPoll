<?php
include '../config/db.php';

$analytics = [];

$sql = "SELECT category, COUNT(*) as total FROM survey_responses GROUP BY category";
$result = $conn->query($sql);
$analytics['categories'] = [];
while ($row = $result->fetch_assoc()) {
    $analytics['categories'][] = $row;
}

$sql = "SELECT category, product, COUNT(*) as total FROM survey_responses GROUP BY category, product";
$result = $conn->query($sql);
$analytics['products'] = [];
while ($row = $result->fetch_assoc()) {
    $analytics['products'][] = $row;
}

$sql = "SELECT product, size, COUNT(*) as total FROM survey_responses GROUP BY product, size";
$result = $conn->query($sql);
$analytics['sizes'] = [];
while ($row = $result->fetch_assoc()) {
    $analytics['sizes'][] = $row;
}

$sql = "SELECT gender, COUNT(*) as total FROM survey_responses GROUP BY gender";
$result = $conn->query($sql);
$analytics['gender'] = [];
while ($row = $result->fetch_assoc()) {
    $analytics['gender'][] = $row;
}

$sql = "
    SELECT CASE 
        WHEN age BETWEEN 18 AND 25 THEN '18-25'
        WHEN age BETWEEN 26 AND 35 THEN '26-35'
        WHEN age BETWEEN 36 AND 45 THEN '36-45'
        ELSE '45+' 
    END as age_group, COUNT(*) as total 
    FROM survey_responses GROUP BY age_group";
$result = $conn->query($sql);
$analytics['age'] = [];
while ($row = $result->fetch_assoc()) {
    $analytics['age'][] = $row;
}

header('Content-Type: application/json');
echo json_encode($analytics);
$conn->close();
?>
