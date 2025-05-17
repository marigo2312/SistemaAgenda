<?php
include_once("modelo/Contacto.php");
session_start();

$sErr = "";
$arrContactos = null;
$oContacto = new Contacto();

if (isset($_SESSION["usuario"])) {
    $idUsuario = $_SESSION["usuario"];
    $rol = $_SESSION["rol"];
    $arrContactos = $oContacto->buscarTodos($idUsuario);
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
                <th>Operaciones</th>
            </tr>
            <?php
            if (!empty($arrContactos)) {
                foreach ($arrContactos as $contacto) {
                    ?>
                    <tr>
                        <td><?php echo $contacto->getNombre(); ?></td>
                        <td><?php echo $contacto->getDireccion(); ?></td>
                        <td><?php echo $contacto->getTelefono(); ?></td>
                        <td><?php echo $contacto->getEmail(); ?></td>
                        <td>
                            <button type="submit" onclick="document.formTablaGral.txtClave.value=<?php echo $contacto->getId(); ?>; document.formTablaGral.txtOpe.value='m';">Modificar</button>
                            <button type="button" onclick="confirmarEliminacion(<?php echo $contacto->getId(); ?>)">Borrar</button>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo '<tr><td colspan="5">No hay contactos registrados</td></tr>';
            }
            ?>
        </table>

        <br>
        <input type="submit" value="Crear nuevo contacto" onclick="txtClave.value='-1'; txtOpe.value='a'">
    </form>
</section>
<script src="js/script-confirmar.js"></script>


<?php include_once("pie.html"); ?>
