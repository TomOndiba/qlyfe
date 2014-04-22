<?php 

/**
 * Qlyfe_Identity ... stores identity information about an entity
 * You can use it to set $entity->name = new Qlyfe_Identity($array)
 * @author brian
 *
 */
class Qlyfe_Identity {
    public $names = array(); // hash of network=>name
	public $default;
    
	/**
	 * @param array $array an associative array network=>identity
	 * @param string $default = the default value (should be = firstname + " " + lastname)
	 */
    public function __construct($array, $default) {
		$this->names = $array;
    	$this->default = $default;
    }
    
    /**
     * 
     */
    public function get($network) {
    	if ($this->names[$network])
    		return $this->names[$network];
    		
    	return $this->default;
    }
    
    /**
     * This method determins identity precedence
     */
    public function __toString() {
    	if ($this->names['family'])
    		return $this->names['family'];

    	if ($this->names['friends'])
    		return $this->names['friends'];

    	if ($this->names['public'])
    		return $this->names['public'];
    		
    	return $default;
    }
}