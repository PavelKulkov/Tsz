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
            <putZjvIstrebRB>
              <use>true</use>
              <zjv>
				<reservedNakhodka>without-sending-status</reservedNakhodka>
				<?php 
                	require("zjvIstreb.php");
                ?>
                <heDoRB>
                  <fio>
                    <fam><?php echo $_POST['fam_muzh']; ?></fam>
                    <nam><?php echo $_POST['name_muzh']; ?></nam>
                    <otch><?php echo $_POST['otch_muzh']; ?></otch>
                  </fio>
                  <datRojdN>
                    <?php 
	                	if ($_POST['date_true_rb_m'] == 'true'){
	                       	$datRojdN = explode("-",$_POST['birthday_muzh']);
	                    }else{
	                       	$datRojdN = explode("-",$_POST['birthday_s_muzh']);
	                    }
                    ?>
                    <dtDay><?php echo $datRojdN[0]; ?></dtDay>
                    <dtMonth><?php echo $datRojdN[1]; ?></dtMonth>
                    <dtYear><?php echo $datRojdN[2]; ?></dtYear>
                  </datRojdN>
                  <datRojdK>
					<?php $datRojdK = explode("-",$_POST['birthday_po_muzh']); ?>
                    <dtDay><?php echo $datRojdK[0]; ?></dtDay>
                    <dtMonth><?php echo $datRojdK[1]; ?></dtMonth>
                    <dtYear><?php echo $datRojdK[2]; ?></dtYear>
                  </datRojdK>
                  <mestoRojd>
                     <?php
                  		$country = $_POST['gos_rb_muzh'];
                  		 if ($_POST['hand_input_rb_muzh'] == "on"){
                  		 	$state = $_POST['subgos_rb_muzh'];
	                  		$region = $_POST['rayon_rb_muzh'];
                  		 	$settlement = $_POST['naspun_rb_muzh'];
                  		 	$settlement_type = $_POST['typenp_rb_muzh'];
                  		 }else{
							$state = $_POST['subgos_kladr_rb_muzh'];
							$region = $_POST['naspunParent_kladr_rb_muzh'];
							$settlement = $_POST['naspun_kladr_rb_muzh'];
							$settlement_type = "";
						 }
						 $city = $_POST['gorod_rb_muzh'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </heDoRB>
                <sheDoRB>
                  <fio>
                    <fam><?php echo $_POST['fam_zhena']; ?></fam>
                    <nam><?php echo $_POST['name_zhena']; ?></nam>
                    <otch><?php echo $_POST['otch_zhena']; ?></otch>
                  </fio>
                  <datRojdN>
                    <?php 
	                	if ($_POST['date_true'] == 'true'){
	                       	$datRojdN = explode("-",$_POST['birthday_zhena']);
	                    }else{
	                       	$datRojdN = explode("-",$_POST['birthday_s_zhena']);
	                    }
                    ?>
                    <dtDay><?php echo $datRojdN[0]; ?></dtDay>
                    <dtMonth><?php echo $datRojdN[1]; ?></dtMonth>
                    <dtYear><?php echo $datRojdN[2]; ?></dtYear>
                  </datRojdN>
                  <datRojdK>
					<?php $datRojdK = explode("-",$_POST['birthday_po_zhena']); ?>
                    <dtDay><?php echo $datRojdK[0]; ?></dtDay>
                    <dtMonth><?php echo $datRojdK[1]; ?></dtMonth>
                    <dtYear><?php echo $datRojdK[2]; ?></dtYear>
                  </datRojdK>
                  <mestoRojd>
                    <?php
                  		$country = $_POST['gos_rb_zhena'];
                  		 if ($_POST['hand_input_rb_zhena'] == "on"){
                  		 	$state = $_POST['subgos_rb_zhena'];
	                  		$region = $_POST['rayon_rb_zhena'];
                  		 	$settlement = $_POST['naspun_rb_zhena'];
                  		 	$settlement_type = $_POST['typenp_rb_zhena'];
                  		 }else{
							$state = $_POST['subgos_kladr_rb_zhena'];
							$region = $_POST['naspunParent_kladr_rb_zhena'];
							$settlement = $_POST['naspun_kladr_rb_zhena'];
							$settlement_type = "";
						 }
						 $city = $_POST['gorod_rb_zhena'];
                  	?>
                    <gos><?php echo $country; ?></gos>
                    <subGos><?php echo $state; ?></subGos>
                    <rayon><?php echo $region; ?></rayon>
                    <gorod><?php echo $city; ?></gorod>
                    <nasPun><?php echo $settlement; ?></nasPun>
                    <typeNP><?php echo $settlement_type; ?></typeNP>
                  </mestoRojd>
                </sheDoRB>
                <hePosleRB>
                    <fam><?php echo $_POST['fam_muzh_p']; ?></fam>
                    <nam><?php echo $_POST['name_muzh_p']; ?></nam>
                    <otch><?php echo $_POST['otch_muzh_p']; ?></otch>        
                </hePosleRB>
                <shePosleRB>
                    <fam><?php echo $_POST['fam_zhena_p']; ?></fam>
                    <nam><?php echo $_POST['name_zhena_p']; ?></nam>
                    <otch><?php echo $_POST['otch_zhena_p']; ?></otch>
                </shePosleRB>
                <timeQue>
					<datQue><?php echo $_POST['date']; ?></datQue>
					<typeQue>AZ_ISTREB</typeQue>
					<?php $hourTime = explode(":",$_POST['time']); ?>
					<hourQue><?php echo $hourTime[0]; ?></hourQue>
					<minQue><?php echo $hourTime[1]; ?></minQue>
					<namKabinet><?php echo $_POST['namKabinet']; ?></namKabinet>
				</timeQue>
              </zjv>
            </putZjvIstrebRB>
          </wsZagsIstreb>
        </ns2:AppData>
      </ns2:MessageData>
    </ns2:ZagsService>
  </S:Body>
</S:Envelope>