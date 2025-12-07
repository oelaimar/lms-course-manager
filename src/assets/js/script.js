"use strict";
//gloabal varialbles
const modalTitle = document.getElementById('modal-title');
const courseForum = document.getElementById('courseForum');
const submitBtn = document.getElementById('submitBtn');
const courseTitle = document.getElementById('courseTitle');
const courseDescription = document.getElementById('courseDescription');
const coursLevel = document.getElementById('coursLevel');
const errorCourseTitle = document.getElementById('errorCourseTitle');
const errorCourseDescription = document.getElementById('errorCourseDescription');
const errorCoursLevel = document.getElementById('errorCoursLevel');
const deleteTilteModal = document.querySelector('#deleteModal .text-center');
const deleteForm = document.getElementById('deleteForm');
const sectionForum = document.getElementById('sectionForm');
//open modals for add and edit a course
function openModal(modalId, id) {
    const modal = document.getElementById(modalId);
    if (modal)
        modal.classList.add("active");
    courseForum.addEventListener('submit', validationCourseForum);
    if (id == 0) {
        modalTitle.textContent = "Add New Course";
        courseForum.action = "courses_create.php";
        submitBtn.textContent = "Create Course";
    }
    else {
        modalTitle.textContent = "Edit Course";
        courseForum.action = "courses_edit.php?id=" + id;
        submitBtn.textContent = "Edit Course";
        const titleToEdit = document.querySelector(`#course-card-${id} .course-title`);
        const descriptionToEdit = document.querySelector(`#course-card-${id} .course-description`);
        const LevelToEdit = document.querySelector(`#course-card-${id} .badge`);
        //filed the values
        courseTitle.value = titleToEdit.innerText;
        courseDescription.value = descriptionToEdit.innerText;
        coursLevel.value = LevelToEdit.innerText;
    }
}
//open modal for delete a course
function openDeleteModal(modalId, id) {
    const modal = document.getElementById(modalId);
    if (modal)
        modal.classList.add("active");
    const titleToDelet = document.querySelector(`#course-card-${id} .course-title`);
    deleteTilteModal.textContent = "Delete Course: " + titleToDelet.innerText;
    deleteForm.action = "courses_delete.php?id=" + id;
}
//validation after add or edit a course
function validationCourseForum(e) {
    e.preventDefault();
    let isValid = true;
    if (courseTitle.value.trim() == "") {
        errorCourseTitle.textContent = "the title must be valid";
        isValid = false;
    }
    if (courseDescription.value.trim() == "") {
        errorCourseDescription.textContent = "the description must be valid";
        isValid = false;
    }
    if (coursLevel.value.trim() == "") {
        errorCoursLevel.textContent = "the level must be valid";
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
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal)
        modal.classList.remove("active");
    if (modalId === 'courseModal') {
        errorCourseTitle.textContent = "";
        errorCourseDescription.textContent = "";
        errorCoursLevel.textContent = "";
    }
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
function openSectionModal(modalId, id) {
    const modal = document.getElementById(modalId);
    if (modal)
        modal.classList.add("active");
    let asdfadsf = id;
    sectionForum.addEventListener('submit', validationSectionForum);
}
function validationSectionForum(e) {
    e.preventDefault();
    let isValid = true;
    courseForum.submit();
}
