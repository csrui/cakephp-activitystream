<?php 

App::import('Vendor', 'ActivityStream.ActivityEntry');#, array('file' => 'StreamActivity'.DS.'StreamActivity.php'));

class StreamComponent extends Component {
	

	private $controller = null;
	
	private $actor = null;
	
	private $object = null;
	
	
	//called before Controller::beforeFilter()
	public function initialize($controller) {
		
		// saving the controller reference for later use
		$this->controller = $controller;
		
	}
	
	public function actor($use_session = true) {
		
		$this->actor = new StreamObject(StreamObject::PERSON);
		
		if ($use_session === true) {
			
			$user = $this->controller->Auth->user();			
			$this->actor->id($user['id'])->displayName($user['name']);
			
		}
		
		return $this->actor;
		
	}
	
	public function object() {
		
		$this->object = new StreamObject(StreamObject::EVENT);
		
		return $this->object;
		
	}
	
	public function log($verb) {

		$Activity = new StreamActivity();
		
		if (!is_object($this->actor)) $this->actor();
		
		$Activity->actor($this->actor)->verb($verb)->object($this->object);

		$this->controller->loadModel('Stream.Stream');		
		$this->controller->Stream->save(array('content' => $Activity));	
		
	}
	
}