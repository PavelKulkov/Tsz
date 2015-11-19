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
                            <q1:value>5840100010000006106</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>officeName</q1:name>
                            <q1:value><?php echo $_POST['officeName']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>categoryApplicant</q1:name>
                            <q1:value><?php echo $_POST['categoryApplicant']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>FIO</q1:name>
                            <q1:value><?php echo $_POST['FIO']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>identityDocument</q1:name>
                            <q1:value><?php echo $_POST['identityDocument']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>addressActualResiding</q1:name>
                            <q1:value><?php echo $_POST['addressActualResiding']; ?></q1:value>
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
                            <q1:name>birthDay</q1:name>
                            <?php $birth = explode('-', $_POST['birthDay']); ?>
                            <q1:value><?php echo $birth[0].'/'.$birth[1].'/'.$birth[2]; ?></q1:value>
                        </q1:dataRow>
                        
                        <q1:dataRow>
                            <q1:name>age</q1:name>
                            <q1:value><?php echo $_POST['age']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>education</q1:name>
                            <q1:value><?php echo $_POST['education']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>institution</q1:name>
                            <q1:value><?php echo $_POST['institution']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>profession</q1:name>
                            <q1:value><?php echo $_POST['profession']; ?></q1:value>
                        </q1:dataRow>
                        
                         <q1:dataRow>
                            <q1:name>qualification</q1:name>
                            <q1:value><?php echo $_POST['qualification']; ?></q1:value>
                        </q1:dataRow>
                         <q1:dataRow>
                            <q1:name>post</q1:name>
                            <q1:value><?php echo $_POST['post']; ?></q1:value>
                        </q1:dataRow>
                         <q1:dataRow>
                            <q1:name>kindOfActivity</q1:name>
                            <q1:value><?php echo $_POST['kindOfActivity']; ?></q1:value>
                        </q1:dataRow>
                        
                        
                        
                        <q1:dataRow>
                            <q1:name>entryInTheWorkbook</q1:name>
                            <q1:value><?php echo ($_POST['entryInTheWorkbook']  == "on") ? 'true' : 'false'; ?> </q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>flagDisability</q1:name>
                            <q1:value><?php echo ($_POST['flagDisability']  == "on") ? 'true' : 'false'; ?> </q1:value>
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