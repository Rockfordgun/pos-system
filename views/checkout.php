<?php

// display error codes and messages
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// redirect back to index if payment button is selected
if (isset($_GET['payment'])) {
    session_unset();
    header("Location: ./../");
}

include('../functions.php');
include('../model/MenuItem.php');

$menuItems = loadData();

$selectedItemName = isset($_SESSION['selectedItem']) ? $_SESSION['selectedItem'] : "";

// Retrieve the selected items from the session
$selectedItems = isset($_SESSION['order']) ? $_SESSION['order'] : array();

// Calculate the total price for display
$totalPrice = isset($_SESSION['orderTotal']) ? $_SESSION['orderTotal'] : 0;

// Calculate the VAT amount
$vatAmount = $totalPrice * 0.15;

// Calculate the subtotal
$subtotal = $totalPrice + $vatAmount;


?>

<!doctype html>
<html lang="en">

<head>
    <title>Store & Save</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="../style.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <div class="mainNav">
            <div class="centerNav">
                <div class="logo"><img src="../static/img/logo.png" alt="" srcset="" class="logoIMG"></div>
                <div class="social"></div>
            </div>
        </div>
    </header>
    <main class="my-5">

        <div class="cart">
            <h4>Items Purchased:</h4>

            <ul>
                <?php if (isset($_SESSION['selectedItems'])) {
                    foreach ($_SESSION['selectedItems'] as $selectedItem) {
                ?>
                        <li><?php echo $selectedItem; ?></li>
                <?php
                    }
                }
                ?>
            </ul>




            <hr>

            <h4 class="my-5">
                Amount: R<span><?php echo $totalPrice; ?></span>
                <br>
                VAT Amount: R <span><?php echo number_format($vatAmount, 2); ?></span>
                <br>
                <hr>

                Subtotal for all items: R<span><?php echo number_format($subtotal, 2); ?></span>
            </h4>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">


                <button type="submit" name="payment" class="payment">Pay with card <i class="fa-solid fa-wallet"></i></button>
                <button type="submit" name="payment" class="payment">Pay with cash <i class="fa-solid fa-credit-card"></i></button>
            </form>

        </div>
    </main>
    <footer class="mt-5">



    </footer>

    <script src="https://kit.fontawesome.com/c9e1ae9f10.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>