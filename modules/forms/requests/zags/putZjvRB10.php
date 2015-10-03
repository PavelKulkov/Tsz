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
          <wsZagsRb>
            <putZjvRB10>
              <use>true</use>
              <zjv>
				<reservedNakhodka>without-sending-status</reservedNakhodka>
                <idZags><?php echo $_POST['id_agency_in']; ?></idZags>
                <email><?php echo $_POST['contact_email']; ?></email>
                <needActive>false</needActive>
                <heFamPosle><?php echo $_POST['he_last_name_notmerried']; ?></heFamPosle>
                <sheFamPosle><?php echo $_POST['she_last_name_notmerried']; ?></sheFamPosle>
                <he>
                  <fio>
                    <fam><?php echo $_POST['he_last_name_merried']; ?></fam>
                    <nam><?php echo $_POST['he_first_name']; ?></nam>
                    <otch><?php echo $_POST['he_middle_name']; ?></otch>
                  </fio>
                  <pol>MALE</pol>
                  <docum>
                    <nam><?php echo $_POST['he_doc_type']; ?></nam>
                    <seria><?php echo $_POST['he_doc_ser']; ?></seria>
                    <num><?php echo $_POST['he_doc_number']; ?></num>
                    <dat>
                        <?php $heDocumDate = explode("-",$_POST['he_doc_date']); ?>
	                    <dtDay><?php echo $heDocumDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $heDocumDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $heDocumDate[2]; ?></dtYear>
                    </dat>
                    <ovd><?php echo $_POST['he_doc_place']; ?></ovd>
                  </docum>
                  <mestoLive>
	                   <?php
	                  		$country = $_POST['groom_country'];
	                  		 if ($_POST['groom_input'] == "on"){
	                  		 	$state = $_POST['groom_state'];
		                  		$region = $_POST['groom_region'];
	                  		 	$settlement = $_POST['groom_settlement'];
	                  		 	$settlement_type = $_POST['groom_place'];
	                  		 	$street = $_POST['groom_street'];
	                  		 	$typeStr = $_POST['groom_street_type'];
	                  		 }else{
								$state = $_POST['groom_stateKLADR'];
								$region = $_POST['groom_settlementParentKLADR'];
								$settlement = $_POST['groom_settlementKLADR'];
								$settlement_type = "";
								$street = $_POST['groom_streetKLADR'];
								$typeStr = "";
							 }
							 $city = $_POST['groom_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
	                    <street><?php echo $street; ?></street>
	                    <typeStr><?php echo $typeStr; ?></typeStr>
	                    <house><?php echo $_POST['groom_house']; ?></house>
	                    <korp><?php echo $_POST['groom_building']; ?></korp>
	                    <kvart><?php echo $_POST['groom_flat']; ?></kvart>
	                    <indMal><?php echo $_POST['groom_index']; ?></indMal>
                  </mestoLive>
                  <datRojd>
                        <?php $heBirthDate = explode("-",$_POST['he_birth_date']); ?>
	                    <dtDay><?php echo $heBirthDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $heBirthDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $heBirthDate[2]; ?></dtYear>
                  </datRojd>
                  <grajd>
                    <type>GRAJD_YES_GOS</type>
                    <gosRod><?php echo $_POST['he_citizenship']; ?></gosRod>
                  </grajd>
                  <nation><?php echo $_POST['he_nation']; ?></nation>
                  <mestoRojd>
	                  	<?php
	                  		$country = $_POST['groom_birth_country'];
	                  		 if ($_POST['groom_adress_input'] == "on"){
	                  		 	$state = $_POST['groom_birth_state'];
		                  		$region = $_POST['groom_birth_region'];
	                  		 	$settlement = $_POST['groom_birth_settlement'];
	                  		 	$settlement_type = $_POST['groom_birth_place'];
	                  		 }else{
								$state = $_POST['groom_birth_stateKLADR'];
								$region = $_POST['groom_birth_settlementParentKLADR'];
								$settlement = $_POST['groom_birth_settlementKLADR'];
								$settlement_type = "";
							 }
							 $city = $_POST['groom_birth_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </he>
                <she>
                  <fio>
                    <fam><?php echo $_POST['she_last_name_merried']; ?></fam>
                    <nam><?php echo $_POST['she_first_name']; ?></nam>
                    <otch><?php echo $_POST['she_middle_name']; ?></otch>
                  </fio>
                  <pol>FEMALE</pol>
                  <docum>
                    <nam><?php echo $_POST['she_doc_type']; ?></nam>
                    <seria><?php echo $_POST['she_doc_ser']; ?></seria>
                    <num><?php echo $_POST['she_doc_number']; ?></num>
                    <dat>
                        <?php $heDocumDate = explode("-",$_POST['she_doc_date']); ?>
	                    <dtDay><?php echo $heDocumDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $heDocumDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $heDocumDate[2]; ?></dtYear>
                    </dat>
                    <ovd><?php echo $_POST['she_doc_place']; ?></ovd>
                  </docum>
                  <mestoLive>
	                   <?php
	                  		$country = $_POST['bride_country'];
	                  		 if ($_POST['bride_input'] == "on"){
	                  		 	$state = $_POST['bride_state'];
		                  		$region = $_POST['bride_region'];
	                  		 	$settlement = $_POST['bride_settlement'];
	                  		 	$settlement_type = $_POST['bride_place'];
	                  		 	$street = $_POST['bride_street'];
	                  		 	$typeStr = $_POST['bride_street_type'];
	                  		 }else{
								$state = $_POST['bride_stateKLADR'];
								$region = $_POST['bride_settlementParentKLADR'];
								$settlement = $_POST['bride_settlementKLADR'];
								$settlement_type = "";
								$street = $_POST['bride_streetKLADR'];
								$typeStr = "";
							 }
							 $city = $_POST['bride_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
	                    <street><?php echo $street; ?></street>
	                    <typeStr><?php echo $typeStr; ?></typeStr>
	                    <house><?php echo $_POST['bride_house']; ?></house>
	                    <korp><?php echo $_POST['bride_building']; ?></korp>
	                    <kvart><?php echo $_POST['bride_flat']; ?></kvart>
	                    <indMal><?php echo $_POST['bride_index']; ?></indMal>
                  </mestoLive>
                  <datRojd>
                        <?php $sheBirthDate = explode("-",$_POST['she_birth_date']); ?>
	                    <dtDay><?php echo $sheBirthDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $sheBirthDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $sheBirthDate[2]; ?></dtYear>
                  </datRojd>
                  <grajd>
                    <type>GRAJD_YES_GOS</type>
                    <gosRod><?php echo $_POST['she_citizenship']; ?></gosRod>
                  </grajd>
                  <nation><?php echo $_POST['she_nation']; ?></nation>
                  <mestoRojd>
	                  	<?php
	                  		$country = $_POST['bride_birth_country'];
	                  		 if ($_POST['bride_adress_input'] == "on"){
	                  		 	$state = $_POST['bride_birth_state'];
		                  		$region = $_POST['bride_birth_region'];
	                  		 	$settlement = $_POST['bride_birth_settlement'];
	                  		 	$settlement_type = $_POST['bride_birth_place'];
	                  		 }else{
								$state = $_POST['bride_birth_stateKLADR'];
								$region = $_POST['bride_birth_settlementParentKLADR'];
								$settlement = $_POST['bride_birth_settlementKLADR'];
								$settlement_type = "";
							 }
							 $city = $_POST['bride_birth_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </she>
                <docZB>
                  <num><?php echo $_POST['merried_akt_num']; ?></num>
                  <dat>
                        <?php $docZBDate = explode("-",$_POST['merried_akt_date']); ?>
	                    <dtDay><?php echo $docZBDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $docZBDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $docZBDate[2]; ?></dtYear>
                  </dat>
                  <zgs><?php echo $_POST['merried_akt_zags']; ?></zgs>
                </docZB>
                <reshSud>
                  <reshen><?php echo $_POST['name_law']; ?></reshen>
                  <?php 
                  	$datResh = explode("-",$_POST['decision_law_date']);
                  	echo "<datResh>".$datResh[2]."-".$datResh[1]."-".$datResh[0]."T00:00:00.000+03:00</datResh>";
                  ?>
                </reshSud>
                <zjvl><?php echo $_POST['declarant']; ?></zjvl>
                <?php 
                	if ($_POST['declarant'] == "ZJVL_PERSON"){
						$zjvlPerson = "<zjvlPerson>";
							$zjvlPerson .= "<fio>";
			                	$zjvlPerson .= "<fam>".$_POST['declarant_f']."</fam>";
	                        	$zjvlPerson .= "<nam>".$_POST['declarant_n']."</nam>";
	                        	$zjvlPerson .= "<otch>".$_POST['declarant_o']."</otch>";
							$zjvlPerson .= "</fio>";
							//$zjvlPerson .= "<pol>?</pol>";
							$zjvlPerson .= "<mestoLive>";
								$country = $_POST['gos'];
								if ($_POST['adress_input'] == "on"){
									$state = $_POST['subGos'];
									$region = $_POST['rayon'];
									$settlement = $_POST['declarant_city'];
									$settlement_type = $_POST['typeNP'];
									$street = $_POST['street'];
									$typeStr = $_POST['typeStr'];
								}else{
									$state = $_POST['subGosRus'];
									$region = $_POST['declarant_cityParentRus'];
									$settlement = $_POST['declarant_cityRus'];
									$settlement_type = "";
									$street = $_POST['streetRus'];
									$typeStr = "";
								}
								$city = $_POST['city'];

								$zjvlPerson .= "<gos>".$country."</gos>";
								$zjvlPerson .= "<subGos>".$state."</subGos>";
								$zjvlPerson .= "<rayon>".$region."</rayon>";
								$zjvlPerson .= "<gorod>".$city."</gorod>";
								$zjvlPerson .= "<nasPun>".$settlement."</nasPun>";
								$zjvlPerson .= "<typeNP>".$settlement_type."</typeNP>";
								$zjvlPerson .= "<street>".$street."</street>";
								$zjvlPerson .= "<typeStr>".$typeStr."</typeStr>";
								$zjvlPerson .= "<house>".$_POST['house']."</house>";
								$zjvlPerson .= "<korp>".$_POST['korp']."</korp>";
								$zjvlPerson .= "<kvart>".$_POST['kvart']."</kvart>";
								$zjvlPerson .= "<indMal>".$_POST['indMal']."</indMal>";
							$zjvlPerson .= "</mestoLive>";
						$zjvlPerson .= "</zjvlPerson>";
						echo $zjvlPerson;
					}
                ?>
                <timeQue>
					<datQue><?php echo $_POST['date']; ?></datQue>
					<typeQue>AZ_RB</typeQue>
					<?php $hourTime = explode(":",$_POST['time']); ?>
					<hourQue><?php echo $hourTime[0]; ?></hourQue>
					<minQue><?php echo $hourTime[1]; ?></minQue>
					<namKabinet><?php echo $_POST['namKabinet']; ?></namKabinet>
				</timeQue>
              </zjv>
            </putZjvRB10>
          </wsZagsRb>
        </ns2:AppData>
      </ns2:MessageData>
    </ns2:ZagsService>
  </S:Body>
</S:Envelope>