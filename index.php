<?php
session_start();

// display error codes and messages
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('./functions.php');
include('./model/MenuItem.php');

$menuItems = loadData();


// Calculate the total price
$totalPrice = 0;
if (isset($_POST['selectedItemValue'])) {
    $selectedItem = $_POST['selectedItemValue'];
    $_SESSION['order'][] = $selectedItem;

    $itemPrice = getItemPrice($selectedItem, $menuItems);
    $_SESSION['orderTotal'] += $itemPrice;


    // Calculate the total price for display
    $totalPrice = $_SESSION['orderTotal'];
}

if (isset($_POST['selectedItemValue'])) {
    $selectedItemName = $_POST['selectedItemValue'];
    if (!isset($_SESSION['selectedItems'])) {
        $_SESSION['selectedItems'] = array();
    }
    $_SESSION['selectedItems'][] = $selectedItemName;
}

/*
foreach ($menuItems as $menuItem) {
    echo "Name: " . $menuItem->getName() . "<br>";
    echo "Price: " . $menuItem->getPrice() . "<br>";
    echo "Barcode: " . $menuItem->barCode() . "<br><br>";
}
*/

if (isset($_POST['cancel'])) {
    // Clear selected items
    session_unset();
}

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

    <link rel="stylesheet" href="style.css">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <div class="mainNav">
            <div class="centerNav">
                <div class="logo"><img src="./static/img/logo.png" alt="" srcset="" class="logoIMG"></div>
                <div class="social"></div>
            </div>
        </div>
    </header>
    <main>

        <div class="mainContainer">
            <div class="confirmOrder">

                <div class="row mt-5 me-5">

                    <div class="col ">
                        <div class=" sidebar">

                            <div class="confirmTop d-flex justify-content-between ">
                                <div>
                                    <p>Confirm Order</p>
                                </div>
                                <div>
                                    <p><i class="fa-solid fa-arrow-down-short-wide"></i></p>
                                </div>
                            </div>

                            <div class="confirmCenter mt-5">

                                <div class="d-flex justify-content-between">
                                    <div class="confirmFont">
                                        <?php
                                        if (isset($_SESSION['selectedItems'])) {
                                            foreach ($_SESSION['selectedItems'] as $selectedItem) {
                                                $itemPrice = getItemPrice($selectedItem, $menuItems);
                                        ?>
                                                <li style="list-style: none;"><?php echo $selectedItem; ?> - R<?php echo $itemPrice; ?></li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>

                                </div>

                            </div>



                            <hr>
                            <div class=" confirmCenter">

                                <div class="d-flex justify-content-between">
                                    <div class="confirmFont">Tax</div>
                                    <div class="confirmFont"><?php echo number_format($vatAmount, 2); ?></div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-between" style="font-weight: 700;">
                                    <div class="confirmFinal">Total</div>
                                    <div class="confirmFinal">R <span><?php echo number_format($subtotal, 2); ?></span></div>
                                </div>

                                <div class="confirmBottom d-flex justify-content-between mt-5">
                                    <div> <a href="./views/checkout.php" class="text-decoration-none link-light">confirm</a></div>
                                    <div>
                                        <form action="" method="POST">
                                            <input type="submit" name="cancel" value="cancel" style="background: none; border: none; color: white;">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class=" productSelect ms-5">

                <form class="items" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <?php
                    foreach ($menuItems as $menuItem) {
                    ?>
                        <button type="submit" name="selectedItemValue" value="<?php echo $menuItem->name; ?>" class="item">
                            <div class="row">

                                <div class="col ms-5" style="background-image: url(<?php echo $menuItem->image; ?>); background-size: contain; background-repeat: no-repeat;">
                                    <div class=" mainProduct">

                                        <div class="infoProduct">
                                            <div>
                                                <p> <?php echo $menuItem->name; ?></p>
                                            </div>
                                            <div>
                                                <p><?php echo "R" . $menuItem->price; ?></p>
                                            </div>
                                        </div>


                                    </div>

                                </div>



                            </div>
                        </button>
                    <?php
                    }
                    ?>
            </div>


        </div>


        </div>

        </form>

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