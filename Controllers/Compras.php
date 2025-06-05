<?php 
	class Compras extends Controllers{
		public function __construct()
		{
			parent::__construct();
			session_start();
			if(empty($_SESSION['login']))
			{
				header('Location: '.base_url().'/login');
				die();
			}
			getPermisos(MDCOMPRA);
		}

		public function Compras()
		{
			if(empty($_SESSION['permisosMod']['r'])){
				header("Location:".base_url().'/dashboard');
			}
			$data['page_tag'] = "Compras";
			$data['page_title'] = "COMPRAS";
			$data['page_name'] = "compras";
			$data['page_functions_js'] = "functions_Compras.js";
			$this->views->getView($this,"compras",$data);
		}

		public function getCompras()
		{
			if($_SESSION['permisosMod']['r']){
				$arrData = $this->model->selectCompras();
				for ($i=0; $i < count($arrData); $i++) {
					$btnView = '';
					$btnEdit = '';
					$btnDelete = '';

					if($arrData[$i]['status'] == 1)
					{
						$arrData[$i]['status'] = '<span class="badge badge-success">Activo</span>';
					}else{
						$arrData[$i]['status'] = '<span class="badge badge-danger">Inactivo</span>';
					}

					$arrData[$i]['precio'] = SMONEY.' '.formatMoney($arrData[$i]['precio']);
					if($_SESSION['permisosMod']['r']){
						$btnView = '<button class="btn btn-info btn-sm" onClick="fntViewInfo('.$arrData[$i]['idproducto'].')" title="Ver producto"><i class="far fa-eye"></i></button>';
					}
					if($_SESSION['permisosMod']['u']){
						$btnEdit = '<button class="btn btn-primary  btn-sm" onClick="fntEditInfo(this,'.$arrData[$i]['idproducto'].')" title="Editar producto"><i class="fas fa-pencil-alt"></i></button>';
					}
					if($_SESSION['permisosMod']['d']){	
						$btnDelete = '<button class="btn btn-danger btn-sm" onClick="fntDelInfo('.$arrData[$i]['idproducto'].')" title="Eliminar producto"><i class="far fa-trash-alt"></i></button>';
					}
					$arrData[$i]['options'] = '<div class="text-center">'.$btnView.' '.$btnEdit.' '.$btnDelete.'</div>';
				}
				echo json_encode($arrData,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setProducto(){
			if($_POST){
				if(empty($_POST['txtNombre']) || empty($_POST['txtCodigo']) || empty($_POST['listCategoria']) || empty($_POST['txtPrecio']) || empty($_POST['listStatus']) )
				{
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					
					$idProducto = intval($_POST['idProducto']);
					$strNombre = strClean($_POST['txtNombre']);
					$strDescripcion = strClean($_POST['txtDescripcion']);
					$strCodigo = strClean($_POST['txtCodigo']);
					$intCategoriaId = intval($_POST['listCategoria']);
					$strPrecio = strClean($_POST['txtPrecio']);
					$intStock = intval($_POST['txtStock']);
					$intStatus = intval($_POST['listStatus']);
					$request_producto = "";

					$ruta = strtolower(clear_cadena($strNombre));
					$ruta = str_replace(" ","-",$ruta);

					if($idProducto == 0)
					{
						$option = 1;
						if($_SESSION['permisosMod']['w']){
							$request_producto = $this->model->insertProducto($strNombre, 
																		$strDescripcion, 
																		$strCodigo, 
																		$intCategoriaId,
																		$strPrecio, 
																		$intStock, 
																		$ruta,
																		$intStatus );
						}
					}else{
						$option = 2;
						if($_SESSION['permisosMod']['u']){
							$request_producto = $this->model->updateProducto($idProducto,
																		$strNombre,
																		$strDescripcion, 
																		$strCodigo, 
																		$intCategoriaId,
																		$strPrecio, 
																		$intStock, 
																		$ruta,
																		$intStatus);
						}
					}
					if($request_producto > 0 )
					{
						if($option == 1){
							$arrResponse = array('status' => true, 'idproducto' => $request_producto, 'msg' => 'Datos guardados correctamente.');
						}else{
							$arrResponse = array('status' => true, 'idproducto' => $idProducto, 'msg' => 'Datos Actualizados correctamente.');
						}
					}else if($request_producto == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! ya existe un producto con el Código Ingresado.');		
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getProducto($idproducto){
			if($_SESSION['permisosMod']['r']){
				$idproducto = intval($idproducto);
				if($idproducto > 0){
					$arrData = $this->model->selectProducto($idproducto);
					if(empty($arrData)){
						$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
					}else{
						$arrImg = $this->model->selectImages($idproducto);
						if(count($arrImg) > 0){
							for ($i=0; $i < count($arrImg); $i++) { 
								$arrImg[$i]['url_image'] = media().'/images/uploads/'.$arrImg[$i]['img'];
							}
						}
						$arrData['images'] = $arrImg;
						$arrResponse = array('status' => true, 'data' => $arrData);
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function setImage(){
			if($_POST){
				if(empty($_POST['idproducto'])){
					$arrResponse = array('status' => false, 'msg' => 'Error de dato.');
				}else{
					$idProducto = intval($_POST['idproducto']);
					$foto      = $_FILES['foto'];
					$imgNombre = 'pro_'.md5(date('d-m-Y H:i:s')).'.jpg';
					$request_image = $this->model->insertImage($idProducto,$imgNombre);
					if($request_image){
						$uploadImage = uploadImage($foto,$imgNombre);
						$arrResponse = array('status' => true, 'imgname' => $imgNombre, 'msg' => 'Archivo cargado.');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error de carga.');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function delFile(){
			if($_POST){
				if(empty($_POST['idproducto']) || empty($_POST['file'])){
					$arrResponse = array("status" => false, "msg" => 'Datos incorrectos.');
				}else{
					//Eliminar de la DB
					$idProducto = intval($_POST['idproducto']);
					$imgNombre  = strClean($_POST['file']);
					$request_image = $this->model->deleteImage($idProducto,$imgNombre);

					if($request_image){
						$deleteFile =  deleteFile($imgNombre);
						$arrResponse = array('status' => true, 'msg' => 'Archivo eliminado');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar');
					}
				}
				echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function delProducto(){
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$intIdproducto = intval($_POST['idProducto']);
					$requestDelete = $this->model->deleteProducto($intIdproducto);
					if($requestDelete)
					{
						$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el producto');
					}else{
						$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el producto.');
					}
					echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}

		public function setCompra(){
			if($_POST){
				if(empty($_POST['idDistribuidor']) || empty($_POST['nroFactura']) || empty($_POST['fechaFactura']) || empty($_POST['totalFactura']) || empty($_POST['productos'])){
					$arrResponse = array("status" => false, "msg" => 'Datos incompletos.');
				}else{
					$idCompra = intval($_POST['idCompra']);
					$idDistribuidor = intval($_POST['idDistribuidor']);
					$nroFactura = strClean($_POST['nroFactura']);
					$fechaFactura = strClean($_POST['fechaFactura']);
					$totalFactura = floatval($_POST['totalFactura']);
					$productos = $_POST['productos']; // Array de productos
					$status = intval($_POST['status']);

					if($idCompra == 0){
						// Crear nueva compra
						$request_compra = $this->model->insertCompra($idDistribuidor, $nroFactura, $fechaFactura, $totalFactura, $status);
						if($request_compra > 0){
							foreach($productos as $producto){
								$this->model->insertCompraProducto($request_compra, $producto['idProducto'], $producto['cantidad'], $producto['precioUnitario'], $producto['subtotal']);
							}
							$arrResponse = array("status" => true, "msg" => 'Compra registrada correctamente.');
						}else{
							$arrResponse = array("status" => false, "msg" => 'No se pudo registrar la compra.');
						}
					}else{
						// Actualizar compra existente
						$request_compra = $this->model->updateCompra($idCompra, $idDistribuidor, $nroFactura, $fechaFactura, $totalFactura, $status);
						if($request_compra){
							$arrResponse = array("status" => true, "msg" => 'Compra actualizada correctamente.');
						}else{
							$arrResponse = array("status" => false, "msg" => 'No se pudo actualizar la compra.');
						}
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function getCompra($idCompra){
			if($_SESSION['permisosMod']['r']){
				$idCompra = intval($idCompra);
				$arrData = $this->model->selectCompraById($idCompra);
				$arrProductos = $this->model->selectCompraProductos($idCompra);
				if(!empty($arrData)){
					$arrData['productos'] = $arrProductos;
					$arrResponse = array("status" => true, "data" => $arrData);
				}else{
					$arrResponse = array("status" => false, "msg" => 'Datos no encontrados.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function delCompra(){
			if($_POST){
				if($_SESSION['permisosMod']['d']){
					$idCompra = intval($_POST['idCompra']);
					$requestDelete = $this->model->deleteCompra($idCompra);
					if($requestDelete){
						$arrResponse = array("status" => true, "msg" => 'Compra eliminada correctamente.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'Error al eliminar la compra.');
					}
					echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
				}
			}
			die();
		}
		public function getDistribuidores(){
			$arrData = $this->model->selectDistribuidores();
			echo json_encode($arrData, JSON_UNESCAPED_UNICODE);
			die();
		}

		public function getDistribuidor(int $idDistribuidor){
			$idDistribuidor = intval($idDistribuidor);
			if($idDistribuidor > 0){
				$arrData = $this->model->selectDistribuidor($idDistribuidor);
				
				if(empty($arrData)){
					$arrResponse = array('status' => false, 'msg' => 'Datos no encontrados.');
				}else{
					$arrResponse = array('status' => true, 'data' => $arrData);
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function setDistribuidor(){
			if($_POST){
				if(empty($_POST['txtNombre']) || empty($_POST['txtRIF']) || empty($_POST['txtTelefono']) || empty($_POST['txtDireccion'])){
					$arrResponse = array("status" => false, "msg" => 'Datos incompletos.');
				}else{
					$idDistribuidor = intval($_POST['idDistribuidor']);
					$strNombre = strClean($_POST['txtNombre']);
					$strRIF = strClean($_POST['txtRIF']);
					$strTelefono = strClean($_POST['txtTelefono']);
					$strDireccion = strClean($_POST['txtDireccion']);
					$intStatus = intval($_POST['status']);

					if($idDistribuidor == 0){
						// Crear nuevo distribuidor
						$request_distribuidor = $this->model->insertDistribuidor($strNombre, $strRIF, $strTelefono, $strDireccion, $intStatus);
						$option = 1;
					}else{
						// Actualizar distribuidor existente
						$request_distribuidor = $this->model->updateDistribuidor($idDistribuidor, $strNombre, $strRIF, $strTelefono, $strDireccion, $intStatus);
						$option = 2;
					}

					if($request_distribuidor > 0){
						if($option == 1){
							$arrResponse = array('status' => true, 'msg' => 'Distribuidor registrado correctamente.');
						}else{
							$arrResponse = array('status' => true, 'msg' => 'Distribuidor actualizado correctamente.');
						}
					}else if($request_distribuidor == 'exist'){
						$arrResponse = array('status' => false, 'msg' => '¡Atención! El RIF ya existe.');
					}else{
						$arrResponse = array("status" => false, "msg" => 'No es posible almacenar los datos.');
					}
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}

		public function delDistribuidor(){
			if($_POST){
				$intIdDistribuidor = intval($_POST['idDistribuidor']);
				$requestDelete = $this->model->deleteDistribuidor($intIdDistribuidor);
				if($requestDelete){
					$arrResponse = array('status' => true, 'msg' => 'Se ha eliminado el distribuidor.');
				}else{
					$arrResponse = array('status' => false, 'msg' => 'Error al eliminar el distribuidor.');
				}
				echo json_encode($arrResponse, JSON_UNESCAPED_UNICODE);
			}
			die();
		}
	}

 ?>