/* Display popup */
document.addEventListener("click", function (event) {
    const popupOverlay = document.querySelector('.popup-overlay');

    if (event.target === popupOverlay) {
        popupOverlay.style.display = "none";
    }
});

// Define variable "currentId" to assign value
let currentUserId;

const openPopupButtons = document.querySelectorAll('.open-popup-button');
const popupOverlay = document.querySelector('.popup-overlay');
openPopupButtons.forEach(function (button) {
    button.addEventListener('click', function () {
        const userId = this.getAttribute('data-id');
        const name = document.querySelector('.name[data-id="' + userId + '"]').textContent;
        const phone = document.querySelector('.phone[data-id="' + userId + '"]').textContent;
        const email = document.querySelector('.email[data-id="' + userId + '"]').textContent;


        const popupName = document.querySelector('input[name="name"]');
        const popupNewPassword = document.querySelector('input[name="new-password"]');
        const popupPhone = document.querySelector('input[name="phone"]');
        const popupEmail = document.querySelector('input[name="email"]');
        const popupAddress = document.querySelector('input[name="address"]');
        const popupUserId = document.querySelector('input[name="userid"]');


        currentUserId = userId; // Assign the value of userId to currentUserId

        popupUserId.value = currentUserId;
        popupName.value = name;
        popupNewPassword.value = '';
        popupAddress.value = '';
        popupPhone.value = phone;
        popupEmail.value = email;

        popupOverlay.style.display = "block";
    });
});
