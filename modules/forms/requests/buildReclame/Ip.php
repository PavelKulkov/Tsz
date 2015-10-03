<?php 
	$subservice_url_id = 69;
      $soapAction = "urn:doBuildReclForIp";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/declarant" xmlns:q2="http://oep-penza.ru/com/oep/omsu/build/reclame" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <soapenv:Body>
        <smev:doBuildReclForIp>
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
                    <q1:ipData>
                        <q1:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q1:addressActualResiding>
                        <q1:contacts>
                            <q1:phone><?php echo $_POST['phone']; ?></q1:phone>
                            <q1:eMail><?php echo $_POST['eMail']; ?></q1:eMail>
                        </q1:contacts>
                        <q1:egrData>
                            <q1:INN><?php echo $_POST['INN']; ?></q1:INN>
                            <q1:OGRN><?php echo $_POST['OGRN']; ?></q1:OGRN>
                        </q1:egrData>
                        <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO>
                    </q1:ipData>
                    <q2:activityQuery>
                        <q2:address><?php echo $_POST['address']; ?></q2:address>
                        <q2:area><?php echo $_POST['area']; ?></q2:area>
                        <q2:high><?php echo $_POST['high']; ?></q2:high>
                        <q2:kindConstruction><?php echo $_POST['kindConstruction']; ?></q2:kindConstruction>
                        <q2:numberElement><?php echo $_POST['numberElement']; ?></q2:numberElement>
                        <q2:numberSide><?php echo $_POST['numberSide']; ?></q2:numberSide>
                        <q2:OKATO><?php echo $_POST['OKATO']; ?></q2:OKATO>
                        <q2:OKTMO><?php echo $_POST['OKTMO']; ?></q2:OKTMO>
                        <q2:officeName><?php echo $_POST['officeName']; ?></q2:officeName>
                        <q2:owner><?php echo $_POST['owner']; ?></q2:owner>
                        <q2:registered><?php echo ($_POST['isRegistered']  == "on") ? true : false; ?></q2:registered>
                        <q2:reklamInformation><?php echo $_POST['reklamInformation']; ?></q2:reklamInformation>
                        <q2:weight><?php echo $_POST['weight']; ?></q2:weight>
                    </q2:activityQuery>
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
        </smev:doBuildReclForIp>
    </soapenv:Body>
</soapenv:Envelope>