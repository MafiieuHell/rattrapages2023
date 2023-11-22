<?php
include('partials-front/menu.php')
?>
<?php
//check id 
if (isset($_GET['category_id'])) {
    //category id is set 
    $category_id = $_GET['category_id'];
    //get the category title
    $sql = "SELECT title FROM tbl_category WHERE id = $category_id";
    $q = $db->query($sql);
    $q->execute();
    $title = $q->fetch();
} else {
    header('Location:' . SITEURL);
}
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white"><?= $title['title']; ?></a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //sql to display category
        $sql = "SELECT * FROM  tbl_food WHERE category_id = $category_id";
        //On exécute la requete
        $q = $db->query($sql);
        $count = $q->rowCount();
        if ($count > 0) {
            $foods = $q->fetchAll();

        ?>
            <?php foreach ($foods as $food) : ?>
                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <img src="<?= SITEURL; ?>images/food/<?= $food['image_name']; ?> " alt="<?= $food['title']; ?>" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h4><?= $food['title']; ?></h4>
                        <p class="food-price"><?= $food['price']; ?> $</p>
                        <p class="food-detail">
                            <?= $food['description']; ?>
                        </p>
                        <br>

                        <a href="<?= SITEURL; ?>order.php?food_id=<?= $food['id'] ?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php } else {
            echo "<div> Food not Available.</div>";
        }
        ?>




        <div class="clearfix"></div>



    </div>

</section>

<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>