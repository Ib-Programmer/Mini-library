let menuitems = document.querySelector(".menu_items");
function clicking_menu() {
    if(menuitems.style.display == "none"){
        menuitems.style.display = "block";
    }
    else{
        menuitems.style.display = "none"; 
    }
}