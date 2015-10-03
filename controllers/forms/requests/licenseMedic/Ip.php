<?php 
	$subservice_url_id = 55;
      $soapAction = "urn:doRequestForIp";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/minaid/license/medic" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <soapenv:Body>
        <smev:doRequestForIp>
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
                <smev:ServiceName>MedicalActivityService</smev:ServiceName>
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
                    <q1:activityQuery>
                        <q1:flagHaveRightOnEstate>true</q1:flagHaveRightOnEstate>
                        <q1:licenseActivityAddress><?php echo $_POST['licenseActivityAddress']; ?> </q1:licenseActivityAddress>
                        <q1:OKATO><?php echo $_POST['OKATO']; ?></q1:OKATO>
                        <q1:OKTMO><?php echo $_POST['OKTMO']; ?></q1:OKTMO>
                    </q1:activityQuery>
                    <q2:ipData>
                        <q2:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q2:addressActualResiding>
                        <q2:contacts>
                            <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
                            <q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
                        </q2:contacts>
                        <q2:egrData>
                            <q2:INN><?php echo $_POST['INN']; ?></q2:INN>
                            <q2:OGRN><?php echo $_POST['OGRN']; ?></q2:OGRN>
                        </q2:egrData>
                        <q2:FIO><?php echo $_POST['FIO']; ?></q2:FIO>
                    </q2:ipData>
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
        </smev:doRequestForIp>
    </soapenv:Body>
</soapenv:Envelope>