<?php
  $host = "localhost";
  $dbname = "lb1";
  $username = "root";
  $password = "";

  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_delete"])) {
      $employee_id = $_POST["employee_id"];

      $sql = "DELETE FROM employee WHERE employee_id = :employee_id";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':employee_id', $employee_id);

      if ($stmt->execute()) {
          header("Location: index.php");
          exit();
      } else {
          echo "Error deleting employee.";
      }
  }

  if (isset($_GET["employee_id"])) {
      $employee_id = $_GET["employee_id"];
      $sql = "SELECT * FROM employee WHERE employee_id = :employee_id";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':employee_id', $employee_id);
      $stmt->execute();
      $employee = $stmt->fetch(PDO::FETCH_ASSOC);
  } else {
      echo "Employee ID not provided.";
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Employee</title>
</head>

<body>
    <h2>Delete Employee</h2>
    <p>Are you sure you want to delete the following employee?</p>
    <form method="POST" action="delete.php">
        <input type="hidden" name="employee_id" value="<?php echo $employee['employee_id']; ?>">

        <p>Employee ID: <?php echo $employee['employee_id']; ?></p>
        <p>First Name: <?php echo $employee['first_name']; ?></p>
        <p>Last Name: <?php echo $employee['last_name']; ?></p>
        <button type="submit" name="submit_delete">Delete</button>
        <a href="index.php">Cancel</a>
    </form>
</body>

</html>
