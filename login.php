<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "root"; // Your MySQL root password
$dbname = "logindb"; // Correct database name

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    // Check if user exists and verify password
    if ($stmt->num_rows > 0 && password_verify($inputPassword, $hashedPassword)) {
        echo "Login successful! Welcome " . $inputUsername;
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
}

$conn->close();
?>


<?php
$servername = "localhost";
$dbusername = "root";
$dbpassword = "root"; // Your MySQL root password
$dbname = "logindb"; // Correct database name

// Create connection
$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$username = 'testuser';
$password = 'password123';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $hashedPassword);

if ($stmt->execute()) {
    echo "New user created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
