<?php 
	  $subservice_url_id = 92;
      $soapAction = "urn:enqueue";
?>
<SOAP-ENV:Envelope xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="tns" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
   <SOAP-ENV:Header/>
   <ns0:Body>
      <ns1:enqueue>
         <ns1:parameters>
            <ns1:doctorUid><?php echo $doctorId; ?></ns1:doctorUid>
            <ns1:hospitalUidFrom>0</ns1:hospitalUidFrom>
            <ns1:sex><?php echo $sex;?></ns1:sex>
            <ns1:timeslotStart><?php echo $timeslot ?></ns1:timeslotStart>
            <ns1:person>
               <ns1:firstName><?php echo $firstName; ?></ns1:firstName>
               <ns1:lastName><?php echo $lastName; ?></ns1:lastName>
               <ns1:patronymic><?php echo $patronymic; ?></ns1:patronymic>
            </ns1:person>
            <ns1:birthday><?php echo $birthday; ?></ns1:birthday>
            <ns1:document>
            	<?php if ($type === false):?>
            		<ns1:number><?php echo $number; ?></ns1:number>
            	<?php else: ?>
            		<?php if ($document == 'document'): ?>
            			<ns1:document_code><?php echo $type; ?></ns1:document_code>
						<ns1:series><?php echo $series; ?></ns1:series>
            			<ns1:number><?php echo $number; ?></ns1:number>
            		<?php else: ?>
            			<ns1:policy_type><?php echo $type; ?></ns1:policy_type>
            			<ns1:number><?php echo $number; ?></ns1:number>
            			<?php if ($series != false): ?>
            				<ns1:series><?php echo $series; ?></ns1:series>	
            			<?php endif; ?>	
            		<?php endif; ?>		
            	<?php endif; ?>
            </ns1:document>
            <ns1:hospitalUid><?php echo $hospitalIdSub; ?></ns1:hospitalUid>
         </ns1:parameters>
      </ns1:enqueue>
   </ns0:Body>
</SOAP-ENV:Envelope>
