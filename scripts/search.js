
function searchInit() {
  new Validator(document.forms["query"]);

  $(function() {
    $("#datepicker1").datepicker({ minDate: new Date() });
  });
  $(function() {
    $("#datepicker2").datepicker({ minDate: new Date() });
  });
}

window.addEventListener("load", searchInit);




