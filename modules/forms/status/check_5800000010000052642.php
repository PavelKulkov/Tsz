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
                            <q1:value>5800000010000052644</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>organizationName</q1:name>
                            <q1:value><?php echo $_POST['organizationName']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>organizationShortName</q1:name>
                            <q1:value><?php echo $_POST['organizationShortName']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>organizationFirmName</q1:name>
                            <q1:value><?php echo $_POST['organizationFirmName']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>INN</q1:name>
                            <q1:value><?php echo $_POST['INN']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>OGRN</q1:name>
                            <q1:value><?php echo $_POST['OGRN']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>KPP</q1:name>
                            <q1:value><?php echo $_POST['KPP']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>organizationAddress</q1:name>
                            <q1:value><?php echo $_POST['organizationAddress']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>isLinearObject</q1:name>
                            <q1:value><?php echo ($_POST['isLinearObject']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>flagHaveRightOnEstate</q1:name>
                            <q1:value><?php echo ($_POST['flagHaveRightOnEstate']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>surveyWork</q1:name>
                            <q1:value><?php echo ($_POST['surveyWork']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>geologicalExplorationofmineralResources</q1:name>
                            <q1:value><?php echo ($_POST['geologicalExplorationofmineralResources']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>activitiesInTheFieldOfHunting</q1:name>
                            <q1:value><?php echo ($_POST['activitiesInTheFieldOfHunting']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>cadastralRegistration</q1:name>
                            <q1:value><?php echo ($_POST['cadastralRegistration']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>investmentProjectDocuments</q1:name>
                            <q1:value><?php echo ($_POST['investmentProjectDocuments']  == "on") ? 'true' : 'false'; ?></q1:value>
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
                            <q1:name>forestryArea</q1:name>
                            <q1:value><?php echo $_POST['countForestBlock']; ?></q1:value>
                        </q1:dataRow>
						
						
					  <?php 
						
						for ($i=1; $i <= $_POST['countForestBlock']; $i++) {
						
						echo "
						
                        <q1:dataRow>
                            <q1:name>forestryArea_forestry_".$i."</q1:name>
                            <q1:value>".$_POST['forestry_'.$i.'']."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>forestryArea_forestDistrict_".$i."</q1:name>
                            <q1:value>".$_POST['forestDistric_'.$i.'']."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>forestryArea_forestBlock_".$i."</q1:name>
                            <q1:value>".$_POST['forestBlock_'.$i.'']."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>forestryArea_inventoryAreas_".$i."</q1:name>
                            <q1:value>".$_POST['inventoryAreas_'.$i.'']."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>forestryArea_landArea_".$i."</q1:name>
                            <q1:value>".$_POST['landArea_'.$i.'']."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>forestryArea_intendedUseOfForests_".$i."</q1:name>
                            <q1:value>".$_POST['intendedUseOfForests_'.$i.'']."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>forestryArea_categoryOfProtectionForests_".$i."</q1:name>
                            <q1:value>".$_POST['categoryOfProtectionForests_'.$i.'']."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>forestryArea_termForestManagement_".$i."</q1:name>
                            <q1:value>".$_POST['termForestManagement_'.$i.'']."</q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>forestryArea_useOfForests_".$i."</q1:name>
                            <q1:value>".$_POST['useOfForests_'.$i.'']."</q1:value>
                        </q1:dataRow>

						";
						
						}
						
						?>
						

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