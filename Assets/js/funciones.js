let tblUsuarios, tblClientes, tblHorarios, tblPlanes, t_historial_c;
document.addEventListener("DOMContentLoaded", function() {
    tblUsuarios = $('#tblUsuarios').DataTable({
        ajax: {
            url: base_url + 'Usuarios/listar',
            dataSrc: ''
        },
        columns: [
            {"data": "usuario_id"},
            {"data": "usuario"},
            {"data": "pass"},
            {"data": "nombre"},
            {"data": "role"},
            {"data": "estado"},
            {"data": "acciones"}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',
                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de usuarios',
                filename: 'Reporte de usuarios',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de usuarios',
                    filename: 'Reporte de usuarios',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    }); // fin tabla usuarios

    tblPlanes = $('#tblPlanes').DataTable({
        ajax: {
            url: base_url + "Planes/listar",
            dataSrc: ''
        },
        columns: [
            {'data': 'plan_id'},
            {'data': 'plan'},
            {'data': 'precio'},
            {'data': 'estado'},
            {'data': 'obs'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',
                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de planes',
                filename: 'Reporte de planes',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de planes',
                    filename: 'Reporte de planes',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    }); // fin tabla planes

    tblClientes = $('#tblClientes').DataTable({
        ajax: {
            url: base_url + "Clientes/listar",
            dataSrc: ''
        },
        columns: [
            {'data': 'atleta_id'},
            {'data': 'ci'},
            {'data': 'nombre'},
            {'data': 'direccion'},
            {'data': 'email'},
            {'data': 'celular'},
            {'data': 'estado'},
            {'data': 'fecha_ingreso'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',
                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Reporte de clientes',
                filename: 'Reporte de clientes',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Reporte de clientes',
                    filename: 'Reporte de clientes',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    }); // fin tabla clientes

    tblHistorialCompra = $('#t_historial_c').DataTable({
        ajax: {
            url: base_url + "Compras/listarHistorial",
            dataSrc: ''
        },
        columns: [
            {'data': 'compra_id'},
            {'data': 'total'},
            {'data': 'fecha'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',
                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Historial de compras',
                filename: 'Historial de compras',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Historial de compras',
                filename: 'Historial de compras',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    }); // fin tabla historial compras

    tblHorarios = $("#tblHorarios").DataTable({
        ajax: {
            url: base_url + "Horarios/listar",
            dataSrc: ''
        },
        columns: [
            {'data': 'horarios_id'},
            {'data': 'plan'},
            {'data': 'hinicio'},
            {'data': 'hfin'},
            {'data': 'estado'},
            {'data': 'acciones'}
        ]
    });

    $('#t_historial_a').DataTable({
        ajax: {
            url: base_url + "Asistencias/listarHistorial",
            dataSrc: ''
        },
        columns: [
            {'data': 'asistencias_id'},
            {'data': 'nombre'},
            {'data': 'fecha'},
            {'data': 'acciones'}
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        language: {
            "url": "//cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
        },
        dom: "<'row'<'col-sm-4'l><'col-sm-4 text-center'B><'col-sm-4'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        buttons: [
            {
                //Botón para Excel
                extend: 'excelHtml5',
                footer: true,
                title: 'Archivo',
                filename: 'Export_File',
                //Aquí es donde generas el botón personalizado
                text: '<span class="badge badge-success"><i class="fas fa-file-excel"></i></span>'
            },
            //Botón para PDF
            {
                extend: 'pdfHtml5',
                download: 'open',
                footer: true,
                title: 'Historial de compras',
                filename: 'Historial de compras',
                text: '<span class="badge  badge-danger"><i class="fas fa-file-pdf"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para copiar
            {
                extend: 'copyHtml5',
                footer: true,
                title: 'Historial de compras',
                filename: 'Historial de compras',
                text: '<span class="badge  badge-primary"><i class="fas fa-copy"></i></span>',
                exportOptions: {
                    columns: [0, ':visible']
                }
            },
            //Botón para print
            {
                extend: 'print',
                footer: true,
                filename: 'Export_File_print',
                text: '<span class="badge badge-light"><i class="fas fa-print"></i></span>'
            },
            //Botón para cvs
            {
                extend: 'csvHtml5',
                footer: true,
                filename: 'Export_File_csv',
                text: '<span class="badge  badge-success"><i class="fas fa-file-csv"></i></span>'
            },
            {
                extend: 'colvis',
                text: '<span class="badge  badge-info"><i class="fas fa-columns"></i></span>',
                postfixButtons: ['colvisRestore']
            }
        ]
    });
});



// =================== INICIA MODULO USUARIOS ====================
function frmUsuario() {
    document.getElementById("title").innerHTML = "Nuevo Usuario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("claves").classList.remove("d-none");
    document.getElementById("frmUsuario").reset();
    document.getElementById("usuario_id").value = "";
    $("#nuevo_usuario").modal("show");
}
function registrarUser(e) {
    e.preventDefault();
    const usuario = document.getElementById("usuario");
    const nombre = document.getElementById("nombre");
    const estado = document.getElementById("estado");
    const rol = document.getElementById("role");
    
    if(usuario.value == "" || nombre.value =="" || role.value=="" || estado.value=="") {
        alertas('Todos los campos son obligatorios.', 'warning');
        clave.classList.remove("is-invalid");
        usuario.classList.add("is-invalid");
        usuario.focus();
    } else {
        const url = base_url + "Usuarios/registrar";
        const frm = document.getElementById("frmUsuario");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                $("#nuevo_usuario").modal("hide");
                alertas(res.msg, res.icono); 
                tblUsuarios.ajax.reload();
            }
        }
    }
}
function btnEditarUser(usuario_id) {
    document.getElementById("title").innerHTML = "Actualizar Usuario";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Usuarios/editar/"+usuario_id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.getElementById("usuario_id").value = res.usuario_id;
            document.getElementById("usuario").value = res.usuario;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("estado").value = res.estado;
            document.getElementById("role").value = res.role;
            document.getElementById("claves").classList.add("d-none");
            $("#nuevo_usuario").modal("show");
        }
    }
    
}
function btnEliminarUser(usuario_id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El usuario no se eliminara de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/eliminar/" + usuario_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    //console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblUsuarios.ajax.reload();
                }
            }
            
        }
    })
}
function btnReingresarUser(usuario_id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Usuarios/reingresar/" + usuario_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    //console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    tblUsuarios.ajax.reload();
                    alertas(res.msg, res.icono);
                }
            }
            
        }
    })
}
function frmCambiarPass(e) {
    e.preventDefault();
    const actual = document.getElementById('clave_actual').value;
    const nueva = document.getElementById('clave_nueva').value;
    const confirmar = document.getElementById('confirmar_clave').value;
    if( actual == '' || nueva == '' || confirmar == '') {
        alertas('Todos los campos son obligatorios.', 'warning');
    } else {
        if(nueva != confirmar) {
            alertas('Las contraseñas no coinciden.', 'warning');
        } else {
            const url = base_url + "Usuarios/cambiarPass";
            const frm = document.getElementById("frmCambiarPass");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono); 
                    $("#cambiarPass").modal("hide");
                    frm.reset();
                }
            }
        }
    }

}
//=================== FINAL MODULO USUARIORS ====================

