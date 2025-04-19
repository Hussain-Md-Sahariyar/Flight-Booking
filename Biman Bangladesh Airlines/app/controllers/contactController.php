<?php
require_once '../models/ContactModel.php';
$conn = new mysqli("localhost", "root", "", "airlinesystem");
$model = new ContactModel($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $model->submitContact(trim($_POST['name']), trim($_POST['email']), trim($_POST['message']))
        ? "Message sent successfully!" : "Failed to send message.";
} else {
    include '../views/contactView.php';
}
?>
