<?
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\Application;
Loc::loadMessages(__FILE__);
if(class_exists("vlad_d7")) return;
class vlad_d7 extends CModule
{
    var $MODULE_ID = "vlad.d7";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $MODULE_GROUP_RIGHTS = "Y";

    function vlad_d7()
    {
        $arModuleVersion = array();

        include(__DIR__."/version.php");

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];    
        $this->MODULE_NAME = "vlad.d7 – модуль с компонентом";
        $this->MODULE_DESCRIPTION = "После установки вы сможете пользоваться компонентом vlad_d7:date.current";
    }

    function InstallFiles()
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/vlad.d7/install/components",
                    $_SERVER["DOCUMENT_ROOT"]."/bitrix/components", true, true);
        return true;
    }

    function UnInstallFiles()
    {
    DeleteDirFilesEx("/local/components/vlad.d7");
        return true;
    }

    function isVersionD7() 
    {
		return CheckVersion(ModuleManager::getVersion("main"), "14.00.00");
    }
    
    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        if ($this->isVersionD7())
        {
           $this->InstallFiles();
            RegisterModule("vlad.d7");
            $APPLICATION->IncludeAdminFile("Установка модуля vlad.d7", $DOCUMENT_ROOT."/local/modules/vlad.d7/install/step.php");
        }
        else
        {
            $APPLICATION->ThrowExeption('Модуль не поддерживает D7');
        }
    }
    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        $content = Application::getInstance()->getContext();
        $request = $content->getRequest();
        if($request["step"] < 2)
        {
            $APPLICATION->IncludeAdminFile("Деинсталляция модуля vlad.d7", $DOCUMENT_ROOT."/local/modules/vlad.d7/install/unstep1.php");
        }
        elseif ($request["step"] == 2) {
            $this->UnInstallFiles();
            if($request['savefata'] != 'Y')
            {
                $this->UnInstallDB();
            }
            UnRegisterModule("vlad.d7");
            $APPLICATION->IncludeAdminFile("Деинсталляция модуля vlad.d7 (удаление таблиц)", $DOCUMENT_ROOT."/local/modules/vlad.d7/install/unstep2.php");
        }
    }
}
?>