<?php

namespace Provenance;

final class CheckCommit
{
    private const TOOLS = ['claude', 'cursor', 'copilot', 'chatgpt', 'openai', 'gemini', 'codex'];
    private const TOOL_INDEX = 1;
    
    public function check(string $commit): array
    {
        preg_match_all('/^(?:Co-Authored-By|Assisted-By|Generated-By):\s*(.+)$/im', $commit, $matches);
        $violations = [];
        foreach ($matches[self::TOOL_INDEX] as $value) {
            foreach (self::TOOLS as $tool) {
                if (false !== stripos($value, $tool)) {
                    $violations = ['message' => 'AI used', 'tool' => $tool];
                    break;
                }
            }
        }
        return $violations;
    }
}
