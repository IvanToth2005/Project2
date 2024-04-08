<?php



class Html {
    static function newData(){
        echo '<div class="newData">
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
        </div>';
    }

    static function modify(){
        echo '</div>
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
        </div>';
    }

    
}








