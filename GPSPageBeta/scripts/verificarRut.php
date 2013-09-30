<?php
function validaRut($rut){
    $dig=substr($rut,-1);
    if ( strlen($rut) == 0 || strlen($rut) < 8){
        return false;
    }else{
        $rut = str_replace('-','',$rut);
        $rut =str_replace('.','',$rut);
        $suma = 0;
        $caracteres = "1234567890kK";
        $contador = 0;
        for ( $i=0; $i < strlen($rut); $i++){
            $u = substr($rut, $i, ($i + 1));
            if (strpos($caracteres,$u) != -1)
                $contador++;
        }
        if ( $contador==0 ){
            return false;
        }
        $var_rut = substr($rut,0,strlen($rut)-1);
        $drut= substr($rut,strlen($rut)-1);
        $dvr = '0';
        $mul = 2;
        for ($i = strlen($var_rut)-1 ; $i >= 0; $i--){
            $suma = $suma + ($var_rut{$i} * $mul);
            if ($mul == 7){
                $mul = 2;
            }else{
                $mul++;
            }
        }
        $res = $suma % 11;
        if ($res==1){
            $dvr = 'k';
        }
        else if ($res==0){
            $dvr = '0';
        }
        else{
            $dvi = 11 - $res;
            $dvr = $dvi + "";
        }
        if ( $dvr != strtolower($drut) ){
            return false;
        }
        else{
            return true;
        }
    }//Fin Else
}//Fin validaRut
?>