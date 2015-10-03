<?php 
	$subservice_url_id = 14;
    $soapAction = "urn:putData";

?>

<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

    <soap:Body>
        <smev:putData>
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
                <smev:ServiceName>UniversalMVV</smev:ServiceName>
                <smev:TypeCode>GSRV</smev:TypeCode>
                <smev:Status>PING</smev:Status>
                <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
                <smev:ExchangeType>123</smev:ExchangeType>
                <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
                <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
                <smev:ServiceCode>111111111111</smev:ServiceCode>
                <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
            </smev:Message>
            <smev:MessageData>
                <smev:AppData>
                    <q1:result>
                        <q1:dataRow>
                            <q1:name>procedureCode</q1:name>
                            <q1:value>5840100010000011567</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>organizationName</q1:name>
                            <q1:value><?php echo $_POST['organizationName']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>organizationShortName</q1:name>
                            <q1:value><?php echo $_POST['organizationShortName']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>organizationFirmName</q1:name>
                            <q1:value><?php echo $_POST['organizationFirmName']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>INN</q1:name>
                            <q1:value><?php echo $_POST['INN']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>OGRN</q1:name>
                            <q1:value><?php echo $_POST['OGRN']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>KPP</q1:name>
                            <q1:value><?php echo $_POST['KPP']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>organizationAddressUR</q1:name>
                            <q1:value><?php echo $_POST['organizationAddressUR']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>organizationAddressFact</q1:name>
                            <q1:value><?php echo $_POST['organizationAddressFact']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>phone</q1:name>
                            <q1:value><?php echo $_POST['phone']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>eMail</q1:name>
                            <q1:value><?php echo $_POST['eMail']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>detailsContractOfForest</q1:name>
                            <q1:value><?php echo $_POST['detailsContractOfForest']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>locationOfForestLand</q1:name>
                            <q1:value><?php echo $_POST['locationOfForestLand']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>forestArea</q1:name>
                            <q1:value><?php echo $_POST['forestArea']; ?></q1:value>
                        </q1:dataRow>	
                        <q1:dataRow>
                            <q1:name>viewOfForest</q1:name>
                            <q1:value><?php echo $_POST['viewOfForest']; ?></q1:value>
                        </q1:dataRow>						
                        <q1:dataRow>
                            <q1:name>termForestManagement</q1:name>
                            <q1:value><?php echo $_POST['termForestManagement']; ?></q1:value>
                        </q1:dataRow>			
                        <q1:dataRow>
                            <q1:name>otherDocumentsScan</q1:name>
                            <q1:value><?php echo $_POST['otherDocumentsScan']; ?></q1:value>
                        </q1:dataRow>
                        <q1:params>
                            <q1:app_id><?php echo(htmlspecialchars($idRequest));?></q1:app_id>
                            <q1:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q1:status_date>
                        </q1:params>
                    </q1:result>
                </smev:AppData>
				<smev:AppDocument>
				  <smev:RequestCode>metadata</smev:RequestCode>
				  <smev:BinaryData><?php echo ($attachment->data); ?></smev:BinaryData>
				</smev:AppDocument>
            </smev:MessageData>
        </smev:putData>
    </soap:Body>
</soap:Envelope>