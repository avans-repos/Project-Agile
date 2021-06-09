document.querySelectorAll('[id=searchInput]').forEach(function (e) {
  e.addEventListener('keyup', function () {
    !(function (e) {
      for (var t = e.value.toUpperCase(), n = e.nextElementSibling.tBodies[0].getElementsByTagName('tr'), a = 0; a < n.length; a++) {
        var l = n[a].getElementsByTagName('td');
        n[a].style.display = 'none';
        for (var r = 0; r < l.length; r++) l[r].innerHTML.toUpperCase().indexOf(t) > -1 && (n[a].style.display = '');
      }
    })(e);
  });
});
