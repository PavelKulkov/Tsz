<?php 
	  $subservice_url_id = 90;
      $soapAction = "urn:listDoctors";
?>

<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:tns="tns" xmlns:ns0="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ns1="tns" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">
   <soapenv:Header/>
   <soapenv:Body>
      <tns:listDoctors>
         <!--Optional:-->
         <tns:parameters>
            <!--Optional:-->
            <tns:searchScope>
                <tns:hospitalUid><?php echo $hospitalId; ?></tns:hospitalUid>
            </tns:searchScope>
            <!--Optional:-->
            <tns:speciality><?php echo $specialty; ?></tns:speciality>
            <!--Optional:-->
            
         </tns:parameters>
      </tns:listDoctors>
   </soapenv:Body>
</soapenv:Envelope>