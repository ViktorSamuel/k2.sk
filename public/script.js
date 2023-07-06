// Selecting elements
var openMenu = document.querySelector(".openMenu");
var crossMenu = document.querySelector(".crossMenu");
var mobileNav = document.querySelector(".mobileNav");
var mobileMenuOptions = document.querySelectorAll(".mobileMenuOptions");

// Event listener for opening the mobile navigation menu
openMenu.addEventListener("click", function(event) {
  mobileNav.style.visibility = "visible";
});

// Event listener for closing the mobile navigation menu
crossMenu.addEventListener("click", function(event) {
  mobileNav.style.visibility = "hidden";
});

// Event listeners for each mobile menu option to close the menu when clicked
mobileMenuOptions.forEach(function(element) {
  element.addEventListener("click", function(event) {
    mobileNav.style.visibility = "hidden";
  });
});

// Checking if the 'usButton' exists on the page
var usButton = document.querySelector(".moblieAboutButton");

if (usButton) {
  // Selecting additional elements related to the 'usButton'
  var usIcon = document.querySelector(".mobileAboutIcon");
  var activeIcon = "m";
  var usMenu = document.querySelector(".moblieAboutOptions");
  var radius = usIcon.style.borderTopLeftRadius;

  // Event listener for toggling the 'usMenu' and changing the 'usIcon' based on its state
  usButton.addEventListener("click", function() {
    if (activeIcon == "m") {
      // Changing to the close menu icon and modifying styles
      usIcon.src = "img/crossMenu.png";
      activeIcon = "c";
      usMenu.style.display = "block";
      usMenu.style.borderTopLeftRadius = "0";
      usMenu.style.borderTopRightRadius = "0";
      usButton.style.borderBottomLeftRadius = "0";
      usButton.style.borderBottomRightRadius = "0";
    } else {
      // Changing back to the menu icon and restoring styles
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
