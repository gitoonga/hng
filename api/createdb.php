<?php
// Include the database.php file to access the Database class
include "./database.php";

// Create a new instance of the Database class
$database = new Database();

// Define the SQL code to create the database and table
$sql = "
CREATE DATABASE IF NOT EXISTS `hng3` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hng3`;

CREATE TABLE `persons` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `persons`
  ADD PRIMARY KEY (`id`);

  ALTER TABLE `persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;
";

// Execute the SQL code using the Database class
$database->query($sql);

try {
    $database->execute();
    echo "Database and table created successfully.";
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
