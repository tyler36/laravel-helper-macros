<?php


/**
 * Class CollectionMacroServiceProviderTest
 *
 * @test
 * @group ServiceProvider
 * @group macro
 * @group collection
 */
class CollectionMacroServiceProviderTest extends TestCase
{

    /**
     * TEST:        'pipe'
     */
    public function testPipeMacroOnCollection()
    {
        $collect = collect([1, 2, 3])
            ->pipe(function ($data) {
                return $data->merge([4, 5, 6]);
            });

        $this->assertEquals(collect([1, 2, 3, 4, 5, 6]), $collect);
    }


    /**
     * TEST:        'dd'
     */
    public function testDDMacroOnCollection()
    {
        // Not test-able
    }


    /**
     * TEST:        'ifEmpty' runs callback on empty Collection
     *
     * @group ifEmpty
     */
    public function testIfEmptyMacroOnEmptyCollection()
    {
        // SETUP:       New collection
        $collection = collect([]);

        // ASSERT:      Empty
        $this->assertTrue($collection->isEmpty());

        // SETUP:       Callback should toggle this
        $callback = false;
        $this->assertFalse($callback);

        // RUN:
        $collection->ifEmpty(function () use (&$callback) {
            $callback = true;
        });

        // ASSERT:      Callback was called
        $this->assertTrue($callback);
    }


    /**
     * TEST:        'ifEmpty' does NOT run on populated collection
     *
     * @group ifEmpty
     */
    public function testIfEmptyMacroOnPopulatedCollection()
    {
        // SETUP:       New collection
        $collection = collect([1, 2, 3]);

        // ASSERT:      Not Empty
        $this->assertFalse($collection->isEmpty());

        // SETUP:       Callback should toggle this
        $callback = false;
        $this->assertFalse($callback);

        // RUN:
        $collection->ifEmpty(function () use (&$callback) {
            $callback = true;
        });

        // ASSERT:      Callback was not called
        $this->assertFalse($callback);
    }


    /**
     * TEST:        'ifAny' does NOT run callback on empty Collection
     *
     * @group ifAny
     */
    public function testIfAnyMacroOnEmptyCollection()
    {
        // SETUP:       New collection
        $collection = collect([]);

        // ASSERT:      Empty
        $this->assertTrue($collection->isEmpty());

        // SETUP:       Callback should toggle this
        $callback = false;
        $this->assertFalse($callback);

        // RUN:
        $collection->ifAny(function () use (&$callback) {
            $callback = true;
        });

        // ASSERT:      Callback was not called
        $this->assertFalse($callback);
    }


    /**
     * TEST:        'ifAny' runs callback on populated Collection
     *
     * @group ifAny
     */
    public function testIfAnyMacroOnPopulatedCollection()
    {
        // SETUP:       New collection
        $collection = collect([1, 2, 3]);

        // ASSERT:      Empty
        $this->assertFalse($collection->isEmpty());

        // SETUP:       Callback should toggle this
        $callback = false;
        $this->assertFalse($callback);

        // RUN:
        $collection->ifAny(function () use (&$callback) {
            $callback = true;
        });

        // ASSERT:      Callback was not called
        $this->assertTrue($callback);
    }


    /**
     * TEST:        'fails'
     */
    public function testFailsMacro()
    {
        $items = collect([
            1 => ['created_at' => '20150228'],
            2 => ['created_at' => '20150229'],
            3 => ['created_at' => '20150230'],
            4 => ['created_at' => '20150301'],
        ]);

        $this->assertEquals(
            [
                2 => ['created_at' => '20150229'],
                3 => ['created_at' => '20150230'],
            ],
            $items->fails(['created_at' => 'date'])->all()
        );
    }


    /**
     * TEST:        'passes'
     */
    public function testPassesMacro()
    {
        $items = collect([
            1 => ['created_at' => '20150228'],
            2 => ['created_at' => '20150229'],
            3 => ['created_at' => '20150301'],
        ]);

        $this->assertEquals(
            [
                1 => ['created_at' => '20150228'],
                3 => ['created_at' => '20150301'],
            ],
            $items->passes(['created_at' => 'date'])->all()
        );
    }
}
