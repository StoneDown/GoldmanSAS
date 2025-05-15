<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Selecciona el medio de pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 30px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            display: flex;
            justify-content: space-between;
        }

        .form-section {
            background-color: white;
            padding: 25px;
            border-radius: 6px;
            width: 65%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .summary-section {
            background-color: white;
            padding: 20px;
            border-radius: 6px;
            width: 30%;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            height: fit-content;
        }

        h2 {
            font-size: 18px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        select, input[type="text"], input[type="tel"] {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .checkbox {
            margin-top: 20px;
        }

        .checkbox input {
            margin-right: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 25px;
            background-color: #88c40f;
            color: white;
            border: none;
            border-radius: 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .info {
            font-size: 13px;
            margin-top: 10px;
            background-color: #f0f0f0;
            padding: 12px;
            border-left: 4px solid #ccc;
        }

        .summary-section strong {
            display: block;
            margin-bottom: 10px;
        }

        .summary-section p {
            margin: 5px 0;
        }

        .pse-logo {
            display: inline-block;
            background: url('https://www.pse.com.co/sites/default/files/2022-11/pse_0.png') no-repeat center;
            background-size: contain;
            width: 50px;
            height: 50px;
            vertical-align: middle;
            margin-left: 10px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-section">
        <div class="section-title">
            <h2>2. Selecciona el medio de pago</h2>
            <div class="pse-logo"></div>
        </div>

        <div class="info">
            <p>1. Todas las compras y pagos por PSE son realizados en línea y la confirmación es inmediata.</p>
            <p>2. Algunos bancos tienen un procedimiento de autenticación en su página (por ejemplo, una segunda clave)...</p>
        </div>

        <form>
            <label for="banco">Banco *</label>
            <select id="banco" required>
                <option>- Seleccione -</option>
            </select>

            <label for="nombre">Nombre del titular *</label>
            <input type="text" id="nombre" placeholder="Aspirante Anónimo" required>

            <label for="tipo_cliente">Tipo de cliente *</label>
            <select id="tipo_cliente" required>
                <option>- Seleccione -</option>
            </select>

            <label for="documento">Documento de identificación *</label>
            <input type="text" id="documento" required>

            <label for="telefono">Teléfono *</label>
            <input type="tel" id="telefono" placeholder="+57 ___ ___ __ __" required>

            <div class="checkbox">
                <label>
                    <input type="checkbox" required> Acepto los <a href="#">términos y condiciones</a>
                </label>
            </div>

            <button type="submit">Pagar →</button>
        </form>
    </div>

    <div class="summary-section">
        <strong>Resumen de la compra</strong>
        <p><strong>Referencia:</strong> 123-DEMO</p>
        <p><strong>Descripción:</strong> Pago de prueba con referencia (123-DEMO)</p>
        <p><strong>Total a pagar:</strong><br> COP $32.000,00</p>
    </div>
</div>

</body>
</html>
