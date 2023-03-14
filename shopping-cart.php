<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/d39f9ee5aa.js" crossorigin="anonymous"></script>
    <script type="text/JavaScript" src="script.js"></script>
</head>
<body>
    <div class="navBar" id="myNavBar">
        <div class="navBarLeft">
          <a href="Home.html" class="active">E-handel</a>
          <a href="Home.html">Hem</a>
          <div class="dropdown">
            <button class="dropbtn">Produkter 
              <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
              <a href="Kategori1.php">Kategori 1</a>
              <a href="Kategori2.php">Kategori 2</a>
              <a href="Kategori3.php">Kategori 3</a>
            </div>
          </div> 
        </div>
        <div class="navBarRight">
          <a href="shopping-cart.php"><i class='fas fa-shopping-cart'></i></a>
          <form action="search.php" method="POST">
            <input type="text" name="word" placeholder="Sök produkt" />
            <input type="hidden" name="search"/>
          </form>
          <a onclick="openNav()" class="icon">
            <i class="fa fa-bars"></i>
          </a>
        </div> 
      </div>
      
      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Examensarbete";

        session_start();

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
        echo "fel";
        die("Connection failed: " . $conn->connect_error);
        }
    

        if(isset($_POST["add"]))
        {
            if(isset($_SESSION["shopping_cart"]))
            {
                $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
                if(!in_array($_POST["articlenr"], $item_array_id))
                {
                    $count = count($_SESSION["shopping_cart"]);
                    $item_array = array(
                        'item_id'			=>	$_POST["articlenr"],
                        'item_name'			=>	$_POST["name"],
                        'item_price'		=>	$_POST["price"],
                        'item_quantity'		=>	$_POST["quantity"]
                    );
                    $_SESSION["shopping_cart"][$count] = $item_array;
                }
                else
                {
                    echo '<script>alert("Produkten finns redan i din varukorg")</script>';
                }
            }
            else
            {
                $item_array = array(
                    'item_id'			=>	$_GET["id"],
                    'item_name'			=>	$_POST["name"],
                    'item_price'		=>	$_POST["price"],
                    'item_quantity'		=>	$_POST["quantity"]
                );
                $_SESSION["shopping_cart"][0] = $item_array;
            }
        }

        if(isset($_GET["action"]))
        {
            if($_GET["action"] == "delete")
            {
                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
                    if($values["item_id"] == $_GET["id"])
                    {
                        unset($_SESSION["shopping_cart"][$keys]);
                        echo '<script>alert("Produkten har tagits bort")</script>';
                        echo '<script>window.location="shopping-cart.php"</script>';
                    }
                }
            }
        }        
     ?>  



    <h2 class="cartHead">Din kundkorg</h2>
    <div class="divCart">
        <table id="cart">
            <tr>
                <th width="40%">Produkt</th>
                <th width="10%">Antal</th>
                <th width="20%">Pris</th>
                <th width="15%">Totalt</th>
                <th width="15%"></th>
            </tr>
            <?php
            if(!empty($_SESSION["shopping_cart"]))
            {
                $total = 0;
                foreach($_SESSION["shopping_cart"] as $keys => $values)
                {
            ?>
            <tr>
                <td><?php echo $values["item_name"]; ?></td>
                <td><?php echo $values["item_quantity"]; ?></td>
                <td><?php echo $values["item_price"]; ?> kr</td>
                <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?> kr</td>
                <td><a style="color: black;" href="shopping-cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger"><i class="fa-regular fa-trash-can" style="font-size: 1.5rem;"></i></span></a></td>
            </tr>
            <?php
                    $total = $total + ($values["item_quantity"] * $values["item_price"]);
                }
            ?>
            <tr>
                <td colspan="3" align="right">Totalt</td>
                <td align="right"><?php echo number_format($total, 2); ?> kr</td>
                <td></td>
            </tr>
            <?php
            }
            ?>
                
        </table>
    </div>
</body>
</html>