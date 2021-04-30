<?php

namespace InstagramScraper\Model;

/**
 * Class Story
 * @package InstagramScraper\Model
 */
class Story extends Media
{
    /**
     * @var array
     */
    protected $tappableObjects = [];

    /**
     * @var string
     */
    protected $storyCtaUrl;


    /**
     * @return string
     */
    public function getStoryCtaUrl()
    {
        return $this->storyCtaUrl;
    }


    /**
     * @param false $toJson
     *
     * @return array|false|string
     */
    public function getTappableObjects($toJson = false)
    {
        return $toJson ? json_encode($this->tappableObjects) : $this->tappableObjects;
    }


    private $skip_prop = [
        'owner' => true,
    ];

    /***
     * We do not need some values - do not parse it for Story,
     * for example - we do not need owner object inside story
     *
     * @param $value
     * @param $prop
     * @param $arr
     */
    protected function initPropertiesCustom($value, $prop, $arr)
    {
        if (!empty($this->skip_prop[$prop])) {
            return;
        }

        switch ($prop) {
            case 'tappable_objects':
                $this->tappableObjects = (array) $value;
                break;
            case 'story_cta_url':
                $this->storyCtaUrl = (string) $value;
                break;
        }

        parent::initPropertiesCustom($value, $prop, $arr);
    }
}