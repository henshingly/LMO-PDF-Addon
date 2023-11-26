<?php
/** This file is part of PDF Addon for LMO 4.
  * Copyright © 2017 by Dietmar Kersting
  *
  * MINITABLE Addon for LigaManager Online (pdf-tabelle.php and pdf-spielplan.php)
  * Copyright © 2003 by Tim Schumacher
  * timme@uni.de /
  *
  * PDF Addon for LMO 4 für Spielplan (pdf-spielplan.php)
  * Copyright © by Torsten Hofmann V 2.0
  *
  * PDF Addon für LMO 4 is free software: you can redistribute it and/or modify
  * it under the terms of the GNU General Public License as published by
  * the Free Software Foundation, either version 3 of the License, or
  * (at your option) any later version.
  *
  * PDF Addon für LMO 4 is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  * GNU General Public License for more details.
  *
  * You should have received a copy of the GNU General Public License
  * along with PDF Addon für LMO 4.  If not, see <http://www.gnu.org/licenses/>.
  *
  * REMOVING OR CHANGING THE COPYRIGHT NOTICES IS NOT ALLOWED!
  *
  * Diese Datei ist Teil des PDF Addon für LMO 4.
  *
  * PDF Addon für LMO 4 ist Freie Software: Sie können es unter den Bedingungen
  * der GNU General Public License, wie von der Free Software Foundation,
  * Version 3 der Lizenz oder (nach Ihrer Wahl) jeder späteren
  * veröffentlichten Version, weiterverbreiten und/oder modifizieren.
  *
  * PDF Addon für LMO 4 wird in der Hoffnung, dass es nützlich sein wird, aber
  * OHNE JEDE GEWÄHRLEISTUNG, bereitgestellt; sogar ohne die implizite
  * Gewährleistung der MARKTFÄHIGKEIT oder EIGNUNG FÜR EINEN BESTIMMTEN ZWECK.
  * Siehe die GNU General Public License für weitere Details.
  *
  * Sie sollten eine Kopie der GNU General Public License zusammen mit diesem
  * PDF Addon für LMO 4 erhalten haben. Wenn nicht, siehe <http://www.gnu.org/licenses/>.
  *
  * DAS ENTFERNEN ODER DIE ÄNDERUNG DER COPYRIGHT-HINWEISE IST NICHT ERLAUBT!
  */

if($lmtype==0 && $plan==1) {
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td align="center" width='50%'>
    </td>
    <td align="center" width='50%'>
<?php
  if (file_exists(PATH_TO_ADDONDIR."/pdf/pdf-teamplan.php")) {
?>
      <!-- Trigger the modal with a button -->
      <button type="button" class="custom-btn btn-pdf1" data-toggle="modal" data-target="#myModal_Schedule"><?php echo $text['pdf'][100]?></button>
      <!-- Modal -->
      <div class="modal fade" id="myModal_Schedule" tabindex="-1" role="dialog" aria-labelledby="pdfModalTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="pdfModalTitle"><?php echo $text['pdf'][206]?></h5>
              <button type="button" class="custom-btn btn-pdf1" data-dismiss="modal"><?php echo $text['pdf'][290]?></button>
            </div>
            <div class="modal-body">
              <embed src="<?php echo URL_TO_LMO."/addon/pdf/pdf-teamplan.php?file=".$file."&selteam=".$selteam?>" frameborder="0" width="100%" height="500px">
            </div>
          </div>
        </div>
      </div>
<?php
  }
?>    </td>
  </tr>
</table>
<?php
}
?>