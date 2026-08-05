<?php 
include('../includes/config.php'); 
include('../includes/functions.php'); 
?>
<?php
$class_id = intval($_GET['class_id'] ?? 0);
$subject_id = intval($_GET['subject_id'] ?? 0);
if (isset($_POST['submit'])) {

    $title = $_POST['name'];
    $class_id = $_POST['class_id'];
    $subject_id = $_POST['subject_id'];
    $target_dir = "./uploads/";
    $file_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $file_name;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    $allowedTypes = array( "jpg", "jpeg", "png", "gif", "pdf", "doc", "docx", "ppt", "pptx", "xls", "xlsx", "zip");

    if (file_exists($target_file)) {
        echo "File already exists.";
        $uploadOk = 0;
    }
    if ($_FILES["image"]["size"] > 10 * 1024 * 1024) {
        echo "Sorry, file size must be less than 10 MB.";
        $uploadOk = 0;
    }

    if (!in_array($fileType, $allowedTypes)) {
        echo "Only JPG, PNG, JPEG, GIF, PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX and ZIP files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

            // Save only the filename in the database
            $filename = $file_name;
            //QUERY
        $stmt = $conn->prepare("INSERT INTO study_materials(title, class_id, subject_id, file) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siis", $title, $class_id, $subject_id, $filename);
        $stmt->execute();
        $_SESSION['success'] = "Material Added Successfully!";
        header("Location: add_study_material.php?class_id=" . $class_id);
        exit();

        } else {
            echo "Sorry, there was an error uploading the file.";
        }

    } else {
        echo "Sorry, the file was not uploaded.";
    }
    }
?>
<?php 
include('header.php');
include('sidebar.php');
?>

<main class="app-main">
    <div class="app-content-header">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Manage Courses <br> </h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                       Add Courses
                    </li>
                </ol>
            </div>
		</div>
    <div class="app-content">
        <div class="container-fluid">
            <!-- Teacher Page Content -->
            <div class="card">
                <div class="card-header">
                    <h5>Add New Course</h5>
                </div>

                <div class="card-body">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success">
                            <?php echo htmlspecialchars($_SESSION['success']); ?>
                        </div>
                    <?php unset($_SESSION['success']); endif; ?>
                    <form action="" method="POST" enctype="multipart/form-data">

                        <!-- Course Name -->
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text"
                                name="name"
                                class="form-control"
                                placeholder="Title"
                                required>
                                </div>
                                <!--Class -->
                                <div class="mb-3">
                                <label class="form-label">Select Class</label>
                                <select name="class_id" class="form-select"
                                onchange="location='add_study_material.php?class_id='+this.value;">
                                <option value="">-- Select Class --</option>
                                        <?php
                                        $classes = get_the_classes($conn);
                                        foreach ($classes as $value) { ?>
                                            <option value="<?=$value->id?>" <?= $value->id == $class_id ? 'selected' : '' ?>>
                                                <?=htmlspecialchars($value->title)?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                <label class="form-label">Select Subject</label>
                                <select name="subject_id" class="form-select">
                                <option value="">-- Select Subject --</option>

                                <?php
                                if ($class_id) {

                                $stmt = $conn->prepare("SELECT id, name FROM subjects WHERE class_id = ?");
                                $stmt->bind_param("i", $class_id);
                                $stmt->execute();

                                $result = $stmt->get_result();

                                while ($row = $result->fetch_object()) {
                                ?>
                                <option value="<?= $row->id ?>">
                                    <?= htmlspecialchars($row->name) ?>
                                </option>
                                <?php
                                }
                                }
                                ?>
                                </select>
                                </div>
                                <!-- Thumbnail -->
                                <div class="mb-3">
                                    <label class="form-label">Course Thumbnail</label>
                                    <input type="file"
                                        name="image"
                                        class="form-control"
                                        accept="image/*">
                                </div>

                                <!-- Submit -->
                                <button type="submit"
                                        name="submit"
                                        class="btn btn-success">
                                    Submit
                                </button>

                            </form>

                            </div>
                            </div>
                            </main>
<?php include('footer.php');?>
