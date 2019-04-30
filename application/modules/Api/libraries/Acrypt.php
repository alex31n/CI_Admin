<?php


class Acrypt
{

	private $CI;

	private $key;
	private $iv= "0000000000000000";
	private $cipher = 'aes-256-cbc';
	private $options = OPENSSL_RAW_DATA;

	public function __construct()
	{
		$CI =& get_instance();
		$this->key = $CI->config->item('key');
	}

	/*public function verify($text, $encryptText)
    {
        if (empty($input) || empty($encryptText))
        {
            return FALSE;
        }

        if ($text == $this->encryptText($text))
        {
            return true;
        }


        return false;
    }*/

	public function encrypt($text, $key='', $iv='')
	{

		if (empty($text))
		{
			return FALSE;
		}

		if (!empty($key)){
			$this->key = $key;
		}
		if (!empty($iv)){
			$this->iv = $iv;
		}

		$ciphertext = openssl_encrypt(
			$text,
			$this->cipher,
			$this->key,
			$this->options,
			$this->iv
		);
		return $ciphertext;
	}

	public function decrypt($text, $key='', $iv=''){


		if (empty($text))
		{
			return FALSE;
		}

		if (!empty($key)){
			$this->key = $key;
		}
		if (!empty($iv)){
			$this->iv = $iv;
		}

		$cipherText = base64_decode($text);
		$plaintext = openssl_decrypt(
			$cipherText,
			$this->cipher,
			$this->key,
			$this->options,
			$this->iv
		);

		return $plaintext;
	}

	public function get_iv_length(){
		return openssl_cipher_iv_length ( $this->cipher );
	}
}
