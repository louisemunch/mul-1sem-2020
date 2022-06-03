let box = document.querySelector("#box");
let knap = document.querySelector("#knap");

knap.addEventListener("click", myFunction);

function myFunction() {
    if (knap.style.display == "flex" ){
        knap.style.display = "none";
        box.style.display = "flex";
    }
    else {
        knap.style.display = "flex";
        box.style.display = "none";
    }
}

box.addEventListener("click", myFunction);

function myFunction() {
    if (box.style.display == "flex" ){
        box.style.display = "none";
        knap.style.display = "flex";
    }
    else {
        box.style.display = "flex";
        knap.style.display = "none";
    }
}