// =================== INICIA MODULO CLIENTES "ATLETAS" ====================
function frmClientes() {
    document.getElementById("title").innerHTML = "Nuevo Cliente";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    //document.getElementById("frmClientes").reset();
    document.getElementById("atleta_id").value = "";
    $("#nuevo_cliente").modal("show");
}

function registrarCliente(e) {
    e.preventDefault();
    const ci = document.getElementById("ci");
    const nombre = document.getElementById("nombre");
    const direccion = document.getElementById("direccion");
    const email = document.getElementById("email");
    const celular = document.getElementById("celular");
    const estado = document.getElementById("estado");
    const fecha_ingreso = document.getElementById("fecha_ingreso");
    const plan = document.getElementById("plan");
    
    if(ci.value == "" || nombre.value =="" || direccion.value=="" || email.value=="" || celular == "") {
        alertas('Todos los campos son necesarios.','error');
        ci.focus();
    } else {
        const url = base_url + "Clientes/registrar";
        const frm = document.getElementById("frmCliente");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    alertas('Cliente registrado con éxito.','success');
                    frm.reset();
                    $("#nuevo_cliente").modal("hide");
                    tblClientes.ajax.reload();
                }
                else if (res == "modificado") {
                    alertas('Cliente modificado con éxito.','success');
                    $("#nuevo_cliente").modal("hide");
                    tblClientes.ajax.reload();
                } else {
                    alertas(res.msg, res.icono);
                }
            }
        }
    }
}

