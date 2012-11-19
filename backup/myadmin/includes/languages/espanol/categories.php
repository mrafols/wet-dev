<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Categor&iacute;as / Productos');
define('HEADING_TITLE_SEARCH', 'Buscar:');
define('HEADING_TITLE_GOTO', 'Ir a:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categor&iacute;as / Productos');
define('TABLE_HEADING_ACTION', 'Acci&oacute;n');
define('TABLE_HEADING_STATUS', 'Estado');

define('TEXT_NEW_PRODUCT', 'Nuevo Producto en &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Categor&iacute;as:');
define('TEXT_SUBCATEGORIES', 'Subcategor&iacute;as:');
define('TEXT_PRODUCTS', 'Productos:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Precio:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Tipo Impuesto:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Valoraci&oacute;n Media:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Cantidad:');
define('TEXT_DATE_ADDED', 'A&ntilde;adido el:');
define('TEXT_DATE_AVAILABLE', 'Fecha Disponibilidad:');
define('TEXT_LAST_MODIFIED', 'Modificado el:');
define('TEXT_IMAGE_NONEXISTENT', 'NO EXISTE IMAGEN');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Inserte una nueva categor&iacute;a o producto en este nivel');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Si quiere mas informaci&iacute;n, visite la <a href="http://%s" target="blank"><u>p&aacute;gina</u></a> de este producto.');
define('TEXT_PRODUCT_DATE_ADDED', 'Este producto fue a&ntilde;adido a nuestro cat&aacute;logo el %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Este producto estar&aacute; disponible el %s.');

define('TEXT_EDIT_INTRO', 'Por favor realice los cambios necesarios');
define('TEXT_EDIT_CATEGORIES_ID', 'ID Categor&iacute;a:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nombre Categor&iacute;a:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Imagen Categor&iacute;a:');
define('TEXT_EDIT_SORT_ORDER', 'Orden:');

define('TEXT_INFO_COPY_TO_INTRO', 'Elija la categor&iacute;a hacia donde quiera copiar este producto');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Categor&iacute;as:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nueva Categor&iacute;a');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editar Categor&iacute;a');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Eliminar Categor&iacute;a');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Mover Categor&iacute;a');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Eliminar Producto');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Mover Producto');
define('TEXT_INFO_HEADING_COPY_TO', 'Copiar A');

define('TEXT_DELETE_CATEGORY_INTRO', 'Seguro que desea eliminar esta categor&iacute;a ?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Est&aacute; usted seguro que desea suprimir permanentemente este producto ?');

define('TEXT_DELETE_WARNING_CHILDS', '<strong>ADVERTENCIA:</strong> Hay %s categor&iacute;as que pertenecen a esta categor&iacute;a!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<strong>ADVERTENCIA:</strong> Hay %s productos en esta categor&iacute;a!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Elija la categor&iacute;a hacia donde quiera mover <strong>%s</strong>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Elija la categor&iacute;a hacia donde quiera mover <strong>%s</strong>');
define('TEXT_MOVE', 'Mover <strong>%s</strong> a:');

define('TEXT_NEW_CATEGORY_INTRO', 'Rellene la siguiente informaci&oacute;n para la nueva categor&iacute;a');
define('TEXT_CATEGORIES_NAME', 'Nombre categor&iacute;a:');
define('TEXT_CATEGORIES_IMAGE', 'Imagen categor&iacute;a:');
define('TEXT_SORT_ORDER', 'Orden:');

define('TEXT_PRODUCTS_STATUS', 'Estado de los Productos:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Fecha Disponibilidad:');
define('TEXT_PRODUCT_AVAILABLE', 'Disponible');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Agotado');
define('TEXT_PRODUCTS_MANUFACTURER', 'Fabricante del producto:');
define('TEXT_PRODUCTS_NAME', 'Nombre del Producto:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Descripci&oacute;n del producto:');
define('TEXT_PRODUCTS_QUANTITY', 'Cantidad:');
define('TEXT_PRODUCTS_MODEL', 'Modelo:');
define('TEXT_PRODUCTS_IMAGE', 'Imagen:');
define('TEXT_PRODUCTS_MAIN_IMAGE', 'Imagen Principal');
define('TEXT_PRODUCTS_LARGE_IMAGE', 'Imagen Grande');
define('TEXT_PRODUCTS_LARGE_IMAGE_HTML_CONTENT', 'Contenido HTML (para la ventana popup)');
define('TEXT_PRODUCTS_ADD_LARGE_IMAGE', 'Adicionar Imagen Grande');
define('TEXT_PRODUCTS_LARGE_IMAGE_DELETE_TITLE', 'Eliminar Imagen Grande ?');
define('TEXT_PRODUCTS_LARGE_IMAGE_CONFIRM_DELETE', 'Por favor confirme la eliminaci&oacute;n de la Imagen Grande.');
define('TEXT_PRODUCTS_URL', 'URL de los Productos:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sin http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Precio del Producto (Neto):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Precio del Producto (Bruto):');
define('TEXT_PRODUCTS_WEIGHT', 'Peso:');

define('EMPTY_CATEGORY', 'Categor&iacute;a vac&iacute;a');

define('TEXT_HOW_TO_COPY', 'M&eacute;todo de copia:');
define('TEXT_COPY_AS_LINK', 'Enlazar producto');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicar producto');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: No se pueden enlazar productos en la misma categor&iacute;a.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio de im&aacute;genes del cat&aacute;logo: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio de im&aacute;genes del cat&aacute;logo: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: La categor&iacute;a NO puede ser movida dentro de la categor&iacute;a hijo.');
?>
