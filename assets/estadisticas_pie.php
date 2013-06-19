<?php
require_once ("jpgraph/src/jpgraph.php");
require_once ("jpgraph/src/jpgraph_pie.php");

// Se define el array de valores y el array de la leyenda
$datos = explode(',',$_GET['y']);
$leyenda = explode(',',$_GET['x']);

//Se define el grafico
$grafico = new PieGraph(450,300);





//Añadimos el titulo y la leyenda
$p1 = new PiePlot($datos);
$p1->SetLegends($leyenda);
$p1->SetCenter(0.4);

//Se muestra el grafico
$grafico->Add($p1);
$grafico->Stroke();
?>
