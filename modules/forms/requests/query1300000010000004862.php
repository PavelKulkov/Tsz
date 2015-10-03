<?php 
	$soapAction = "urn:AdoptionStatementService";
	$subservice_url_id = 86;
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:dec="Declaration.xsd" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:inc="http://www.w3.org/2004/08/xop/include" xmlns:ser="http://service/" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:tinf="TransitInfo.xsd" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
	<soapenv:Body>
		<ser:adoptionStatement>
		      <smev:Message>
			<smev:Sender>
			    <smev:Code><?php echo(htmlspecialchars($sender[0]));?></smev:Code>
			    <smev:Name><?php echo(htmlspecialchars($sender[1]));?></smev:Name>
			</smev:Sender>
			<smev:Recipient>
			  <smev:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></smev:Code>
			  <smev:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></smev:Name>
			</smev:Recipient>
			<smev:Originator>
			     <smev:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></smev:Code>
			      <smev:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></smev:Name>
			</smev:Originator>
			<smev:ServiceName>Запрос в орган ЗАГС</smev:ServiceName>
			<smev:TypeCode>GFNC</smev:TypeCode>
			<smev:Status>REQUEST</smev:Status>
			<smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
			<smev:ExchangeType>2</smev:ExchangeType>
			<smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
			<smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
			<smev:ServiceCode>000000001</smev:ServiceCode>
			<smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
		      </smev:Message>
		      <smev:MessageData>
			<smev:AppData>
			<?php
				$appData = $_POST['sendData'];  
				$appData = str_replace("#idRequestPGU#", htmlspecialchars($idRequest), $appData);
				echo $appData;
			?>
			</smev:AppData>
                      </smev:MessageData>
		</ser:adoptionStatement>
	</soapenv:Body>
</soapenv:Envelope>
