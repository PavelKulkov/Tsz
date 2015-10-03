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
                            <q1:value>5800000010000061502</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>certificationOfTeachers</q1:name>
                            <q1:value><?php echo $_POST['certificationOfTeachers']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>FIO</q1:name>
                            <q1:value><?php echo $_POST['FIO']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>birthDay</q1:name>
                            <?php $birthDay = str_replace('-', '/', $_POST['birthDay']); ?>
                            <q1:value><?php echo $birthDay; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>identityDocument</q1:name>
                            <q1:value><?php echo $_POST['identityDocument']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>informationAboutEducation</q1:name>
                            <q1:value><?php echo $_POST['informationAboutEducation']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>postHeldAtTheTimeCertification</q1:name>
                            <q1:value><?php echo $_POST['postHeldAtTheTimeCertification']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>dateOfAppointment</q1:name>
                            <?php $dateOfAppointment = str_replace('-', '/', $_POST['dateOfAppointment']); ?>
                            <q1:value><?php echo $dateOfAppointment; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>experienceOfPedagogicalWork</q1:name>
                            <q1:value><?php echo $_POST['experienceOfPedagogicalWork']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>professionalDevelopment</q1:name>
                            <q1:value><?php echo $_POST['professionalDevelopment']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>finalCertificationCategory</q1:name>
                            <q1:value><?php echo $_POST['finalCertificationCategory']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>finalCertificationPosition</q1:name>
                            <q1:value><?php echo $_POST['finalCertificationPosition']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>informationOnRewardings</q1:name>
                            <q1:value><?php echo $_POST['informationOnRewardings']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>performance</q1:name>
                            <q1:value><?php echo $_POST['performance']; ?></q1:value>
                        </q1:dataRow>  
                         <q1:dataRow>
                            <q1:name>indicatorsOfStudents</q1:name>
                            <q1:value><?php echo $_POST['indicatorsOfStudents']; ?></q1:value>
                        </q1:dataRow>        
                         <q1:dataRow>
                            <q1:name>jobPlace</q1:name>
                            <q1:value><?php echo $_POST['jobPlace']; ?></q1:value>
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
                            <q1:name>otherDocumentsScan</q1:name>
                            <q1:value><?php echo $_POST['otherDocumentsScanCount']; ?></q1:value>
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