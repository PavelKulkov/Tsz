<?php
/**
  0 - Новый запрос
  1 - Запрос подготовлен к отправке
  2 - OEP-SIGNER не может отправить запрос
  3 - OEP-SIGNER не ответил
  4 - статус ответа не найден
  5 - ошибка в данных запроса
  6 - удаленный сервер не смог обработать запрос
  7 - в ведомстве
  8 - в обработке 
  9 - отказ ведомства в исполнении
  10- Завершена 
 */
class SmevClient {
	private $source;
	private $socket;
	private $answer;
	private $db_instance;
	private $forms;
	public $outId;
	private $idRequest;
	private $smevFormat = true;
	private $soapAction;
	public $exchangeCode;
	public $comment;
	
	
	function __construct($db,$forms) 	{
		$this->db_instance = $db;
		$this->socket = false;
		$this->forms = $forms;
		$this->outId = false;
		$this->comment = '';
	}
	
	public function setValidatingSmevFormat($smevFormat){
	  $this->smevFormat = $smevFormat;
	} 
	
	public function setSoapAction($soapAction){
	  $this->soapAction = $soapAction;
	}
	
	public function open($address, $port){
		$this->socket =
		socket_create(AF_INET,
				SOCK_STREAM,
				SOL_TCP);
		if ($this->socket === false) {
		    $this->exchangeCode = 3;
			throw new SmevException("Не возможно соединится с удаленным сервером");
		}
		$result = socket_connect($this->socket, $address, $port);
		if ($result === false) {
		    $this->exchangeCode = 3;
			throw new SmevException("Удаленный сервис не отвечает ");
		}		
	}
	
	
	public function setReadTimeOut($timeout){
		socket_set_option($this->socket,
				SOL_SOCKET,
				SO_RCVTIMEO,
				array("sec"=>$timeout, "usec"=>0));
		$this->timeout = $timeout * 1000;
	}
	
	
	private function saveDataIntoFile($filename,$data){
		$handle = fopen($filename,"w");
		fwrite($handle,$data);
		fclose($handle);	  	
	}
	
	
	public function saveQuery($query,$idRequest,$date){
		$this->idRequest = $idRequest;
		$this->source = tempnam(ModuleHome::getTemp(),"req");
		$this->saveDataIntoFile($this->source, $query);
		if(isset($this->forms))$this->forms->saveResponse($query,$idRequest,0,"0",$date,'');
	}
	
	
	private function generateOEPProtocolHeader($url,$sign){
		if(!file_exists($this->source)){
		  throw new SmevException("Отсутствует файл запроса");	
		}
		$fileSize = filesize($this->source);
		$requestData = "command=remoteRun\r\nurl=$url\r\ncontentLength=".$fileSize;
		if($sign){
			$requestData .= "\r\nsign=true"; 
		 	if(isset($this->signType)){
				$requestData .= "\r\nsignUnitaler=".$this->signType; 
			}
		}
		if(isset($this->timeout)){
		  $requestData .= "\r\ntimeout=".$this->timeout; 
		}
		if(isset($this->soapAction)){
		  $requestData .= "\r\nsoapAction=".$this->soapAction; 
		}
		$leng = dechex(strlen($requestData));
		$size = '0000';
		$size = substr_replace($size,$leng, strlen($size)-strlen($leng));
		$requestData=$size.$requestData;
		return $requestData;		
	}
	
	private function receiveAnswer(){
		$out      = socket_read($this->socket,4);
		$leng     = hexdec($out);
		$response = socket_read($this->socket,$leng);
		return $response;
	}
	
