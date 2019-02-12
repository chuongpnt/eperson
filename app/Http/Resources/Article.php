<?php

namespace App\Http\Resources;

class Article extends BaseResource
{
	public function index()
	{
		if (null !== $this->data) {
			foreach ($this->data as $item) {
				$item->title	= $item->{$this->getField('title')};
				$item->summary	= $item->{$this->getField('summary')};
				$item->color	= array("badge-blue","badge-green","badge-pink","badge-brown");
				
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
			$this->data->content	= $this->data->{$this->getField('content')};
			
			$category = new Category($this->data->category);
			$this->data->category	= $category->detail();
		}
		return $this->data;
	}
}
