import { Tooltip } from "bootstrap";

const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);

// Enable Bootstrap tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map((tooltipTriggerEl) => new Tooltip(tooltipTriggerEl));

$$(".search-input__active").forEach((btn) => {
  btn.addEventListener("click", () => {
    $(".search-input__dropdown-btn").innerText = btn.innerText;
    $(".search-input.is-show").classList.remove("is-show");
    const isSearchCar = btn.classList.contains("--car");

    if (isSearchCar) {
      $(".search-input[name='car']").classList.add("is-show");
    } else {
      $(".search-input[name='manufacturedYear']").classList.add("is-show");
    }
  });
});
