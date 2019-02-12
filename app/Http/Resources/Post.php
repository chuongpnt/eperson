<?php

namespace App\Http\Resources;

class Post extends BaseResource
{
	public function index()
	{
		if (null !== $this->data) {
			foreach ($this->data as $item) {
				$item->title	= $item->{$this->getField('title')};
				$item->summary	= $item->{$this->getField('summary')};
				$item->content	= $item->{$this->getField('content')};
				
				$category = new Category($item->category);
				$item->category	= $category->detail();




			}		
		}
		return $this->data;
	}
	
	public function detail()
	{
		if (null !== $this->data) {
			$this->data->title	= $this->data->{$this->getField('title')};
			$this->data->summary	= $this->data->{$this->getField('summary')};
			$this->data->content	= $this->data->{$this->getField('content')};
			
			$category = new Category($this->data->category);
			$this->data->category	= $category->detail();
		}
		return $this->data;
	}
}
