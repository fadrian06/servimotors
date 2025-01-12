import { toast } from "../vendor/sweetalert2/index.js";

const form = document.getElementById("userForm");
const passwordField = form.password;
const confirmPasswordField = form.confirmPassword;
const cedulaField = form.cedula;

// Expresión regular para validar cédula
const cedulaRegex = /^[V|E]-\d{5,8}$/;

// Función para validar que las contraseñas coincidan
function validatePasswords() {
  if (passwordField.value !== confirmPasswordField.value) {
    confirmPasswordField.setCustomValidity("Las contraseñas no coinciden");
    confirmPasswordField.classList.add("is-invalid");
    return false;
  }
  confirmPasswordField.setCustomValidity("");
  confirmPasswordField.classList.remove("is-invalid");
  return true;
}

// Validación de cada campo con el evento "input"
for (const field of form.querySelectorAll("input, select")) {
  field.addEventListener("input", () => {
    field.setCustomValidity("");
    if (!field.checkValidity()) {
      field.classList.add("is-invalid");
    } else {
      field.classList.remove("is-invalid");
    }

    // Validar el campo de cédula
    if (field === cedulaField) {
      if (!cedulaRegex.test(cedulaField.value)) {
        cedulaField.setCustomValidity(
          "Por favor ingrese una cédula válida (V-12345678 o E-12345678).",
        );

        cedulaField.classList.add("is-invalid");
      } else {
        cedulaField.setCustomValidity("");
        cedulaField.classList.remove("is-invalid");
      }
    }
  });
}

// Validar contraseñas cuando cambien
passwordField.addEventListener("input", validatePasswords);
confirmPasswordField.addEventListener("input", validatePasswords);

// Validación al enviar el formulario
form.addEventListener("submit", async (e) => {
  e.preventDefault();

  // Validar coincidencia de contraseñas
  if (!validatePasswords()) {
    toast.fire({
      icon: "error",
      title: "Error",
      text: "Las contraseñas no coinciden.",
    });
    return;
  }

  // Validar cédula antes de enviar el formulario
  if (!cedulaRegex.test(cedulaField.value)) {
    cedulaField.setCustomValidity(
      "Por favor ingrese una cédula válida (V-12345678 o E-12345678).",
    );

    cedulaField.classList.add("is-invalid");
    toast.fire({
      icon: "error",
      title: "Error",
      text: "Por favor ingrese una cédula válida siguiendo la estructura: (V-12345678 o E-12345678).",
    });
    return;
  }

  // Validar el formulario completo
  if (!form.checkValidity()) {
    toast.fire({
      icon: "error",
      title: "Formulario incompleto",
      text: "Por favor complete correctamente todos los campos.",
    });
    return;
  }

  // Procesamiento del registro con fetch
  try {
    // Mostrar indicador de carga
    toast.fire({
      title: "Procesando",
      text: "Por favor espere...",
      allowOutsideClick: false,
      didOpen() {
        Swal.showLoading();
      },
    });

    const response = await fetch("../../CRUD/Usuarios/RegistroUsuario.php", {
      method: "POST",
      body: new FormData(form),
    });

    const result = await response.json();

    if (result.success) {
      toast
        .fire({
          icon: "success",
          title: "Usuario registrado",
          text: "El usuario ha sido registrado exitosamente.",
        })
        .then(form.reset);
    } else {
      toast.fire({
        icon: "error",
        title: "Error",
        text:
          result.mensaje ||
          (Array.isArray(result.errores)
            ? result.errores.join("\n")
            : "Error al registrar usuario"),
      });
    }
  } catch (error) {
    toast.fire({
      icon: "error",
      title: "Error",
      text: "Ocurrió un error al procesar la solicitud",
    });
  }
});
