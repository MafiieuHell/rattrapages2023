<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login - Food Order</title>
    <link rel="stylesheet" href="../css/admin.css">

</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1>


        <form action="" method="POST" class="text-center">
            <p> username: </p>
            <input type="text" name="username" placeholder="Enter username">
            <p>Password: </p>
            <input type="password" name="password" placeholder="Enter password">

            <p><input type="submit" name="submit" value="Login" class="btn-primary"></p>
        </form>


        <p class="text-center">Created By - <a href="">Mehdi Kerkar</a> </p>
    </div>

</body>

</html>

<?php
if (isset($_POST['submit'])) {


    //requete sql 


    //connexion a la db
    include "../config/constants.php";

    $sql = "SELECT * FROM tbl_admin WHERE username = :username";

    $q = $db->prepare($sql);

    $q->bindValue(":username", $_POST["username"], PDO::PARAM_STR);

    $q->execute();

    $user = $q->fetch();


    //verification du user
    if ($user) {
        // user exist
        //verification du mdp de user
        if (password_verify($_POST["password"], $user["password"])) {

            $_SESSION['user'] = $user;

            //le mdp est bon
            //on redigire vers une page 
            header("location:" . SITEURL . 'admin/');
        }
    }
}






?>