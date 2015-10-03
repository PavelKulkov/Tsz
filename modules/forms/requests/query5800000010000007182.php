<?php   
	$soapAction = "urn:doQuery";
?>


<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/edu/license/learn" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">


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
		<smev:ServiceName>LearnActivityService</smev:ServiceName> 
        <smev:TypeCode>GSRV</smev:TypeCode>
        <smev:Status>REQUEST</smev:Status>
        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
          <smev:ExchangeType>33333333333</smev:ExchangeType> 
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>LearnActivityService</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>


  <smev:MessageData>

  <smev:AppData>

  <q1:queryData>

  <q1:bossEmail><?php echo $_POST['bossEmail']; ?></q1:bossEmail> 

  <q1:bossFIO><?php echo $_POST['bossFIO']; ?></q1:bossFIO> 

  <q1:bossPhone><?php echo $_POST['bossPhone']; ?></q1:bossPhone> 

  <q1:bossPost><?php echo $_POST['bossPost']; ?></q1:bossPost> 

  <q1:egrQueryData>

  <q2:INN><?php echo $_POST['INN']; ?></q2:INN> 

  <q2:OGRN><?php echo $_POST['OGRN']; ?></q2:OGRN> 

  </q1:egrQueryData>

  <q1:flagArenda><?php echo ($_POST['flagArenda']  == "on") ? 'true' : 'false'; ?></q1:flagArenda> 

  <q1:flagBranchLicense><?php echo ($_POST['flagBranchLicense']  == "on") ? 'true' : 'false'; ?></q1:flagBranchLicense> 

  <q1:flagEducationUnit><?php echo ($_POST['flagEducationUnit']  == "on") ? 'true' : 'false'; ?></q1:flagEducationUnit> 

  <q1:hasBranchs><?php echo ($_POST['hasBranchs']  == "on") ? 'true' : 'false'; ?></q1:hasBranchs> 

  <q1:KPP><?php echo $_POST['KPP']; ?></q1:KPP> 

  <q1:licenseActivityAddress><?php echo $_POST['licenseActivityAddress']; ?></q1:licenseActivityAddress> 

  <q1:nameEducationPrograms><?php echo $_POST['nameEducationPrograms']; ?></q1:nameEducationPrograms> 

  <q1:organizationAddress><?php echo $_POST['organizationAddress']; ?></q1:organizationAddress> 

  <q1:organizationName><?php echo $_POST['organizationName']; ?></q1:organizationName> 

  <q1:organizationType><?php echo $_POST['organizationType']; ?></q1:organizationType> 

  </q1:queryData>

  <q3:systemParams>

  <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id> 

  <q3:form_id>15</q3:form_id> 

  <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date> 

  </q3:systemParams>

  </smev:AppData>

  <smev:AppDocument>

  <smev:RequestCode/> 

  <smev:BinaryData><?php echo ($attachment->data);?></smev:BinaryData> 

  </smev:AppDocument>

  </smev:MessageData>

  </smev:doQuery>

  </soapenv:Body>

  </soapenv:Envelope>