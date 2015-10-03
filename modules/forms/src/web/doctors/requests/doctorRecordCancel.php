<?php 
	  $subservice_url_id = 92;
      $soapAction = "urn:enqueue";
?>
<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tns="tns">
   <soapenv:Header/>
   <soapenv:Body>
      <tns:cancel>
         <!--Optional:-->
         <tns:parameters>
            <!--Optional:-->
            <tns:ticketUid><?php echo $ticket_id ?></tns:ticketUid>
            <!--Optional:-->
            <tns:hospitalUid><?php echo $hospital_id ?></tns:hospitalUid>
         </tns:parameters>
      </tns:cancel>
   </soapenv:Body>
</soapenv:Envelope>