<?php 
	$subservice_url_id = 105;
    $soapAction = "urn:getData";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:q1="http://oep-penza.ru/com/oep" xmlns:rev="http://smev.gosuslugi.ru/rev120315" xmlns:oep="http://oep-penza.ru/com/oep">
   <soapenv:Body>
      <rev:getData>
         <!--Optional:-->
         <rev:Message>
		        <rev:Sender>
		          <rev:Code><?php echo(htmlspecialchars($sender[0]));?></rev:Code>
		          <rev:Name><?php echo(htmlspecialchars($sender[1]));?></rev:Name>
		        </rev:Sender>
		        <rev:Recipient>
		          <rev:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></rev:Code>
		          <rev:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></rev:Name>
		        </rev:Recipient>
		        <rev:Originator>
		          <rev:Code><?php echo(htmlspecialchars($siuRecipient[0]));?></rev:Code>
		          <rev:Name><?php echo(htmlspecialchars($siuRecipient[1]));?></rev:Name>
		        </rev:Originator>
                <rev:ServiceName>PersonalPaymentService</rev:ServiceName>
                <rev:TypeCode>GSRV</rev:TypeCode>
                <rev:Status>REQUEST</rev:Status>
                <rev:Date>2014-06-06T09:51:32.228Z</rev:Date>
                <rev:ExchangeType>1</rev:ExchangeType>
		        <rev:RequestIdRef><?php echo(htmlspecialchars($idRequest));?></rev:RequestIdRef>
		        <rev:OriginRequestIdRef><?php echo(htmlspecialchars($idRequest));?></rev:OriginRequestIdRef>
		        <rev:ServiceCode>PersonalPaymentService</rev:ServiceCode>
		        <rev:CaseNumber><?php echo(htmlspecialchars($idRequest));?></rev:CaseNumber>
         </rev:Message>
         <!--Optional:-->
         <rev:MessageData>
            <!--Optional:-->
            <rev:AppData>
			   <q1:result>
					<q1:dataRow>
						<q1:name>operation</q1:name>
						<q1:value><?php echo (isset($_GET['operation']) ? $_GET['operation'] : $_POST['operation']);?></q1:value>
					</q1:dataRow>
					<q1:dataRow>
						<q1:name>data_id</q1:name>
						<q1:value><?php echo (isset($_GET['data_id']) ? $_GET['data_id'] : $_POST['data_id']);?></q1:value>
					</q1:dataRow>
					<?php 
						$data = isset($_GET['data']) ? $_GET['data'] : $_POST['data'];
						if (isset($data)){
							echo '<q1:dataRow>
								<q1:name>data</q1:name>
								<q1:value>'.$data.'</q1:value>
							</q1:dataRow>';		
						}
					?>
			   </q1:result>
            </rev:AppData>
         </rev:MessageData>
      </rev:getData>
   </soapenv:Body>
</soapenv:Envelope>