<?php
require_once __DIR__ . "/assets/includes/header.php";

$coursId = $_GET['course_id'] ?? null;
$success = $_GET['success'] ?? null;

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

<?php if ($success === "1"): ?>
    <div class="toast-container">
        <div id="alert-box" class="toast toast-success">
            <div class="toast-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">Success!</div>
                <div class="toast-message">Section created successfully</div>
            </div>
        </div>
    </div>
<?php elseif ($success === "2"): ?>
    <div class="toast-container">
        <div id="alert-box" class="toast toast-success">
            <div class="toast-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">Success!</div>
                <div class="toast-message">Section edited successfully</div>
            </div>
        </div>
    </div>
<?php elseif ($success === "3"): ?>
    <div class="toast-container">
        <div id="alert-box" class="toast toast-success">
            <div class="toast-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">Success!</div>
                <div class="toast-message">Section deleted successfully</div>
            </div>
        </div>
    </div>
<?php elseif ($success === "0"): ?>
    <div class="toast-container">
        <div id="alert-box" class="toast toast-error">
            <div class="toast-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <div class="toast-content">
                <div class="toast-title">Error</div>
                <div class="toast-message">Something went wrong</div>
            </div>
        </div>
    </div>
<?php endif; ?>

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
                <div class="section-card" id="Section-card-<?php echo $section["id"] ?>">
                    <div class="drag-handle">
                        <i class="fas fa-grip-vertical"></i>
                    </div>
                    <div class="section-content">
                        <div class="section-header">
                            <p style="display: none;" class="position"><?php echo $section["position"] ?></p>
                            <span class="section-number"><?php echo ++$count; ?></span>
                            <h3 class="section-title"><?php echo $section['title']; ?></h3>
                        </div>

                        <p class="section-text">
                            <?php echo $section['content']; ?>
                        </p>
                        <p class="section-creation">
                            created at <?php echo $section["created_at"] ?>
                        </p>
                    </div>
                    <div class="section-actions">
                        <button class="btn-icon" onclick="openSectionModal('sectionModal', <?php echo $section['id'] ?>)">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn-icon" style="color: #ef4444;" onclick="openDeleteModal('deleteSectionModal', <?php echo $section['id'] ?>)">
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
<div id="sectionModal" class="modal-overlay" onclick="closeModal('sectionModal')">
    <div class="modal" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2 id="modal-title-section" class="modal-title">Add New Section</h2>
            <button class="close-modal" onclick="closeModal('sectionModal')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <form id="sectionForm" action="sections_edit.php" method="POST">
            <div class="form-group">
                <span style="color: #d9534f; font-size: 16px; background-color: #f2dede;" id="errorSectionTitle"></span>
                <label class="form-label">Section Title</label>
                <input id="sectionTitle" type="text" name="SectionTitle" class="form-input" placeholder="e.g., Introduction to Variables">
            </div>
            <div class="form-group">
                <span style="color: #d9534f; font-size: 16px; background-color: #f2dede;" id="errorSectionDescription"></span>
                <label class="form-label">Section Content</label>
                <textarea id="sectionDescription" name="sectionContent" class="form-textarea" placeholder="Enter the section content..."></textarea>
            </div>
            <div class="form-group">
                <span style="color: #d9534f; font-size: 16px; background-color: #f2dede;" id="errorSectionPosition"></span>
                <label class="form-label">Position</label>
                <input id="sectionPosition" type="number" name="position" class="form-input" placeholder="1" min="1">
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('sectionModal')">Cancel</button>
                <button id="submitBtnSection" type="submit" class="btn btn-primary">Add Section</button>
            </div>
            <input type="hidden" name="course_id" value="<?php echo $courses[0]["id"] ?>">
        </form>
    </div>
</div>

<div id="deleteSectionModal" class="modal-overlay" onclick="closeModal('deleteSectionModal')">
    <div class="modal" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2 class="modal-title text-center">Delete Section: </h2>
        </div>
        <div class="modal-content">
            <div class="modal-icon modal-icon-danger">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <p class="modal-text">
                Are you sure you want to delete this Section? This action cannot be undone.
            </p>
            <div class="modal-warning">
                <p class="modal-warning-text">
                    <i class="fas fa-info-circle"></i>
                    The sections will be permanently deleted.
                </p>
            </div>
            <form id="deleteSectionForm" action="sections_delete.php" method="POST">
                <div class="form-actions">
                    <input type="hidden" name="course_id" value="<?php echo $courses[0]["id"] ?>">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('deleteSectionModal')">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                        Delete Section
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
require_once __DIR__ . "/assets/includes/footer.php";
?>