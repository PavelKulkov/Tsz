<?php
	session_start();
	if($_SESSION['admin']){
		header("Location: /");
		exit;
	}


  $text ='  	<form method="post" action="/modules/auth/admin.php">
        <table>
          <tr>
            <td>Логин</td>
            <td><input type="text" name="login"/></td>
          </tr>
          <tr>
            <td>Пароль</td>
            <td><input type="password" name="password"/></td>
          </tr> 
          <tr>
            <td colspan="2"><input type="submit" name="submit" value="Отправить"/></td>
          </tr>                   
        </table>        
      </form>';
echo $text;
?>