function btnEditarCliente(atleta_id) {
    document.getElementById("title").innerHTML = "Actualizar Cliente";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Clientes/editar/"+atleta_id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.getElementById("atleta_id").value = res.atleta_id;
            document.getElementById("ci").value = res.ci;
            document.getElementById("nombre").value = res.nombre;
            document.getElementById("direccion").value = res.direccion;
            document.getElementById("email").value = res.email;
            document.getElementById("celular").value = res.celular;
            document.getElementById("estado").value = res.estado;
            document.getElementById("fecha_ingreso").value = res.fecha_ingreso;
            $("#nuevo_cliente").modal("show");
        }
    }
    
}

function btnEliminarCliente(atleta_id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El cliente no se eliminara de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/eliminar/" + atleta_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if(res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'Cliente eliminado con éxito.',
                            'success'
                        )
                        tblClientes.ajax.reload();
                    }
                    else {
                        Swal.fire(
                            'Error al eliminar cliente!',
                            res,
                            'error'
                        )
                    }
                    // alertas(res.msg, res.icono);
                    // tblUsuarios.ajax.reload();
                }
            }
            
        }
    })
}

function btnReingresarCliente(usuario_id) {
    Swal.fire({
        title: 'Esta seguro de reingresar?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Clientes/reingresar/" + usuario_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if(res == "ok") {
                        Swal.fire(
                            'Mensaje!',
                            'Cliente reingresado con éxito.',
                            'success'
                        )
                        tblClientes.ajax.reload();
                    }
                    else {
                        Swal.fire(
                            'Error al reingresar cliente',
                            res,
                            'error'
                        )
                    }
                    // alertas(res.msg, res.icono);
                    // tblUsuarios.ajax.reload();
                }
            }
            
        }
    })
}
// FINAL MODULO CLIENTE

// =================== INICIA MODULO PLANES ====================
function frmPlanes() {
    document.getElementById("title").innerHTML = "Nuevo Plan";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmPlanes").reset();
    document.getElementById("plan_id").value = "";
    $("#nuevo_plan").modal("show");
}

function registrarPlan(e) {
    e.preventDefault();
    const plan = document.getElementById("plan");
    const precio = document.getElementById("precio");
    const estado = document.getElementById("estado");
    const obs  = document.getElementById("obs");

    if(plan.value == "" || precio.value =="" || estado.value=="" ) {
        alertas('Todos los campos son necesarios', 'error');
        plan.classList.add("is-invalid");
        plan.focus();
    } else {
        const url = base_url + "Planes/registrar";
        const frm = document.getElementById("frmPlanes");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res == "si") {
                    alertas('Plan registrado con éxito', 'success');
                    frm.reset();
                    $("#nuevo_plan").modal("hide");
                    tblPlanes.ajax.reload();
                }
                else if (res == "modificado") {
                    alertas('El plan ha sido modificado con éxito','success');
                    $("#nuevo_plan").modal("hide");
                    tblPlanes.ajax.reload();
                } else {
                    alertas(res.msg, res.icono);
                }
            }
        }
    }
}

