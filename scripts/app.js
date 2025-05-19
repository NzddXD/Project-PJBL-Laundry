document.addEventListener("DOMContentLoaded", function () {
  const loginField = document.getElementById("login-form");
  const title = document.querySelector(".title");

  const error = document.querySelector(".error");
  const info = document.querySelector(".status");

  if (!loginField) {
    console.error("Login field not found");
    return;
  }

  gsap.from(loginField, {
    width: 250,
    opacity: 0,
    ease: "expo.out",
    duration: 0.6,
  });
  gsap.from(title, {
    opacity: 0,
    ease: "linear.inOut",
    duration: 0.3,
  });
  gsap.from(error, {
    y: 50,
    opacity: 0,
    ease: "expo.out",
    duration: 0.6,
  });
  gsap.from(info, {
    y: 50,
    opacity: 0,
    ease: "expo.out",
    duration: 0.3,
  });
});
function hideInfo(e) {
    e.classList.remove("visible");
}

function vanish(element) {
  gsap.to(element, {
    opacity: 0,
    y: -50,
    duration: 0.3,
    ease: "expo.in",
  });
  setTimeout(() => {
    hideInfo(element);
  }, 100);
}
