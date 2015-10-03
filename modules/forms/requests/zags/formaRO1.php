<?php
	$subservice_url_id = 49;
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
        <!--  <ns2:TestMsg>true</ns2:TestMsg>-->
      </ns2:Message>
      <ns2:MessageData>
        <ns2:AppData>
          <wsZagsRo>
            <putZjvRo1>
              <use>true</use>
              <zjv>
				<reservedNakhodka>without-sending-status</reservedNakhodka>
                <idZags><?php echo $_POST['id_agency_in']; ?></idZags>
                <email><?php echo $_POST['contact_email']; ?></email>
                <needActive>false</needActive>
                <child>
                  <fio>
                    <fam><?php echo $_POST['child_last_name']; ?></fam>
                    <nam><?php echo $_POST['child_first_name']; ?></nam>
                    <otch><?php echo $_POST['child_middle_name']; ?></otch>
                  </fio>
                  <pol><?php echo $_POST['child_sex']; ?></pol>
                  <datRojd>
                        <?php $childBirth = explode("-",$_POST['child_ident_birth_date']); ?>
	                    <dtDay><?php echo $childBirth[0]; ?></dtDay>
	                    <dtMonth><?php echo $childBirth[1]; ?></dtMonth>
	                    <dtYear><?php echo $childBirth[2]; ?></dtYear>
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
                <moth>
                  <fio>
                    <fam><?php echo $_POST['mother_last_name']; ?></fam>
                    <nam><?php echo $_POST['mother_first_name']; ?></nam>
                    <otch><?php echo $_POST['mother_middle_name']; ?></otch>
                  </fio>
                  <pol><?php echo 'FEMALE'; ?></pol>
                  <docum>
                    <nam><?php echo $_POST['mother_doc_type']; ?></nam>
                    <seria><?php echo $_POST['mother_doc_ser']; ?></seria>
                    <num><?php echo $_POST['mother_doc_number']; ?></num>
                    <dat>
                        <?php $motherDocData = explode("-",$_POST['mother_doc_date']); ?>
	                    <dtDay><?php echo $motherDocData[0]; ?></dtDay>
	                    <dtMonth><?php echo $motherDocData[1]; ?></dtMonth>
	                    <dtYear><?php echo $motherDocData[2]; ?></dtYear>
                    </dat>
                    <ovd><?php echo $_POST['mother_doc_place']; ?></ovd>
                  </docum>
                  <mestoLive>
                   <?php
                  		$country = $_POST['mother_living_country'];
                  		 if ($_POST['mother_living_isHand'] == "on"){
                  		 	$state = $_POST['mother_living_state'];
	                  		$region = $_POST['mother_living_region'];
                  		 	$settlement = $_POST['mother_living_settlement'];
                  		 	$settlement_type = $_POST['mother_living_place_type'];
                  		 	$street = $_POST['mother_living_street'];
                  		 	$typeStr = $_POST['mother_living_street_type'];
                  		 }else{
							$state = $_POST['mother_regionKLADR'];
							$region = $_POST['mother_cityParentKLADR'];
							$settlement = $_POST['mother_cityKLADR'];
							$settlement_type = "";
							$street = $_POST['mother_streetKLADR'];
							$typeStr = "";
						 }
						 $city = $_POST['mother_city'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                    <street><?php echo $street; ?></street>
                    <typeStr><?php echo $typeStr; ?></typeStr>
                    <house><?php echo $_POST['mother_living_house']; ?></house>
                    <korp><?php echo $_POST['mother_living_building']; ?></korp>
                    <kvart><?php echo $_POST['mother_living_flat']; ?></kvart>
                    <indMal><?php echo $_POST['mother_zipCode']; ?></indMal>
                  </mestoLive>
                  <datRojd>
                  	<?php $motherBirth = explode("-",$_POST['mother_birth_date']); ?>
                    <dtDay><?php echo $motherBirth[0]; ?></dtDay>
                    <dtMonth><?php echo $motherBirth[1]; ?></dtMonth>
                    <dtYear><?php echo $motherBirth[2]; ?></dtYear>
                  </datRojd>
                  <grajd>
                    <type>GRAJD_YES_GOS</type>
                    <gosRod><?php echo $_POST['mother_citizenship']; ?></gosRod>
                  </grajd>
                  <nation><?php echo $_POST['mother_nation']; ?></nation>
                  <mestoRojd>
                  	<?php
                  		$country = $_POST['mother_birth_place_country'];
                  		 if ($_POST['mother_birth_place_isHand'] == "on"){
                  		 	$state = $_POST['mother_birth_place_state'];
	                  		$region = $_POST['mother_birth_place_region'];
                  		 	$settlement = $_POST['mother_birth_place_settlement'];
                  		 	$settlement_type = $_POST['mother_birth_place_settlement_type'];
                  		 }else{
							$state = $_POST['mother_birth_stateKLADR'];
							$region = $_POST['mother_birth_settlementParentKLADR'];
							$settlement = $_POST['mother_birth_settlementKLADR'];
							$settlement_type = "";
						 }
						 $city = $_POST['mother_birth_PartCity'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </moth>
                <fath>
                  <fio>
                    <fam><?php echo $_POST['father_last_name']; ?></fam>
                    <nam><?php echo $_POST['father_first_name']; ?></nam>
                    <otch><?php echo $_POST['father_middle_name']; ?></otch>
                  </fio>
                  <docum>
                    <nam><?php echo $_POST['father_doc_type']; ?></nam>
                    <seria><?php echo $_POST['father_doc_ser']; ?></seria>
                    <num><?php echo $_POST['father_doc_number']; ?></num>
                    <dat>
	                  	<?php $fatherBirth = explode("-",$_POST['father_birth_date']); ?>
	                    <dtDay><?php echo $fatherBirth[0]; ?></dtDay>
	                    <dtMonth><?php echo $fatherBirth[1]; ?></dtMonth>
	                    <dtYear><?php echo $fatherBirth[2]; ?></dtYear>
                    </dat>
                    <ovd><?php echo $_POST['father_doc_place']; ?></ovd>
                  </docum>
                  <mestoLive>
	                   <?php
	                  		$country = $_POST['father_living_country'];
	                  		 if ($_POST['father_living_isHand'] == "on"){
	                  		 	$state = $_POST['father_living_state'];
		                  		$region = $_POST['father_living_region'];
	                  		 	$settlement = $_POST['father_living_settlement'];
	                  		 	$settlement_type = $_POST['father_living_place_type'];
	                  		 	$street = $_POST['father_living_street'];
	                  		 	$typeStr = $_POST['father_living_street_type'];
	                  		 }else{
								$state = $_POST['father_regionKLADR'];
								$region = $_POST['father_cityParentKLADR'];
								$settlement = $_POST['father_cityKLADR'];
								$settlement_type = "";
								$street = $_POST['father_streetKLADR'];
								$typeStr = "";
							 }
							 $city = $_POST['father_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
	                    <street><?php echo $street; ?></street>
	                    <typeStr><?php echo $typeStr; ?></typeStr>
	                    <house><?php echo $_POST['father_living_house']; ?></house>
	                    <korp><?php echo $_POST['father_living_building']; ?></korp>
	                    <kvart><?php echo $_POST['father_living_flat']; ?></kvart>
	                    <indMal><?php echo $_POST['father_zipCode']; ?></indMal>
                  </mestoLive>
                  <datRojd>
	                <?php $fatherBirth = explode("-",$_POST['father_birth_date']); ?>
	                <dtDay><?php echo $fatherBirth[0]; ?></dtDay>
	                <dtMonth><?php echo $fatherBirth[1]; ?></dtMonth>
	                <dtYear><?php echo $fatherBirth[2]; ?></dtYear>
                  </datRojd>
                  <grajd>
                    <type>GRAJD_YES_GOS</type>
                    <gosRod><?php echo $_POST['father_citizenship']; ?></gosRod>
                  </grajd>
                  <nation><?php echo $_POST['father_nation']; ?></nation>
                  <mestoRojd>
                  	<?php
                  		$country = $_POST['father_birth_place_country'];
                  		 if ($_POST['father_birth_place_isHand'] == "on"){
                  		 	$state = $_POST['father_birth_place_state'];
	                  		$region = $_POST['father_birth_place_region'];
                  		 	$settlement = $_POST['father_birth_place_settlement'];
                  		 	$settlement_type = $_POST['father_birth_place_settlement_type'];
                  		 }else{
							$state = $_POST['father_birth_stateKLADR'];
							$region = $_POST['father_birth_settlementParentKLADR'];
							$settlement = $_POST['father_birth_settlementKLADR'];
							$settlement_type = "";
						 }
						 $city = $_POST['father_birth_PartCity'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </fath>
                <?php 
                	if ($_POST['father_cause_doc_type'] == "Свидетельство о браке"){
						$typeDoc = "ZB";
					}else{
						if ($_POST['father_cause_doc_type'] == "Свидетельство об установлении отцовства"){
							$typeDoc = "UO";
						}
					} 
					$docDat = explode("-",$_POST['father_cause_doc_date']);
                ?>
                <doc<?php echo $typeDoc; ?>>
                  <num><?php echo $_POST['father_cause_doc_num']; ?></num>
                  <restored>false</restored>
                  <dat>
                    <dtDay><?php echo $docDat[0]; ?></dtDay>
                    <dtMonth><?php echo $docDat[1]; ?></dtMonth>
                    <dtYear><?php echo $docDat[2]; ?></dtYear>
                  </dat>
                  <zgs><?php echo $_POST['father_cause_doc_source']; ?></zgs>
                </doc<?php echo $typeDoc; ?>>
                                <?php 
                	if ($_POST['declarant'] == "ZJVL_PERS"){
						$zjvlPerson = "<zjvlPerson>";
							$zjvlPerson .= "<fio>";
			                	$zjvlPerson .= "<fam>".$_POST['surname_person']."</fam>";
	                        	$zjvlPerson .= "<nam>".$_POST['name_person']."</nam>";
	                        	$zjvlPerson .= "<otch>".$_POST['middle_person']."</otch>";
							$zjvlPerson .= "</fio>";
							$zjvlPerson .= "<pol>?</pol>";
							$zjvlPerson .= "<docum>";
								$zjvlPerson .= "<nam>".$_POST['type_doc_person']."</nam>";
								$zjvlPerson .= "<seria>".$_POST['ser_doc_person']."</seria>";
								$zjvlPerson .= "<num>".$_POST['num_doc_person']."</num>";
								$zjvlPerson .= "<dat>";
									$personDoc = explode("-",$_POST['date_doc_person']);
									$zjvlPerson .= "<dtDay>".$personDoc[0]."</dtDay>";
									$zjvlPerson .= "<dtMonth>".$personDoc[1]."</dtMonth>";
									$zjvlPerson .= "<dtYear>".$personDoc[2]."</dtYear>";
								$zjvlPerson .= "</dat>";
								$zjvlPerson .= "<ovd>".$_POST['issue_doc_person']."</ovd>";
							$zjvlPerson .= "</docum>";
							$zjvlPerson .= "<mestoLive>";

								$country = $_POST['count_person'];
								if ($_POST['enterhand'] == "on"){
									$state = $_POST['state_person_hand'];
									$region = $_POST['region_perso_hand'];
									$settlement = $_POST['loc_person_hand'];
									$settlement_type = $_POST['type_loc_hand'];
									$street = $_POST['street_person_hand'];
									$typeStr = $_POST['person_street_type'];
								}else{
									$state = $_POST['state_person'];
									$region = $_POST['region_person'];
									$settlement = $_POST['loc_person'];
									$settlement_type = "";
									$street = $_POST['street_person'];
									$typeStr = "";
								}
								$city = $_POST['person_city'];

								$zjvlPerson .= "<gos>".$country."</gos>";
								$zjvlPerson .= "<subGos>".$state."</subGos>";
								$zjvlPerson .= "<rayon>".$region."</rayon>";
								$zjvlPerson .= "<gorod>".$city."</gorod>";
								$zjvlPerson .= "<nasPun>".$settlement."</nasPun>";
								$zjvlPerson .= "<typeNP>".$settlement_type."</typeNP>";
								$zjvlPerson .= "<street>".$street."</street>";
								$zjvlPerson .= "<typeStr>".$typeStr."</typeStr>";
								$zjvlPerson .= "<house>".$_POST['house_person']."</house>";
								$zjvlPerson .= "<korp>".$_POST['building_person']."</korp>";
								$zjvlPerson .= "<kvart>".$_POST['flat_person']."</kvart>";
								//$zjvlPerson .= "<indMal>".$_POST['']."</indMal>";
							$zjvlPerson .= "</mestoLive>";
						$zjvlPerson .= "</zjvlPerson>";
						echo $zjvlPerson;
					}
                ?>
                <zjvl><?php echo $_POST['declarant']; ?></zjvl>
                <timeQue>
					<datQue><?php echo $_POST['que_date']; ?></datQue>
					<typeQue>AZ_RO</typeQue>
					<?php $hourTime = explode(":",$_POST['que_time']); ?>
					<hourQue><?php echo $hourTime[0]; ?></hourQue>
					<minQue><?php echo $hourTime[1]; ?></minQue>
					<namKabinet><?php echo $_POST['namKabinet']; ?></namKabinet>
				</timeQue>
              </zjv>
            </putZjvRo1>
          </wsZagsRo>
        </ns2:AppData>
      </ns2:MessageData>
    </ns2:ZagsService>
  </S:Body>
</S:Envelope>