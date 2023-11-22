<?php include_once('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br /><br />
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add']; //affichage du message
            unset($_SESSION['add']); //retrait du message
        }
        ?>

        <form  method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" placeholder="Enter your username"></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" placeholder="Enter your password"></td>
                </tr>
                <tr>
                    <td colspan="2">

                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php include_once('partials/footer.php'); ?>

<?php
//Form Gestion 

//Vérification du submit
if (isset($_POST['submit'])) {
    //boutton cliqué
    //echo "bouton cliqué";

    //Récupperé les donnés du form 

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);

    //SQL Query




    $sql = "INSERT INTO tbl_admin(full_name, username, password) VALUES
                (:full_name, :username, '$password')";

    $q = $db->prepare($sql);
    //Execution de la query et envoie des donnes dans la DB
    $q->bindValue(":full_name", $full_name, PDO::PARAM_STR);
    $q->bindValue(":username", $username, PDO::PARAM_STR);
    $q->execute();


    if ($q == true) {
        //message de confirmation
        $_SESSION['add'] = "Admin ajouté";
        //redirection  
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        //message de confirmation
        $_SESSION['add'] = "Ajout échoué";
        //redirection  
        header("location:" . SITEURL . 'admin/manage-admin.php');
    }
}


?>