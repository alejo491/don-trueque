<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<com:THead Title="donTrueque">
	

<!-- Design by Free CSS Templates http://www.freecsstemplates.org Released for free under a Creative Commons Attribution License Name : Reverse Obscurity Version : 1.0 Released : 20130222 -->
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />

<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet" type="text/css" />
<link href="http://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="assets/style.css" />
</com:THead>

<body>
<com:TForm ID="FormCuerpo">
<div id="bg">
<div id="outer">
<div id="banner"> <img src="assets/images/pic1.jpg" alt="" height="212" width="1064" /> </div>
<div id="main">
<div id="sidebar1">
<div id="dirinicio" class="test" align="center">
<h2><a href="?page=principaladministrador" >Inicio</a></h2>
</div>


<div id="columncat" class="test" align="center">
<a href="#"><h1>Categorias</h1></a><br />
<ul class="linkedList">
		<li> <a href="?page=resultadosBusqueda&id=tecnologia&tipo=categoria&ms=templateadministrador">Tecnologia</a></li>
		<li> <a href="?page=resultadosBusqueda&id=vehiculos&tipo=categoria&ms=templateadministrador">Vehiculos</a> </li>
		<li> <a href="?page=resultadosBusqueda&id=Electrodomesticos&tipo=categoria&ms=templateadministrador">Electrodomesticos</a> </li>
		<li> <a href="?page=resultadosBusqueda&id=Juguetes&tipo=categoria&ms=templateadministrador">Juguetes</a> </li>
		<li> <a href="?page=resultadosBusqueda&id=Libros&tipo=categoria&ms=templateadministrador">Libros</a></li>
		<li> <a href="?page=resultadosBusqueda&id=Peliculas&tipo=categoria&ms=templateadministrador">Peliculas</a> </li>
		<li> <a href="?page=resultadosBusqueda&id=Videojuegos&tipo=categoria&ms=templateadministrador">Videojuegos</a></li>
	</ul>
</div>

</div>

<div id="sidebar2">

			<div id="barrader" class="test">
				<fieldset><legend><com:TLabel ID="lb" Text="Administrador "/><com:TLabel ID="nombre_administrador" Text=""/></legend>
					<a href="?page=editarPerfil&ms=templateadministrador">Editar Perfil</a><br />
					<a href="?page=listarUsuarios" >Ver Usuarios</a><br />
					<a href="?page=administrarArticulos" >Administrar Articulos</a><br />
					<a href="" >Ver Estadisticas</a><br />
				</fieldset><br />
				
				<com:TButton ID="button" Text="Cerrar Sesion" OnClick="cerrar_sesion"/>
				
			</div>
			
	
	
	<img class="top" src="assets/images/pic1.jpg" alt="" height="84" width="232" />
</div>

<div id="content">
<div id="box1"> <b>Buscar &nbsp;</b><com:TTextBox ID="txt_buscar" Text=""/>
	<com:TLabel ID="lbl_espacio" Text=" "/>
	<com:TButton ID="btn_buscar" Text="Buscar" OnClick="buscar_Clicked"/>
<a href="?page=busquedaAvanzada&ms=templateadministrador">Busqueda
Avanzada</a> </div>
<div id="box2">
	
		<com:TContentPlaceHolder ID="cphCuerpo" />
	
</div>
<div id="box3"> </div>
<br class="clear" />
</div>
<br class="clear" />
</div>
<div id="footer">
<div style="text-align: center;"></div>
<div id="footerContent">
<div style="text-align: center;"></div>
<h3 style="text-align: center;"> &nbsp; &nbsp;
&nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
&nbsp; &nbsp; &nbsp;&nbsp;
&nbsp;

	<a href="#">Contáctenos</a><com:TLabel ID="lbl_espacio2" Text=" "/><a href="#">¿quiénes
somos?</a></h3>


</h3>
</div>
<div id="footerSidebar"><a><br />
</a></div>
<a><br class="clear" />
</a></div>
</div>
<div id="copyright"><a> ©2013, <span style="text-decoration: underline;">Dontrueque.com todos los
derechos reservados</span> </a></div>
</div>
</com:TForm>
</body>
</html>