//gloabal varialbles
const modalTitle = document.getElementById('modal-title') as HTMLElement;
const courseForum = document.getElementById('courseForum') as HTMLFormElement;
const submitBtn = document.getElementById('submitBtn') as HTMLButtonElement;

const courseTitle = document.getElementById('courseTitle') as HTMLInputElement;
const courseDescription = document.getElementById('courseDescription') as HTMLInputElement;
const coursLevel = document.getElementById('coursLevel') as HTMLInputElement;

const errorCourseTitle = document.getElementById('errorCourseTitle') as HTMLElement;
const errorCourseDescription = document.getElementById('errorCourseDescription') as HTMLTextAreaElement;
const errorCoursLevel = document.getElementById('errorCoursLevel') as HTMLElement;

const deleteTilteModal = document.querySelector('#deleteModal .text-center') as HTMLElement;
const deleteForm = document.getElementById('deleteForm') as HTMLFormElement;

const modalSectiontitle = document.getElementById('modal-title-section') as HTMLElement;
const sectionForum = document.getElementById('sectionForm') as HTMLFormElement;
const submitBtnSection = document.getElementById('submitBtnSection') as HTMLButtonElement;

const errorSectionTitle = document.getElementById('errorSectionTitle') as HTMLElement;
const errorSectionDescription = document.getElementById('errorSectionDescription') as HTMLTextAreaElement;
const errorSectionPosition = document.getElementById('errorSectionPosition') as HTMLElement;

const sectionTitle = document.getElementById('sectionTitle') as HTMLInputElement;
const sectionDescription = document.getElementById('sectionDescription') as HTMLInputElement;
const sectionPosition = document.getElementById('sectionPosition') as HTMLInputElement;

const deleteTilteSectionModal = document.querySelector('#deleteSectionModal .text-center') as HTMLElement;
const deleteSectionForm = document.getElementById('deleteSectionForm') as HTMLFormElement;

//open modals for add and edit a course
function openModal(modalId: string, id: number): void {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.add("active");

    courseForum.addEventListener('submit', validationCourseForum);

    if (id == 0) {
        modalTitle.textContent = "Add New Course";
        courseForum.action = "courses_create.php";
        submitBtn.textContent = "Create Course";

    } else {
        modalTitle.textContent = "Edit Course";
        courseForum.action = "courses_edit.php?id=" + id;
        submitBtn.textContent = "Edit Course";

        const titleToEdit = document.querySelector(`#course-card-${id} .course-title`) as HTMLElement;
        const descriptionToEdit = document.querySelector(`#course-card-${id} .course-description`) as HTMLElement;
        const LevelToEdit = document.querySelector(`#course-card-${id} .badge`) as HTMLElement;

        //filed the values
        courseTitle.value = titleToEdit.innerText;
        courseDescription.value = descriptionToEdit.innerText;
        coursLevel.value = LevelToEdit.innerText;

    }
}

//open modal for delete a course
function openDeleteModal(modalId: string, id: number): void {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.add("active");

    if (modalId === "deleteModal") {
        const titleToDelet = document.querySelector(`#course-card-${id} .course-title`) as HTMLElement;

        deleteTilteModal.textContent = "Delete Course: " + titleToDelet.innerText;
        deleteForm.action = "courses_delete.php?id=" + id;
    }
    if (modalId === "deleteSectionModal") {
        const titleToDelet = document.querySelector(`#Section-card-${id} .section-title`) as HTMLElement;

        deleteTilteSectionModal.textContent = "Delete Section: " + titleToDelet.innerText;
        deleteSectionForm.action = "sections_delete.php?id=" + id;

    }

}

//validation after add or edit a course
function validationCourseForum(e: Event): void {
    e.preventDefault();

    let isValid = true;

    if (courseTitle.value.trim() == "") {
        errorCourseTitle.textContent = "the title must be valid"
        isValid = false;
    }
    if (courseDescription.value.trim() == "") {
        errorCourseDescription.textContent = "the description must be valid"
        isValid = false;
    }
    if (coursLevel.value.trim() == "") {
        errorCoursLevel.textContent = "the level must be valid"
        isValid = false;
    }

    if (isValid) {
        errorCourseTitle.textContent = "";
        errorCourseDescription.textContent = "";
        errorCoursLevel.textContent = "";

        courseForum.submit();
    }
}

//close modal for edit delete update
function closeModal(modalId: string): void {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.remove("active");
    if (modalId === 'courseModal') {
        errorCourseTitle.textContent = "";
        errorCourseDescription.textContent = "";
        errorCoursLevel.textContent = "";
    }
    if (modalId === 'sectionModal') {
        errorSectionTitle.textContent = "";
        errorSectionDescription.textContent = "";
        errorSectionPosition.textContent = "";
    }

    sectionTitle.value = "";
    sectionDescription.value = "";
    sectionPosition.value = "";

    courseTitle.value = "";
    courseDescription.value = "";
    coursLevel.value = "";
}

//time out for the alert message
let timeOutAlert;

if (timeOutAlert) {
    clearTimeout(timeOutAlert);
}

timeOutAlert = setTimeout(() => {
    const alertBox = document.getElementById("alert-box");
    if (alertBox) {
        alertBox.style.opacity = "0";
        alertBox.style.transition = "opacity 0.8s ease";
        setTimeout(() => alertBox.remove(), 800);
    }
}, 5000);

//open modals for add and edit a section
function openSectionModal(modalId: string, id: number): void {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.add("active");

    sectionForum.addEventListener('submit', validationSectionForum);

    if (id == 0) {
        modalSectiontitle.textContent = "Add New Section";
        sectionForum.action = "sections_create.php";
        submitBtnSection.textContent = "Create Section";

    } else {
        modalSectiontitle.textContent = "Edit Section";
        sectionForum.action = "sections_edit.php?id=" + id;
        submitBtnSection.textContent = "Edit Section";

        const titleToEdit = document.querySelector(`#Section-card-${id} .section-title`) as HTMLElement;
        const textToEdit = document.querySelector(`#Section-card-${id} .section-text`) as HTMLElement;
        const positionToEdit = document.querySelector(`#Section-card-${id} .position`) as HTMLElement;

        //filed the values
        sectionTitle.value = titleToEdit.innerText;
        sectionDescription.value = textToEdit.innerText;
        sectionPosition.value = positionToEdit.innerText;

    }
}

function validationSectionForum(e: Event) {
    e.preventDefault();

    let isValid = true;

    if (sectionTitle.value.trim() == "") {
        errorSectionTitle.textContent = "the title must be valid"
        isValid = false;
    }
    if (sectionDescription.value.trim() == "") {
        errorSectionDescription.textContent = "the Content must be valid"
        isValid = false;
    }
    if (sectionPosition.value.trim() == "") {
        errorSectionPosition.textContent = "the Position must be valid"
        isValid = false;
    }

    if (isValid) {
        errorSectionTitle.textContent = "";
        errorSectionDescription.textContent = "";
        errorSectionPosition.textContent = "";

        sectionForum.submit();
    }

}