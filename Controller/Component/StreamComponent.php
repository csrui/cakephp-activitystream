<?php 

App::import('Vendor', 'ActivityStream.ActivityEntry', array('file' => 'ActivityEntry'.DS.'ActivityEntry.php'));

class StreamComponent extends Component {
	

	private $controller = null;
	
	private $actor = null;
	
	private $object = null;
	
	
	//called before Controller::beforeFilter()
	public function initialize($controller) {
		
		// saving the controller reference for later use
		$this->controller = $controller;
		
	}
	
	public function actor($user = null) {
		
		$this->actor = new ActivityObject(ActivityObject::PERSON);
		
		if (!is_null($user)) {
			
			$this->actor->id($user['User']['id'])->displayName($user['User']['username']);
			
		}
		
		return $this->actor;
		
	}
	
	public function object($type) {
		
		$this->object = new ActivityObject($type);
		
		return $this->object;
		
	}
	
	public function log($verb) {

		$Activity = new ActivityEntry();
		
		if (!is_object($this->actor)) $this->actor();
		
		$Activity->actor($this->actor)->verb($verb)->object($this->object);

		$user_ids = $Activity->getRelIDs(ActivityObject::PERSON);

		$this->controller->loadModel('ActivityStream.ActivityStreamActivity');		
		
		$data = array(
			'ActivityStreamActivity' => array(
				'content' => $Activity
			),
			'ActivityStreamTimeline' => array()
		);
		
		foreach($user_ids as $user_id) {
			
			$data['ActivityStreamTimeline'][] = array('user_id' => $user_id);
			
		}
		
		$this->controller->ActivityStreamActivity->saveAssociated($data);	
		
	}
	
}