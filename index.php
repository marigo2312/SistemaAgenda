<?php
/*************************************************************/
/* Archivo:  index.php
 * Objetivo: página inicial de manejo de catálogo,
 *           incluye manejo de sesiones y plantillas
 * Autor:
 *************************************************************/
include_once("cabecera.html");
include_once("menu.php");
include_once("aside.html");
?>
        <section>
			<form id="frm" method="post" action="login.php">
				Usuario:  
				<input type="text" name="txtUsuario" required />
				<br/>
				Contraseña:  
				<input type="password" name="txtContrasena" required />
				<br/>
				<input type="submit" value="Enviar"/>
			</form>
</section>

<?php
include_once("pie.html");
?>