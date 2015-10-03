<?php
ini_set("display_errors", "On");

require_once("core/class/database/DB.class.php");
require_once("core/class/database/DBRegInfo.class.php");

require_once("core/class/logger/Logger.class.php");
require_once("core/class/global/Dumper.class.php");
require_once("core/class/auth/AuthHome.class.php");
require_once("core/class/auth/SecureFile.class.php");
require_once("core/class/database/DbException.class.php");
require_once("core/class/Modules/ModuleHome.class.php");
require_once("core/class/Template/TemplateHome.class.php");
require_once("core/class/Domens/DomenHome.class.php");

require_once("core/class/http/HttpRequest.class.php");
require_once("core/class/http/HttpSession.class.php");
require_once("core/class/http/HttpResponse.class.php");
require_once("core/class/menu/Menu.class.php");

require_once("core/class/Object.php");
require_once("core/class/AppController.php");
require_once("core/class/view/View.class.php");

?>