	private function parseHeader($responseHeader){
	  $rows = explode("\r\n",$responseHeader);
	  if(count($rows)==0){
	    throw new SmevException("Не найден заголовок ответа");	
	  }
	  $header = null;
	  $field = null;
	  foreach ($rows as $entry){
		$field = explode("=", $entry);
	    if(count($field)==2){
	      $key = $field[0];
	      $header[$key] = $field[1];	
	    }
	  }
	  return $header;	
	}
	
	
	private function checkSmevHeader(){
	  	//TODO выгрызать из ответа поставщика OUT_ID и время ответа пока генерим их сами
		$xml = simplexml_load_file($this->answer);
		if (!$xml) {
		  //throw new SmevException("Не верный ответ от сервиса. Обратитесь в службу поддержки!!");
		}
		$xml->registerXPathNamespace('smev', 'http://smev.gosuslugi.ru/rev120315');
		$result = $xml->xpath('//smev:Status');
		if(count($result)==0){
			$xml->registerXPathNamespace('ns3', 'http://smev.gosuslugi.ru/rev111111');
  		    $result = $xml->xpath('//ns3:Status');
		    if(count($result)==0){
		    	$this->exchangeCode = 4;
				throw new SmevException("Неверный ответ от сервиса. Обратитесь в службу поддержки!");
		    }		
		}
		$error = false;
		
		while(list( , $node) = each($result)) {
                  echo "<input type='hidden' value='$node'/>";
			if($node=='INVALID'){
				$smevException = new SmevException('Ошибка отправки формы, проверьте правильность введенных данных');  
				$smevException->showAsWarning(true);
				$this->exchangeCode = 5;
				throw $smevException;
			}
			if($node=='FAILURE'){
			    $this->exchangeCode = 6;
				throw new SmevException('Ошибка отправки данных! обратитесь в службу поддержки портала');
			}
		}
		return $error;
	} 
	
	
	public function remoteRun($url,$sign){
	  $header = $this->generateOEPProtocolHeader($url,$sign);
	  socket_write($this->socket, $header, strlen($header));
	  $body = file_get_contents($this->source);
	  socket_write($this->socket, $body, strlen($body));
	  $responseHeader = $this->receiveAnswer();
	  unset($header);
	  $header = $this->parseHeader($responseHeader);
      $this->exchangeCode = 1;
	  
	  
	  if (isset($header)&&
	  	  isset($header['code'])) {
	  	$this->exchangeCode = $header['code'];
	  }
	  
	  if(isset($header['contentLength'])){
	  	  $leng = $header['contentLength'];
	  	  $this->answer = tempnam(ModuleHome::getTemp(),"resp");
		  
	  	  $handle = fopen($this->answer,"w");
		  $bufferSize = 0;
		  while($out=socket_read($this->socket,$leng)){
		    $bufferSize += strlen($out);
		    fwrite($handle,$out); 
			if($bufferSize==$leng)break;
		  }
	  	  fclose($handle);
	  	  if($this->smevFormat && $this->exchangeCode==0){
		    $this->checkSmevHeader();
		    $this->exchangeCode=7;
		  }
	  }
      socket_write($this->socket, "0", 1);	  
	  if(!($this->exchangeCode==0 || $this->exchangeCode==7)){
	     $message = "Не верный ответ от сервиса. Обратитесь в службу поддержки!";
	     if($this->exchangeCode==2){
		   if(isset($header)&&isset($header['error'])){
		      $message =  $header['error'];
		   }
		 }
	     throw new SmevException($message);
	  }
	  
	}
	
	
	public function getExchangeCode(){
	  return $this->exchangeCode;
	}
	
	public function deleteTempFiles(){
	  
	  if(file_exists($this->source)){
	  	unlink($this->source);
	  }
	  
	  if(file_exists($this->answer)){
	    
	  	$date  = new DateTime();
	  	$outId = isset($this->outId)&&$this->outId?$this->outId:$this->idRequest;
		$comment = $this->comment;
		
	  	if($this->exchangeCode == 0 || $this->exchangeCode==7 || $this->exchangeCode==10){
		  unlink($this->answer);
		}else{
		   
		  $comment = $this->answer;
		}
		if(isset($this->forms))
		  $this->forms->saveResponse($query,
		                             $this->idRequest, 
									 $this->exchangeCode,
									 $outId,
									 $date, 
									 $comment);
	  }	  
	}
	
	
	public function getAnswerFile(){
	  return $this->answer;
	}
	
	
	public function close(){
	  if($this->socket!=null){
	  	socket_close($this->socket);
	  }
	}
	
}  
?>