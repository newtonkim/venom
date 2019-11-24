<?php

 namespace App;


 use Illuminate\Database\Eloquent\Model;

 trait RecordsActivity

{
 	if (auth()->guest()) return;

 	protected static function bootRecordsActivity()
 	{

 		foreach(static::getActivitesToRecord as $event){

 			static::$event(function($model) use ($event){

 				$model->RecordActivity($event);
 			});
 		}

 	}


 	protected static function getActivitesToRecord()
 	{
 		return ['created'];
 	}

 	protected function RecordActivity($event)
    {
    	$this->Activity::create([
            'user_id' => auth()->id(),
            'type' => $this->getActivityType($event),
    	]);

    }

    public function activity(){

    	return $this->morphMany('App\Activity', 'subject');
    }

    protected function getActivityType($event){

        $type = strtolower((new \ReflectionClass($this))->getShotName();

        return "{$event}_{$type}";
    }


}