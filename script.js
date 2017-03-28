///////////////////////////////////////////////////////
/* script to pull out form data and make it a string */
///////////////////////////////////////////////////////

function buildString(e){

//get all inputs out of the form element
var elements = document.getElementById("buildString").elements;
//declare a variable to hold the result;
var result = "";
//iterate through the select elements and build a pipe-delimited string
for (var i = 0, element; element = elements[i++];){

    if(element.type == "select-one"){

    //if it's the first element, and it's empty, add an extra pipe
    if(i == 0 && !element.value){
    result += "|";
    }

    result += element.value;

    //no trailing pipes.
    if(i < elements.length){
    result += "|";
    }
  }

  }

  //stick the result in the output textarea
  document.getElementById("output").innerHTML = result;

  //don't let it do weird button stuff.
  e.preventDefault();

}

//add the event listener to the button
document.getElementById("submitBuildString").addEventListener("click", buildString);

////////////////////////////
/* control data mini-previews */
///////////////////////////

function toggleMiniPreview(){

  var id = this.id.split("-");
  var key = id[1];
  var el = document.getElementById("preview-" + key);

  if (this.checked == true){

    el.style.display = 'block';

  }else{

    el.style.display = 'none';

  }

}

var elements = document.getElementById("buildString").elements;

for(var i = 0, element; element = elements[i++];){

  var check = element.id.split("-");

  if(element.type == "checkbox"){

    element.addEventListener("click", toggleMiniPreview);

  }

}
