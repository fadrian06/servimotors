import sweetalert2 from "./sweetalert2.esm.all.min.js";

/** @type {import('./sweetalert2.d.ts').Swal} */
const Swal = sweetalert2;

export const toast = Swal.mixin({
  showConfirmButton: false,
  toast: true,
  timer: 5000,
  timerProgressBar: true,
  position: 'top-end'
});

export default Swal;
