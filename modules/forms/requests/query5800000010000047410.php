<?php 
	
	$soapAction = "urn:ZagsService";

?>

<S:Envelope xmlns:S="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
  <S:Body wsu:Id="body">
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
        <!-- <ns2:TestMsg>true</ns2:TestMsg>-->
      </ns2:Message>
      <ns2:MessageData>
        <ns2:AppData>
          <wsZagsPi>
            <putZjvPI>
              <use>true</use>
              <zjv>
				<reservedNakhodka>without-sending-status</reservedNakhodka>
                <idZags><?php echo $_POST['id_agency_in']; ?></idZags>
                <email><?php echo $_POST['contact_email']; ?></email>
                <peopDo>
                  <fio>
                    <fam><?php echo $_POST['declarant_last_name']; ?></fam>
                    <nam><?php echo $_POST['declarant_first_name']; ?></nam>
                    <otch><?php echo $_POST['declarant_middle_name']; ?></otch>
                  </fio>
                  <docum>
                    <nam><?php echo $_POST['declarant_ident_doc_type']; ?></nam>
                    <seria><?php echo $_POST['declarant_ident_doc_ser']; ?></seria>
                    <num><?php echo $_POST['declarant_ident_doc_num']; ?></num>
                    <dat>
                        <?php $docDate = explode("-",$_POST['declarant_ident_doc_date']); ?>
	                    <dtDay><?php echo $docDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $docDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $docDate[2]; ?></dtYear>
                    </dat>
                    <ovd><?php echo $_POST['declarant_ident_doc_source']; ?></ovd>
                  </docum>
                  <mestoLive>
	                   <?php
	                  		$country = $_POST['declarant_country'];
	                  		 if ($_POST['declarant_adress_input'] == "on"){
	                  		 	$state = $_POST['declarant_state'];
		                  		$region = $_POST['declarant_region'];
	                  		 	$settlement = $_POST['declarant_settlement'];
	                  		 	$settlement_type = $_POST['declarant_settlement_type'];
	                  		 	$street = $_POST['declarant_street'];
	                  		 	$typeStr = $_POST['declarant_street_type'];
	                  		 }else{
								$state = $_POST['declarant_stateKLADR'];
								$region = $_POST['declarant_settlementParentKLADR'];
								$settlement = $_POST['declarant_settlementKLADR'];
								$settlement_type = "";
								$street = $_POST['declarant_streetKLADR'];
								$typeStr = "";
							 }
							 $city = $_POST[''];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
	                    <street><?php echo $street; ?></street>
	                    <typeStr><?php echo $typeStr; ?></typeStr>
	                    <house><?php echo $_POST['declarant_house']; ?></house>
	                    <korp><?php echo $_POST['declarant_building']; ?></korp>
	                    <kvart><?php echo $_POST['declarant_flat']; ?></kvart>
	                    <indMal><?php echo $_POST['declarant_index']; ?></indMal>
                  </mestoLive>
                  <datRojd>
                  	<?php $docDate = explode("-",$_POST['declarant_birth_date']); ?>
	                <dtDay><?php echo $docDate[0]; ?></dtDay>
	                <dtMonth><?php echo $docDate[1]; ?></dtMonth>
	                <dtYear><?php echo $docDate[2]; ?></dtYear>
                  </datRojd>
                  <grajd>
                    <type>GRAJD_YES_GOS</type>
                    <gosRod><?php echo $_POST['declarant_citizenship']; ?></gosRod>
                  </grajd>
                  <nation><?php echo $_POST['declarant_nation']; ?></nation>
                  <mestoRojd>
	                  	<?php
	                  		$country = $_POST['declarant_birth_place_country'];
	                  		 if ($_POST['declarant_birth_place_input'] == "on"){
	                  		 	$state = $_POST['declarant_birth_place_state'];
		                  		$region = $_POST['declarant_birth_place_region'];
	                  		 	$settlement = $_POST['declarant_birth_place_settlement'];
	                  		 	$settlement_type = $_POST['declarant_birth_place_settlement_type'];
	                  		 }else{
								$state = $_POST['declarant_birth_place_stateKLADR'];
								$region = $_POST['declarant_birth_place_settlementParentKLADR'];
								$settlement = $_POST['declarant_birth_place_settlementKLADR'];
								$settlement_type = "";
							 }
							 $city = $_POST['declarant_birth_part_of_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </peopDo>
                <fioPo>
                  <fam><?php echo $_POST['person_new_last_name']; ?></fam>
                  <nam><?php echo $_POST['person_new_first_name']; ?></nam>
                  <otch><?php echo $_POST['person_new_middle_name']; ?></otch>
                </fioPo>
                <docRo>
                  <num><?php echo $_POST['birth_doc_num']; ?></num>
                  <dat>
                  	<?php $docDate = explode("-",$_POST['birth_doc_date']); ?>
	                <dtDay><?php echo $docDate[0]; ?></dtDay>
	                <dtMonth><?php echo $docDate[1]; ?></dtMonth>
	                <dtYear><?php echo $docDate[2]; ?></dtYear>
                  </dat>
                  <zgs><?php echo $_POST['birth_doc_org']; ?></zgs>
                </docRo>
                <prichPI><?php echo $_POST['change_name_reason']; ?></prichPI>
                <teleph><?php echo $_POST['contact_phone']; ?></teleph>
                <maritalStatus><?php echo $_POST['declarant_family_status']; ?></maritalStatus>
                <?php
                	if ($_POST['declarant_family_status'] != 'MS_NONE'){
						echo "<maritalStatusActInfo>";
							echo "<num>".$_POST['num_akt_status']."</num>";
							echo "<dat>";
								$actInfoRoDate = explode("-",$_POST['date_akt_status']);
								echo "<dtDay>".$actInfoRoDate[0]."</dtDay>";
								echo "<dtMonth>".$actInfoRoDate[1]."</dtMonth>";
								echo "<dtYear>".$actInfoRoDate[2]."</dtYear>";
							echo "</dat>";
							echo "<zgs>".$_POST['name_org_akt_status']."</zgs>";
						echo "</maritalStatusActInfo>";
					}
                ?>
                <?php
					if (($_POST['have_children'] == "on")&&($_POST['countChilds'] > 0)){
						echo "<childsInfo>";
		                for ($i=0; $i < $_POST['countChilds']; $i++) {
							echo "<item>";
								echo "<child>";
									echo "<fio>";
										echo "<fam>".$_POST['child_last_name_'.$i]."</fam>";
										echo "<nam>".$_POST['child_first_name_'.$i]."</nam>";
										echo "<otch>".$_POST['child_middle_name_'.$i]."</otch>";
									echo "</fio>";
									echo "<datRojd>";
										$childBirth = explode("-",$_POST['child_birthday_'.$i]);
										echo "<dtDay>".$childBirth[0]."</dtDay>";
										echo "<dtMonth>".$childBirth[1]."</dtMonth>";
										echo "<dtYear>".$childBirth[2]."</dtYear>";
									echo "</datRojd>";
								echo "</child>";
								echo "<actInfoRo>";
									echo "<num>".$_POST['num_akt_child_'.$i]."</num>";
									echo "<dat>";
								    	$actInfoRoDate = explode("-",$_POST['date_akt_child_'.$i]);
									    echo "<dtDay>".$actInfoRoDate[0]."</dtDay>";
									    echo "<dtMonth>".$actInfoRoDate[1]."</dtMonth>";
									    echo "<dtYear>".$actInfoRoDate[2]."</dtYear>";
								    echo "</dat>";
								    echo "<zgs>".$_POST['issue_akt_child_'.$i]."</zgs>";
								echo "</actInfoRo>";
							echo "</item>";
						}
						echo "</childsInfo>";
					}
				?>
                <timeQue>
					<datQue><?php echo $_POST['date']; ?></datQue>
					<typeQue>AZ_PI</typeQue>
					<?php $hourTime = explode(":",$_POST['time']); ?>
					<hourQue><?php echo $hourTime[0]; ?></hourQue>
					<minQue><?php echo $hourTime[1]; ?></minQue>
					<namKabinet><?php echo $_POST['namKabinet']; ?></namKabinet>
				</timeQue>
              </zjv>
            </putZjvPI>
          </wsZagsPi>
        </ns2:AppData>
      </ns2:MessageData>
    </ns2:ZagsService>
  </S:Body>
</S:Envelope>