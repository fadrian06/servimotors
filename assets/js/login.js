import { toast } from "../vendor/sweetalert2/index.js";

const form = document.getElementById("loginForm");

form.addEventListener("submit", async (event) => {
  event.preventDefault(); // Evita que el formulario se envíe de forma predeterminada

  // Validación del formulario
  if (form.checkValidity()) {
    try {
      // Ruta del archivo PHP
      const response = await fetch("CRUD/Usuarios/Login.php", {
        method: "post",
        body: new FormData(form),
      });

      if (!response.ok) {
        console.error(await response.text());
        return;
      }

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