function btnEditarPlan(plan_id) {
    document.getElementById("title").innerHTML = "Actualizar Plan";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Planes/editar/" + plan_id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            console.log(res);
            document.getElementById("plan_id").value = res.plan_id;
            document.getElementById("plan").value = res.plan;
            //document.getElementById("precio").value = res.precio;
            document.getElementById("estado").value = res.estado;
            document.getElementById("obs").value = res.obs;
            document.getElementById("precio").classList.add("d-none");
            $("#nuevo_plan").modal("show");
        }
    }
    
}

function btnEliminarPlan(plan_id) {
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El usuario no se eliminara de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Planes/eliminar/" + plan_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if(res == "ok") {
                        alertas('Usuario eliminado con éxito.', 'success');
                        tblPlanes.ajax.reload();
                    }
                    else {
                        alertas('No se ha eliminado al usuario.', 'error');
                    }
                    // alertas(res.msg, res.icono);
                    // tblUsuarios.ajax.reload();
                }
            }
            
        }
    })
}

function btnReingresarPlan(plan_id) {
    Swal.fire({
        title: 'Esta seguro de reingresar el plan?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Planes/reingresar/" + plan_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if(res == "ok") {
                        alertas('Plan reingresado con éxito.', 'success');
                        tblPlanes.ajax.reload();
                    }
                    else {
                        alertas('Error al activar plan.', 'error');
                    }
                    // alertas(res.msg, res.icono);
                    // tblUsuarios.ajax.reload();
                }
            }
            
        }
    })
}
//=================== FINAL MODULO PLANES ====================

// =================== INICIA MODULO COMPRAS ====================
function buscarPlan(e) {
    e.preventDefault();
    const plan = document.getElementById("plan").value;
    const url = base_url + "Compras/buscarPlan/" + plan;
    const url2 = base_url + "Compras/buscarHorario/" + plan;
    const http = new XMLHttpRequest();
    const http2 = new XMLHttpRequest();
    http.open("GET", url, true);
    http2.open("GET", url2, true);
    http.send();
    http2.send();
    http.onreadystatechange = function () {
        if( this.readyState == 4 && this.status== 200 ) {
            //console.log(this.responseText);
            //devuelve los elementos de la consulta a planes de un id determinado
            const res = JSON.parse(this.responseText); 
            if(res) {
                document.getElementById("id").value = res.plan_id;
                document.getElementById("precio").value = res.precio;
                document.getElementById("obs").value = res.obs;
                document.getElementById("horarios").focus();
            }
            else {
                alertas('El plan no existe', 'warning');
                document.getElementById("cantidad").value = '';
                document.getElementById("plan").focus();
            }
        }
    }
    http2.onreadystatechange = function () {
        if( this.readyState == 4 && this.status== 200 ) {
            //console.log(this.responseText);
            const res2 = JSON.parse(this.responseText); 
            let html = '';
            res2.forEach(row => {
                html += `
                    <option name="horarios_id" value="${row['horarios_id']}">${row['hinicio']} - ${row['hfin']}</option>
                `;
            });
            document.getElementById("horarios").innerHTML = html;
            document.getElementById("hinicio").value = res2.hinicio;
            document.getElementById("hfin").value = res2.hfin;
            document.getElementById("id_h").value = res2.horarios_id;
        }
    }
}

function buscarCliente(e) {
    e.preventDefault();
    const atleta_id = document.getElementById("atleta_id").value;
    const url = base_url + "Compras/buscarCliente/" + atleta_id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if( this.readyState == 4 && this.status== 200 ) {
            //console.log(this.responseText);
            //devuelve los elementos de la consulta a planes de un id determinado
            const res = JSON.parse(this.responseText); 
            if(res) {
                document.getElementById("id_a").value = res.atleta_id;
                //document.getElementById("nombre").value = res.nombre;
                document.getElementById("plan").focus();
            }
            else {
                alertas('Datos erroneos', 'error');
                document.getElementById("cantidad").value = '';
                document.getElementById("plan").focus();
            }
        }
    }
}

