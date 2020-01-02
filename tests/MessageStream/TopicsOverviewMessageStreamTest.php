<?php namespace BlackScorp\OctoberTopicVoter\Tests\MessageStream;

use BlackScorp\OctoberTopicVoter\MessageStream\OctoberTopicsOverviewMessageStream;
use PluginTestCase;

class TopicsOverviewMessageStreamTest extends PluginTestCase
{

    public function testCanSetLimit(){
        $messageStream = new OctoberTopicsOverviewMessageStream(10,0);
        $this->assertSame(10,$messageStream->getLimit());
    }

    public function testOffsetIsNullOnFirstPage(){
        $messageStream = new OctoberTopicsOverviewMessageStream(10,0);
        $this->assertSame(0,$messageStream->getOffset());
    }

    public function testOffsetIsCorrectOnPage(){
        $messageStream = new OctoberTopicsOverviewMessageStream(10,1);
        $this->assertSame(10,$messageStream->getOffset());
    }

}
