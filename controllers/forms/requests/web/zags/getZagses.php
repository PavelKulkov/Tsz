<?php 
	  $subservice_url_id = 80;
      $soapAction = "urn:getZagses";
?>

<S:Envelope xmlns:S="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">

    <S:Body wsu:Id="body">
        <ns2:ZagsService xmlns:ns2="http://smev.gosuslugi.ru/rev120315">
            <ns2:Message>
                <ns2:Sender>
                    <ns2:Code>IZGS01302</ns2:Code>
                    <ns2:Name>Клиент сервиса</ns2:Name>
                </ns2:Sender>
                <ns2:Recipient>
                    <ns2:Code>IZGS01301</ns2:Code>
                    <ns2:Name>Служба ЗАГС Пензенской области</ns2:Name>
                </ns2:Recipient>
                <ns2:Originator>
                    <ns2:Code>IZGS01302</ns2:Code>
                    <ns2:Name>Клиент сервиса</ns2:Name>
                </ns2:Originator>
                <ns2:ServiceName>Запрос в орган ЗАГС</ns2:ServiceName>
                <ns2:TypeCode>GFNC</ns2:TypeCode>
                <ns2:Status>REQUEST</ns2:Status>
                <ns2:Date>2012-11-27T11:02:30.198+04:00</ns2:Date>
                <ns2:ExchangeType>2</ns2:ExchangeType>
                <ns2:RequestIdRef>010101</ns2:RequestIdRef>
                <ns2:OriginRequestIdRef>123456789</ns2:OriginRequestIdRef>
                <ns2:ServiceCode>000000001</ns2:ServiceCode>
                <ns2:CaseNumber>1</ns2:CaseNumber>
                <!-- <ns2:TestMsg>true</ns2:TestMsg> -->
            </ns2:Message>
            <ns2:MessageData>
                <ns2:AppData>
                    <wsZagsZagses>
                        <getZagses>
                            <use>true</use>
                        </getZagses>
                    </wsZagsZagses>
                </ns2:AppData>
            </ns2:MessageData>
        </ns2:ZagsService>
    </S:Body>
</S:Envelope>