<?php
	$subservice_url_id = 26; 
      $soapAction = "urn:doTermForUr";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/minaid/license/pharm" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

    <soapenv:Body>
        <smev:doTermForUr>
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
		        <smev:ServiceName>PharmActivityService</smev:ServiceName>
		        <smev:TypeCode>GSRV</smev:TypeCode>
		        <smev:Status>REQUEST</smev:Status>
		        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
		        <smev:ExchangeType>111111</smev:ExchangeType>
		        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
		        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
		        <smev:ServiceCode>5800000010000053602</smev:ServiceCode>
		        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
		      </smev:Message>
            <smev:MessageData>
                <smev:AppData>
                    <q1:dataUr xmlns:q1="http://oep-penza.ru/com/oep/minaid/license/pharm" xmlns:q2="http://oep-penza.ru/com/oep/declarant">
                        <q1:contacts>
                            <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
                            <q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
                        </q1:contacts>
                        <q1:egrpData>
                            <q2:INN><?php echo $_POST['INN']; ?></q2:INN>
                            <q2:OGRN><?php echo $_POST['OGRN']; ?></q2:OGRN>
                        </q1:egrpData>
                        <q1:KPP><?php echo $_POST['KPP']; ?></q1:KPP>
                        <q1:organizationAddress><?php echo $_POST['organizationAddress']; ?></q1:organizationAddress>
                        <q1:organizationFirmName><?php echo $_POST['organizationFirmName']; ?></q1:organizationFirmName>
                        <q1:organizationName><?php echo $_POST['organizationName']; ?></q1:organizationName>
                        <q1:organizationShortName><?php echo $_POST['organizationShortName']; ?></q1:organizationShortName>
                    </q1:dataUr>
                    <q1:dataTerm xmlns:q1="http://oep-penza.ru/com/oep/minaid/license/pharm" />
                    <q3:inParams xmlns:q3="http://oep-penza.ru/com/oep">
                        <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id>
                        <q3:form_id>16</q3:form_id>
                        <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date>
                    </q3:inParams>
                </smev:AppData>
                <smev:AppDocument>
                    <smev:RequestCode />
                    <smev:BinaryData><?php echo ($attachment->data);?></smev:BinaryData>
                </smev:AppDocument>
            </smev:MessageData>
        </smev:doTermForUr>
    </soapenv:Body>
</soapenv:Envelope>