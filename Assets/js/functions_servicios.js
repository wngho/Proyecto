let tableServicios;
let rowTable = "";

tableServicios = $('#tableServicios').dataTable( {
    "aProcessing":true,
    "aServerSide":true,
    "language": {
        "url": " "+base_url + "/Assets/js/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"/ServicioTecnico/getServicios",
        "dataSrc":""
    },
    "columns":[
        {"data":"idservicio"},
        {"data":"num_serie"},
        {"data":"descripcion"},
        {"data":"cliente"},
        {"data":"estado"},
        {"data":"fecha_entrada"},
        {"data":"fecha_salida"},
        {"data":"options"}
    ],
    "columnDefs": [
        { 'className': "textcenter", "targets": [0,5,6] },
        { 
            "render": function (data, type, row) {
                return `<span class="badge" style="background-color:${row.color}">${data}</span>`;
            },
            "targets": 4
        }
    ],       
    'dom': 'lBfrtip',
    'buttons': [
        {
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr":"Exportar a Excel",
            "className": "btn btn-success",
            "exportOptions": { 
                "columns": [0,1,2,3,4,5,6] 
            }
        },{
            "extend": "pdfHtml5",
            "text": "<i class='fas fa-file-pdf'></i> PDF",
            "titleAttr":"Exportar a PDF",
            "className": "btn btn-danger",
            "exportOptions": { 
                "columns": [0,1,2,3,4,5,6] 
            }
        }
    ],
    "resonsieve":"true",
    "bDestroy": true,
    "iDisplayLength": 10,
    "order":[[0,"desc"]]  
});

window.addEventListener('load', function() {
    if(document.querySelector("#formServicio")){
        let formServicio = document.querySelector("#formServicio");
        formServicio.onsubmit = function(e) {
            e.preventDefault();
            let strNumSerie = document.querySelector('#txtNumSerie').value;
            let intCliente = document.querySelector('#listCliente').value;
            let intEstado = document.querySelector('#listEstado').value;
            
            if(strNumSerie == '' || intCliente == '' || intEstado == '')
            {
                Swal.fire("Atención", "Todos los campos obligatorios deben ser llenados." , "error");
                return false;
            }
            
            divLoading.style.display = "flex";
            let request = (window.XMLHttpRequest) ? 
                            new XMLHttpRequest() : 
                            new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url+'/ServicioTecnico/setServicio'; 
            let formData = new FormData(formServicio);
            request.open("POST",ajaxUrl,true);
            request.send(formData);
            request.onreadystatechange = function(){
                if(request.readyState == 4 && request.status == 200){
                    let objData = JSON.parse(request.responseText);
                    if(objData.status)
                    {
                        formServicio.reset();
                        fntClientes();
                        fntEstados();
                        $('#modalServicioTecnico').modal('hide');
                        Swal.fire("", objData.msg ,"success");
                        document.querySelector("#idServicio").value = objData.idservicio;
                        document.querySelector("#containerGallery").classList.remove("notblock");
                        
                        if(rowTable == ""){
                            tableServicios.api().ajax.reload();
                        }else{
                            rowTable = ""; 
                        }
                    }else{
                        Swal.fire("Error", objData.msg , "error");
                    }
                }
                divLoading.style.display = "none";
                return false;
            }
        }
    } // Listo

    if(document.querySelector(".btnAddImage")){
       let btnAddImage =  document.querySelector(".btnAddImage");
       btnAddImage.onclick = function(e){
        let key = Date.now();
        let newElement = document.createElement("div");
        newElement.id= "div"+key;
        newElement.innerHTML = `
            <div class="prevImage"></div>
            <input type="file" name="foto" id="img${key}" class="inputUploadfile">
            <label for="img${key}" class="btnUploadfile"><i class="fas fa-upload "></i></label>
            <button class="btnDeleteImage notblock" type="button" onclick="fntDelItem('#div${key}')"><i class="fas fa-trash-alt"></i></button>`;
        document.querySelector("#containerImages").appendChild(newElement);
        document.querySelector("#div"+key+" .btnUploadfile").click();
        fntInputFile();
       }
    }

    fntInputFile();
    fntClientes();
    fntEstados();
}, false);

