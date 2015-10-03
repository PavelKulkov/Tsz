<?php $subservice_url_id = 14;
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
                            <q1:value>5800000010000044048</q1:value>
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
                            <q1:name>nameForestry</q1:name>
                            <q1:value><?php echo $_POST['nameForestry']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>volumeWood</q1:name>
                            <q1:value><?php echo $_POST['volumeWood']; ?></q1:value>
                        </q1:dataRow>
                        <?php 
                           for($i = 1; $i <= $_POST['volumeWood']; $i++) {
                           	  $name =  'name_'.$i.'_nameNeedsForTimber';
                           	  $liquid =  'liquid_'.$i.'_liquidVolume';
                           	  $farm =  'farm_'.$i.'_farmRequiredTimber';
                           	  $nameNee = $_POST[$name];
                           	  $liquidVol = $_POST[$liquid];
                           	  $farmReq = $_POST[$farm];
                           	
                           	  echo '<q1:dataRow><q1:name>volumeWood_nameNeedsForTimber_'.$i.'</q1:name><q1:value>'.$nameNee.'</q1:value></q1:dataRow>';	
                           	  echo '<q1:dataRow><q1:name>volumeWood_liquidVolume_'.$i.'</q1:name><q1:value>'.$liquidVol.'</q1:value></q1:dataRow>';	
                           	  echo '<q1:dataRow><q1:name>volumeWood_farmRequiredTimber_'.$i.'</q1:name><q1:value>'.$farmReq.'</q1:value></q1:dataRow>';	
                           } 
                        ?>                                                  
                        <q1:dataRow>
                            <q1:name>grantedToForestPlantationsPreviously</q1:name>
                            <q1:value><?php echo ($_POST['grantedToForestPlantationsPreviously']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>purposeOfUseOfWood</q1:name>
                            <q1:value><?php echo $_POST['purposeOfUseOfWood']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>dateOfReceiptOfTimber</q1:name>
                            <q1:value><?php echo $_POST['dateOfReceiptOfTimber']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>theVolumeOfTimber</q1:name>
                            <q1:value><?php echo $_POST['theVolumeOfTimber']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>flagHaveRightOnEstate</q1:name>
                            <q1:value><?php echo ($_POST['flagHaveRightOnEstate']  == "on") ? 'true' : 'false'; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>OKATO</q1:name>
                            <q1:value><?php echo $_POST['OKATO']; ?></q1:value>
                        </q1:dataRow>
                        <q1:dataRow>
                            <q1:name>OKATMO</q1:name>
                            <q1:value><?php echo $_POST['OKATMO']; ?></q1:value>
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
                            <q1:name>dokumentstotheobjectstobereconstructed</q1:name>
                            <q1:value><?php echo $_POST['dokumentstotheobjectstobereconstructed']; ?></q1:value>
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