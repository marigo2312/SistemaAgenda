function confirmarEliminacion(idContacto) {
  const overlay = document.createElement('div');
  overlay.style.position = 'fixed';
  overlay.style.top = 0;
  overlay.style.left = 0;
  overlay.style.width = '100%';
  overlay.style.height = '100%';
  overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
  overlay.style.display = 'flex';
  overlay.style.justifyContent = 'center';
  overlay.style.alignItems = 'center';
  overlay.style.zIndex = 1000;

  const popup = document.createElement('div');
  popup.style.background = '#fff';
  popup.style.padding = '20px';
  popup.style.borderRadius = '10px';
  popup.style.textAlign = 'center';
  popup.style.boxShadow = '0 0 10px rgba(0,0,0,0.3)';

  const mensaje = document.createElement('p');
  mensaje.textContent = "¿Estás segura(o) de que deseas eliminar este contacto?";

  const btnCancelar = document.createElement('button');
  btnCancelar.textContent = "Cancelar";
  btnCancelar.style.marginRight = "10px";
  btnCancelar.onclick = function () {
    document.body.removeChild(overlay);
  };

  const btnAceptar = document.createElement('button');
  btnAceptar.textContent = "Aceptar";
  btnAceptar.onclick = function () {
    document.formTablaGral.txtClave.value = idContacto;
    document.formTablaGral.txtOpe.value = 'b';
    document.formTablaGral.submit();
    document.body.removeChild(overlay);
  };

  popup.appendChild(mensaje);
  popup.appendChild(document.createElement('br'));
  popup.appendChild(btnCancelar);
  popup.appendChild(btnAceptar);
  overlay.appendChild(popup);
  document.body.appendChild(overlay);
}
