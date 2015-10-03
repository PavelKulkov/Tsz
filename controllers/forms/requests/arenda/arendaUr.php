<?php
	$subservice_url_id = 38;
      $soapAction = "urn:doUrQuery";

?>



<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/estate/arenda" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">

<soapenv:Body>

	<smev:doUrQuery>

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
            <q1:addressActivites><?php echo $_POST['addressActivites'];?></q1:addressActivites>
            <q1:arendaPeriod><?php echo $_POST['arendaPeriod'];?></q1:arendaPeriod>
            <q1:forUseUnder><?php echo $_POST['forUseUnder'];?></q1:forUseUnder>
            <q1:square><?php echo $_POST['square'];?></q1:square>
            <q1:typeOfLease><?php echo $_POST['typeOfLease'];?></q1:typeOfLease>
          </q1:queryData>
          <q1:urQueryData>
            <q1:contacts>
              <q2:phone><?php echo $_POST['phone'];?></q2:phone>
              <q2:eMail><?php echo $_POST['eMail'];?></q2:eMail>
            </q1:contacts>
            <q1:egrpData>
              <q2:INN><?php echo $_POST['INN'];?></q2:INN>
              <q2:OGRN><?php echo $_POST['OGRN'];?></q2:OGRN>
            </q1:egrpData>
            
			<q1:flagLivingNotRussia><?php echo (($_POST['flagLivingNotRussia'] == "on") ? 'true' : 'false'); ?></q1:flagLivingNotRussia>
			
            <q1:flagRepresentative><?php echo (($_POST['flagRepresentative'] == "on") ? 'true' : 'false'); ?></q1:flagRepresentative>
            
			<q1:KPP><?php echo $_POST['KPP'];?></q1:KPP>
            <q1:organizationAddress><?php echo $_POST['organizationAddress'];?></q1:organizationAddress>
            <q1:organizationFirmName><?php echo $_POST['organizationFirmName'];?></q1:organizationFirmName>
            <q1:organizationName><?php echo $_POST['organizationName'];?></q1:organizationName>
            <q1:organizationShortName><?php echo $_POST['organizationShortName'];?></q1:organizationShortName>
          </q1:urQueryData>
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
	</smev:doUrQuery>
  </soapenv:Body>
</soapenv:Envelope>