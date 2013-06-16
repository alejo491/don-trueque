<?php

	class Estadisticas extends Tpage{
		public function onInit($param) {
		parent::onLoad($param);
 
		$this->generateProductsGraph();
	}
 
	private function generateProductsGraph() {
		$ydata1 = array();
		$ydata2 = array();
		$xdata = array();
 
		// Prepare array of x values
		$xValues = ...
		foreach( $xValues as $xValue ) {
			$xdata[] = $xValue;
		}
 
		// Prepare array of ydata1
		foreach( $xValues as $xValue ) {
			$products = GET_PRODUCTS_DEPENDING_ON_xValue();
			$ydata1[] = count($products);
		}
 
		// Prepare array of ydata2
		foreach( $xValues as $xValue ) {
			$products = GET_PRODUCTS_DEPENDING_ON_xValue();
			$ydata2[] = count($products);
		}
 
		$ydata1 = implode(',', $ydata1);
		$ydata2 = implode(',', $ydata2);
		$xdata = implode(',', $xdata);
		$this->ProductsImage->ImageUrl = $this->getRequest()->constructUrl('graph', 1, array( 'xdata' => $xdata, 'ydata1' => $ydata1, 'ydata2' => $ydata2, 'ytitle' => 'title'), false);
	}
	
	}

?>