function fntInputFile(){
    let inputUploadfile = document.querySelectorAll(".inputUploadfile");
    inputUploadfile.forEach(function(inputUploadfile) {
        inputUploadfile.addEventListener('change', function(){
            let idServicio = document.querySelector("#idServicio").value;
            let parentId = this.parentNode.getAttribute("id");
            let idFile = this.getAttribute("id");            
            let uploadFoto = document.querySelector("#"+idFile).value;
            let fileimg = document.querySelector("#"+idFile).files;
            let prevImg = document.querySelector("#"+parentId+" .prevImage");
            let nav = window.URL || window.webkitURL;
            if(uploadFoto !=''){
                let type = fileimg[0].type;
                let name = fileimg[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png'){
                    prevImg.innerHTML = "Archivo no válido";
                    uploadFoto.value = "";
                    return false;
                }else{
                    let objeto_url = nav.createObjectURL(this.files[0]);
                    prevImg.innerHTML = `<img class="loading" src="${base_url}/Assets/images/loading.svg" >`;

                    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
                    let ajaxUrl = base_url+'/ServicioTecnico/setFoto'; 
                    let formData = new FormData();
                    formData.append('idservicio',idServicio);
                    formData.append("foto", this.files[0]);
                    request.open("POST",ajaxUrl,true);
                    console.log("Sending request to:", ajaxUrl);
                    console.log("FormData:", formData);
                    request.send(formData);
                    request.onreadystatechange = function(){
                        if(request.readyState != 4) return;
                        if(request.status == 200){
                            
                            try {
                                    // Verificamos si ya está parseado (por responseType: 'json')
                                    let objData = JSON.parse(request.response);
                                    console.log("Response:", objData);
                                    if(objData && objData.status){
                                        prevImg.innerHTML = `<img src="${objeto_url}">`;
                                        document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgname", objData.imgname);
                                        document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgid", objData.idimg);
                                        document.querySelector("#"+parentId+" .btnUploadfile").classList.add("notblock");
                                        document.querySelector("#"+parentId+" .btnDeleteImage").classList.remove("notblock");
                                    } else {
                                        Swal.fire("Error", objData?.msg || "Respuesta inválida del servidor", "error");
                                    }
                                } catch (e) {
                                    console.error("Error parsing JSON:", e, "Response:", request.responseText);
                                    Swal.fire("Error", "La respuesta del servidor no es válida", "error");
                                }
                            } else {
                                Swal.fire("Error", `Error ${request.status}: ${request.statusText}`, "error");
                            
                            /*let objData = JSON.parse(request.responseText);
                            if(objData.status){
                                prevImg.innerHTML = `<img src="${objeto_url}">`;
                                document.querySelector("#"+parentId+" .btnDeleteImage").setAttribute("imgname",objData.imgname);
                                document.querySelector("#"+parentId+" .btnUploadfile").classList.add("notblock");
                                document.querySelector("#"+parentId+" .btnDeleteImage").classList.remove("notblock");
                            }else{
                                Swal.fire("Error", objData.msg , "error");
                            }*/
                        }
                    }
                }
            }
        });
    });
}

function fntDelItem(element){
    let idFoto = document.querySelector(element+' .btnDeleteImage').getAttribute("imgid");
    let imgNombre = document.querySelector(element+' .btnDeleteImage').getAttribute("imgname");
    let idServicio = document.querySelector("#idServicio").value;
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/ServicioTecnico/delFile'; 

    let formData = new FormData();
    formData.append('idservicio',idServicio);
    formData.append("idfoto",idFoto);
    formData.append("imgNombre",imgNombre);
    request.open("POST",ajaxUrl,true);
    console.log("Sending request to:", ajaxUrl);
    console.log("FormData:", formData);
    request.send(formData);
    request.onreadystatechange = function(){
        if(request.readyState != 4) return;
        if(request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let itemRemove = document.querySelector(element);
                itemRemove.parentNode.removeChild(itemRemove);
            }else{
                Swal.fire("", objData.msg , "error");
            }
        }
    }
}

