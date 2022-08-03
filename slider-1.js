// just querying the DOM...like a boss!
var links = document.querySelectorAll(".itemLinks");
// var links1 = document.querySelectorAll(".itemLinks1");

var wrapper5 = document.querySelector("#wrapper5");
var wrapper6 = document.querySelector("#wrapper6");
var wrapper7 = document.querySelector("#wrapper7");

// the activeLink provides a pointer to the currently displayed item
var activeLink = 0;

// setup the event listeners
for (var i = 0; i < links.length; i++) {
    var link = links[i];
    link.addEventListener('click', setClickedItem, false);

    // identify the item for the activeLink
    link.itemID = i;
}

// set first item as active
links[activeLink].classList.add("active");

function setClickedItem(e) {
    removeActiveLinks();

    var clickedLink = e.target;
    activeLink = clickedLink.itemID;

    changePosition(clickedLink);
}

function removeActiveLinks() {
    for (var i = 0; i < links.length; i++) {
        links[i].classList.remove("active");
    }
}

// Handle changing the slider position as well as ensure
// the correct link is highlighted as being active
function changePosition(link) {

    var position5 = link.getAttribute("data-pos5");
    var position6 = link.getAttribute("data-pos6");
    var position7 = link.getAttribute("data-pos7");


    var translateValue5 = "translate3d(" + position5 + ", 0px, 0)";
    var translateValue6 = "translate3d(" + position6 + ", 0px, 0)";
    var translateValue7 = "translate3d(" + position7 + ", 0px, 0)";


    wrapper5.style.transform = translateValue5;
    wrapper6.style.transform = translateValue6;
    wrapper7.style.transform = translateValue7;

    link.classList.add("active");
}