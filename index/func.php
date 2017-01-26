<?php

function ordenarArquivosPorTipo(&$arquivos) {
	$extensoes = [];
	foreach ($arquivos as $key => $value) {
		$extensoes[] = substr($arquivos[$key], -4)[0] == '.'?substr($arquivos[$key], -3):substr($arquivos[$key], -4);
	}
	// Elimina extensões repetidas e ordena
	$extensoes = array_unique($extensoes);
	sort($extensoes);

	$arquivosOrdenados = [];
	// Percorre extensoes e arquivos, atribuindo cada arquivo a sua classe
	foreach ($extensoes as $key => $value) {// Percorre extensoes
		$ext = $extensoes[$key];
		foreach ($arquivos as $key2 => $value2) {// Percorre arquivos um por um e atribui cada um deles à sua classe
			$ext2 = substr($arquivos[$key2], -4)[0] == '.'?substr($arquivos[$key2], -3):substr($arquivos[$key2], -4);
			// echo $ext2."  ". $ext."<br>";
			if ($ext == $ext2) {
				array_push($arquivosOrdenados, $arquivos[$key2]);// Atribuir novo valor a classe
			}
		}
	}
	$arquivos = $arquivosOrdenados;
}

function identificarImgExtensao($arquivo) {
	$dirImg = $GLOBALS['imgdir'];
	$ext    = explode('.', $arquivo);
	$ext    = $ext[count($ext)-1];

	switch ($ext) {
		case ("html"):
			return $dirImg."html.svg";
			break;
		case ("js"):
			return $dirImg."js.svg";
			break;
		case ("php"):
			return $dirImg."php.svg";
			break;
		case ("css"):
			return $dirImg."css.svg";
			break;
		case ("json"):
			return $dirImg."json.svg";
			break;
		case ("txt"):
			return $dirImg."txt.svg";
			break;
		case ("jpg"):
		case ("svg"):
		case ("png"):
		case ("gif"):
		case ("bmp"):
			return $GLOBALS['dir']."/".$arquivo;
			break;
		default:
			return $dirImg."file.svg";
			break;
	}
}
function imprimir($conteudo) {
	// $acima      = $GLOBALS['imgdir']."up.svg";
	$imgPasta = $GLOBALS['imgdir']."pasta-flat.svg";
	// $imgArquivo = $GLOBALS['imgdir']."html.svg";
	foreach ($conteudo as $key => $value) {
		if (!is_file($GLOBALS['dir']."/".$value)) {
			$img  = ($value == "..")?$acima:$imgPasta;
			$link = $value;
			if (isset($_GET['url'])) {
				$link = $_GET['url']."/".$value;
			}
			$link = "?url=$link";
		} else {
			$img  = identificarImgExtensao($value);
			//$link = $GLOBALS['dir'] == "./"?$value:$GLOBALS['dir']."/".$value;
			$link = ($value == "index.php" or $value == "index.html")?$GLOBALS['dir']."/":
			$link = ($GLOBALS['dir'] == "./")?$value:$GLOBALS['dir']."/".$value;
		}
		$value = ucfirst($value);

		echo "
<div>
	<a href='$link'>
		<img src='$img'><br>
		<span>$value</span>
	</a>
</div>
";
	}
}
