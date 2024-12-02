<?php
$host = "localhost";
$dbname = "world";
$username = "lab5_user";
$password = "password123";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';

if ($lookup === 'cities') {
    $stmt = $conn->prepare("SELECT c.name AS city, c.district, c.population FROM cities c JOIN countries cs ON c.country_code = cs.code WHERE cs.name LIKE :country");
} else {
    $stmt = $conn->prepare("SELECT name, continent, independence_year, head_of_state FROM countries WHERE name LIKE :country");
}

$stmt->execute(['country' => "%$country%"]);
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($lookup === 'cities') {
    echo "<table>";
    echo "<tr><th>City</th><th>District</th><th>Population</th></tr>";
    foreach ($results as $row) {
        echo "<tr><td>{$row['city']}</td><td>{$row['district']}</td><td>{$row['population']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<table>";
    echo "<tr><th>Country</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
    foreach ($results as $row) {
        echo "<tr><td>{$row['name']}</td><td>{$row['continent']}</td><td>{$row['independence_year']}</td><td>{$row['head_of_state']}</td></tr>";
    }
    echo "</table>";
}
?>
