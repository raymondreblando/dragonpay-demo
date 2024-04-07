<?php

namespace App\Http\Requests;

use stdClass;

class StoreCartRequest extends FormRequest
{
	/**
	 * Accepted fields
	 */
	private $fillable = [
		'product_id'
	];

	/**
	 * Inject the current http request information
	 * 
	 * @param array $request Request informaation
	 * @return void
	 */
   public function __construct(array $request)
   {
      parent::__construct($request);
   }

	/**
	 * Validate the request data
	 * 
	 * @return stdClass
	 */
   public function validate(): stdClass
	{
		$this->sanitize();
		$this->verifyPayload($this->fillable);

		return (object) [
			'errors' => $this->errors, 
			'data' => (object) $this->_request
		];
	}
}