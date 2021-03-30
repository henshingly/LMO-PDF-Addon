# PDF-Addons
1<Einführung  >

Dieses PDF Addon Paket enthält den offiziellen GIT-Klon der R&OS PHP PDF-Klasse und 3 PDF Addons verschiedener Autoren

    1. <c:alink:https://github.com/rospdf/pdf-php/>ROS PHP Pdf creation class</c:alink>
        enthält die Source Dateien der PDF-Klasse
	   
    2. <c:alink:https://www.liga-manager-online.de/homepage/homepage/addons/pdf-spielplan.html>PDF Spielplan von timme</c:alink>
        enthält unter anderem die PDF Ausgabedateien pdf-spielplan.php und pdf-tabelle.php

    3. <c:alink:https://www.liga-manager-online.de/homepage/homepage/addons/teamplan.html>PDF Teamplan von plastic</c:alink>
        enthält unter anderem die PDF Ausgabedatei pdf-teamplan.php
	
    4. <c:alink:https://www.liga-manager-online.de/homepage/homepage/addons/teamvergleich.html>PDF Teamvergleich von plastic</c:alink>
        enthält unter anderem die PDF Ausgabedatei stats_viewp.php

Dieses Paket wurde von mir neu geschnürt um diverse festgestellte Bugs zu entfernen und die Möglichkeit der Sprachauswahl aller Dateien zu gewährleisten.
Außerdem wurde noch die Verwendbarkeit der Addons unter PHP7 getestet. Bei mir lief es auch unter PHP Version 7.3.3.
Ich muss außerdem zugeben das ich nicht den originalen <c:alink:https://www.liga-manager-online.de/homepage/homepage/download/>LMO 4.0.2a</c:alink>,
von der Webseite www.liga-manager-online.de, genommenhabe. Sondern den LMO mit PHP7 Unterstützung von meiner Webseite.
Also alle hier beschriebenen Einstellungen und Codeänderungen beziehen sich auf die <u>LMO_PHP7</u> Version.


1<Changelog>


3<3.0.5>
  17.03.2019
  - Dateiupdate der R&OS Klasse von 0.12.41 -> 0.12.49

3<3.0.3>
  03.08.2017
  - Dateiupdate der R&OS Klasse von 0.12.40 -> 0.12.41
  - sortierte Ausgabe der Partien eines Spieltages in pdf-tabelle.php und 
    pdf-spielplan.php (wenn in den Grundeistellungen des Ligenfiles dieses
    eingestellt wurde "->Datumssortierung<-". Ansonsten Ausgabe wie in der Adminansicht)

3<3.0.2>
  19.07.2017
  - Dateiupdate der R&OS Klasse von 0.12.39 -> 0.12.40
  - Ausgabe der Mannschaftsicon in den Tabellen und Spielplänen mittels
    "'<C:showimage:'.HTML_iconPDF($tableRow[$key]->name,'teams').' 11>'"
    "'<C:showimage:'.HTML_iconPDF($partie->gast->name,'teams').' 9>'" und 
    "'<C:showimage:'.HTML_iconPDF($partie->heim->name,'teams').' 9>'"
    und dem einfügen einer geänderten HTML_icon Funktion als function HTML_iconPDF()
    und einer function findImage() als function findImagePDF() in die ini.php.


3<3.0.1>
  08.07.2017
  - Dateiupdate der R&OS Klasse von 0.12.38 -> 0.12.39


3<3.0rc>
  28.04.2017
  - Einbindung aller einzelnen Addons in einer Addonoberfläche im Adminmenü
  - Anpassungen an PHP 7
  - Dateiupdate der R&OS PDF-Klasse von 0.11.6 -> 0.12.38


3<2.3>
  10.01.2013
  - Update der alten PDF-Klasse aus dem CSV-Download des LMO's. Von 0.0.9 -> 0.11.6


3<2.2>
  16.12.2012
  - Anpassungen der Originalen PDF Addons aus dem Forum des <c:alink:https://www.liga-manager-online.de/lmo-forum/>LMO</c:alink>.
#NP

