<?php
  $host = "localhost";
  $dbname = "lb1";
  $username = "root";
  $password = "";

  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_update"])) {
      $employee_id = $_POST["employee_id"];
      $first_name = $_POST["first_name"];
      $last_name = $_POST["last_name"];
      $position = $_POST["position"];
      $office_id = $_POST["office_id"];
      $category = $_POST["category"];

      if (empty($first_name) || empty($last_name) || empty($position) || empty($office_id) || empty($category)) {
          echo "All fields are required.";
      } else {
          $sql = "UPDATE employee SET
                  first_name = :first_name,
                  last_name = :last_name,
                  position = :position,
                  office_id = :office_id,
                  category = :category
                  WHERE employee_id = :employee_id";

          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':first_name', $first_name);
          $stmt->bindParam(':last_name', $last_name);
          $stmt->bindParam(':position', $position);
          $stmt->bindParam(':office_id', $office_id);
          $stmt->bindParam(':category', $category);
          $stmt->bindParam(':employee_id', $employee_id);

          if ($stmt->execute()) {
              header("Location: index.php");
              exit();
          } else {
              echo "Error updating employee.";
          }
      }
  }

  if (isset($_GET["employee_id"])) {
      $employee_id = $_GET["employee_id"];
      $sql = "SELECT * FROM employee WHERE employee_id = :employee_id";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':employee_id', $employee_id);
      $stmt->execute();
      $employee = $stmt->fetch(PDO::FETCH_ASSOC);
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
</head>

<body>
    <h2>Edit Employee</h2>
    <form method="POST" action="edit.php">
        <input type="hidden" name="employee_id" value="<?php echo $employee['employee_id']; ?>">
        <input type="text" name="first_name" value="<?php echo $employee['first_name']; ?>" placeholder="First Name">
        <input type="text" name="last_name" value="<?php echo $employee['last_name']; ?>" placeholder="Last Name">
        <input type="text" name="position" value="<?php echo $employee['position']; ?>" placeholder="Position">
        <input type="text" name="office_id" value="<?php echo $employee['office_id']; ?>" placeholder="Office ID">
        <input type="text" name="category" value="<?php echo $employee['category']; ?>" placeholder="Category">
        <button type="submit" name="submit_update">Update</button>
    </form>
</body>

</html>
