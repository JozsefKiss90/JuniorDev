<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <?php
     require('database/Products.php');
     if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['saveBtn'])) {
            $attributes = $_POST['size'] . " " . $_POST['weight'] . " " .  ($_POST['height'] . " " . $_POST['width'] . " " . $_POST['length']);
            if(!empty($_POST['sku']) && !empty($_POST['name']) && !empty($_POST['price']) && isset($attributes)) {
                $productTypes = [
                    'disc' => 'DVD',
                    'book' => 'Book',
                    'furniture' => 'Furniture',
                ];
               $productType = $_POST['productType'];
               $productClass = $productTypes[$productType];
               $product = new $productClass($productType);
               $postArray = [$_POST['sku'], $_POST['name'], $_POST['price'], $attributes];
               $product->postData($postArray);
            }
        }
   }
     ?>
</head>
<body style="padding:0 40px 0 40px">
    <div id="navitem" class="navitem">
        <h1>Product list</h1>
      <div style="height: 30px;">
        <button class="btn-1" id="saveBtn"  type="submit" form="product_form">Save</button>
        <button class="btn-2" onclick="window.location.href='https://juniordev123.000webhostapp.com';">Cancel</button>
      </div>
    </div>
    <form class="product_form" id="product_form" method="post">
        <table>
            <tr>
                <td >SKU</td>
                <td ><input id="sku" type="text" name="sku" required/></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><input id="name" type="text" name="name"required/></td>
            </tr>
            <tr>
                <td>Price ($)</td>
                <td><input id="price" type="number" name="price" required/></td>
            </tr>
            <tr>
                <td>Type Switcher</td>
                <td>
                    <select style="font-size:13px;padding:3px;" name="productType" id="productType" onchange="addProps()" required>
                        <option disabled selected value>-select an option-</option>
                        <option value="disc">DVD</option>
                        <option value="book">Book</option>
                        <option value="furniture">Furniture</option>
                    </select>
                </td>
            </tr>
            <tr class="discProps">
                <td>Size (MB)</td>
                <td><input id="size" type="number" name="size" min="0"/></td>
            </tr>
            <tr class="bookProps">
                <td>Weight (KG)</td>
                <td><input id="weight" type="number" name="weight" min="0"/></td>
            </tr>
            <tr class="furniProps">
                <td>Height (CM)</td>
                <td><input id="height" type="number" name="height" min="0"/></td>
            </tr>
            <tr class="furniProps">
                <td>Width (CM)</td>
                <td><input id="width" type="number" name="width" min="0"/></td>
            </tr>
            <tr class="furniProps">
                <td>Length (CM)</td>
                <td><input id="length" type="number" name="length" min="0"/></td>
            </tr>
        </table>
    </form>
       <div style="margin:0 0 0 100px" class="">
            <strong class="discProps">
                Please provide a size in MB.
            </strong>
            <strong class="bookProps">
                Please provide a weight in KG.
            </strong>
            <strong class="furniProps">
                Please provide dimensions <br> (height, width, length) in CM.
            </strong>
       </div>
</body>
<script>
    let productType = document.getElementById('productType')

    function addProps() {
        let nodeList = document.querySelectorAll(".furniProps");
        let nodeList_2 = document.querySelectorAll(".bookProps");
        let nodeList_3 = document.querySelectorAll(".discProps");

        if (productType.value === "furniture") {
            //document.querySelectorAll('#furniProps').style.removeProperty("display")
            for (let i = 0; i < nodeList.length; i++) {
                nodeList[i].style.display = "table-row";
                }
            for (let i = 0; i < nodeList_2.length; i++) {
                nodeList_2[i].style.display = "none";
                nodeList_3[i].style.display = "none";
                }
                document.getElementById("height").setAttribute("required", "true")
                document.getElementById("width").setAttribute("required", "true")
                document.getElementById("length").setAttribute("required", "true")
                document.getElementById("size").removeAttribute("required")
                document.getElementById("size").value = null;
                document.getElementById("weight").removeAttribute("required")
                document.getElementById("weight").value = null;
            }
         if (productType.value === "book") {
            for (let i = 0; i < nodeList.length; i++) {
                nodeList[i].style.display = "none";
                }
            for (let i = 0; i < nodeList_2.length; i++) {
                nodeList_2[i].style.display = "table-row";
                nodeList_3[i].style.display = "none";
                }
                document.getElementById("weight").setAttribute("required", "true")
                document.getElementById("size").removeAttribute("required")
                document.getElementById("size").value = null;
                document.getElementById("height").removeAttribute("required")
                document.getElementById("height").value = null;
                document.getElementById("width").removeAttribute("required")
                document.getElementById("width").value = null;
                document.getElementById("length").removeAttribute("required")
                document.getElementById("length").value = null;
            }
        if (productType.value === "disc") {
            for (let i = 0; i < nodeList.length; i++) {
                nodeList[i].style.display = "none";
                }
            for (let i = 0; i < nodeList_2.length; i++) {
                nodeList_2[i].style.display = "none";
                nodeList_3[i].style.display = "table-row";
                }
                document.getElementById("size").setAttribute("required", "true")
                document.getElementById("weight").removeAttribute("required")
                document.getElementById("weight").value = null;
                document.getElementById("height").removeAttribute("required")
                document.getElementById("height").value = null;
                document.getElementById("width").removeAttribute("required")
                document.getElementById("width").value = null;
                document.getElementById("length").removeAttribute("required")
                document.getElementById("length").value = null;
            }
        }

        let form = document.forms["product_form"]
        form.addEventListener("submit", function() {
            let sku = document.getElementById("sku").value
            let name = document.getElementById("name").value
        
            if (!isNaN(sku) || !isNaN(name)) {
                alert("Please, provide the data of indicated type");
            }
            else {
                document.getElementById("saveBtn").setAttribute("name", "saveBtn")
            }
        });

</script>
</html>