function fntViewInfo(idServicio){
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/ServicioTecnico/getServicio/'+idServicio;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objServicio = objData.data;
                let estadoServicio = objServicio.color ? `<span class="badge" style="background-color:${objServicio.color}">${objServicio.estado}</span>` : 'Estado no definido';
                console.log(objServicio);
                console.log(objServicio.num_serie)
                document.querySelector("#txtNumSerie").innerHTML = objServicio.num_serie || 'No definido';
                document.querySelector("#txtDescripcion").innerHTML = objServicio.descripcion || 'No definido';
                document.querySelector("#listCliente").innerHTML = objServicio.cliente_nombre && objServicio.cliente_apellidos ? `${objServicio.cliente_nombre} ${objServicio.cliente_apellidos}` : 'Cliente no definido';
                document.querySelector("#txtTelefono").innerHTML = objServicio.cliente_telefono || 'No definido';
                document.querySelector("#txtEmail").innerHTML = objServicio.cliente_email || 'No definido';
                /*document.querySelector("#listEstado").innerHTML = estadoServicio;*/   
                document.querySelector("#txtDiagnostico").innerHTML = objServicio.diagnostico || 'No definido';
                document.querySelector("#txtObservaciones").innerHTML = objServicio.observaciones || 'No definido';
                document.querySelector("#txtFechaEntrada").innerHTML = objServicio.fecha_entrada || 'No definido';
                document.querySelector("#txtFechaSalida").innerHTML = objServicio.fecha_salida ? objServicio.fecha_salida : 'No entregado';

                if(objServicio.images && objServicio.images.length > 0){
                    let objImagenes = objServicio.images;
                    for (let p = 0; p < objImagenes.length; p++) {
                        htmlImage +=`<img src="${objImagenes[p].url_image}" class="img-thumbnail">`;
                        }
                } else {
                    htmlImage = 'No hay imágenes disponibles';
                }
                document.querySelector("#celFotos").innerHTML = htmlImage;
                $('#modalViewServicio').modal('show');

            }else{
                Swal.fire("Error", objData.msg , "error");
            }
        }
    } 
}

function fntViewHistory(idServicio){
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/ServicioTecnico/getMovimientos/'+idServicio;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.length > 0)
            {
                let htmlHistory = "";
                for (let i = 0; i < objData.length; i++) {
                    htmlHistory += `
                    <div class="timeline-block mb-3">
                        <div class="timeline-content">
                            <div class="card">
                                <div class="card-header">
                                    <h6>${objData[i].tecnico}</h6>
                                    <small class="text-muted">${objData[i].fecha}</small>
                                </div>
                                <div class="card-body">
                                    <p class="mb-1"><strong>Estado anterior:</strong> ${objData[i].estado_anterior}</p>
                                    <p class="mb-1"><strong>Estado nuevo:</strong> ${objData[i].estado_nuevo}</p>
                                    <p class="mb-0"><strong>Descripción:</strong> ${objData[i].descripcion}</p>
                                </div>
                            </div>
                        </div>
                    </div>`;
                }
                document.querySelector("#historyContent").innerHTML = htmlHistory;
                $('#modalHistoryServicio').modal('show');
            }else{
                Swal.fire("Error", "No hay historial para este servicio" , "error");
            }
        }
    } 
}

