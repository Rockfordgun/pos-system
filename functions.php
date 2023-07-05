<?php


if (!isset($_SESSION['order'])) {

    $_SESSION['order'] = array();
}

if (isset($_POST['selectedItemValue'])) {

    $selectedItem = $_POST['selectedItemValue'];
    $_SESSION['order'][] = $selectedItem;
}

// functions.php

function getItemPrice($itemName, $menuItems)
{
    foreach ($menuItems as $menuItem) {
        if ($menuItem->name === $itemName) {
            return $menuItem->price;
        }
    }
    return 0; // Return 0 if the item is not found
}
