<?php namespace Sircamp\Xenapi\Element;

use Respect\Validation\Validator as Validator;
use GuzzleHttp\Client as Client;

class XenVDI extends XenElement
{

	private $uuid;

	public function __construct($xenconnection, $uuid)
	{
		parent::__construct($xenconnection);
		$this->uuid      = $uuid;
	}

	/**
	 * Gets the value of name.
	 *
	 * @return mixed
	 */
	public function getUUID()
	{
		return $this->uuid;
	}

    public function getSize()
    {
        return (int)$this->getXenconnection()->VDI__get_virtual_size($this->uuid)->getValue();
    }

    public function resize($size)
    {
        return $this->getXenconnection()->VDI__resize($this->uuid, $size);
    }

}

?>