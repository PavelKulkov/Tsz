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
                            <q1:value>5800000010000014805</q1:value>
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
                            <q1:name>position</q1:name>
                            <q1:value><?php echo $_POST['position']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>nameOrganization</q1:name>
                            <q1:value><?php echo $_POST['nameOrganization']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>spouse</q1:name>
                            <q1:value><?php echo ($_POST['spouse']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>FIOSpouse</q1:name>
                            <q1:value><?php echo $_POST['FIOSpouse']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>applicantIdentityDocument</q1:name>
                            <q1:value><?php echo $_POST['applicantIdentityDocument']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>actualAddress</q1:name>
                            <q1:value><?php echo $_POST['actualAddress']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>haveChildren</q1:name>
                            <q1:value><?php echo ($_POST['haveChildren']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>child</q1:name>
                            <q1:value><?php echo $_POST['countChildBlock']; ?></q1:value>
                        </q1:dataRow>
						
					
					  <?php 
						
						for ($i=1; $i <= $_POST['countChildBlock']; $i++) {
						
						$childBirthDayArr = explode('-', $_POST['dateOfBirth_'.$i.'']);
						$childBirthDay = $childBirthDayArr[0].'/'.$childBirthDayArr[1].'/'.$childBirthDayArr[2];
						
						echo "
						
                        <q1:dataRow>
                            <q1:name>child_FIOChild_".$i."</q1:name>
                            <q1:value>".$_POST['FIOChild_'.$i.'']."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>child_dateOfBirth_".$i."</q1:name>
                            <q1:value>".$childBirthDay."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>child_identityDocumentChildren_".$i."</q1:name>
                            <q1:value>".$_POST['identityDocumentChildren_'.$i.'']."</q1:value>
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
                            <q1:name>informationAboutPropertyScan</q1:name>
                            <q1:value><?php echo $_POST['informationAboutPropertyScan']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>documentsProvingTheirRelationshipScan</q1:name>
                            <q1:value><?php echo $_POST['documentsProvingTheirRelationshipScan']; ?></q1:value>
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