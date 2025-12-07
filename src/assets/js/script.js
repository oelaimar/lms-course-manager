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
function openModal(modalId, id) {
    const modal = document.getElementById(modalId);
    if (modal)
        modal.classList.add("active");
    courseForum.addEventListener('submit', validationForum);
    //here i will add if add new course or if edit existion course
    if (id == 0) {
        modalTitle.textContent = "Add New Course";
        courseForum.action = "courses_create.php";
        submitBtn.textContent = "Create Course";
    }
    else {
        modalTitle.textContent = "Edit Course";
        courseForum.action = "courses_create.php?id=" + id;
        submitBtn.textContent = "Edit Course";
    }
}
function validationForum(e) {
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
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal)
        modal.classList.remove("active");
    errorCourseTitle.textContent = "";
    errorCourseDescription.textContent = "";
    errorCoursLevel.textContent = "";
}
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
