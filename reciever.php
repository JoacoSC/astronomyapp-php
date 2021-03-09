<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.1.1/socket.io.min.js" integrity="sha512-tXH7Av8en7+/hg0XwBppaCDPmpJhUXbZ+j7lNC4y+ZQpmCZQcgQN6RjkM7Irj1MUW7bZengfuTOqR4RzCC4bnA==" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>

<script>

    var socket = io.connect("http://localhost:8098");

    socket.on("new_order",function (data){

        console.log(data);

    })

</script>
    
</body>
</html>