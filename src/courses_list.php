<?php
require_once __DIR__ . "/assets/includes/header.php";
?>
<?php
$success = $_GET['success'] ?? null;
?>
<?php if ($success === "1"): ?>
    <div id="alert-box" style="padding:10px; background:#d4edda; color:#155724; border-radius:5px; margin-bottom:15px; text-align:center;">
        Course created successfully 🎉
    </div>
<?php elseif ($success === "2"): ?>
    <div id="alert-box" style="padding:10px; background:#d4edda; color:#155724; border-radius:5px; margin-bottom:15px; text-align:center;">
        Course edited successfully 🎉
    </div>
<?php elseif ($success === "0"): ?>
    <div id="alert-box" style="padding:10px; background:#f8d7da; color:#721c24; border-radius:5px; margin-bottom:15px; text-align:center;">
        Failed to create course. (Shocking, I know.)
    </div>
<?php endif; ?>

<?php
$sql = "SELECT * FROM courses ORDER BY created_at DESC";
$data = $conn->query($sql);
$courses = $data->fetch_all(MYSQLI_ASSOC);
?>

<div id="coursesPage" class="page active">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Courses Management</h1>
            <button class="btn btn-primary" onclick="openModal('courseModal',0)">
                <i class="fas fa-plus"></i> Add New Course
            </button>
        </div>

        <div class="courses-grid">
            <?php foreach ($courses as $course): ?>
                <div class="course-card" id="course-card-<?php echo $course ["id"]?>">
                    <div class="course-header">
                        <span class="badge badge-<?php echo strtolower($course["levels"]) ?>"><?php echo $course["levels"] ?></span>
                    </div>
                    <h3 class="course-title"><?php echo $course["title"] ?></h3>
                    <p class="course-description">
                        <?php echo $course["descriptions"] ?>
                    </p>
                    <div class="course-footer">
                        <div class="action-buttons">
                            <a href="sections_by_course.php?course_id=<?php echo $course['id'] ?>">
                                <button class="btn btn-secondary">
                                    <i class="fas fa-list"></i> View Sections
                                </button>
                            </a>
                            <button class="btn-icon" onclick="openModal('courseModal', <?php echo $course['id'] ?>)">
                                <i class="fas fa-edit"></i>
                            </button>
                            <a href="courses_delete.php?id=<?php echo $course['id'] ?>">
                                <button class="btn-icon" style="color: #ef4444;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                    <div>
                        <p>created at <?php echo $course["created_at"] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
        echo empty($courses) ? "<div class='empty-state'>" : "<div class='empty-state' style='display: none;'>";
        ?>

        <div class="empty-state-icon">
            <i class="fas fa-book-open"></i>
        </div>
        <h2 class="empty-state-title">No Courses Yet</h2>
        <p class="empty-state-text">Get started by creating your first course</p>
        <button class="btn btn-primary" onclick="openModal('courseModal', 0)">
            <i class="fas fa-plus"></i> Create Your First Course
        </button>
    </div>
</div>
</div>
<div id="courseModal" class="modal-overlay" onclick="closeModal('courseModal')">
    <div class="modal" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2 id="modal-title" class="modal-title">Add New Course</h2>
            <button class="close-modal" onclick="closeModal('courseModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="courseForum" action="courses_create.php" method="POST">
            <div class="form-group">
                <span style="color: #d9534f; font-size: 16px; background-color: #f2dede;" id="errorCourseTitle"></span>
                <label class="form-label">Course Title</label>
                <input id="courseTitle" type="text" class="form-input" name="title" placeholder="e.g., Introduction to Python Programming">
            </div>
            <div class="form-group">
                <span style="color: #d9534f; font-size: 16px; background-color: #f2dede" id="errorCourseDescription"></span>
                <label class="form-label">Description</label>
                <textarea id="courseDescription" class="form-textarea" name="description" placeholder="Describe what students will learn in this course..."></textarea>
            </div>
            <div class="form-group">
                <span style="color: #d9534f; font-size: 16px; background-color: #f2dede;" id="errorCoursLevel"></span>
                <label class="form-label">Level</label>
                <select id="coursLevel" class="form-select" name="level">
                    <option value="">Select level...</option>
                    <option value="Beginner">Beginner</option>
                    <option value="Intermediate">Intermediate</option>
                    <option value="Advanced">Advanced</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('courseModal')">Cancel</button>
                <button id="submitBtn" type="submit" class="btn btn-primary">Create Course</button>
            </div>
        </form>
    </div>
</div>

<?php
require_once __DIR__ . "/assets/includes/footer.php";
?>