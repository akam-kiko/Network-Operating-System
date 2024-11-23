<?php
$mysqli = new mysqli("localhost", "root", "", "crud");
if ($mysqli->connect_errno) {
    echo "Not connected to server";
    exit; // Ensure the script stops if connection fails
}

$id = $_REQUEST["id"];

$sql = "DELETE FROM crudapp WHERE id = $id";
$result = $mysqli->query($sql);

if ($result) {
    echo "Deleted";
} else {
    echo "Not Deleted";
}

// Redirect and refresh after deletion
header("Refresh:2; url=index.php");
exit;
?>