1<R&OS PHP PDF Class>
Die R&OS Pdf-Klasse wird verwendet um PDF-Dokumente mit PHP zu erzeugen. Dabei werden keine zusätzlichen Module oder Erweiterungen installiert.
Die R&OS PDF-Klasse kommt mit einer Basisklasse namens "Cpdf.php". Zusätzlich noch mit einer Hilfs-Klasse "Cezpdf.php", um Tabellen zu generieren,
Hintergründe hinzuzufügen und Paging zu bieten.
Ich habe die aktuellste stabile Version in diesen Download integriert.
Die im CSV_LMO enthaltene PDF-Klasse ist schon ein sehr alter Vorläufer, mit der Versionnummer: 0.0.9.
Die neue Version unterstüzt nun auch UTF-8. Bzw. es werden nicht UTF-8 kodierte Strings bei Bedarf automatisch in UTF-8 umgewandelt.
Die neuen Dateien der Klasse überschreiben einige alte aus dem Download der CSV-Version des LMO's.


2<Installation>
Zur Installation des kompletten Pakets dieses zuerst einmal entpacken. Den entpackten Ordner "lmo_root" öffnen nun sollten dort einige Ordner zu sehen sein. Diese heißen -
  - addons
  - config
  - help
  - img
  - lang
alle Ordner kopieren und in das Hauptverzeichnis deines LMO's einfügen.
Es werden nur einige Schriftarten der alten PDF-Klasse von Wayne Munro, R&OS Ltd überschrieben.
Das PDF-ADDON ist nun integriert. Weiter geht es mit dem Einbinden der Designoberfläche, des PDF-ADDON, in das Adminmenü.


1<PDF-Design Oberfläche - Adminmenü>

2<Installation>

1. Zuerst einmal wurden alle Dateien schon in Dein LMO Hauptverzeichnis kopiert? Wenn Du diese Frage mit "JA" beantworten kannst dann geht es weiter.

2. Du öffnest mit einem Texteditor die Datei 
   - lmo-adminmain.php
Diese befindet sich im Hauptverzeichnis Deine's LMO's.

1. Änderung
Die Zeilen 206 - 210 sehen folgendermaßen aus.

    /*Viewer-Addon*/
    elseif($todo=="vieweroptions"){
      require(PATH_TO_ADDONDIR."/viewer/lmo-adminvieweroptions.php");
    }
    /*Viewer-Addon*/


unter die letzte Zeile
"/*Viewer-Addon*/"
fügst Du folgenden Code ein.


    /*PDF-Addon*/
    elseif($todo=="pdfoptions"){
      require(PATH_TO_ADDONDIR."/pdf/lmo-adminpdfoptions.inc.php");
    }
    /*PDF-Addon*/


danach sollte es so aussehen.


    /*Viewer-Addon*/
    elseif($todo=="vieweroptions"){
      require(PATH_TO_ADDONDIR."/viewer/lmo-adminvieweroptions.php");
    }
    /*Viewer-Addon*/
    /*PDF-Addon*/
    elseif($todo=="pdfoptions"){
      require(PATH_TO_ADDONDIR."/pdf/lmo-adminpdfoptions.inc.php");
    }
    /*PDF-Addon*/



2. Änderung
Nun zum nächsten Codeeinfügen. Es sind die Zeilen 150 - 152. Die sollten so aussehen.

    /*Viewer-Addon*/
    $viewer_addr_optionen = $_SERVER['PHP_SELF']."?action=admin&amp;todo=vieweroptions";
    /*Viewer-Addon*/


Darunter (<u>nach</u> "/*PDF-Addon*/") folgenden Code einfügen.


    /*PDF-Addon*/
    $pdf_addr_optionen = $_SERVER['PHP_SELF']."?action=admin&amp;todo=pdfoptions";
    /*PDF-Addon*/


der Codebereich sollte nun so aussehen.


    /*Viewer-Addon*/
    $viewer_addr_optionen = $_SERVER['PHP_SELF']."?action=admin&amp;todo=vieweroptions";
    /*Viewer-Addon*/
    /*PDF-Addon*/
    $pdf_addr_optionen = $_SERVER['PHP_SELF']."?action=admin&amp;todo=pdfoptions";
    /*PDF-Addon*/


3. Änderung
kommen wir nun zum letzten einfügen von PHP Code in der lmo-admimain.php.
Die Zeilen 104 - 106 sehen so aus.

    echo $text['viewer'][20];
  }
  /*Viewer-Addon*/


