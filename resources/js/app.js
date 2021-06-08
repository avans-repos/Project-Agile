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

window.sortTable = function (table, col, reverse) {
  let tb = table.tBodies[0], // use `<tbody>` to ignore `<thead>` and `<tfoot>` rows
    tr = Array.prototype.slice.call(tb.rows, 0), // put rows into array
    i;
  reverse = -(reverse || -1);
  tr = tr.sort(function (a, b) {
    // sort rows
    return (
      reverse * // `-1 *` if want opposite order
      a.cells[col].textContent
        .trim() // using `.textContent.trim()` for test
        .localeCompare(b.cells[col].textContent.trim())
    );
  });
  for (i = 0; i < tr.length; ++i) tb.appendChild(tr[i]); // append each row in order
};

window.makeSortable = function (table) {
  let th = table.tHead,
    i;
  th && (th = th.rows[0]) && (th = th.cells);
  if (th) i = th.length;
  else return; // if no `<thead>` then do nothing
  while (--i >= 0)
    (function (i) {
      let dir = 1;
      if (th[i].innerText.toLowerCase() !== 'acties') {
        th[i].addEventListener('click', function () {
          sortTable(table, i, (dir = 1 - dir));
        });
        th[i].classList.add('cursor-pointer');
      }
    })(i);
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
