<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="content-type" content="application/json; charset=utf-8" />
        <title>Oceansbook-Book Management Platform</title>

        <script type="text/javascript" src="js/load.js?v=9"></script>

       <link rel="stylesheet" type="text/css" href="css/style.css?version=97">

       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    </head>


    <body>
      <div class="home" id="hideHome">
       <h1>Welcome to Oceansbook!!!</h1>
       <div class="nav-bar"></div>
       <h3>The best book management platform around...</h3>
       <div class="btncon">
         <button type="button" id="btn1" onclick="revealAdd()"><i class="fa fa-save fa-2x"></i></i></button>
         <button type="button" id="btn2" onclick="revealSearch()"><i class="fa fa-search fa-2x"></i></button>
       </div>
     </div>
     <div class="btn" id="backB" style="display:none;">
        <button type="button" id="btn3" onclick="goBack()"><i class="fa fa-home fa-2x" aria-hidden="true"></i></button>
     </div>
      <div class="container">
        <div class="coninsert" id="revAdd" style="display:none;">
          <div class="insertBook" id="saveB" >
            <h2>SAVE A BOOK</h2>
            <div class="insertElem"  id="insdiv" >
            <form name="Form" id="theForm" enctype='application/json'>
                 Author: <input type="text" name="author" autocomplete="off"><br>
                 Title: <input type="text" name="title" autocomplete="off"><br>
                 <div class="droplist">
                 Genre :<select id="list" name="genre">
                    <option value="selectcard" style="display:none;">--- Please select ---</option>
                    <option value="science fiction">Science fiction</option>
                    <option value="satire">Satire</option>
                    <option value="drama">Drama</option>
                    <option value="action and adventure">Action & Adventure</option>
                    <option value="romance">Romance</option>
                    <option value="Mystery">Mystery</option>
                    <option value="horror">Horror</option>
                </select>
                </div>
                 Price: <input type="text" name="price" autocomplete="off"><br>
                <input type="button" value="Save"  onclick="createBook()">
            </form>
            <!-- MODAL AREA -->
            <div id="myModal" class="modal">

                   <!-- Modal content -->
               <div class="modal-content">
                 <div class="modal-header" >
                   <span class="close">&times;</span>
                   <p>GREAT BOOK!</p>
                 </div>
                 <div class="modal-body">
                   <p>Your book added succesfully!</p>
                   <p>You can now search it by giving a keyword...</p>
                 </div>
                 <div class="modal-footer">
                   <p>THANK YOU</p>
                 </div>
               </div>

          </div>
          </div>
        </div>
        </div>
          <div class="seachd" id="findB" style="display:none;">
            <div class="confind">
            <h2>SEARCH A BOOK</h2>
            <div class="insider" id="insidiv" >
            <form id="secForm">
                <input type="text" placeholder="Enter a keyword" id="searchbox" autocomplete="off" name="query" onkeydown="preventEnterKeyAction()"/>
                <input type="button"  value="Search" onclick="findBook()" />
            </form>
          </div>
      <div id="myModal2" class="modal2">
          <!-- Modal content -->
            <div class="modal-content2">
              <div class="modal-header2" >
                <span class="close2">&times;</span>
                <p>SEARCH RESULTS</p>
              </div>
              <div class="modal-body2">
                <div id="allResults" class="keywordResult"></div>
              </div>
              <div class="modal-footer2">
                <p>THANK YOU</p>
              </div>
            </div>
          </div>

        </div>
      </div>
      </div>
      <div class="footer">
        <p>&copy; 2017 Alex Papanikos<p>
      </div>
    </body>
</html>
