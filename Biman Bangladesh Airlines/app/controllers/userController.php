<?php
require_once '../models/UserModel.php';
$conn = new mysqli("localhost", "root", "", "airlinesystem");

$model = new UserModel($conn);

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['action'] === 'delete' && isset($_POST['id'])) {
        echo $model->deleteUser($_POST['id']) ? 'success' : 'error';
    } elseif ($_POST['action'] === 'updateProfile') {
        echo $model->updateUser($_SESSION['user_id'], $_POST['name'], $_POST['email'], $_POST['contact'], $_POST['address']) ? 'success' : 'error';
    }
}
?>
