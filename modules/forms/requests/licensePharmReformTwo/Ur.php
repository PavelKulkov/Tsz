<?php   
	$subservice_url_id = 86;
	$soapAction = "urn:doReformTwoForUr";
?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/minaid/license/pharm" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <soapenv:Body xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" wsu:Id="doReformTwoForUr">
    <smev:doReformTwoForUr>
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
        <smev:ServiceName>PharmActivityService</smev:ServiceName>
        <smev:TypeCode>GSRV</smev:TypeCode>
        <smev:Status>REQUEST</smev:Status>
        <smev:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></smev:Date>
        <smev:ExchangeType>111111</smev:ExchangeType>
        <smev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:RequestIdRef>
        <smev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></smev:OriginRequestIdRef>
        <smev:ServiceCode>5800000010000053602</smev:ServiceCode>
        <smev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></smev:CaseNumber>
      </smev:Message>
      <smev:MessageData>
        <smev:AppData>
          <q1:dataUrRequestReformTwo>
            <q1:dataUr>
              <q1:contacts>
                <q2:phone>6666666</q2:phone>
              </q1:contacts>
              <q1:egrpData>
                <q2:INN>6666666666</q2:INN>
                <q2:OGRN>6666666666666</q2:OGRN>
              </q1:egrpData>
              <q1:KPP>666666666</q1:KPP>
              <q1:organizationAddress>666666666</q1:organizationAddress>
              <q1:organizationFirmName>66666666</q1:organizationFirmName>
              <q1:organizationName>666666</q1:organizationName>
              <q1:organizationShortName>1111111</q1:organizationShortName>
            </q1:dataUr>
            <q1:flagHaveRightOnEstate>true</q1:flagHaveRightOnEstate>
            <q1:OKATO>66666666666</q1:OKATO>
          </q1:dataUrRequestReformTwo>
          <q1:dataReformTwo>
            <q1:dataPharmDictionary>
              <q1:pharmDictionary>N1</q1:pharmDictionary>
            </q1:dataPharmDictionary>
            <q1:dataPharmDictionary>
              <q1:pharmDictionary>n3</q1:pharmDictionary>
            </q1:dataPharmDictionary>
            <q1:licenseActivityAddress>1111111</q1:licenseActivityAddress>
          </q1:dataReformTwo>
          <q3:inParams xmlns:q3="http://oep-penza.ru/com/oep">
			<q3:app_id><?php echo(htmlspecialchars($idRequest));?></q3:app_id>
            <q3:form_id>16</q3:form_id>
            <q3:status_date><?php echo(htmlspecialchars($nowTimeWithFormat));?></q3:status_date>
		  </q3:inParams>
        </smev:AppData>
        <smev:AppDocument>
          <smev:RequestCode/>
          <smev:BinaryData>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bWVudE9yZGVyU2Nhbi50eHRQSwECFAAUAAgICABXgVxCWystGgYAAAAEAAAAJgAAAAAAAAAAAAAAAAC9AgAAZGF0YVJlZm9ybVR3b1xwZXRpdGlvbkRvY3VtZW50U2Nhbi50eHRQSwECFAAUAAgICABXgVxCyLZtYgsAAAAIAAAAYQAAAAAAAAAAAAAAAAAXAwAAZGF0YVJlZm9ybVR3b1xwaGFybURlYWxlclNwZWNpYWxpc3RzRWR1Y2F0aW9uRG9jc1NjYW5ccGhhcm1EZWFsZXJTcGVjaWFsaXN0c0VkdWNhdGlvbkRvY3NTY2FuLnR4dFBLAQIUABQACAgIAFeBXELDIxufCAAAAAYAAABVAAAAAAAAAAAAAAAAALEDAABkYXRhUmVmb3JtVHdvXHBoYXJtU3BlY2lhbGlzdHNFZHVjYXRpb25Eb2NzU2NhblxwaGFybVNwZWNpYWxpc3RzRWR1Y2F0aW9uRG9jc1NjYW4udHh0UEsBAhQAFAAICAgAV4FcQnOcrkAIAAAABgAAACoAAAAAAAAAAAAAAAAAPAQAAGRhdGFSZWZvcm1Ud29cc2FuaXRhcnlOb3JtRG9jdW1lbnRTY2FuLnR4dFBLBQYAAAAACwALADsEAACcBAAAAAA=</smev:BinaryData>
        </smev:AppDocument>
      </smev:MessageData>
    </smev:doReformTwoForUr>
  </soapenv:Body>
</soapenv:Envelope>