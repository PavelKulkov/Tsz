<?php   
	$subservice_url_id = 86;
	$soapAction = "urn:doReformTwoForIp";
?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:q1="http://oep-penza.ru/com/oep/minaid/license/pharm" xmlns:q2="http://oep-penza.ru/com/oep/declarant" xmlns:q3="http://oep-penza.ru/com/oep" xmlns:smev="http://smev.gosuslugi.ru/rev120315" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
  <soapenv:Body xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" wsu:Id="doReformTwoForIp">
    <smev:doReformTwoForIp>
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
  <q1:dataIpRequest>
  <q1:dataIp>
  <q1:addressActualResiding>555555</q1:addressActualResiding> 
  <q1:contacts>
  <q2:phone>555555</q2:phone> 
  </q1:contacts>
  <q1:egrData>
  <q2:INN>555555555555</q2:INN> 
  <q2:OGRN>555555555555555</q2:OGRN> 
  </q1:egrData>
  <q1:FIO>55555555</q1:FIO> 
  </q1:dataIp>
  <q1:flagHaveRightOnEstate>true</q1:flagHaveRightOnEstate> 
  <q1:OKATO>55555555555</q1:OKATO> 
  </q1:dataIpRequest>
  <q1:datareformTwo>
  <q1:dataPharmDictionary>
  <q1:pharmDictionary>N1</q1:pharmDictionary> 
  </q1:dataPharmDictionary>
  <q1:dataPharmDictionary>
  <q1:pharmDictionary>N3</q1:pharmDictionary> 
  </q1:dataPharmDictionary>
  <q1:licenseActivityAddress>55555555</q1:licenseActivityAddress> 
  </q1:datareformTwo>
  <q3:inParams>
  <q3:app_id>55555</q3:app_id> 
  <q3:form_id>555555</q3:form_id> 
  <q3:status_date>2013-02-28T11:19:38.139Z</q3:status_date> 
  </q3:inParams>
  </smev:AppData>
  <smev:AppDocument>
  <smev:RequestCode/> 
  <smev:BinaryData>UEsDBBQACAgIANp6XEIAAAAAAAAAAAAAAAAtAAAAZGF0YUlwUmVxdWVzdFxkYXRhSXBcaWRlbnRpdHlEb2N1bWVudFNjYW4udHh0+//70YP3AFBLBwj8qYyZBwAAAAUAAABQSwMEFAAICAgA2npcQgAAAAAAAAAAAAAAADcAAABkYXRhUmVmb3JtVHdvXGJ1aWxkT3duZXJEb2NzU2NhblxidWlsZE93bmVyRG9jc1NjYW4udHh0e/T7wfvfjx68BwBQSwcIt0Gk6wsAAAAIAAAAUEsDBBQACAgIANp6XEIAAAAAAAAAAAAAAAA/AAAAZGF0YVJlZm9ybVR3b1xlcXVpcG1lbnRPd25lckRvY3NTY2FuXGVxdWlwbWVudE93bmVyRG9jc1NjYW4udHh0e/Th0QMgAgBQSwcIGKQs4QgAAAAHAAAAUEsDBBQACAgIANp6XEIAAAAAAAAAAAAAAAAgAAAAZGF0YVJlZm9ybVR3b1xsaXN0QWxsRG9jU2Nhbi50eHT7/ej9o98PAFBLBwhoU7vvCAAAAAYAAABQSwMEFAAICAgA2npcQgAAAAAAAAAAAAAAACcAAABkYXRhUmVmb3JtVHdvXG1lZGljYWxMaWNlbnNlRG9jU2Nhbi50eHT7/ej9owfvHwEAUEsHCL5ua0gKAAAABwAAAFBLAwQUAAgICADaelxCAAAAAAAAAAAAAAAAJQAAAGRhdGFSZWZvcm1Ud29cb3JpZ2luYWxMaWNlbnNlU2Nhbi50eHR79OD970cP3gMAUEsHCKG6WSAKAAAABwAAAFBLAwQUAAgICADaelxCAAAAAAAAAAAAAAAANwAAAGRhdGFSZWZvcm1Ud29cb3RoZXJEb2N1bWVudHNTY2FuXG90aGVyRG9jdW1lbnRzU2Nhbi50eHR78P7Rg/cAUEsHCGdpR6QHAAAABQAAAFBLAwQUAAgICADaelxCAAAAAAAAAAAAAAAAIgAAAGRhdGFSZWZvcm1Ud29ccGF5bWVudE9yZGVyU2Nhbi50eHR79PvB+0cP3gMAUEsHCOAfYxQKAAAABwAAAFBLAwQUAAgICADaelxCAAAAAAAAAAAAAAAAJgAAAGRhdGFSZWZvcm1Ud29ccGV0aXRpb25Eb2N1bWVudFNjYW4udHh0+//70XsAUEsHCFsrLRoGAAAABAAAAFBLAwQUAAgICADaelxCAAAAAAAAAAAAAAAAYQAAAGRhdGFSZWZvcm1Ud29ccGhhcm1EZWFsZXJTcGVjaWFsaXN0c0VkdWNhdGlvbkRvY3NTY2FuXHBoYXJtRGVhbGVyU3BlY2lhbGlzdHNFZHVjYXRpb25Eb2NzU2Nhbi50eHT7/ujD+0cfHjwCAFBLBwjItm1iCwAAAAgAAABQSwMEFAAICAgA2npcQgAAAAAAAAAAAAAAAFUAAABkYXRhUmVmb3JtVHdvXHBoYXJtU3BlY2lhbGlzdHNFZHVjYXRpb25Eb2NzU2NhblxwaGFybVNwZWNpYWxpc3RzRWR1Y2F0aW9uRG9jc1NjYW4udHh0e/T7/aMH7wFQSwcIwyMbnwgAAAAGAAAAUEsDBBQACAgIANp6XEIAAAAAAAAAAAAAAAAqAAAAZGF0YVJlZm9ybVR3b1xzYW5pdGFyeU5vcm1Eb2N1bWVudFNjYW4udHh0+/7h0YP3HwBQSwcIc5yuQAgAAAAGAAAAUEsBAhQAFAAICAgA2npcQvypjJkHAAAABQAAAC0AAAAAAAAAAAAAAAAAAAAAAGRhdGFJcFJlcXVlc3RcZGF0YUlwXGlkZW50aXR5RG9jdW1lbnRTY2FuLnR4dFBLAQIUABQACAgIANp6XEK3QaTrCwAAAAgAAAA3AAAAAAAAAAAAAAAAAGIAAABkYXRhUmVmb3JtVHdvXGJ1aWxkT3duZXJEb2NzU2NhblxidWlsZE93bmVyRG9jc1NjYW4udHh0UEsBAhQAFAAICAgA2npcQhikLOEIAAAABwAAAD8AAAAAAAAAAAAAAAAA0gAAAGRhdGFSZWZvcm1Ud29cZXF1aXBtZW50T3duZXJEb2NzU2NhblxlcXVpcG1lbnRPd25lckRvY3NTY2FuLnR4dFBLAQIUABQACAgIANp6XEJoU7vvCAAAAAYAAAAgAAAAAAAAAAAAAAAAAEcBAABkYXRhUmVmb3JtVHdvXGxpc3RBbGxEb2NTY2FuLnR4dFBLAQIUABQACAgIANp6XEK+bmtICgAAAAcAAAAnAAAAAAAAAAAAAAAAAJ0BAABkYXRhUmVmb3JtVHdvXG1lZGljYWxMaWNlbnNlRG9jU2Nhbi50eHRQSwECFAAUAAgICADaelxCobpZIAoAAAAHAAAAJQAAAAAAAAAAAAAAAAD8AQAAZGF0YVJlZm9ybVR3b1xvcmlnaW5hbExpY2Vuc2VTY2FuLnR4dFBLAQIUABQACAgIANp6XEJnaUekBwAAAAUAAAA3AAAAAAAAAAAAAAAAAFkCAABkYXRhUmVmb3JtVHdvXG90aGVyRG9jdW1lbnRzU2NhblxvdGhlckRvY3VtZW50c1NjYW4udHh0UEsBAhQAFAAICAgA2npcQuAfYxQKAAAABwAAACIAAAAAAAAAAAAAAAAAxQIAAGRhdGFSZWZvcm1Ud29ccGF5bWVudE9yZGVyU2Nhbi50eHRQSwECFAAUAAgICADaelxCWystGgYAAAAEAAAAJgAAAAAAAAAAAAAAAAAfAwAAZGF0YVJlZm9ybVR3b1xwZXRpdGlvbkRvY3VtZW50U2Nhbi50eHRQSwECFAAUAAgICADaelxCyLZtYgsAAAAIAAAAYQAAAAAAAAAAAAAAAAB5AwAAZGF0YVJlZm9ybVR3b1xwaGFybURlYWxlclNwZWNpYWxpc3RzRWR1Y2F0aW9uRG9jc1NjYW5ccGhhcm1EZWFsZXJTcGVjaWFsaXN0c0VkdWNhdGlvbkRvY3NTY2FuLnR4dFBLAQIUABQACAgIANp6XELDIxufCAAAAAYAAABVAAAAAAAAAAAAAAAAABMEAABkYXRhUmVmb3JtVHdvXHBoYXJtU3BlY2lhbGlzdHNFZHVjYXRpb25Eb2NzU2NhblxwaGFybVNwZWNpYWxpc3RzRWR1Y2F0aW9uRG9jc1NjYW4udHh0UEsBAhQAFAAICAgA2npcQnOcrkAIAAAABgAAACoAAAAAAAAAAAAAAAAAngQAAGRhdGFSZWZvcm1Ud29cc2FuaXRhcnlOb3JtRG9jdW1lbnRTY2FuLnR4dFBLBQYAAAAADAAMAJYEAAD+BAAAAAA=</smev:BinaryData> 
  </smev:AppDocument>
  </smev:MessageData>
  </smev:doReformTwoForIp>
  </soapenv:Body>
  </soapenv:Envelope>