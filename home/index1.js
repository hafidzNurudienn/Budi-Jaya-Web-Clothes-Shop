const answers = document.querySelectorAll(".answer");
const questions = document.querySelectorAll(".question");

answers.forEach((answer) => (answer.style.display = "none"));

questions.forEach((question) => {
  question.addEventListener("click", (e) => {
    const answer = e.target.nextElementSibling;
    const arrow = question.querySelector("img");

    if (answer.style.display === "none") {
      arrow.style.transform = "rotate(180deg)";
      answer.style.display = "block";
      question.style.color = "crimson";
    } else if (answer.style.display === "block") {
      arrow.style.transform = "rotate(0)";
      answer.style.display = "none";
      question.style.color = "rgb(90, 90, 90)";
    }
  });
});