function fntEditInfo(element,idServicio){
    rowTable = element.parentNode.parentNode.parentNode;
    document.querySelector('#titleModal').innerHTML ="Actualizar Servicio";
    document.querySelector('.modal-header').classList.replace("headerRegister", "headerUpdate");
    document.querySelector('#btnActionForm').classList.replace("btn-primary", "btn-info");
    document.querySelector('#btnText').innerHTML ="Actualizar";
    let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/ServicioTecnico/getServicio/'+idServicio;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status)
            {
                let htmlImage = "";
                let objServicio = objData.data;
                document.querySelector("#idServicio").value = objServicio.idservicio;
                document.querySelector("#txtNumSerie").value = objServicio.num_serie;
                document.querySelector("#txtDescripcion").value = objServicio.descripcion;
                document.querySelector("#txtDiagnostico").value = objServicio.diagnostico;
                document.querySelector("#txtObservaciones").value = objServicio.observaciones;
                
                // Asegurarse de que los selects de cliente y estado se actualicen correctamente
                if (objServicio.idcliente) {
                    document.querySelector("#listCliente").value = objServicio.idcliente;
                    $('#listCliente').selectpicker('refresh');
                } else {
                    console.error("Cliente no definido en el servicio.");
                }

                if (objServicio.idestado) {
                    document.querySelector("#listEstado").value = objServicio.idestado;
                    $('#listEstado').selectpicker('refresh');
                } else {
                    console.error("Estado no definido en el servicio.");
                }
                
                if(objServicio.images.length > 0){
                    let objImagenes = objServicio.images;
                    for (let p = 0; p < objImagenes.length; p++) {
                        let key = Date.now()+p;
                        htmlImage +=`<div id="div${key}">
                            <div class="prevImage">
                            <img src="${objImagenes[p].url_image}"></img>
                            </div>
                            <button type="button" class="btnDeleteImage" onclick="fntDelItem('#div${key}')" imgid="${objImagenes[p].idfoto}" imgname="${objImagenes[p].ruta}">
                            <i class="fas fa-trash-alt"></i></button></div>`;
                    }
                }
                document.querySelector("#containerImages").innerHTML = htmlImage; 
                document.querySelector("#containerGallery").classList.remove("notblock");           
                $('#modalServicioTecnico').modal('show');
            }else{
                Swal.fire("Error", objData.msg , "error");
            }
        }
    }
}

function fntDelInfo(idServicio){
    Swal.fire({
        title: "Eliminar Servicio",
        text: "¿Realmente quiere eliminar el servicio?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar!",
        cancelButtonText: "No, cancelar!",
    }).then((result) => {
        if (result.isConfirmed) {
            let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            let ajaxUrl = base_url + '/ServicioTecnico/delServicio';
            let strData = "idServicio=" + idServicio;
            request.open("POST", ajaxUrl, true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send(strData);
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        Swal.fire("Eliminado!", objData.msg, "success");
                        tableServicios.api().ajax.reload();
                    } else {
                        Swal.fire("Atención!", objData.msg, "error");
                    }
                }
            };
        }
    });
}

function fntClientes(){
    if(document.querySelector('#listCliente')){
        let ajaxUrl = base_url+'/ServicioTecnico/getClientes';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                let htmlOptions = '<option value="" selected>Seleccione</option>';
                for (let i = 0; i < objData.length; i++) {
                    htmlOptions += `<option value="${objData[i].idpersona}">${objData[i].nombres} ${objData[i].apellidos}</option>`;
                }
                document.querySelector('#listCliente').innerHTML = htmlOptions;
                $('#listCliente').selectpicker('refresh');
            }
        }
    }
}

function fntEstados(){
    if(document.querySelector('#listEstado')){
        let ajaxUrl = base_url+'/ServicioTecnico/getEstados';
        let request = (window.XMLHttpRequest) ? 
                    new XMLHttpRequest() : 
                    new ActiveXObject('Microsoft.XMLHTTP');
        request.open("GET",ajaxUrl,true);
        request.send();
        request.onreadystatechange = function(){
            if(request.readyState == 4 && request.status == 200){
                let objData = JSON.parse(request.responseText);
                let htmlOptions = '<option value="" selected>Seleccione</option>';
                for (let i = 0; i < objData.length; i++) {
                    htmlOptions += `<option value="${objData[i].idestado}" data-color="${objData[i].color}">${objData[i].nombre}</option>`;
                }
                document.querySelector('#listEstado').innerHTML = htmlOptions;
                $('#listEstado').selectpicker('refresh');
            }
        }
    }
}

