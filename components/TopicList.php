<?php

namespace BlackScorp\OctoberTopicVoter\Components;

use BlackScorp\OctoberTopicVoter\MessageStream\OctoberTopicsOverviewMessageStream;
use BlackScorp\OctoberTopicVoter\Repository\IlluminateTopicsRepository;
use BlackScorp\TopicVoter\UseCase\ListTopicsUseCase;
use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\DB;

class TopicList extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Topic List',
            'description' => 'Shows a simple voting List'
        ];
    }

    public function defineProperties()
    {
        return [
            'topicsPerPage' => [
                'title'             => 'Topics per page',
                'description'       => 'The amount of topics to display',
                'default'           => 10,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'The Max Items property can contain only numeric symbols'
            ]

        ];
    }


    public function onRun()
    {

        $messageStream = new OctoberTopicsOverviewMessageStream(
            $this->property('topicsPerPage'),$this->param('page',0)
        );
        $topicRepository = new IlluminateTopicsRepository(DB::connection());

        $useCase = new ListTopicsUseCase($topicRepository);
        $useCase->process($messageStream);
        $this->page['topics'] = $messageStream->topics;

    }
}
