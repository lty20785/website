
function organiseInit() {
  new Validator(document.forms["organise"]);
  $(function() {
    $("#datepicker").datepicker({ minDate: new Date() });
  });
}

window.addEventListener("load", organiseInit);




