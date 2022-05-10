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
      $discs = new DVD('disc');
      $books = new Book('book');
      $furnitures = new Book('furniture');
      $discArr = $discs->getData();
      $bookArr = $books->getData();
      $furnitureArr = $furnitures->getData();
      $prodcutArr = array_merge($discArr,$bookArr,$furnitureArr);
      $keys = array_column($prodcutArr, 'id');
      array_multisort($keys, SORT_ASC, $prodcutArr);
      if(isset($_POST['delBtn'])){
         if(isset($_POST['delete']) && !empty($_POST['delete'])){
           foreach($_POST['delete'] as $deleteid){
             $deleteDiscs = $discs->con->query("DELETE from {$discs->table} WHERE id=$deleteid");
             $deleteBooks = $books->con->query("DELETE from {$books->table} WHERE id=$deleteid");
             $deleteFurnitures = $furnitures->con->query("DELETE from {$furnitures->table} WHERE id=$deleteid");
           }
           if($deleteDiscs ||  $deleteBooks || $deleteFurnitures) {
             header("Refresh: 0");
           }
         }
       }
     ?>
</head>
<body style="padding:0 40px 0 40px">
    <div id="navitem" class="navitem">
      <h1>Product list</h1>
      <div style="height: 30px;">
        <button class="btn-1" onclick="window.location.href='addproduct.php';">ADD</button>
        <button class="btn-2" type="submit" form="delete_form" name='delBtn'>MASS DELETE</button>
      </div>
    </div>
    <div class="delete_div" >
    <form class="box" id="delete_form" method='post' action=''>
      <?php foreach ($prodcutArr as $item) { ?>
          <div class="item_box">
              <p><?php echo $item['SKU'] ?></p>
              <p><?php echo $item['name'] ?></p>
              <p><?php echo $item['price']?> <?php echo $item['id'] ? "$" : '' ?></p>
              <p><?php echo $item['attribute'] ?></p>
              <input type="checkbox" class="delete-checkbox" id="delete_box" name='delete[]' value="<?php echo $item['id'];?>">
          </div>
          <?php
        }
      ?>
        </form>
    </div>
    <div class="footerdiv">
      <p>Scandiweb Test assignment<br>
    </div>
</body>
<script>

   let boxes = document.querySelectorAll(".delete-checkbox") 
   let items = document.querySelectorAll(".item_box") 

   boxes.forEach(setChecked)
   
   console.log(boxes[0].getAttribute("checked") == null)
   
   function setChecked() {
    for (var i = 0; i < boxes.length; i++) {
    var box = boxes[i];
    box.addEventListener('click', function () {  
      if(this.getAttribute("checked") == null) {
        this.setAttribute("checked", "true")       
      }
      else if (this.getAttribute("checked") == "true"){
        this.removeAttribute("checked")   
      }
    })
   }
  }

   function massDelete() {
    for (var i = 0; i < boxes.length; i++) {
      var box = boxes[i];
      //console.log(box.getAttribute("checked"))
      if(box.getAttribute("checked") !== null) {
        items[i].remove()
      }
    }
   }
   /*for (var i = 0; i < boxes.length; i++) {
    var box = boxes[i];

    box.addEventListener('click', function (event) {  
        event.preventDefault();

    this.setAttribute(("checked", "true"))       
    });*/

</script>
</html>