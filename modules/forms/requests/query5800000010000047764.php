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
          <wsZagsUs>
            <putZjvUs>
              <use>true</use>
              <zjv>
				<reservedNakhodka>without-sending-status</reservedNakhodka>
                <idZags><?php echo $_POST['id_agency_in']; ?></idZags>
                <email><?php echo $_POST['contact_email']; ?></email>
                <child>
                  <fio>
                    <fam><?php echo $_POST['child_last_name']; ?></fam>
                    <nam><?php echo $_POST['child_first_name']; ?></nam>
                    <otch><?php echo $_POST['child_middle_name']; ?></otch>
                  </fio>
                  <pol><?php echo $_POST['child_sex']; ?></pol>
                  <datRojd>
                    <?php $childBithDate = explode("-",$_POST['child_ident_birth_date']); ?>
                    <dtDay><?php echo $childBithDate[0]; ?></dtDay>
                    <dtMonth><?php echo $childBithDate[1]; ?></dtMonth>
                    <dtYear><?php echo $childBithDate[2]; ?></dtYear>
                  </datRojd>
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
                <?php 
                	if ($_POST['he_last_name'] != "")
                		require("zags/putZjvUs_peopUsl.php");
                	if ($_POST['she_last_name'] != "")
                		require("zags/putZjvUs_peopUsca.php");
                ?>
				
                <reshSud>
                  <reshen><?php echo $_POST['decision_law']; ?></reshen>
                  <?php 
                  	$datResh = explode("-",$_POST['decision_date']);
                  	echo "<datResh>".$datResh[2]."-".$datResh[1]."-".$datResh[0]."T00:00:00.000+04:00</datResh>";
                  ?>
                </reshSud>
                <docZB>
                  <num><?php echo $_POST['merried_doc_num']; ?></num>
                  <dat>
	                    <?php $docZB = explode("-",$_POST['merried_doc_date']); ?>
	                    <dtDay><?php echo $docZB[0]; ?></dtDay>
	                    <dtMonth><?php echo $docZB[1]; ?></dtMonth>
	                    <dtYear><?php echo $docZB[2]; ?></dtYear>
                  </dat>
                  <zgs><?php echo $_POST['merried_doc_source']; ?></zgs>
                </docZB>
                <zjvl><?php echo $_POST['declarant']; ?></zjvl>
                <?php 
                	if ($_POST['declarant'] == "ZIVL_AUTH"){
						$zjvlPerson = "<zjvlPerson>";
							$zjvlPerson .= "<fio>";
			                	$zjvlPerson .= "<fam>".$_POST['declarant_name']."</fam>";
	                        	$zjvlPerson .= "<nam>".$_POST['declarant_lastname']."</nam>";
	                        	$zjvlPerson .= "<otch>".$_POST['declarant_scndname']."</otch>";
							$zjvlPerson .= "</fio>";
							//$zjvlPerson .= "<pol>?</pol>";
							$zjvlPerson .= "<mestoLive>";
								$country = $_POST['gos'];
								if ($_POST['declarant_adress_hand'] == "on"){
									$state = $_POST['declarant_state'];
									$region = $_POST['declarant_region'];
									$settlement = $_POST['declarant_settlement'];
									$settlement_type = $_POST['declarant_settlement_type'];
									$street = $_POST['declarant_street'];
									$typeStr = $_POST['declarant_street_type'];
								}else{
									$state = $_POST['declarant_state_Rus'];
									$region = $_POST['declarant_settlementParent_Rus'];
									$settlement = $_POST['declarant_settlement_Rus'];
									$settlement_type = "";
									$street = $_POST['declarant_street_Rus'];
									$typeStr = "";
								}
								$city = $_POST['declarant_city'];

								$zjvlPerson .= "<gos>".$country."</gos>";
								$zjvlPerson .= "<subGos>".$state."</subGos>";
								$zjvlPerson .= "<rayon>".$region."</rayon>";
								$zjvlPerson .= "<gorod>".$city."</gorod>";
								$zjvlPerson .= "<nasPun>".$settlement."</nasPun>";
								$zjvlPerson .= "<typeNP>".$settlement_type."</typeNP>";
								$zjvlPerson .= "<street>".$street."</street>";
								$zjvlPerson .= "<typeStr>".$typeStr."</typeStr>";
								$zjvlPerson .= "<house>".$_POST['declarant_house']."</house>";
								$zjvlPerson .= "<korp>".$_POST['declarant_building']."</korp>";
								$zjvlPerson .= "<kvart>".$_POST['declarant_flat']."</kvart>";
								$zjvlPerson .= "<indMal>".$_POST['indMal']."</indMal>";
							$zjvlPerson .= "</mestoLive>";
						$zjvlPerson .= "</zjvlPerson>";
						echo $zjvlPerson;
					}
                ?>
                <timeQue>
					<datQue><?php echo $_POST['date']; ?></datQue>
					<typeQue>AZ_US</typeQue>
					<?php $hourTime = explode(":",$_POST['time']); ?>
					<hourQue><?php echo $hourTime[0]; ?></hourQue>
					<minQue><?php echo $hourTime[1]; ?></minQue>
					<namKabinet><?php echo $_POST['namKabinet']; ?></namKabinet>
				</timeQue>
              </zjv>
            </putZjvUs>
          </wsZagsUs>
        </ns2:AppData>
      </ns2:MessageData>
    </ns2:ZagsService>
  </S:Body>
</S:Envelope>