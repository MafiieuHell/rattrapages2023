<?php include_once('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <?php
        if (isset($_GET['id'])) {
            //recuperer l'id de l'admin
            $id = $_GET["id"];

            //requete sql
            $sql = "SELECT * FROM tbl_admin WHERE id = $id";


            //executer la query
            $q = $db->prepare($sql);

            $q->execute();

            $count = $q->rowCount();

            if ($count == 1) {
                $admin = $q->fetch(PDO::FETCH_OBJ);
            } else {
                header("location:" . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            header('location:' . SITEURL . '/admin/manage-admin.php');
        }

        ?>

        <form  method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full name:</td>
                    <td><input type="text" name="full_name" value="<?= $admin->full_name ?>"></td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" value="<?= $admin->username ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?= $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    </div>
</div>

<?php
if (isset($_POST['submit'])) {
    //boutton cliqué
    //echo "bouton cliqué";

    //Récupperé les donnés du form 

    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];

    //requete sql
    $sql = "UPDATE tbl_admin SET full_name=:full_name, username=:username 
        WHERE id=$id";

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
    }
}

?>


<?php include_once('partials/footer.php'); ?>