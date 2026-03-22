# Coding Standard

A PHP coding standard ruleset built on [PSR-12](https://www.php-fig.org/psr/psr-12/) and [Slevomat Coding Standard](https://github.com/slevomat/coding-standard). Targets **PHP 8.1+**.

---

## What's included

- **PSR-12** as the base standard
- **62 Slevomat sniffs** covering type hints, namespace hygiene, early exit patterns, null coalescing, strict types, trailing commas, and spacing consistency
- A full [sniff decision log](sniffs-decision.md) documenting every Slevomat sniff and whether it was included or skipped, with reasoning

---

## Requirements

- PHP 8.1+
- Composer

---

## Installation

Add to your project's `composer.json`:

```json
{
    "require-dev": {
        "zolfuis/coding-standard": "dev-main"
    },
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/zolfuis/coding-standard"
        }
    ]
}
```

Then install:

```bash
composer install
```

---

## Usage

### Run the linter

```bash
composer phpcs
```

Or directly:

```bash
vendor/bin/phpcs --standard=vendor/zolfuis/coding-standard/phpcs.xml src/
```

### Auto-fix violations

```bash
composer phpcbf
```

Or directly:

```bash
vendor/bin/phpcbf --standard=vendor/zolfuis/coding-standard/phpcs.xml src/
```

---

## Using this ruleset in your own `phpcs.xml`

Create a `phpcs.xml` in your project root and extend this standard:

```xml
<?xml version="1.0"?>
<ruleset name="MyProject">
    <description>My project coding standard</description>

    <!-- Extend the base standard -->
    <rule ref="vendor/zolfuis/coding-standard/phpcs.xml"/>

    <!-- Override line length for this project -->
    <rule ref="Generic.Files.LineLength">
        <properties>
            <property name="lineLimit" value="140"/>
            <property name="absoluteLineLimit" value="180"/>
        </properties>
    </rule>

    <!-- Exclude a sniff that doesn't fit -->
    <rule ref="SlevomatCodingStandard.Functions.UnusedParameter">
        <exclude-pattern>*/Handlers/*</exclude-pattern>
    </rule>

    <file>src</file>
    <file>tests</file>
    <exclude-pattern>*/vendor/*</exclude-pattern>
</ruleset>
```

---

## Sniff decisions

Every Slevomat sniff has been reviewed and documented in [`sniffs-decision.md`](sniffs-decision.md). Each entry explains why a sniff was included or excluded. If you disagree with a decision, override it in your project's own `phpcs.xml`.

---

## Development

To modify the ruleset:

1. Edit `phpcs.xml` to add, remove, or configure sniffs
2. Update `sniffs-decision.md` to document the reasoning
3. Use the available Claude skills: `/commit` and `/create-issue`
