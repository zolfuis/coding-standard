# Slevomat Coding Standard — Sniff Decision Log

All sniffs from the [Slevomat Coding Standard](https://github.com/slevomat/coding-standard#alphabetical-list-of-sniffs) have been reviewed. Each entry documents whether it was included in `phpcs.xml` and the reasoning.

Legend: ✅ Added | ❌ Skipped

---

## Arrays

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Arrays.AlphabeticallySortedByKeys` | ✅ Added | Consistent alphabetical key ordering aids readability and reduces merge conflicts |
| `Arrays.ArrayAccess` | ❌ Skipped | Too specific; not broadly applicable |
| `Arrays.DisallowImplicitArrayCreation` | ✅ Added | Prevents accidental implicit `$arr[] = $x` when the array was never initialized |
| `Arrays.DisallowPartiallyKeyed` | ❌ Skipped | Too strict; mixing keyed/unkeyed is sometimes intentional and readable |
| `Arrays.MultiLineArrayEndBracketPlacement` | ❌ Skipped | PSR-12 already handles closing bracket placement |
| `Arrays.SingleLineArrayWhitespace` | ✅ Added | Ensures consistent whitespace in `[1, 2, 3]` style arrays |
| `Arrays.TrailingArrayComma` | ✅ Added | Standard practice for cleaner diffs in multi-line arrays |

---

## Attributes

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Attributes.AttributeAndTargetSpacing` | ✅ Added | Enforces zero blank lines between an attribute and its target; consistent with project spacing conventions |
| `Attributes.AttributesOrder` | ✅ Added | Enforces alphabetical attribute ordering for consistency |
| `Attributes.DisallowAttributesJoining` | ✅ Added | Each attribute on its own `#[…]` line improves readability and diff clarity |
| `Attributes.DisallowMultipleAttributesPerLine` | ✅ Added | Keeps one attribute per line for clarity |
| `Attributes.RequireAttributeAfterDocComment` | ✅ Added | Attributes belong after the doc comment — consistent with PHP-standard attribute placement |

---

## Classes

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Classes.BackedEnumTypeSpacing` | ❌ Skipped | Minor; PSR-12 handles enum formatting sufficiently |
| `Classes.ClassConstantVisibility` | ✅ Added | Enforces explicit `public`/`protected`/`private` on constants — improves clarity |
| `Classes.ClassKeywordOrder` | ❌ Skipped | PSR-12 already enforces keyword order |
| `Classes.ClassLength` | ❌ Skipped | Arbitrary limit; class size should be determined by design, not a linter |
| `Classes.ClassMemberSpacing` | ✅ Added | Ensures exactly one blank line between class members |
| `Classes.ClassStructure` | ❌ Skipped | Too rigid; enforcing a fixed member order doesn't suit all architectures |
| `Classes.ConstantSpacing` | ❌ Skipped | Covered by `ClassMemberSpacing` |
| `Classes.DisallowConstructorPropertyPromotion` | ❌ Skipped | Constructor promotion is a useful PHP 8.0+ feature — should not be banned |
| `Classes.DisallowLateStaticBindingForConstants` | ❌ Skipped | Niche rule; late static binding for constants has valid uses |
| `Classes.DisallowMultiConstantDefinition` | ❌ Skipped | PSR-12 handles this |
| `Classes.DisallowMultiPropertyDefinition` | ❌ Skipped | PSR-12 handles this |
| `Classes.DisallowStringExpressionPropertyFetch` | ❌ Skipped | Niche use case |
| `Classes.EmptyLinesAroundClassBraces` | ✅ Added | Removes spurious blank lines after `{` and before `}` in class bodies |
| `Classes.EnumCaseSpacing` | ❌ Skipped | Minor; handled by `ClassMemberSpacing` |
| `Classes.ForbiddenPublicProperty` | ❌ Skipped | Too strict; public properties are valid in DTOs, value objects, etc. |
| `Classes.MethodSpacing` | ✅ Added | Enforces consistent spacing between methods |
| `Classes.ModernClassNameReference` | ❌ Skipped | Can introduce unexpected behavior in inheritance; evaluate per project |
| `Classes.ParentCallSpacing` | ❌ Skipped | Minor formatting detail |
| `Classes.PropertyDeclaration` | ✅ Added | Enforces one property per line and correct declaration format |
| `Classes.PropertySpacing` | ✅ Added | Ensures consistent blank lines between properties |
| `Classes.RequireAbstractOrFinal` | ❌ Skipped | Too opinionated; not all classes need to be sealed or abstract |
| `Classes.RequireConstructorPropertyPromotion` | ❌ Skipped | Too prescriptive — forces a style that isn't always clearer |
| `Classes.RequireMultiLineMethodSignature` | ❌ Skipped | Too opinionated on line breaks in signatures |
| `Classes.RequireSelfReference` | ❌ Skipped | Can conflict with late static binding patterns |
| `Classes.RequireSingleLineMethodSignature` | ❌ Skipped | Conflicts with `RequireMultiLineMethodSignature`; pick neither |
| `Classes.SuperfluousAbstractClassNaming` | ❌ Skipped | Naming conventions are project-specific |
| `Classes.SuperfluousErrorNaming` | ❌ Skipped | Naming conventions are project-specific |
| `Classes.SuperfluousExceptionNaming` | ❌ Skipped | Naming conventions are project-specific |
| `Classes.SuperfluousInterfaceNaming` | ❌ Skipped | Naming conventions are project-specific |
| `Classes.SuperfluousTraitNaming` | ❌ Skipped | Naming conventions are project-specific |
| `Classes.TraitUseDeclaration` | ❌ Skipped | Minor; `TraitUseSpacing` covers the important parts |
| `Classes.TraitUseOrder` | ❌ Skipped | Too opinionated on trait ordering |
| `Classes.TraitUseSpacing` | ✅ Added | Enforces correct blank lines around `use` declarations inside classes |
| `Classes.UselessLateStaticBinding` | ✅ Added | Detects `static::` when `self::` would suffice |

---

## Commenting

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Commenting.AnnotationName` | ❌ Skipped | Too specific; annotation naming varies by framework |
| `Commenting.DeprecatedAnnotationDeclaration` | ❌ Skipped | Minor; edge case |
| `Commenting.DisallowCommentAfterCode` | ❌ Skipped | Too strict; inline comments are valid for explaining complex logic |
| `Commenting.DisallowOneLinePropertyDocComment` | ❌ Skipped | Conflicts with `RequireOneLinePropertyDocComment` — not both |
| `Commenting.DocCommentSpacing` | ✅ Added | Enforces consistent blank lines and spacing inside doc blocks |
| `Commenting.EmptyComment` | ✅ Added | Removes pointless empty comment blocks |
| `Commenting.ForbiddenAnnotations` | ❌ Skipped | Project-specific; configured per use case |
| `Commenting.ForbiddenComments` | ❌ Skipped | Project-specific; configure per project needs |
| `Commenting.InlineDocCommentDeclaration` | ✅ Added | Enforces `/** @var Type $var */` format for inline declarations |
| `Commenting.RequireOneDocComment` | ❌ Skipped | Too strict; not every method needs a doc comment |
| `Commenting.RequireOneLineDocComment` | ❌ Skipped | Conflicts with multi-line doc comments that are legitimately needed |
| `Commenting.RequireOneLinePropertyDocComment` | ✅ Added | Simple properties should have concise one-line doc comments |
| `Commenting.ThrowsAnnotationsOrder` | ❌ Skipped | Minor; low impact |
| `Commenting.UselessFunctionDocComment` | ❌ Skipped | Opinionated; some teams require doc comments regardless |
| `Commenting.UselessInheritDocComment` | ✅ Added | `{@inheritDoc}` with no extra content is noise |

---

## Complexity

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Complexity.Cognitive` | ❌ Skipped | Useful but requires careful per-project threshold tuning; add manually when needed |

---

## Control Structures

| Sniff | Decision | Reason |
|-------|----------|--------|
| `ControlStructures.AssignmentInCondition` | ✅ Added | Prevents confusing `if ($x = foo())` patterns |
| `ControlStructures.BlockControlStructureSpacing` | ❌ Skipped | PSR-12 handles brace and spacing rules |
| `ControlStructures.DisallowContinueWithoutIntegerOperandInSwitch` | ❌ Skipped | Niche edge case |
| `ControlStructures.DisallowEmpty` | ✅ Added | Encourages explicit checks (`=== null`, `=== []`, `strlen() === 0`) over `empty()` |
| `ControlStructures.DisallowNullSafeObjectOperator` | ❌ Skipped | Null-safe operator (`?->`) is a valid PHP 8.0+ feature |
| `ControlStructures.DisallowShortTernaryOperator` | ❌ Skipped | Conflicts with `RequireShortTernaryOperator`; pick neither |
| `ControlStructures.DisallowTrailingMultiLineTernaryOperator` | ❌ Skipped | Too opinionated |
| `ControlStructures.DisallowYodaComparison` | ✅ Added | Natural-order comparisons (`$x === null`) are more readable |
| `ControlStructures.EarlyExit` | ✅ Added | Reduces nesting by encouraging guard clauses |
| `ControlStructures.JumpStatementsSpacing` | ❌ Skipped | Minor formatting detail |
| `ControlStructures.LanguageConstructWithParentheses` | ❌ Skipped | Too opinionated; `echo` vs `echo()` is a style choice |
| `ControlStructures.NewWithParentheses` | ✅ Added | `new Foo()` is clearer and consistent with method call style |
| `ControlStructures.NewWithoutParentheses` | ❌ Skipped | Conflicts with `NewWithParentheses` |
| `ControlStructures.RequireMultiLineCondition` | ❌ Skipped | Too opinionated; short conditions are fine on one line |
| `ControlStructures.RequireMultiLineTernaryOperator` | ❌ Skipped | Too opinionated |
| `ControlStructures.RequireNullCoalesceEqualOperator` | ✅ Added | Prefer `$x ??= $default` over `$x = $x ?? $default` |
| `ControlStructures.RequireNullCoalesceOperator` | ✅ Added | Prefer `$x ?? $default` over `isset($x) ? $x : $default` |
| `ControlStructures.RequireNullSafeObjectOperator` | ❌ Skipped | Too prescriptive; sometimes explicit null checks are clearer |
| `ControlStructures.RequireShortTernaryOperator` | ❌ Skipped | Conflicts with `DisallowShortTernaryOperator`; pick neither |
| `ControlStructures.RequireSingleLineCondition` | ❌ Skipped | Conflicts with `RequireMultiLineCondition`; pick neither |
| `ControlStructures.RequireTernaryOperator` | ❌ Skipped | Too opinionated; if/else is often clearer |
| `ControlStructures.RequireYodaComparison` | ❌ Skipped | Conflicts with `DisallowYodaComparison` — we chose natural order |
| `ControlStructures.UselessIfConditionWithReturn` | ✅ Added | `if (x) return true; return false;` → `return x` |
| `ControlStructures.UselessTernaryOperator` | ✅ Added | `$x ? true : false` → `(bool) $x` |

---

## Exceptions

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Exceptions.CatchExceptionsOrder` | ❌ Skipped | Minor; catch order is usually intentional |
| `Exceptions.DeadCatch` | ✅ Added | Catches that can never be reached are bugs |
| `Exceptions.DisallowNonCapturingCatch` | ❌ Skipped | Conflicts with `RequireNonCapturingCatch` |
| `Exceptions.ReferenceThrowableOnly` | ✅ Added | Catch `\Throwable` to cover both `\Exception` and `\Error` |
| `Exceptions.RequireNonCapturingCatch` | ❌ Skipped | Conflicts with `DisallowNonCapturingCatch`; pick neither |

---

## Files

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Files.FileLength` | ❌ Skipped | Arbitrary; file size is a design concern, not a lint concern |
| `Files.LineLength` | ❌ Skipped | Using `Generic.Files.LineLength` instead (120/150 limits) |
| `Files.TypeNameMatchesFileName` | ❌ Skipped | Handled at framework/autoloader level |

---

## Functions

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Functions.ArrowFunctionDeclaration` | ❌ Skipped | Minor; arrow function spacing is handled by PSR-12 |
| `Functions.DisallowArrowFunction` | ❌ Skipped | Arrow functions are a useful PHP 7.4+ feature |
| `Functions.DisallowEmptyFunction` | ❌ Skipped | Too strict; empty constructors, stubs, and no-op overrides are valid |
| `Functions.DisallowNamedArguments` | ❌ Skipped | Named arguments are a useful PHP 8.0+ feature |
| `Functions.DisallowTrailingCommaInCall` | ❌ Skipped | Conflicts with `RequireTrailingCommaInCall` |
| `Functions.DisallowTrailingCommaInClosureUse` | ❌ Skipped | Conflicts with `RequireTrailingCommaInClosureUse` |
| `Functions.DisallowTrailingCommaInDeclaration` | ❌ Skipped | Conflicts with `RequireTrailingCommaInDeclaration` |
| `Functions.FunctionLength` | ❌ Skipped | Arbitrary; function length is a design concern |
| `Functions.NamedArgumentSpacing` | ❌ Skipped | Minor; low impact |
| `Functions.RequireArrowFunction` | ❌ Skipped | Too prescriptive; closures are often clearer for multi-line callbacks |
| `Functions.RequireMultiLineCall` | ❌ Skipped | Too opinionated; short calls are fine on one line |
| `Functions.RequireSingleLineCall` | ❌ Skipped | Conflicts with `RequireMultiLineCall` |
| `Functions.RequireTrailingCommaInCall` | ✅ Added | Cleaner diffs when adding arguments to multi-line calls |
| `Functions.RequireTrailingCommaInClosureUse` | ❌ Skipped | Minor; `RequireTrailingCommaInCall` and `InDeclaration` cover the important cases |
| `Functions.RequireTrailingCommaInDeclaration` | ✅ Added | Cleaner diffs when adding parameters to multi-line declarations |
| `Functions.StaticClosure` | ✅ Added | Prevents unnecessary binding of `$this` in closures |
| `Functions.StrictCall` | ❌ Skipped | Too strict; enforcing strict mode on every call is impractical |
| `Functions.UnusedInheritedVariablePassedToClosure` | ❌ Skipped | Minor; edge case |
| `Functions.UnusedParameter` | ✅ Added | Unused parameters indicate dead code or interface misalignment |
| `Functions.UselessParameterDefaultValue` | ❌ Skipped | Minor; low impact |

---

## Namespaces

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Namespaces.AlphabeticallySortedUses` | ✅ Added | Consistent import ordering reduces merge conflicts |
| `Namespaces.DisallowGroupUse` | ✅ Added | Group imports (`use Foo\{Bar, Baz}`) reduce readability and searchability |
| `Namespaces.FullyQualifiedClassNameInAnnotation` | ❌ Skipped | Too verbose; imported names in annotations are fine |
| `Namespaces.FullyQualifiedExceptions` | ❌ Skipped | Too verbose; use imports instead |
| `Namespaces.FullyQualifiedGlobalConstants` | ❌ Skipped | Too verbose; import global constants |
| `Namespaces.FullyQualifiedGlobalFunctions` | ❌ Skipped | Too verbose; import global functions |
| `Namespaces.MultipleUsesPerLine` | ❌ Skipped | Covered by `DisallowGroupUse` |
| `Namespaces.NamespaceDeclaration` | ✅ Added | Enforces consistent namespace declaration format |
| `Namespaces.NamespaceSpacing` | ✅ Added | Enforces correct blank lines around namespace declaration |
| `Namespaces.ReferenceUsedNamesOnly` | ❌ Skipped | Too strict; requires importing every used class |
| `Namespaces.RequireOneNamespaceInFile` | ❌ Skipped | Too restrictive for generated files |
| `Namespaces.UnusedUses` | ✅ Added | Removes noise from unused imports |
| `Namespaces.UseDoesNotStartWithBackslash` | ✅ Added | `use \Foo` → `use Foo`; leading backslash is redundant |
| `Namespaces.UseFromSameNamespace` | ✅ Added | Importing from own namespace is unnecessary |
| `Namespaces.UseOnlyWhitelistedNamespaces` | ❌ Skipped | Project-specific; configure per project |
| `Namespaces.UseSpacing` | ✅ Added | Enforces blank lines before/after use block |
| `Namespaces.UselessAlias` | ✅ Added | `use Foo\Bar as Bar` → `use Foo\Bar` |

---

## Numbers

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Numbers.DisallowNumericLiteralSeparator` | ❌ Skipped | Conflicts with `RequireNumericLiteralSeparator` |
| `Numbers.RequireNumericLiteralSeparator` | ❌ Skipped | Too opinionated; `1000000` vs `1_000_000` is stylistic |

---

## Operators

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Operators.DisallowEqualOperators` | ✅ Added | `==`/`!=` have surprising coercion behaviour; `===`/`!==` are safer |
| `Operators.DisallowIncrementAndDecrementOperators` | ❌ Skipped | Too strict; `$i++` is standard and readable |
| `Operators.NegationOperatorSpacing` | ✅ Added | `!$foo` not `! $foo` |
| `Operators.RequireCombinedAssignmentOperator` | ✅ Added | `$x += 1` is cleaner than `$x = $x + 1` |
| `Operators.RequireOnlyStandaloneIncrementAndDecrementOperators` | ❌ Skipped | Minor; low impact |
| `Operators.SpreadOperatorSpacing` | ✅ Added | Enforces `...$args` without space |

---

## PHP

| Sniff | Decision | Reason |
|-------|----------|--------|
| `PHP.DisallowDirectMagicInvokeCall` | ❌ Skipped | Niche; `$obj->__invoke()` is unusual but has valid uses |
| `PHP.DisallowReference` | ❌ Skipped | Too strict; references have legitimate uses in some algorithms |
| `PHP.ForbiddenClasses` | ❌ Skipped | Project-specific configuration |
| `PHP.OptimizedFunctionsWithoutUnpacking` | ❌ Skipped | Micro-optimisation; not worth enforcing globally |
| `PHP.ReferenceSpacing` | ❌ Skipped | Minor; low impact |
| `PHP.RequireExplicitAssertion` | ❌ Skipped | Too strict; implicit truthy checks are idiomatic PHP |
| `PHP.RequireNowdoc` | ❌ Skipped | Opinionated; heredoc vs nowdoc depends on context |
| `PHP.ShortList` | ✅ Added | Prefer `[$a, $b] = ...` over `list($a, $b) = ...` |
| `PHP.TypeCast` | ✅ Added | Enforces `(int)` not `(integer)`, `(bool)` not `(boolean)` |
| `PHP.UselessParentheses` | ✅ Added | Removes `return (value)` and similar needless wrapping |
| `PHP.UselessSemicolon` | ✅ Added | Removes spurious `;` after closing braces |

---

## Strings

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Strings.DisallowVariableParsing` | ❌ Skipped | Too opinionated; `"Hello $name"` is concise and idiomatic |

---

## Type Hints

| Sniff | Decision | Reason |
|-------|----------|--------|
| `TypeHints.ClassConstantTypeHint` | ❌ Skipped | Requires PHP 8.3+; not broadly applicable yet |
| `TypeHints.DeclareStrictTypes` | ✅ Added | `declare(strict_types=1)` is a fundamental safety measure |
| `TypeHints.DisallowArrayTypeHintSyntax` | ❌ Skipped | `string[]` is readable; forcing `array` is regression |
| `TypeHints.DisallowMixedTypeHint` | ❌ Skipped | Too strict; `mixed` is sometimes the correct type |
| `TypeHints.DNFTypeHintFormat` | ❌ Skipped | Requires PHP 8.2+; not broadly applicable yet |
| `TypeHints.LongTypeHints` | ✅ Added | `int` not `integer`, `bool` not `boolean` |
| `TypeHints.NullTypeHintOnLastPosition` | ✅ Added | `int\|null` not `null\|int`; consistent ordering |
| `TypeHints.NullableTypeForNullDefaultValue` | ✅ Added | `?string` required when default is `null` |
| `TypeHints.ParameterTypeHint` | ✅ Added | All parameters must have type hints |
| `TypeHints.ParameterTypeHintSpacing` | ✅ Added | Enforces `string $foo` not `string  $foo` |
| `TypeHints.PropertyTypeHint` | ✅ Added | All properties must have type hints |
| `TypeHints.ReturnTypeHint` | ✅ Added | All functions/methods must declare return types |
| `TypeHints.ReturnTypeHintSpacing` | ✅ Added | Enforces `: string` spacing in return type declarations |
| `TypeHints.UnionTypeHintFormat` | ✅ Added | Enforces `int\|string` (no spaces), null last |
| `TypeHints.UselessConstantTypeHint` | ❌ Skipped | Minor; rarely encountered |

---

## Variables

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Variables.DisallowSuperGlobalVariable` | ❌ Skipped | Too strict; `$_SERVER`, `$_ENV` etc. are needed in entry points and middleware |
| `Variables.DisallowVariableVariable` | ❌ Skipped | Too strict for some framework patterns (e.g. dynamic property access) |
| `Variables.DuplicateAssignmentToVariable` | ✅ Added | Assigning then immediately overwriting a variable is a bug or dead code |
| `Variables.UnusedVariable` | ✅ Added | Unused variables indicate dead code |
| `Variables.UselessVariable` | ✅ Added | `$x = expr; return $x;` → `return expr;` |

---

## Whitespaces

| Sniff | Decision | Reason |
|-------|----------|--------|
| `Whitespaces.DuplicateSpaces` | ✅ Added | Multiple consecutive spaces (outside alignment) are always a mistake |

---

## Summary

| Category | Added | Skipped | Total |
|----------|-------|---------|-------|
| Arrays | 4 | 3 | 7 |
| Attributes | 5 | 0 | 5 |
| Classes | 8 | 26 | 34 |
| Commenting | 5 | 10 | 15 |
| Complexity | 0 | 1 | 1 |
| Control Structures | 9 | 15 | 24 |
| Exceptions | 2 | 3 | 5 |
| Files | 0 | 3 | 3 |
| Functions | 4 | 16 | 20 |
| Namespaces | 9 | 8 | 17 |
| Numbers | 0 | 2 | 2 |
| Operators | 4 | 2 | 6 |
| PHP | 4 | 7 | 11 |
| Strings | 0 | 1 | 1 |
| Type Hints | 10 | 5 | 15 |
| Variables | 3 | 2 | 5 |
| Whitespaces | 1 | 0 | 1 |
| **Total** | **68** | **104** | **172** |
