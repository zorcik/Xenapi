<?php namespace Sircamp\Xenapi\Element;

use Respect\Validation\Validator as Validator;
use GuzzleHttp\Client as Client;

class XenVIF extends XenElement
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

    public function getMAC()
    {
        return $this->getXenconnection()->VIF__get_MAC($this->uuid)->getValue();
    }

    public function setMAC($mac)
    {
        $record = $this->getRecord()->getValue();

        $resp = $this->getXenconnection()->VIF__destroy($this->uuid);

//        print_r($resp);

        $resp2 = $this->create($mac, $record['network'], $record['VM'], $record['device']);

//        print_r($resp2);
    }

    public function getRecord()
    {
        return $this->getXenconnection()->VIF__get_record($this->uuid);
    }

    public function create($mac, $network, $vm, $device)
    {
        return $this->getXenconnection()->VIF__create([
            'network' => $network,
            'MAC' => $mac,
            'MTU' => '1500',
            'device' => (string)$device,
            'VM' => $vm,
            'other_config' => 'replace_empty_struct',
            'qos_algorithm_type' => '',
            'qos_algorithm_params' => 'replace_empty_struct',

        ]);
    }

    
}

?>