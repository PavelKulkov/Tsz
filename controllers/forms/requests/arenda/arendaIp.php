<?php 
	$subservice_url_id = 38;
      $soapAction = "urn:doIpQuery";

?>

 
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/estate/arenda" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

<soapenv:Body>
	<smev:doIpQuery>
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
        <smev:TypeCode>GSRV</smev:TypeCode>
        <smev:Status>REQUEST</smev:Status>
        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
        <smev:ExchangeType/>
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>FundWomenService</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>
      <smev:MessageData>
        <smev:AppData>
          <q1:queryData>
            <q1:addressActivites><?php echo $_POST['addressActivites']; ?></q1:addressActivites>
            <q1:arendaPeriod><?php echo $_POST['arendaPeriod']; ?></q1:arendaPeriod>
            <q1:forUseUnder><?php echo $_POST['forUseUnder']; ?></q1:forUseUnder>
            <q1:square><?php echo $_POST['square']; ?></q1:square>
            <q1:typeOfLease><?php echo $_POST['typeOfLease']; ?></q1:typeOfLease>
          </q1:queryData>
          <q1:ipQueryData>
            <q1:addressActualResiding><?php echo $_POST['addressActualResiding']; ?></q1:addressActualResiding>
            <q1:contacts>
              <q2:phone><?php echo $_POST['phone']; ?></q2:phone>
              <q2:eMail><?php echo $_POST['eMail']; ?></q2:eMail>
            </q1:contacts>
            <q1:egrData>
              <q2:INN><?php echo $_POST['INN']; ?></q2:INN>
              <q2:OGRN><?php echo $_POST['OGRN']; ?></q2:OGRN>
            </q1:egrData>
            <q1:FIO><?php echo $_POST['FIO']; ?></q1:FIO>
            <q1:flagLivingNotRussia><?php echo (($_POST['flagLivingNotRussia'] == "on") ? 'true' : 'false'); ?></q1:flagLivingNotRussia>
          </q1:ipQueryData>
		<q3:inParams>
		  <q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id> 
          <q3:form_id>1</q3:form_id> 
          <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date> 
        </q3:inParams>
        </smev:AppData>
        <smev:AppDocument>
          <smev:RequestCode/>
          <smev:BinaryData><?php echo ($attachment->data);?></smev:BinaryData>
        </smev:AppDocument>
      </smev:MessageData>
	</smev:doIpQuery>
  </soapenv:Body>
</soapenv:Envelope>