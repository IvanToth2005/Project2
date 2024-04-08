<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raktár</title>
    <link rel="stylesheet" type="text/css" href="index.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="mainBody">
        <h1>Raktárak</h1>
        <div class="upLoadBt">
            <form action="setupDatabase.php" method="post">
                <input type="submit" name="upload" value="Adatbázis feltöltése">
            </form>
        </div>
        <?php
            require_once 'Html.php';
            Html::newData();
        ?>
         <!--
        <div class="newData">
            <button id="newDataBtn">Új adat</button>
            <div id="form" style="display: none;">
                <form id="newDataForm" action="add.php" method="post">
                    <label for="store_name">Áruház neve:</label><br>
                    <input type="text" id="store_name" name="store_name"><br>
                    <label for="store_address">Cím:</label><br>
                    <input type="text" id="store_address" name="store_address"><br>
                    <label for="shelf_name">Polc:</label><br>
                    <input type="text" id="shelf_name" name="shelf_name"><br>
                    <label for="row_name">Sor:</label><br>
                    <input type="text" id="row_name" name="row_name"><br>
                    <label for="column_name">Oszlop:</label><br>
                    <input type="text" id="column_name" name="column_name"><br>
                    <label for="product_name">Termék:</label><br>
                    <input type="text" id="product_name" name="product_name"><br>
                    <label for="min_qty">Minimális mennyiség:</label><br>
                    <input type="number" id="min_qty" name="min_qty" min="1"><br>
                    <label for="quantity">Mennyiség:</label><br>
                    <input type="number" id="quantity" name="quantity" min="1"><br>
                    <label for="price">Ár:</label><br>
                    <input type="number" id="price" name="price" step="0.01" min="0"><br><br>
                    <input type="button" id="addDataBtn" value="Hozzáadás">
                </form>
                
            </div>
        </div>
-->

        <script src="index.js"></script>

        <div class="kiiratas">

                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <label for="storeName">Áruház neve:</label>
                    <input type="text" id="storeName" name="storeName" required>
                    <label for="productName">Termék neve:</label>
                    <input type="text" id="productName" name="productName" required>
                    <input type="submit" value="Keresés">
                </form>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <input type="hidden" name="lowStock" value="true">
                    <input type="submit" value="Alacsony készletű termékek">
                </form>

        <table>
            <tr>
                <th>Áruház neve</th>
                <th>Cím</th>
                <th>Polc</th>
                <th>Sor</th>
                <th>Oszlop</th>
                <th>Termék</th>
                <th>Törlés</th>
            </tr>
            <?php
            
            require_once 'dataBaseManager.php';
            

            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "shop";

            $databaseManager = new DatabaseManager($servername, $username, $password, $dbname);
            $databaseManager->connect();

            $data = $databaseManager->getAllData();


            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                if (isset($_POST["storeName"]) && isset($_POST["productName"]) && !empty($_POST["storeName"]) && !empty($_POST["productName"])) {
                    
                    $searchedProduct = $_POST["productName"];
            
                    
                    $productLocation = $databaseManager->getProductLocation($searchedProduct);
            
                    if ($productLocation !== null) {
                        echo "<h2>Keresett termék adatai:</h2>";
                        echo "<p><strong>Termék:</strong> " . $searchedProduct . "</p>"; 
                        echo "<p><strong>Darabszám:</strong> " . $productLocation['quantity'] . "</p>"; 
                        echo "<p><strong>Polc:</strong> " . $productLocation['shelf_name'] . "</p>";
                        echo "<p><strong>Sor:</strong> " . $productLocation['row_name'] . "</p>";
                        echo "<p><strong>Oszlop:</strong> " . $productLocation['column_name'] . "</p>";
                    } else {
                        
                        echo "<p>Nincs találat a keresett termékre.</p>";
                    }
                } else if (isset($_POST["lowStock"]) && $_POST["lowStock"] === "true") {
                    
                    $lowStockProducts = $databaseManager->getLowStockProducts();
            
                    if (!empty($lowStockProducts)) {
                        echo "<h2>Alacsony készletű termékek:</h2>";
                        echo "<ul>";
                        foreach ($lowStockProducts as $product) {
                            echo "<li>" . $product['product_name'] . " - Darabszám: " . $product['quantity'] . "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>Nincs alacsony készletű termék.</p>";
                    }
                } else {
                    
                    echo "<p>Hiányzó keresési paraméterek.</p>";
                }
            }
            if (!empty($data)) {
                foreach ($data as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["store_name"] . "</td>";
                    echo "<td>" . $row["store_address"] . "</td>";
                    echo "<td>" . $row["shelf_name"] . "</td>";
                    echo "<td>" . $row["row_name"] . "</td>";
                    echo "<td>" . $row["column_name"] . "</td>";
                    echo "<td>" . $row["product_name"] . "</td>";
                    echo "<td><button class='delBtn' data-id='" . $row['product_id'] . "'>Adat törlése</button>";
                    
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>Nincs elérhető adat.</td></tr>";
            }
            $databaseManager->closeConnection();
            
        ?>

        </table>
        <?php
            //require_once 'Html.php';
            Html::modify();
        ?>
        <!--
        </div>
        <form method="POST" action="modify.php">
            <label for="modified_product_id">A termék sorszámát írja ide:</label><br>
            <input type="text" id="modify_product_id" name="modify_product_id" value=""><br>
            <label for="modified_store_id">Módosítandó áruház indexe:</label><br>
            <input type="text" id="modified_store_id" name="modified_store_id" required><br>
            <label for="modified_store_name">Módosított áruház neve:</label><br>
            <input type="text" id="modified_store_name" name="modified_store_name" required><br>
            <label for="modified_store_address">Módosított cím:</label><br>
            <input type="text" id="modified_store_address" name="modified_store_address" required><br>
            <label for="modified_shelf_name">Módosított polc:</label><br>
            <input type="text" id="modified_shelf_name" name="modified_shelf_name" required><br>
            <label for="modified_row_name">Módosított sor:</label><br>
            <input type="text" id="modified_row_name" name="modified_row_name" required><br>
            <label for="modified_column_name">Módosított oszlop:</label><br>
            <input type="text" id="modified_column_name" name="modified_column_name" required><br>
            <label for="modified_product_name">Módosított termék:</label><br>
            <input type="text" id="modified_product_name" name="modified_product_name" required><br>
            <label for="modified_min_qty">Módosított minimális mennyiség:</label><br>
            <input type="number" id="modified_min_qty" name="modified_min_qty" min="1" required><br>
            <label for="modified_quantity">Módosított mennyiség:</label><br>
            <input type="number" id="modified_quantity" name="modified_quantity" min="1" required><br>
            <label for="modified_price">Módosított ár:</label><br>
            <input type="number" id="modified_price" name="modified_price" step="0.01" min="0" required><br><br>
            <input type="submit" value="Módosítás">
        </form>
        </div>
        -->
</body>
</html>
