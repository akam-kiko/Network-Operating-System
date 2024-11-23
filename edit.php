<?php
session_start();

// Initialize session for employee list
if (!isset($_SESSION['employeeList'])) {
    $_SESSION['employeeList'] = [];
}

// Handle form submission for updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editIndex'])) {
    $editIndex = $_POST['editIndex'];
    $_SESSION['employeeList'][$editIndex] = [
        'fullName' => $_POST['fullName'],
        'empCode' => $_POST['empCode'],
        'salary' => $_POST['salary'],
        'city' => $_POST['city'],
    ];
    header("Location: index.php"); // Prevent resubmission
    exit();
}

// Handle edit action
$editRecord = null;
if (isset($_GET['edit'])) {
    $editIndex = $_GET['edit'];
    $editRecord = $_SESSION['employeeList'][$editIndex];
}
?>

<!-- Form Section -->
<form action="index.php" method="POST">
    <input type="hidden" name="editIndex" value="<?php echo isset($editIndex) ? $editIndex : ''; ?>">
    <label for="fullName">Full Name:</label>
    <input type="text" id="fullName" name="fullName" value="<?php echo $editRecord['fullName'] ?? ''; ?>"><br>

    <label for="empCode">Employee Code:</label>
    <input type="text" id="empCode" name="empCode" value="<?php echo $editRecord['empCode'] ?? ''; ?>"><br>

    <label for="salary">Salary:</label>
    <input type="number" id="salary" name="salary" value="<?php echo $editRecord['salary'] ?? ''; ?>"><br>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" value="<?php echo $editRecord['city'] ?? ''; ?>"><br>

    <input type="submit" value="Update">
</form>

<!-- Employee List Table -->
<table border="1">
    <thead>
        <tr>
            <th>Full Name</th>
            <th>Employee Code</th>
            <th>Salary</th>
            <th>City</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($_SESSION['employeeList'] as $index => $employee): ?>
            <tr>
                <td><?php echo htmlspecialchars($employee['fullName']); ?></td>
                <td><?php echo htmlspecialchars($employee['empCode']); ?></td>
                <td><?php echo htmlspecialchars($employee['salary']); ?></td>
                <td><?php echo htmlspecialchars($employee['city']); ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $index; ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
