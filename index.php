<?php
  $host = "localhost";
  $dbname = "lb1";
  $username = "root";
  $password = "";

  $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $first_name = $_POST["first_name"];
      $last_name = $_POST["last_name"];
      $position = $_POST["position"];
      $office_id = $_POST["office_id"];
      $category = $_POST["category"];


      if (empty($first_name) || empty($last_name) || empty($position) || empty($office_id) || empty($category)) {
        echo "All fields are required.";
      } else {
          $sql = "INSERT INTO employee (first_name, last_name, position, office_id, category) 
                  VALUES (:first_name, :last_name, :position, :office_id, :category)";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':first_name', $first_name);
          $stmt->bindParam(':last_name', $last_name);
          $stmt->bindParam(':position', $position);
          $stmt->bindParam(':office_id', $office_id);
          $stmt->bindParam(':category', $category);

          if ($stmt->execute()) {
              echo "Employee created successfully.";
          } else {
              echo "Error creating employee.";
          }
      }
  }

  $sql = "SELECT * FROM employee";
  $stmt = $conn->query($sql);
  $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD System</title>
</head>

<body>

    <h2>Create/Update Employee</h2>
    <form method="POST" action="index.php">
        <input type="text" name="first_name" placeholder="First Name">
        <input type="text" name="last_name" placeholder="Last Name">
        <input type="text" name="position" placeholder="Position">
        <input type="text" name="office_id" placeholder="Office ID">
        <input type="text" name="category" placeholder="Category">
        <button type="submit" name="submit_create">Create</button>
        <button type="submit" name="submit_update">Update</button>
    </form>

    <h2>Employee List</h2>

    <table border="1">
        <tr>
            <th>Employee ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Position</th>
            <th>Office ID</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        <?php foreach ($employees as $employee) : ?>
            <tr>
                <td><?php echo $employee['employee_id']; ?></td>
                <td><?php echo $employee['first_name']; ?></td>
                <td><?php echo $employee['last_name']; ?></td>
                <td><?php echo $employee['position']; ?></td>
                <td><?php echo $employee['office_id']; ?></td>
                <td><?php echo $employee['category']; ?></td>
                <td>
                    <a href="edit.php?employee_id=<?php echo $employee['employee_id']; ?>">Edit</a>
                    <a href="delete.php?employee_id=<?php echo $employee['employee_id']; ?>" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>
