<?php 
      $soapAction = "urn:registateQuery";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/minaid/license/drugs" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

<soapenv:Body>
    <smev:registateQuery>
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
		<smev:ServiceName>DrugsLicenseLiveCycleService</smev:ServiceName> 
        <smev:TypeCode>GSRV</smev:TypeCode>
        <smev:Status>REQUEST</smev:Status>
        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
          <smev:ExchangeType>33333333333</smev:ExchangeType> 
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>DrugsLicenseLiveCycleService</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>
      <smev:MessageData>
        <smev:AppData>
          <q1:dataLicenseQuery>
            <q1:applicantData>
              <q1:contacts>
                <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
                <q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
              </q1:contacts>
              <q1:egrpData>
                <q2:INN><?php echo $_POST['INN']; ?></q2:INN>
                <q2:OGRN><?php echo $_POST['OGRN']; ?></q2:OGRN>
              </q1:egrpData>
              <q1:KPP><?php echo $_POST['KPP']; ?></q1:KPP>
              <q1:licenseActivityAddress><?php echo $_POST['licenseActivityAddress']; ?></q1:licenseActivityAddress>
              <q1:organizationAddress><?php echo $_POST['organizationAddress']; ?></q1:organizationAddress>
              <q1:organizationFirmName><?php echo $_POST['organizationFirmName']; ?></q1:organizationFirmName>
              <q1:organizationName><?php echo $_POST['organizationName']; ?></q1:organizationName>
              <q1:organizationShortName><?php echo $_POST['organizationShortName']; ?></q1:organizationShortName>
            </q1:applicantData>
            <q1:flagHaveRightOnEstate><?php echo ($_POST['flagHaveRightOnEstate']  == "on") ? 'true' : 'false'; ?></q1:flagHaveRightOnEstate>
            <q1:listOfDrugs>
              <q1:listOfDrugs><?php echo $_POST['listOfDrugs']; ?></q1:listOfDrugs>
            </q1:listOfDrugs>
            <q1:OKATO><?php echo $_POST['OKATO']; ?></q1:OKATO>
            <q1:OKTMO><?php echo $_POST['OKTMO']; ?></q1:OKTMO>
            <q1:serviceType>
              <q1:serviceType><?php echo $_POST['serviceType']; ?></q1:serviceType>
            </q1:serviceType>
          </q1:dataLicenseQuery>
          <q3:inParams>
			  <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id> 
			  <q3:form_id>15</q3:form_id> 
			  <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date> 
          </q3:inParams>
        </smev:AppData>
        <smev:AppDocument>
          <smev:RequestCode/>
          <smev:BinaryData><?php echo ($attachment->data);?></smev:BinaryData>
        </smev:AppDocument>
      </smev:MessageData>
    </smev:registateQuery>
  </soapenv:Body>
</soapenv:Envelope>