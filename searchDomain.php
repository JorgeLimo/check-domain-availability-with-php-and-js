<?php

function verificarDominio(string $dominio, string $extension): bool {
    $salida  = '';
    $errores = '';

    $extensiones = [
        'com'  => 'whois.crsnic.net@No match for',
        'net'  => 'whois.crsnic.net@No match for',
        'org'  => 'whois.publicinterestregistry.net@NOT FOUND',
        'info' => 'whois.afilias.net@NOT FOUND',
    ];

    if (!isset($extensiones[$extension])) {
        return false; // extensión no soportada
    }

    [$servidorWhois, $noEncontradoTexto] = explode('@', $extensiones[$extension]);

    $fp = @fsockopen($servidorWhois, 43, $errno, $errstr, 10);

    if (!$fp) {
        error_log("Whois connection failed: $errstr ($errno)");
        return false;
    }

    fputs($fp, $dominio . '.' . $extension . "\n");

    while (!feof($fp)) {
        $salida .= fgets($fp, 128);
    }

    fclose($fp);

    return !preg_match('/' . preg_quote($noEncontradoTexto, '/') . '/i', $salida);
}

$getName   = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$getDomain = filter_input(INPUT_POST, 'domain', FILTER_SANITIZE_STRING);

if ($getName && $getDomain) {
    $disponible = verificarDominio($getName, $getDomain);
    echo $disponible ? 0 : 1;
} else {
    echo 'Invalid input';
}
