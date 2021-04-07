require('./bootstrap');

require('alpinejs');

import Swal from 'sweetalert2';

window.deleteConfirm = function(formId)
{
  Swal.fire({
    icon: 'warning',
    text: 'Weet u zeker dat u dit wilt verwijderen?',
    showCancelButton: true,
    confirmButtonText: 'Verwijder',
    confirmButtonColor: '#e3342f',
  }).then((result) => {
    if (result.isConfirmed) {
      document.getElementById(formId).submit();
    }
  });
}
