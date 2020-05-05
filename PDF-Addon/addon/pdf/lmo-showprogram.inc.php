<?php
/** This file is part of Pdf Addon for LMO 4.
..* Copyright (C) 2017 by Dietmar Kersting
..*
..* MINITABLE Addon for LigaManager Online (pdf-tabelle.php and pdf-spielplan.php)
..* Copyright (C) 2003 by Tim Schumacher
..* timme@uni.de /
..*
..* Pdf Addon for LMO 4 für Spielplan (pdf-spielplan.php)
..* Copyright (C)  by Torsten Hofmann V 2.0
..*
..* Pdf Addon für LMO 4 is free software: you can redistribute it and/or modify
..* it under the terms of the GNU General Public License as published by
..* the Free Software Foundation, either version 3 of the License, or
..* (at your option) any later version.
..*
..* Pdf Addon für LMO 4 is distributed in the hope that it will be useful,
..* but WITHOUT ANY WARRANTY; without even the implied warranty of
..* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
..* GNU General Public License for more details.
..*
..* You should have received a copy of the GNU General Public License
..* along with Pdf Addon für LMO 4.  If not, see <http://www.gnu.org/licenses/>.
  *
  * REMOVING OR CHANGING THE COPYRIGHT NOTICES IS NOT ALLOWED!
..*
..* Diese Datei ist Teil des PDF Addon für LMO 4.
..*
..* Pdf Addon für LMO 4 ist Freie Software: Sie können es unter den Bedingungen
..* der GNU General Public License, wie von der Free Software Foundation,
..* Version 3 der Lizenz oder (nach Ihrer Wahl) jeder späteren
..* veröffentlichten Version, weiterverbreiten und/oder modifizieren.
..*
..* Pdf Addon für LMO 4 wird in der Hoffnung, dass es nützlich sein wird, aber
..* OHNE JEDE GEWÄHRLEISTUNG, bereitgestellt; sogar ohne die implizite
..* Gewährleistung der MARKTFÄHIGKEIT oder EIGNUNG FÜR EINEN BESTIMMTEN ZWECK.
..* Siehe die GNU General Public License für weitere Details.
..*
..* Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
..* Pdf Addon für LMO 4 erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>.
  *
  * DAS ENTFERNEN ODER DIE ÄNDERUNG DER COPYRIGHT-HINWEISE IST NICHT ERLAUBT!
**/

if($lmtype==0 && $plan==1) {
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td align="center" width='37%'></td>
    <td align="center"><?php 
if ($pdf_lmo_show_adobe_link<>0) { 
?><a target='_blank' href='https://get.adobe.com/reader/'><img src='<?php echo URL_TO_IMGDIR."/pdf/getadobe.png";?>' height='30' border=0 title='<?php echo $text['pdf'][12] ?>'></a><?php
  } else echo"&nbsp;";
?></td>
    <td align="center" width='37%'><?php
  if (file_exists(PATH_TO_ADDONDIR."/pdf/pdf-teamplan.php")) {
?><img src='<?php echo URL_TO_IMGDIR."/pdf/pdf.png' height='25' border='0' align='absmiddle'><a target='".$pdf_lmo_pdf_linktarget."' href='".URL_TO_LMO."/addon/pdf/pdf-teamplan.php?file=".$file."&selteam=".$selteam."' title='".$text['pdf'][101]."'>".$text['pdf'][100];?></a><?php
  }
?></td>
  </tr>
</table>
<?php 
}
?>