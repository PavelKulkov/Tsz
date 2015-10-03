
<?php $soapAction = "urn:putQueSession"; ?>

<S:Envelope xmlns:S="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">

    <S:Body wsu:Id="body">
        <ns2:ZagsService xmlns:ns2="http://smev.gosuslugi.ru/rev120315" xmlns:ns3="http://idecs.nvg.ru/privateoffice/ws/types/" xmlns:ns4="http://wsService.zags.com/" xmlns:typ="http://idecs.nvg.ru/privateoffice/ws/types/">
		  <ns2:Message>
			<ns2:Sender>
				<ns2:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></ns2:Code>
				<ns2:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></ns2:Name>
			</ns2:Sender>
			<ns2:Recipient>
			  <ns2:Code>210401581</ns2:Code>
			  <ns2:Name>Находка-Загс Портал Пензенской области</ns2:Name>
			</ns2:Recipient>
			<ns2:Originator>
				 <ns2:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></ns2:Code>
				  <ns2:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></ns2:Name>
			</ns2:Originator>
			<ns2:ServiceName>Запрос в орган ЗАГС</ns2:ServiceName>
			<ns2:TypeCode>GFNC</ns2:TypeCode>
			<ns2:Status>REQUEST</ns2:Status>
			<ns2:Date><?php echo(htmlspecialchars($nowTimeWithFormat));?></ns2:Date>
			<ns2:ExchangeType>2</ns2:ExchangeType>
			<ns2:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></ns2:RequestIdRef>
			<ns2:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></ns2:OriginRequestIdRef>
			<ns2:ServiceCode>000000001</ns2:ServiceCode>
			<ns2:CaseNumber><?php echo(htmlspecialchars($idRequest));?></ns2:CaseNumber>
			<!-- <ns2:TestMsg>true</ns2:TestMsg> -->
		  </ns2:Message>
            <ns2:MessageData>
                <ns2:AppData>
                    <wsZagsQue>
                        <putQueSession>
                            <use>true</use>
                            <guidSession><?php echo $_POST['outId']; ?></guidSession>

								<?php $HourTime = explode(":",$_POST['time']); ?>
									
								<timeQue>
									<datQue><?php echo $_POST['date']; ?></datQue>
									<typeQue>AZ_ZB</typeQue>
									<hourQue><?php echo $HourTime[0]; ?></hourQue>
									<minQue><?php echo $HourTime[1]; ?></minQue>
									<namKabinet><?php echo $_POST['namKabinet']; ?></namKabinet>
								</timeQue>
								
                        </putQueSession>
                    </wsZagsQue>
                </ns2:AppData>
            </ns2:MessageData>
        </ns2:ZagsService>
    </S:Body>
</S:Envelope>