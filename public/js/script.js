var navbarActive = false;
document.addEventListener("DOMContentLoaded", function () {
    var hamburger = document.getElementsByClassName("burger")[0];
    var nav = document.getElementsByTagName("nav")[0];

    hamburger.addEventListener("click", function () {
        navbarActive = !navbarActive;

        if (navbarActive) {
            nav.classList.add("active");
        } else {
            nav.classList.remove("active");
        }
    });
});
