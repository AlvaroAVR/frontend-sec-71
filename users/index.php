<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mantenedor de usuarios</title>
    <style>
        body {
            background-color: black;
            color: greenyellow;
            font-family: 'Courier New', Courier, monospace;
            margin: auto 60px;
            border: solid white;
        }
    </style>
</head>

<body>
    <h1>Usuarios</h1>
    <hr>
    <button onclick="nuevoUsuario()">Nuevo Usuario</button>
    <hr>
    <div id="formulario" style="display: none;">
        <input type="text" id="inUsername" placeholder="Ingrese Username" value="abecerra"> <br>
        <input type="text" id="inNombre" placeholder="Ingrese Nombre" value="Andrea Becerra"> <br>
        <select id="selRol">
            <option value="1">Owner</option>
            <option value="2">Operator</option>
        </select> <br>
        <button onclick="nuevo()">Guardar Nuevo</button>
    </div>
    <hr>
    <table id="tDatos"></table>
    <hr>
    <div id="showInfoUsuario">
        <h2>Info del Usuario</h2>
    </div>
</body>

<script>
    const listaUsuarios = [{
        id: 1,
        username: 'scabezas',
        nombre: 'Sebastian Cabezas',
        rol: {
            id: 1,
            nombre: 'Owner'
        },
        estado: true
    },
    {
        id: 2,
        username: 'cduque',
        nombre: 'Carlos Duque',
        rol: {
            id: 2,
            nombre: 'Operator'
        },
        estado: false
    }]

    listar();

    function listar(){
        const tabla = document.getElementById('tDatos');
        tabla.innerHTML='';
        const thead = document.createElement('thead');

        thead.innerHTML = `
        <tr>
            <th>#</th>
            <th>UserName</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        `;

        const tbody = document.createElement('tbody');

        listaUsuarios.forEach(user => {
            const tr = document.createElement('tr');
            const id = document.createElement('td');
            const username = document.createElement('td');
            const estado = document.createElement('td');
            const acciones = document.createElement('td');

            id.innerText = user.id;
            username.innerText = user.username;
            estado.innerText = user.estado == true ? 'Activado' : 'Desactivado';
            acciones.innerHTML = `
            <button onclick="ver(${user.id})">Ver</button>
            <button onclick="editar(${user.id})">Editar</button>
            `;

            tr.appendChild(id);
            tr.appendChild(username);
            tr.appendChild(estado);
            tr.appendChild(acciones);
            tbody.appendChild(tr);
        })

        tabla.appendChild(thead);
        tabla.appendChild(tbody);
    }

    function nuevoUsuario() {
        document.getElementById('formulario').style.display = 'block';
    }

    function nuevo(){
        const nuevo = {
            id:listaUsuarios.length +1 ,
            username: document.getElementById('inUsername').value,
            nombre: document.getElementById('inNombre').value,
            rol:{
                id: document.getElementById('selRol').selectedOptions[0].value,
                nombre: document.getElementById('selRol').selectedOptions[0].innerText
            },
            estado:false
        };
        listaUsuarios.push(nuevo);
        listar();
        
    }

    function ver(_id){
        console.log(_id);
        const user = listaUsuarios.find(u => u.id == _id);
        const showInfoUsuario = document.getElementById('showInfoUsuario');
        showInfoUsuario.innerHTML= '<h2>Info del Usuario</h2>';
        const tabla = document.createElement('table');
        tabla.innerHTML = `
        <tr> 
            <td>Identificador</td>
            <td>${user.id}</td>
        </tr>
        <tr> 
            <td>Username</td>
            <td>${user.username}</td>
        </tr>
        <tr> 
            <td>Nombre</td>
            <td>${user.nombre}</td>
        </tr>
        <tr> 
            <td>Estado</td>
            <td>${user.estado}</td>
        </tr>
        `;

        showInfoUsuario.appendChild(tabla);
        document.getElementById('formulario').style.display = 'none';
    }

    function editar(_id){
        const user = listaUsuarios.find(u => u.id == _id);
        let indice = listaUsuarios.findIndex(function(user){
            return user.id === _id;
        });

        const showInfoUsuario = document.getElementById('showInfoUsuario');
        showInfoUsuario.innerHTML= '<h2>Info del Usuario</h2>';
        const tabla = document.createElement('table');
        tabla.innerHTML = `
        <tr> 
            <td>Identificador</td>
            <td>${user.id}</td>
        </tr>
        <tr> 
            <td>Username</td>
            <td><input type="text" id="editUsername" placeholder="Ingrese Username" value="${user.username}"></td>
        </tr>
        <tr> 
            <td>Nombre</td>
            <td><input type="text" id="editNombre" placeholder="Ingrese Nombre" value="${user.nombre}"></td>
        </tr>
        <tr> 
            <td>Estado</td>
            <td>${user.estado}</td>
        </tr>
        <tr>
            <td><button onClick="guardarCambio(${indice})";>Guardar</button></td>
            <p>${indice}</p>
        </tr>
        `;

        showInfoUsuario.appendChild(tabla);
    }

    function guardarCambio(indice){
        const userName = document.getElementById("editUsername").value;
        const nombreUsuario = document.getElementById("editNombre").value;
        listaUsuarios[indice].username = userName;
        listaUsuarios[indice].nombre = nombreUsuario;
        alert("Usuario editado con exito!");
        listar();
        ver(listaUsuarios[indice].id);
    };
</script>



</html>

