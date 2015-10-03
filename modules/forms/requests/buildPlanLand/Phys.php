<?php 
	$subservice_url_id = 39;
      $soapAction = "urn:doQueryForPhys";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/omsu/build/planLand" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <soapenv:Body>
        <smev:doQueryForPhys>
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
                <smev:ServiceName>BuildPlanlandActivityService</smev:ServiceName>
                <smev:TypeCode>GSRV</smev:TypeCode>
                <smev:Status>REQUEST</smev:Status>
                <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
                <smev:ExchangeType>1</smev:ExchangeType>
                <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
                <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
                <smev:ServiceCode>5800000010000014762</smev:ServiceCode>
                <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
            </smev:Message>
            <smev:MessageData>
                <smev:AppData>
                    <q1:queryPhysData>
                        <q1:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q1:addressActualResiding>
                        <q1:contact>
                            <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
							<q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
                        </q1:contact>
                        <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO>
                        <q1:flagHaveRightOnEstate><?php echo ($_POST['flagHaveRightOnEstate']  == "on") ? 'true' : 'false'; ?></q1:flagHaveRightOnEstate>
                        <q1:identityDocument><?php echo $_POST['identityDocument']; ?></q1:identityDocument>
                        <q1:OKATO><?php echo $_POST['OKATO']; ?></q1:OKATO>
						<q1:OKTMO><?php echo $_POST['OKTMO']; ?></q1:OKTMO>
                        <q1:officeName><?php echo $_POST['officeName']; ?></q1:officeName>
                    </q1:queryPhysData>
                    <q1:queryData>
                        <q1:address><?php echo $_POST['address']; ?></q1:address>
                        <q1:cadastralNumber><?php echo $_POST['cadastralNumber']; ?></q1:cadastralNumber>
                        <q1:registered><?php echo ($_POST['isRegistered']  == "on") ? 'true' : 'false'; ?></q1:registered>
                        <q1:square><?php echo $_POST['square']; ?></q1:square>
                        <q1:flagHaveObject><?php echo ($_POST['flagHaveObject']  == "on") ? 'true' : 'false'; ?></q1:flagHaveObject>
                    </q1:queryData>
                    <q3:inParams>
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
        </smev:doQueryForPhys>
    </soapenv:Body>
</soapenv:Envelope>