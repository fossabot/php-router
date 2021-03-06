<?php
namespace jblond\router;

/**
 * Class responses
 * @package jblond\router
 */
class responses {

	/**
	 * @param string $file file with path
	 * @param string $name name for the client
	 */
	public function download($file, $name){
		$this->headers(
			array(
				'Content-Transfer-Encoding' => 'Binary',
				'Content-Type' => 'application/octet-stream',
				'Content-disposition' => 'attachment; filename="' . $name . '"'
			)
		);
		readfile($file);
	}

	/**
	 * @param string $type
	 * @param string $value optional parameter
	 * @return bool
	 */
	public function header($type, $value = ''){
		if($value !== ''){
			header("$type: $value");
			return true;
		}
		header("$type");
		return true;
	}

	/**
	 * @param array $header_array Header => Value
	 */
	public function headers($header_array){
		foreach ($header_array as $header => $value){
			$this->header($header, $value);
		}
	}

	/**
	 * @param string $location
	 */
	public function redirect($location){
		header('Location: ' . $location, true, 302);
	}

	/**
	 * send a 503 error to the client
	 */
	public function error_503(){
		$this->header('HTTP/1.1 503 Service Unavailable');
		$this->header('Status', '503 Service Unavailable');
	}

}
