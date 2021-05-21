function search() {
    // Declare variables
    let inputstudent = document.getElementById("search-1");
    let filterstudent = inputstudent.value.toUpperCase();

    let inputclass = document.getElementById("search-2");
    let filterclass = inputclass.value.toUpperCase();

    let table = document.getElementById("add-contact-table");
    let tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
      let studenttd = tr[i].getElementsByTagName("td")[0];
      let classtd = tr[i].getElementsByTagName("td")[3];

      if (studenttd && classtd) {
        let studentvalue = studenttd.textContent || studenttd.innerText;
        let classvalue = classtd.textContent || classtd.innerText;

        if (studentvalue.toUpperCase().indexOf(filterstudent) > -1 && classvalue.toUpperCase().indexOf(filterclass) > -1) {
          tr[i].classList.remove("d-none");
        } else {
          tr[i].classList.add("d-none");
        }
      }
    }
  }