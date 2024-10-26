<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=sound', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the existing data from the database
    $stmt = $pdo->query("SELECT id, description FROM subscription_chart");
    $chartData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if a POST request is made to update the data
    if (isset($_POST['id'], $_POST['description'])) {
        $ids = $_POST['id'];
        $descriptions = $_POST['description'];

        // Loop through the IDs and descriptions to update the database
        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            $description = $descriptions[$i];

            if ($id === "") {
                // Insert a new row if ID is empty
                $sql = "INSERT INTO subscription_chart (description) VALUES (:description)";
            } else {
                // Update the existing row if ID is not empty
                $sql = "UPDATE subscription_chart SET description = :description WHERE id = :id";
            }

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->execute();
        }

        // Check if the "insertNewRows" flag is set and insert new rows
        if (isset($_POST['insertNewRows']) && $_POST['insertNewRows'] === "true") {
            $newDescriptions = $_POST['newDescription'];

            foreach ($newDescriptions as $newDescription) {
                // Insert new rows with descriptions
                $sql = "INSERT INTO subscription_chart (description) VALUES (:newDescription)";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':newDescription', $newDescription, PDO::PARAM_STR);
                $stmt->execute();
            }
        }

        // Fetch the updated data from the database
        $stmt = $pdo->query("SELECT id, description FROM subscription_chart");
        $chartData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "Chart data saved successfully!";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    $pdo = null;
}
?>








<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
 
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
   Admin
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
  <div class="sidebar" data-color="blue">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="dashboard.php" class="simple-text logo-mini">
          SL
        </a>
        <a href="dashboard.php" class="simple-text logo-normal">
          SolMusic
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li >
            <a href="./dashboard.php">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="./categories.php">
              <i class="now-ui-icons media-2_sound-wave"></i>
              <p>categories</p>
            </a>
          </li>
          <li>
            <a href="./files.php">
              <i class="now-ui-icons location_map-big"></i>
              <p>files</p>
            </a>
          </li>
      
          <li>
            <a href="./user.php">
              <i class="now-ui-icons users_single-02"></i>
              <p>Users</p>
            </a>
          </li>
          <li>
            <a href="./tables.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>forms</p>
            </a>
          </li>
       
          <li  class="active-pro">
            <a href="./upgrade.php">
              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
              <p>upgrade</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">SUbscription</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           
            <ul class="navbar-nav">
             
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="logout.php">Logout</a>
                  <a class="dropdown-item" href="update.php">Change login info</a>
                </div>
              </li>
              
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      </div>
      <div  class="content">
    <div class="row">
      <div class="col-md-8 ml-auto mr-auto">
    <div class="card card-upgrade">
        <div class="card-header text-center">
          <h4 class="card-title">SolMusic premium subscription</h3>
            <p class="card-category">Are you looking for more components? Please check our Premium Version of Now UI Dashboard PRO.</p>
        </div>
        <div class="card-body">
          <div class="table-responsive table-upgrade">
            <table class="table">
              <thead>
                <th></th>
                <th class="text-center">Free</th>
                <th class="text-center">PRO</th>
              </thead>
              <tbody>

<?php foreach ($chartData as $data) { ?>
<tr>
<td contenteditable="true" data-id="<?php echo $data['id']; ?>"><?php echo $data['description']; ?></td>
  <td class="text-center"><i class="fas fa-times text-danger"></i></td>
  <td class="text-center"><i class="fas fa-check text-success"></i></td>
  <td class="text-center"><i class="fas fa-star text-warning"></i></td>
</tr>
<?php } ?>

                <tr>
                  <td></td>
                  <td class="text-center">Free</td>
                  <td class="text-center">Just $49</td>
                </tr>
                <tr>
                  <td class="text-center"></td>
                  <td class="text-center">
                    <a href="#" class="btn btn-round btn-default disabled">Current Version</a>
                  </td>
                  <td class="text-center">
                    <a target="_blank" href="#" class="btn btn-round btn-primary">Upgrade to PRO</a>
                  </td>
                </tr>
                
              </tbody>
            </table>
          </div>
          <button id="add-row-button" class="btn btn-success">Add Row</button>
          <button id="save-button" class="btn btn-primary">Save Changes</button>
        </div>
      </div>
    </div>
  </div>
</div>
      
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script><!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>

  
  <script>
    document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.querySelector("tbody");
    const saveButton = document.getElementById("save-button");
    const addRowButton = document.getElementById("add-row-button");

    // Function to add a new row
    let isEven = false; // Flag to track if the next row should be even or odd

    function addRow() {
        const newRow = document.createElement("tr");
        newRow.innerHTML = `
            <td contenteditable="true" data-id="">New Row</td>
            <td class="text-center"><i class="fas fa-times text-danger"></i></td>
            <td class="text-center"><i class="fas fa-check text-success"></i></td>
            <td class="text-center"><i class="fas fa-star text-warning"></i></td>
        `;

        if (isEven) {
            // Insert the new even row before the "Upgrade to PRO" row
            tableBody.insertBefore(newRow, tableBody.lastElementChild);
        } else {
            // Insert the new odd row before the "Current Version" row
            tableBody.insertBefore(newRow, tableBody.lastElementChild.previousElementSibling);
        }

        isEven = !isEven; // Toggle the flag for the next row
    }

    addRowButton.addEventListener("click", addRow);

    saveButton.addEventListener("click", function () {
        // Get the edited data directly from the contenteditable elements
        const editableTds = document.querySelectorAll('[contenteditable="true"]');
        const chartData = [];
        const newDescriptions = []; // To store new row descriptions

        editableTds.forEach((td) => {
            const id = td.getAttribute("data-id");
            const description = td.textContent.trim();
            
            if (id === "") {
                // If ID is empty, it's a new row
                newDescriptions.push(description); // Store the new description
            } else {
                chartData.push({ id, description });
            }
        });

        // Send the chartData to the server using a form submission
        const form = document.createElement("form");
        form.method = "post";
        form.action = "upgrade.php"; // Replace with the correct PHP script URL

        chartData.forEach((data) => {
            const idInput = document.createElement("input");
            idInput.type = "hidden";
            idInput.name = "id[]";
            idInput.value = data.id;
            form.appendChild(idInput);

            const descriptionInput = document.createElement("input");
            descriptionInput.type = "hidden";
            descriptionInput.name = "description[]";
            descriptionInput.value = data.description;
            form.appendChild(descriptionInput);
        });

        // Send a flag to the server to indicate that it should also insert new rows
        const insertNewRowsInput = document.createElement("input");
        insertNewRowsInput.type = "hidden";
        insertNewRowsInput.name = "insertNewRows";
        insertNewRowsInput.value = "true";
        form.appendChild(insertNewRowsInput);

        // Send the new row descriptions to the server
        newDescriptions.forEach((newDescription) => {
            const newDescriptionInput = document.createElement("input");
            newDescriptionInput.type = "hidden";
            newDescriptionInput.name = "newDescription[]";
            newDescriptionInput.value = newDescription;
            form.appendChild(newDescriptionInput);
        });

        document.body.appendChild(form);
        form.submit();
    });
});

  </script>


</body>

</html>