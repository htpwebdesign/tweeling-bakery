const jobForm = document.querySelector("#job-form");
const applyNowBtns = document.querySelectorAll(".button-apply-bottom");

applyNowBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    jobForm.style.display = "block";
    jobForm.scrollIntoView({ behavior: "smooth" });
  });
});
