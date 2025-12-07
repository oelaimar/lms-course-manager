<?php
require_once __DIR__ . "/assets/includes/header.php";

$coursId = $_GET['course_id'] ?? null;

$sqlCousrses = "SELECT * FROM courses WHERE id = ?";
$sqlSections = "SELECT * FROM sections WHERE course_id = ? ORDER BY position ASC";

$stmt = $conn->prepare($sqlSections);
$stmt->bind_param("i", $coursId);
$stmt->execute();

$data = $stmt->get_result();
$sections = $data->fetch_all(MYSQLI_ASSOC);

$stmt->close();

$stmt = $conn->prepare($sqlCousrses);
$stmt->bind_param("i", $coursId);
$stmt->execute();

$data = $stmt->get_result();
$courses = $data->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<div id="sectionsPage" class="page active">
    <div class="container">
        <div class="breadcrumb">
            <a href="../">Courses</a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current"><?php echo $courses[0]["title"] ?></span>
        </div>

        <div class="course-info-card">
            <h2 class="course-info-title"><?php echo $courses[0]["title"] ?></h2>
            <p><?php echo $courses[0]["descriptions"] ?></p>
            <div class="course-info-meta">
                <div class="meta-item">
                    <i class="fas fa-signal"></i>
                    <span><?php echo $courses[0]["levels"] ?> Level</span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-list"></i>
                    <span><?php echo count($sections); ?> sections</span>
                </div>
            </div>
        </div>

        <div class="page-header">
            <h1 class="page-title">Course Sections</h1>
            <button class="btn btn-primary" onclick="openSectionModal('sectionModal' , 0);">
                <i class="fas fa-plus"></i> Add Section
            </button>
        </div>

        <div class="sections-list">
            <?php $count = 0; ?>
            <?php foreach ($sections as $section): ?>
                <div class="section-card">
                    <div class="drag-handle">
                        <i class="fas fa-grip-vertical"></i>
                    </div>
                    <div class="section-content">
                        <div class="section-header">
                            <span class="section-number"><?php echo ++$count; ?></span>
                            <h3 class="section-title"><?php echo $section['title']; ?></h3>
                        </div>

                        <p class="section-text">
                            <?php echo $section['content']; ?>
                        </p>
                        <p class="section-text">
                            created at <?php echo $section["created_at"] ?>
                        </p>
                    </div>
                    <div class="section-actions">
                        <button class="btn-icon">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" style="color: #ef4444;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php
            echo empty($sections) ? "<div class='empty-state'>" : "<div class='empty-state' style='display: none;'>";
            ?>
                <div class="empty-state-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h2 class="empty-state-title">No Sections Yet</h2>
                <p class="empty-state-text">Get started by creating your first Section</p>
                <button class="btn btn-primary" onclick="openSectionModal('sectionModal' , 0);">
                    <i class="fas fa-plus"></i> Create Your First Section
                </button>
            </div>
        </div>
    </div>
</div>
<div id="sectionModal" class="modal-overlay" onclick="closeModal('courseModal')">
        <div class="modal" onclick="event.stopPropagation()">
            <div class="modal-header">
                <h2 class="modal-title">Add New Section</h2>
                <button class="close-modal" onclick="closeModal('sectionModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="sectionForm" action="sections_edit.php" method="POST">
                <div class="form-group">
                    <label class="form-label">Section Title</label>
                    <input type="text" class="form-input" placeholder="e.g., Introduction to Variables">
                </div>
                <div class="form-group">
                    <label class="form-label">Section Content</label>
                    <textarea class="form-textarea" placeholder="Enter the section content..."></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Position</label>
                    <input type="number" class="form-input" placeholder="1" min="1">
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('sectionModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Section</button>
                </div>
            </form>
        </div>
    </div>
<?php
require_once __DIR__ . "/assets/includes/footer.php";
?>