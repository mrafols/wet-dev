<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'B&uacute;squeda avanzada');
define('NAVBAR_TITLE_2', 'Resultados de la b&uacute;squeda');

define('HEADING_TITLE_1', 'B&uacute;squeda avanzada');
define('HEADING_TITLE_2', 'Productos que coinciden con tus criterios');

define('HEADING_SEARCH_CRITERIA', 'Criterios de b&uacute;squeda');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Buscar en las descripciones de los productos');
define('ENTRY_CATEGORIES', 'Categorias:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Incluir Subcategorias');
define('ENTRY_MANUFACTURERS', 'Fabricante:');
define('ENTRY_PRICE_FROM', 'Precio Inicial:');
define('ENTRY_PRICE_TO', 'Precio Final:');
define('ENTRY_DATE_FROM', 'Fecha Inicial:');
define('ENTRY_DATE_TO', 'Fecha Final:');

define('TEXT_SEARCH_HELP_LINK', '<u>Ayuda de la b&uacute;squeda</u> [?]');

define('TEXT_ALL_CATEGORIES', 'Todas las categorias');
define('TEXT_ALL_MANUFACTURERS', 'Todos los fabricantes');

define('HEADING_SEARCH_HELP', 'Ayuda de la b&uacute;squeda');
define('TEXT_SEARCH_HELP', '<p>	Para obtener un mayor control sobre los resultados de la b&uacute;squeda, las palabras clave han de estar separadas por AND y/o OR:<br />
								Por ejemplo: <u>Latex AND vibracion</u> generar&iacute;a un resultado que contendr&iacute;a las dos palabras. <br />
								Sin embargo, para <u>Latex OR vibracion</u>, el resultado contendr&aacute; las dos o ninguna de las palabras.</p>
							<p> Las coincidencias exactas podr&aacute;n buscarse englobando las palabras a buscar entre comillas dobles ("):<br />
								Por ejemplo: <u>"juguete er&oacute;tico"</u> buscar&aacute; un resultado que contendra la cadena exacta.</p>
							<p> Los parentesis se podr&aacute;n usar para maximizar el control de los resultados.<br />
								Por ejemplo, <u>Vibracion AND (latex OR gelatina OR "actor")</u>.</p>');
define('TEXT_CLOSE_WINDOW', '<u>Cerrar ventana</u> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS', 'Nombre del Producto');
define('TABLE_HEADING_MANUFACTURER', 'Fabricante');
define('TABLE_HEADING_QUANTITY', 'Cantidad');
define('TABLE_HEADING_PRICE', 'Precio');
define('TABLE_HEADING_WEIGHT', 'Peso');
define('TABLE_HEADING_BUY_NOW', 'Compra ahora');

define('TEXT_NO_PRODUCTS', 'No hay productos que coincidan con &eacute;stos criterios.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Al menos has de rellenar uno de los campos del formulario de b&uacute;squeda.');
define('ERROR_INVALID_FROM_DATE', 'Fecha Inicial inv&aacute;lida.');
define('ERROR_INVALID_TO_DATE', 'Fecha Final inv&aacute;lida.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'Fecha final ha de ser superior o igual a Fecha incial.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Precio Inicial tiene que ser un n&uacute;mero.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Precio Final tiene que ser un n&uacute;mero.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Precio Final tiene que ser superior o igual al Precio Inicial.');
define('ERROR_INVALID_KEYWORDS', 'Palabras clave inv&aacute;lidas.');
?>
