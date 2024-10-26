<?php
// Include your database connection here (e.g., include 'database.php').

// Function to safely get the category details by ID using prepared statements
function getCategoryDetails($conn, $categoryId) {
    $sql = "SELECT id, name, class_name FROM categories WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $categoryId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["addCategory"])) {
        $categoryName = $_POST["categoryName"];
        $className = $_POST["className"];
        $imagePath = "uploads/categories/" . basename($_FILES["categoryImage"]["name"]);

        if (move_uploaded_file($_FILES["categoryImage"]["tmp_name"], $imagePath)) {
            $conn = new mysqli("localhost", "root", "", "sound");

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "INSERT INTO categories (name, class_name, image_path) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $categoryName, $className, $imagePath);

            if ($stmt->execute()) {
                header("Location: categories.php");
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $stmt->close();
            $conn->close();
        } else {
            echo "Sorry, there was an error uploading the category image.";
        }
    } elseif (isset($_POST["updateCategory"])) {
        $categoryId = $_POST["categoryId"];
        $categoryName = $_POST["categoryName"];
        $className = $_POST["className"];

        $conn = new mysqli("localhost", "root", "", "sound");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE categories SET name = ?, class_name = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $categoryName, $className, $categoryId);

        if ($stmt->execute()) {
            header("Location: categories.php");
            exit();
        } else {
            echo "Error updating category: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } elseif (isset($_POST["deleteCategory"])) {
        // Handle category deletion here
        $categoryId = $_POST["categoryId"];
        
        $conn = new mysqli("localhost", "root", "", "sound");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM categories WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $categoryId);

        if ($stmt->execute()) {
            header("Location: categories.php");
            exit();
        } else {
            echo "Error deleting category: " . $conn->error;
        }

        $stmt->close();
        $conn->close();
    }
}

// Fetch all categories for display
$conn = new mysqli("localhost", "root", "", "sound");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sqlCategories = "SELECT id, name, class_name FROM categories";
$resultCategories = $conn->query($sqlCategories);

$categories = []; // Initialize an empty array to store categories

if ($resultCategories->num_rows > 0) {
    while ($row = $resultCategories->fetch_assoc()) {
        $categories[] = $row;
    }
}

$conn->close();
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

<body class="user-profile">
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
          <li class="active ">
            <a href="./categories.php">
              <i class="now-ui-icons media-2_sound-wave"></i>
              <p>categories</p>
            </a>
          </li>
          <li >
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
       
          <li class="active-pro">
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
            <a class="navbar-brand" href="#pablo">Categories</a>
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
      <div class="content">
        <div class="row">
          <!-- Add categories form -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Add categories</h4>
              </div>
              <div class="card-body">
                <form action="categories.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="categoryName">Category Name</label>
                    <input type="text" class="form-control" name="categoryName" id="categoryName" required>
                  </div>
                  <div class="form-group">
                    <label for="className">Class Name</label>
                    <input type="text" class="form-control" name="className" id="className" required>
                  </div>
                  <div class="form-group">
                    <label for="categoryImage">Select Category Image</label>
                    <input type="file" class="form-control" name="categoryImage" id="categoryImage" required>
                  </div>
                  <button type="submit" class="btn btn-primary" name="addCategory">Add Category</button>
                </form>
              </div>
            </div>
          </div>
          <!-- Display categories in a table -->
          <div class="col-md-12">
    <div class="card card-plain">
        <div class="card-header">
            <h4 class="card-title">Categories</h4>
        </div>
        <div class="card-body">
            <?php if (empty($categories)) : ?>
            <p>No categories found.</p>
            <?php else : ?>
            <div class="table-responsive">
                <table class="table">
                    <thead class="text-primary">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Class Name</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category) : ?>
                        <tr>
                            <td><?php echo $category['id']; ?></td>
                            <td>
                                <!-- Edit Artist Name Button -->
                                <button class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral edit-artist"
                                    data-id="<?php echo $category['id']; ?>"
                                    data-name="<?php echo $category['name']; ?>"
                                    data-class-name="<?php echo $category['class_name']; ?>"
                                    title="Edit Artist Name">
                                    <i class="now-ui-icons ui-2_settings-90"></i>
                                </button>
                                <span class="editable-field"><?php echo $category['name']; ?></span>
                            </td>
                            <td>
                                <!-- Edit Class Name Button -->
                                <button class="btn btn-info btn-round btn-icon btn-icon-mini btn-neutral edit-class"
                                    data-id="<?php echo $category['id']; ?>"
                                    data-name="<?php echo $category['name']; ?>"
                                    data-class-name="<?php echo $category['class_name']; ?>"
                                    title="Edit Class Name">
                                    <i class="now-ui-icons ui-2_settings-90"></i>
                                </button>
                                <span class="editable-field"><?php echo $category['class_name']; ?></span>
                            </td>
                            <td class="text-right">
                            <form action="categories.php" method="POST">
    <input type="hidden" name="deleteCategory" value="1">
    <input type="hidden" name="categoryId" value="<?php echo $category['id']; ?>">
    <button type="submit" class="btn btn-danger btn-round btn-icon btn-icon-mini btn-neutral" title="Remove">
        <i class="now-ui-icons ui-1_simple-remove"></i>
    </button>
