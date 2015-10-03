<?php 
      $soapAction = "urn:doQuery";

?>

<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/edu/accreditation/learn" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

<soap:Body>

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
		<smev:ServiceName>LearnActivityAccredService</smev:ServiceName> 
        <smev:TypeCode>GSRV</smev:TypeCode>
        <smev:Status>REQUEST</smev:Status>
        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
        <smev:ExchangeType>33333333333</smev:ExchangeType> 
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>LearnActivityAccredService</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>
	 
  <smev:MessageData>

  <smev:AppData>

  <q1:learnQuery>

  <q1:bossEmail><?php echo $_POST['bossEmail']; ?></q1:bossEmail> 

  <q1:bossFIO><?php echo $_POST['bossFIO']; ?></q1:bossFIO> 

  <q1:bossPhone><?php echo $_POST['bossPhone']; ?></q1:bossPhone> 

  <q1:bossPost><?php echo $_POST['bossPost']; ?></q1:bossPost> 

  <q1:branchFullName><?php echo $_POST['branchFullName']; ?></q1:branchFullName> 

  <q1:egrData>

  <q2:INN><?php echo $_POST['INN']; ?></q2:INN> 

  <q2:OGRN><?php echo $_POST['OGRN']; ?></q2:OGRN> 

  </q1:egrData>

  <q1:flagBranchAccreditation><?php echo ($_POST['flagBranchAccreditation']  == "on") ? 'true' : 'false'; ?></q1:flagBranchAccreditation> 

  <q1:flagOthersLicense><?php echo ($_POST['flagOthersLicense']  == "on") ? 'true' : 'false'; ?></q1:flagOthersLicense> 

  <q1:hasBranchs><?php echo ($_POST['hasBranchs']  == "on") ? 'true' : 'false'; ?></q1:hasBranchs> 

  <q1:KPP><?php echo $_POST['KPP']; ?></q1:KPP> 

  <q1:kindOfOrganization><?php echo $_POST['kindOfOrganization']; ?></q1:kindOfOrganization> 

  <q1:organizationAddress><?php echo $_POST['organizationAddress']; ?></q1:organizationAddress> 

  <q1:organizationName><?php echo $_POST['organizationName']; ?></q1:organizationName> 

  <q1:organizationType><?php echo $_POST['organizationType']; ?></q1:organizationType> 

  <q1:typeOfOrganization><?php echo $_POST['typeOfOrganization']; ?></q1:typeOfOrganization> 

  </q1:learnQuery>

  <q3:systemParams>

  <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id> 

  <q3:form_id>19</q3:form_id> 

  <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date>

  </q3:systemParams>

  </smev:AppData>

  <smev:AppDocument>

  <smev:RequestCode/> 

  <smev:BinaryData><?php echo ($attachment->data);?></smev:BinaryData> 

  </smev:AppDocument>

  </smev:MessageData>

  </smev:doQuery>

  </soap:Body>

  </soap:Envelope>