function calcularPrecio(e) {
    e.preventDefault();
    const cant = document.getElementById("cantidad").value;
    const precio = document.getElementById("precio").value;
    var sub_total = parseFloat(precio)*parseFloat(cant);
    document.getElementById("sub_total").value = sub_total;
    if( e.which == 13) {
        if (cant > 0) {
            const url = base_url + "Compras/ingresar";
            const frm = document.getElementById("frmCompra");
            const http = new XMLHttpRequest();
            http.open("POST", url, true);
            http.send(new FormData(frm));
            http.onreadystatechange = function () {
                if( this.readyState == 4 && this.status== 200 ) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    frm.reset();
                    cargarDetalle();                
                }
            }
        }
    }
}

if(document.getElementById('tblDetalle')) { cargarDetalle(); }

function cargarDetalle() {
    const url = base_url + "Compras/listar";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if( this.readyState == 4 && this.status== 200 ) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let html = '';
            res.detalle.forEach( row => {
                html += ` <tr>
                    <td>${row['detalle_id']}</td>
                    <td>${row['nombre']}</td>
                    <td>${row['plan']}</td>
                    <td>${row['hinicio']} - ${row['hfin']}</td>
                    <td>${row['cantidad']}</td>
                    <td>${row['precio']}</td>
                    <td>${row['obs']}</td>
                    <td>${row['sub_total']}</td>
                    <td>
                    <button class="btn btn-danger" type="button" onclick="borrarDetalle(${row['detalle_id']})"><i class="fas fa-trash-alt"></i></button>
                    </td>
                </tr>
                `;
            });
            document.getElementById("tblDetalle").innerHTML = html;
            document.getElementById("total").value = res.total_pagar.total;
        }
    }
}

function borrarDetalle(detalle_id) {
    const url = base_url + "Compras/delete/" + detalle_id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if( this.readyState == 4 && this.status== 200 ) {
            //console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if(res == 'ok') {
                alertas('Detalle eliminado.', 'success');
                cargarDetalle();
            } else {
                alertas('Error al eliminar el detalle.', 'warning');
                
            }
        }
    }
}

function generarCompra() {
    Swal.fire({
        title: 'Esta seguro de reingresar la compra?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Compras/registrarCompra";
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if(res.msg == "ok") {
                        alertas();
                        Swal.fire('Compra generada.','success');
                        //tblPlanes.ajax.reload();
                        const ruta = base_url + 'Compras/generarPDF/' + res.compra_id;
                        window.open(ruta);
                        setTimeout(() => {
                            window.location.reload();
                        }, 300);
                    }
                    else {
                        alertas('Mensaje! error en la compra','error');
                    }
                    // alertas(res.msg, res.icono);
                    // tblUsuarios.ajax.reload();
                }
            }
            
        }
    })
}

function btnAnularCompra(compra_id) {
    Swal.fire({
        title: 'Esta seguro de anular la compra?',
        icon: 'warning',
        showCancelButton: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if(result.isConfirmed) {
            url = base_url + "Compras/anularCompra/" + compra_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    alertas(res.msg, res.icono);
                    tblHistorialCompra.ajax.reload();
                }
            }
        }    
    })
}
// ====================== Fin de Compras ========================

// ====================== HORARIOS ===============================

function frmHorarios() {
    document.getElementById("title").innerHTML = "Nuevo Horario";
    document.getElementById("btnAccion").innerHTML = "Registrar";
    document.getElementById("frmHorarios").reset();
    $("#nuevo_horario").modal("show");
}
function buscarPlanH(e) {
    e.preventDefault();
    const plan = document.getElementById("plan").value;
    const url = base_url + "Horarios/buscarPlanH/" + plan;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if( this.readyState == 4 && this.status== 200 ) {
            //console.log(this.responseText);
            //devuelve los elementos de la consulta a planes de un id determinado
            const res = JSON.parse(this.responseText); 
            if(res) {
                document.getElementById("plan_id").value = res.plan_id;
            }
            else {
                alertas('El plan no existe', 'warning');
                
                document.getElementById("plan").focus();
            }
        }
    }
}

