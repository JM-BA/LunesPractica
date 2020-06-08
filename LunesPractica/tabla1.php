<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>
    Tabla 
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="mclibre-php-ejercicios.css" title="Color">
</head>

<body>
  <h1>Tabla</h1>

  <form action="" method="get">
    

    <table>
      <tbody>
        <tr>
          <td><label for="columnas">Número de columnas:</label></td>
          <td><input type="number" name="columnas" min="1" max="100" value="5" id="columnas"></td>
        </tr>
        <tr>
          <td><label for="numeradas">Cantidad final que desee ingresar : </label></td>
          <td><input type="number" name="numeradas" min="1" max="1000" value="17" id="numeradas"></td>
        </tr>
      </tbody>
    </table>

    <p>
      <input type="submit" value="Mostrar">
    </p>
  </form>

  
  <h1>Tabla numerada (Resultado)</h1>

<?php
function recoge($var, $m = "")
{
    if (!isset($_REQUEST[$var])) {
        $tmp = (is_array($m)) ? [] : "";
    } elseif (!is_array($_REQUEST[$var])) {
        $tmp = trim(htmlspecialchars($_REQUEST[$var], ENT_QUOTES, "UTF-8"));
    } else {
        $tmp = $_REQUEST[$var];
        array_walk_recursive($tmp, function (&$valor) {
            $valor = trim(htmlspecialchars($valor, ENT_QUOTES, "UTF-8"));
        });
    }
    return $tmp;
}

$numeradas = recoge("numeradas");
$columnas  = recoge("columnas");

$numeradasOk = $columnasOk = false;

$numeradasMinimo = 1;
$numeradasMaximo = 1000;
$columnasMinimo  = 1;
$columnasMaximo  = 100;

if ($numeradas == "") {
    print "  <p class=\"aviso\">No ha escrito el número de celdas numeradas.</p>\n";
    print "\n";
} elseif (!is_numeric($numeradas)) {
    print "  <p class=\"aviso\">No ha escrito el número de celdas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($numeradas)) {
    print "  <p class=\"aviso\">No ha escrito el número de celdas numeradas "
        . "como número entero.</p>\n";
    print "\n";
} elseif ($numeradas < $numeradasMinimo || $numeradas > $numeradasMaximo) {
    print "  <p class=\"aviso\">El número de celdas numeradas debe estar entre "
        . "$numeradasMinimo y $numeradasMaximo.</p>\n";
    print "\n";
} else {
    $numeradasOk = true;
}

if ($columnas == "") {
    print "  <p class=\"aviso\">No ha escrito el número de columnas.</p>\n";
    print "\n";
} elseif (!is_numeric($columnas)) {
    print "  <p class=\"aviso\">No ha escrito el número de columnas como número.</p>\n";
    print "\n";
} elseif (!ctype_digit($columnas)) {
    print "  <p class=\"aviso\">No ha escrito el número de columnas "
        . "como número entero.</p>\n";
    print "\n";
} elseif ($columnas < $columnasMinimo || $columnas > $columnasMaximo) {
    print "  <p class=\"aviso\">El número de columnas debe estar entre "
        . "$columnasMinimo y $columnasMaximo.</p>\n";
    print "\n";
} else {
    $columnasOk = true;
}

if ($numeradasOk && $columnasOk) {
    $filas = ceil($numeradas / $columnas);
    $contador = 1;
    print "  <table class=\"conborde\">\n";
    print "    <tbody>\n";
    for ($i = 1; $i <= $filas; $i++) {
        print "      <tr>\n";
        for ($j = 1; $j <= $columnas; $j++) {
            print "        <td>" . (($contador <= $numeradas) ? $contador++ : "")
                . "</td>\n";
        }
        print "      </tr>\n";
    }
    print "    </tbody>\n";
    print "  </table>\n";
    print "\n";
}

?>
</body>
</html>
