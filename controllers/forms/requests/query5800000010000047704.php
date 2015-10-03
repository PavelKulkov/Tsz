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
        <!--  <ns2:TestMsg>true</ns2:TestMsg>-->
      </ns2:Message>
      <ns2:MessageData>
        <ns2:AppData>
          <wsZagsSm>
            <putZjvSm>
              <use>true</use>
              <zjv>
                <requestHeader>
                  <typ:authToken>NAKHODKA:530-fdlpw0-49jbsx00dp:20310101</typ:authToken>
                  <typ:requestId>0e027230-da41-4eb9-a03d-4894bd05e7f8</typ:requestId>
                </requestHeader>
                <idZags><?php echo $_POST['id_agency_in']; ?></idZags>
                <email><?php echo $_POST['contact_email']; ?></email>
                <um>
                  <fio>
                    <fam><?php echo $_POST['death_person_last_name']; ?></fam>
                    <nam><?php echo $_POST['death_person_first_name']; ?></nam>
                    <otch><?php echo $_POST['death_person_middle_name']; ?></otch>
                  </fio>
                  <pol><?php echo $_POST['death_person_sex']; ?></pol>
                  <docum>
                    <nam><?php echo $_POST['death_person_ident_doc_type']; ?></nam>
                    <seria><?php echo $_POST['death_person_ident_doc_ser']; ?></seria>
                    <num><?php echo $_POST['death_person_ident_doc_num']; ?></num>
                    <dat>
                        <?php $docUmDate = explode("-",$_POST['death_person_ident_doc_date']); ?>
	                    <dtDay><?php echo $docUmDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $docUmDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $docUmDate[2]; ?></dtYear>
                    </dat>
                    <ovd><?php echo $_POST['death_person_ident_doc_source']; ?></ovd>
                  </docum>
                  <mestoLive>
	                   <?php
	                  		$country = $_POST['death_person_living_country'];
	                  		 if ($_POST['death_person_living_isHand'] == "on"){
	                  		 	$state = $_POST['death_person_living_state'];
		                  		$region = $_POST['death_person_living_region'];
	                  		 	$settlement = $_POST['death_person_living_settlement'];
	                  		 	$settlement_type = $_POST['death_person_living_settlement_type'];
	                  		 	$street = $_POST['death_person_living_street'];
	                  		 	$typeStr = $_POST['death_person_living_street_type'];
	                  		 }else{
								$state = $_POST['death_person_living_stateRus'];
								$region = $_POST['death_person_living_settlementParentRus'];
								$settlement = $_POST['death_person_living_settlementRus'];
								$settlement_type = "";
								$street = $_POST['death_person_living_streetRus'];
								$typeStr = "";
							 }
							 $city = $_POST['death_person_living_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
	                    <street><?php echo $street; ?></street>
	                    <typeStr><?php echo $typeStr; ?></typeStr>
	                    <house><?php echo $_POST['death_person_living_house']; ?></house>
	                    <korp><?php echo $_POST['death_person_living_building']; ?></korp>
	                    <kvart><?php echo $_POST['death_person_living_flat']; ?></kvart>
	                    <indMal><?php echo $_POST['death_person_living_post_index']; ?></indMal>
                  </mestoLive>
                  <datRojd>
                    <dtDay><?php echo $_POST['death_person_birthday_day']; ?></dtDay>
                    <dtMonth><?php echo $_POST['death_person_birthday_month']; ?></dtMonth>
                    <dtYear><?php echo $_POST['death_person_birthday_year']; ?></dtYear>
                  </datRojd>
                  <grajd>
                    <type>GRAJD_YES_GOS</type>
                    <gosRod><?php echo $_POST['death_person_citizenship']; ?></gosRod>
                  </grajd>
                  <nation><?php echo $_POST['death_person_nationality']; ?></nation>
                  <mestoRojd>
	                  	<?php
	                  		$country = $_POST['death_person_birth_country'];
	                  		 if ($_POST['death_person_birth_hand_input'] == "on"){
	                  		 	$state = $_POST['death_person_birth_state'];
		                  		$region = $_POST['death_person_birth_region'];
	                  		 	$settlement = $_POST['death_person_birth_settlement'];
	                  		 	$settlement_type = $_POST['death_person_birth_settlement_type'];
	                  		 }else{
								$state = $_POST['death_person_birth_state_kladr'];
								$region = $_POST['death_person_birth_settlementParent_kladr'];
								$settlement = $_POST['death_person_birth_settlement_kladr'];
								$settlement_type = "";
							 }
							 $city = $_POST['death_person_birth_part_city'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </um>
                <datSm>
                    <dtDay><?php echo $_POST['death_date_day']; ?></dtDay>
                    <dtMonth><?php echo $_POST['death_date_month']; ?></dtMonth>
                    <dtYear><?php echo $_POST['death_date_year']; ?></dtYear>
                </datSm>
                <mestoSm>
	                  	<?php
	                  		$country = $_POST['death_country'];
	                  		 if ($_POST['death_isHand'] == "on"){
	                  		 	$state = $_POST['death_state'];
		                  		$region = $_POST['death_region'];
	                  		 	$settlement = $_POST['death_settlement'];
	                  		 	$settlement_type = $_POST['death_settlement_type'];
	                  		 }else{
								$state = $_POST['death_stateKladr'];
								$region = $_POST['death_settlementParentKladr'];
								$settlement = $_POST['death_settlementKladr'];
								$settlement_type = "";
							 }
							 $city = $_POST['death_partCity'];
	                  	?>
	                    <gos><?php echo $country; ?></gos>
	                    <subGos><?php echo $state; ?></subGos>
	                    <rayon><?php echo $region; ?></rayon>
	                    <gorod><?php echo $city; ?></gorod>
	                    <nasPun><?php echo $settlement; ?></nasPun>
	                    <typeNP><?php echo $settlement_type; ?></typeNP>
                </mestoSm>
                <zjvl>
                  <fio>
                    <fam><?php echo $_POST['declarant_last_name']; ?></fam>
                    <nam><?php echo $_POST['declarant_first_name']; ?></nam>
                    <otch><?php echo $_POST['declarant_middle_name']; ?></otch>
                  </fio>
                  <!-- <pol>?</pol> -->
                  <docum>
                    <nam><?php echo $_POST['declarant_ident_doc_type']; ?></nam>
                    <seria><?php echo $_POST['declarant_ident_doc_ser']; ?></seria>
                    <num><?php echo $_POST['declarant_ident_doc_num']; ?></num>
                    <dat>
                        <?php $docZlDate = explode("-",$_POST['declarant_ident_doc_date']); ?>
	                    <dtDay><?php echo $docZlDate[0]; ?></dtDay>
	                    <dtMonth><?php echo $docZlDate[1]; ?></dtMonth>
	                    <dtYear><?php echo $docZlDate[2]; ?></dtYear>
                    </dat>
                    <ovd><?php echo $_POST['declarant_ident_doc_source']; ?></ovd>
                  </docum>
                  <mestoLive>
	                   <?php
	                  		$country = $_POST['declarant_country'];
	                  		 if ($_POST['declarant_isHand'] == "on"){
	                  		 	$state = $_POST['declarant_state'];
		                  		$region = $_POST['declarant_region'];
	                  		 	$settlement = $_POST['declarant_settlement'];
	                  		 	$settlement_type = $_POST['declarant_settlement_type'];
	                  		 	$street = $_POST['declarant_street'];
	                  		 	$typeStr = $_POST['declarant_street_type'];
	                  		 }else{
								$state = $_POST['declarant_stateRus'];
								$region = $_POST['declarant_settlementParentRus'];
								$settlement = $_POST['declarant_settlementRus'];
								$settlement_type = "";
								$street = $_POST['declarant_streetRus'];
								$typeStr = "";
							 }
							 $city = $_POST['declarant_city'];
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
                </zjvl>
                <timeQue>
					<datQue><?php echo $_POST['date']; ?></datQue>
					<typeQue>AZ_SM</typeQue>
					<?php $hourTime = explode(":",$_POST['time']); ?>
					<hourQue><?php echo $hourTime[0]; ?></hourQue>
					<minQue><?php echo $hourTime[1]; ?></minQue>
					<namKabinet><?php echo $_POST['namKabinet']; ?></namKabinet>
				</timeQue>
              </zjv>
            </putZjvSm>
          </wsZagsSm>
        </ns2:AppData>
      </ns2:MessageData>
    </ns2:ZagsService>
  </S:Body>
</S:Envelope>