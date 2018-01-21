
function Init() {
    
    var hiddenRating=document.getElementById("rating");
    if (hiddenRating) {
        ratingValue=hiddenRating.value;
        var star=document.getElementById(ratingValue+"star");
        if (star) star.click();
    }
    
}
/*
$( function() {
    $( "#datepicker" ).datepicker();
  } );
*/

function clearForm(oForm) {
    var frm_elements = oForm.elements;
    for(i=0; i<frm_elements.length; i++) {
        field_type = frm_elements[i].type.toLowerCase();
        switch (field_type)
        {
        case "text":
        case "password":
        case "textarea":
        case "hidden":
            frm_elements[i].value = "";
            break;
        case "radio":
        case "checkbox":
            if (frm_elements[i].checked)
            {
                frm_elements[i].checked = false;
            }
            break;
        case "select-one":
        case "select-multi":
            frm_elements[i].selectedIndex = -1;
            break;
        default:
            break;
        }

    }

}

function rateSake(rating) {
    var hiddenRating=document.getElementById("rating");
    console.log("Rating: "+rating);
    if (hiddenRating) {
        hiddenRating.value=rating;
    }
}

function submitForm() {
    //
}

function populateRegion() {
    alert("populating region!");
    var region=document.getElementById("region");
    if (region) {
        region.value="JAK";
    }
}

var nav = document.getElementById("header");
var menu = document.getElementsByClassName("menuitems");
var menuButton = document.getElementById("menu");

function navToggle(x) { // x is the element "menu"
    var i;
    var numMenuItems=menu.length;
    if (x.classList.contains('expanded')) {
        // close:
        nav.style.height="40px";
        for (i = 0; i < numMenuItems; i++){
            menu[i].style.opacity="0.0";
            menu[i].style.visibility = "hidden";
        }
    } else {
        // open:
        nav.style.height=((34*numMenuItems)+20)+"px";
        for (i = 0; i < numMenuItems; i++){
            menu[i].style.opacity="1.0";
            menu[i].style.marginTop="0px";
            menu[i].style.visibility = "visible";
        }
    }
    x.classList.toggle('expanded');
    
}

menuButton.addEventListener("click", function(){
  var menuIcon = menuButton.children;
  for (i = 0; i < menuIcon.length; i++){
    menuIcon[i].classList.toggle("active");
  }   
});

window.onload=Init;

