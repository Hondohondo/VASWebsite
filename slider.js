// just querying the DOM...like a boss!
var links = document.querySelectorAll(".itemLinks");
// var links1 = document.querySelectorAll(".itemLinks1");
var wrapper = document.querySelector("#wrapper");
var wrapper1 = document.querySelector("#wrapper1");
var wrapper2 = document.querySelector("#wrapper2");
var wrapper3 = document.querySelector("#wrapper3");

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
    var position = link.getAttribute("data-pos");
    var position1 = link.getAttribute("data-pos1");
    var position2 = link.getAttribute("data-pos2");
    var position3 = link.getAttribute("data-pos3");

    var translateValue = "translate3d(" + position + ", 0px, 0)";
    var translateValue1 = "translate3d(" + position1 + ", 0px, 0)";
    var translateValue2 = "translate3d(" + position2 + ", 0px, 0)";
    var translateValue3 = "translate3d(" + position3 + ", 0px, 0)";
    wrapper.style.transform = translateValue;
    // wrapper1.style.transform = translateValue1;
    wrapper2.style.transform = translateValue2;
    wrapper3.style.transform = translateValue3;

    link.classList.add("active");
}