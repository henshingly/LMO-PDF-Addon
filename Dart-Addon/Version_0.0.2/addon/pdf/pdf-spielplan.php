<?
/** Pdf Addon for LMO 4
  *
  * (c) by Tim Schumacher
  *
  * This program is free software; you can redistribute it and/or
  * modify it under the terms of the GNU General Public License as
  * published by the Free Software Foundation; either version 2 of
  * the License, or (at your option) any later version.
  *
  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
  * General Public License for more details.
  *
  * REMOVING OR CHANGING THE COPYRIGHT NOTICES IS NOT ALLOWED!
  *
  */
require_once(dirname(__FILE__).'/../../init.php');
require_once(PATH_TO_ADDONDIR."/pdf/ini.php");
$file = isset($_GET['file'])?$_GET['file']:'';
$sp=1; // Test Nur Spielplan anzeigen
$error = FALSE;
$protectRows = 30;
if ($file <> '') {
  $liga = new liga();
  if ($liga->loadFile(PATH_TO_LMO."/".$dirliga.$file)==TRUE) {
    $ligaName = $liga->name;
    $pdf = new Cezpdf();// &
    $pdf -> ezSetMargins(50,70,50,50);
    $pdf->selectFont('./classes/fonts/Helvetica.afm');
    $all = $pdf->openObject();
    $pdf->saveState();
    $pdf->setStrokeColor(0,0,0,1);
    $pdf->line(20,40,578,40);
    $pdf->line(20,822,578,822);
    $pdf->addText(50,34,6,PDF_VERSION);
    $pdf->addText(50,824,8,$liga->name);
    $pdf->restoreState();
    $pdf->closeObject();
    $pdf->addObject($all,'all');
    $partieOptions = array(
        'HTore'=>array('justification'=>'right'),
        'GTore'=>array('justification'=>'right')
        );
    $spTagOptions = array(
        'cols' => $partieOptions,
        'titleFontSize'=>10,
        'fontSize'=>8,
        'shaded' => 0,
        'protectRows'=> $protectRows
        );
    foreach($liga->spieltage as $spieltag) {
      $pdfSpieltag = array();
      foreach($spieltag->partien as $partie) {
        $pdfPartie=array(
//        "Datum"=>$partie->datumString(),
//        "Zeit"=>$partie->zeitString(),
        "Heim"=>$partie->heim->name,
        "Gast"=>$partie->gast->name,
//        "HTore"=>$partie->hToreString(''),
//        "GTore"=>$partie->gToreString('')
        );
      $pdfSpieltag[]=$pdfPartie;
      }
    $spTagOptions['protectRows'] = $spieltag->partienCount()<$protectRows ?
                                 $spieltag->partienCount():$protectRows;
    $pdf->ezTable($pdfSpieltag,"",$spieltag->nr.". Spieltag",$spTagOptions);
    }

  }
  else {
    $error=TRUE;
    $message = "Fehler beim Laden der Liga: $file";
    $ligaName= $message;
  }
}

if (!$error) {
  $pdf->ezStream();
}
 else {
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
          "http://www.w3.org/TR/html4/loose.dtd">
<html lang="de">
<head>
<title><?="Pdf Addon ($ligaName)"?></title>
</head>
<body>
<?=$message;?>
</body>
</html>
<?
}