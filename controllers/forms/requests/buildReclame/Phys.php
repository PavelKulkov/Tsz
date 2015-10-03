<?php 
	$subservice_url_id = 69;
      $soapAction = "urn:doBuildReclForPhys";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/omsu/build/reclame" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <soapenv:Body>
        <smev:doBuildReclForPhys>
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
                <smev:ServiceName>ReclameBuildService</smev:ServiceName>
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
                    <q1:physData>
                        <q1:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q1:addressActualResiding>
                        <q1:contacts>
                            <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
                        </q1:contacts>
                        <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO>
                        <q1:identityDocument><?php echo $_POST['identityDocument']; ?></q1:identityDocument>
                    </q1:physData>
                    <q1:activityQuery>
                        <q1:address><?php echo $_POST['address']; ?></q1:address>
                        <q1:area><?php echo $_POST['area']; ?></q1:area>
                        <q1:high><?php echo $_POST['high']; ?></q1:high>
                        <q1:kindConstruction><?php echo $_POST['kindConstruction']; ?></q1:kindConstruction>
                        <q1:numberElement><?php echo $_POST['numberElement']; ?></q1:numberElement>
                        <q1:numberSide><?php echo $_POST['numberSide']; ?></q1:numberSide>
                        <q1:OKATO><?php echo $_POST['OKATO']; ?></q1:OKATO>
                        <q1:officeName><?php echo $_POST['officeName']; ?></q1:officeName>
                        <q1:owner><?php echo $_POST['owner']; ?></q1:owner>
                        <q1:registered><?php echo ($_POST['registered']  == "on") ? 'true' : 'false'; ?></q1:registered>
                        <q1:reklamInformation><?php echo $_POST['reklamInformation']; ?></q1:reklamInformation>
                        <q1:weight><?php echo $_POST['weight']; ?></q1:weight>
                    </q1:activityQuery>
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
        </smev:doBuildReclForPhys>
    </soapenv:Body>
</soapenv:Envelope>