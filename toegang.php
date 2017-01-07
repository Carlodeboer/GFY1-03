<?php
/**********************************************************************
  Authors : Carlo de Boer, Floris de Grip, Thijs Marschalk, Ralphine de Roo,
            Sophie Roos, Ian Vredenburg
  Date   : 07/01/17
  Copyright (C) 2017 MIT license
*******************************************************************/

// Controleert of de constante variabele 'toegang' bestaat. Zo niet, dan wordt de
// gebruiker doorgestuurd naar de 403-pagina. Deze variabele wordt gedeclareerd
// in bestanden waar gebruikers bij mogen komen. In bestanden waarvan het de
// bedoeling is dat ze alleen included worden, en dus niet direct toegankelijk
// mogen zijn, wordt 'toegang' niet gedefinieerd.
if(!defined('toegang')) {
   header("Location: 403.php");
   exit();
}
?>
