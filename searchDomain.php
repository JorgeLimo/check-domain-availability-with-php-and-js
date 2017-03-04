<?

    function verificarDominio($dominio, $extension){

        //Creación de las variables necesarias.
        $salida  = "";
        $errores = "";

        //Creación de la lista de extensiones con su whois.
        $extensiones  = array(
            'com' => 'whois.crsnic.net@No match for',
            'net' => 'whois.crsnic.net@No match for',
            'org' => 'whois.publicinterestregistry.net@NOT FOUND',
            'info' => 'whois.rotld.ro@Not Found'
        );

        //filtro por @ de la lista de extensiones.
        $valores = explode('@', $extensiones[$extension]);
        
        //fsockopen — inicia una conexión vía sockets al recurso especificado por hostname.
        //Este proceso ayuda a validar la conexión con whois en relación a la extension seleccionada. 
        if (($fp = fsockopen($valores[0], 43)) == false) {
            $errores .= "No se pudo conectar al servidor de Whois";
        }

        //El fputs —  escribe en un archivo abierto.
        //La función se detendrá al final del archivo o cuando alcance la longitud especificada, lo que ocurra primero.
        //Esta función devuelve el número de bytes escritos en caso de éxito, o FALSE en caso de fallo.
        //La función fputs () es un alias de la función fwrite ().
        fputs($fp, $dominio . '.' . $extension . "\n");

        //feof — Comprueba si el puntero a un archivo está al final del archivo
        while (!feof($fp)) {
            $salida .= fgets($fp, 128);
        }

        //fclose — Cierra un puntero a un archivo abierto
        fclose($fp);
        
        /** 
        eregi — Comparación de una expresión regular de forma insensible a mayúsculas-minúsculas
        Advertencia - Esta función está OBSOLETA en PHP 5.3.0, por lo tanto, será ELIMINADA en PHP 7.0.0.
        PHP7 - preg_match()
        Para la sustitución, tenemos que tener en cuanta lo siguiente:
        1. Es necesario añadir delimitadores a la expresión regular.
        2. Algunas expresiones las tendremos que cambiar por sus equivalentes en PCRE (Perl Compatible Regular Expressions).
        3. La 'i' de 'eregi' viene de case-insensitive, que en PCRE equivale a usar el flag 'i'.
        if (eregi($valores[1], $salida)) { 
        **/
        if (preg_match('/'.$valores[1].'/i', $salida)) {
            return 'false';
        } else {
            return 'true';
        }

    }

    //Obtener parametros - method post
    $getName   = $_POST['name'];
    $getDomain = $_POST['domain'];

    //Llamado al metodo verificarDominio()
    $a = verificarDominio($getName, $getDomain);

    //Validar resultado de metodo.
    if ($a == "true") {
        //echo $getName . "." . $getDomain . " dominio no diponible"; 
        echo 0;
    } else {
        //echo $getName . "." . $getDomain . " dominio diponible"; 
        echo 1;
    }

?> 