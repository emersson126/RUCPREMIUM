<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATA CUSTOMERS</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
</head>
<body>
    <header>
    </header>

    <style type="text/css">
        div.container { width: 100%; }
    </style>
    <main>
        <div class="container">
            <table id="example" class="display nowrap" style="width:100%; display: none;">
                <thead>
                    <tr>
                        <th>ID</th> 
                        <th>numeroRuc</th>
                        <th>codDomHabido</th>
                        <th>numTelefono3</th>
                        <th>desRazonSocial</th>
                        <th>codUbigeo</th>
                        <th>desDistrito</th>
                        <th>desProvincia</th>
                        <th>desDepartamento</th>
                        <th>desDireccion</th>
                        <th>desNomApe</th>
                        <th>codCorreo2</th>
                        <th>codCorreo1</th>
                        <th>codEstado</th>
                        <th>nombreComercial</th>
                        <th>actividadEconomica_principal</th>
                        <th>actividadEconomica_secundaria</th>
                        <th>sistemaEmisionElectronica_factura</th>
                        <th>sistemaEmisionElectronica_boleta</th>
                        <th>padrones</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Datos cargados por AJAX se agregarán aquí -->
                </tbody>
            </table>
            <!-- Div para mostrar mensajes de éxito o error -->
            <div id="mensaje"></div>
        </div>
    </main>

    <footer>
    </footer>

    <style type="text/css">
        #example {
            display: none;
        }
    </style>

    <script type="text/javascript">
        var table;

        function cargarTabla() {
            $.ajax({
                type: 'GET',
                url: 'consulta.php',
                dataType: 'json',
                success: function(response) {
                    if ($.fn.DataTable.isDataTable('#example')) {
                        table.destroy();
                    }

                    table = $('#example').DataTable({
                        responsive: true,
                        paging: true,
                        deferRender: true,
                        columns: [
                            { data: 'id' }, 
                            { data: 'numeroRuc' },
                            { data: 'codDomHabido' },
                            { data: 'numTelefono3' },
                            { data: 'desRazonSocial' },
                            { data: 'codUbigeo' },
                            { data: 'desDistrito' },
                            { data: 'desProvincia' },
                            { data: 'desDepartamento' },
                            { data: 'desDireccion' },
                            { data: 'desNomApe' },
                            { data: 'codCorreo2' },
                            { data: 'codCorreo1' },
                            { data: 'codEstado' },
                            { data: 'nombreComercial' },
                            { data: 'actividadEconomica_principal' },
                            { data: 'actividadEconomica_secundaria' },
                            { data: 'sistemaEmisionElectronica_factura' },
                            { data: 'sistemaEmisionElectronica_boleta' },
                            { data: 'padrones' },
                            { 
                                data: null, 
                                render: function (data, type, row) {
                                    return '<button onclick="editarCliente(' + row.id + ')">Editar</button>' +
                                           '<button onclick="eliminarCliente(' + row.id + ')">Eliminar</button>';
                                }
                            }
                        ]
                    });
                    table.rows.add(response).draw();

                    // Mostrar la tabla después de cargar los datos
                    $('#example').show();
                },
                error: function(error) {
                    console.error('Error al cargar la tabla:', error);
                }
            });
        }

        function editarCliente(id) {
            // Redirigir a la página de edición con el ID del cliente
            window.location.href = 'editar_cliente.php?id=' + id;
        }

        function eliminarCliente(id) {
            // Implementa la lógica para eliminar el cliente con el ID proporcionado
            // Puedes mostrar un mensaje de confirmación, hacer una solicitud AJAX, etc.
            console.log('Eliminar cliente con ID:', id);

            // Ejemplo de cómo mostrar un mensaje en el div de mensajes
            $('#mensaje').text('Cliente eliminado con éxito.');
        }

        $(document).ready(function() {
            cargarTabla();
        });
    </script>

</body>
</html>
