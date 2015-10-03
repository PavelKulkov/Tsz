<?php 
      $soapAction = "\"urn:registerComplectRequest\"";
	  $responseSmevValidation = false;
	  $sign = false;
?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:q0="urn:bars-web-dou" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <soapenv:Body>
    <q0:registerComplectRequest>
      <q0:request>
        <q0:address>
          <?php
	$address = $_POST["street"].",".$_POST["housingNumber"].",".$_POST['address_block'].",".$_POST['address_flat'];
	echo "<q0:addressText>".htmlspecialchars($address)."</q0:addressText>\r\n";			
	$kladr = $_POST["kladr"];  
	if(intval($kladr)!==0){
	  echo "<q0:kladr>".$kladr."</q0:kladr>\r\n";
	}	
           ?>
            <q0:housingNumber><?php echo htmlspecialchars($_POST["housingNumber"]);?></q0:housingNumber>
            <?php
                  if(isset($_POST['address_block']) && $_POST['address_block']){
	echo "<q0:buildingNumber>".htmlspecialchars($_POST["address_block"])."</q0:buildingNumber>\r\n";
                  }
              ?>
               <?php
	if(isset($_POST['address_flat']) && $_POST['address_flat']){
	  echo "<q0:flatNumber>".htmlspecialchars($_POST['address_flat'])."</q0:flatNumber>\r\n";
    }
                ?>
          <q0:regAddressText><?php echo htmlspecialchars($_POST["reg_address"]);?></q0:regAddressText>					
          <q0:regKladr>56000000000</q0:regKladr>
        </q0:address>
        <q0:admissionDate><?php echo htmlspecialchars($_POST['year']."-09-01T00:00:00.000Z");?></q0:admissionDate>
        <q0:admissionDateType>asap</q0:admissionDateType>
        <q0:agent>
          <q0:identityDocument>
            <q0:information/>
            <q0:type><?php echo htmlspecialchars($_POST["delegate_dul_type"]);?></q0:type>
            <q0:series><?php echo htmlspecialchars($_POST["delegate_dul_series"]);?></q0:series>
            <q0:number><?php echo htmlspecialchars($_POST["delegate_dul_number"]);?></q0:number>
            <q0:date><?php echo htmlspecialchars($_POST["delegate_dul_date"]);?>T00:00:00.000Z</q0:date>
          </q0:identityDocument>
          <q0:name>
            <q0:firstName><?php echo htmlspecialchars($_POST["delegate_firstname"]);?></q0:firstName>
            <q0:lastName><?php echo htmlspecialchars($_POST["delegate_surname"]);?></q0:lastName>
            <q0:patronymic><?php echo htmlspecialchars($_POST["delegate_patronymic"]);?></q0:patronymic>
          </q0:name>
          <q0:type><?php echo($_POST["delegate_type"]);?></q0:type>
          <q0:contacts>
	<?php
	   if(isset($_POST['email'])){
	     echo "<q0:email>".htmlspecialchars($_POST['email'])."</q0:email>\r\n";
         echo "<q0:notifyByEMail>true</q0:notifyByEMail>\r\n";
	  }
     ?>
            <q0:phones>
              <q0:number><?php echo htmlspecialchars($_POST["phone_for_sms"]);?></q0:number>
              <q0:type>mobilesms</q0:type>
            </q0:phones>
          </q0:contacts>
        </q0:agent>
        <q0:child>
          <q0:birthday><?php echo htmlspecialchars($_POST["date_of_birth"]);?>T00:00:00.000Z</q0:birthday>
          <q0:identityDocument>
            <q0:series><?php echo htmlspecialchars($_POST["dul_series"]);?></q0:series>
            <q0:number><?php echo htmlspecialchars($_POST["dul_number"]);?></q0:number>
            <q0:date><?php echo htmlspecialchars($_POST["dul_date"]."T00:00:00.000Z");?></q0:date>
            <q0:type><?php echo htmlspecialchars($_POST["dul_type"]);?></q0:type>
          </q0:identityDocument>
          <q0:name>
            <q0:firstName><?php echo htmlspecialchars($_POST["first_name"]);?></q0:firstName>
            <q0:lastName><?php echo htmlspecialchars($_POST["surname"]);?></q0:lastName>
            <q0:patronymic><?php echo htmlspecialchars($_POST["patronymic"]);?></q0:patronymic>
          </q0:name>
          <q0:gender><?php echo htmlspecialchars($_POST["gender"]);?></q0:gender>
        </q0:child>
		<?php
		   if(isset($_POST['benefits'])&&$_POST['benefits']!==''){
		     $benefits = explode(',',$_POST['benefits']);
		     for($i=0;$i<count($benefits)-1;$i++){
		echo "<q0:benefits><q0:name>".htmlspecialchars($benefits[$i])."</q0:name></q0:benefits>\r\n";
			 }
		   }
		?>
		<?php
		   if(isset($_POST['listNeedsAndConditions'])&&$_POST['listNeedsAndConditions']!==''){
		echo "<q0:hasNeeds>".htmlspecialchars($_POST['listNeedsAndConditions'])."</q0:hasNeeds>\r\n";
		   }
		?>
		<?php
		   if(isset($_POST['listKindergardens'])&&$_POST['listKindergardens']!==''){
		     $listKindergardens = explode(',',$_POST['listKindergardens']);
		     for($i=0;$i<count($listKindergardens)-1;$i++){
		echo "<q0:kindergartens>".htmlspecialchars($listKindergardens[$i])."</q0:kindergartens>\r\n";
			 }
		   }
		?>		
        <q0:legalEventDate><?php echo(htmlspecialchars($nowTimeWithFormat));?></q0:legalEventDate>
      </q0:request>
    </q0:registerComplectRequest>
  </soapenv:Body>
  </soapenv:Envelope>