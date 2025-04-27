const trigger1 = document.getElementById("container");
const trigger2 = document.getElementById("noti_icon");
trigger2.addEventListener("click", (event) => {
	trigger1.classList.add("clicked");
	trigger1.style.display = "block";
	trigger1.classList.toggle("active");
});


// const trigger1 = document.getElementById("container");
// const trigger2 = document.getElementById("noti_icon");

// trigger2.addEventListener("click", () => {
// 	trigger1.classList.add("clicked");
//     trigger1.classList.add("active");
// });