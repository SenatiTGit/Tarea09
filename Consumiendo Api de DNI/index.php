<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/ico.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/estilo.css">

    <title>Consulta DNI</title>
    <script src="js/jquery.min.js"></script>
</head>
<body>

<div class="title">
    <h1>CONSULTA <span class="negrita">DNI</span></h1>
</div>


<div class="dni form-center mt-5">
    <div class="inputs">
        <span><i class='bx bx-user'></i></span>
        <input class="input" type="text" id="dni" autocomplete="off" name="dni">
    </div>
    <button class="button" id="prueba">Consultar</button>
</div>
    
    <div class="secc-dni">
        <div class="row">
            <div class="col-foto col-md-6">
                <h1>Carnet</h1>
                <h1>Estudiantil</h1>
                <div class="cont-foto">
                    <img class="user" src="/api/img/User.png" alt="">
                </div>
                <img class="logo"src="/api/img/logo-senati.png" alt="">
            </div>
            <div class="col-datos col-md-6">
                <h3>9:00:00</h3>
                <h2>Nombres Completo:</h2> 
                <label id="nombre"> </label>
                <h1 >Apellido Paterno: </h1>
                <label id="apellidop">  </label >
                <h1> Apellido Materno:  </h1>
                <label  id="apellidom"> </label >
            </div>
        </div>
    </div>

  



<script>

$("#prueba").click(function(){

  var dni=$("#dni").val();


$.ajax({           
    type:"POST",
    url: "consulta-dni-ajax.php",
    data: 'dni='+dni,
    dataType: 'json',
    success: function(data) {
  
  
        if(data==1)
        {
            alert('El DNI tiene que tener 8 digitos');
        }
       
    
        else{
            console.log(data);
            $("#nombre").html(data.nombres);
            $("#apellidop").html(data.apellidoPaterno);
            $("#apellidom").html(data.apellidoMaterno);
          

         
        }
 

    }
});

})

</script>
</body>
</html>
   