darunter nun den letzten Code einfügen. (wieder nach dem "/*Viewer-Addon*/")


  /*PDF-Addon*/
  echo "&nbsp;";
  if (($todo!="pdfoptions")){
    echo "<a href='{$adda}pdfoptions' onclick='return chklmolink();' title='{$text['pdf'][201]}'>{$text['pdf'][200]}</a>";
  } else {
    echo $text['pdf'][200];
  }
  /*PDF-Addon*/


der gesamte Codebereich sollte nun so aussehen.


    echo $text['viewer'][20];
  }
  /*Viewer-Addon*/
  /*PDF-Addon*/
  echo "&nbsp;";
  if (($todo!="pdfoptions")){
    echo "<a href='{$adda}pdfoptions' onclick='return chklmolink();' title='{$text['pdf'][201]}'>{$text['pdf'][200]}</a>";
  } else {
    echo $text['pdf'][200];
  }
  /*PDF-Addon*/


Das war es auch schon für diesen Teil mit den Änderungen im Code. Die oberen 3 Codeänderungen haben nun die Ansicht des Adminbereiches um einen neuen Menüpunkt erweitert.



1<PDF Spielplan>

Ermöglicht das Erstellen von Spielplänen im PDF-Format.
Nach der erfolreichen Einbindung erscheint unterhalb der Links 'Aktuellen Spieltag drucken' ein weiterer Link namens 'Spieltag als PDF-Dokument'.
Dieser zeigt den aktuellen Spieltag, die aktuelle Tabelle und den folgenden Spieltag in einer PDF Datei an.
Unter dem Link 'Ligaspielplan drucken' erscheint der Link 'Ligaspielplan als PDF-Dokument'.
Beim betätigen dieses Links erscheint eine Ausgabe aller Spieltage der Liga als PDF Datei.


2<Installation>

1. Zuerst einmal, du hast die Dateien aus der Installation der R&OS PHP PDF Class schon in Deinen LMO kopierst.

2. Nun öffnest Du die Datei
   - lmo-showmain2.php
Diese befindet sich im Hauptverzeichnis Deines LMO's.
Die Zeilen 244, 245 und 246 sehen folgendermaßen aus.


        $output_savehtml.=ob_get_contents();ob_end_clean();
  }
}


nach der ERSTEN schließenden Klammer "}" (Zeile 245) fügst Du folgenden Code ein.


  // PDF ADDON BEGIN
  if (file_exists(PATH_TO_ADDONDIR.'/pdf/lmo-showmain2.inc.php'))
  include(PATH_TO_ADDONDIR.'/pdf/lmo-showmain2.inc.php');
  // PDF ADDON END


danach sollte es so aussehen.



        $output_savehtml.=ob_get_contents();ob_end_clean();
  }
  // PDF ADDON BEGIN
  if (file_exists(PATH_TO_ADDONDIR.'/pdf/lmo-showmain2.inc.php'))
  include(PATH_TO_ADDONDIR.'/pdf/lmo-showmain2.inc.php');
  // PDF ADDON END
}


Das war es schon mit der Einbindung des PDF-Addon Spielplan



1<PDF Teamplan>

Ermöglicht die Ausgabe im Link Spielpläne des LMO in einer PDF Ausgabe.
Hier werden die gezeigten Partien (der ganzen Session) einer ausgewählten Mannschaft als PDF-Dokument dargestellt.
Nach der Installation erscheint unterhalb des Auswahlfensters 'Spielpläne' ein neuer Link 'Spielplan als PDF-Dokument'.

2<Installation>

1. Zuerst einmal, du hast die Dateien aus der Installation der R&OS PHP PDF Class schon in Deinen LMO kopierst.

2. Nun öffnest Du folgende Datei aus dem Hauptverzeichnis Deines LMO's
     - lmo-showprogram.php
nach die letzte Zeile (Zeile 161)

}?>


folgendes einfügen


<?php
// Teamplan ADDON BEGIN
if (file_exists(PATH_TO_ADDONDIR.'/pdf/lmo-showprogram.inc.php'))
include(PATH_TO_ADDONDIR.'/pdf/lmo-showprogram.inc.php');
// Teamplan ADDON END
?>


danach sollte es so aussehen.


}?>
<?php
// Teamplan ADDON BEGIN
if (file_exists(PATH_TO_ADDONDIR.'/pdf/lmo-showprogram.inc.php'))
include(PATH_TO_ADDONDIR.'/pdf/lmo-showprogram.inc.php');
// Teamplan ADDON END
?>

Das war es schon mit der Einbindung des PDF-Addon Teamplan
