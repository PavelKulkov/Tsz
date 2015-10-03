<?php 
      $soapAction = "urn:doQuery";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:q1="http://oep-penza.ru/com/oep/minaid/finance/subsidy" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep/declarant/family" xmlns:q4="http://oep-penza.ru/com/oep" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <soapenv:Body>
        <smev:doQuery>
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
                <smev:ServiceName>CitizenRentAidService</smev:ServiceName>
                <smev:TypeCode>GSRV</smev:TypeCode>
                <smev:Status>PING</smev:Status>
                <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
                <smev:ExchangeType>1</smev:ExchangeType>
                <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
                <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
                <smev:ServiceCode>5800000010000014762</smev:ServiceCode>
                <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
            </smev:Message>
            <smev:MessageData>
                <smev:AppData>
                    <q1:queryData>
                        <q1:address><?php echo $_POST['address']; ?></q1:address>
                        <q1:consentNotice><?php echo ($_POST['consentNotice']  == "on") ? 'true' : 'false'; ?></q1:consentNotice>
                        <q1:contacts>
                            <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
                        </q1:contacts>
                        <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO>
                        <q1:haveFamilyMember><?php echo ($_POST['haveFamilyMember']  == "on") ? 'true' : 'false'; ?></q1:haveFamilyMember>
                        <q1:identityDocument><?php echo $_POST['identityDocument']; ?></q1:identityDocument>
                        <q1:listLivedPeople>
                            <q3:comment><?php echo $_POST['comment']; ?></q3:comment>
                            <q3:FIO><?php echo $_POST['FIO']; ?></q3:FIO>
                            <q3:jointEconomy><?php echo ($_POST['jointEconomy']  == "on") ? 'true' : 'false'; ?></q3:jointEconomy>
                            <q3:relationDegree><?php echo $_POST['relationDegree']; ?></q3:relationDegree>
                        </q1:listLivedPeople>
                        <q1:officeName><?php echo $_POST['officeName']; ?></q1:officeName>
                    </q1:queryData>
                    <q4:inParams>
                        <q4:app_id><?php echo(htmlspecialchars($idRequest));?></q4:app_id>
                        <q4:form_id>123</q4:form_id>
                        <q4:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q4:status_date>
                    </q4:inParams>
                </smev:AppData>
                <smev:AppDocument>
                    <smev:RequestCode />
                    <smev:BinaryData><?php echo ($attachment->data);?></smev:BinaryData>
                </smev:AppDocument>
            </smev:MessageData>
        </smev:doQuery>
    </soapenv:Body>
</soapenv:Envelope>