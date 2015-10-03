<?php 
	  $subservice_url_id = 105;
      $soapAction = "urn:registerPayment";
	  $sender_id = "382801";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:rev="http://smev.gosuslugi.ru/rev120315">
   <soapenv:Header/>
   <soapenv:Body>
      <rev:registerPayment>
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
            <rev:Date><?php echo $nowTimeWithFormat; ?></rev:Date>
            <rev:ExchangeType>1</rev:ExchangeType>
            <rev:ServiceCode>PersonalPaymentService</rev:ServiceCode>
         </rev:Message>
         <rev:MessageData>
            <rev:AppData>
    			<v1:registerPaymentRequest xmlns:v1="http://schemas.bssys.com/spg/acquirer/service/messages/v1" xmlns:rp="http://registerpayment/com/oep/pp" xmlns:oep="http://oep-penza.ru/com/oep">
		<requestHeader requestUUID="<?php echo $requestUUID; ?>">
            <createDateTime><?php echo $nowTimeWithFormat; ?></createDateTime>
            <sender>
               <id><?php echo $sender_id; ?></id>
            </sender>
            <recipient>
               <id>SPG</id>
            </recipient>
         </requestHeader>	
            <paymentDetails paymentUUID="<?php echo $paymentUUID; ?>">
				<amount><?php echo $_POST['amountWithCommission']; ?></amount>
				<narrative><?php echo $_POST['narrative']; ?></narrative>
				<supplierOrgInfo>
				   <Name><?php echo $_POST['supplier_name']; ?></Name>
				   <INN><?php echo $_POST['supplier_inn']; ?></INN>
				   <KPP><?php echo $_POST['supplier_kpp']; ?></KPP>
				   <Account kind="<?php echo $_POST['account_kind']; ?>">
					  <Account><?php echo $_POST['account_account']; ?></Account>
					  <?php 
						if (isset($_POST['account_sub_account']) && $_POST['account_sub_account'] != "")
							echo "<SubAccount>".$_POST['account_sub_account']."</SubAccount>"; ?>
					  <Bank>
						 <Name><?php echo $_POST['bank_name']; ?></Name>
						 <?php 
							if (isset($_POST['bank_bik']) && $_POST['bank_bik'] != "")
								echo "<BIK>".$_POST['bank_bik']."</BIK>"; 
							if (isset($_POST['bank_swift'])  && $_POST['bank_swift'] != "")
								echo "<SWIFT>".$_POST['bank_swift']."</SWIFT>"; 
							if (isset($_POST['bank_correspondent_bank_account'])  && $_POST['bank_correspondent_bank_account'] != "")
								echo "<CorrespondentBankAccount>".$_POST['bank_correspondent_bank_account']."</CorrespondentBankAccount>"; 
						 ?>
					  </Bank>
				   </Account>
				   <OKATO><?php echo $_POST['supplier_oktmo']; ?></OKATO>
				</supplierOrgInfo>
				<KBK><?php echo $_POST['kbk']; ?></KBK>		<!--selectAccount=id услуги вместо kbk для нашей базы ? - нет-->
				<budgetIndex>
				   <Status><?php echo $_POST['budget_index_status']; ?></Status>
				   <PaymentType><?php echo $_POST['budget_index_payment_type']; ?></PaymentType>
				   <Purpose><?php echo $_POST['budget_index_purpose']; ?></Purpose>
				   <TaxPeriod><?php echo $_POST['budget_index_tax_period']; ?></TaxPeriod>
				   <TaxDocNumber><?php echo $_POST['budget_index_tax_doc_number']; ?></TaxDocNumber>
				   <TaxDocDate><?php echo $_POST['budget_index_tax_doc_date']; ?></TaxDocDate>
				</budgetIndex>
				<?php
					if (isset($_POST['payer_identifier']))
						echo  "<payerIdentifier>".$_POST['payer_identifier']."</payerIdentifier>";
					if (isset($_POST['supplier_bill_id']))
						echo  "<supplierBillID>".$_POST['supplier_bill_id']."</supplierBillID>";	
					if (isset($_POST['bill_date']))
						echo  "<billDate>".$_POST['bill_date']."</billDate>";	
					if (isset($_POST['application_id']))
						echo  "<applicationId>".$_POST['application_id']."</applicationId>";						
					if (isset($_POST['srvCode'])){
						echo "<additionalData>
								<name>Srv_Code</name>
								<value>".$_POST['srvCode']."</value>
								<label>Код гос. услуги</label>
							</additionalData>";
					}				
					for ($i=1; $i <= $_POST['additionalDataCount']; $i++) {
						echo '<additionalData>
								<name>'.$_POST['additional_data_name_'.$i].'</name>
								<value>'.$_POST['additional_data_value_'.$i].'</value>';
						if (isset($_POST['additional_data_label']))		
							echo '<label>'.$_POST['additional_data_label_'.$i].'</label>';
						echo '</additionalData>';
					}		
				?>
			</paymentDetails>
                  <rp:params>
					 <oep:form_id><?php echo (($authHome->checkSession()!=1)) ? $paymentUUID : $_SESSION['login']; ?></oep:form_id>
					 <oep:org_id><?php echo $sender_id; ?></oep:org_id>
                     <oep:app_id>1</oep:app_id>
                  </rp:params>						 				  
    			</v1:registerPaymentRequest>
            </rev:AppData>
         </rev:MessageData>
      </rev:registerPayment>
   </soapenv:Body>
</soapenv:Envelope>