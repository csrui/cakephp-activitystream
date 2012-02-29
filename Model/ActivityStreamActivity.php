<?php 

class ActivityStreamActivity extends AppModel {
	
	
	
	public $hasMany = array(
		'ActivityStreamTimeline' => array(
			'className' => 'ActivityStream.ActivityStreamTimeline'
		)		
	);
	
	
}