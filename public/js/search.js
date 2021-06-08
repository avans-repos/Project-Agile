document.getElementById('searchInput').addEventListener('keyup', function () {
  for (
    var e = document.getElementById('searchInput').value.toUpperCase(),
      t = document.getElementById('searchTable').tBodies[0].getElementsByTagName('tr'),
      n = 0;
    n < t.length;
    n++
  ) {
    var a = t[n].getElementsByTagName('td');
    t[n].style.display = 'none';
    for (var d = 0; d < a.length; d++) a[d].innerHTML.toUpperCase().indexOf(e) > -1 && (t[n].style.display = '');
  }
});
