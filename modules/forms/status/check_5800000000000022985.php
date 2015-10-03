<?php $subservice_url_id = 14;
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
                            <q1:value>5800000000000022985</q1:value>
                        </q1:dataRow>
						<q1:dataRow>
						    <q1:name>FIO</q1:name>
						    <q1:value><?php echo $_POST['FIO__']; ?></q1:value>
						</q1:dataRow>	
                        <q1:dataRow>
                            <q1:name>applicantIdentityDocument</q1:name>
                            <q1:value><?php echo $_POST['applicantIdentityDocument__']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>addressActualResiding</q1:name>
                            <q1:value><?php echo $_POST['addressActualResiding__']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>landArea</q1:name>
                            <q1:value><?php echo $_POST['landArea__']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>cadastralParcelNumber</q1:name>
                            <q1:value><?php echo $_POST['cadastralParcelNumber__']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>categoryLand</q1:name>
                            <q1:value><?php echo $_POST['categoryLand__']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>permittedUse</q1:name>
                            <q1:value><?php echo $_POST['permittedUse__']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>locationOfTheSite</q1:name>
                            <q1:value><?php echo $_POST['locationOfTheSite__']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>phone</q1:name>
                            <q1:value><?php echo $_POST['phone__']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>eMail</q1:name>
                            <q1:value><?php echo $_POST['eMail__']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>tenderForTheSaleOfLand</q1:name>
                            <q1:value><?php echo ($_POST['tenderForTheSaleOfLand']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>housingForSale</q1:name>
                            <q1:value><?php echo ($_POST['housingForSale']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>plannedСonstruction</q1:name>
                            <q1:value><?php echo ($_POST['plannedСonstruction']  == "on") ? 'true' : 'false'; ?></q1:value>
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