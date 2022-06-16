<?php
    if (!empty($_SESSION['id'])) {
        $session_id = $_SESSION['id'];
        include 'includes/config.php';
        include 'includes/users.php';

        $db = new Database();
        $db->getConnection();
        $users = new UserClass($db);
    }
    if (empty($_SESSION['id'])) {
        $url = $url = 'https://hongminhdev-pizza-app.herokuapp.com/admin/'.'index.php';
        header('location: $url');
    }
?>