<?php
// PDF _ DRUCK BEGIN
if($lmtype==0 && $druck==1){
  ob_start();
  if($lmtype==0 && $druck==1){?>
  <table width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr><td align="center" width='37%'>
  </td>
  <td align="center">
  <?php if ($pdf_show_adobe_link<>0) { ?>
  <a target='_blank' href='http://www.adobe.com'><img src='
  <?php echo URL_TO_ADDONDIR."/pdf/img/getacro.gif";?>' border=0></a>
  <?php }else echo"&nbsp;";?>

  </td>
        <td align="center" width='37%'>
        <?php
  if (file_exists(PATH_TO_ADDONDIR."/pdf/pdf-spielplan.php")) {?>
  <a target='<?=$pdf_linktarget?>' href='<?=URL_TO_LMO?>/addon/pdf/pdf-spielplan.php?file=<?=$file?>' title='<?php echo $text['pdf'][1]?>'>
  <?php echo $text['pdf'][0]?></a><?php
  }
  ?>
        </td>
      </tr>
  </table>
<?php }
  $output_savehtml.=ob_get_contents();ob_end_clean();
}
