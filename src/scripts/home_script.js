let imageIndex = 0;
let textIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("slides");
  let reviewSlides = document.getElementsByClassName("review-slide");

  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none"; //to make sure only the current slide to display
  }

  for (i = 0; i < reviewSlides.length; i++) {
    reviewSlides[i].style.display = "none";
  }

  imageIndex++;
  if (imageIndex > slides.length) {
    imageIndex = 1;
  }

  textIndex++;
  if (textIndex > reviewSlides.length) {
    textIndex = 1;
  }

  slides[imageIndex - 1].style.display = "block";
  reviewSlides[textIndex - 1].style.display = "block";

  setTimeout(showSlides, 3500); // Change image and text every 2 seconds
}