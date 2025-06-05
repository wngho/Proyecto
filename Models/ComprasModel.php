<?php 

	class ComprasModel extends Mysql
	{
		private $intIdProducto;
		private $strNombre;
		private $strDescripcion;
		private $intCodigo;
		private $intCategoriaId;
		private $intPrecio;
		private $intStock;
		private $intStatus;
		private $strRuta;
		private $strImagen;

		private $intIdCompra;
		private $intIdDistribuidor;
		private $strFactura;
		private $dateFechaFactura;
		private $floatTotalFactura;

		public function __construct()
		{
			parent::__construct();
		}

		public function selectCompras(){
			$sql = "SELECT c.id_compra, c.nro_factura, c.fecha_factura, c.total_factura, d.nombre as distribuidor, c.status 
            FROM compra c 
            INNER JOIN distribuidor d ON c.id_distribuidor = d.id_distribuidor 
            WHERE c.status != 0";
			$request = $this->select_all($sql);
			return $request;
		}	

		public function insertProducto(string $nombre, string $descripcion, int $codigo, int $categoriaid, string $precio, int $stock, string $ruta, int $status){
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intStock = $stock;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE codigo = '{$this->intCodigo}'";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$query_insert  = "INSERT INTO producto(categoriaid,
														codigo,
														nombre,
														descripcion,
														precio,
														stock,
														ruta,
														status) 
								  VALUES(?,?,?,?,?,?,?,?)";
	        	$arrData = array($this->intCategoriaId,
        						$this->intCodigo,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
        						$this->intStock,
        						$this->strRuta,
        						$this->intStatus);
	        	$request_insert = $this->insert($query_insert,$arrData);
	        	$return = $request_insert;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function updateProducto(int $idproducto, string $nombre, string $descripcion, int $codigo, int $categoriaid, string $precio, int $stock, string $ruta, int $status){
			$this->intIdProducto = $idproducto;
			$this->strNombre = $nombre;
			$this->strDescripcion = $descripcion;
			$this->intCodigo = $codigo;
			$this->intCategoriaId = $categoriaid;
			$this->strPrecio = $precio;
			$this->intStock = $stock;
			$this->strRuta = $ruta;
			$this->intStatus = $status;
			$return = 0;
			$sql = "SELECT * FROM producto WHERE codigo = '{$this->intCodigo}' AND idproducto != $this->intIdProducto ";
			$request = $this->select_all($sql);
			if(empty($request))
			{
				$sql = "UPDATE producto 
						SET categoriaid=?,
							codigo=?,
							nombre=?,
							descripcion=?,
							precio=?,
							stock=?,
							ruta=?,
							status=? 
						WHERE idproducto = $this->intIdProducto ";
				$arrData = array($this->intCategoriaId,
        						$this->intCodigo,
        						$this->strNombre,
        						$this->strDescripcion,
        						$this->strPrecio,
        						$this->intStock,
        						$this->strRuta,
        						$this->intStatus);

	        	$request = $this->update($sql,$arrData);
	        	$return = $request;
			}else{
				$return = "exist";
			}
	        return $return;
		}

		public function selectProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT p.idproducto,
							p.codigo,
							p.nombre,
							p.descripcion,
							p.precio,
							p.stock,
							p.categoriaid,
							c.nombre as categoria,
							p.status
					FROM producto p
					INNER JOIN categoria c
					ON p.categoriaid = c.idcategoria
					WHERE idproducto = $this->intIdProducto";
			$request = $this->select($sql);
			return $request;

		}

		public function insertImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query_insert  = "INSERT INTO imagen(productoid,img) VALUES(?,?)";
	        $arrData = array($this->intIdProducto,
        					$this->strImagen);
	        $request_insert = $this->insert($query_insert,$arrData);
	        return $request_insert;
		}

		public function selectImages(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "SELECT productoid,img
					FROM imagen
					WHERE productoid = $this->intIdProducto";
			$request = $this->select_all($sql);
			return $request;
		}

		public function deleteImage(int $idproducto, string $imagen){
			$this->intIdProducto = $idproducto;
			$this->strImagen = $imagen;
			$query  = "DELETE FROM imagen 
						WHERE productoid = $this->intIdProducto 
						AND img = '{$this->strImagen}'";
	        $request_delete = $this->delete($query);
	        return $request_delete;
		}

		public function deleteProducto(int $idproducto){
			$this->intIdProducto = $idproducto;
			$sql = "UPDATE producto SET status = ? WHERE idproducto = $this->intIdProducto ";
			$arrData = array(0);
			$request = $this->update($sql,$arrData);
			return $request;
		}

		public function insertCompra(int $idDistribuidor, string $factura, string $fechaFactura, float $totalFactura, int $status){
			$this->intIdDistribuidor = $idDistribuidor;
			$this->strFactura = $factura;
			$this->dateFechaFactura = $fechaFactura;
			$this->floatTotalFactura = $totalFactura;
			$this->intStatus = $status;

			$query_insert = "INSERT INTO compra(id_distribuidor, nro_factura, fecha_factura, total_factura, status) VALUES(?,?,?,?,?)";
			$arrData = array($this->intIdDistribuidor, $this->strFactura, $this->dateFechaFactura, $this->floatTotalFactura, $this->intStatus);
			$request_insert = $this->insert($query_insert, $arrData);
			return $request_insert;
		}

		public function insertCompraProducto(int $idCompra, int $idProducto, int $cantidad, float $precioUnitario, float $subtotal){
			$query_insert = "INSERT INTO compra_producto(id_compra, id_producto, cantidad, precio_unitario, subtotal) VALUES(?,?,?,?,?)";
			$arrData = array($idCompra, $idProducto, $cantidad, $precioUnitario, $subtotal);
			$request_insert = $this->insert($query_insert, $arrData);
			return $request_insert;
		}

		public function selectCompraById(int $idCompra){
			$this->intIdCompra = $idCompra;
			$sql = "SELECT c.id_compra, c.nro_factura, c.fecha_factura, c.total_factura, d.nombre as distribuidor, c.status 
            FROM compra c 
            INNER JOIN distribuidor d ON c.id_distribuidor = d.id_distribuidor 
            WHERE c.id_compra = ?";
			$request = $this->select($sql, array($this->intIdCompra));
			return $request;
		}

		public function selectCompraProductos(int $idCompra){
			$this->intIdCompra = $idCompra;
			$sql = "SELECT cp.id_compra_producto, p.nombre as producto, cp.cantidad, cp.precio_unitario, cp.subtotal 
            FROM compra_producto cp 
            INNER JOIN producto p ON cp.id_producto = p.idproducto 
            WHERE cp.id_compra = ?";
			$request = $this->select_all($sql, array($this->intIdCompra));
			return $request;
		}

		public function updateCompra(int $idCompra, int $idDistribuidor, string $factura, string $fechaFactura, float $totalFactura, int $status){
			$this->intIdCompra = $idCompra;
			$this->intIdDistribuidor = $idDistribuidor;
			$this->strFactura = $factura;
			$this->dateFechaFactura = $fechaFactura;
			$this->floatTotalFactura = $totalFactura;
			$this->intStatus = $status;

			$sql = "UPDATE compra SET id_distribuidor = ?, nro_factura = ?, fecha_factura = ?, total_factura = ?, status = ? WHERE id_compra = ?";
			$arrData = array($this->intIdDistribuidor, $this->strFactura, $this->dateFechaFactura, $this->floatTotalFactura, $this->intStatus, $this->intIdCompra);
			$request = $this->update($sql, $arrData);
			return $request;
		}

		public function deleteCompra(int $idCompra){
			$this->intIdCompra = $idCompra;
			$sql = "UPDATE compra SET status = ? WHERE id_compra = ?";
			$arrData = array(0, $this->intIdCompra);
			$request = $this->update($sql, $arrData);
			return $request;
		}

		// CRUD para distribuidores
		public function insertDistribuidor(string $nombre, string $rif, string $telefono, string $direccion, int $status){
		    $this->strNombre = $nombre;
		    $this->strRif = $rif;
		    $this->strTelefono = $telefono;
		    $this->strDireccion = $direccion;
		    $this->intStatus = $status;

		    $query_insert = "INSERT INTO distribuidor(nombre, rif, telefono, direccion, status, datecreated) VALUES(?,?,?,?,?,NOW())";
		    $arrData = array($this->strNombre, $this->strRif, $this->strTelefono, $this->strDireccion, $this->intStatus);
		    $request_insert = $this->insert($query_insert, $arrData);
		    return $request_insert;
		}

		public function selectDistribuidores(){
		    $sql = "SELECT id_distribuidor, nombre, rif, telefono, direccion, status, datecreated FROM distribuidor WHERE status != 0";
		    $request = $this->select_all($sql);
		    return $request;
		}

		public function selectDistribuidor(int $idDistribuidor){
		    $this->intIdDistribuidor = $idDistribuidor;
		    $sql = "SELECT id_distribuidor, nombre, rif, telefono, direccion, status, datecreated FROM distribuidor WHERE id_distribuidor = ?";
		    $request = $this->select($sql, array($this->intIdDistribuidor));
		    return $request;
		}

		public function updateDistribuidor(int $idDistribuidor, string $nombre, string $rif, string $telefono, string $direccion, int $status){
		    $this->intIdDistribuidor = $idDistribuidor;
		    $this->strNombre = $nombre;
		    $this->strRif = $rif;
		    $this->strTelefono = $telefono;
		    $this->strDireccion = $direccion;
		    $this->intStatus = $status;

		    $sql = "UPDATE distribuidor SET nombre = ?, rif = ?, telefono = ?, direccion = ?, status = ? WHERE id_distribuidor = ?";
		    $arrData = array($this->strNombre, $this->strRif, $this->strTelefono, $this->strDireccion, $this->intStatus, $this->intIdDistribuidor);
		    $request = $this->update($sql, $arrData);
		    return $request;
		}

		public function deleteDistribuidor(int $idDistribuidor){
		    $this->intIdDistribuidor = $idDistribuidor;
		    $sql = "UPDATE distribuidor SET status = ? WHERE id_distribuidor = ?";
		    $arrData = array(0, $this->intIdDistribuidor);
		    $request = $this->update($sql, $arrData);
		    return $request;
		}
	}
 ?>