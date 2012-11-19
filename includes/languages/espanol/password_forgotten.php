<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Iniciar Sesi&oacute;n');
define('NAVBAR_TITLE_2', 'Contrase&ntilde;a Olvidada');

define('HEADING_TITLE', 'He olvidado Mi Contrase&ntiled;a!');

define('TEXT_MAIN', 'Si has olvidado tu contrase&ntilde;a, introduce tu e-mail abajo y te enviaremos instrucciones de c&oacute;mo cambiarla de una forma segura.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Error: La Direcci&oacute;n e-mail no aparece en nuestros registros, por favor vuelve a intentarlo.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nueva contrase&ntilde;a');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Se ha recibido una solicitud de cambio de contrase&ntilde;a de ' . tep_get_ip_address() . '.' . "\n\n" . 'Tu nueva Contrase&ntilde;a para \'' . STORE_NAME . '\' es:' . "\n\n" . '   %s' . "\n\n");

define('SUCCESS_PASSWORD_SENT', '&Eacute;xito: Se ha enviado una contrase&ntilde;a nueva a tu direcci&oacute;n e-mail.');
?>