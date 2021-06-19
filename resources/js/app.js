require('./bootstrap');
require('./contact');
require('./navigation');
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

window.makeSortable = function (table) {
  let tableHeadElements = table.getElementsByTagName('thead')[0]?.getElementsByTagName('tr')[0];
  tableHeadElements =
    tableHeadElements?.getElementsByTagName('td').length > 0
      ? tableHeadElements?.getElementsByTagName('td')
      : tableHeadElements?.getElementsByTagName('th');

  let tableData = {
    language: {
      lengthMenu: 'Laat _MENU_ velden per pagina zien',
      zeroRecords: 'Er is niks gevonden.',
      info: 'Pagina _PAGE_ van _PAGES_',
      infoEmpty: 'Er is geen data beschikbaar',
      infoFiltered: '(gefilterd uit _MAX_ velden)',
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
  if (
    tableHeadElements &&
    tableHeadElements.length > 0 &&
    tableHeadElements[tableHeadElements.length - 1].innerText.toLowerCase() === 'acties'
  ) {
    tableData.columnDefs = [{ orderable: false, targets: tableHeadElements.length - 1 }];
  }
  $(table).DataTable(tableData);
};

window.makeAllSortable = function (parent) {
  parent = parent || document.body;
  let t = parent.getElementsByTagName('table'),
    i = t.length;
  while (--i >= 0) makeSortable(t[i]);
};

window.addEventListener('load', event => {
  makeAllSortable(document.getElementsByTagName('main')[0]);
});
