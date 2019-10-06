window.onscroll = function() {myFunction()};

function myFunction() {
  if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
    document.getElementById("top").classList.add("sticky")
  } 
  else {
    document.getElementById("top").className = ""
  }
}


function navBarHandler(){
  var header = document.getElementById("myNavbar");
  var btns = header.getElementsByClassName("rgstr");
  for (var i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
    });
  }
}


function loginBoxHandler(){
  var click = document.getElementsByClassName("textbox");
  for(var i = 0; i < click.length; i++){
      click[i].addEventListener("click", function() {
      var current = document.getElementsByClassName("activeLogin");
      if (current.length > 0){
      current[0].className = current[0].className.replace(" activeLogin", "");
      }
      this.className += " activeLogin";
      });
  }
}