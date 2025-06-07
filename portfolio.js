function myFunction(x) {
  x.classList.toggle("change");
}
document.querySelector("form").addEventListener("submit", function (e) {
    // Optional: delay form reset for 1 second to allow submission
    setTimeout(() => {
      this.reset();  // Clears all inputs
  }, 1000);
});
form.addEventListener("submit", function (e) {
  e.preventDefault(); // Stop normal behavior
  fetch(this.action, {
    method: this.method,
    body: new FormData(this),
    headers: {
      'Accept': 'application/json'
    }
  }).then(response => {
    if (response.ok) {
      form.reset(); // Clear the form if successful
    }
  });
});
document.querySelector("form").addEventListener("submit", function (e) {
    e.preventDefault(); // Stop real form submission (for testing or third-party handling)

    Swal.fire({
      title: "Form Submitted!",
      text: "Thanks for getting in touch 😊",
      icon: "success",
      confirmButtonText: "OK"
    });

    this.reset(); // Optional: clear form after popup
  });