</form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Edit Artist Name and Class Name Form (Initially Hidden) -->
<div class="col-md-6" style="display: none;" id="editArtistForm">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Artist and Class</h4>
        </div>
        <div class="card-body">
            <form action="update_category.php" method="POST">
                <input type="hidden" name="categoryId" id="editCategoryId">
                <div class="form-group">
                    <label for="editArtistName">Artist Name</label>
                    <input type="text" class="form-control" name="editArtistName" id="editArtistName" required>
                </div>
                <div class="form-group">
                    <label for="editClassName">Class Name</label>
                    <input type="text" class="form-control" name="editClassName" id="editClassName" required>
                </div>
                <button type="submit" class="btn btn-primary" name="updateArtistClass">Update Artist and Class</button>
                <button type="button" class="btn btn-secondary" onclick="cancelEditArtist()">Cancel</button>
            </form>
        </div>
    </div>
</div>

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
document.addEventListener('DOMContentLoaded', function () {
    const editArtistForm = document.getElementById("editArtistForm");
    const editArtistName = document.getElementById("editArtistName");
    const editClassName = document.getElementById("editClassName");
    const editCategoryId = document.getElementById("editCategoryId");
    const editFormSubmitButton = document.querySelector("#editArtistForm button[type='submit']");

    const editArtistButtons = document.querySelectorAll(".edit-artist");
    const editClassButtons = document.querySelectorAll(".edit-class");
    const cancelEditArtistButton = document.querySelector("#editArtistForm button[type='button']");

    const removeCategoryButtons = document.querySelectorAll(".remove-category");

    // Function to populate the edit form with data
    function populateEditForm(id, name, className) {
        editCategoryId.value = id;
        editArtistName.value = name;
        editClassName.value = className;
    }

    // Show the edit form and hide the table
    function showEditForm() {
        editArtistForm.style.display = "block";
        document.querySelector(".table-responsive").style.display = "none";
    }

    // Hide the edit form and show the table
    function hideEditForm() {
        editArtistForm.style.display = "none";
        document.querySelector(".table-responsive").style.display = "block";
    }

    // Function to cancel editing artist name and class name
    function cancelEditArtist() {
        hideEditForm();
        // You can also clear the form fields here if needed
    }

    // Add click event listeners to the edit buttons for artist name and class name
    editArtistButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const id = button.getAttribute("data-id");
            const name = button.getAttribute("data-name");
            const className = button.getAttribute("data-class-name");
            populateEditForm(id, name, className);
            showEditForm();
        });
    });

    editClassButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const id = button.getAttribute("data-id");
            const name = button.getAttribute("data-name");
            const className = button.getAttribute("data-class-name");
            populateEditForm(id, name, className);
            showEditForm();
        });
    });

    // Function to handle category removal
    function removeCategory(id) {
    if (confirm("Are you sure you want to delete this category?")) {
        // Perform an AJAX request to delete the category on the server
        fetch(`delete_category.php?id=${id}`, {
            method: 'GET'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Category deleted successfully
                location.reload(); // Refresh the page
            } else {
                // Error deleting category
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting the category.');
        });
    }
}

    // Add click event listeners to the remove buttons
    removeCategoryButtons.forEach(function (button) {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const id = button.getAttribute("data-id");
            removeCategory(id);
        });
    });

    // Add click event listener to the cancel button
    cancelEditArtistButton.addEventListener("click", cancelEditArtist);
});
</script>

</body>

</html>