<?php

use \Illuminate\Database\Eloquent\ModelNotFoundException;

class Job extends Eloquent
{
    public function author()
    {
        return $this->belongsTo('User', 'user_id');
    }

    public function findPublishedByIdOrFail($id)
    {
        $job = $this->whereId($id)
            ->whereStatus('published')
            ->first();

        if ($job) {
            return $job;
        }

        throw new ModelNotFoundException;
    }

    public function getAllPublishedPaginated($perPage = 25)
    {
        return $this->whereStatus('published')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function getByQueryPaginated($query, $perPage = 25)
    {
        return $this->whereStatus('published')
            ->where(function ($modelQuery) use ($query)
            {
                $query = '%' . strtolower($query) . '%';
                $modelQuery
                    ->orWhereRaw('LOWER(title) LIKE ?', array($query))
                    ->orWhereRaw('LOWER(description) LIKE ?', array($query));
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

}