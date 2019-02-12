<?php

namespace App\Http\Resources;

class Category extends BaseResource
{
	public function index()
	{
		if (null !== $this->data) {
			foreach ($this->data as $item) {
				$item->title	= $item->{$this->getField('title')};
				$item->summary	= $item->{$this->getField('summary')};
			}
		}
		
		return $this->data;
	}
	
	public function detail()
	{
		if (null !== $this->data) {
			$this->data->title	= $this->data->{$this->getField('title')};
		}
		
		return $this->data;
	}
}
