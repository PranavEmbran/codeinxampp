<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle reset first
    if (isset($_POST["reset"])) {
        $_SESSION["entries"] = [];
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Handle data submission
    if (isset($_POST["id"], $_POST["name"])) {
        $id = htmlspecialchars($_POST["id"]);
        $name = htmlspecialchars($_POST["name"]);
        $_SESSION['entries'][] = ["ID" => $id, "Name" => $name];

        // Prevent resubmission
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
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
      <button type="submit" name="self">Submit</button>
    </form>
  </div>

  <div class="entryTable">
    <style>
      .entryTable {
        display: flex;
        justify-content: center;
        margin-top: 20px;
      }

      .entryTable table {
        border-collapse: collapse;
        background-color: #d3d3d3;
        border: 3px solid black;
        box-shadow: 10px 10px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        text-align: center;
      }

      .entryTable th,
      .entryTable td {
        border: 1px solid black;
        padding: 10px 15px;
      }
    </style>

    <?php
    if (!empty($_SESSION['entries'])) {
        echo "<table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                </tr>
              </thead>
              <tbody>";

        foreach ($_SESSION['entries'] as $entry) {
            echo "<tr>
                    <td>{$entry['ID']}</td>
                    <td>{$entry['Name']}</td>
                  </tr>";
        }

        echo "</tbody></table>";
    }
    ?>
  </div>

  <form method="post">
    <button type="submit" name="reset">Reset</button>
  </form>
</body>
</html>
