<?php

$name = $_POST["name"];
$message = $_POST["message"];
$prior = $_POST["prior"];
$type = $_POST["type"];

//boolean filter validation to avoid warning for checkbox
$terms = filter_input(INPUT_POST, "terms", FILTER_VALIDATE_BOOL);

if ( ! $terms) {
    die ("Terms must be accepted");
}


// connection details for the database
$host = "localhost";
$dbname = "message_db";
$username = "root";
$password = "";

$conn = mysqli_connect(hostname: $host,
               username: $username,
               password: $password,
               database: $dbname);

if (mysqli_connect_errno()) {
    die("Connection error:" . mysqli_connect_error());
}
$sql = "INSERT INTO message (name, body, prior, type)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_stmt_init($conn);

if (! mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}


mysqli_stmt_bind_param($stmt, "ssii",
                       $name,
                       $message,
                       $prior,
                       $type);

mysqli_stmt_execute($stmt);

echo "<div style='background-color: yellow; padding: 20px; border: 1px solid #ccc;'>
    <p>Thank you for your feedback!</p>
    <p>We truly appreciate you taking the time to share your thoughts with us. Your feedback helps us improve our services and better serve our customers.</p>
    <p>Record Saved.</p>
</div>";