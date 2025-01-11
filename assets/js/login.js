import { toast } from "../vendor/sweetalert2/index.js";

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
          location.href = "views/dashboard/dashboard.php"; // Redirección en caso de éxito
        } else {
          toast.fire({
            icon: "error",
            text: data.message,
          });
        }
      })
      .catch((error) => {
        console.error("Error:", error);

        toast.fire({
          icon: "error",
          text: "Hubo un problema al procesar tu solicitud.",
        });
      });
  }
});
