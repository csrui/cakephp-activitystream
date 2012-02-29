<?php 

class ActivityStreamTimeline extends AppModel {
	
	public $useTable = 'activity_stream_timeline';
	
	public $belongsTo = array(
		'ActivityStreamActivity' => array(
			'className' => 'ActivityStream.ActivityStreamActivity'
		)		
	);
	
}