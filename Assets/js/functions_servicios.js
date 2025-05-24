if (typeof jQuery == 'undefined') {
    throw new Error('jQuery no está cargado');
}

let tableServicios;
let rowTable = "";

// Formatear fecha
function formatDate(dateString) {
    if(!dateString) return '--';
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleDateString('es-ES', options);
}

// Formatear botones
function formatButtons(id) {
    let buttons = '';
    
    if($_SESSION['permisosMod']['u']) {
        buttons += `<button class="btn btn-info btn-sm" onclick="openModalMovimientos(${id})" title="Movimientos">
                        <i class="fas fa-history"></i>
                    </button>
                    <button class="btn btn-secondary btn-sm" onclick="openModalFotos(${id})" title="Fotos">
                        <i class="fas fa-camera"></i>
                    </button>`;
    }
    
    if($_SESSION['permisosMod']['u']) {
        buttons += `<button class="btn btn-primary btn-sm" onclick="fntEditServicio(${id})" title="Editar">
                        <i class="fas fa-pencil-alt"></i>
                    </button>`;
    }
    
    if($_SESSION['permisosMod']['d']) {
        buttons += `<button class="btn btn-danger btn-sm" onclick="fntDelServicio(${id})" title="Eliminar">
                        <i class="far fa-trash-alt"></i>
                    </button>`;
    }
    
    return buttons;
}

// Inicializar DataTable
function initTable() {
    tableServicios = $('#tableServicios').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        },
        "ajax": {
            "url": base_url + "/ServicioTecnico/getServicios",
            "dataSrc": ""
        },
        "columns": [
            {"data": "idservicio"},
            {"data": "num_serie"},
            {"data": "descripcion"},
            {"data": "cliente"},
            {
                "data": "estado",
                "render": function(data, type, row) {
                    return `<span class="badge badge-pill" style="background-color:${row.color}">${data}</span>`;
                }
            },
            {
                "data": "fecha_entrada",
                "render": function(data) {
                    return formatDate(data);
                }
            },
            {
                "data": "fecha_salida",
                "render": function(data) {
                    return formatDate(data);
                }
            },
            {
                "data": "options",
                "render": function(data, type, row) {
                    return data;
                }
            }
        ],
        "columnDefs": [
            {"className": "text-center", "targets": [0,4,5,6]},
            {"orderable": false, "targets": [7]}
        ],
        "dom": '<"row"<"col-md-6"l><"col-md-6"f>><"row"<"col-md-12"B>>rtip',
        "buttons": [
            {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success",
                "exportOptions": {
                    "columns": [0,1,2,3,4,5,6]
                }
            },
            {
                text: '<i class="fas fa-filter"></i> Filtros',
                className: 'btn btn-info',
                action: function ( e, dt, node, config ) {
                    showEstadoFilters();
                }
            },
            {
                text: '<i class="fas fa-sync-alt"></i> Recargar',
                className: 'btn btn-secondary',
                action: function ( e, dt, node, config ) {
                    tableServicios.ajax.reload();
                }
            }
        ],
        "responsive": true,
        "bDestroy": true,
        "iDisplayLength": 10,
        "order": [[5, "desc"]]
    });
}

// Mostrar filtros por estado
function showEstadoFilters() {
    $.get(base_url + '/ServicioTecnico/getEstados', function(response) {
        if(typeof response === 'string') {
            try {
                response = JSON.parse(response);
            } catch(e) {
                console.error("Error parsing JSON:", e);
                return;
            }
        }
        let html = '<div class="btn-group mb-3" role="group">';
        html += '<button type="button" class="btn btn-outline-secondary" onclick="filterByEstado(null)">Todos</button>';
        
        $.each(response, function(index, estado) {
            html += `<button type="button" class="btn btn-outline-secondary" 
                     onclick="filterByEstado(${estado.idestado})" 
                     style="border-left-color:${estado.color}; color:${estado.color}">
                     ${estado.nombre}</button>`;
        });
        
        html += '</div>';
        
        Swal.fire({
            title: 'Filtrar por Estado',
            html: html,
            showConfirmButton: false,
            showCloseButton: true
        });
    });
}

// Filtrar por estado
function filterByEstado(idEstado) {
    tableServicios.ajax.url(base_url + '/ServicioTecnico/getServiciosByEstado/' + (idEstado || 'all')).load();
    Swal.close();
}

// Función para abrir modal de servicio
function openModal() {
    $('#formServicio')[0].reset();
    $('#idServicio').val(0);
    clearErrors('#formServicio');
    $('#modalServicios').modal('show');
}

// Función para limpiar errores
function clearErrors(formSelector) {
    $(formSelector).find('.is-invalid').removeClass('is-invalid');
    $(formSelector).find('.invalid-feedback').remove();
}

// Mostrar error en campo
function showError(element, message) {
    const $element = $(element);
    $element.addClass('is-invalid');
    let errorElement = $element.next('.invalid-feedback');
    
    if (errorElement.length === 0) {
        errorElement = $('<span class="invalid-feedback"></span>');
        $element.after(errorElement);
    }
    
    errorElement.text(message);
}

