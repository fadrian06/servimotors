import { toast } from "../vendor/sweetalert2/index.js";

const $loginForm = document.querySelector("#loginForm");

$loginForm.addEventListener("submit", async (event) => {
  event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

  // Validación del formulario
  if ($loginForm.checkValidity()) {
    try {
      // Ruta del archivo PHP
      const response = await fetch("api/ingresar/", {
        method: "post",
        body: new FormData($loginForm),
      });

      const data = await response.json();

      if (data.success) {
        location.href = "views/dashboard/dashboard.php"; // Redirección en caso de éxito
      } else {
        toast.fire({
          icon: "error",
          text: data.message,
        });

        data.debug && console.error(data.debug);
      }
    } catch (error) {
      console.error({ error });

      toast.fire({
        icon: "error",
        text: "Hubo un problema al procesar tu solicitud.",
      });
    }
  }
});
