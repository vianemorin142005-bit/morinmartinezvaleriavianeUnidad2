<?php
require_once 'config/security.php';
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat de Soporte</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background-color:#f4f6f9;
        }

        .chat-box{
            height: 400px;
            overflow-y: auto;
            background: white;
            border-radius: 15px;
            padding: 15px;
        }

        .contenedor{
            max-width: 700px;
            margin: auto;
            margin-top: 40px;
        }

        .msg-user{
            text-align: right;
        }

        .msg-user span{
            background: #1f1cff;
            color: white;
            padding: 10px 15px;
            border-radius: 15px 15px 0 15px;
            display: inline-block;
            margin: 5px 0;
        }

        .msg-bot span{
            background: #e9ecef;
            padding: 10px 15px;
            border-radius: 15px 15px 15px 0;
            display: inline-block;
            margin: 5px 0;
        }

        .btn-chat{
            background:#1f1cff;
            color:white;
        }

        .btn-chat:hover{
            background:#1714d9;
       
}

    </style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="contenedor">

    <h3 class="text-center mb-3">💬 Chat de Soporte</h3>

    <div class="chat-box shadow" id="chat">

        <div class="msg-bot">
            <span>🤖 Hola, ¿en qué puedo ayudarte?</span>
        </div>

    </div>

    <div class="input-group mt-3">
        <input type="text" id="mensaje" class="form-control" placeholder="Escribe tu mensaje...">
        <button class="btn btn-chat" onclick="enviar()">Enviar</button>
    </div>

</div>

<script>
function enviar(){
    let input = document.getElementById("mensaje");
    let chat = document.getElementById("chat");

    if(input.value.trim() === "") return;

    // Mensaje usuario
    chat.innerHTML += `
        <div class="msg-user">
            <span>${input.value}</span>
        </div>
    `;

    // Respuesta automática
    setTimeout(() => {
        chat.innerHTML += `
            <div class="msg-bot">
                <span>🤖 Gracias por tu mensaje, en breve te respondemos.</span>
            </div>
        `;
        chat.scrollTop = chat.scrollHeight;
    }, 800);

    input.value = "";
    chat.scrollTop = chat.scrollHeight;
}
</script>

</body>
</html>