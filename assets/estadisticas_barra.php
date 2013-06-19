<?php // content="text/plain; charset=utf-8"

require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_bar.php');

			
			
			$data2y=explode(',',$_GET['y']);
			$datax=explode(',',$_GET['x']);


			
			$graph = new Graph(550,500,'auto'); 
			$graph->SetScale("textlin");
			$graph->img->SetMargin(100,30,30,200);
			$graph->SetShadow();
			

			
			$b1plot = new BarPlot($data2y);
		
			

			
			$graph->Add($b1plot);
			$b1plot->value->Show();
				$b1plot->SetFillColor("orange");
			$b1plot->SetWidth(0.5);
			$b1plot->value->SetFont(FF_ARIAL,FS_BOLD,12);
			$b1plot->value->SetAlign('left','center');
			$b1plot->value->SetColor('black');
			$b1plot->value->SetFormat('%.1f ');
			
			
 
			
			
			$graph->xaxis->SetPos('min');
			$graph->xaxis->SetTickLabels($datax);
			$graph->xaxis->SetFont(FF_FONT1,FS_BOLD);
			
			$graph->yaxis->title->Set("Solicitudes (%)");
			
			$graph->xaxis->SetLabelAngle(90);
 

			
			$graph->title->SetFont(FF_FONT1,FS_BOLD);
			
			$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
			$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

			// Display the graph
			$graph->Stroke();
	
	
	


?>
