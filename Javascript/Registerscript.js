let adminform = document.querySelector("#adminregister");
let adminsign = document.querySelector("#btnadminreg");
let schoolform = document.querySelector("#schoolregister");
let schoolsign = document.querySelector("#btnschoolreg");
adminsign.addEventListener("click",function filling_firstForm(e){
    e.preventDefault();
    if(adminform.style.display == "block"){
        adminform.style.display = "none";
    }
    else{
        schoolform.style.display = "block"; 
    }
});