// Validar formulario de servicio
function validateServicioForm() {
    let isValid = true;
    clearErrors('#formServicio');
    
    // Validar cliente
    if ($('#listCliente').val() === '') {
        showError($('#listCliente'), 'Seleccione un cliente');
        isValid = false;
    }
    
    // Validar número de serie
    const numSerie = $('#txtNumSerie').val().trim();
    if (numSerie === '') {
        showError($('#txtNumSerie'), 'Ingrese un número de serie');
        isValid = false;
    } else if (numSerie.length < 3) {
        showError($('#txtNumSerie'), 'El número de serie debe tener al menos 3 caracteres');
        isValid = false;
    }
    
    // Validar descripción
    const descripcion = $('#txtDescripcion').val().trim();
    if (descripcion === '') {
        showError($('#txtDescripcion'), 'Ingrese una descripción');
        isValid = false;
    } else if (descripcion.length < 10) {
        showError($('#txtDescripcion'), 'La descripción debe tener al menos 10 caracteres');
        isValid = false;
    }
    
    // Validar estado
    if ($('#listEstado').val() === '') {
        showError($('#listEstado'), 'Seleccione un estado');
        isValid = false;
    }
    
    return isValid;
}

// Función para guardar/editar servicio
function fntSaveServicio(e) {
    e.preventDefault();
    
    if (!validateServicioForm()) {
        return false;
    }
    
    var formData = new FormData($('#formServicio')[0]);
    
    $.ajax({
        url: base_url + "/ServicioTecnico/setServicio",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if(typeof response === 'string') {
            try {
                response = JSON.parse(response);
            } catch(e) {
                console.error("Error parsing JSON:", e);
                return;
            }
        }
            if(response.status === true) {
                $('#modalServicios').modal('hide');
                swal({
                    title: "Servicio Técnico",
                    text: response.msg,
                    type: "success",
                    confirmButtonText: "Aceptar"
                });
                tableServicios.ajax.reload();
            } else {
                swal({
                    title: "Error Aqui",
                    text: response.msg,
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
            }
        },
        error: function() {
            swal({
                title: "Error",
                text: "Ocurrió un error al procesar la solicitud",
                type: "error",
                confirmButtonText: "Aceptar"
            });
        }
    });
}

// Función para editar servicio
function fntEditServicio(id) {
    $.get(base_url + '/ServicioTecnico/getServicio/'+id, function(response) {
        if(typeof response === 'string') {
            try {
                response = JSON.parse(response);
            } catch(e) {
                console.error("Error parsing JSON:", e);
                return;
            }
        if(response.status) {
            $('#idServicio').val(response.data.idservicio);
            $('#txtNumSerie').val(response.data.num_serie);
            $('#txtDescripcion').val(response.data.descripcion);
            $('#listCliente').val(response.data.idcliente);
            $('#listEstado').val(response.data.idestado);
            $('#txtDiagnostico').val(response.data.diagnostico);
            $('#txtObservaciones').val(response.data.observaciones);
            
            $('#modalServicios').modal('show');
        }
    }});
}

// Función para eliminar servicio
function fntDelServicio(id) {
    swal({
        title: "Eliminar Servicio",
        text: "¿Está seguro de eliminar este servicio?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            $.post(base_url + '/ServicioTecnico/delServicio', {idServicio: id}, function(response) {
                if(response.status) {
                    swal("Eliminado!", response.msg, "success");
                    tableServicios.ajax.reload();
                } else {
                    swal("Error!", response.msg, "error");
                }
            });
        }
    });
}

// Funciones para movimientos
function openModalMovimientos(id) {
    $('#idServicioMov').val(id);
    $('#formMovimiento')[0].reset();
    clearErrors('#formMovimiento');
    $('#modalMovimientos').modal('show');
    loadMovimientos(id);
}

function loadMovimientos(id) {
    $.get(base_url + '/ServicioTecnico/getServicio/'+id, function(response) {
        if(response.status) {
            let html = '<h5>Historial de Movimientos</h5>';
            if(response.data.movimientos.length > 0) {
                html += '<div class="table-responsive"><table class="table table-sm table-striped">';
                html += '<thead><tr><th>Fecha</th><th>Técnico</th><th>Estado Anterior</th><th>Estado Nuevo</th><th>Descripción</th></tr></thead><tbody>';
                
                $.each(response.data.movimientos, function(index, movimiento) {
                    html += `<tr>
                        <td>${formatDate(movimiento.fecha)}</td>
                        <td>${movimiento.tecnico}</td>
                        <td>${movimiento.estado_anterior || '-'}</td>
                        <td>${movimiento.estado_nuevo}</td>
                        <td>${movimiento.descripcion}</td>
                    </tr>`;
                });
                
                html += '</tbody></table></div>';
            } else {
                html += '<div class="alert alert-info">No hay movimientos registrados.</div>';
            }
            $('#containerMovimientos').html(html);
        }
    });
}

