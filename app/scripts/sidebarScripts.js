function moveSidebar() {
  const sidebar = document.querySelector(".navbar");
  const mainContent = document.querySelector(".content");
  const dashboard = document.querySelector(".dashboard");
  const bottomPanel = document.querySelector(".history");

  gsap.from(sidebar, {
    duration: 0.4,
    opacity: 0,
    x: -50,
    opacity: 0,
    ease: "expo.out",
    // onComplete: function() {
    //     sidebar.style.display = 'block';
    // }
  });
  gsap.from(dashboard, {
    duration: 0.4,
    height: 50 + "px",
    ease: "expo.out",
  });
}

document.addEventListener("DOMContentLoaded", function () {
  moveSidebar();
});
