<?php
	if($_GET)
	{
		echo "{$_GET['nome']}<br> {$_GET['idade']}";
	}
	else
	{	
		// Redirecionar para a página index.html
		header("location:index.html");
	}
?>