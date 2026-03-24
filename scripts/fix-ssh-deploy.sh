#!/bin/bash
# ============================================================
# 🔧 SSH Diagnostic & Fix Script for GitHub Actions deployment
# Run this on the VPS as root or with sudo
#
# Usage:
#   ssh root@102.223.210.91
#   bash fix-ssh-deploy.sh
# ============================================================

set -e

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

DEPLOY_USER="deploy"
SSH_DIR="/home/$DEPLOY_USER/.ssh"
AUTH_KEYS="$SSH_DIR/authorized_keys"

echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  🔧 SSH Diagnostic for deploy user         ${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""

# ─── Check 1: Does deploy user exist? ──────────────────────
echo -e "${YELLOW}1. Checking if '$DEPLOY_USER' user exists...${NC}"
if id "$DEPLOY_USER" &>/dev/null; then
    echo -e "   ✅ User '$DEPLOY_USER' exists"
else
    echo -e "   ${RED}❌ User '$DEPLOY_USER' does NOT exist. Creating...${NC}"
    sudo adduser --disabled-password --gecos "" "$DEPLOY_USER"
    echo -e "   ✅ User created"
fi
echo ""

# ─── Check 2: SSH directory ────────────────────────────────
echo -e "${YELLOW}2. Checking .ssh directory...${NC}"
if [ -d "$SSH_DIR" ]; then
    echo -e "   ✅ $SSH_DIR exists"
else
    echo -e "   ${RED}❌ $SSH_DIR missing. Creating...${NC}"
    sudo mkdir -p "$SSH_DIR"
    echo -e "   ✅ Created"
fi

# Fix ownership & permissions
sudo chown -R $DEPLOY_USER:$DEPLOY_USER "$SSH_DIR"
sudo chmod 700 "$SSH_DIR"
echo -e "   ✅ Permissions: 700 on $SSH_DIR"
echo ""

# ─── Check 3: authorized_keys ──────────────────────────────
echo -e "${YELLOW}3. Checking authorized_keys...${NC}"
if [ -f "$AUTH_KEYS" ]; then
    KEY_COUNT=$(wc -l < "$AUTH_KEYS")
    echo -e "   ✅ $AUTH_KEYS exists ($KEY_COUNT key(s))"
    echo -e "   📋 Current keys:"
    cat "$AUTH_KEYS" | while read line; do
        echo "      $(echo $line | cut -c1-80)..."
    done
else
    echo -e "   ${RED}❌ $AUTH_KEYS does NOT exist${NC}"
    sudo touch "$AUTH_KEYS"
    echo -e "   ✅ Created empty file"
fi
sudo chown $DEPLOY_USER:$DEPLOY_USER "$AUTH_KEYS"
sudo chmod 600 "$AUTH_KEYS"
echo -e "   ✅ Permissions: 600 on authorized_keys"
echo ""

# ─── Check 4: SSHD config ──────────────────────────────────
echo -e "${YELLOW}4. Checking SSHD configuration...${NC}"

SSHD_CONFIG="/etc/ssh/sshd_config"

# Check PubkeyAuthentication
if grep -qE "^PubkeyAuthentication\s+yes" "$SSHD_CONFIG" 2>/dev/null; then
    echo -e "   ✅ PubkeyAuthentication is enabled"
elif grep -qE "^#?PubkeyAuthentication" "$SSHD_CONFIG" 2>/dev/null; then
    echo -e "   ${YELLOW}⚠️  PubkeyAuthentication found but may be commented out or set to no${NC}"
    echo -e "   Current: $(grep -E '^#?PubkeyAuthentication' $SSHD_CONFIG)"
else
    echo -e "   ${YELLOW}⚠️  PubkeyAuthentication not explicitly set (defaults to yes)${NC}"
fi

# Check AuthorizedKeysFile
if grep -qE "^AuthorizedKeysFile" "$SSHD_CONFIG" 2>/dev/null; then
    echo -e "   📋 AuthorizedKeysFile: $(grep -E '^AuthorizedKeysFile' $SSHD_CONFIG)"
else
    echo -e "   ✅ AuthorizedKeysFile uses default (.ssh/authorized_keys)"
fi

# Check if password auth is disabled (normal for deploy)
if grep -qE "^PasswordAuthentication\s+no" "$SSHD_CONFIG" 2>/dev/null; then
    echo -e "   ℹ️  PasswordAuthentication is disabled (key-only, which is correct)"
fi
echo ""

# ─── Check 5: Generate a new key pair ──────────────────────
echo -e "${YELLOW}5. Generating a FRESH SSH key pair for GitHub Actions...${NC}"
echo ""

TEMP_KEY="/tmp/deploy_github_actions"
rm -f "$TEMP_KEY" "$TEMP_KEY.pub"

ssh-keygen -t ed25519 -C "github-actions-deploy@okamisarl.org" -f "$TEMP_KEY" -N ""

echo ""
echo -e "${GREEN}✅ New key pair generated${NC}"
echo ""

# Add public key to authorized_keys
echo -e "${YELLOW}Adding public key to authorized_keys...${NC}"
PUBLIC_KEY=$(cat "$TEMP_KEY.pub")

# Check if key already exists
if grep -qF "$PUBLIC_KEY" "$AUTH_KEYS" 2>/dev/null; then
    echo -e "   ⚠️  Key already in authorized_keys"
else
    echo "$PUBLIC_KEY" | sudo tee -a "$AUTH_KEYS" > /dev/null
    echo -e "   ✅ Public key added to $AUTH_KEYS"
fi

# Fix permissions again
sudo chown $DEPLOY_USER:$DEPLOY_USER "$AUTH_KEYS"
sudo chmod 600 "$AUTH_KEYS"
echo ""

# ─── Display the private key ───────────────────────────────
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  📋 COPY THIS PRIVATE KEY TO GITHUB        ${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""
echo -e "${RED}Copy EVERYTHING below (including the BEGIN and END lines):${NC}"
echo ""
echo "─────────────── START COPYING HERE ───────────────"
cat "$TEMP_KEY"
echo "─────────────── STOP COPYING HERE ────────────────"
echo ""
echo -e "${YELLOW}Steps:${NC}"
echo "  1. Copy the entire private key above"
echo "  2. Go to GitHub → your repo → Settings → Secrets and variables → Actions"
echo "  3. Edit the secret 'VPS_SSH_KEY'"
echo "  4. Paste the key (make sure there's NO extra whitespace)"
echo "  5. Save"
echo "  6. Re-run the GitHub Actions workflow"
echo ""

# Clean up private key from /tmp
rm -f "$TEMP_KEY"
echo -e "   🗑️  Temporary private key deleted from /tmp"
echo ""

# ─── Check 6: Test SSH locally ─────────────────────────────
echo -e "${YELLOW}6. Verifying authorized_keys final state...${NC}"
echo -e "   Keys in authorized_keys:"
sudo cat "$AUTH_KEYS" | while read line; do
    KEY_TYPE=$(echo $line | awk '{print $1}')
    KEY_COMMENT=$(echo $line | awk '{print $3}')
    echo "      - [$KEY_TYPE] $KEY_COMMENT"
done
echo ""

# ─── Check 7: SELinux/AppArmor ─────────────────────────────
echo -e "${YELLOW}7. Checking security modules...${NC}"
if command -v getenforce &>/dev/null; then
    SELINUX=$(getenforce 2>/dev/null || echo "disabled")
    echo -e "   SELinux: $SELINUX"
    if [ "$SELINUX" = "Enforcing" ]; then
        echo -e "   ${YELLOW}⚠️  SELinux is enforcing. Run: restorecon -Rv /home/$DEPLOY_USER/.ssh/${NC}"
        sudo restorecon -Rv /home/$DEPLOY_USER/.ssh/ 2>/dev/null || true
    fi
else
    echo -e "   ✅ SELinux not installed"
fi
echo ""

# ─── Check 8: Home directory permissions ───────────────────
echo -e "${YELLOW}8. Checking home directory permissions...${NC}"
HOME_PERMS=$(stat -c '%a' /home/$DEPLOY_USER)
echo -e "   /home/$DEPLOY_USER permissions: $HOME_PERMS"
if [ "$HOME_PERMS" -gt 755 ]; then
    echo -e "   ${RED}⚠️  Home directory too permissive! Fixing...${NC}"
    sudo chmod 755 /home/$DEPLOY_USER
    echo -e "   ✅ Fixed to 755"
else
    echo -e "   ✅ OK"
fi
echo ""

# ─── Restart SSH ────────────────────────────────────────────
echo -e "${YELLOW}9. Restarting SSH daemon...${NC}"
sudo systemctl restart sshd
echo -e "   ✅ SSHD restarted"
echo ""

# ─── Summary ───────────────────────────────────────────────
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  ✅ DIAGNOSTIC COMPLETE                     ${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""
echo "Summary:"
echo "  ✅ deploy user exists"
echo "  ✅ .ssh directory: 700"
echo "  ✅ authorized_keys: 600"
echo "  ✅ Fresh ed25519 key pair generated"
echo "  ✅ Public key added to authorized_keys"
echo "  ✅ SSHD restarted"
echo ""
echo -e "${RED}👉 NEXT: Paste the private key into GitHub Secret 'VPS_SSH_KEY' and re-run the workflow${NC}"
echo ""

