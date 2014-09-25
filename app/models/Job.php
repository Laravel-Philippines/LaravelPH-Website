<?php

class Job extends Eloquent
{
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function getAllPaginated($perPage = 25)
    {
        return $this->orderBy('created_at', 'desc')->paginate($perPage);
    }

}