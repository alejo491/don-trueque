<?php
 class Registro extends Tpage {
         public function onInit($param) { 
           parent::onInit($param); 
            $this->lbl_val->Enabled="False";
            $this->lbl_val->Visible="False";
            $this->lbl_val1->Enabled="False";
            $this->lbl_val1->Visible="False";
         
         }
  
        public function validar_string($sender, $param){
         if(is_numeric($param->Value)){
            $param->IsValid = false;
         }
         
        }
  
        public function validar_tamano($sender,$param){
         if(strlen($param->Value)<6){
            $param->IsValid=false;
         }
        }
        
        
  
        
  
        public function btn_registrarse_click($param){
               if ($this->isValid){
                  if($this->chk_condiciones->Checked){
                        $usuario=usuarioRecord::finder()->findAll("NICK=?",$this->txt_nombre_usuario->Text);  
                        if ($usuario==null){   
                     
                           $usuario=new usuarioRecord();
                           
                           $usuario->NOMBRE_USUARIO=$this->txt_nombre->Text;
                           $usuario->APELLIDO_USUARIO=$this->txt_apellido->Text;
                           $usuario->FECHA_N=date('Y-m-d',$this->fecha_nac->TimeStampFromText);
                           $usuario->TELEFONO=$this->txt_telefono->Text;
                           $usuario->PREGUNTA=$this->txt_pregunta->Text;
                           $usuario->RESPUESTA=$this->txt_respuesta->Text;
                           $usuario->CORREO=$this->txt_correo->Text;
                           $usuario->NICK=$this->txt_nombre_usuario->Text;
                           $usuario->PASS=md5($this->txt_contrasena->Text);
                           
                           $usuario->save();
                           $url=$this->Service->constructUrl('RegistroExitoso');
                           $this->Response->redirect($url);
                        }else{
                           $this->lbl_val->Enabled="True";
                           $this->lbl_val->Visible="True";
                        }
                  }else{
                     $this->lbl_val1->Enabled="True";
                     $this->lbl_val1->Visible="True";
                  }
                
              
               }
        
        }
  
  } 
?>