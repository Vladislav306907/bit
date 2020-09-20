<?
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if(!check_bitrix_sessid()){

   return;
}

if($errorException = $APPLICATION->GetException())
{
  echo(CAdminMessage::ShowMessage(array(
      'MESSAGE' => Loc::getMessage("VLAD_D7_ERROR"),
      'TYPE' => 'ERROR',
      'DETAILS' => $errorException->GetString(),
      'HTML' => true
    )));
}
else
{
    echo(CAdminMessage::ShowNote(Loc::getMessage("VLAD_D7_STEP_BEFORE")." ".Loc::getMessage("VLAD_D7_STEP_AFTER")));
}
?>

<form action="<? echo($APPLICATION->GetCurPage()); ?>">
  <input type="hidden" name="lang" value="<? echo(LANG); ?>" />
 <input type="submit" value="<? echo(Loc::getMessage("VLAD_D7_STEP_SUBMIT_BACK")); ?>">
</form>