<?php

namespace InstagramScraper\Model;

/**
 * Class Media
 * @package InstagramScraper\Model
 */
class ReelMedia extends AbstractModel
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var int
     */
    protected $pk;

    /**
     * @var string
     */
    protected $caption;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var int
     */
    protected $expiringAt;

    /**
     * @var string
     */
    protected $image;

    /**
     * @var Account
     */
    protected $user;

    /**
     * @var Account[]
     */
    protected $mentions;

    /**
     * @var Comment[]
     */
    protected $previewComments = [];

    /**
     * @var Comment[]
     */
    protected $comments = [];

    /**
     * @var string
     */
    protected $commentsCount = 0;

    /**
     * @var int
     */
    protected $createdTime = 0;

    /**
     * @var int
     */
    protected $likesCount = 0;

    /**
     * @var Account[]
     */
    protected $likers = [];

    /**
     * @var int
     */
    protected $mediaType;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPk()
    {
        return $this->pk;
    }

    /**
     * @return string
     */
    public function getCaption()
    {
        return $this->caption;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getExpiringAt()
    {
        return $this->expiringAt;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return Account
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return Account[]
     */
    public function getMentions()
    {
        return $this->mentions;
    }

    /**
     * @return Comment[]
     */
    public function getPreviewComments()
    {
        return $this->previewComments;
    }

    /**
     * @return Comment[]
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return string
     */
    public function getCommentsCount()
    {
        return $this->commentsCount;
    }

    /**
     * @return int
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * @return int
     */
    public function getLikesCount()
    {
        return $this->likesCount;
    }

    /**
     * @return Account[]
     */
    public function getLikers()
    {
        return $this->likers;
    }

    /**
     * @return int
     */
    public function getMediaType()
    {
        return $this->mediaType;
    }

    /**
     * @param $value
     * @param $prop
     * @param $arr
     */
    protected function initPropertiesCustom($value, $prop, $arr)
    {
        switch ($prop) {
            case 'pk':
                $this->pk = (int)$value;
                break;
            case 'id':
                $this->id = $value;
                break;
            case 'caption':
                $this->caption = isset($arr[$prop]['text']) ? $arr[$prop]['text'] : null;
                break;
            case 'code':
                $this->code = $value;
                break;
            case 'expiring_at':
                $this->expiringAt = (int)$value;
                break;
            case 'reel_mentions':
                foreach ($arr[$prop] as $mention) {
                    if (!$mention['user']) {
                        continue;
                    }

                    $this->mentions[] = Account::create($mention['user']);
                }
                break;
            case 'user':
                $this->user = Account::create($arr[$prop]);
                break;
            case 'image_versions2':
                foreach ($arr[$prop]['candidates'] as $candidate) {
                    if (!$candidate['url']) {
                        continue;
                    }

                    $this->image = $candidate['url'];
                    break;
                }
                break;
            case 'preview_comments':
                if (is_array($arr[$prop])) {
                    foreach ($arr[$prop] as $commentData) {
                        $this->previewComments[] = Comment::create($commentData);
                    }
                }
                break;
            case 'comments':
                if (is_array($arr[$prop])) {
                    foreach ($arr[$prop] as $commentData) {
                        $this->comments[] = Comment::create($commentData);
                    }
                }
                break;
            case 'comment_count':
                $this->commentsCount = (int)$arr[$prop];
                break;
            case 'taken_at':
                $this->createdTime = $arr[$prop];
                break;
            case 'like_count':
                $this->likesCount = $arr[$prop];
                break;
            case 'likers':
                if (is_array($arr[$prop])) {
                    foreach ($arr[$prop] as $accountData) {
                        $this->likers[] = Account::create($accountData);
                    }
                }
                break;
            case 'media_type':
                $this->mediaType = $value;
                break;
        }
    }
}
