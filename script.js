function openNav() {
    var x = document.getElementById("myNavBar");
    if (x.className === "navBar") {
      x.className += " responsive";
    } else {
      x.className = "navBar";
    }
}


function closeModal(){
  var modal = document.getElementById("productModal");
  modal.style.display = "none";
}

