
function Init() {
    
    //JAK - is this necessary?
    var hiddenRating=document.getElementById("rating");
    if (hiddenRating) {
        ratingValue=hiddenRating.value;
        var star=document.getElementById(ratingValue+"star");
        if (star) star.click();
    }
    
}


function populateRegion(prefectureName) {
    var region = document.getElementById("region");
    if (!region) {
        return;
    }
    if (prefectureName == "") {
        region.value = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                region.value = this.responseText;
            }
        };
        xmlhttp.open("GET","getregion.php?q="+prefectureName,true);
        xmlhttp.send();
    }

}

$( function() {
    $( "#datepicker" ).datepicker();
  } );


function toggleAccordion(x) {
    x.classList.toggle("open");

    /* Toggle between hiding and showing the active panel */
    var panel = x.nextElementSibling;
    if (panel.style.height){
      panel.style.height = null;
    } else {
      panel.style.height = panel.scrollHeight + "px";
    } 
}

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

var nav = document.getElementById("header");
var menu = document.getElementsByClassName("menuitems");
var menuButton = document.getElementById("menu");

function navToggle(x) { // x is the element "menu"
    x.classList.toggle("expanded");
    var numMenuItems=menu.length;
    /* Toggle between hiding and showing the menulist */
    var menulist = document.getElementById("menulist");
    if (menulist.style.height){
      menulist.style.height=null
    } else {
        menulist.style.height = ((34*numMenuItems)+20)+"px";
    }
    
}

window.onload=Init;

