<?
/**
 * lmo-savehtml1.php: HTML-Ausgabe von Tabelle, aktuellem Spieltag und folgenden Spieltag
 * In der Datei lmo-savefile.php muss über der Zeile
 *  $datei = fopen($file,"w");
 *
 * folgende Zeile hinzugefügt werden:
 *
 *  include(PATH_TO_LMO."/lmo-savehtml1.php");
 *
 *
 * Autor: Bernd Hoyer, basierend auf dem LMO3.02
 * Verbesserungen, Bugs etc. bitte nur in das Forum bei Hollwitz.net
 *
 */


if($st>0){$actual=$anzst;}else{$actual=$stx;}
if($lmtype==0){
        for($i1=0;$i1<$anzsp;$i1++){
                if ($goala[$actual-1][$i1]=="-1") $goala[$actual-1][$i1]="_";
                if ($goalb[$actual-1][$i1]=="-1") $goalb[$actual-1][$i1]="_";
        }
        $endtab=$actual;
        include_once(PATH_TO_LMO."/lmo-calctable.php");

        for($i1=0;$i1<$anzsp;$i1++){
                if ($goala[$actual-1][$i1]=="_") $goala[$actual-1][$i1]="-1";
                if ($goalb[$actual-1][$i1]=="_") $goalb[$actual-1][$i1]="-1";
        }
}
if($lmtype==0){
        isset($tab0) ? $table1=$tab0 : $table1=$tab1;
  if (isset($table1)) {
    $wmlfile= fopen(PATH_TO_LMO.'/'.$diroutput.basename($file)."-sp.html","wb");
                ob_start();
                ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
                                        "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title><?=$titel?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" >
  <style type="text/css">
   body {background:#fff; color:#000; font-size: 0.9em;padding:auto;max-width:800px;}
   caption, p, h1 {margin: 3pt auto; text-align:center;}
   table {margin-left:5px; border:1pt solid #000; float:left; width:48%;}
   td {padding: 0; white-space:nowrap;}
   th {border-bottom: 1px solid #000;}
   h1 {font:14pt bolder;}
   caption {font-weight:bolder;white-space:nowrap;}
  </style>

  </head>
<body>

<a href="javascript:location.reload(true)">Jetzt neu laden</a>


  <h1><?=$titel?></h1>
  <?
                for ($y1=1;$y1<$anzst+1;$y1++) {
      $datumanz=$y1-1;
      $z=array_filter($teama[$y1-1],"filterZero");
      if (!empty($z)) {?>
    <table>
          <caption><?=$y1?>.  <?=$text[2]?><?if ($datum1[$datumanz]!='') { echo ' - '.$datum1[$datumanz].' '.$text[4].' '.$datum2[$datumanz];}?></caption><?
        $datsort= $mterm[$y1-1];
        asort($datsort);
        reset($datsort);
        while (list ($key, $val) = each ($datsort)) {
        $i1=$key;
        if(($teama[$y1-1][$i1]>0) && ($teamb[$y1-1][$i1]>0)){
                            $heimteam=$teams[$teama[$y1-1][$i1]];
                            $gastteam=$teams[$teamb[$y1-1][$i1]];

                            // * Spielfrei-Hack-Beginn1        - Autor: Bernd Hoyer - eMail: info@salzland-info.de
                            if (($anzteams-($anzst/2+1))!=0){
                              $spielfreiaa[$i1]=$teama[$y1-1][$i1];
                              $spielfreibb[$i1]=$teamb[$y1-1][$i1];
                            }
                            // * Spielfrei-Hack-Ende1- Autor: Bernd Hoyer - eMail: info@salzland-info.de
                            if($mterm[$y1-1][$i1]>0){$dum1=strftime($datf, $mterm[$y1-1][$i1]);}else{$dum1="";} // Anstosszeit einblenden
                        ?>
            <tr>
       <td align="right"><?=$heimteam?></td>
       <td>-</td>
       <td><?=$gastteam?></td>
       <?
      if ($msieg[$y1-1][$i1]==3){ ?>
        <?
      }?>
     </tr><?
                  }                }
                  $actual=$actual+1;
                }
    if (!empty($z)) {?>
        </table>
  <?}
    if (($anzteams-($anzst/2+1))!=0){
                        $spielfreicc=array_merge($spielfreiaa,$spielfreibb);
                        unset($spielfreiaa);
                        unset($spielfreibb);
                        $i=1;
                        for ($j=1;$j<$anzteams+1;$j++) {
                        if (!in_array($j,$spielfreicc)) {
                          if ($i==1) {?>
                                <p><small><?=$text[4004]?>: <?
        }
        echo $teams[$j]?>&nbsp;&nbsp;<?
                          $i++;
                  }
                }?>
        </small></p><?
                unset($spielfreicc);
        }
 }
  $datumanz=$actual-1;?>




</body>
</html><?}
    fwrite($wmlfile,ob_get_contents());
    ob_end_clean();
                fclose($wmlfile);

}
?>