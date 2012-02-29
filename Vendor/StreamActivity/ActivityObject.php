<?php

class ActivityObject {
	
	const ARTICLE = 'article';
	const BADGE = 'badge';
	const BOOKMARK = 'bookmark';
	const COMMENT = 'comment';
	const EVENT = 'event';
	const GROUP = 'group';
	const IMAGE = 'image';
	const PERSON = 'person';
	const PLACE = 'place';
	
	private $data = array();
	
	protected $properties = array();
	
	protected $schema = array(
		'person' => array(
			'displayName',
			'image',
			'id',
			'published',
			'updated',
			'url'
		),
		'place' => array(
			'displayName',
			'id',
			'position',
			'address',
			'url'
		),
		'event' => array(
			'attending',
			'author',
			'displayName',
			'endTime',
			'id',
			'location',
			'published',
			'startTime',
			'summary',
			'updated',
			'url'
		)
	);
	
	public function __construct($type) {
		
		$this->properties = $this->schema[$type];
		$this->data['type'] = $type;
		
	}
	
	public function __call($method, $args) {
		
		if (!in_array($method, $this->properties)) throw new Exception(sprintf("Invalid property: %s", $method), 1);
		
		if (!empty($args)) {
		
			if (count($args) == 1) {
			
				$this->data[$method] = $args[0];
				
			} else {
		
				$this->data[$method] = $args;
				
			}
			
		} else {
			
			return $this->get($method);
			
		}
		
		return $this;
		
	}
	
	public function get($property) {
		
		return $this->data[$property];
		
	}
	
	public function getData() {
		
		return $this->data;
		
	}
	
	public function __toString() {
		
		return json_encode($this->getData());
		
	}
	
}