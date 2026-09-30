<?php

use PHPUnit\Framework\TestCase;
use Provenance\CheckCommit;
use Provenance\Git\Commit;

final class CommitTest extends TestCase
{
    private CheckCommit $checkCommit;

    public function setUp(): void
    {
        $this->checkCommit = new CheckCommit();
    }

    public function testCanSpotAnAICommit(): void
    {
        $commit = new Commit('1234', "Co-Authored-By: Claude Sonnet 5");
        $this->assertSame(['hash' => '1234', 'tool' => 'claude'], $this->checkCommit->check($commit));
    }

    public function testCanSpotAHumanCommit(): void
    {
        $commit = new Commit('', "Just a simple human commit");
        $this->assertSame([], $this->checkCommit->check($commit));
    }
}