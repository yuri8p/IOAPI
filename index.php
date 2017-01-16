<?php
require ("index/func.php");
$cor   = ["#ea2f4a", "#346094", "#318254", "#DD8013", "#111"][rand(0, 4)];
$style = file_get_contents("index/style.css");

$imgdir   = "index/img/";
$dir      = isset($_GET['url'])?"./".$_GET['url']:"./";
$conteudo = scandir($dir);
$arquivos = [];
$pastas   = [];

foreach ($conteudo as $item) {
	if (is_file($GLOBALS['dir']."/".$item)) {
		$arquivos[] = $item;
	} else if ($item != "." and $item != "..") {
		$pastas[] = $item;
	}
}
// // Abrir arquivo index de cada pasta se existir ao invés de mostrar arquivos da mesma
// if ((in_array("index.php", $arquivos) or in_array("index.html", $arquivos)) and $dir != "./") {
// 	header("Location: $dir");
// }
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="<?php echo $cor;?>">
	<meta charset="utf-8">
	<link rel="icon" href=<?php echo $imgdir."favicon.png";?>>
	<title>Index of Apache/PHP</title>
	<style> <?php echo $style;?></style>
</head>
<body>
<?php
// Botão Voltar
echo ($dir != "./")?"<div>\n\t<a href='javascript:window.history.go(-1)'>
\t\t<img src='$imgdir/up.svg'>\n\t</a>\n</div>":"";

ordenarArquivosPorTipo($arquivos);
imprimir($pastas);
imprimir($arquivos);
?>
</body>
</html>