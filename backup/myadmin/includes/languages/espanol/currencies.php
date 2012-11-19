<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Monedas');

define('TABLE_HEADING_CURRENCY_NAME', 'Moneda');
define('TABLE_HEADING_CURRENCY_CODES', 'C&oacute;digo');
define('TABLE_HEADING_CURRENCY_VALUE', 'Valor');
define('TABLE_HEADING_ACTION', 'Acci&oacute;n');

define('TEXT_INFO_EDIT_INTRO', 'Por favor realice los cambios necesarios');
define('TEXT_INFO_COMMON_CURRENCIES', '-- Monedas Comunes --');
define('TEXT_INFO_CURRENCY_TITLE', 'T&iacute;tulo:');
define('TEXT_INFO_CURRENCY_CODE', 'C&oacute;digo:');
define('TEXT_INFO_CURRENCY_SYMBOL_LEFT', 'S&iacute;mbolo a la izquierda:');
define('TEXT_INFO_CURRENCY_SYMBOL_RIGHT', 'S&iacute;mbolo a la derecha:');
define('TEXT_INFO_CURRENCY_DECIMAL_POINT', 'Punto decimal:');
define('TEXT_INFO_CURRENCY_THOUSANDS_POINT', 'Separador de miles:');
define('TEXT_INFO_CURRENCY_DECIMAL_PLACES', 'N&uacute;mero de decimales:');
define('TEXT_INFO_CURRENCY_LAST_UPDATED', 'Actualizado el:');
define('TEXT_INFO_CURRENCY_VALUE', 'Valor:');
define('TEXT_INFO_CURRENCY_EXAMPLE', 'Ejemplo:');
define('TEXT_INFO_INSERT_INTRO', 'Introduzca los datos de la nueva moneda');
define('TEXT_INFO_DELETE_INTRO', 'Seguro que quiere eliminar esta moneda ?');
define('TEXT_INFO_HEADING_NEW_CURRENCY', 'Nueva Moneda');
define('TEXT_INFO_HEADING_EDIT_CURRENCY', 'Editar Moneda');
define('TEXT_INFO_HEADING_DELETE_CURRENCY', 'Eliminar Moneda');
define('TEXT_INFO_SET_AS_DEFAULT', TEXT_SET_DEFAULT . ' (requiere una actualizaci&oacute;n manual de los cambios de moneda)');
define('TEXT_INFO_CURRENCY_UPDATED', 'El tipo de cambio para %s (%s) se ha actualizado correctamente v&iacute;a %s.');

define('ERROR_REMOVE_DEFAULT_CURRENCY', 'Error: La moneda seleccionada por defecto no se puede eliminar. Seleccione otra moneda predeterminada y pruebe de nuevo.');
define('ERROR_CURRENCY_INVALID', 'Error: El tipo de cambio para %s (%s) no fue actualizado v&iacute;a %s. Se trata de un c&oacute;digo de moneda v&aacute;lido ?');
define('WARNING_PRIMARY_SERVER_FAILED', 'Advertencia: El tipo de cambio primario (%s) fallo por %s (%s) - probando el servidor de tipo de cambio secundario.');
?>
