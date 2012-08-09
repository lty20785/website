
var usernameField;
var usernameAvailabilityDiv;

function splashInit() {
  new Validator(document.forms["signup"]);

  usernameField = document.forms["signup"]["username"];
  usernameField.addEventListener("keyup", onUsernameChange);

  usernameAvailabilityDiv = document.getElementById("usernameAvailability");

}

function onUsernameChange() {
  // Old results are out of down, so kill them
  hideUsernameAvailability();
  if (usernameField.value.length < 4) {
    // Can't have a username less than 4 chars anyway
    return;
  }

  xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState==4 && xhr.status==200) {
      checkUsernameAvailability(xhr.responseText);
    }
  }

  url = "usernameCheck.php?username=" + encodeURIComponent(usernameField.value);
  xhr.open("GET", url, true);
  xhr.send();
}

function checkUsernameAvailability(responseText) {

  response = JSON.parse(responseText);

  if (response["username"] == usernameField.value) {
    // Results are up-t-date
    showUsernameAvailability(response["available"]);
  }
}

function showUsernameAvailability(available) {
  if (available) {
    usernameAvailabilityDiv.className = "available";
  } else {
    usernameAvailabilityDiv.className = "unavailable";
  }
}

function hideUsernameAvailability() {
  usernameAvailabilityDiv.className = "unsure";
}

window.addEventListener("load", splashInit);

