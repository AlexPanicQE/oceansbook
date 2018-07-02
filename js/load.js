/* JS file
author:Alex Papanikos
year:2017 */

// http req/res function

function createBook()
{
  var a=document.forms["Form"]["author"].value;
  var t=document.forms["Form"]["title"].value;
  var p=document.forms["Form"]["price"].value;
  // var regex=/^[0-9]+$/;
  var answer = document.getElementById("list");
  if (a==null || a=="",t==null || t=="",p==null || p=="",answer[answer.selectedIndex].value=="selectcard" || isNaN(p)) //check valid input for sapces,number and selected genre or not
      {
      alert("Please Fill all required fields with the correct type!");
      return;
      }
  else{

    var form = document.getElementById("theForm"); //Convert into object the form data
    var formLength = form.length;
    var obj={};
    for(var i=0;i< formLength; i+=1){
      obj[form[i].name] = form[i].value;
    }
    var xhr = new XMLHttpRequest();
    var url = "/php/save.php";
    xhr.open("POST",url,true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function(){
      if(xhr.readyState == 4 && xhr.status == 200){

        console.log(xhr.responseText); //for debugging purpose
        var obj =JSON.parse(xhr.responseText);
        if(obj.status == "success"){
           // MODAL TRIGGERING
           // Get the modal
          var modal = document.getElementById('myModal');

          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close")[0];


             modal.style.display = "block";


          // When the user clicks on <span> (x), close the modal
          span.onclick = function() {
             modal.style.display = "none";
          }

          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function(event) {
             if (event.target == modal) {
                 modal.style.display = "none";
             }
          }
        }
        else{
          alert("Something went wrong!Please try again!")
        }

      }
    };

      var json = JSON.stringify(obj);
      xhr.send(json);
      form.reset();
    }

}


//Find book given a keyword
function findBook(){

	//Get keyword from keyword text field
	var keyword = document.getElementById("searchbox").value;

	if ( keyword == "" || keyword == " " ) {  //checking for input errors

    alert("No keyword given!Please try again!")

	} else if(hasNumber(keyword)===true){
       alert("Numbers are not allowed in this text field!");
  }
  else {

		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function() {
			if ( xmlhttp.readyState == 4 && xmlhttp.status == 200 ) {
				console.log(xmlhttp.responseText);//debug
        var secmodal = document.getElementById("myModal2");
        var span = document.getElementsByClassName("close2")[0];
        secmodal.style.display = "block";
        span.onclick = function() {
           secmodal.style.display = "none";
        }

        window.onclick = function(event) {
           if (event.target == secmodal) {
               secmodal.style.display = "none";
           }
        }

        // stringify json and convert in table
        var jres = JSON.parse(xmlhttp.responseText);

// check if there is an error
       if(jres.status !== "error"){
        // EXTRACT VALUE FOR HTML HEADER.
        var col = [];
        for (var i = 0; i < jres.length; i++) {
            for (var key in jres[i]) {
                if (col.indexOf(key) === -1) {
                    col.push(key);
                }
            }
        }

        // CREATE DYNAMIC TABLE.
        var table = document.createElement("table");

        // CREATE HTML TABLE HEADER ROW USING THE EXTRACTED HEADERS ABOVE.

        var tr = table.insertRow(-1);                   // TABLE ROW.

        for (var i = 0; i < col.length; i++) {
            var th = document.createElement("th");      // TABLE HEADER.
            th.innerHTML = col[i];
            tr.appendChild(th);
        }

        // ADD JSON DATA TO THE TABLE AS ROWS.
        for (var i = 0; i < jres.length; i++) {

            tr = table.insertRow(-1);

            for (var j = 0; j < col.length; j++) {
                var tabCell = tr.insertCell(-1);
                tabCell.innerHTML = jres[i][col[j]];
            }
        }

        // FINALLY ADD THE NEWLY CREATED TABLE WITH JSON DATA TO A CONTAINER.
        var divContainer = document.getElementById("allResults");
        divContainer.innerHTML = "";
        divContainer.appendChild(table);

      }
      else{
        document.getElementById("allResults").innerHTML="Oops!Sorry,we didn't find anything...";
      }
			}
		}

		xmlhttp.open( "GET","php/findBook.php?keyword=" + keyword, true );
		xmlhttp.send();

    }
  document.getElementById("searchbox").value = "";
}



//function to reveal add a book div
function revealAdd(){
  document.getElementById("revAdd").style.display="block";
  document.getElementById("hideHome").style.display="none";
  document.getElementById("backB").style.display="block";
}

//function to reveal search a book div
function revealSearch(){
  document.getElementById("findB").style.display="block";
  document.getElementById("hideHome").style.display="none";
  document.getElementById("backB").style.display="block";
}

//function to get you back hideHome
function goBack(){
  document.getElementById("findB").style.display="none";
  document.getElementById("revAdd").style.display="none";
  document.getElementById("hideHome").style.display="block";
  document.getElementById("backB").style.display="none";
}


//check if input contains number function
function hasNumber(myString) {
  return /\d/.test(myString);
}

//function to prevent enter key default action
function preventEnterKeyAction() {
	// if user press enter(13 key code)
	if ( event.keyCode == 13 ) {
		event.preventDefault();
		// and force our search for keyword
		findBook();
	}
}
