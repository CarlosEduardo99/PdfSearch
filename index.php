<?php

include "media/PdfToText/PdfToText.phpclass"; //Inclui a Classe PDF TO TEXT

//Executa a  Pesquisa se for clicado o botão PESQUISAR no html
if (isset($_POST['enviar'])) {
	/*------------------Valores Recebidos do Form HTML--------------------*/
	$string = $_POST['string']; //Palavra-Chave
	$dir = $_POST['diretorio'];
	$ano = $_POST['ano'];
	/*---------------------------------End--------------------------------*/

	/*-------------------------Iterador de Arquivos-----------------------*/
	$docPath = "";
	//Array que irá conter os nomes dos arquivos na pasta $ano

	//$file receberá cada item do array $arquivos
	foreach (new DirectoryIterator($docPath.$dir. "/" . $ano) as $file) {
		$filename = $file->getPathname();
	/*---------------------------------End--------------------------------*/
		//Condicão para exibir somente os BI
		if(stripos($file, "BI") !== false) {
			//Inicio do PDF TO TEXT
			$pdf = new PdfToText ($filename);

			if(stripos($pdf, $string) !== false) {

				echo '<a href="jdownloads/'.$dir.'/'.$ano.'/'.$filename.'" target="_blank">'.$file.'</a>';
				echo "<br/>";

				$line = substr($pdf, stripos($pdf, $string) - 15, 150);
				echo "<br/>";

				echo "[...]";
				printf($line);
				echo "[...]";
				echo '<hr/>';
			}else {
				$piece = explode(" ", $string);

				foreach($piece as $consulta) {
					if(stripos($pdf, $consulta) !== false) {
						echo '<a href="jdownloads/'.$dir.'/'.$ano.'/'.$filename.'" target="_blank">'.$filename.'</a>';
						echo "<br/>";

						$line = substr($pdf, stripos($pdf, $consulta) - 15, 150);
						echo "<br/>";

						echo "[...]";
						printf($line);
						echo "[...]";
						echo "<hr/>";
					}
				}
			}

		}
	}
}
?>
