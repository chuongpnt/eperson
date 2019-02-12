<?php

namespace App\Engine\Language;

class LanguageItem
{
    /**
    /**
     * the label of the language
     *
     * @var string
     */
    public $label = '';
	
    /**
     * the code of the language
     *
     * @var string
     */
    public $code = '';
    
	/**
     * the navigation icon. See https://material.io/icons/
     *
     * @var string
     */
    public $icon = '';
	
    /**
     * the route name defined in laravel routes if this is a route type laravel
     * or vue-router route name if this is a route type vue.
     *
     * @var string
     */
    public $routeName = '';

	/**
     * the route name is activated.
     *
     * @var string
     */
    public $isActive = false;
	
    /**
     * languageItem constructor.
     * @param array $languageData
     */
    public function __construct(array $languageData = [])
    {
        if(!empty($languageData))
        {
            $this->label = $languageData['label'];
			$this->icon = $languageData['icon'];
			$this->code = $languageData['code'];
			$this->routeName = !empty($languageData['route']) ? $languageData['route'] : '/';
        }
    }
}