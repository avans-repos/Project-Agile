window.AddContactType = function(){
  let div = document.getElementById('company-1'),
    clone = div.cloneNode(true); // true means clone all childNodes and all event handlers
  clone.id = `company-${++highestCompany}`;
  document.getElementById('companies').appendChild(clone);

  clone = document.getElementById(`company-${highestCompany}`);
  let companySelector =  clone.querySelector(`#companySelector-1`);
  companySelector.id = `companySelector-${highestCompany}`;
  companySelector.name = companySelector.id
  let contactTypeSelector = clone.querySelector(`#contactTypeSelector-1`);
  contactTypeSelector.id = `contactTypeSelector-${highestCompany}`;
  contactTypeSelector.name = contactTypeSelector.id
  return false;
}
let highestCompany = 1;
