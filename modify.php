<?php
require_once 'dataBaseManager.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modify_product_id"])) {
    $modifyProductId = $_POST["modify_product_id"];

    
    if (
        isset($_POST["modified_store_name"]) && !empty($_POST["modified_store_name"]) &&
        isset($_POST["modified_store_address"]) && !empty($_POST["modified_store_address"]) &&
        isset($_POST["modified_shelf_name"]) && !empty($_POST["modified_shelf_name"]) &&
        isset($_POST["modified_row_name"]) && !empty($_POST["modified_row_name"]) &&
        isset($_POST["modified_column_name"]) && !empty($_POST["modified_column_name"]) &&
        isset($_POST["modified_product_name"]) && !empty($_POST["modified_product_name"]) &&
        isset($_POST["modified_min_qty"]) && !empty($_POST["modified_min_qty"]) &&
        isset($_POST["modified_quantity"]) && !empty($_POST["modified_quantity"]) &&
        isset($_POST["modified_price"]) && !empty($_POST["modified_price"])
    ) {
        
        $modifiedData = array(
            "store_name" => $_POST["modified_store_name"],
            "store_address" => $_POST["modified_store_address"],
            "shelf_name" => $_POST["modified_shelf_name"],
            "row_name" => $_POST["modified_row_name"],
            "column_name" => $_POST["modified_column_name"],
            "product_name" => $_POST["modified_product_name"],
            "min_qty" => $_POST["modified_min_qty"],
            "quantity" => $_POST["modified_quantity"],
            "price" => $_POST["modified_price"]
        );

        
        $databaseManager = new DatabaseManager($servername, $username, $password, $dbname);
        $databaseManager->connect();
        $databaseManager->modifyDataByProductId($modifyProductId, $modifiedData);
        $databaseManager->closeConnection();

        echo "Az adatok sikeresen módosítva lettek!";
    } else {
        echo "Hiányzó módosítási adatok!";
    }
} else {
    echo "Hiba történt a módosítás közben!";
}
?>
