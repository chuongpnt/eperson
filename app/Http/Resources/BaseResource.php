<?php

namespace App\Http\Resources;

abstract class BaseResource
{
	protected $data = null;
	
	protected $language;
	
	protected $locales = array(
		'vi' => '',
		'ja' => 'jp'
	);
	
    public function __construct($data=array())
    {
		$this->data = $data;
		
		$this->language = $this->locales[app()->getLocale()];
    }
	
	public function getField($name)
	{
		if (empty($this->language)) return $name;
		
		return "{$name}_{$this->language}";
	}
	
	public function getBreadcrumbRoute()
	{
		return $this->data->slug;
	}
	
	public function getBreadcrumbText()
	{
		return $this->data->{$this->getField('title')};
	}
}
