<?php
  session_start();
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Form Field Entry</title>
  <link rel="stylesheet" href="app.css">

</head>

<body>
  <div class="form-container">
    <h2>Form Field Entry</h2>
    <form method="post">
      <div class="form-group">
        <label for="id">Enter ID:</label>
        <input type="text" id="id" name="id" />
      </div>
      <div class="form-group">
        <label for="name">Enter name:</label>
        <input type="text" id="name" name="name" />
      </div>
      <button type="submit">Submit</button>
    </form>
</div>

  <div class="entryTable">

    <?php

    echo 
    "<style>
    .entryTable {
    display: flex;
    justify-content: center;   /* Horizontally centers child elements */
    margin-top: 20px;
  }
  
  .entryTable table {
    border-collapse: collapse;
    background-color:#d3d3d3;
    border: 3px solid black;
    box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    overflow: hidden; /* Needed for rounded corners to clip */
    text-align: center;
  }
  
  .entryTable th, .entryTable td {
    border: 1px solid black;
    padding: 10px 15px;
  }
    </style>";
    
    if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["id"], $_POST["name"])){
      $id=htmlspecialchars($_POST["id"]);
      $name=htmlspecialchars($_POST["name"]);
      $_SESSION['entries'][]=[ "ID" => $id, "Name" => $name];
      
      echo 
        "<table>
        <thead >
          <tr>
          <th>ID</th>
          <th>Name</th>
          </tr>
        </thead>
      <tbody>";
      
      foreach ($_SESSION['entries'] as $entry)
      {        
        echo 
        "<tr>
          <td> {$entry['ID']}</td>
          <td> {$entry['Name']}</td>
        </tr>";
      }
      
    }
    echo "</tbody> </table>";
    //<tr>echo $id;</tr>
    //<tr>echo $name;</tr>
    ?>
  </div>
 
  <form action="" method="POST">
    <button type="submit" name="reset">Reset</button>    
  </form>
  <?php
    if(isset($_POST["reset"])){
      $_SESSION["entries"]=[];
    }
  ?>

</body>
</html>