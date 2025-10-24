#!/bin/bash
# Git Hooks Installation Script
# Version: 1.0.0

set -e

# Colors
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m'

echo -e "${BLUE}════════════════════════════════════════${NC}"
echo -e "${BLUE}  Git Hooks Installation${NC}"
echo -e "${BLUE}════════════════════════════════════════${NC}"
echo ""

# Check if .git directory exists
if [ ! -d ".git" ]; then
    echo -e "${RED}❌ Error: Not a git repository${NC}"
    echo "Run this script from the project root."
    exit 1
fi

# Hooks to install
HOOKS=("pre-commit" "commit-msg" "pre-push")

# Installation directory
HOOKS_DIR=".git/hooks"
SOURCE_DIR=".claude/git-hooks"

# Backup existing hooks
echo "1. Backing up existing hooks..."
for hook in "${HOOKS[@]}"; do
    if [ -f "$HOOKS_DIR/$hook" ]; then
        BACKUP_FILE="$HOOKS_DIR/$hook.backup.$(date +%Y%m%d_%H%M%S)"
        cp "$HOOKS_DIR/$hook" "$BACKUP_FILE"
        echo -e "   ${YELLOW}⚠️  Backed up existing $hook to $BACKUP_FILE${NC}"
    fi
done
echo ""

# Install hooks
echo "2. Installing hooks..."
INSTALLED=0
for hook in "${HOOKS[@]}"; do
    SOURCE="$SOURCE_DIR/$hook"
    DEST="$HOOKS_DIR/$hook"

    if [ ! -f "$SOURCE" ]; then
        echo -e "   ${RED}❌ Source file not found: $SOURCE${NC}"
        continue
    fi

    # Copy hook
    cp "$SOURCE" "$DEST"

    # Make executable (Unix/Mac)
    if [[ "$OSTYPE" != "msys" && "$OSTYPE" != "win32" ]]; then
        chmod +x "$DEST"
    fi

    echo -e "   ${GREEN}✅ Installed: $hook${NC}"
    INSTALLED=$((INSTALLED + 1))
done
echo ""

# Summary
echo -e "${BLUE}════════════════════════════════════════${NC}"
if [ $INSTALLED -eq ${#HOOKS[@]} ]; then
    echo -e "${GREEN}✅ Successfully installed $INSTALLED hooks${NC}"
else
    echo -e "${YELLOW}⚠️  Installed $INSTALLED of ${#HOOKS[@]} hooks${NC}"
fi
echo -e "${BLUE}════════════════════════════════════════${NC}"
echo ""

# Configuration instructions
echo "Configuration (optional):"
echo ""
echo "Create .git/hooks/.env file with:"
echo "  HOOK_LEVEL=normal        # strict, normal, loose"
echo "  RUN_PHPSTAN=true         # Run static analysis"
echo "  RUN_PHPCS=true           # Run code style checks"
echo "  PHPSTAN_LEVEL=8          # PHPStan level (0-9)"
echo "  REQUIRE_TESTS=true       # Require tests in pre-push"
echo "  MIN_COVERAGE=70          # Minimum coverage %"
echo ""

# Test hook
echo "Testing pre-commit hook..."
if [ -x "$HOOKS_DIR/pre-commit" ]; then
    echo -e "${GREEN}✅ pre-commit is executable${NC}"
else
    if [[ "$OSTYPE" == "msys" || "$OSTYPE" == "win32" ]]; then
        echo -e "${YELLOW}⚠️  Windows detected - hooks will work via Git Bash${NC}"
    else
        echo -e "${RED}❌ pre-commit is not executable${NC}"
        echo "Run: chmod +x $HOOKS_DIR/pre-commit"
    fi
fi
echo ""

# Next steps
echo "Next steps:"
echo "  1. Make a test commit to verify hooks work"
echo "  2. Configure hook level if needed (.git/hooks/.env)"
echo "  3. Share with team: commit .claude/git-hooks/ directory"
echo ""

# Disable hooks option
echo "To temporarily disable hooks:"
echo "  touch .git/hooks/disabled"
echo ""
echo "To re-enable:"
echo "  rm .git/hooks/disabled"
echo ""

echo -e "${GREEN}Installation complete!${NC}"
