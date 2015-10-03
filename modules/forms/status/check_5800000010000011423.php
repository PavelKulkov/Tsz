<?php 
      $soapAction = "urn:landConstForUr";

?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/estate/granting/land" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

<soapenv:Body>
<smev:landConstForUr>
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
        <smev:TypeCode>GSRV</smev:TypeCode>
        <smev:Status>PING</smev:Status>
        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
        <smev:ExchangeType/>
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>estate-granting</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>
<smev:MessageData>
<smev:AppData>
	<q1:activityQuery>
	<q1:addressActivites><?php echo $_POST['addressActivites']; ?></q1:addressActivites>
	<q1:cadastralNumber><?php echo $_POST['cadastralNumber']; ?></q1:cadastralNumber>
	<q1:categoryOfLand><?php echo $_POST['categoryOfLand']; ?></q1:categoryOfLand>
	<q1:flagHaveObject><?php echo ($_POST['flagHaveObject']  == "on") ? 'true' : 'false'; ?></q1:flagHaveObject>
	<q1:flagHaveRightOnEstate><?php echo ($_POST['flagHaveRightOnEstate']  == "on") ? 'true' : 'false'; ?></q1:flagHaveRightOnEstate>
	<q1:kindPermission><?php echo $_POST['kindPermission']; ?></q1:kindPermission>
	<q1:OKATO><?php echo $_POST['OKATO']; ?></q1:OKATO>
	<q1:OKTMO><?php echo $_POST['OKTMO']; ?></q1:OKTMO>
	<q1:registered><?php echo ($_POST['isRegistered']  == "on") ? 'true' : 'false'; ?></q1:registered>
	<q1:square><?php echo $_POST['square']; ?></q1:square>
	</q1:activityQuery>
	<q2:urData>
		<q2:contacts>
		<q2:phone><?php echo $_POST['phone']; ?></q2:phone>	
		<q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
		</q2:contacts>
		<q2:egrpData>
			<q2:INN><?php echo $_POST['INN']; ?></q2:INN>
			<q2:OGRN><?php echo $_POST['OGRN']; ?></q2:OGRN>
		</q2:egrpData>
		<q2:KPP><?php echo $_POST['KPP']; ?></q2:KPP>
		<q2:organizationAddress><?php echo $_POST['organizationAddress']; ?></q2:organizationAddress>
		<q2:organizationFirmName><?php echo $_POST['organizationFirmName']; ?></q2:organizationFirmName>
		<q2:organizationName><?php echo $_POST['organizationName']; ?></q2:organizationName>
		<q2:organizationShortName><?php echo $_POST['organizationShortName']; ?></q2:organizationShortName>
	</q2:urData>
	<q3:inParams>
  		<q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id> 
  		<q3:form_id>1</q3:form_id> 
		<q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date> 
  	</q3:inParams>
</smev:AppData>
<smev:AppDocument>
<smev:RequestCode/>
<smev:BinaryData>
	<?php echo($attachment->data);?>
</smev:BinaryData>
</smev:AppDocument>
</smev:MessageData>
</smev:landConstForUr>
</soapenv:Body>
</soapenv:Envelope>
