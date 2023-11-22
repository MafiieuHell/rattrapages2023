<?php
include('partials-front/menu.php');


?>
<?php //get the search keyword
$search = $_POST['search']; ?>


<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">


        <h2>Foods on Your Search <a href="#" class="text-white"><?= $search ?></a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //get the search keyword


        //SQL  to get foods on search kayword
        $sql = "SELECT * FROM tbl_food WHERE title LIKE :search OR description LIKE :search ";
        $q = $db->prepare($sql);
        $searchValue = "%" . $search . "%";
        $q->bindValue(':search', $searchValue);
        $q->execute();
        $count = $q->rowCount();

        if ($count > 0) {
            //food avalailable
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

                        <a href="<?= SITEURL; ?>order.php?food_id=<?= $food['id'] ?>" class="btn btn-primary" class="btn btn-primary">Order Now</a>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php

        } else {
            echo "<div> Food not Found.</div>";
        }
        ?>
        <div class="clearfix"></div>
    </div>

</section>
<!-- fOOD Menu Section Ends Here -->
<?php include('partials-front/footer.php'); ?>