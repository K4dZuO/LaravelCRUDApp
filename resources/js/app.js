import "bootstrap";
import "../scss/app.scss";

document.addEventListener("DOMContentLoaded", function () {
    // Обработчик открытия модального окна
    const moreInfoButtons = document.querySelectorAll(".more-info");

    moreInfoButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const title = this.getAttribute("data-title");
            const body = this.getAttribute("data-body");

            const modalTitle = document.getElementById("modalTitle");
            const modalBody = document.getElementById("modalBody");

            // Обновляем информацию в модальном окне
            modalTitle.textContent = title;
            modalBody.textContent = body;
        });
    });

    // Toast
    const uploadButton = document.getElementById("uploadButton");
    const toastMessage = new bootstrap.Toast(
        document.getElementById("toastMessage")
    );

    uploadButton.addEventListener("click", () => {
        // Показать Toast
        toastMessage.show();
    });
});



// Обработка перемещений по модальным окнам
document.addEventListener('keydown', function (event) {
    const modals = ['1', '2', '3', '4', '5', '6', '7', '#LandTurtleModal', '#TwoClawedModal', '#AmericaTurtle'];
    let currentModalIndex = modals.findIndex(modal => document.querySelector(modal).classList.contains('show'));

    // Левая стрелка - назад
    if (event.key === 'ArrowLeft') {
        if (currentModalIndex > 0) {
            bootstrap.Modal.getInstance(document.querySelector(modals[currentModalIndex])).hide();
            const previousModal = new bootstrap.Modal(document.querySelector(modals[currentModalIndex - 1]));
            previousModal.show();
        }
    }

    // Правая стрелка - вперед
    if (event.key === 'ArrowRight') {
        if (currentModalIndex < modals.length - 1) {
            bootstrap.Modal.getInstance(document.querySelector(modals[currentModalIndex])).hide();
            const nextModal = new bootstrap.Modal(document.querySelector(modals[currentModalIndex + 1]));
            nextModal.show();
        }
    }
});

// Убираем фон
document.querySelectorAll('.modal').forEach(function(modalElement) {
    modalElement.addEventListener('hidden.bs.modal', function () {
        if (!document.querySelector('.modal.show')) {
            // Удаление затемняющего фона
            document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
                backdrop.remove();
            });
            document.body.classList.remove('modal-open'); // Убираем класс, блокирующий прокрутку страницы
        }
    });
});