function registrarHorario(e){
    e.preventDefault();
    const plan_id = document.getElementById("plan_id");
    const horarioi = document.getElementById("horario_i");
    const horariof = document.getElementById("horario_f");
    const estado = document.getElementById("estado");
    const horarios_id = document.getElementById("horarios_id");
    
    if(horarioi.value == "" || horariof.value =="") {
        alertas('Todos los campos son obligatorios.', 'warning');
    } else {
        const url = base_url + "Horarios/registrar";
        const frm = document.getElementById("frmHorarios");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if(res.msg== "Registro de horario correcto.") {
                    alertas(res.msg, res.icono);
                    frm.reset();
                    $("#nuevo_horario").modal("hide");
                    tblHorarios.ajax.reload();
                }
                else if (res.msg == "Horario modificado con éxito.") {
                    alertas('El horario ha sido modificado con éxito','success');
                    $("#nuevo_horario").modal("hide");
                    tblHorarios.ajax.reload();
                }
                else { 
                    alertas(res.msg, res.icono);
                }
            }
        }
    }
}

function btnEditarHorario(horarios_id) {
    document.getElementById("title").innerHTML = "Actualizar Horario";
    document.getElementById("btnAccion").innerHTML = "Modificar";
    const url = base_url + "Horarios/editar/" + horarios_id;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.getElementById("horarios_id").value = res.horarios_id;
            document.getElementById("plan_id").value.selected = res.plan_id;
            document.getElementById("horario_i").value = res.hinicio;
            document.getElementById("horario_f").value = res.hfin;
            $("#nuevo_horario").modal("show");
        }
    }
}

function btnEliminarHorario(horarios_id) {
    console.log(horarios_id);
    Swal.fire({
        title: 'Esta seguro de eliminar?',
        text: "El horario no se eliminara de forma permanente, solo cambiará el estado a inactivo!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Horarios/eliminar/" + horarios_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if(res == "ok") {
                        alertas('Horario eliminado con éxito.', 'success');
                        tblHorarios.ajax.reload();
                    }
                    else {
                        alertas('Horario no ha sido eliminado.', 'success');
                    }
                    // alertas(res.msg, res.icono);
                    // tblUsuarios.ajax.reload();
                }
            }
            
        }
    })
}

function btnReingresarHorario(horarios_id) {
    Swal.fire({
        title: 'Esta seguro de reingresar el horario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si!',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            const url = base_url + "Horarios/reingresar/" + horarios_id;
            const http = new XMLHttpRequest();
            http.open("GET", url, true);
            http.send();
            http.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    const res = JSON.parse(this.responseText);
                    if(res == "ok") {
                        alertas('Horario reingresado con éxito.','success');
                        tblHorarios.ajax.reload();
                    }
                    else {
                        alertas('Error!.', 'error');
                    }
                    // alertas(res.msg, res.icono);
                    // tblUsuarios.ajax.reload();
                }
            }
            
        }
    })
}

// ====================== FIN DE HORARIOS ========================

// ====================== ASISTENCIAS ========================
function registrarAsistencia(e) {
    e.preventDefault();
    const carnet = document.getElementById("carnet").value;
    //console.log(carnet);

    if(carnet == "") {
        alertas('ingrese un carnet valido', 'error');
    }
    else{
        const url = base_url + "Asistencias/registrar";
        const frm = document.getElementById("frmAsistencia");
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(new FormData(frm));
        http.onreadystatechange = function () {
            if( this.readyState == 4 && this.status== 200 ) {
                console.log(this.responseText);
                res = JSON.parse(this.responseText);
                if(res.msg == 'ok') {
                    alertas(res.msg, res.icono);

                }
                else alertas(res.msg, res.icono);
            }
            else alertas('Error en el registro de asistencia', 'error')
        }
    }
}



// ====================== AUXILIARES =========================

