<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="app.css">


</head>
<body>
    <h1>PHP Project</h1>
    <p id="p1">Healzapp uses PHP</p>

    <p id="date">
      
      <?php
        echo date("Y-m-d");
        echo "<br>";
        echo "Hello DODO<br>";

        $var1 = 5;
        echo $var1."<br>";
      
        $var2 = 7;
        echo $var2."<br>";

        if($_SERVER["REQUEST_METHOD"]=="POST"){
          $var3=htmlspecialchars($_POST["var3"]);
        }
      ?>

  <!-- HTML form should be outside PHP -->
        <form method="post">
          <label for="var3">Enter var1:</label>
          <input type="text" id="var3" name="var3">
          <button type="submit">Submit</button>
        </form>
        <?php echo "You entered: $var3<br>"; ?>

    </p>
</body>
</html>