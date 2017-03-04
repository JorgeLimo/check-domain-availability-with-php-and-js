<!DOCTYPE html>
<html>
   <head>
      <title>Verificar un Dominio</title>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <!-- Optional theme -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <!-- Latest compiled and minified JavaScript Jquery-->
      <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
   </head>
   <body>
      <center>
         <h2>Revisar si el dominio esta disponible</h2>
      </center>
      <br>
      <div class="container">
         <div class="row">
               <div class="col-md-6">
                  <input name="dominio" class="form-control" id="dominioData" placeholder="Ingrese el dominio que deseas, ejm: midominio" size="30" maxlength="35"> 
               </div>
               <div class="col-md-6">
                  <select name="ext" id="ext"  class="form-control">
                     <option value="com" selected>.com</option>
                     <option value="net">.net</option>
                     <option value="org">.org</option>
                     <option value="org">.info</option>
                  </select>
               </div>
            <center>
               <button style="margin-top:30px" id="getData" type="submit" class="btn btn-primary">Revisar</button>
            </center>
            <div  style="margin-top:30px"  id="result"></div>
         </div>
      </div>
      <script type="text/javascript">
        $( "#getData" ).click(function() {

            var getName = $("#dominioData").val();
            var getDomain = $("#ext").val()

            if (getName != "") {
              $("#result").empty();
              $("#result").html('<center><img src="http://dribbble.s3.amazonaws.com/users/4613/screenshots/911982/jar-loading.gif" /></center>');            

              var dataString = 'name='+getName+'&domain='+getDomain;
                $.ajax({
                    type: "POST",
                    url: "searchDomain.php",
                    data: dataString,
                    success: function(data) {
                        $("#result").empty();
                        if (data == 1) {
                            $("#result").html('<div class="alert alert-success"><h4>Buenas noticias, el dominio <strong>www.'+getName+'.'+getDomain+'</strong> se encuentra disponible</h4></div><br><center><img src="https://cdn2.iconfinder.com/data/icons/social-buttons-2/512/thumb_up-512.png" style="width:300px"/></center>'); 
                        }else{
                            $("#result").html('<div class="alert alert-danger"><h4>Hay un problema, el dominio <strong>www.'+getName+'.'+getDomain+'</strong> no se encuentra disponible</h4></div><br><center><img src="https://cdn2.iconfinder.com/data/icons/social-buttons-2/512/thumb_down-512.png" style="width:300px"/></center>'); 
                        }            
                    }
                });

            }else{

                $("#result").html('<div class="alert alert-danger">Ingrese el nombre del dominio que desea </div>');
            
            }

        });
      </script>
   </body>
</html>

