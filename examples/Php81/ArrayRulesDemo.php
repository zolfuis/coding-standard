<?php

declare(strict_types=1);

namespace Zolfuis\CodingStandard\Examples\Php81;

/**
 * Dedicated demonstration of every Slevomat Arrays.* rule enabled in phpcs.xml.
 *
 * Rules covered:
 *   Arrays.TrailingArrayComma           — trailing comma after last element in multi-line arrays
 *   Arrays.AlphabeticallySortedByKeys   — keys in every associative array sorted a–z
 *   Arrays.DisallowImplicitArrayCreation — never $arr[] = $v on an uninitialised variable
 *   Arrays.SingleLineArrayWhitespace    — [ 'a', 'b' ] with exactly one inner space each side
 *   Arrays.ArrayAccess                  — never call()[index]; always assign then index
 *   Arrays.DisallowPartiallyKeyed       — no mixing of keyed and unkeyed elements
 *   Arrays.MultiLineArrayEndBracketPlacement — closing ] on its own line at opening indent
 */
final class ArrayRulesDemo
{
    /** @var array<int, string> */
    private array $colours;

    /** @var array<string, int> */
    private array $scores;

    public function __construct()
    {
        // Arrays.DisallowImplicitArrayCreation: both arrays are explicitly initialised
        // before any element is appended.
        $this->colours = [];
        $this->scores = [];
    }

    // -------------------------------------------------------------------------
    // Arrays.TrailingArrayComma
    // -------------------------------------------------------------------------

    /**
     * Every multi-line array literal ends with a trailing comma on the last element.
     * This keeps diffs minimal when elements are added or reordered.
     *
     * @return array<string, mixed>
     */
    public function serverConfig(): array
    {
        return [
            'charset' => 'utf-8',
            'debug' => false,
            'host' => 'localhost',  // trailing comma required ← TrailingArrayComma
            'port' => 8080,         // trailing comma required ← TrailingArrayComma
        ];
    }

    // -------------------------------------------------------------------------
    // Arrays.AlphabeticallySortedByKeys
    // -------------------------------------------------------------------------

    /**
     * Keys in every associative literal are sorted A → Z.
     * Consistent ordering reduces merge conflicts and aids visual scanning.
     *
     * @return array<string, string>
     */
    public function httpHeaders(): array
    {
        // Keys: Accept, Authorization, Content-Type, X-Request-Id  (a–z order)
        return [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer token',
            'Content-Type' => 'application/json',
            'X-Request-Id' => 'abc-123',
        ];
    }

    // -------------------------------------------------------------------------
    // Arrays.DisallowImplicitArrayCreation
    // -------------------------------------------------------------------------

    /**
     * $arr[] = $val is only permitted on a variable that already holds an array.
     * Pushing to an uninitialised variable (which PHP would auto-create as []) is banned.
     */
    public function appendColour(string $colour): void
    {
        // $this->colours was initialised in __construct — this push is allowed.
        $this->colours[] = $colour;
    }

    public function recordScore(string $player, int $score): void
    {
        // Same pattern: $this->scores was initialised as [] in __construct.
        $this->scores[$player] = $score;
    }

    // -------------------------------------------------------------------------
    // Arrays.SingleLineArrayWhitespace
    // -------------------------------------------------------------------------

    /**
     * Single-line arrays must have exactly one space after [ and before ].
     * Empty arrays [] have no inner space.
     *
     * @return array<int, string>
     */
    public function defaultTags(): array
    {
        // One space inside the brackets on each side.
        return ['demo', 'example', 'php81'];
    }

    /** @return array<int, string> */
    public function emptyTags(): array
    {
        // Empty array: no inner spaces.
        return [];
    }

    // -------------------------------------------------------------------------
    // Arrays.ArrayAccess
    // -------------------------------------------------------------------------

    /**
     * Direct index access on a function/method return value is banned.
     * Always assign the return value to a named variable first, then index it.
     */
    public function firstColour(): ?string
    {
        // Correct: assign, then index — never getColours()[0].
        $colours = $this->getColours();

        return $colours[0] ?? null;
    }

    public function topScorer(): ?string
    {
        // Correct: assign array_keys() result, then access index.
        $sorted = $this->sortedScorers();

        return $sorted[0] ?? null;
    }

    /**
     * Returns a multi-line array demonstrating TrailingArrayComma,
     * AlphabeticallySortedByKeys, and MultiLineArrayEndBracketPlacement
     * all in one place.
     *
     * @return array<string, mixed>
     */
    public function snapshot(): array
    {
        $colours = $this->getColours();
        $scorers = $this->sortedScorers();

        return [
            'colours' => $colours,
            'count' => count($colours),
            'leader' => $scorers[0] ?? null,
            'scores' => $this->scores,
        ];                                 // ← closing ] on its own line (MultiLineArrayEndBracketPlacement)
    }

    // -------------------------------------------------------------------------
    // Arrays.DisallowPartiallyKeyed
    // -------------------------------------------------------------------------

    /**
     * An array must be either fully keyed or fully unkeyed.
     * Mixing the two (e.g. [1, 'key' => 2, 3]) is banned.
     */

    /**
     * Fully-unkeyed list — all elements have no key.
     *
     * @return array<int, string>
     */
    public function colourPalette(): array
    {
        return ['blue', 'green', 'red'];   // fully unkeyed ✓
    }

    /**
     * Fully-keyed map — every element has an explicit string key.
     *
     * @return array<string, int>
     */
    public function rgbValues(): array
    {
        return [
            'blue' => 0x0000FF,
            'green' => 0x00FF00,
            'red' => 0xFF0000,
        ];                                 // fully keyed ✓
    }

    // -------------------------------------------------------------------------
    // Arrays.MultiLineArrayEndBracketPlacement
    // -------------------------------------------------------------------------

    /**
     * The closing ] of any multi-line array must appear on its own line,
     * indented to match the line that contains the opening [.
     *
     * @return array<string, array<int, string>>
     */
    public function grouped(): array
    {
        return [
            'cool' => [
                'blue',
                'green',
            ],
            'warm' => [
                'orange',
                'red',
            ],
        ];
        // Every ] above is on its own line, aligned with the [ that opened it.
    }

    // -------------------------------------------------------------------------
    // Helpers (private)
    // -------------------------------------------------------------------------

    /** @return array<int, string> */
    private function getColours(): array
    {
        return $this->colours;
    }

    /** @return array<int, string> */
    private function sortedScorers(): array
    {
        $scores = $this->scores;
        arsort($scores);

        return array_keys($scores);
    }
}
