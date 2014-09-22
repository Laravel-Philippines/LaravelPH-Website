<?php

class Job extends Eloquent
{
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }
}