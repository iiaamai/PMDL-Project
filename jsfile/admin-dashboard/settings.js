import { securitySettingsInit } from "./settings/security.js";
const sideBarButtons = document.querySelectorAll(".side-bar-item");
sideBarButtons.forEach((item) => {
  item.addEventListener("click", () => {
    sideBarButtons.forEach((btn) => {
      btn.classList.remove("side-bar-item-active");
    });
    item.classList.add("side-bar-item-active");
    document.querySelectorAll(".content-active").forEach((content) => {
      if (!content.classList.contains("content-hide")) {
        content.classList.add("content-hide");
      }
    });
    const itemIdSidebar = item.dataset.itemId;
    const content = document.getElementById(`${itemIdSidebar}`);
    content.classList.remove("content-hide");
  });
});

securitySettingsInit();
