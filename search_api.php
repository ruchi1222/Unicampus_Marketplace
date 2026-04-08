<?php
header('Content-Type: application/json');
$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q === '') {
    echo json_encode([]);
    exit;
}

require_once 'db.php';

$stmt = $conn->prepare("SELECT product_name as name, category FROM product WHERE product_name LIKE ? LIMIT 10");
$searchTerm = "%" . $q . "%";
$stmt->bind_param("s", $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = [
        "name" => $row['name'],
        "link" => "view_category.php?cat=" . urlencode($row['category'])
    ];
}

echo json_encode($items);

$stmt->close();
$conn->close();
?>
