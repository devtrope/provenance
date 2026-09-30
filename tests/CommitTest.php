<?php

use PHPUnit\Framework\TestCase;
use Provenance\CheckCommit;

final class CommitTest extends TestCase
{
    private CheckCommit $checkCommit;

    public function setUp(): void
    {
        $this->checkCommit = new CheckCommit();
    }

    public function testCanSpotAnAICommit(): void
    {
        $commit = "Co-Authored-By: Claude Sonnet 5";
        $this->assertSame(['message' => 'AI used', 'tool' => 'claude'], $this->checkCommit->check($commit));
    }

    public function testCanSpotAHumanCommit(): void
    {
        $commit = "Just a simple human commit";
        $this->assertSame([], $this->checkCommit->check($commit));
    }
}