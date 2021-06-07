require('./bootstrap');
require('./contact');
require('alpinejs');
import Swal from 'sweetalert2';

window.deleteConfirm = function (formId, removeText = '') {
  Swal.fire({
    title: 'Weet u zeker dat u dit wilt verwijderen?',
    html: `${removeText}`,
    icon: 'warning',
    showCancelButton: true,
    cancelButtonText: 'Annuleren',
    confirmButtonText: 'Verwijder',
    confirmButtonColor: '#e3342f',
  }).then(result => {
    if (result.isConfirmed) {
      document.getElementById(formId).submit();
    }
  });
};

window.sendEmailConfirm = function (formId, emailRecipients) {
  Swal.fire({
    title: 'Weet je zeker dat je de e-mail(s) wilt versturen?',
    html: `De e-mail zal worden verstuurd naar: ${emailRecipients}`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Versturen',
    cancelButtonText: 'Annuleren',
    reverseButtons: true,
  }).then(result => {
    if (result.isConfirmed) {
      document.getElementById(formId).submit();
      Swal.fire('Verzonden!', 'De e-mail is verzonden naar de contacten.', 'success');
    }
  });
};

let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});
