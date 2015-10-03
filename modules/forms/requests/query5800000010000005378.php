<?php $soapAction = "sendRequest";
	  $responseSmevValidation = false;

?>
<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:s="http://www.w3.org/2001/XMLSchema" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
 <SOAP-ENV:Body>
  <sendRequest xmlns="http://smev.gosuslugi.ru/rev111111">
    <Message>
      <Sender>
        <Code><?php echo(htmlspecialchars($sender[0]));?></Code>
        <Name><?php echo(htmlspecialchars($sender[1]));?></Name>
      </Sender>
      <Recipient>
	    <Code>FISA01</Code>
        <Name>ФИС ГИБДД Адмпрактика</Name>
      </Recipient>
	  <Originator>
	    <Code>FISA01</Code>
        <Name>ФИС ГИДД Адмпрактика</Name>
      </Originator>
      <TypeCode>GSRV</TypeCode>
      <Status>REQUEST</Status>
	  <Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></Date>
	  <ExchangeType>2</ExchangeType>
	  <ServiceCode>22222</ServiceCode>
      <CaseNumber><?php echo(htmlspecialchars($idRequest));?></CaseNumber>
	  <TestMsg>1</TestMsg>
	</Message>
    <MessageData>
      <AppData>
        <RequestData xmlns="http://gibdd.ru/rev01">
          <RegPointNum><?php echo $_POST['RegPointNum']; ?></RegPointNum>
        </RequestData>
      </AppData>
    </MessageData>
  </sendRequest>
  </SOAP-ENV:Body>
</SOAP-ENV:Envelope>
