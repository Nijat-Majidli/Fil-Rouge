// Hamburger icon show-hide
var hamburgerIcon = document.getElementById("hamburger_icon");
var navbars= document.getElementById("navbars");
var pageBody = document.getElementById("pageBody");

hamburgerIcon.addEventListener("click", showHamburgerIcon);

function showHamburgerIcon(){
    
    if(navbars.style.display=="none") {
        navbars.style.display="block";
        pageBody.style.opacity=0.4;
    } else {
        navbars.style.display="none";
        pageBody.style.opacity=1;
    }
}

