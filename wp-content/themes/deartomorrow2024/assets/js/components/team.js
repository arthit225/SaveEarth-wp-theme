import Swiper from 'swiper';
import { Navigation } from 'swiper/modules';

function initializeTeam() {
  var swiper = new Swiper(".team-tab-panels__panel .swiper-container", {
    modules: [Navigation], // Load Navigation module
    slidesPerView: 1.5,
    centeredSlides: true,
    spaceBetween: 6,
    loop: true,
    navigation: {
      nextEl: ".swiper-next-button",
      prevEl: ".swiper-prev-button",
    },
    breakpoints: {
      576: {
        // width: 576,
        slidesPerView: 2.5,
      },
      768: {
        // width: 768,
        slidesPerView: 4,
        centeredSlides: false,
      },
    }
  });
  // Select all tab elements and panel elements
  const tabs = document.querySelectorAll(".team-tabs__tab");
  const panels = document.querySelectorAll(".team-tab-panels__panel");

  // Add click event listeners to each tab
  tabs.forEach((tab, index) => {
    tab.addEventListener("click", () => {
      // Remove the "active" class from all tabs and panels
      tabs.forEach(tab => tab.classList.remove("active"));
      panels.forEach(panel => panel.classList.remove("active"));

      // Add the "active" class to the clicked tab and corresponding panel
      tab.classList.add("active");
      panels[index].classList.add("active");
    });
  });

  // bio modal
  const modal_bio = document.querySelector(".modal-bio");
  const bio_buttons = document.querySelectorAll(".team-member-card__btn");
  const modal_bio_title = document.querySelector(".modal-bio__title");
  const modal_bio_position = document.querySelector(".modal-bio__position");
  const modal_bio_photo = document.querySelector(".modal-bio__photo source");
  const modal_bio_content = document.querySelector(".modal-bio__content");
  bio_buttons.forEach((button, index) => {
    button.addEventListener("click", () => {
      modal_bio_title.innerHTML = button.dataset.title;
      modal_bio_position.innerHTML = button.dataset.position;
      modal_bio_photo.srcset = button.dataset.photo;
      modal_bio_content.innerHTML = button.dataset.content;
      modal_bio.classList.add("active");
    });
  });

  const modal_close = document.querySelector(".modal-close");
  modal_close.addEventListener("click", () => {
    modal_bio.classList.remove("active");
  });
}

export default initializeTeam;
