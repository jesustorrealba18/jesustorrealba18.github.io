<?php

require_once('modelo/datos.php');



class productos extends datos{

	private $codigo; 
	private $nombre;
	private $descripcion;
	private $cantidad;
	private $proveedor;
	private $categoria;
	private $almacen;

	

	function set_codigo($valor){
		$this->codigo = $valor;
	}
	
	function set_nombre($valor){
		$this->nombre = $valor;
	}
	
	function set_descripcion($valor){
		$this->descripcion = $valor;
	}
	
	function set_cantidad($valor){
		$this->cantidad = $valor;
	}
	
	function set_proveedor($valor){
		$this->proveedor = $valor;
	}
	
	function set_categoria($valor){
		$this->categoria = $valor;
	}

	function set_almacen($valor){
		$this->almacen = $valor;
	}
	

	
	function get_codigo(){
		return $this->codigo;
	}
	
	function get_nombre(){
		return $this->nombre;
	}
	
	function get_descripcion(){
		return $this->descripcion;
	}
	
	function get_cantidad(){
		return $this->cantidad;
	}
	
	function get_proveedor(){
		return $this->proveedor;
	}
	
	function get_categoria(){
		return $this->categoria;
	}

	function get_almacen(){
		return $this->almacen;
	}

	
	
	function incluir(){
		
		$r = array();
		if(!$this->existe($this->codigo)){
		
			$co = $this->conecta();
			$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			try {
                $co->query("INSERT INTO productos(
                    codigo,
                    nombre,
                    descripcion,
                    cantidad,
                    proveedor,
                    categoria,
                    almacen
                    )
                    VALUES(
                    '$this->codigo',
                    '$this->nombre',
                    '$this->descripcion',
                    '$this->cantidad',
                    '$this->proveedor',
                    '$this->categoria',
                    '$this->almacen'
                    )");
						$r['resultado'] = 'incluir';
			            $r['mensaje'] =  'Registro Inluido';
			} catch(Exception $e) {
				$r['resultado'] = 'error';
			    $r['mensaje'] =  $e->getMessage();
			}
		}
		else{
			$r['resultado'] = 'incluir';
			$r['mensaje'] =  'Este producto ya esta registrado';
		}
		return $r;
	
	}
	
	function modificar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		if($this->existe($this->codigo)){
			try {
                $co->query("UPDATE productos SET 
                codigo = '$this->codigo',
                nombre = '$this->nombre',
                descripcion = '$this->descripcion',
                cantidad = '$this->cantidad',
                proveedor = '$this->proveedor',
                categoria = '$this->categoria',
                almacen = '$this->almacen'
                WHERE
                codigo = '$this->codigo'
                ");
						$r['resultado'] = 'modificar';
			            $r['mensaje'] =  'Registro Modificado';
			} catch(Exception $e) {
				$r['resultado'] = 'error';
			    $r['mensaje'] =  $e->getMessage();
			}
		}
		else{
			$r['resultado'] = 'modificar';
			$r['mensaje'] =  'Producto no registrado';
		}
		return $r;
	}
	
	function eliminar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		if($this->existe($this->codigo)){
			try {
					$co->query("delete from productos 
						where
						codigo = '$this->codigo'
						");
						$r['resultado'] = 'eliminar';
			            $r['mensaje'] =  'Registro Eliminado';
			} catch(Exception $e) {
				$r['resultado'] = 'error';
			    $r['mensaje'] =  $e->getMessage();
			}
		}
		else{
			$r['resultado'] = 'eliminar';
			$r['mensaje'] =  'No existe el producto';
		}
		return $r;
	}
	
	
	function consultar(){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$r = array();
		try{
			
			$resultado = $co->query("Select * from productos");
			
			if($resultado){
				
				$respuesta = '';
				foreach($resultado as $r){
					$respuesta = $respuesta."<tr>";
					    $respuesta = $respuesta."<td>";
							$respuesta = $respuesta."<button type='button'
							class='btn btn-dark w-100 small-width mb-3' 
							onclick='pone(this,0)'
						    >Modificar</button><br/>";
							$respuesta = $respuesta."<button type='button'
							class='btn btn-light w-100 small-width mt-2' 
							onclick='pone(this,1)'
						    >Eliminar</button><br/>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['codigo'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['nombre'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['descripcion'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['cantidad'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['proveedor'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['categoria'];
						$respuesta = $respuesta."</td>";
						$respuesta = $respuesta."<td>";
							$respuesta = $respuesta.$r['almacen'];
						$respuesta = $respuesta."</td>";
					$respuesta = $respuesta."</tr>";
				}
				
			    $r['resultado'] = 'consultar';
				$r['mensaje'] =  $respuesta;
			}
			else{
				$r['resultado'] = 'consultar';
				$r['mensaje'] =  '';
			}
			
		}catch(Exception $e){
			$r['resultado'] = 'error';
			$r['mensaje'] =  $e->getMessage();
		}
		return $r;
	}
	
	
	private function existe($codigo){
		$co = $this->conecta();
		$co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		try{
			
			$resultado = $co->query("SELECT * FROM `productos` WHERE codigo='$codigo'");
			
			
			$fila = $resultado->fetchAll(PDO::FETCH_BOTH);
			if($fila){

				return true;
			    
			}
			else{
				
				return false;;
			}
			
		}catch(Exception $e){
			return false;
		}
	}
	
	
	
	function obtienefecha(){
		$r = array();
		
			  $f = date('Y-m-d');
		      $f1 = strtotime ('-18 year' , strtotime($f)); 
		      $f1 = date ('Y-m-d',$f1);
			  $r['resultado'] = 'obtienefecha';
			  $r['mensaje'] =  $f1;
		
		return $r;
	}




	
}







