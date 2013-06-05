<?php
 class Masterpage extends TTemplateControl{
        
        public function iniciar_sesion($param){
                
                $u=usuarioRecord::finder()->find('NICK=? and PASS=?',array($this->txt_usuario->Text,$this->txt_pass->Text));
                $this->txt_conf->Text=$this->txt_usuario->Text;
                if($this->u==null){
                        $this->txt_conf->Text="No se ha podido iniciar sesion";
                        
                }
         }
         
         public function buscar_Clicked($param){
                
                
                //esto es para pasar valores por post
                $url=$this->Service->constructUrl('resultadosBusqueda',array('id'=>$this->txt_buscar->Text,'tipo'=>'nombre','ms'=>'Masterpage'));
                $this->Response->redirect($url);
                
        }
 }
?>