function modificarEmpresa(){
    const frm = document.getElementById("frmEmpresa");
    const url = base_url + "Administracion/modificarEmpresa";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);        
            if(res == "ok") {
                Swal.fire("Mensaje!", "Datos modificados.", "success");
            }
        }
    }
}

function alertas(mensaje, icono) {
    Swal.fire( {
        position: 'top-end',
        icon: icono,
        title: mensaje,
        showConfirmButton: false,
        timer: 3000
    }) 
}
//===================permisos ====================
function registrarPermisos(e) {
    e.preventDefault();
    const frm = document.getElementById("formulario");
    const url = base_url + "Usuarios/registrarPermisos";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(new FormData(frm));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //console.log(this.responseText);
            const res = JSON.parse(this.responseText)
            if(res != '') {
                alertas(res.msg, res.icono);
            } else {
                alertas('Error no identificado', 'error');
            }
            
        }
    }
}


// ==================== GRAFICAS =========================

if(document.getElementById("planesVendidos")) {
    horariosVendidos();
    planesVendidos();
}
function planesVendidos() {
    const url = base_url + "Administracion/graficaPlan";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let nombre = [];
            let cantidad = [];
            for (let index = 0; index < res.length; index++) {
                nombre.push(res[index]['plan']);
                cantidad.push(res[index]['total']);
            }
            var ctx = document.getElementById("planesVendidos");
            var myChart = new Chart( ctx, {
                type: 'pie',
                data: {
                    labels: nombre,
                    datasets: [{
                        data: cantidad,
                        backgroundColor: ['red','green','yellow','blue'],
                    }],
                },
            });
        }
    }
}

function horariosVendidos() {
    const url = base_url + "Administracion/graficaHorarios";
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            let nombre = [];
            let cantidad = [];
            for (let index = 0; index < res.length; index++) {
                hora = res[index]['hinicio'] + '-'+ res[index]['hfin'];
                nombre.push(hora);
                cantidad.push(res[index]['total']);
            }
            var ctx = document.getElementById("horariosVendidos");
            var myChart = new Chart( ctx, {
                type: 'pie',
                data: {
                    labels: nombre,
                    datasets: [{
                        data: cantidad,
                        backgroundColor: ['red','green','yellow','blue'],
                    }],
                },
            });
        }
    }
}


// var ctx = document.getElementById("horariosVendidos");

// var myChart = new Chart( ctx, {
//     type: 'pie',
//     data: {
//         labels: ["red","green", "yellow", "blue"],
//         datasets: [{
//             data: [12,15,11,8],
//             backgroundColor: ['red','green','yellow','blue'],
//         }],
//     },
// });

if(document.getElementById('time')) { generateTime(); }
function generateTime() {
    // Capturamos la hora actual mediante la creación de una nueva instancia del objeto Date
    let timeNow = new Date();
    // Queremos que la hora se muestre siempre con 2 dígitos. Para eso, hacemos lo siguiente:
    // Usamos un ternario para saber si el número de digitos es menor que 2
    let hours = timeNow.getHours().toString().length < 2 ? "0" + timeNow.getHours() : timeNow.getHours();
    let minutes = timeNow.getMinutes().toString().length < 2 ? "0" + timeNow.getMinutes() : timeNow.getMinutes();
    let seconds = timeNow.getSeconds().toString().length < 2 ? "0" + timeNow.getSeconds() : timeNow.getSeconds();

    //  Concatenando variables | Usando ES5 
    // let mainTime = hours + ":" + minutes + ":" + seconds;
     //  Concatenando variables | Usando ES6: Template Strings (Template literals) 
    let mainTime = `${hours}:${minutes}:${seconds}`;
    // Si quiero que el efecto del reloj se vea correctamente, tengo que usar un setInterval de 1000
    // setInterval - ES6 - Javascript Moderno
    setInterval(() => {
        generateTime();
    }, 1000);

    // Escribo la hora en el elemento h1 con id="time"
    document.getElementById("time").innerHTML = mainTime;
};