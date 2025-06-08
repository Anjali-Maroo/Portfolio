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
      title: "Sent the message!",
      text: "Thanks for getting in touch",
      icon: "success",
      confirmButtonText: "OK"
    });

    this.reset(); // Optional: clear form after popup
  });
