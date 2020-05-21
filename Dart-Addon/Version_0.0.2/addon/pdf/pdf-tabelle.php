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
$st = isset($_GET['st'])?$_GET['st']:1;
$sp = isset($_GET['sp'])?1:0; // gesammtSpielplan anzeigen
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
    // put a line top and bottom on all the pages
    $all = $pdf->openObject();
    $pdf->saveState();
    $pdf->setStrokeColor(0,0,0,1);
    $pdf->line(20,40,578,40);
    $pdf->line(20,822,578,822);
    $pdf->addText(50,34,6,PDF_VERSlON);
    $pdf->addText(50,824,8,$liga->name);
//    $pdf->ezText($liga->name,10,array('justification'=>'center'));
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

    $pos = 1;

    if ($sp == 0) { // Tabelle
      if($st<0) $st=1;
      $akt = isset($liga->options->keyValues['Actual'])?
        $liga->options->keyValues['Actual']:1;
      $st = $st==0 ?$akt:$st;
      $favTeamNr = isset($liga->options->keyValues['favTeam'])?
        $liga->options->keyValues['favTeam']:0;

      $table = $liga->calcTable($st);
      $keys = array_keys($table[0]);
      $pdfTable = array();
      $cols = array ( // Arraypos bestimmt auch die Spalte !
          "pos"=>'',
          "team"=>'Mannschaft',
          "spiele"=>'Spiele',
          "s"=> "s",
          "u"=> "u",
          "n"=> "n",
          "pTor"=> "+Tore",
          "mTor"=> "-Tore",
          "dTor"=> "Diff.",
          "pPkt"=> "+Pkt",
          "mPkt"=> "-Pkt"
          );
      $align =  array(
          'pos'=> array('justification'=>'right'),
          'pPkt'=> array('justification'=>'right'),
          'mPkt'=> array('justification'=>'right'),
          'pTor'=> array('justification'=>'right'),
          'mTor'=> array('justification'=>'right'),
          'dTor'=> array('justification'=>'right'),
          "spiele"=> array('justification'=>'right'),
          "s"=> array('justification'=>'right'),
          "u"=> array('justification'=>'right'),
          "n"=> array('justification'=>'right')
          );
      $pos = 1;
      foreach ($table as $tableRow) {
        $pdfTableRow = array();
        foreach ($keys as $key) {
          $pdfTableRow[$key] = $key == 'team' ?
            $tableRow[$key]->name : $tableRow[$key];
        }
        $pdfTableRow['pos'] = $pos++;
        $pdfTable[]  = $pdfTableRow;
      }
      $pdfAktuellerSpieltag = array();
      $spieltag=$liga->spieltagForNumber($st);
      foreach($spieltag->partien as $partie) {
        $pdfPartie=array(
          "Datum"=>$partie->datumString(),
          "Zeit"=>$partie->zeitString(),
          "Heim"=>$partie->heim->name,
          "Gast"=>$partie->gast->name,
          "HTore"=>$partie->hToreString(),
          "GTore"=>$partie->gToreString());
      $pdfAktuellerSpieltag[]=$pdfPartie;
      }
      $pdfSpieltag = array();
      $pdfPartie = array();
      $spieltag=$liga->spieltagForNumber($st+1);
      foreach($spieltag->partien as $partie) {
        $pdfPartie=array(
          "Datum"=>$partie->datumString(),
          "Zeit"=>$partie->zeitString(),
          "Heim"=>$partie->heim->name,
          "Gast"=>$partie->gast->name,
          "HTore"=>$partie->hToreString(),
          "GTore"=>$partie->gToreString());
        $pdfSpieltag[]=$pdfPartie;
      }
    }
    else if ($sp == 1) { // GesamtSpielplan
      foreach($liga->spieltage as $spieltag) {
        $pdfSpieltag = array();
        foreach($spieltag->partien as $partie) {
          $pdfPartie=array(
          "Datum"=>$partie->datumString(),
          "Zeit"=>$partie->zeitString(),
          "Heim"=>$partie->heim->name,
          "Gast"=>$partie->gast->name,
          "HTore"=>$partie->hToreString(''),
          "GTore"=>$partie->gToreString('')
          );
        $pdfSpieltag[]=$pdfPartie;
        }
      $spTagOptions['protectRows'] = $spieltag->partienCount()<$protectRows ?
                                   $spieltag->partienCount():$protectRows;
      $pdf->ezTable($pdfSpieltag,"",$spieltag->nr.". Spieltag",$spTagOptions);
      }
    }

  }
  else {
    $error=TRUE;
    $message = "Fehler beim Laden der Liga: $file";
    $ligaName= $message;
  }
}

if (!$error) {

//  $pdf =& new Cezpdf();
//  $pdf->selectFont('./classes/fonts/Helvetica.afm');
  if ($sp == 0) {
    $pdf->ezTable($pdfAktuellerSpieltag,"",$spieltag->nr.". Spieltag",$spTagOptions);
    $pdf->ezTable($pdfTable,$cols,$st.'.Spieltag '.$liga->name,
                                               array('cols'=>$align));
    $pdf->ezTable($pdfSpieltag,"",$spieltag->nr.". Spieltag",$spTagOptions);

  }

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