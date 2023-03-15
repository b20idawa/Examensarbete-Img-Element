<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action=Form.php  method=POST>
        <label for="articlenr">Articlenummer: </label><br>
        <input type="text" id="articlenr" name="articlenr" Placeholder="Articlenummer"><br>
        <label for="name">Namn: </label><br>
        <input type="text" id="name" name="name" Placeholder="Namn"><br>
        <label for="price">Pris: </label><br>
        <input type="text" id="price" name="price" Placeholder="Pris"><br>
        <label for="category">Kategori: </label><br>
        <input type="text" id="category" name="category" Placeholder="Kategori"><br><br>
        <input id="submit" type="submit" value="Skicka">
    </form>



    <?php
        $conn = mysqli_connect("localhost", "root", "", "Examensarbete");
        
        // Check connection
        if($conn === false){
            die("ERROR: Could not connect. "
                . mysqli_connect_error());
        }
        
        // Taking all 4 values from the form data(input)
        $articlenr =  $_REQUEST['articlenr'];
        $name = $_REQUEST['name'];
        $price =  $_REQUEST['price'];
        $category = $_REQUEST['category'];

        
        // Performing insert query execution
        // here our table name is college
        $sql = "INSERT INTO Products  VALUES ('$articlenr',
            '$name','$price','$category')";
        
        if(mysqli_query($conn, $sql)){
            echo "<h3>Data stored in database successfully</h3>";

            echo nl2br("\n$articlenr\n $name\n "
                . "$price\n $category");
        } else{
            echo "ERROR: Hush! Sorry $sql. "
                . mysqli_error($conn);
        }
        
        // Close connection
        mysqli_close($conn);
    ?>
    
</body>
</html>