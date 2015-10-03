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
                            <q1:value>5800000010000013881</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>officeName</q1:name>
                            <q1:value><?php echo $_POST['officeName']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>FIO</q1:name>
                            <q1:value><?php echo $_POST['FIO']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
						<?php
						
						$birthDayArr = explode('-', $_POST['birthDay']);
						$birthDay = $birthDayArr[0].'/'.$birthDayArr[1].'/'.$birthDayArr[2];
						
						?>
                            <q1:name>birthDay</q1:name>
                            <q1:value><?php echo $birthDay; ?></q1:value>
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
                            <q1:name>FIOspouse</q1:name>
                            <q1:value><?php echo $_POST['FIOSpouse']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
						
						<?php
						
						$birthDaySpouseArr = explode('-', $_POST['birthDaySpouse']);
						$birthDaySpouse = $birthDaySpouseArr[0].'/'.$birthDaySpouseArr[1].'/'.$birthDaySpouseArr[2];
						
						?>
						
                            <q1:name>birthDaySpouse</q1:name>
                            <q1:value><?php echo $birthDaySpouse; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>identityDocumentSpouse</q1:name>
                            <q1:value><?php echo $_POST['identityDocumentSpouse']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>addressActualResidingSpouse</q1:name>
                            <q1:value><?php echo $_POST['addressActualResidingSpouse']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>child</q1:name>
                            <q1:value><?php echo $_POST['countChildBlock']; ?></q1:value>
                        </q1:dataRow>
						
					
					  <?php 
						
						for ($i=1; $i <= $_POST['countChildBlock']; $i++) {
						
						$childBirthDayArr = explode('-', $_POST['childBirthDay_'.$i.'']);
						$childBirthDay = $childBirthDayArr[0].'/'.$childBirthDayArr[1].'/'.$childBirthDayArr[2];
						
						echo "
						
                        <q1:dataRow>
                            <q1:name>child_childFIO_".$i."</q1:name>
                            <q1:value>".$_POST['childFIO_'.$i.'']."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>child_childBirthDay_".$i."</q1:name>
                            <q1:value>".$childBirthDay."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>child_childAddress_".$i."</q1:name>
                            <q1:value>".$_POST['childAddress_'.$i.'']."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>child_birthDayChildren_".$i."</q1:name>
                            <q1:value>".$_POST['birthDayChildren_'.$i.'']."</q1:value>
                        </q1:dataRow>

						";
						
						}
						
						?>
						
						
						
                        <q1:dataRow>
                            <q1:name>flagHaveRightOnEstate</q1:name>
                            <q1:value><?php echo ($_POST['flagHaveRightOnEstate']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>OKATO</q1:name>
                            <q1:value><?php echo $_POST['OKATO']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>OKTMO</q1:name>
                            <q1:value><?php echo $_POST['OKTMO']; ?></q1:value>
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
                            <q1:name>identityDocumentScan</q1:name>
                            <q1:value><?php echo $_POST['identityDocumentScan']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>birthDayChildrenDocumentScan</q1:name>
                            <q1:value><?php echo $_POST['birthDayChildrenDocumentScan']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>rostehinventarizatsiya</q1:name>
                            <q1:value><?php echo $_POST['rostehinventarizatsiya']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>documentsConfirmingMembers</q1:name>
                            <q1:value><?php echo $_POST['documentsConfirmingMembers']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>flagMortgage</q1:name>
                            <q1:value><?php echo ($_POST['flagMortgage']  == "on") ? 'true' : 'false'; ?></q1:value>
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