<?php
/*
  $Id: banktransfer.php,v 1.3 2002/05/31 19:02:02 thomasamoulton Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_TITLE', 'Pago por Transferencia Bancaria');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_DESCRIPTION','Se ha enviado un Email con los datos para la transferencia del pago por tu pedido.:<br>
<br>
<br>
  No se enviar&aacute; tu pedido hasta que confirmemos la recepci&oacute;n de la transferencia en la cuenta siguiente.');
  define('MODULE_PAYMENT_BANKTRANSFER_TEXT_EMAIL_FOOTER', "Por favor, utiliza los siguientes datos para transferir el pago por tu pedido:\n\nAccount No.:  " . MODULE_PAYMENT_BANKTRANSFER_ACCNUM . "\nSort Code:    " . MODULE_PAYMENT_BANKTRANSFER_SORTCODE . "\nAccount Name: " . MODULE_PAYMENT_BANKTRANSFER_ACCNAM . "\nBank Name:    " . MODULE_PAYMENT_BANKTRANSFER_BANKNAM . "\nIBAN number:    " . MODULE_PAYMENT_BANKTRANSFER_IBAN . "\nSWIFT number:    " . MODULE_PAYMENT_BANKTRANSFER_SWIFT ."\n\nYour order will not ship until we receive payments in the above account.");
  define('MODULE_PAYMENT_BANKTRANSFER_SORT_ORDER', 'Sort order of display');
define('MODULE_PAYMENT_BANKTRANSFER_ORDER_STATUS_ID', 'Set the order status');
?>
