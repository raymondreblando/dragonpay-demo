<?php

namespace App\Http\Requests;

class FormRequest
{
	protected $_request;
	protected $rules = [];
	protected $errors = [];
	protected $messages;

	/**
	 * Inject the current http request data
	 * 
	 * @param array $request Request information
	 * @return void
	 */
	public function __construct(array $request)
	{
		$this->_request = $request;
	}

	/**
	 * Sanitize the data fields
	 * 
	 * @return void
	 */
	protected function sanitize(): void
	{
		foreach ($this->_request as $key => $value) {
			$value = trim($value);
			$value = stripslashes($value);
			$value = htmlspecialchars($value, ENT_QUOTES, 'utf-8');
			$this->_request[$key] = $value;
		}
	}

	/**
	 * Verify the current request payload
	 * 
	 * @param array $fields Accepted fields
	 * @return void
	 */
	protected function verifyPayload(array $fields): void
	{
		foreach ($this->_request as $key => $value) {
			if (! in_array($key, $fields)) {
				$this->errors[] = 'Invalid payload';
			}
		}
	}

	/**
	 * Apply the request rules specified
	 * 
	 * @param string $field Request field
	 * @param string $rule Rule to be applied
	 * @return void
	 */
	protected function applyRules(string $field, string $rule): void
	{
		$value = $this->_request[$field];

		switch ($rule) {
			case 'required':
				if ($value == 'null' || $value == '') {
					$this->errors[] = $field . ' is required';
				}
				break;
			case 'email':
				if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
					$this->errors[] = 'Invalid email address';
				}
				break;
		}
	}
}