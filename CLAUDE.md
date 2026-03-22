# CLAUDE.md — Coding Standard Project

This file provides context for Claude Code sessions working in this repository.

---

## Project overview

This repository contains a reusable PHP coding standard based on PSR-12 and [Slevomat Coding Standard](https://github.com/slevomat/coding-standard). The primary artefacts are:

| File | Purpose |
|------|---------|
| `phpcs.xml` | The main ruleset — edit this to add/remove/configure sniffs |
| `sniffs-decision.md` | Log of every Slevomat sniff with include/skip decision and reason |
| `composer.json` | Dependencies: phpcs, slevomat, composer installer |
| `README.md` | User-facing documentation |

---

## Running checks

```bash
# Check for violations
composer phpcs

# Auto-fix what can be fixed
composer phpcbf
```

Dependencies must be installed first (`composer install`).

---

## Adding or modifying sniffs

1. Open `phpcs.xml`
2. Add `<rule ref="SlevomatCodingStandard.Category.SniffName"/>` in the appropriate section
3. Add a `<properties>` block inside the rule if configuration is needed
4. Open `sniffs-decision.md` and update the relevant row (change ❌ to ✅, update the Reason column)
5. Commit via `/commit`

To remove a sniff: delete its `<rule>` block from `phpcs.xml` and update `sniffs-decision.md`.

---

## Branching conventions

- All changes go on a feature branch prefixed with `claude/`
- Branch names follow the pattern: `claude/<description>-<session-id>`
- Never push directly to `main`

---

## Available skills

Two Claude skills are available in this repo:

| Skill | Trigger | What it does |
|-------|---------|-------------|
| `/commit` | `/commit` | Stages changes, writes a conventional commit message, commits |
| `/create-issue` | `/create-issue` | Interactively creates a GitHub issue with title, body, and labels |

Skills are defined in `.claude/skills/`.

---

## Sniff reference

The full alphabetical list of Slevomat sniffs: https://github.com/slevomat/coding-standard#alphabetical-list-of-sniffs

PHP_CodeSniffer annotated ruleset docs: https://github.com/squizlabs/PHP_CodeSniffer/wiki/Annotated-Ruleset
