addItem = document.querySelector("#add");
closeBtn = document.querySelector(".closeBtn");
add = document.querySelector(".popupForm");


inputs = document.querySelectorAll(".input");

inputs.forEach(element => {
    
        console.log("xxx");
});

addItem.addEventListener("click", function() {
    add.classList.remove("invisible")
});

closeBtn.addEventListener("click", function() {
    console.log("adasd");
    add.classList.add("invisible")
});
