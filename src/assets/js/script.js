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
const modalSectiontitle = document.getElementById('modal-title-section');
const sectionForum = document.getElementById('sectionForm');
const submitBtnSection = document.getElementById('submitBtnSection');
const errorSectionTitle = document.getElementById('errorSectionTitle');
const errorSectionDescription = document.getElementById('errorSectionDescription');
const errorSectionPosition = document.getElementById('errorSectionPosition');
const sectionTitle = document.getElementById('sectionTitle');
const sectionDescription = document.getElementById('sectionDescription');
const sectionPosition = document.getElementById('sectionPosition');
const deleteTilteSectionModal = document.querySelector('#deleteSectionModal .text-center');
const deleteSectionForm = document.getElementById('deleteSectionForm');
const modalTitleLogin = document.getElementById('modalTitleLogin');
const loginBtn = document.getElementById('loginBtn');
const signupBtn = document.getElementById('signupBtn');
//open modals for add and edit a course and login singup modal
function openModal(modalId, id) {
    const modal = document.getElementById(modalId);
    if (modal)
        modal.classList.add("active");
    if (modalId === 'loginModal')
        return;
    courseForum.addEventListener('submit', validationCourseForum);
    if (id == 0) {
        modalTitle.textContent = "Add New Course";
        courseForum.action = "./courses/courses_create.php";
        submitBtn.textContent = "Create Course";
    }
    else {
        modalTitle.textContent = "Edit Course";
        courseForum.action = "./courses/courses_edit.php?id=" + id;
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
    if (modalId === "deleteModal") {
        const titleToDelet = document.querySelector(`#course-card-${id} .course-title`);
        deleteTilteModal.textContent = "Delete Course: " + titleToDelet.innerText;
        deleteForm.action = "./courses/courses_delete.php?id=" + id;
    }
    if (modalId === "deleteSectionModal") {
        const titleToDelet = document.querySelector(`#Section-card-${id} .section-title`);
        deleteTilteSectionModal.textContent = "Delete Section: " + titleToDelet.innerText;
        deleteSectionForm.action = "./sections/sections_delete.php?id=" + id;
    }
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
        courseTitle.value = "";
        courseDescription.value = "";
        coursLevel.value = "";
    }
    if (modalId === 'sectionModal') {
        errorSectionTitle.textContent = "";
        errorSectionDescription.textContent = "";
        errorSectionPosition.textContent = "";
        sectionTitle.value = "";
        sectionDescription.value = "";
        sectionPosition.value = "";
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
    sectionForum.addEventListener('submit', validationSectionForum);
    if (id == 0) {
        modalSectiontitle.textContent = "Add New Section";
        sectionForum.action = "./sections_create.php";
        submitBtnSection.textContent = "Create Section";
    }
    else {
        modalSectiontitle.textContent = "Edit Section";
        sectionForum.action = "./sections_edit.php?id=" + id;
        submitBtnSection.textContent = "Edit Section";
        const titleToEdit = document.querySelector(`#Section-card-${id} .section-title`);
        const textToEdit = document.querySelector(`#Section-card-${id} .section-text`);
        const positionToEdit = document.querySelector(`#Section-card-${id} .position`);
        //filed the values
        sectionTitle.value = titleToEdit.innerText;
        sectionDescription.value = textToEdit.innerText;
        sectionPosition.value = positionToEdit.innerText;
    }
}
function validationSectionForum(e) {
    e.preventDefault();
    let isValid = true;
    if (sectionTitle.value.trim() == "") {
        errorSectionTitle.textContent = "the title must be valid";
        isValid = false;
    }
    if (sectionDescription.value.trim() == "") {
        errorSectionDescription.textContent = "the Content must be valid";
        isValid = false;
    }
    if (sectionPosition.value.trim() == "") {
        errorSectionPosition.textContent = "the Position must be valid";
        isValid = false;
    }
    if (isValid) {
        errorSectionTitle.textContent = "";
        errorSectionDescription.textContent = "";
        errorSectionPosition.textContent = "";
        sectionForum.submit();
    }
}
//switch sing in and login
function switchTab(tab) {
    const theTab = document.getElementById(tab);
    const allTabs = document.querySelectorAll('.tab-content');
    allTabs.forEach(eachTab => {
        eachTab.classList.remove('active');
    });
    loginBtn.classList.remove('active');
    signupBtn.classList.remove('active');
    if (tab === 'signupTab') {
        modalTitleLogin.innerHTML = 'Create Account';
        theTab.classList.add('active');
        signupBtn.classList.add('active');
    }
    if (tab === 'loginTab') {
        modalTitleLogin.innerHTML = 'Welcome Back';
        theTab.classList.add('active');
        loginBtn.classList.add('active');
    }
}
