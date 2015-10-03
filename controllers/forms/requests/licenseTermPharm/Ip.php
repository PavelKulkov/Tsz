<?php 
	$subservice_url_id = 26;
      $soapAction = "urn:doTermForIp";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:rev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <soapenv:Body>
        <rev:doTermForIp>
            <rev:Message>
                <rev:Sender>
                    <rev:Code><?php echo(htmlspecialchars($sender[0]));?></rev:Code>
                    <rev:Name><?php echo(htmlspecialchars($sender[1]));?></rev:Name>
                </rev:Sender>
                <rev:Recipient>
                    <rev:Code><?php echo(htmlspecialchars($sender[0]));?></rev:Code>
                    <rev:Name><?php echo(htmlspecialchars($sender[1]));?></rev:Name>
                </rev:Recipient>
                <rev:Originator>
                    <rev:Code><?php echo(htmlspecialchars($sender[0]));?></rev:Code>
                    <rev:Name><?php echo(htmlspecialchars($sender[1]));?></rev:Name>
                </rev:Originator>
                <rev:ServiceName>IPGUSERVICE55811003</rev:ServiceName>
                <rev:TypeCode>GSRV</rev:TypeCode>
                <rev:Status>REQUEST</rev:Status>
                <rev:Date><?php echo(htmlspecialchars($idRequest));?></rev:Date>
                <rev:ExchangeType>1</rev:ExchangeType>
                <rev:RequestIdRef />
                <rev:OriginRequestIdRef />
                <rev:ServiceCode>5800000010000014762</rev:ServiceCode>
                <rev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></rev:CaseNumber>
            </rev:Message>
            <rev:MessageData>
                <rev:AppData>
                    <q1:dataIp xmlns:q1="http://oep-penza.ru/com/oep/minaid/license/pharm" xmlns:q2="http://oep-penza.ru/com/oep/declarant">
                        <q1:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q1:addressActualResiding>
                        <q1:contacts>
                            <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
                            <q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
                        </q1:contacts>
                        <q1:egrData>
                            <q2:INN><?php echo $_POST['INN']; ?></q2:INN>
                            <q2:OGRN><?php echo $_POST['OGRN']; ?></q2:OGRN>
                        </q1:egrData>
                        <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO>
                    </q1:dataIp>
                    <q1:dataTerm xmlns:q1="http://oep-penza.ru/com/oep/minaid/license/pharm" />
                    <q3:inParams xmlns:q3="http://oep-penza.ru/com/oep">
                        <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id>
                        <q3:form_id>16</q3:form_id>
                        <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date>
                    </q3:inParams>
                </rev:AppData>
                <rev:AppDocument>
                    <rev:RequestCode />
                    <rev:BinaryData><?php echo ($attachment->data);?></rev:BinaryData>
                </rev:AppDocument>
            </rev:MessageData>
        </rev:doTermForIp>
    </soapenv:Body>
</soapenv:Envelope>