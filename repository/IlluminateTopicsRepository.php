<?php namespace BlackScorp\OctoberTopicVoter\Repository;


use BlackScorp\TopicVoter\Entity\TopicEntity;
use BlackScorp\TopicVoter\Repository\TopicRepository;

use Illuminate\Database\Connection;

class IlluminateTopicsRepository implements TopicRepository
{
    /**
     * @var \Illuminate\Database\Connection
     */
    private Connection $connection;

    /**
     * IlluminateTopicsRepository constructor.
     * @param Connection $connection
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(int $limit, int $offset)
    {
        $topics = $this->connection->table('october_topics')->limit($limit)->offset($offset)->get();

        $found = [];
        foreach ($topics as $topic){
            $created = new \DateTime();
            $created->setTimestamp((int)$topic->created_at);
            $entity = new TopicEntity($topic->id,$topic->title,$topic->text,$topic->slug,$created);
            $found[]=$entity;
        }

        return $found;
    }

    public function findBySlug(string $slug): ?TopicEntity
    {
        return null;
    }

    public function saveOrUpdate(TopicEntity $entity)
    {
        return true;
    }

}
