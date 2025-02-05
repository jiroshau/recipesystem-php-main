<?php
// Include database connection
include '../database/database.php';

// Get the recipe ID from the URL
$id = $_GET['id'];

// Fetch the recipe from the database
$res = $conn->query("SELECT * FROM recipes WHERE id = $id");
$row = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];

    $stmt = $conn->prepare("UPDATE recipes SET title = ?, description = ?, ingredients = ?, instructions = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $title, $description, $ingredients, $instructions, $id);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Update Recipe</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
</head>
<body>
  <div class="container mt-5">
    <h2>Update Recipe</h2>
    <form action="update.php?id=<?= $row['id']; ?>" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Recipe Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $row['title']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" required><?= $row['description']; ?></textarea>
      </div>
      <div class="mb-3">
        <label for="ingredients" class="form-label">Ingredients</label>
        <textarea class="form-control" id="ingredients" name="ingredients" rows="4" required><?= $row['ingredients']; ?></textarea>
      </div>
      <div class="mb-3">
        <label for="instructions" class="form-label">Instructions</label>
        <textarea class="form-control" id="instructions" name="instructions" rows="4" required><?= $row['instructions']; ?></textarea>
      </div>
      <button type="submit" class="btn btn-success">Update Recipe</button>
    </form>
  </div>
</body>
</html>
