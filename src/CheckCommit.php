<?php

namespace Provenance;

use Provenance\Git\Commit;

final class CheckCommit
{
    private const TOOLS = ['claude', 'cursor', 'copilot', 'chatgpt', 'openai', 'gemini', 'codex'];
    private const TOOL_INDEX = 1;
    
    public function check(Commit $commit): array
    {
        preg_match_all('/^(?:Co-Authored-By|Assisted-By|Generated-By):\s*(.+)$/im', $commit->getMessage(), $matches);
        $violations = [];
        foreach ($matches[self::TOOL_INDEX] as $value) {
            foreach (self::TOOLS as $tool) {
                if (false !== stripos($value, $tool)) {
                    $violations = ['hash' => $commit->getHash(), 'tool' => $tool];
                    break;
                }
            }
        }
        return $violations;
    }
}
