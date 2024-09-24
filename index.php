<?php
session_start();
?>
<?php
require_once 'config.php';
require_once 'database/connect_auth.php';
require_once 'database/connect_service.php';
require_once 'database/database.php';
require_once 'includes/phpmailer/PHPMailer.php';
require_once 'includes/phpmailer/SMTP.php';
require_once 'includes/phpmailer/Exception.php';
require_once 'includes/function.php';
require_once 'includes/session.php';
$module='_MODULE_DEFAULT';
$action='_ACTION_DEFAULT';


 if (!empty($_GET['module']))
 {
   if(is_string($_GET['module'])){
      $module=trim($_GET['module']);
   }
 }
 if (empty($_GET['module']))
 {
   $module='auth';
 }
 if (!empty($_GET['action']))
 {
   if(is_string($_GET['action'])){

      $action=trim($_GET['action']);
   }
 } 
 if(empty($_GET['action']))
 {
  $action='login';
 }
 $path='modules/'.$module.'/'.$action.'.php';
if(file_exists($path))
{
    require_once $path;
}
// else
// {
//     require_once '/module/error/404.php';
// }

?>


 