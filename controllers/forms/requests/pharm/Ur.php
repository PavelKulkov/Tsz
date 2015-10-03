<?php 
      $soapAction = "urn:doTermForUr";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:q0="http://pharm.license.minaid.oep.com/" xmlns:q1="http://smev.gosuslugi.ru/rev110801" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep/minaid/license/pharm" xmlns:q4="http://oep-penza.ru/com/oep" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

<soapenv:Body>
    <rev:doTermForUr>
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
		<smev:ServiceName>IPGUSERVICE55811003</smev:ServiceName> 
        <smev:TypeCode>GSRV</smev:TypeCode>
        <smev:Status>REQUEST</smev:Status>
        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
          <smev:ExchangeType>1</smev:ExchangeType> 
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>5800000010000014762</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>
      <rev:MessageData>
        <rev:AppData>
          <q1:dataUr xmlns:q1="http://oep-penza.ru/com/oep/minaid/license/pharm" xmlns:q2="http://oep-penza.ru/com/oep/declarant">
            <q1:contacts>
              <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
              <q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
            </q1:contacts>
            <q1:egrpData>
              <q2:INN><?php echo $_POST['INN']; ?></q2:INN>
              <q2:OGRN><?php echo $_POST['OGRN']; ?></q2:OGRN>
            </q1:egrpData>
            <q1:KPP><?php echo $_POST['KPP']; ?></q1:KPP>
            <q1:organizationAddress><?php echo $_POST['organizationAddress']; ?></q1:organizationAddress>
            <q1:organizationFirmName><?php echo $_POST['organizationFirmName']; ?></q1:organizationFirmName>
            <q1:organizationName><?php echo $_POST['organizationName']; ?></q1:organizationName>
            <q1:organizationShortName><?php echo $_POST['organizationShortName']; ?></q1:organizationShortName>
          </q1:dataUr>
          <q1:dataTerm xmlns:q1="http://oep-penza.ru/com/oep/minaid/license/pharm" />
          <q3:inParams xmlns:q3="http://oep-penza.ru/com/oep">
		  <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id> 
		  <q3:form_id>16</q3:form_id> 
		  <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date>
          </q3:inParams>
        </rev:AppData>
        <rev:AppDocument>
          <rev:RequestCode />
          <rev:BinaryData><?php echo ($attachment->data);?></rev:BinaryData>
        </rev:AppDocument>
      </rev:MessageData>
    </rev:doTermForUr>
  </soapenv:Body>
</soapenv:Envelope>