<?php 

class ActivityStreamTimeline extends AppModel {
	
	public $useTable = 'activity_stream_timeline';
	
	public $order = array(
		'ActivityStreamActivity.created' => 'DESC'
	);
	
	public $belongsTo = array(
		'ActivityStreamActivity' => array(
			'className' => 'ActivityStream.ActivityStreamActivity'
		)		
	);
	
}