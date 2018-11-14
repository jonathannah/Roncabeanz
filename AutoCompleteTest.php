<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    * {
      box-sizing: border-box;
    }

    body {
      font: 16px Arial;
    }

    .autocomplete {
      /*the container must be positioned relative:*/
      position: relative;
      display: inline-block;
    }

    input {
      border: 1px solid transparent;
      background-color: #f1f1f1;
      padding: 10px;
      font-size: 16px;
    }

    input[type=text] {
      background-color: #f1f1f1;
      width: 100%;
    }

    input[type=submit] {
      background-color: DodgerBlue;
      color: #fff;
      cursor: pointer;
    }

    .autocomplete-items {
      position: absolute;
      border: 1px solid #d4d4d4;
      border-bottom: none;
      border-top: none;
      z-index: 99;
      /*position the autocomplete items to be the same width as the container:*/
      top: 100%;
      left: 0;
      right: 0;
    }

    .autocomplete-items div {
      padding: 10px;
      cursor: pointer;
      background-color: #fff;
      border-bottom: 1px solid #d4d4d4;
    }

    .autocomplete-items div:hover {
      /*when hovering an item:*/
      background-color: #e9e9e9;
    }

    .autocomplete-active {
      /*when navigating through the items using the arrow keys:*/
      background-color: DodgerBlue !important;
      color: #ffffff;
    }
    </style>
    </head>

    <title>Title</title>
<body>

<h2>Autocomplete</h2>

<p>Start typing:</p>

<!--Make sure the form has the autocomplete function switched off:-->
<div style="float:left; padding: 10px">
    <form autocomplete="off" action="/action_page.php">
      <div class="autocomplete" style="width:25vw;">
        <input id="customers" type="text" name="customers" placeholder="Search Customers">
      </div>
    </form>
</div>

<div style="float:left; padding: 10px">
    <form autocomplete="off" action="/action_page.php">
       <div class="autocomplete" style="width:25vw;">
            <input id="products" type="text" name="products" placeholder="Search Products">
        </div>
    </form>
</div>

<script>

function autocomplete(inp, inpType)
{
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);

      var request = new XMLHttpRequest();

      // Open a new connection, using the GET request on the URL endpoint

      var url = "http://roncabeanz.com/Roncabeanz/lib/AutoCompleteSearch.php?sType=" + inpType + "&sVal=" + val;
      request.open('GET', url, true);

      request.onerror = function(){
          b = document.createElement("DIV");
          b.innerHTML = "Error";
          a.appendChild(b);

      }

      request.onload = function () {

          var data = JSON.parse(this.responseText);
          for(var i = 0, len = data.length; i < len; i++){
              // Begin accessing JSON data here
              var cur = data[i];
              b = document.createElement("DIV");
              var curText;

              if(inpType == "user") {
                  curText = cur["lastName"] + ", " + cur["firstName"] + ": " + cur["emailAddress"];
              }
              else {
                  curText = cur["country"] + " " + cur["name"];
              }
              b.innerHTML = curText;
                  b.innerHTML += "<input type='hidden' value='" + curText + "'>";
              b.addEventListener("click", function(e) {
                  /*insert the value for the autocomplete text field:*/
                  sel = this.getElementsByTagName("input")[0].value;
                  inp.value = sel;
                  /*close the list of autocompleted values,
                  (or any other open lists of autocompleted values:*/
                  closeAllLists();
              });

              a.appendChild(b);
          };
      }
      request.send();
   });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        //e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("customers"), "user");
autocomplete(document.getElementById("products"), "product");
</script>

</body>
</html>