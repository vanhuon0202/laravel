//Add category popup
document.addEventListener('DOMContentLoaded', () => {
    // Lấy tham chiếu đến các phần tử
    const addCategoryBtn = document.getElementById('addCategoryBtn');
    const addCategoryPopup = document.getElementById('addCategoryPopup');
    const addCategoryForm = document.getElementById('addCategoryForm');

    // Xử lý sự kiện click để mở/đóng popup
    addCategoryBtn.addEventListener('click', () => {
        addCategoryPopup.style.display = 'block';
    });

    addCategoryPopup.addEventListener('click', (event) => {
        if (event.target === addCategoryPopup) {
            addCategoryPopup.style.display = 'none';
        }
    });
});




