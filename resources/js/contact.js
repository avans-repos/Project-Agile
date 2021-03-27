window.AddContactType = function(){
  let div = document.getElementById('company-1'),
    clone = div.cloneNode(true); // true means clone all childNodes and all event handlers
  clone.id = `company-${++highestCompany}`;
  document.getElementById('companies').appendChild(clone);
  return false;
}
let highestCompany = 1;
