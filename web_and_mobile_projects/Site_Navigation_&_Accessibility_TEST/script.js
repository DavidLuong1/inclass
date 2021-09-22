// function popTheToast(){
//   document.getElementById()
// }

document.getElementById("searchBar").addEventListener("keyup", function(evt){
  if(evt.keyCode == 13) { //for "Enter" key...
    evt.preventDefault();
    alert("No results found.");
  }
});

// function toggleMenu( window.matchMedia("(max-width: 1200px)") ){
function toggleMenu(){
  // if( window.matchMedia("(max-width: 1200px)").matches ){
    document.getElementById("#menu").classList.toggle("hidden-tab");
    // document.getElementsByClassName(".tabs").style.display = "none";
    // document.getElementsByClassName(".hidden-tab").style.display = "block";
  // }
}

function loadMyItem(){
  var input, filter, item, a, i;
  input = document.getElementById("itemSearch");
  filter = input.value.toUpperCase();
  item = document.getElementById("searchBox").getElementsByTagName("li");

  for(i=0; i < item.length; i++){
      a = item[i].getElementsByTagName("a")[0];

      if( a.innerHTML.toUpperCase().indexOf(filter) > -1 ) {
          item[i].style.display = "";
      } else {
          item[i].style.display = "none";
      }
  }

}