function openModal()
{
    rowTable = "";
    document.querySelector('#idServicio').value ="";
    document.querySelector('.modal-header').classList.replace("headerUpdate", "headerRegister");
    document.querySelector('#btnActionForm').classList.replace("btn-info", "btn-primary");
    document.querySelector('#btnText').innerHTML ="Guardar";
    document.querySelector('#titleModal').innerHTML = "Nuevo Servicio";
    document.querySelector("#formServicio").reset();
    document.querySelector("#containerGallery").classList.add("notblock");
    document.querySelector("#containerImages").innerHTML = "";
    $('#modalServicioTecnico').modal('show');
}

function addMovimiento(idServicio){
    document.querySelector('#idServicioMov').value = idServicio;

    // Cargar los estados en el select del modal
    let ajaxUrl = base_url + '/ServicioTecnico/getEstados';
    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET", ajaxUrl, true);
    request.send();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            let objData = JSON.parse(request.responseText);
            let htmlOptions = '<option value="">Seleccione</option>';
            for (let i = 0; i < objData.length; i++) {
                htmlOptions += `<option value="${objData[i].idestado}" data-color="${objData[i].color}">${objData[i].nombre}</option>`;
            }
            document.querySelector('#listEstadoNuevo').innerHTML = htmlOptions;
            $('#listEstadoNuevo').selectpicker('refresh');
        }
    }

    $('#modalAddMovimiento').modal('show');
}

function saveMovimiento(e){
    e.preventDefault();

    let formData = new FormData(document.querySelector("#formMovimiento"));

    // Agregar las imágenes seleccionadas al FormData
    let imageInputs = document.querySelectorAll(".inputUploadfile");
    imageInputs.forEach(input => {
        if (input.files.length > 0) {
            formData.append("fotos[]", input.files[0]);
        }
    });

    let request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    let ajaxUrl = base_url+'/ServicioTecnico/setMovimiento';
    request.open("POST", ajaxUrl, true);
    request.send(formData);

    request.onreadystatechange = function(){
        if(request.readyState == 4 && request.status == 200){
            let objData = JSON.parse(request.responseText);
            if(objData.status){
                Swal.fire("", objData.msg , "success");
                $('#modalAddMovimiento').modal('hide');
                tableServicios.api().ajax.reload();
            }else{
                Swal.fire("Error", objData.msg , "error");
            }
        }
    }
    return false;
}

// Ensure the event listener is properly bound
if(document.querySelector("#formMovimiento")){
    document.querySelector("#formMovimiento").onsubmit = saveMovimiento;
}

document.querySelector("#inputMovImage").addEventListener("change", function(e) {
    const file = e.target.files[0];
    const container = document.querySelector("#containerMovImage");
    container.innerHTML = ""; // Limpiar cualquier vista previa existente

    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            const img = document.createElement("img");
            img.src = event.target.result;
            img.classList.add("img-thumbnail");
            img.style.maxWidth = "100%";
            container.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
});

document.querySelector(".btnAddMovImage").addEventListener("click", function() {
    const input = document.createElement("input");
    input.type = "file";
    input.accept = "image/*";
    input.style.display = "none";

    input.addEventListener("change", function(e) {
        const file = e.target.files[0];
        const container = document.querySelector("#containerMovImages");
        container.innerHTML = ""; // Limpiar cualquier vista previa existente

        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const img = document.createElement("img");
                img.src = event.target.result;
                img.classList.add("img-thumbnail");
                img.style.maxWidth = "100%";
                container.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    });

    document.body.appendChild(input);
    input.click();
    document.body.removeChild(input);
});