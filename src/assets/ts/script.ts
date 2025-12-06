function openModal(modalId: string, id: number): void {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.add("active");

    //here i will add if add new course or if edit existion course
    if (id == 0) {
        console.log('here will be add new course');
    } else {
        console.log('here will be the course edit', id);
    }
}

function closeModal(modalId: string): void {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.remove("active");
}
