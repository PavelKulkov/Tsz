<?php
	$subservice_url_id = 88;
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
			<!-- <ns2:TestMsg>true</ns2:TestMsg> -->
		  </ns2:Message>
            <ns2:MessageData>
        <ns2:AppData>
          <wsZagsUo>
            <putZjvUO12>
              <use>true</use>
              <zjv>
				<reservedNakhodka>without-sending-status</reservedNakhodka>
								<idZags><?php echo $_POST['id_agency_in']; ?></idZags>
								<email><?php echo $_POST['contact_email']; ?></email>
                                <childDo>
                                    <fio>
                                        <fam><?php echo $_POST['child_after_last_name']; ?></fam>
                                        <nam><?php echo $_POST['child_after_first_name']; ?></nam>
                                        <otch><?php echo $_POST['child_after_middle_name']; ?></otch>
                                    </fio>
                                    <pol><?php echo $_POST['child_sex']; ?></pol>
									<datRojd>
										<?php $childBirth = explode("-",$_POST['child_birthDate']); ?>
										<dtDay><?php echo $childBirth[0]; ?></dtDay>
										<dtMonth><?php echo $childBirth[1]; ?></dtMonth>
										<dtYear><?php echo $childBirth[2]; ?></dtYear>
									</datRojd>
									  <mestoRojd>
										<?php
											$country = $_POST['child_country'];
											 if ($_POST['child_state_hand_input'] == "on"){
												$state = $_POST['child_state'];
												$region = $_POST['child_region'];
												$settlement = $_POST['child_settlement'];
												$settlement_type = $_POST['child_settlement_type'];
											 }else{
												$state = $_POST['child_region_kladr'];
												$region = $_POST['child_settlementParent_kladr'];
												$settlement = $_POST['child_settlement_kladr'];
												$settlement_type = "";
											 }
											 $city = $_POST['child_place'];
										?>
										<gos><?php echo $country; ?></gos>
										<subGos><?php echo $state; ?></subGos>
										<rayon><?php echo $region; ?></rayon>
										<gorod><?php echo $city; ?></gorod>
										<nasPun><?php echo $settlement; ?></nasPun>
										<typeNP><?php echo $settlement_type; ?></typeNP>
									  </mestoRojd>
                                </childDo>
                                <childFioPo>
                                    <fam><?php echo $_POST['child_before_last_name']; ?></fam>
                                    <nam><?php echo $_POST['child_before_first_name']; ?></nam>
                                    <otch><?php echo $_POST['child_before_middle_name']; ?></otch>
                                </childFioPo>
                                <fath>
                                    <fio>
                                        <fam><?php echo $_POST['declarant_father_last_name']; ?></fam>
                                        <nam><?php echo $_POST['declarant_father_first_name']; ?></nam>
                                        <otch><?php echo $_POST['declarant_father_middle_name']; ?></otch>
                                    </fio>
                                    <pol>MALE</pol>
                                    <docum>
                                        <nam><?php echo $_POST['declarant_father_doc_type']; ?></nam>
                                        <seria><?php echo $_POST['declarant_father_doc_ser']; ?></seria>
                                        <num><?php echo $_POST['declarant_father_doc_number']; ?></num>
                                        
										<?php $fatherDocDate = explode("-",$_POST['declarant_father_doc_date']); ?>
										<dat>
                                            <dtDay><?php echo $fatherDocDate[0]; ?></dtDay>
                                            <dtMonth><?php echo $fatherDocDate[1]; ?></dtMonth>
                                            <dtYear><?php echo $fatherDocDate[2]; ?></dtYear>
                                        </dat>
                                        <ovd><?php echo $_POST['declarant_father_doc_place']; ?></ovd>
                                    </docum>
									  <mestoLive>
										   <?php
												$country = $_POST['father_living_country'];
												 if ($_POST['father_living_isHand'] == "on"){
													$state = $_POST['father_living_state'];
													$region = $_POST['father_living_region'];
													$settlement = $_POST['father_living_settlement'];
													$settlement_type = $_POST['father_living_place'];
													$street = $_POST['father_living_street'];
													$typeStr = $_POST['father_living_street_type'];
												 }else{
													$state = $_POST['father_living_stateRus'];
													$region = $_POST['father_living_settlementParent_Rus'];
													$settlement = $_POST['father_settlement_Rus'];
													$settlement_type = "";
													$street = $_POST['father_living_streetRus'];
													$typeStr = "";
												 }
												 $city = $_POST['father_living_city'];
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
										<?php $fatherBirth = explode("-",$_POST['declarant_father_birth_date']); ?>
										<dtDay><?php echo $fatherBirth[0]; ?></dtDay>
										<dtMonth><?php echo $fatherBirth[1]; ?></dtMonth>
										<dtYear><?php echo $fatherBirth[2]; ?></dtYear>
									  </datRojd>
                                    <grajd>
                                        <type>GRAJD_YES_GOS</type>
                                        <gosRod><?php echo $_POST['declarant_father_citizenship']; ?></gosRod>
                                    </grajd>
                                    <nation><?php echo $_POST['declarant_father_nation']; ?></nation>
									  <mestoRojd>
										<?php
											$country = $_POST['father_birth_place_country'];
											 if ($_POST['father_birth_place_hand_input'] == "on"){
												$state = $_POST['father_birth_place_state'];
												$region = $_POST['father_birth_place_region'];
												$settlement = $_POST['father_birth_place_settlement'];
												$settlement_type = $_POST['father_birth_place_settlement_type'];
											 }else{
												$state = $_POST['father_birth_place_state_kladr'];
												$region = $_POST['father_birth_place_settlementParent_kladr'];
												$settlement = $_POST['father_birth_place_settlement_kladr'];
												$settlement_type = "";
											 }
											 $city = $_POST['father_birth_place_city'];
										?>
										<gos><?php echo $country; ?></gos>
										<subGos><?php echo $state; ?></subGos>
										<rayon><?php echo $region; ?></rayon>
										<gorod><?php echo $city; ?></gorod>
										<nasPun><?php echo $settlement; ?></nasPun>
										<typeNP><?php echo $settlement_type; ?></typeNP>
									  </mestoRojd>
                                </fath>
                                <docRo>
                                    <num><?php echo $_POST['birth_akt_num']; ?></num>
									
									<?php $birthName = explode("-",$_POST['birth_name']); ?>
									
                                    <dat>
                                        <dtDay><?php echo $birthName[0]; ?></dtDay>
                                        <dtMonth><?php echo $birthName[1]; ?></dtMonth>
                                        <dtYear><?php echo $birthName[2]; ?></dtYear>
                                    </dat>
                                    <zgs><?php echo $_POST['birth_zags']; ?></zgs>
                                </docRo>
                                <moth>
                                    <fio>
                                    <fam><?php echo $_POST['declarant_mother_last_name']; ?></fam>
                                    <nam><?php echo $_POST['declarant_mother_first_name']; ?></nam>
                                    <otch><?php echo $_POST['declarant_mother_middle_name']; ?></otch>
                                    </fio>
                                    <pol>FEMALE</pol>
                                    <docum>
                                        <nam><?php echo $_POST['declarant_mother_doc_type']; ?></nam>
                                        <seria><?php echo $_POST['declarant_mother_doc_ser']; ?></seria>
                                        <num><?php echo $_POST['declarant_mother_doc_number']; ?></num>
                                        
										<?php $motherDocDate = explode("-",$_POST['declarant_mother_doc_date']); ?>
										<dat>
                                            <dtDay><?php echo $motherDocDate[0]; ?></dtDay>
                                            <dtMonth><?php echo $motherDocDate[1]; ?></dtMonth>
                                            <dtYear><?php echo $motherDocDate[2]; ?></dtYear>
                                        </dat>
                                        <ovd><?php echo $_POST['declarant_mother_doc_place']; ?></ovd>
                                    </docum>
									  <mestoLive>
										   <?php
												$country = $_POST['mother_living_country'];
												 if ($_POST['mother_living_isHand'] == "on"){
													$state = $_POST['mother_living_state'];
													$region = $_POST['mother_living_region'];
													$settlement = $_POST['mother_living_settlement'];
													$settlement_type = $_POST['mother_living_place'];
													$street = $_POST['mother_living_street'];
													$typeStr = $_POST['mother_living_street_type'];
												 }else{
													$state = $_POST['mother_living_stateRus'];
													$region = $_POST['mother_living_settlementParent_Rus'];
													$settlement = $_POST['mother_settlement_Rus'];
													$settlement_type = "";
													$street = $_POST['mother_living_streetRus'];
													$typeStr = "";
												 }
												 $city = $_POST['mother_living_city'];
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
										<?php $motherBirth = explode("-",$_POST['declarant_mother_birth_date']); ?>
										<dtDay><?php echo $motherBirth[0]; ?></dtDay>
										<dtMonth><?php echo $motherBirth[1]; ?></dtMonth>
										<dtYear><?php echo $motherBirth[2]; ?></dtYear>
									  </datRojd>
                                    <grajd>
                                        <type>GRAJD_YES_GOS</type>
                                        <gosRod><?php echo $_POST['declarant_mother_citizenship']; ?></gosRod>
                                    </grajd>
                                    <nation><?php echo $_POST['declarant_mother_nation']; ?></nation>
									  <mestoRojd>
										<?php
											$country = $_POST['mother_birth_place_country'];
											 if ($_POST['mother_birth_place_hand_input'] == "on"){
												$state = $_POST['mother_birth_place_state'];
												$region = $_POST['mother_birth_place_region'];
												$settlement = $_POST['mother_birth_place_settlement'];
												$settlement_type = $_POST['mother_birth_place_settlement_type'];
											 }else{
												$state = $_POST['mother_birth_place_state_kladr'];
												$region = $_POST['mother_birth_place_settlementParent_kladr'];
												$settlement = $_POST['mother_birth_place_settlement_kladr'];
												$settlement_type = "";
											 }
											 $city = $_POST['mother_birth_place_city'];
										?>
										<gos><?php echo $country; ?></gos>
										<subGos><?php echo $state; ?></subGos>
										<rayon><?php echo $region; ?></rayon>
										<gorod><?php echo $city; ?></gorod>
										<nasPun><?php echo $settlement; ?></nasPun>
										<typeNP><?php echo $settlement_type; ?></typeNP>
									  </mestoRojd>
                                </moth>
								
								
								<?php $HourTime = explode(":",$_POST['time']); ?>
								<?php $NamZal = explode("|",$_POST['time']); ?>
									
								<timeQue>
									<datQue><?php echo $_POST['date']; ?></datQue>
									<typeQue>AZ_UO</typeQue>
									<hourQue><?php echo $HourTime[0]; ?></hourQue>
									<minQue><?php echo $HourTime[1]; ?></minQue>
									<namKabinet><?php echo $_POST['namKabinet']; ?></namKabinet>
								</timeQue>
              </zjv>
            </putZjvUO12>
          </wsZagsUo>
        </ns2:AppData>
      </ns2:MessageData>
    </ns2:ZagsService>
  </S:Body>
</S:Envelope>
