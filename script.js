document.addEventListener("DOMContentLoaded", () => {
  const menuToggle = document.querySelector(".menu-toggle");
  const mobileMenu = document.querySelector(".mobile-menu");

  if (menuToggle) {
    // Открытие и закрытие меню по клику на кнопку
    menuToggle.addEventListener("click", (event) => {
      event.stopPropagation();  // Остановка всплытия события
      mobileMenu.classList.toggle("open");
      menuToggle.classList.toggle("active");
    });

    // Закрытие меню при клике вне его области
    document.addEventListener("click", (event) => {
      if (!mobileMenu.contains(event.target) && !menuToggle.contains(event.target)) {
        mobileMenu.classList.remove("open");
        menuToggle.classList.remove("active");
      }
    });
  } else {
    console.error("Элемент с классом .menu-toggle не найден");
  }
});


/Контактная форма/  

const contactForm = document.getElementById('contactForm');
if (contactForm) {
  contactForm.addEventListener('submit', function() {
    document.getElementById('successMessage').style.display = 'block';
  });
}


// const icon = document.querySelector(".loading i");
// const closeBtn = document.querySelector(".close-btn");
// const container = document.querySelector(".container");

// icon.addEventListener("click", () => {
//   container.classList.add("change");
// });

// closeBtn.addEventListener("click", () => {
//   container.classList.remove("change");
// });