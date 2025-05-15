<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Procesando Compra</title>
  <style>
    body {
      margin: 0;
      height: 100vh;
      background-color:rgb(0, 0, 0);
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: sans-serif;
      overflow: hidden;
    }

    .linea {
      position: fixed;
      height: 4px;
      background-color: #007bff;
      z-index: 10;
    }

    .linea.arriba {
      top: 0;
      right: -100%;
      width: 100%;
      animation: moverIzquierda 5s forwards;
    }

    .linea.abajo {
      bottom: 0;
      left: -100%;
      width: 100%;
      animation: moverDerecha 5s 5s forwards;
    }

    @keyframes moverIzquierda {
      to { right: 100%; }
    }

    @keyframes moverDerecha {
      to { left: 100%; }
    }

    .mensaje {
      font-size: 2em;
      color: white;
    }

    .puntos::after {
      content: '';
      display: inline-block;
      animation: puntos 1.5s infinite steps(4);
      color: puntos white;
    }

    @keyframes puntos {
      0%   { content: ''; }
      25%  { content: '.'; }
      50%  { content: '..'; }
      75%  { content: '...'; }
      100% { content: ''; }
    }
  </style>
  <script>
    setTimeout(() => {
      window.location.href = "recibo.php";
    }, 10000); // 10 segundos en total
  </script>
</head>
<body>
  <div class="linea arriba"></div>
  <div class="linea abajo"></div>
  <div class="mensaje">Procesando compra<span class="puntos"></span></div>
</body>
</html>
