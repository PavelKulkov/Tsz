<?php
	session_start();
	if($_SESSION['admin']){
		header("Location: /");
		exit;
	}


  $text ='  	<form method="post" action="/modules/auth/admin.php">
        <table>
          <tr>
            <td>�����</td>
            <td><input type="text" name="login"/></td>
          </tr>
          <tr>
            <td>������</td>
            <td><input type="password" name="password"/></td>
          </tr> 
          <tr>
            <td colspan="2"><input type="submit" name="submit" value="���������"/></td>
          </tr>                   
        </table>        
      </form>';
echo $text;
?>