// Validar formulario de movimientos
function validateMovimientoForm() {
    let isValid = true;
    clearErrors('#formMovimiento');
    
    // Validar estado nuevo
    if ($('#listEstadoNuevo').val() === '') {
        showError($('#listEstadoNuevo'), 'Seleccione un estado');
        isValid = false;
    }
    
    // Validar descripción
    const descripcion = $('#txtDescMovimiento').val().trim();
    if (descripcion === '') {
        showError($('#txtDescMovimiento'), 'Ingrese una descripción');
        isValid = false;
    } else if (descripcion.length < 10) {
        showError($('#txtDescMovimiento'), 'La descripción debe tener al menos 10 caracteres');
        isValid = false;
    }
    
    return isValid;
}

// Guardar movimiento
function saveMovimiento(e) {
    e.preventDefault();
    
    if (!validateMovimientoForm()) {
        return false;
    }
    
    $.post(base_url + '/ServicioTecnico/setMovimiento', $('#formMovimiento').serialize(), function(response) {
         if(typeof response === 'string') {
            try {
                response = JSON.parse(response);
            } catch(e) {
                console.error("Error parsing JSON:", e);
                return;
            }
        if(response.status) {
            $('#formMovimiento')[0].reset();
            swal("Movimiento", response.msg, "success");
            loadMovimientos($('#idServicioMov').val());
            tableServicios.ajax.reload(); // Actualizar tabla principal
        } else {
            swal("Error", response.msg, "error");
        }
    }});
}

// Funciones para fotos
function openModalFotos(id) {
    $('#idServicioFoto').val(id);
    $('#formFoto')[0].reset();
    clearErrors('#formFoto');
    $('#modalFotos').modal('show');
    loadFotos(id);
}

function loadFotos(id) {
    $.get(base_url + '/ServicioTecnico/getServicio/'+id, function(response) {
         if(typeof response === 'string') {
            try {
                response = JSON.parse(response);
            } catch(e) {
                console.error("Error parsing JSON:", e);
                return;
            }
        if(response.status) {
            console.log('aqui');
            let html = '<div class="row mx-3">';
            if(response.data.fotos.length > 0) {
                $.each(response.data.fotos, function(index, foto) {
                    html += `<div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="${base_url}/${foto.ruta}" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text small">${foto.descripcion || 'Sin descripción'}</p>
                                <button class="btn btn-danger btn-sm" onclick="delFoto(${foto.idfoto})">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </div>
                        </div>
                    </div>`;
                });
            } else {
                console.log('alla');
                html += '<div class="col-12"><div class="alert alert-info">No hay fotos registradas.</div></div>';
            }
            html += '</div>';
            $('#containerFotos').html(html);
        }
    }});
}

// Validar formulario de fotos
function validateFotoForm() {
    let isValid = true;
    clearErrors('#formFoto');
    
    // Validar archivo
    const fileInput = $('#foto')[0];
    if (fileInput.files.length === 0) {
        showError($('#foto'), 'Seleccione una foto');
        isValid = false;
    }
    
    return isValid;
}

// Guardar foto
function saveFoto(e) {
    e.preventDefault();
    
    if (!validateFotoForm()) {
        return false;
    }
    
    var formData = new FormData($('#formFoto')[0]);
    
    $.ajax({
        url: base_url + '/ServicioTecnico/setFoto',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
             if(typeof response === 'string') {
            try {
                response = JSON.parse(response);
            } catch(e) {
                console.error("Error parsing JSON:", e);
                return;
            }}
            if(response.status) {
                console.log(response);
                $('#formFoto')[0].reset();
                swal("Foto", response.msg, "success");
                loadFotos($('#idServicioFoto').val());
            } else {
                swal("Error", response.msg, "error");
            }
        }
    });
}

function delFoto(idFoto) {
    swal({
        title: "Eliminar Foto",
        text: "¿Está seguro de eliminar esta foto?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "No, cancelar",
        closeOnConfirm: false,
        closeOnCancel: true
    }, function(isConfirm) {
        if (isConfirm) {
            $.post(base_url + '/ServicioTecnico/delFoto', {idFoto: idFoto}, function(response) {
                if(response.status) {
                    swal("Eliminado!", response.msg, "success");
                    loadFotos($('#idServicioFoto').val());
                } else {
                    swal("Error!", response.msg, "error");
                }
            });
        }
    });
}

// Inicialización
$(document).ready(function() {
    initTable();
    
    // Manejar envío del formulario de servicio
    $('#formServicio').on('submit', function(e) {
        fntSaveServicio(e);
    });
    
    // Manejar envío del formulario de movimientos
    $('#formMovimiento').on('submit', function(e) {
        saveMovimiento(e);
    });
    
    // Manejar envío del formulario de fotos
    $('#formFoto').on('submit', function(e) {
        saveFoto(e);
    });
});