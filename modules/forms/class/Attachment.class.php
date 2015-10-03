<?php
class Attachment {
	public $data;
	private $maxPacketSize;
	private $filename;

	function __construct($data=false) 	{
		$this->data = $data;
		$this->filename = NULL;
	}
	
	public function setMaxPacketSize($maxPacketSize){
		$this->maxPacketSize = $maxPacketSize;
	}
	
	
	private function getSavePathForKey($path,$fileName){
		  $ext = explode(".",$fileName);
		  $type = ".dat";
		  
		  $type = end($ext);
		  //if(count($ext)==2) $type = $ext[1];
		  $path .= ".".$type;     
			
	      $path = str_replace("_","/",$path);
	      $path = str_replace("\\/","_",$path);
	      
		  $path = str_replace("appData/","",$path);
		  return $path;
	}
	
	
	public function delete(){
		foreach($_FILES as $key => $value){
		  $tmp = $value['tmp_name'];
		  if(file_exists($tmp)){
		    unlink($tmp);	
		  }
		}
        $this->deleleFileStore();
	}  
	
	private function deleleFileStore(){
		if(isset($this->filename) && file_exists($this->filename)){
           unlink($this->filename);		
		   unset($this->filename);
		}
        if(isset($this->data)){
		  unset($this->data);
		}		
	}
	
	private function getAppliedDocumentXML($file, $key, $name){
		$xml = "<ns1:AppliedDocument ns1:ID=\"".rand("31931385","34931385")."\">";
		$xml .= "<ns1:CodeDocument>".$key."</ns1:CodeDocument>";
		$xml .= "<ns1:Name>".$name."</ns1:Name>";
		$xml .= "<ns1:URL>".$this->getSavePathForKey($key,$name)."</ns1:URL>";
		$xml .= "<ns1:Type>".mime_content_type($file)."</ns1:Type>";
		//$xml .= "<ns1:DigestValue>".hash_file('gost', $file)."</ns1:DigestValue>";
		$xml .= "</ns1:AppliedDocument>";
		return $xml; 
	}
	
	private function getAAppliedDocumentSXML(){
		$xml = "<ns1:AppliedDocuments xmlns:ns1=\"http://smev.gosuslugi.ru/request/rev111111\">";
		foreach($_FILES as $key => $value){
			$tmp = $value['tmp_name'];
			if(isset($tmp)&&file_exists($tmp)){
				$xml .= $this->getAppliedDocumentXML($tmp, $key, $value['name']);
			}
		}
		$xml .= "</ns1:AppliedDocuments>";
		return $xml;
	}	
	
	private function addMetadata($zip){
		$metadataName = tempnam(ModuleHome::getTemp(), "att_");
		$fp = fopen($metadataName, "w");
		$appliedDocuments = $this->getAAppliedDocumentSXML();
		fwrite($fp, $appliedDocuments);
		$zip->addFile($metadataName, "metadata.xml");
		//unlink($metadataName);
		return $zip; 
	}

	/*
	* reposite into  $_FILES => Reposite file in fileStore
	* $_FILES['folder_sub_file'] = $file;
	* archive => folder/sub/file
	*/
	public function generateAttachment(){
		if($this->data)return $this->data;
		$archive = "";
		if(count($_FILES)==0){
		  return "";	
		}
		$this->deleleFileStore();
		$zip = new ZipArchive();
		$filename = tempnam(ModuleHome::getTemp(), "att_");
		$this->filename = $filename;
		$zip->open($filename, ZIPARCHIVE::CREATE);		
		
		foreach($_FILES as $key => $value){
                  $path = $this->getSavePathForKey($key,$value['name']);
		  $tmp = $value['tmp_name'];
		  if(isset($tmp)&&file_exists($tmp)){
		    $zip->addFile($tmp,$path);
		  }
		}
		$needMetadata = isset($_POST["metadata"]);
		if ($needMetadata)
			$zip = $this->addMetadata($zip);
		
		$zip->close();
		if(isset($this->maxPacketSize)){
		  if(filesize($filename)>$this->maxPacketSize){
		    $smpe = new SmevException("Превышен максимальный размер вложений в ".$this->maxPacketSize." Байт");
		    unlink($filename);
		    throw $smpe;
		  }	
		}
		$this->data = base64_encode(file_get_contents($filename));
		return $this->data;
	}
}

?>