let tableServicios;
let rowTable = "";

$(document).ready(function() {
    // Evitar problemas con TinyMCE
    $(document).on('focusin', function(e) {
        if ($(e.target).closest('.tox-dialog').length) {
            e.stopImmediatePropagation();
        }
    });
    
    // Inicializar DataTable
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
            {"data": "estado"},
            {"data": "fecha_entrada"},
            {"data": "fecha_salida"},
            {"data": "options"}
        ],
        "columnDefs": [
            {"className": "text-center", "targets": [0,4,5,6]},
            {"orderable": false, "targets": [7]}
        ],
        "dom": 'lBfrtip',
        "buttons": [
            {
                "extend": "excelHtml5",
                "text": "<i class='fas fa-file-excel'></i> Excel",
                "titleAttr": "Exportar a Excel",
                "className": "btn btn-success",
                "exportOptions": {
                    "columns": [0,1,2,3,4,5,6]
                }
            }
        ],
        "resonsieve": "true",
        "bDestroy": true,
        "iDisplayLength": 10
    });
});

// Función para abrir modal
function openModal() {
    $('#formServicio')[0].reset();
    $('#modalServicios').modal('show');
}

// Función para guardar/editar servicio
function fntSaveServicio() {
    if($('#formServicio').valid()) {
        var formData = new FormData($('#formServicio')[0]);
        $.ajax({
            url: base_url + "/ServicioTecnico/setServicio",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status) {
                    $('#modalServicios').modal('hide');
                    swal("Servicio Técnico", response.msg, "success");
                    tableServicios.ajax.reload();
                } else {
                    swal("Error", response.msg, "error");
                }
            }
        });
    }
}

// Función para editar servicio
function fntEditServicio(id) {
    $.get(base_url + '/ServicioTecnico/getServicio/'+id, function(response) {
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
    });
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
function openModalMovimientos(id) {
    $('#idServicioMov').val(id);
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

// Funciones para fotos
function openModalFotos(id) {
    $('#idServicioFoto').val(id);
    $('#modalFotos').modal('show');
    loadFotos(id);
}

function loadFotos(id) {
    $.get(base_url + '/ServicioTecnico/getServicio/'+id, function(response) {
        if(response.status) {
            let html = '';
            if(response.data.fotos.length > 0) {
                $.each(response.data.fotos, function(index, foto) {
                    html += `<div class="col-md-4 mb-3">
                        <div class="card">
                            <img src="${base_url}/${foto.ruta}" class="card-img-top" style="height: 150px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text small">${foto.descripcion || 'Sin descripción'}</p>
                                <button class="btn btn-danger btn-sm" onclick="delFoto(${foto.idfoto}, '${foto.ruta}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>`;
                });
            } else {
                html = '<div class="col-12"><div class="alert alert-info">No hay fotos registradas.</div></div>';
            }
            $('#containerFotos').html(html);
        }
    });
}

function delFoto(idFoto, ruta) {
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

// Formatear fecha
function formatDate(dateString) {
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return new Date(dateString).toLocaleDateString('es-ES', options);
}

// Eventos
$(document).ready(function() {
    // ... (código existente)
    
    // Formulario de movimientos
    $('#formMovimiento').validate({
        submitHandler: function(form) {
            $.post(base_url + '/ServicioTecnico/setMovimiento', $(form).serialize(), function(response) {
                if(response.status) {
                    $('#formMovimiento')[0].reset();
                    swal("Movimiento", response.msg, "success");
                    loadMovimientos($('#idServicioMov').val());
                    tableServicios.ajax.reload(); // Actualizar tabla principal
                } else {
                    swal("Error", response.msg, "error");
                }
            });
        }
    });
    
    // Formulario de fotos
    $('#formFoto').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
            url: base_url + '/ServicioTecnico/setFoto',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if(response.status) {
                    $('#formFoto')[0].reset();
                    swal("Foto", response.msg, "success");
                    loadFotos($('#idServicioFoto').val());
                } else {
                    swal("Error", response.msg, "error");
                }
            }
        });
    });
});

// Actualizar botones en DataTable
function formatButtons(id) {
    return `<button class="btn btn-info btn-sm" onclick="openModalMovimientos(${id})" title="Movimientos">
                <i class="fas fa-history"></i>
            </button>
            <button class="btn btn-secondary btn-sm" onclick="openModalFotos(${id})" title="Fotos">
                <i class="fas fa-camera"></i>
            </button>
            <button class="btn btn-primary btn-sm" onclick="fntEditServicio(${id})" title="Editar">
                <i class="fas fa-pencil-alt"></i>
            </button>
            <button class="btn btn-danger btn-sm" onclick="fntDelServicio(${id})" title="Eliminar">
                <i class="far fa-trash-alt"></i>
            </button>`;
}