<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./fontawesome-free-6.3.0-web/css/all.min.css">
    <script type="text/JavaScript" src="script.js"></script>
</head>
<body>
    <div class="navBar" id="myNavBar">
        <div class="navBarLeft">
          <a href="Home.html" class="home active">E-handel</a>
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
          <a href="shopping-cart.php">Kundvagn <i class='fas fa-shopping-cart'></i></a>
          <form action="search.php" method="POST" class="searchForm">
            <input type="text" name="word" placeholder="Sök produkt" id="searchBox"/>
            <input type="submit" name="search" id="searchBtn" value="Sök"/>
          </form>
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
            
            if(isset($_POST['search']))
            {
                
                $search = $_POST['word'];
                $stmt = "SELECT * FROM Products WHERE name LIKE '%$search%'";

                $count = "SELECT COUNT(articlenr) AS 'hitCount' FROM Products WHERE name LIKE '%$search%'";
          
                $countResult = $conn->query($count);
                $hitResult = $countResult->fetch_assoc();
                echo "<p>";
                echo $hitResult['hitCount']." träffar.";
                echo "</p>";
               
                define('XOAUTH_USERNAME', $hitResult['hitCount']);
        
                $result = $conn->query($stmt);
                if ($result->num_rows > 0) {
                // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='card'>";
                        echo "<img src='Desktop/".$row['picture'].".jpg' alt='' style='width:100%'>";
                        echo "<h2>".$row['name']."</h2>";
                        echo "<p class='pris'>".$row['price']." kr</p>";
                        echo "<p class='articlenr'>Artikelnummer: ".$row['articlenr']."</p>";
                        echo "<form action='' method='POST' style='display: flex; justify-content: center; margin: 20px; font-size: 1.3rem;'>";
                        echo "<input type='hidden' name='articlenr' value='".$row['articlenr']."'</>";
                        echo "<input type='hidden' name='searchValue' value='".$search."'</>";
                        echo "<input type='submit' name='text' value='Beskrivning ' style='border: none; background: none; color: grey; cursor: pointer;'</>";
                        echo "<i class='fa-solid fa-circle-info'></i>";
                        echo "</form>";
                        echo "<form action='shopping-cart.php' method='POST' class='addCart'>";
                        echo "<input type='text' class='quantity' name='quantity' value='1'</>";
                        echo "<input type='hidden' name='name' value='".$row['name']."'</>";
                        echo "<input type='hidden' name='price' value='".$row['price']."'</>";
                        echo "<input type='hidden' name='articlenr' value='".$row['articlenr']."'</>";
                        echo "<input id='cardBtn' type='submit' name='add' value='Lägg i kundkorg'</>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                echo "0 results";
                }
                
                $conn->close();       
            }
           
            if(isset($_POST["text"])){
                
                $article = $_POST['articlenr'];
                $searchValue = $_POST['searchValue'];

                $stmt = "select * from Products where name like '%$searchValue%'";
        
                $result = $conn->query($stmt);
                if ($result->num_rows > 0) {
                // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<div class='card'>";
                        echo "<img src='Desktop/".$row['picture'].".jpg' alt='' style='width:100%'>";
                        echo "<h2>".$row['name']."</h2>";
                        echo "<p class='pris'>".$row['price']." kr</p>";
                        echo "<p class='articlenr'>Artikelnummer: ".$row['articlenr']."</p>";
                        echo "<form action='' method='POST' style='display: flex; justify-content: center; margin: 20px; font-size: 1.3rem;'>";
                        echo "<input type='hidden' name='articlenr' value='".$row['articlenr']."'</>";
                        echo "<input type='hidden' name='searchValue' value='".$search."'</>";
                        echo "<input type='submit' name='text' value='Beskrivning ' style='border: none; background: none; color: grey; cursor: pointer;'</>";
                        echo "<i class='fa-solid fa-circle-info'></i>";
                        echo "</form>";
                        echo "<form action='shopping-cart.php' method='POST' class='addCart'>";
                        echo "<input type='text' class='quantity' name='quantity' value='1'</>";
                        echo "<input type='hidden' name='name' value='".$row['name']."'</>";
                        echo "<input type='hidden' name='price' value='".$row['price']."'</>";
                        echo "<input type='hidden' name='articlenr' value='".$row['articlenr']."'</>";
                        echo "<input id='cardBtn' type='submit' name='add' value='Lägg i kundkorg'</>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                echo "0 results";
                }

                $stmt = "select * from Products where ".$article."=articlenr";
      
                $result = $conn->query($stmt);
        
                if ($result->num_rows > 0) {
                  echo "<div id='productModal' class='modal'>";
                  echo "<div class='modal-content'>";
                  echo "<button onclick='closeModal();' class='close'>&times;</button>";
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  echo "<p>".$row['description']."</p>"; 
                }
                } else {
                echo "0 results";
                }
                echo "</div>";
                echo "</div>";
              }
            
        ?> 
        </div> 
        <script>
        localStorage.setItem('hits', '<?=XOAUTH_USERNAME?>'); 
        </script>
</body>
</html>