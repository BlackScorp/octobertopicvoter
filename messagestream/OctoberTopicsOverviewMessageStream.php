<?php
namespace BlackScorp\OctoberTopicVoter\MessageStream;

use BlackScorp\TopicVoter\MessageStream\ListTopicMessageStream;
use BlackScorp\TopicVoter\View\TopicView;
use Cms\Classes\ComponentBase;
use Cms\Classes\PageCode;

class OctoberTopicsOverviewMessageStream implements ListTopicMessageStream
{
    private $offset = 0;
    private $limit = 0;
    /**
     * @var TopicView[]
     */
    public $topics =[];


    public function __construct(int $limit,int $page)
    {

        $this->limit =  $limit;
        $this->offset = $page* $this->limit;


    }

    public function addTopic(TopicView $view)
    {

     $this->topics[]=$view;
    }

    public function getLimit()
    {
     return $this->limit;
    }

    public function getOffset()
    {
      return $this->offset;
    }

}
