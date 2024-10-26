<?php
// Include your database connection here (e.g., include 'database.php').

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve POST data
    $categoryId = $_POST["categoryId"];
    $editArtistName = $_POST["editArtistName"];
    $editClassName = $_POST["editClassName"];

    $conn = new mysqli("localhost", "root", "", "sound");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE categories SET name = ?, class_name = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $editArtistName, $editClassName, $categoryId);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        
        // Redirect to the categories page
        header("Location: categories.php");
        exit();
    } else {
        $stmt->close();
        $conn->close();

        // Handle the error and display a message
        echo "Error updating category: " . $conn->error;
    }
} else {
    // Handle invalid request method
    $response = array("success" => false, "message" => "Invalid request method");
    echo json_encode($response);
    exit();
}
?>  