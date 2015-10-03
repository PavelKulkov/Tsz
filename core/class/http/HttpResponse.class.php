<?php
class HttpResponse {

	var $redirected;
	var $content;

	public function __construct()
	{
		$this->redirected = false;
		$this->content = '';
	}

	function & getInstance() {
		if (!isset($GLOBALS['HttpResponseInstance'])) {
			$GLOBALS['HttpResponseInstance'] =new HttpResponse();
		}
		return $GLOBALS['HttpResponseInstance'];
	}

	/**
	 * Send http response header
	 *
	 * @param unknown_type $text
	 */
	function sendHeader($text) {
		header($text);
	}

	/**
	 * Send redirect header
	 *
	 * @param string $url Target URL
	 */
	function redirect($url) {
		header('Location: ' . $url);
		$this->redirected = true;
	}

	function notFound(){
		header("HTTP/1.0 404 Not Found");
//		$this->redirected = true;
	}
	/**
	 * Return true if redirect headed was sent.
	 *
	 * @return bool
	 */
	function isRedirected() {
		return $this->redirected;
	}

	function clearContent() {
		$this->content = '';
	}

	/**
	 * Append text to output buffer
	 *
	 * @param string $text
	 */
	function write($text) {
		$this->content .= $text;
	}

	/**
	 * Echo content to client and clear output buffer
	 */
	function flush() {
		flush();
		$this->content = '';
	}
}
?>