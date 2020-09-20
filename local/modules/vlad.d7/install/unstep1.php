<?
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (!check_bitrix_sessid()){
    return;
}

if ($errorException = $APPLICATION->getException()) {
    // ошибка при удалении модуля
    echo(CAdminMessage::ShowMessage(array(
      'MESSAGE' => Loc::getMessage("VLAD_D7_UNINSTALL_FAILED"),
      'TYPE' => 'ERROR',
      'DETAILS' => $errorException->GetString(),
      'HTML' => true
    )));
} else {
    // модуль успешно удален
    CAdminMessage:showNote(
        Loc::getMessage('VLAD_D7_UNINSTALL_SUCCESS')
    );
}
?>

<form action="<?= $APPLICATION->getCurPage(); ?>"> <!-- Кнопка возврата к списку модулей -->
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID; ?>" />
    <input type="hidden" name="id" value="vlad.d7" />
    <input type="hidden" name="uninstall" value="2" />
    <input type="hidden" name="step" value="2" />
    <input type="submit" value="<?= Loc::getMessage('VLAD_D7_RETURN_MODULES'); ?>">
</form>