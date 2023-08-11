<!DOCTYPE html>
<html>

<head>
    <title>Buscar usuarios</title>
    <style>
        *{
            font-family: Arial, Helvetica, sans-serif;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 10px;
        }
        input{
            float: right;
        }
    </style>
    <script>
        function searchUsers() {
            var input = document.getElementById("searchInput");
            var filter = input.value.toUpperCase();
            var cards = document.getElementsByClassName("card");

            for (var i = 0; i < cards.length; i++) {
                var servidor = cards[i].getAttribute("data-nombres");
                if (servidor.toUpperCase().indexOf(filter) > -1) {
                    cards[i].style.display = "";
                } else {
                    cards[i].style.display = "none";
                }
            }
        }

        function downloadUrl(url, callback) {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (request.readyState === 4 && request.status === 200) {
                    callback(request);
                }
            };
            request.open("GET", url, true);
            request.send(null);
        }

        function createCard(nombre, apellido) {
            var card = document.createElement("div");
            card.className = "card";
            card.setAttribute("data-nombres", nombre);

            var nombreElement = document.createElement("h3");
            nombreElement.textContent = nombre + "    " + apellido;

            var addButton = document.createElement("input");
            addButton.type = "button";
            addButton.value = "Añadir";

            nombreElement.appendChild(addButton);
            card.appendChild(nombreElement);

            return card;
        }

        function displayUsers(users) {
            var container = document.getElementById("userContainer");

            users.forEach(function(user) {
                var card = createCard(user.Nombres, user.Apellidos);
                container.appendChild(card);
            });
        }

        downloadUrl('Servidor.php', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');

            var users = Array.from(markers).map(function(marker) {
                return {
                    Nombres: marker.getAttribute('Nombres'),
                    Apellidos: marker.getAttribute('Apellidos')
                };
            });

            displayUsers(users);
        });
    </script>
</head>

<body>
    <h1>Buscar usuarios por servidor</h1>
    <input style="margin-bottom: 2%; float:none;" type="text" id="searchInput" placeholder="Buscar amigos" onkeyup="searchUsers()" />
    <div id="userContainer"></div>

</body>

</html>
