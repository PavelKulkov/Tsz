<?php
	$soapAction = "urn:ZagsService";
?>

<S:Envelope xmlns:S="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
  <S:Body>
    <ns2:ZagsService xmlns:ns2="http://smev.gosuslugi.ru/rev120315" xmlns:ns3="http://idecs.nvg.ru/privateoffice/ws/types/" xmlns:ns4="http://wsService.zags.com/" xmlns:typ="http://idecs.nvg.ru/privateoffice/ws/types/">
      <ns2:Message>
        <ns2:Sender>
        	<ns2:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></ns2:Code>
            <ns2:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></ns2:Name>
        </ns2:Sender>
        <ns2:Recipient>
          <ns2:Code>210401581</ns2:Code>
          <ns2:Name>Находка-Загс Портал Пензенской области</ns2:Name>
        </ns2:Recipient>
        <ns2:Originator>
             <ns2:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></ns2:Code>
              <ns2:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></ns2:Name>
        </ns2:Originator>
        <ns2:ServiceName>Запрос в орган ЗАГС</ns2:ServiceName>
        <ns2:TypeCode>GFNC</ns2:TypeCode>
        <ns2:Status>REQUEST</ns2:Status>
        <ns2:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></ns2:Date>
        <ns2:ExchangeType>2</ns2:ExchangeType>
        <ns2:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></ns2:RequestIdRef>
        <ns2:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></ns2:OriginRequestIdRef>
        <ns2:ServiceCode>000000001</ns2:ServiceCode>
        <ns2:CaseNumber><?php echo(htmlspecialchars($idRequest));?></ns2:CaseNumber>
      </ns2:Message>
      <ns2:MessageData>
        <ns2:AppData>
          <wsZagsIstreb>
            <putZjvIstrebRo>
              <use>true</use>
              <zjv>
				<reservedNakhodka>without-sending-status</reservedNakhodka>
				<?php 
                	require("zjvIstreb.php");
                ?>
                <child>
                  <fio>
                    <fam><?php echo $_POST['fam_child']; ?></fam>
                    <nam><?php echo $_POST['name_child']; ?></nam>
                    <otch><?php echo $_POST['otch_child']; ?></otch>
                  </fio>
                  <datRojdN>
                    <?php 
	                	if ($_POST['date_true_ro'] == 'true'){
	                       	$datRojdN = explode("-",$_POST['birthday_child']);
	                    }else{
	                       	$datRojdN = explode("-",$_POST['birthday_s']);
	                    }
                    ?>
                    <dtDay><?php echo $datRojdN[0]; ?></dtDay>
                    <dtMonth><?php echo $datRojdN[1]; ?></dtMonth>
                    <dtYear><?php echo $datRojdN[2]; ?></dtYear>
                  </datRojdN>
                  <datRojdK>
					<?php $datRojdK = explode("-",$_POST['birthday_po']); ?>
                    <dtDay><?php echo $datRojdK[0]; ?></dtDay>
                    <dtMonth><?php echo $datRojdK[1]; ?></dtMonth>
                    <dtYear><?php echo $datRojdK[2]; ?></dtYear>
                  </datRojdK>
                  <mestoRojd>
                    <?php
                  		$country = $_POST['child_country'];
                  		 if ($_POST['ifHandInput'] == "on"){
                  		 	$state = $_POST['child_state'];
	                  		$region = $_POST['child_region'];
                  		 	$settlement = $_POST['child_settlement'];
                  		 	$settlement_type = $_POST['child_settlement_type'];
                  		 }else{
							$state = $_POST['child_stateKLADR'];
							$region = $_POST['child_settlementParentKLADR'];
							$settlement = $_POST['child_settlementKLADR'];
							$settlement_type = "";
						 }
						 $city = $_POST['childPartCity'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </child>
                <fathFio>
                  <fam><?php echo $_POST['fam_otec']; ?></fam>
                  <nam><?php echo $_POST['name_otec']; ?></nam>
                  <otch><?php echo $_POST['otch_otec']; ?></otch>
                </fathFio>
                <mothFio>
                  <fam><?php echo $_POST['fam_mather']; ?></fam>
                  <nam><?php echo $_POST['name_mather']; ?></nam>
                  <otch><?php echo $_POST['otch_mather']; ?></otch>
                </mothFio>
                <timeQue>
					<datQue><?php echo $_POST['date']; ?></datQue>
					<typeQue>AZ_ISTREB</typeQue>
					<?php $hourTime = explode(":",$_POST['time']); ?>
					<hourQue><?php echo $hourTime[0]; ?></hourQue>
					<minQue><?php echo $hourTime[1]; ?></minQue>
					<namKabinet><?php echo $_POST['namKabinet']; ?></namKabinet>
				</timeQue>
              </zjv>
            </putZjvIstrebRo>
          </wsZagsIstreb>
        </ns2:AppData>
      </ns2:MessageData>
    </ns2:ZagsService>
  </S:Body>
</S:Envelope>