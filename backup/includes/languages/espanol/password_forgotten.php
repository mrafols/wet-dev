<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Iniciar Sesi&oacute;n');
define('NAVBAR_TITLE_2', 'Contrase&ntilde;a Olvidada');

define('HEADING_TITLE', '¡He olvidado mi contrase&ntilde;a!');

define('TEXT_MAIN', 'Si ha olvidado su contrase&ntilde;a, introduzca su direcci&oacute;n de Correo Electr&oacute;nico y le enviaremos instrucciones sobre c&oacute;mo cambiar su contrase&ntilde;a de forma segura.');

define('TEXT_PASSWORD_RESET_INITIATED', 'Por favor, compruebe su Correo Electr&oacute;nico para obtener instrucciones sobre c&oacute;mo cambiar tu contrase&ntilde;a. Las instrucciones contienen un enlace que s&oacute;lo es v&aacute;lido durante 24 horas o hasta que su contrase&ntilde;a haya sido actualizada.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<font color="#ff0000"><b>NOTA:</b></font> El Correo Electr&oacute;nico no figura en nuestros registro, por favor int&eacute;ntelo de nuevo.');

define('EMAIL_PASSWORD_RESET_SUBJECT', STORE_NAME . ' - Nueva Contrase&ntilde;a');
define('EMAIL_PASSWORD_RESET_BODY', 'Una nueva contrase&ntilde;a ha sido solicitada de su cuenta en ' . STORE_NAME . '.' . "\n\n" . 'Por favor, siga este enlace personal para cambiar la contrase&ntilde;a de forma segura:' . "\n\n" . '%s' . "\n\n" . 'Este enlace se descartar&aacute; de forma autom&aacute;tica despu&eacute;s de 24 horas o despu&eacute;s de que su contrase&ntilde;a haya sido cambiada.' . "\n\n" . 'Para obtener ayuda con cualquiera de nuestros servicios, por favor escriba al Administrador de la Tienda: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");

define('ERROR_ACTION_RECORDER', 'Error: Un enlace de restablecimiento de contrase&ntilde;a ya ha sido enviado. Vuelva a intentarlo en %s minutos.');
?>