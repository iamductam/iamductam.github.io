<?php
error_reporting(0);
include_once "class/deviceClass.php";

?>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/common.js" type="application/javascript"></script>
    <link href="css/common.css" rel="stylesheet">
    <style>
        .error{
            color:red;
        }
        input[type='text']{
            width:60%;
            padding:10px;
        }
        #check{
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 9px 13px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
        #clear{
            background-color: red; /* Green */
            border: none;
            color: white;
            padding: 9px 13px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

    </style>
</head>
<body>
<center><div id="loader"></div></center>
<form id="form">
    <label>App Token </label><input type="text" name="appToken" id="appToken" placeholder="App Token" class="validate"><br>
    <span id="appToken_error" class="error"></span>
    <br>
    <label>X-Apple-I-MD </label><input type="text" name="md" id="md" placeholder="X-Apple-I-MD" class="validate"><br>
    <span id="md_error" class="error"></span>
    <br>
    <label>X-Apple-I-MD-M </label><input type="text" name="mdm" id="mdm" placeholder="X-Apple-I-MD-M" class="validate">
    <br>
    <span id="mdm_error" class="error"></span>
    <br>
    <input type="button" id="check" value="CHECK">&nbsp;
    <input type="reset" id="clear" value="CLEAR">
    <br>
    <div id="result"></div>
</form>
<script>
    $(document).ready(function(){
        $(document).on('click', '#check', function () {
            auth();
        })
        $(document).on('click', '.remove', function(){
          var apptoken = $(this).attr('data-apptoken');
          var md = $(this).attr('data-md');
          var mdm = $(this).attr('data-mdm');
          var id = $(this).attr('data-id');

          $.ajax({
              url: 'ajax/index.php',
              data: {apptoken:apptoken, md: md, id:id, mdm:mdm},
              type: 'POST',
              beforeSend: function() {
                  addLoader();
              },
              success: function(response) {
                  removeLoader();
                 auth();
              }
          })
      })
    })
    function auth(){

        var data = JSON.stringify($("form").serializeArray());
        var isTrue = startValidation();
        if(isTrue){
            $.ajax({
                url: 'ajax/index.php',
                type: 'POST',
                data: {
                    auth: data
                },
                // dataType: "json",
                beforeSend: function() {
                    addLoader();
                },
                success: function(response) {
                    removeLoader();
                    $('#result').html(response)
                }

            })
        }
    }
</script>
<p style="text-align:center;">Powered by <a href="http://fb.me/DucTam.Tech" target="_blank">DucTamMobile</a></p>
</body>
</html>