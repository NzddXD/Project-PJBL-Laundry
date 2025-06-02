document.addEventListener("DOMContentLoaded", function() {
    gsap.from(".item", {
        opacity: 0,
        stagger: .05,
        width: 50 + "%",
        duration: 1,
        ease: "expo.out"
    })

    gsap.from(".item-name", {
        opacity: 0,
        y: -200,
        stagger: .05,
        ease: "expo.out",
        duration: 0.5
    })
})