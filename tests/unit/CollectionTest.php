<?php

class CollectionTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function empty_instantiated_collection_returns_no_items()
    {
        $collection = new \App\Support\Collection;

        $this->assertEmpty($collection->get());
    }

    /** @test */
    public function count_is_correct_for_items_passed_in()
    {
        $collection = new \App\Support\Collection([
            '1', '2', '3'
        ]);

        $this->assertEquals(3, $collection->count());
    }

    /** @test */
    public function items_returned_match_items_passed_in()
    {
        $collection = new \App\Support\Collection([
            '1', '2'
        ]);

        $this->assertCount(2, $collection->get());
        $this->assertEquals($collection->get()[0], '1');
        $this->assertEquals($collection->get()[1], '2');
    }

    /** @test */
    public function collection_is_instance_of_iterator_aggregate()
    {
        $collection = new \App\Support\Collection;
        
        $this->assertInstanceOf(IteratorAggregate::class, $collection);
    }

    /** @test */
    public function collection_can_be_iterated()
    {
        $collection = new \App\Support\Collection([
            '1', '2', '3'
        ]);

        $items = [];

        foreach ($collection as $item) {
            $items[] = $item;
        }

        $this->assertCount(3, $items);
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    /** @test */
    public function collection_can_be_merged_with_another_collection()
    {
        $collection1 = new \App\Support\Collection([
            '1', '2'
        ]);
        $collection2 = new \App\Support\Collection([
            '3', '4', '5'
        ]);

        $collection1->merge($collection2);

        $this->assertCount(5, $collection1->get());
        $this->assertEquals(5, $collection1->count());
    }

    /** @test */
    public function can_add_existing_collection()
    {
        $collection = new \App\Support\Collection([
            '1', '2'
        ]);

        $collection->add(['3']);

        $this->assertCount(3, $collection->get());
        $this->assertEquals(3, $collection->count());
    }

    /** @test */
    public function returns_json_encoded_items()
    {
        $collection = new \App\Support\Collection([
            ['username' => 'Hojin'],
            ['username' => 'Jueun']
        ]);

        $json = '[{"username":"Hojin"},{"username":"Jueun"}]';

        $this->assertIsString($collection->toJson());
        $this->assertEquals($json, $collection->toJson());
    }

    /** @test */
    public function json_encoding_collection_object_returns_json()
    {
        $collection = new \App\Support\Collection([
            ['username' => 'Hojin'],
            ['username' => 'Jueun']
        ]);

        $encoded = json_encode($collection);
        $json = '[{"username":"Hojin"},{"username":"Jueun"}]';

        $this->assertIsString($encoded);
        $this->assertEquals($json, $encoded);
    }
}