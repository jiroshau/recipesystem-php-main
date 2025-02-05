<?php
include '../database/database.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];

    $stmt = $conn->prepare("INSERT INTO recipes (title, description, ingredients, instructions) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $title, $description, $ingredients, $instructions);

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
  <title>Add Recipe</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
</head>
<body>
  <div class="container mt-5">
    <h2>Add New Recipe</h2>
    <form action="create.php" method="POST">
      <div class="mb-3">
        <label for="title" class="form-label">Recipe Name</label>
        <input type="text" class="form-control" id="title" name="title" required>
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
      </div>
      <div class="mb-3">
        <label for="ingredients" class="form-label">Ingredients</label>
        <textarea class="form-control" id="ingredients" name="ingredients" rows="4" required></textarea>
      </div>
      <div class="mb-3">
        <label for="instructions" class="form-label">Instructions</label>
        <textarea class="form-control" id="instructions" name="instructions" rows="4" required></textarea>
      </div>
      <button type="submit" class="btn btn-success">Add Recipe</button>
    </form>
  </div>
</body>
</html>
