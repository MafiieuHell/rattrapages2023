<?php
include('partials-front/menu.php')
?>
<?php
//check food id
if (isset($_GET['food_id'])) {

    $food_id = $_GET['food_id'];

    $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
    $q = $db->query($sql);
    $q->execute();
    $count = $q->rowCount();

    if ($count == 1) {
        $food = $q->fetch();
    } else {
        header('location:' . SITEURL);
    }
} else {
    header('location:' . SITEURL);
}

?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form  method="POST" class="order">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <img src="<?= SITEURL; ?>images/food/<?= $food['image_name']; ?>" alt="<?= $food['title']; ?>" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h3><?= $food['title'] ?></h3>
                    <input type="hidden" name="food" value="<?= $food['title']; ?>">
                    <p class="food-price"><?= $food['price'] ?> $</p>
                    <input type="hidden" name="price" value="<?= $food['price']; ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full_name" placeholder="E.g. Mehdi Kerkar" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 0645xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. mehdi@kerkar.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>
        <?php
        //Check submit boutton
        if (isset($_POST['submit'])) {
            //get the data
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("Y-m-d H:i:s"); // order date
            $status = "Ordered";
            $customer_name = $_POST['full_name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];

            //save the data in DB
            //sql query

            $sql = "INSERT INTO tbl_order(food, price, qty, total, order_date, status,
                                            customer_name, customer_contact, customer_email, 
                                            customer_address ) VALUES
                                            (:food, :price, :qty, :total, :order_date, :status,
                                            :customer_name, :customer_contact, :customer_email, 
                                            :customer_address)";

            $q = $db->prepare($sql);
            $q->bindValue(':food', $food);
            $q->bindValue(':price', $price);
            $q->bindValue(':qty', $qty);
            $q->bindValue(':total', $total);
            $q->bindValue(':order_date', $order_date);
            $q->bindValue(':status', $status);
            $q->bindValue(':customer_name', $customer_name);
            $q->bindValue(':customer_contact', $customer_contact);
            $q->bindValue(':customer_email', $customer_email);
            $q->bindValue(':customer_address', $customer_address);

            $q->execute();

            if ($q == true) {
                //succes
                $_SESSION['order'] = "<div class='success text-center'> Food ordered.</div>";
                header("location:" . SITEURL);
            } else {
                //failed

                header("location:" . SITEURL);
            }
        }

        ?>




    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php include('partials-front/footer.php'); ?>