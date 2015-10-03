<?php $url = "http://194.85.124.1:8886/smev/mvvact";
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
                <smev:Status>REQUEST</smev:Status>
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
                            <q1:value>5840100010000011554</q1:value>
                        </q1:dataRow>
						<q1:dataRow>
						    <q1:name>flowName</q1:name>
						    <q1:value>RegisterForImproveLivingArea</q1:value>
						</q1:dataRow>	
                        <q1:dataRow>
                            <q1:name>nameInformation</q1:name>
                            <q1:value><?php echo $_POST['nameInformation_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>forestArea</q1:name>
                            <q1:value><?php echo $_POST['forestArea_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>localForestArea</q1:name>
                            <q1:value><?php echo $_POST['localForestArea_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>numberQuarter</q1:name>
                            <q1:value><?php echo $_POST['numberQuarter_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>numberSite</q1:name>
                            <q1:value><?php echo $_POST['numberSite_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>FIO</q1:name>
                            <q1:value><?php echo $_POST['FIO_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>identityDocument</q1:name>
                            <q1:value><?php echo $_POST['identityDocument_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>INN</q1:name>
                            <q1:value><?php echo $_POST['INN_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>addressActualResiding</q1:name>
                            <q1:value><?php echo $_POST['addressActualResiding_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>FIOrepresentative</q1:name>
                            <q1:value><?php echo $_POST['FIOrepresentative_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>RepresentativeINN</q1:name>
                            <q1:value><?php echo $_POST['RepresentativeINN_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>identityDocumentRepresentative</q1:name>
                            <q1:value><?php echo $_POST['identityDocumentRepresentative_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>RepresentativeDocument</q1:name>
                            <q1:value><?php echo $_POST['RepresentativeDocument_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>flagFreeData</q1:name>
                            <q1:value><?php echo ($_POST['flagFreeData_']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>documentRequisites</q1:name>
                            <q1:value><?php echo $_POST['documentRequisites_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>adressDelivery</q1:name>
                            <q1:value><?php echo $_POST['adressDelivery_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>phone</q1:name>
                            <q1:value><?php echo $_POST['phone_']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>eMail</q1:name>
                            <q1:value><?php echo $_POST['eMail_']; ?></q1:value>
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