<?php
session_start();
include('../includes/config.php'); 
include('../includes/functions.php'); 

$class_id = intval($_GET['class_id'] ?? 0);
if (isset($_POST['submit'])) {
    $post_class_id = intval($_POST['class_id']);
    $name = trim($_POST['name']);

    if ($post_class_id && $name !== '') {
        $stmt = $conn->prepare("INSERT INTO subjects (class_id, name) VALUES (?, ?)");
        $stmt->bind_param("is", $post_class_id, $name);
        $stmt->execute();
    }

    header("location: subjects.php?class_id=" . $post_class_id);
    exit();
}
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);

    $stmt = $conn->prepare("DELETE FROM subjects WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    header("location: subjects.php?class_id=" . $class_id);
    exit();
}

include('header.php');
include('sidebar.php');
?>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h3 class="mb-0">Manage Subjects</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-md-4">
                    <label class="form-label">Select Class</label>
                    <select name="class_id" class="form-select" onchange="location = 'subjects.php?class_id=' + this.value;">
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
            </div>

            <?php if ($class_id) { ?>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Add Subject</h5>
                                <form method="POST">
                                    <input type="hidden" name="class_id" value="<?=$class_id?>">
                                    <div class="mb-3">
                                        <label class="form-label">Subject Name</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Add Subject</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card h-100">
                            <div class="card-body">
                                <h4 class="mb-3">Subjects</h4>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width:60px;">S.No.</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $count = 1;
                                        $stmt = $conn->prepare("SELECT * FROM subjects WHERE class_id = ?");
                                        $stmt->bind_param("i", $class_id);
                                        $stmt->execute();
                                        $subject_query = $stmt->get_result();

                                        while ($subject = mysqli_fetch_object($subject_query)) {
                                        ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= htmlspecialchars($subject->name) ?></td>
											<td>
                                                <a href="subjects.php?class_id=<?=$class_id?>&delete=<?=$subject->id?>"
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Delete this subject?');">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <p class="text-muted">Please select a class you want to add the subject to.</p>
            <?php } ?>

        </div>
    </div>
</main>
<?php include('footer.php'); ?>