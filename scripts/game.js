
var editableForm;

function gameInit() {
  // Set up the editable form
  editableForm = document.getElementById("editableForm");

  var editButton = document.getElementById("editButton");
  editButton.addEventListener("click", enableEditing);

  // Set up form validation
  new Validator(document.forms["editableForm"]);

  // Set up the date picker
  $(function() {
    $("#datepicker").datepicker({ minDate: new Date() });
  });
}

function enableEditing() {
  editableForm.className = "editable"; 
  return false;
}

function disableEditing() {
  editableForm.className = "uneditable";
}

window.addEventListener("load", gameInit);

