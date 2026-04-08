<script>
document.getElementById("name").addEventListener("keyup", function(){
  let email = this.value;

  if (email.length > 3) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "checkEmail.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function() {
      document.getElementById("email-status").innerHTML = this.responseText;
    }

    xhr.send("email=" + email);
  } else {
    document.getElementById("email-status").innerHTML = "";
  }
});
</script>
