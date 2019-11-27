<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>TEST</title>
</head>
<body>
  <div class="container" style="padding-top:50px;">
    <div id="form" class="row">
      <div  class="col">
        <form >
          <div class="form-row" >
            <div class="col" >
              <label for="apiUrl">Method</label>
              <select id="method" class="form-control">
              <option selected>GET</option>
              <option>POST</option>
              <option>DELETE</option>
              </select>
              <small class="form-text text-muted">Chose request Method</small>
            </div>
            <div id="apiUrl" class="col-6">
              <label for="apiUrl">Enter URL</label>
              <input id="url" type="text" class="form-control" placeholder="Enter Url">
              <small class="form-text text-muted">Write Url for API request</small>
            </div>
            <div id="params" class="col">
              <label for="userId">Enter ID</label>
              <input id="userId" type="text" class="form-control" placeholder="Enter ID">
              <small class="form-text text-muted">Write User ID</small>
            </div>
          </div>
          <div style="text-align:center;">
            <button id="send" type="button" class="btn btn-success">Send</button>
          </div>          
        </form>
      </div>
    </div>
  </div>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
  integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script>
  jQuery(document).ready(function($){
    $('#method').change(function(){

      if($('#method').val() == 'GET'){
        $('#params').remove();
        $('#apiUrl').after(`
          <div id="params" class="col" style="display:none;">
            <label for="userId">Enter ID</label>
            <input id="userId" type="text" class="form-control" placeholder="Enter ID">
            <small class="form-text text-muted">Write User ID</small>
          </div>
        `);
        $('#params').fadeIn('500');

      }else if($('#method').val() == 'POST'){
        $('#params').remove();
        $('#apiUrl').after(`
          <div id="params" class="col" style="display:none;">
            <label for="userEmail">Enter Email</label>
            <input id="userEmail" type="text" class="form-control" placeholder="Enter Email">
            <small class="form-text text-muted">Write User Email</small>
            <label for="userPass">Enter Password</label>
            <input id="userPass" type="text" class="form-control" placeholder="Enter Password">
            <small class="form-text text-muted">Write User Password</small>
          </div>`);
        $('#params').fadeIn('500');
      }else if($('#method').val() == 'DELETE'){
        $('#params').remove();
        $('#apiUrl').after(`
          <div id="params" class="col" style="display:none;">
            <label for="userId">Enter ID</label>
            <input id="userId" type="text" class="form-control" placeholder="Enter ID">
            <small class="form-text text-muted">Write User ID</small>
          </div>
        `);
        $('#params').fadeIn('500');
      }
    });


    $("#send").click(function(){
      $('#result').remove();
      if($('#url').val() == ''){

        $('#form').after(`
          <div id="result" class="row" style="display:none;">
            <div class="col" style="text-align:center;">
              <h3 style="color:red;">Api URL Required</h3>
            </div>
          </div>
        `);
        $('#result').fadeIn('500');
      }else{

      $.ajax({
        type: $('#method').val(),
        url: $('#url').val(),
        data:{
          id: $('#userId').val(),
          email: $('#userEmail').val(),
          password: $('#userPass').val()
					},
        cache: false,

        success: function(data){

          switch($('#method').val())
          {
            case 'GET':
              $('#result').remove();
              data = JSON.parse(data);
              if(data['status'] =='OK'){
                $('#form').after(`
                  <div id="result" class="row" style="display:none;">
                    <div class="col" style="text-align:center;">
                      <h3 style="color:green;">User</h3>
                      <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Password</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">`+data['user']['id']+`</th>
                            <td>`+data['user']['email']+`</td>
                            <td>`+data['user']['password']+`</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                `);
              }else{
                $('#form').after(`
                  <div id="result" class="row" style="display:none;">
                    <div class="col" style="text-align:center;">
                      <h3 style="color:red;"> `+data['errorText']+`</h3>
                    </div>
                  </div>
                `);
              }
              $('#result').fadeIn('500');
            break;
            case 'POST':
              $('#result').remove();
              data = JSON.parse(data);
              if(data['status'] =='OK'){
                $('#form').after(`
                  <div id="result" class="row" style="display:none;">
                    <div class="col" style="text-align:center;">
                      <h3 style="color:green;">User Created</h3>
                    </div>
                  </div>
                `);
              }else{
                $('#form').after(`
                  <div id="result" class="row" style="display:none;">
                    <div class="col" style="text-align:center;">
                      <h3 style="color:red;"> `+data['errorText']+`</h3>
                    </div>
                  </div>
                `);
              }
              $('#result').fadeIn('500');
            break;
            case 'DELETE':
              data = JSON.parse(data);
              if(data['status'] =='OK'){
                $('#form').after(`
                  <div id="result" class="row" style="display:none;">
                    <div class="col" style="text-align:center;">
                      <h3 style="color:green;">User Deleted</h3>
                    </div>
                  </div>
                `);
              }else{
                $('#form').after(`
                  <div id="result" class="row" style="display:none;">
                    <div class="col" style="text-align:center;">
                      <h3 style="color:red;"> `+data['errorText']+`</h3>
                    </div>
                  </div>
                `);
              }
              $('#result').fadeIn('500');
            break;
          }



        },
        error:function(data){
          console.log(data.statusText);
        }
    });
      }
    });
  });
</script>
</body>
</html>