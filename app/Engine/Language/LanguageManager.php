<?php

namespace App\Engine\Language;

class LanguageManager
{
	/**
     * the current app locale
     *
     * @var string
     */
    protected $currentLanguage;
	
    /**
     * the array of LanguageItem objects
     *
     * @var array
     */
    protected $languageItems = [];
	
	public function __construct()
	{
		$this->currentLanguage = $this->detectLanguage();
		// app()->setLocale($this->currentLanguage);
	}
	
	/**
     * detect language
     *
     * @param string
     */
	public function detectLanguage()
	{
		return request()->segment(1);
	}
	
    /**
     * add language
     *
     * @param LanguageItem $languageItem
     */
    public function addLanguage(LanguageItem $languageItem)
    {
		$languageItem->isActive = false;
		if (app()->getLocale() === $languageItem->code) $languageItem->isActive = true;
		
        $this->LanguageItems[$languageItem->code] = $languageItem;
    }

    /**
     * add language from given array of LanguageItem objects
     *
     * @param array $languages
     */
    public function addLanguages(array $languages)
    {
        foreach ($languages as $language)
        {
            $this->addLanguage($language);
        }
    }
	
    /**
     * get current language
     *
     * @return \Illuminate\Support\Collection
     */
    public function getCurrent()
    {
		return $this->LanguageItems[app()->getLocale()];
    }
	
    /**
     * get all languages
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return collect($this->LanguageItems);
    }

    /**
     * get languages that is filtered already
     *
     * @return languageManager|\Illuminate\Support\Collection
     */
    public function getFiltered()
    {
        return $this->filter();
    }

    /**
     * check if a the language items has a given language label
     *
     * @param string $languageLabel
     * @return bool
     */
    public function hasLanguage(string $languageLabel)
    {
        $found = false;
        $languages = $this->filter();

        $languages->each(function(LanguageItem $languageItem) use (&$found,$languageLabel)
        {
            if($languageItem->label === $languageLabel) $found = true;
        });

        return $found;
    }
}