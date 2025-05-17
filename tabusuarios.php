<?php
include_once("modelo/Contacto.php");
session_start();

$sErr = "";
$sUsuario = "";
$arrContactos = null;
$oContacto = new Contacto();

if (isset($_SESSION["usuario"])) {
    $sUsuario = $_SESSION["usuario"];
    try {
        $idUsuario = $_SESSION["usuario"];
$rol = $_SESSION["rol"];

if ($rol == "2") {
    $arrContactos = $oContacto->buscarTodos($idUsuario);
} else {
    $arrContactos = $oContacto->buscarTodos();
}

    } catch (Exception $e) {
        error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
        $sErr = "Error en base de datos, comunicarse con el administrador";
    }
} else {
    $sErr = "Debe iniciar sesión";
}

if ($sErr == "") {
    include_once("cabecera.html");
    include_once("menu.php");
    include_once("aside.html");
} else {
    header("Location: error.php?sError=" . urlencode($sErr));
    exit();
}
?>

<section>
    <h3>Contactos</h3>
    <form name="formTablaGral" method="post" action="abcContacto.php">
        <input type="hidden" name="txtClave">
        <input type="hidden" name="txtOpe">

        <table border="1">
            <tr>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>ID Dueño</th>
                <th>Operaciones</th>
            </tr>
            <?php
            if ($arrContactos != null) {
                foreach ($arrContactos as $contacto) {
            ?>
                    <tr>
                        <td><?php echo $contacto->getNombre(); ?></td>
                        <td><?php echo $contacto->getDireccion(); ?></td>
                        <td><?php echo $contacto->getTelefono(); ?></td>
                        <td><?php echo $contacto->getEmail(); ?></td>
                        <td><?php echo $contacto->getIDU(); ?></td>
                        <td>
                            <input type="submit" value="Modificar" onclick="txtClave.value=<?php echo $contacto->getId(); ?>; txtOpe.value='m'">
                            <button type="button" onclick="confirmarEliminacion(<?php echo $contacto->getId(); ?>)">Borrar</button>

                        </td>
                    </tr>
            <?php
                }
            } else {
            ?>
                <tr><td colspan="5">No hay contactos registrados</td></tr>
            <?php
            }
            ?>
        </table>

        <br>
        <input type="submit" value="Crear nuevo contacto" onclick="txtClave.value='-1'; txtOpe.value='a'">
    </form>
</section>
<script src="js/script-confirmar.js"></script>

<?php
if (
    (isset($_GET["eliminado"]) && $_GET["eliminado"] == "1") ||
    (isset($_GET["agregado"]) && $_GET["agregado"] == "1") ||
    (isset($_GET["modificado"]) && $_GET["modificado"] == "1")
) {
    echo '<script src="js/script-ok.js"></script>';
} elseif (isset($_GET["error"]) && $_GET["error"] == "1") {
    echo '<script src="js/script-error.js"></script>';
}
?>


<?php include_once("pie.html"); ?> 
