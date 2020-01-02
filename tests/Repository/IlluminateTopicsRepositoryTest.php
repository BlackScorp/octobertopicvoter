<?php

namespace BlackScorp\OctoberTopicVoter\Tests\Repository;

use BlackScorp\OctoberTopicVoter\Repository\IlluminateTopicsRepository;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\DB;
use PluginTestCase;

class IlluminateTopicsRepositoryTest extends PluginTestCase
{


    public function testEmptyRepository()
    {
        $repository = new IlluminateTopicsRepository(DB::connection());

        $entites = $repository->findAll(10, 0);
        $this->assertEmpty($entites);
    }

    public function testCanFindFirstEntity()
    {
        //Arrange
        DB::table('october_topics')->insert(
            [['id' => 1, 'title' => 'test 1', 'slug' => 'test_slug', 'text' => 'test text', 'created_at' => new \DateTime()]]
        );

        $repository = new IlluminateTopicsRepository(DB::connection());

        //Act
        $entites = $repository->findAll(10, 0);

        //Assert
        $this->assertSame(1, count($entites));

        //Cleanup
        DB::table('october_topics')->where('id', '=', 1)->delete();
    }

    public function testCanFindMultipleEntities(){
        DB::table('october_topics')->insert([
            ['id' => 1, 'title' => 'test 1', 'slug' => 'test_slug', 'text' => 'test text', 'created_at' => new \DateTime()],
            ['id' => 2, 'title' => 'test 2', 'slug' => 'test_slug2', 'text' => 'test text2', 'created_at' => new \DateTime()]
        ]);

        $repository = new IlluminateTopicsRepository(DB::connection());

        $entites = $repository->findAll(10, 0);
        $this->assertSame(2, count($entites));

        DB::table('october_topics')->whereIn('id', [1,2])->delete();
    }


    public function testCanFindWithLimit()
    {
        DB::table('october_topics')->insert([
            ['id' => 1, 'title' => 'test 1', 'slug' => 'test_slug', 'text' => 'test text', 'created_at' => new \DateTime()],
            ['id' => 2, 'title' => 'test 2', 'slug' => 'test_slug2', 'text' => 'test text2', 'created_at' => new \DateTime()]
        ]);

        $repository = new IlluminateTopicsRepository(DB::connection());

        $entites = $repository->findAll(1, 0);
        $this->assertSame(1, count($entites));

        DB::table('october_topics')->whereIn('id',   [1,2])->delete();
    }


    public function testCanFindWithOffset()
    {
        DB::table('october_topics')->insert([
                ['id' => 1, 'title' => 'test 1', 'slug' => 'test_slug', 'text' => 'test text', 'created_at' => new \DateTime()],
                ['id' => 2, 'title' => 'test 2', 'slug' => 'test_slug2', 'text' => 'test text2', 'created_at' => new \DateTime()]
            ]
        );

        $repository = new IlluminateTopicsRepository(DB::connection());

        $entites = $repository->findAll(1, 1);
        $this->assertSame(1, count($entites));
        $this->assertSame(2, $entites[0]->getId());

        DB::table('october_topics')->whereIn('id',  [1,2])->delete();
    }

}
