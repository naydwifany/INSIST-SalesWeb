// Navbar Menu
const btnHamburger = document.querySelector(".hamburger");
const menu = document.querySelector(".menu");

btnHamburger?.addEventListener("click", () => {
  btnHamburger.classList.toggle("is-active");
  menu.classList.toggle("menu-active");
});

// function hello(){
//   btnHamburger.classList.toggle("is-active");
//   menu.classList.toggle("menu-active");
//   }


// Our Agent 
const loadMore = document.querySelector(".load-more-btn");
let jumlahItem = 3;

loadMore.addEventListener("click", () => {
  // console.log("testing");
  let boxes = [...document.querySelectorAll(".ouragent-box .box")];
  for (let i = jumlahItem; i < jumlahItem + 3; i++) {
    boxes[i].style.display = "inline-block";
  }

  jumlahItem += 3;

  if (jumlahItem >= boxes.length) {
    loadMore.style.display = "none";
  }
});

// function hello(){
//   btnHamburger.classList.toggle("is-active");
//   menu.classList.toggle("menu-active");
//   }

/*format email and confirm password
document.getElementById("confirm-password").addEventListener("input", function() {
  var passwordInput = document.getElementById("password");
  var confirmPasswordInput = document.getElementById("confirm-password");
  var password = passwordInput.value;
  var confirmPassword = confirmPasswordInput.value;

  var emailInput = document.querySelector('input[type="email"]');
  var email = emailInput.value;

  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  var isEmailValid = emailRegex.test(email);

  if (!isEmailValid) {
      emailInput.setCustomValidity("Please enter a valid email address");
  } else {
      emailInput.setCustomValidity("");
  }

  if (password !== confirmPassword) {
      confirmPasswordInput.setCustomValidity("Passwords do not match");
  } else {
      confirmPasswordInput.setCustomValidity("");
  }
});


//have/have'nt an account
function register() {
  // Implementasi logika pendaftaran di sini
  alert("Redirect to Sign Up page...");
  // Contoh: Mengarahkan pengguna ke halaman pendaftaran
  window.location.href = "signup.html"; // Ganti "signup.html" dengan URL halaman pendaftaran yang sesuai
} */