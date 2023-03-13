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
          <a class="test" href="#kundkorg"><i class='fas fa-shopping-cart'></i></a>
          <input type="text" placeholder="Sök produkt">
          <a onclick="openNav()" class="icon">
            <i class="fa fa-bars"></i>
          </a>
        </div> 
      </div>
      <div class="products">
      <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Examensarbete";
   
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
          echo "fel";
          die("Connection failed: " . $conn->connect_error);
        }
      
        $sql = "SELECT articlenr, name, price FROM Products WHERE category=2";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "<div class='card'>";
            echo "<img src='bild2.jpg' alt='' style='width:100%'>";
            echo "<h2>".$row['name']."</h2>";
            echo "<p class='pris'>".$row['price']." kr</p>";
            echo "<p class='articlenr'>Artikelnummer: ".$row['articlenr']."</p>";
            echo "<button>Lägg i kundkorg <i class='fas fa-cart-plus'></i></button>";
            echo "</div>";
          }
        } else {
          echo "0 results";
        }
        $conn->close();
     ?>  
    </div>
</body>
</html>