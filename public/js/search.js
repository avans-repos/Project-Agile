/******/ (() => {
  // webpackBootstrap
  var __webpack_exports__ = {};
  /*!********************************!*\
  !*** ./resources/js/search.js ***!
  \********************************/
  document.getElementById('searchInput').addEventListener('keyup', singleSearch);

  function singleSearch() {
    // Declare variables
    var input = document.getElementById('searchInput');
    var filter = input.value.toUpperCase();
    var table = document.getElementById('searchTable');
    var trs = table.tBodies[0].getElementsByTagName('tr'); // Loop through first tbody's rows

    for (var i = 0; i < trs.length; i++) {
      // define the row's cells
      var tds = trs[i].getElementsByTagName('td'); // hide the row

      trs[i].style.display = 'none'; // loop through row cells

      for (var i2 = 0; i2 < tds.length; i2++) {
        // if there's a match
        if (tds[i2].innerHTML.toUpperCase().indexOf(filter) > -1) {
          // show the row
          trs[i].style.display = ''; // skip to the next row

          continue;
        }
      }
    }
  }
  /******/
})();
