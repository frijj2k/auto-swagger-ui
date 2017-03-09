<?php

class ReferralsTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testTheStartAt()
    {
        $start_at =  ref_conf('start_at', 0);
        $this->assertEquals($start_at, \Frijj2k\Referrals\ReferQueue::all()->count());
    }

    public function testJumpQueue() {
        $jump = 10; //jumps 10 places in the queue

        $ref = \Frijj2k\Referrals\ReferQueue::findOrFail(20);

        $move = new \Frijj2k\Referrals\Jobs\MoveInQueue($ref, $ref->position - $jump);

        $move->handle();

        $ref = \Frijj2k\Referrals\ReferQueue::findOrFail(20);

        $this->assertEquals(10, $ref->position);
    }
}