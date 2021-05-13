<!-- <!DOCTYPE html>
<html>
   <head>
     <title>Import Data From Excel or CSV File to Mysql using PHPSpreadsheet</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
   </head> -->
   <?php 
    /* session_start(); */
    include ('header.php');
    

    $user = array();

    
    if(isset($_SESSION['email'])){
        /* print "entré"; */
        
        $user = get_user_info($con, $_SESSION['email']);
        /* echo $user[0];
        echo isset($user[0]); */
        /* foreach ($user as $key => $value) {
            echo "Key: $key; Value: $value\n<br>";
        } */
    }else{
        /* print "no entré"; */
    }

?>
        
  <div class="container-fluid card-style mb-5 pb-4">

  <h1 class="h3 mt-2 mb-4 text-gray-800">Registro de estudiantes</h1>

    <div class="card">
      <div class="card-body">
          
        <a class="btn btn-info btn-sm shadow-sm" href="../excel/estudiantes.xlsx" download="estudiantes.xlsx" type="button" >
        Descargar plantilla Excel
        </a>

        <div class="table-responsive">
          <br>
          <h5>Puedes registrar varios estudiantes en 3 simples pasos:</h5><br>
          <dl>
            <dt>Paso 1:</dt>
            <dd>- Descarga la plantilla Excel</dd>
            <dt>Paso 2:</dt>
            <dd>- Ingresa los datos de tus estudiantes</dd>
            <dt>Paso 3:</dt>
            <dd>- Sube aquí tu archivo Excel y presiona "Registrar estudiantes"</dd>
          </dl> 
          <span id="message"></span>
          <form method="post" id="import_excel_form" enctype="multipart/form-data">
              <div class="table">
                  
                  <input type="file" style="margin-top:15px;" name="import_excel" />
                  <br>
                  
                  <input class="btn btn-info mt-4" type="submit" name="import" id="import" class="btn btn-primary" value="Registrar estudiantes" />
              
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script>
$(document).ready(function(){
  $('#import_excel_form').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:"import.php",
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import').attr('disabled', 'disabled');
        $('#import').val('Subiendo datos...');
      },
      success:function(data)
      {
        $('#message').html(data);
        $('#import_excel_form')[0].reset();
        $('#import').attr('disabled', false);
        $('#import').val('Registrar estudiantes');
      }
    })
  });
});
</script>
