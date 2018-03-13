<?php

/**
* 
*/
class Nlp
{
	
	public $kataDasar;
	public $kataImbuhan;
	public $kataOrang;

	public $resultKataDasar = [];
	public $resultKataImbuhan = [];
	public $resultKataOrang = [];

	function __construct()
	{
		$this->kataDasar = [
			'hanya',
			'bertanya',
			'siapa',
			'yang',
			'memakannya',
			'ini',
			'ialah',
			'main',
			'sedang',
			'teman'
		];

		$this->kataImbuhan = [
			'ber',
			'me',
			'nya'
		];
		
		$this->kataOrang = [
			'andi',
			'fahri',
			'dimas',
			'daffa'
		];

	}

	public function parseKataDasar($kata)
	{
		$delimiters = explode(" ", $kata);

		foreach ($delimiters as $delimiter) {

			foreach ($this->kataDasar as $key => $value) {

				if(preg_match("/$value/", $delimiter, $result)){
					$this->resultKataDasar[] = $result;
					// return $result;
				}
			}

		}
	}

	public function parseKataImbuhan($kata)
	{
		$delimiters = explode(" ", $kata);

		foreach ($delimiters as $delimiter) {

			foreach ($this->kataImbuhan as $key => $value) {

				if(preg_match("/$value/", $delimiter, $result)){
					$this->resultKataImbuhan[] = $result;
					// return $result;
				}
			}

		}
	}

	public function parseKataOrang($kata)
	{
		$delimiters = explode(" ", $kata);

		foreach ($delimiters as $delimiter) {

			foreach ($this->kataOrang as $key => $value) {

				if(preg_match("/$value/", $delimiter, $result)){
					$this->resultKataOrang[] = $result;
					// return $result;
				}
			}

		}	
	}

	public function compare($kata)
	{
		$this->parseKataDasar($kata);
		$this->parseKataImbuhan($kata);
		$this->parseKataOrang($kata);

		$data = [
			"kata_lengkap" => $kata,
			"parse" => [
				"kata dasar" => $this->resultKataDasar,
				"kata imbuhan" => $this->resultKataImbuhan,
				"kata orang" => $this->resultKataOrang,
			]
		];

		return json_encode($data);
	}
}

header('Content-type: application/json');

$nlp = new Nlp;
$kata = "fahri sedang bermain bola bersama daffa dan teman temannya";
echo $nlp->compare($kata);
?>