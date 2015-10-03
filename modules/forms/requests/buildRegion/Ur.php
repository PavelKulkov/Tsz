<?php 
	$subservice_url_id = 51;
      $soapAction = "urn:doRequestForUr";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q0="http://smev.gosuslugi.ru/rev120315" xmlns:q1="http://oep-penza.ru/com/oep/omsu/build/region" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
    <soapenv:Body>
        <q0:doRequestForUr>
		  <q0:Message>
		  <q0:Sender>
		  <q0:Code><?php echo(htmlspecialchars($sender[0]));?></q0:Code> 
		  <q0:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></q0:Name> 
		  </q0:Sender>
		  <q0:Recipient>
		  <q0:Code><?php echo(htmlspecialchars($sender[0]));?></q0:Code> 
		  <q0:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></q0:Name> 
		  </q0:Recipient>
		  <q0:Originator>
		  <q0:Code><?php echo(htmlspecialchars($sender[0]));?></q0:Code> 
		  <q0:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></q0:Name> 
		  </q0:Originator>
		  <q0:ServiceName>FundBuildActivityService</q0:ServiceName> 
		  <q0:TypeCode>GSRV</q0:TypeCode> 
		  <q0:Status>REQUEST</q0:Status> 
		  <q0:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q0:Date> 
		  <q0:ExchangeType>333333333333</q0:ExchangeType> 
		  <q0:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></q0:RequestIdRef> 
		  <q0:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></q0:OriginRequestIdRef> 
		  <q0:ServiceCode>33333</q0:ServiceCode> 
		  <q0:CaseNumber><?php echo(htmlspecialchars($idRequest));?></q0:CaseNumber> 
		  </q0:Message>
            <q0:MessageData>
                <q0:AppData>
                    <q1:urQueryData>
                        <q1:flagHaveRightOnEstate><?php echo ($_POST['flagHaveRightOnEstate']  == "on") ? 'true' : 'false'; ?></q1:flagHaveRightOnEstate>
                        <q1:OKATO><?php echo $_POST['OKATO']; ?></q1:OKATO>
						<q1:OKTMO><?php echo $_POST['OKTMO']; ?></q1:OKTMO>
                        <q1:urData>
                            <q2:contacts>
                                <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
								<q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
                            </q2:contacts>
                            <q2:egrpData>
                                <q2:INN><?php echo $_POST['INN']; ?></q2:INN>
                                <q2:OGRN><?php echo $_POST['OGRN']; ?></q2:OGRN>
                            </q2:egrpData>
                            <q2:KPP><?php echo $_POST['KPP']; ?></q2:KPP>
                            <q2:organizationAddress><?php echo $_POST['organizationAddress']; ?></q2:organizationAddress>
                            <q2:organizationFirmName><?php echo $_POST['organizationFirmName']; ?></q2:organizationFirmName>
                            <q2:organizationName><?php echo $_POST['organizationName']; ?></q2:organizationName>
                            <q2:organizationShortName><?php echo $_POST['organizationShortName']; ?></q2:organizationShortName>
                        </q1:urData>
                    </q1:urQueryData>
                    <q1:queryData>
                        <q1:flagDistruction><?php echo ($_POST['flagDistruction']  == "on") ? 'true' : 'false'; ?></q1:flagDistruction>
                        <q1:nonStateExamination><?php echo ($_POST['nonStateExamination']  == "on") ? 'true' : 'false'; ?></q1:nonStateExamination>
                    </q1:queryData>
                    <q3:inParams>
                        <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id>
                        <q3:form_id>16</q3:form_id>
                        <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date>
                    </q3:inParams>
                </q0:AppData>
                <q0:AppDocument>
                    <q0:RequestCode />
                    <q0:BinaryData><?php echo ($attachment->data);?></q0:BinaryData>
                </q0:AppDocument>
            </q0:MessageData>
        </q0:doRequestForUr>
    </soapenv:Body>
</soapenv:Envelope>