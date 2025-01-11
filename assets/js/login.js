const form = document.getElementById("loginForm");

form.addEventListener("submit", (event) => {
  event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

  // Validación del formulario
  if (form.checkValidity()) {
    fetch("CRUD/Usuarios/Login.php", {
      // Ruta del archivo PHP
      method: "POST",
      body: new FormData(form),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          Swal.fire({
            icon: "success",
            title: "¡Bienvenido!",
            text: data.message,
            showConfirmButton: false,
            timer: 1500,
          }).then(() => {
            location.href = "views/dashboard/dashboard.php"; // Redirección en caso de éxito
          });
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: data.message,
          });
        }
      })
      .catch((error) => {
        console.error("Error:", error);

        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Hubo un problema al procesar tu solicitud.",
        });
      });
  }
});
