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

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});

window.makeSortable = function (table) {
  const tdElements = table.getElementsByTagName('thead')[0]?.getElementsByTagName('tr')[0]?.getElementsByTagName('td');
  let tableData = {
    language: {
      lengthMenu: 'Laat _MENU_ velden per pagina zien',
      zeroRecords: 'Er is niks gevonden.',
      info: 'Pagina _PAGE_ van _PAGES_',
      infoEmpty: 'Er is geen data beschikbaar',
      infoFiltered: '(gefiltert van _MAX_ totale velden)',
      search: 'Zoeken',
      sLoadingRecords: 'Laden..',
      sProcessing: 'Even geduld aub..',
      oPaginate: {
        sFirst: 'Eerste',
        sPrevious: 'Terug',
        sNext: 'Volgende',
        sLast: 'Laatste',
      },
    },
  };
  if (tdElements && tdElements[tdElements.length - 1].innerText.toLowerCase() === 'acties') {
    tableData.columnDefs = [{ orderable: false, targets: tdElements.length - 1 }];
  }
  $(table).DataTable(tableData);
};

window.makeAllSortable = function (parent) {
  parent = parent || document.body;
  let t = parent.getElementsByTagName('table'),
    i = t.length;
  while (--i >= 0) makeSortable(t[i]);
};

window.onload = function () {
  makeAllSortable(document.rootElement);
};
