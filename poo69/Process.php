<?php

    class Arrays{
        public $list = [
            "item0" => array(
                "icon" => "bx bx-grid-alt",
                "name" => "Dashboard"
            ),
            "item1" => array(
                "icon" => "bx bx-box",
                "name" => "Product"
            ),
            "item2" => array(
                "icon" => "bx bx-list-ul",
                "name" => "Order List"
            ),
            "item3" => array(
                "icon" => "bx bx-pie-chart-alt-2",
                "name" => "Analytics"
            ),
            "item4" => array(
                "icon" => "bx bx-coin-stack",
                "name" => "Stock"
            ),
            "item5" => array(
                "icon" => "bx bx-book-alt",
                "name" => "Total order"
            ),
            "item6" => array(
                "icon" => "bx bx-user",
                "name" => "Team"
            ),
            "item7" => array(
                "icon" => "bx bx-message",
                "name" => "Messages"
            ),
            "item8" => array(
                "icon" => "bx bx-heart",
                "name" => "Favorites"
            ),
            "item9" => array(
                "icon" => "bx bx-cog",
                "name" => "Setting"
            ),
            "item10" => array(
                "icon" => "bx bx-log-out",
                "name" => "Log out"
            ),
        ];

        function returArray(){
            return $this->list;
        }
    }
?>