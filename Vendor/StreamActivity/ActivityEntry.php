<?php 

include __DIR__ . '/ActivityObject.php';

class ActivityEntry {
	
	const ADD = 'added';
	const POST = 'posted';
	const SHARE = 'shared';
	const INVITE = 'invited';
	const JOIN = 'joined';
	const RSVP_MAYBE = 'rsvp\'d maybe';
	const RSVP_YES = 'rsvp\'d yes';
	const RSVP_NO = 'rsvp\'d no';
	
	private $data = array();
	
	
	public function actor($actor) {
		
		$this->data['actor'] = $actor;
		
		return $this;
		
	}
	
	public function verb($verb) {
		
		$this->data['verb'] = $verb;
		
		return $this;
		
	}
	
	public function object($object) {
		
		$this->data['object'] = $object;
		
		return $this;
		
	}
	
	public function target($target) {
		
		$this->data['target'] = $target;
		
		return $this;
		
	}
	
	public function title() {
		
		if (!empty($this->data['target'])) {
			
			return $this->data['actor']->get('displayName') . ' ' . $this->data['verb'] . ' ' . $this->data['object']->get('displayName') . ' to ' . $this->data['target']->get('displayName');
			
		} 
		
		return $this->data['actor']->get('displayName') . ' ' . $this->data['verb'] . ' ' . $this->data['object']->get('displayName');
		
	}
	
	public function toJson() {
				
		return json_encode($this->getData());
		
	}
	
	public function getData() {
		
		$data['actor'] = $this->data['actor']->getData();
		$data['verb'] = $this->data['verb'];
		$data['object'] = $this->data['object']->getData();
		if (!empty($this->data['target'])) {
			$data['target'] = $this->data['target']->getData();
		}
		
		return $data;
		
	}
	
	public function __toString() {
		
		return $this->toJson();
		
	}
	
}