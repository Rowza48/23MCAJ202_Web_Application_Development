<?php
// Database connection
$host = 'localhost';
$db = 'library';
$user = 'root';
$pass = ''; // Change if needed

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$conn->query("CREATE TABLE IF NOT EXISTS books (
    accession_number INT PRIMARY KEY,
    title VARCHAR(255),
    authors VARCHAR(255),
    edition VARCHAR(50),
    publisher VARCHAR(255)
)");

// Handle insert
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
    $accession_number = $_POST['accession_number'];
    $title = $_POST['title'];
    $authors = $_POST['authors'];
    $edition = $_POST['edition'];
    $publisher = $_POST['publisher'];

    $stmt = $conn->prepare("INSERT INTO books (accession_number, title, authors, edition, publisher) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $accession_number, $title, $authors, $edition, $publisher);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>Book added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $stmt->error . "</p>";
    }
    $stmt->close();
}

// Handle search
$search_results = [];
if (isset($_GET['search_title'])) {
    $search_title = $_GET['search_title'];
    $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE ?");
    $like = "%" . $search_title . "%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $search_results[] = $row;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Library Management</title>
</head>
<body>
    <h2>Enter Book Information</h2>
    <form method="post">
        <label>Accession Number:</label><input type="number" name="accession_number" required><br><br>
        <label>Title:</label><input type="text" name="title" required><br><br>
        <label>Authors:</label><input type="text" name="authors" required><br><br>
        <label>Edition:</label><input type="text" name="edition" required><br><br>
        <label>Publisher:</label><input type="text" name="publisher" required><br><br>
        <input type="submit" name="add_book" value="Add Book">
    </form>

    <hr>

    <h2>Search Book by Title</h2>
    <form method="get">
        <label>Title:</label><input type="text" name="search_title" required>
        <input type="submit" value="Search">
    </form>

    <?php if (!empty($search_results)) : ?>
        <h3>Search Results:</h3>
        <table border="1" cellpadding="5">
            <tr>
                <th>Accession Number</th>
                <th>Title</th>
                <th>Authors</th>
                <th>Edition</th>
                <th>Publisher</th>
            </tr>
            <?php foreach ($search_results as $book) : ?>
                <tr>
                    <td><?= htmlspecialchars($book['accession_number']) ?></td>
                    <td><?= htmlspecialchars($book['title']) ?></td>
                    <td><?= htmlspecialchars($book['authors']) ?></td>
                    <td><?= htmlspecialchars($book['edition']) ?></td>
                    <td><?= htmlspecialchars($book['publisher']) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif (isset($_GET['search_title'])) : ?>
        <p>No results found for "<?= htmlspecialchars($_GET['search_title']) ?>".</p>
    <?php endif; ?>

</body>
</html>

<?php $conn->close(); ?>
