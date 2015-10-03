<?php 
      $soapAction = "urn:doMonthNQuery";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/minaid/finance/child" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <soapenv:Body>
        <smev:doMonthNQuery>
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
                <smev:ServiceName>FundChildAidService</smev:ServiceName>
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
                    <q1:queryNData>
                        <q1:applicantData>
                            <q1:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q1:addressActualResiding>
                            <q1:contacts>
                                <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
								<q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
                            </q1:contacts>
                            <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO>
                            <q1:identityDocument><?php echo $_POST['identityDocument']; ?></q1:identityDocument>
                            <q1:officeName><?php echo $_POST['officeName']; ?></q1:officeName>
                        </q1:applicantData>
                        <q1:flagAlienApplicant><?php echo ($_POST['flagAlienApplicant']  == "on") ? 'true' : 'false'; ?></q1:flagAlienApplicant>
                        <q1:kindIdentityDocument><?php echo $_POST['kindIdentityDocument']; ?></q1:kindIdentityDocument>
                    </q1:queryNData>
                    <q1:childrenInfoMonthN>
					
					  <?php 
						
						for ($i=1; $i <= $_POST['countChild']; $i++) {
						
						$childBirthDayArr = explode('-', $_POST['childInfo_'.$i.'_childBirthDay']);
						$childBirthDay = $childBirthDayArr[2].'-'.$childBirthDayArr[1].'-'.$childBirthDayArr[0];
		
						echo '
                        <q1:monthNData>
                            <q1:ageChild>'.$_POST['childInfo_'.$i.'_ageChild'].'</q1:ageChild>
                            <q1:childInfo>
                                <q1:childBirthDay>'.$childBirthDay.'</q1:childBirthDay>
                                <q1:childFIO>'.$_POST['childInfo_'.$i.'_childFIO'].'</q1:childFIO>
                            </q1:childInfo>
                            <q1:flagGuardian>'.(($_POST['childInfo_'.$i.'_flagGuardian'] == "on") ? 'true' : 'false').'</q1:flagGuardian>
                        </q1:monthNData>';
						
						}
						
						?>
						
                    </q1:childrenInfoMonthN>
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
        </smev:doMonthNQuery>
    </soapenv:Body>
</soapenv:Envelope>