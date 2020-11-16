<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 503</title>
</head>
<style>
*{
    background-color:  #da4985;
}
.error-container{
    height: 100%;
    width: 100%; 
    display: flex;
    justify-content: center;
    align-items: center;      
}
#nombre-error{
    position:absolute;
    top: 0px;
    color:white;
    font-size:200px;
    z-index: 3;
}
#message{
    position: absolute;
    top: 600px;
    color: white;
    font-size: 45px;
    z-index:2;
}
</style>
<body>
<div class="error-container">
    <div id="nombre-error">503</div>
    <img src="{{ asset('black') }}/img/404.png">
    <div id="message">Servicio no disponible</div>
</div>   
</body>