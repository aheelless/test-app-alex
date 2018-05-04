
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Загрузка изображений на сервер</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
      <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
      <style>
          body {
              padding: 30px;
          }
      </style>
  </head>
  <body>
      <form id="uploadimage" action="api.php" method="post" enctype="multipart/form-data">
          <div class="row">
              <div class="col-xs-6 col-md-3">
                  <div id="image_preview">
                      <img id="blah" src="" />
                  </div>
              </div>
              <div class="col-xs-6 col-md-3">
          <img id="imgUploaded" src="#" class="img-responsive">
         </div>
          </div>
             <hr id="line">
          <div class="input-group col-lg-6" id="selectImage">
              <input type="file" name="file" class="form-control" onchange="readURL(this)" />
              <span class="input-group-btn">
              <input type="submit" value="Отправить" class="submit btn btn-success" />
              </span>
          </div>
      </form>
      <p id="errorresponse"></p>
      <script src="jquery-3.3.1.min.js"></script>
      <script src="bootstrap.min.js"></script>
      <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
      <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
      <script type="text/javascript">
       function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
       $('#uploadimage').on('submit',(function(e) {
           e.preventDefault();
           var formData = new FormData(this);
           $.ajax({
               type:'POST',
               url: $(this).attr('action'),
               data:formData,
               cache:false,
               contentType: false,
               processData: false,
               success:function(data) {
                   data = JSON.parse(data);
                   console.log(data);
                   if (data.success === true) {
                       $('#imgUploaded')
                           .attr('src', data.response)
                           .width(150)
                           .height(200);
                   } else {
                       $('#errorresponse').text(data.response);
                   }
               },
               error: function(data){
                   console.log("error");
                   console.log(data);
               }
           });
       }));
    </script>
  </body>
</html>

