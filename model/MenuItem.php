<?php

class MenuItem
{
    public $name;
    public $price;
    public $barcode;
    public $image;

    // Constructor
    public function __construct($name, $price, $barcode, $image)
    {
        $this->name = $name;
        $this->price = $price;
        $this->barcode = $barcode;
        $this->image = $image;
    }

    // Getters and setters for the properties
    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function barCode()
    {
        return $this->barcode;
    }

    public function image()
    {
        return $this->image;
    }
}


function loadData()
{
    $data = file_get_contents(dirname(__DIR__) . '/data/data.json');
    $menuItemsArray = json_decode($data);

    $menuItems = [];
    foreach ($menuItemsArray as $menuItemData) {
        $menuItem = new MenuItem(
            $menuItemData->name,
            $menuItemData->price,
            $menuItemData->barcode,
            $menuItemData->image
        );

        $menuItems[] = $menuItem;
    }

    return $menuItems;
}
