<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <style>
        body { font-family: 'Roboto', sans-serif; background-color: #f3f3f3; padding: 40px; }
        .cart-box { background: #fff; padding: 25px; border-radius: 12px; box-shadow: 0 0 15px rgba(0,0,0,0.1); width: 400px; }
        h2 { margin-bottom: 15px; }
        .producto-item { display: flex; justify-content: space-between; align-items: center; margin: 8px 0; border-bottom: 1px solid #ddd; padding-bottom: 8px; }
        .nombre-controles { display: flex; align-items: center; gap: 8px; }
        .controles button { background-color: #28a745; color: white; border: none; padding: 4px 8px; border-radius: 5px; cursor: pointer; }
        .controles button:hover { background-color: #218838; }
        .remove { color: red; font-weight: bold; cursor: pointer; margin-left: 10px; }
        .total { margin-top: 20px; font-size: 18px; }
        .btn-pagar { width: 100%; margin-top: 20px; background-color: #ffc107; border: none; padding: 10px; font-weight: bold; border-radius: 8px; cursor: pointer; }
        .btn-pagar:hover { background-color: #e0a800; }
    </style>
</head>
<body>
    <style>
    /* ... tu estilo actual ... */
    .contenedor {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>
</head>
<body>
    <div class="contenedor">
    <div class="cart-box">
        <h2>Carrito de Compras</h2>
        <div id="productos"></div>
        <div class="total">Total: $<span id="total">0</span></div>

        <form id="form-pago" method="POST" action="proceso_pago.php">
            <div id="carrito-inputs"></div>
            <button type="submit" class="btn-pagar">Pagar</button>
        </form>
    </div>
        </div>

    <script>
        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

        function renderCarrito() {
            const contenedor = document.getElementById('productos');
            const totalSpan = document.getElementById('total');
            contenedor.innerHTML = '';
            let total = 0;

            carrito.forEach((producto, index) => {
                const subtotal = producto.precio * producto.cantidad;
                total += subtotal;

                const div = document.createElement('div');
                div.className = 'producto-item';
                div.innerHTML = `
                    <div class="nombre-controles">
                        <button onclick="cambiarCantidad(${index}, -1)">-</button>
                        <strong>${producto.nombre}</strong> x${producto.cantidad}
                        <button onclick="cambiarCantidad(${index}, 1)">+</button>
                        <span class="remove" onclick="quitarProducto(${index})">x</span>
                    </div>
                    <div>$${subtotal.toLocaleString()}</div>
                `;
                contenedor.appendChild(div);
            });

            totalSpan.textContent = total.toLocaleString();
            localStorage.setItem('carrito', JSON.stringify(carrito));
        }

        function cambiarCantidad(index, delta) {
            carrito[index].cantidad += delta;
            if (carrito[index].cantidad <= 0) {
                carrito.splice(index, 1);
            }
            renderCarrito();
        }

        function quitarProducto(index) {
            carrito.splice(index, 1);
            renderCarrito();
        }

        document.getElementById('form-pago').addEventListener('submit', function(event) {
            if (carrito.length === 0) {
                event.preventDefault();
                alert('El carrito está vacío');
                return;
            }

            const inputsDiv = document.getElementById('carrito-inputs');
            inputsDiv.innerHTML = '';

            carrito.forEach(producto => {
                inputsDiv.innerHTML += `
                    <input type="hidden" name="producto_nombre[]" value="${producto.nombre}">
                    <input type="hidden" name="producto_cantidad[]" value="${producto.cantidad}">
                    <input type="hidden" name="producto_precio[]" value="${producto.precio}">
                `;
            });
        });

        renderCarrito();
    </script>
</body>
</html>