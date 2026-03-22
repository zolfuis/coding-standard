# Skill: Create GitHub Issue

Create a new GitHub issue for this repository.

## Steps

1. Ask the user for the following if not already provided in the prompt:
   - **Title**: A short, clear one-line description of the issue
   - **Body**: A detailed description (what is the problem, what is the expected behaviour, any relevant sniff names or file paths)
   - **Labels** (optional): e.g. `bug`, `enhancement`, `sniff`, `documentation`

2. Display a preview of the issue to the user before creating it.

3. Run the following command to create the issue:

```bash
gh issue create \
  --title "<title>" \
  --body "<body>" \
  --label "<labels>"
```

If no labels are provided, omit the `--label` flag.

4. Output the URL of the created issue.

## Label conventions for this repo

| Label | Use for |
|-------|---------|
| `sniff` | Adding, removing, or changing a sniff decision |
| `bug` | A sniff is misconfigured or producing false positives |
| `enhancement` | Improving the ruleset or documentation |
| `documentation` | Changes to README, CLAUDE.md, or sniffs-decision.md only |

## Example

User: "Create an issue to add the Complexity.Cognitive sniff"

```bash
gh issue create \
  --title "Add SlevomatCodingStandard.Complexity.Cognitive sniff" \
  --body "The Cognitive Complexity sniff was excluded from the initial ruleset because it requires per-project threshold tuning. We should evaluate a sensible default threshold and add it to phpcs.xml.\n\nSniff: SlevomatCodingStandard.Complexity.Cognitive\nDefault threshold: 10\nReference: https://github.com/slevomat/coding-standard#slevomatcodingstandardcomplexitycognitive-" \
  --label "sniff,enhancement"
```
