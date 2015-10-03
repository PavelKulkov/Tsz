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
            <putZjvIstrebZB>
              <use>true</use>
              <zjv>
				<reservedNakhodka>without-sending-status</reservedNakhodka>
                 <idZags><?php echo $_POST['id_agency_in']; ?></idZags>
                <gosIstrebDoc><?php echo $_POST['gosIstrebDoc']; ?></gosIstrebDoc>
                <namZagsIstrebDoc><?php echo $_POST['namZagsIstrebDoc']; ?></namZagsIstrebDoc>
                <zjvl>
                  <fio>
                  	<fam><?php echo $_POST['fam']; ?></fam>
                    <nam><?php echo $_POST['name']; ?></nam>
                    <otch><?php echo $_POST['otch']; ?></otch>
                  </fio>
                  <pol><?php echo $_POST['pol']; ?></pol>
                  <docum>
                  	<nam><?php echo $_POST['nam']; ?></nam>
                    <seria><?php echo $_POST['seria']; ?></seria>
                    <num><?php echo $_POST['num']; ?></num>
                    <dat>
						<?php $zjvlDocumDate = explode("-",$_POST['date_doc']); ?>
		                <dtDay><?php echo $zjvlDocumDate[0]; ?></dtDay>
		                <dtMonth><?php echo $zjvlDocumDate[1]; ?></dtMonth>
		                <dtYear><?php echo $zjvlDocumDate[2]; ?></dtYear>
                    </dat>
                    <ovd><?php echo $_POST['ovd']; ?></ovd>
                  </docum>
                  <mestoLive>
                  <?php
                  		$country = $_POST['gos'];
                  		 if ($_POST['hand_input'] == "on"){
                  		 	$state = $_POST['subGos'];
	                  		$region = $_POST['rayon'];
                  		 	$settlement = $_POST['nasPun'];
                  		 	$settlement_type = $_POST['typeNP'];
                  		 	$street = $_POST['street'];
                  		 	$typeStr = $_POST['typeStr'];
                  		 }else{
							$state = $_POST['subGos_kladr'];
							$region = $_POST['nasPunParent_kladr'];
							$settlement = $_POST['nasPun_kladr'];
							$settlement_type = "";
							$street = $_POST['street_kladr'];
							$typeStr = "";
						 }
						 $city = $_POST['gorod'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                    <street><?php echo $street; ?></street>
                    <typeStr><?php echo $typeStr; ?></typeStr>
                    <house><?php echo $_POST['house']; ?></house>
                    <korp><?php echo $_POST['korp']; ?></korp>
                    <kvart><?php echo $_POST['kvart']; ?></kvart>
                    <indMal><?php echo $_POST['indMal']; ?></indMal>
                  </mestoLive>
                </zjvl>
                <grajdZjvl>
                	<type>GRAJD_YES_GOS</type>
                    <gosRod><?php echo $_POST['grajd']; ?></gosRod>
                </grajdZjvl>
                <teleph><?php echo $_POST['contact_phone']; ?></teleph>
                <rightsOnDoc><?php echo $_POST['rightsOnDoc']; ?></rightsOnDoc>
                <namZagsTo><?php echo $_POST['namZagsTo']; ?></namZagsTo>
                <adrZagsTo>
                   <?php
                  		$country = $_POST['strana_zags'];
                  		 if ($_POST['hand_input_zags'] == "on"){
                  		 	$state = $_POST['obl_zags'];
	                  		$region = $_POST['raion_zags'];
                  		 	$settlement = $_POST['locality'];
                  		 	$settlement_type = $_POST['locality_type'];
                  		 	$street = $_POST['ul_zags'];
                  		 	$typeStr = $_POST['typeul_zags'];
                  		 }else{
							$state = $_POST['obl_zags_kladr'];
							$region = $_POST['localityParent_kladr'];
							$settlement = $_POST['locality_kladr'];
							$settlement_type = "";
							$street = $_POST['ul_zags_kladr'];
							$typeStr = "";
						 }
						 $city = $_POST['gorod_zags'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                    <street><?php echo $street; ?></street>
                    <typeStr><?php echo $typeStr; ?></typeStr>
                    <house><?php echo $_POST['dom_zags']; ?></house>
                    <korp><?php echo $_POST['korp_zags']; ?></korp>
                    <kvart><?php echo $_POST['kvart_zags']; ?></kvart>
                    <indMal><?php echo $_POST['index_zags']; ?></indMal>
                </adrZagsTo>
                <prichIstreb><?php echo $_POST['prichIstreb']; ?></prichIstreb>
                <kindDoc><?php echo $_POST['kindDoc']; ?></kindDoc>
                <actInfo>
                	<num><?php echo $_POST['num_act']; ?></num>
                    <dat>
						<?php 
                        	if ($_POST['exact_date'] == 'true'){
                        		$actInfoDocumDate = explode("-",$_POST['date_act_day']);
                        	}else{
								$actInfoDocumDate = explode("-",$_POST['date_act_since']);
							} 
                    	?>
	                	<dtDay><?php echo $actInfoDocumDate[0]; ?></dtDay>
	                	<dtMonth><?php echo $actInfoDocumDate[1]; ?></dtMonth>
	                	<dtYear><?php echo $actInfoDocumDate[2]; ?></dtYear>
                    </dat>
                    <zgs><?php echo $_POST['organ_zags']; ?></zgs>
                    <?php
                    	if ($_POST['exact_date'] == 'false'){
							echo "<datAZ_2>";
							$actInfoDocumDateUntil = explode("-",$_POST['date_act_until']);
							echo "<dtDay>".$actInfoDocumDateUntil[0]."</dtDay>";
							echo "<dtMonth>".$actInfoDocumDateUntil[1]."</dtMonth>";
							echo "<dtYear>".$actInfoDocumDateUntil[2]."</dtYear>";
							echo "</datAZ_2>";
						}
                    ?>
                </actInfo>
                <heDoZB>
                  <fio>
                    <fam><?php echo $_POST['fam_zh']; ?></fam>
                    <nam><?php echo $_POST['name_zh']; ?></nam>
                    <otch><?php echo $_POST['otch_zh']; ?></otch>
                  </fio>
                  <datRojdN>
                    <?php 
	                	if ($_POST['date_true_zb_zh'] == 'true'){
	                       	$datRojdN = explode("-",$_POST['birthday_zh']);
	                    }else{
	                       	$datRojdN = explode("-",$_POST['birthday_s_zh']);
	                    }
                    ?>
                    <dtDay><?php echo $datRojdN[0]; ?></dtDay>
                    <dtMonth><?php echo $datRojdN[1]; ?></dtMonth>
                    <dtYear><?php echo $datRojdN[2]; ?></dtYear>
                  </datRojdN>
                  <datRojdK>
					<?php $datRojdK = explode("-",$_POST['birthday_po_zh']); ?>
                    <dtDay><?php echo $datRojdK[0]; ?></dtDay>
                    <dtMonth><?php echo $datRojdK[1]; ?></dtMonth>
                    <dtYear><?php echo $datRojdK[2]; ?></dtYear>
                  </datRojdK>
                  <mestoRojd>
                     <?php
                  		$country = $_POST['gos_zb_zh'];
                  		 if ($_POST['hand_input_zb_zh'] == "on"){
                  		 	$state = $_POST['subgos_zb_zh'];
	                  		$region = $_POST['rayon_zb_zh'];
                  		 	$settlement = $_POST['naspun_zb_zh'];
                  		 	$settlement_type = $_POST['typenp_zb_zh'];
                  		 }else{
							$state = $_POST['subgos_kladr_zb_zh'];
							$region = $_POST['naspunParent_kladr_zb_zh'];
							$settlement = $_POST['naspun_kladr_zb_zh'];
							$settlement_type = "";
						 }
						 $city = $_POST['gorod_zb_zh'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </heDoZB>
                <sheDoZB>
                  <fio>
                    <fam><?php echo $_POST['fam_nev']; ?></fam>
                    <nam><?php echo $_POST['name_nev']; ?></nam>
                    <otch><?php echo $_POST['otch_nev']; ?></otch>
                  </fio>
                  <datRojdN>
                    <?php 
	                	if ($_POST['date_true_zb_nev'] == 'true'){
	                       	$datRojdN = explode("-",$_POST['birthday_nev']);
	                    }else{
	                       	$datRojdN = explode("-",$_POST['birthday_s_nev']);
	                    }
                    ?>
                    <dtDay><?php echo $datRojdN[0]; ?></dtDay>
                    <dtMonth><?php echo $datRojdN[1]; ?></dtMonth>
                    <dtYear><?php echo $datRojdN[2]; ?></dtYear>
                  </datRojdN>
                  <datRojdK>
					<?php $datRojdK = explode("-",$_POST['birthday_po_nev']); ?>
                    <dtDay><?php echo $datRojdK[0]; ?></dtDay>
                    <dtMonth><?php echo $datRojdK[1]; ?></dtMonth>
                    <dtYear><?php echo $datRojdK[2]; ?></dtYear>
                  </datRojdK>
                  <mestoRojd>
                    <?php
                  		$country = $_POST['gos_zb_nev'];
                  		 if ($_POST['hand_input_zb_nev'] == "on"){
                  		 	$state = $_POST['subgos_zb_nev'];
	                  		$region = $_POST['rayon_zb_nev'];
                  		 	$settlement = $_POST['naspun_zb_nev'];
                  		 	$settlement_type = $_POST['typenp_zb_nev'];
                  		 }else{
							$state = $_POST['subgos_kladr_zb_nev'];
							$region = $_POST['naspunParent_kladr_zb_nev'];
							$settlement = $_POST['naspun_kladr_zb_nev'];
							$settlement_type = "";
						 }
						 $city = $_POST['gorod_zb_nev'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </sheDoZB>
                <hePosleZB>
                	<fam><?php echo $_POST['fam_zh_p']; ?></fam>
                    <nam><?php echo $_POST['name_zh_p']; ?></nam>
                    <otch><?php echo $_POST['otch_zh_p']; ?></otch>
                </hePosleZB>
                <shePosleZB>
                	<fam><?php echo $_POST['fam_nev_p']; ?></fam>
                    <nam><?php echo $_POST['name_nev_p']; ?></nam>
                    <otch><?php echo $_POST['otch_nev_p']; ?></otch>
                </shePosleZB>
                <timeQue>
					<datQue><?php echo $_POST['date']; ?></datQue>
					<typeQue>AZ_ISTREB</typeQue>
					<?php $hourTime = explode(":",$_POST['time']); ?>
					<hourQue><?php echo $hourTime[0]; ?></hourQue>
					<minQue><?php echo $hourTime[1]; ?></minQue>
					<namKabinet><?php echo $_POST['namKabinet']; ?></namKabinet>
				</timeQue>
              </zjv>
            </putZjvIstrebZB>
          </wsZagsIstreb>
        </ns2:AppData>
      </ns2:MessageData>
    </ns2:ZagsService>
  </S:Body>
</S:Envelope>