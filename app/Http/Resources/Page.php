<?php

namespace App\Http\Resources;

class Page extends BaseResource
{
    public function index()
    {
        if (null !== $this->data) {
            $this->data->title			= $this->data->{$this->getField('title')};
            $this->data->description	= $this->data->{$this->getField('description')};
            $this->data->keyword		= $this->data->{$this->getField('keyword')};
            $this->data->content		= $this->data->{$this->getField('content')};

        }
        return $this->data;
    }

}
