const facebook_button = document.getElementById('facebook');
const google_button = document.getElementById('google');

facebook_button.addEventListener('click', facebook_func);
google_button.addEventListener('click', google_func);

function facebook_func() {
    location.href = "http://www.facebook.com";
}

function google_func() {
    location.href = "http://www.google.com";
}