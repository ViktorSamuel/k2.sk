var openMenu = document.querySelector(".openMenu");
var crossMenu = document.querySelector(".crossMenu");
var mobileNav = document.querySelector(".mobileNav");
var mobileMenuOptions = document.querySelectorAll(".mobileMenuOptions");

openMenu.addEventListener("click", function(event) {
  mobileNav.style.visibility = "visible";
});

crossMenu.addEventListener("click", function(event) {
  mobileNav.style.visibility = "hidden";
});

mobileMenuOptions.forEach(function(element) {
  element.addEventListener("click", function(event) {
    mobileNav.style.visibility = "hidden";
  });
});

var usButton = document.querySelector(".moblieAboutButton");

if (usButton) {
  var usIcon = document.querySelector(".mobileAboutIcon");
  var activeIcon = "m";
  var usMenu = document.querySelector(".moblieAboutOptions");
  var radius = usIcon.style.borderTopLeftRadius;

  usButton.addEventListener("click", function() {
    if (activeIcon == "m") {
      usIcon.src = "img/crossMenu.png";
      activeIcon = "c";
      usMenu.style.display = "block";
      usMenu.style.borderTopLeftRadius = "0";
      usMenu.style.borderTopRightRadius = "0";
      usButton.style.borderBottomLeftRadius = "0";
      usButton.style.borderBottomRightRadius = "0";
    } else {
      usIcon.src = "img/menuIcon.png";
      activeIcon = "m";
      usMenu.style.display = "none";
      usMenu.style.borderTopLeftRadius = radius;
      usMenu.style.borderTopRightRadius = radius;
      usButton.style.borderBottomLeftRadius = radius;
      usButton.style.borderBottomRightRadius = radius;
    }
  });
}
