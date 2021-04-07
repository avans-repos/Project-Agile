require('./bootstrap');
require('./contact');
require('alpinejs');

import Swal from 'sweetalert2';

window.deleteConfirm = function(formId)
{
  Swal.fire({
    icon: 'warning',
    title: 'Weet u zeker dat u dit wilt verwijderen?',
    showCancelButton: true,
    cancelButtonText: 'Annuleren',
    confirmButtonText: 'Verwijder',
    confirmButtonColor: '#e3342f',
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById(formId).submit();
    }
  });
}
