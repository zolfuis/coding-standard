# Skill: Commit Changes

Stage and commit changes in this repository using conventional commit format.

## Steps

1. Run `git status` to see what has changed.

2. Run `git diff` (and `git diff --staged`) to review the changes.

3. Determine the appropriate commit type from the changes:

   | Type | Use when |
   |------|---------|
   | `feat` | Adding a new sniff or feature |
   | `fix` | Fixing a misconfigured sniff or bug |
   | `docs` | Updating README, CLAUDE.md, or sniffs-decision.md |
   | `chore` | Dependency updates, .gitignore, composer.json |
   | `refactor` | Restructuring phpcs.xml without changing behaviour |
   | `style` | Whitespace or formatting in config files only |

4. Write a commit message following [Conventional Commits](https://www.conventionalcommits.org/):

   ```
   <type>(<scope>): <short description>

   <optional body explaining why, not what>
   ```

   Examples:
   - `feat(sniffs): add SlevomatCodingStandard.Complexity.Cognitive`
   - `fix(typehints): correct ReturnTypeHint property configuration`
   - `docs(readme): add instructions for extending the ruleset`
   - `chore(deps): update slevomat/coding-standard to ^8.15`

5. Stage the relevant files:

   ```bash
   git add <specific files>
   ```

   Prefer staging specific files over `git add -A` to avoid accidentally committing sensitive files.

6. Create the commit:

   ```bash
   git commit -m "<type>(<scope>): <description>"
   ```

7. Confirm success with `git status` and show the commit with `git log --oneline -1`.

## Rules

- Never commit `vendor/`, `.phpcs-cache`, or `*.log` files
- Never skip hooks (`--no-verify`)
- Never amend a published commit — create a new one instead
- Always push to the current branch: `git push -u origin <branch>`
