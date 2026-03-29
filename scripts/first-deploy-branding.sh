#!/bin/bash
# ============================================================
# 🚀 First Deployment Script — OKAMI Branding Site
# Run this ONCE on the VPS as the 'deploy' user
#
# Usage:
#   chmod +x first-deploy-branding.sh
#   ./first-deploy-branding.sh
# ============================================================

set -e

# ─── Variables ──────────────────────────────────────────────
APP_DIR="/var/www/okami_branding"
REPO_URL="https://github.com/AshDest/okami_website.git"  # ← CHANGE THIS
BRANCH="branding"
DOMAIN="okamisarl.org"
NGINX_CONF="nginx-okami-branding.conf"
PHP_VERSION="8.2"

# Colors for output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  🚀 OKAMI Branding — First Deployment      ${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""

# ─── Step 0: Configure passwordless sudo for deploy ─────────
echo -e "${YELLOW}🔐 Step 0: Configuring passwordless sudo for deploy user...${NC}"
if [ -f /etc/sudoers.d/deploy-okami ]; then
    echo "✅ Sudoers file already exists"
else
    echo "deploy ALL=(ALL) NOPASSWD: ALL" | sudo tee /etc/sudoers.d/deploy-okami > /dev/null
    sudo chmod 440 /etc/sudoers.d/deploy-okami
    sudo visudo -cf /etc/sudoers.d/deploy-okami
    echo "✅ Sudoers configured — deploy user can now sudo without password"
fi
echo ""

# ─── Step 1: Create project directory ───────────────────────
echo -e "${YELLOW}📂 Step 1: Creating project directory...${NC}"
if [ -d "$APP_DIR" ]; then
    echo -e "${RED}⚠️  Directory $APP_DIR already exists!${NC}"
    read -p "Delete and re-clone? (y/N): " confirm
    if [ "$confirm" = "y" ] || [ "$confirm" = "Y" ]; then
        sudo rm -rf "$APP_DIR"
    else
        echo "Aborting."
        exit 1
    fi
fi
sudo mkdir -p "$APP_DIR"
sudo chown deploy:deploy "$APP_DIR"
echo "✅ Directory created: $APP_DIR"
echo ""

# ─── Step 2: Clone the repository ──────────────────────────
echo -e "${YELLOW}📥 Step 2: Cloning repository (branch: $BRANCH)...${NC}"
git clone -b "$BRANCH" "$REPO_URL" "$APP_DIR"
cd "$APP_DIR"
echo "✅ Repository cloned"
echo ""

# ─── Step 3: Install Composer dependencies ──────────────────
echo -e "${YELLOW}📦 Step 3: Installing Composer dependencies...${NC}"
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
echo "✅ Composer dependencies installed"
echo ""

# ─── Step 4: Setup .env file ───────────────────────────────
echo -e "${YELLOW}⚙️  Step 4: Setting up .env file...${NC}"
if [ ! -f .env ]; then
    cp .env.example .env
    echo "✅ .env created from .env.example"
else
    echo "⚠️  .env already exists, skipping copy"
fi

# Generate application key
php artisan key:generate
echo "✅ Application key generated"
echo ""

# Remind user to edit .env
echo -e "${RED}⚠️  IMPORTANT: Edit the .env file now!${NC}"
echo "   nano $APP_DIR/.env"
echo ""
echo "   Set at minimum:"
echo "   - APP_NAME=OKAMI"
echo "   - APP_ENV=production"
echo "   - APP_DEBUG=false"
echo "   - APP_URL=https://okamisarl.org"
echo "   - DB_CONNECTION=sqlite"
echo "   - MAIL_* settings for email notifications"
echo ""
read -p "Press Enter when .env is configured (or press Enter to continue and edit later)..."
echo ""

# ─── Step 5: Create SQLite database ────────────────────────
echo -e "${YELLOW}🗃️  Step 5: Setting up database...${NC}"
touch "$APP_DIR/database/database.sqlite"
php artisan migrate --force
echo "✅ Database migrated"
echo ""

# ─── Step 6: Install Node.js dependencies & build ──────────
echo -e "${YELLOW}🔨 Step 6: Installing Node.js dependencies & building assets...${NC}"
npm ci
npm run build
echo "✅ Assets built"
echo ""

# ─── Step 7: Laravel cache ─────────────────────────────────
echo -e "${YELLOW}⚡ Step 7: Caching Laravel config, routes, views...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
echo "✅ Laravel cached"
echo ""

# ─── Step 8: Create storage link ───────────────────────────
echo -e "${YELLOW}🔗 Step 8: Creating storage symlink...${NC}"
php artisan storage:link
echo "✅ Storage linked"
echo ""

# ─── Step 9: Fix permissions ───────────────────────────────
echo -e "${YELLOW}🔑 Step 9: Fixing permissions...${NC}"
sudo chown -R www-data:www-data "$APP_DIR/storage"
sudo chown -R www-data:www-data "$APP_DIR/bootstrap/cache"
sudo chmod -R 775 "$APP_DIR/storage"
sudo chmod -R 775 "$APP_DIR/bootstrap/cache"
echo "✅ Permissions set"
echo ""

# ─── Step 10: Configure Nginx ──────────────────────────────
echo -e "${YELLOW}🌐 Step 10: Configuring Nginx...${NC}"

# Copy Nginx config
sudo cp "$APP_DIR/scripts/$NGINX_CONF" "/etc/nginx/sites-available/okami-branding"

# Enable site
sudo ln -sf /etc/nginx/sites-available/okami-branding /etc/nginx/sites-enabled/okami-branding

# Test Nginx config
echo "Testing Nginx configuration..."
sudo nginx -t

if [ $? -eq 0 ]; then
    sudo systemctl reload nginx
    echo "✅ Nginx configured and reloaded"
else
    echo -e "${RED}❌ Nginx configuration test failed! Fix the errors above.${NC}"
    exit 1
fi
echo ""

# ─── Step 11: SSL with Certbot ─────────────────────────────
echo -e "${YELLOW}🔒 Step 11: Setting up SSL with Certbot...${NC}"
echo "Running Certbot for $DOMAIN and www.$DOMAIN..."
echo ""

# First, temporarily allow HTTP for Certbot challenge
# The nginx config redirects everything to HTTPS which won't work without certs
# We need to temporarily use HTTP-only config
sudo bash -c "cat > /etc/nginx/sites-available/okami-branding << 'TMPEOF'
server {
    listen 80;
    listen [::]:80;
    server_name okamisarl.org www.okamisarl.org;

    root /var/www/okami_branding/public;
    index index.php index.html;

    client_max_body_size 50M;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
TMPEOF"

sudo nginx -t && sudo systemctl reload nginx

# Run Certbot
sudo certbot --nginx -d "$DOMAIN" -d "www.$DOMAIN" --non-interactive --agree-tos --redirect

if [ $? -eq 0 ]; then
    echo "✅ SSL certificate installed successfully"
else
    echo -e "${RED}⚠️  Certbot failed. You can run it manually later:${NC}"
    echo "   sudo certbot --nginx -d $DOMAIN -d www.$DOMAIN"
fi
echo ""

# ─── Step 12: Reload services ──────────────────────────────
echo -e "${YELLOW}🔄 Step 12: Final reload of services...${NC}"
sudo systemctl reload php${PHP_VERSION}-fpm
sudo systemctl reload nginx
echo "✅ Services reloaded"
echo ""

# ─── Done! ──────────────────────────────────────────────────
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  ✅ DEPLOYMENT COMPLETE!                    ${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""
echo "🌐 Your site should be available at:"
echo "   https://okamisarl.org"
echo "   https://www.okamisarl.org"
echo ""
echo "📋 Next steps:"
echo "   1. Edit .env if you haven't already: nano $APP_DIR/.env"
echo "   2. Configure mail settings in .env for contact notifications"
echo "   3. Push changes to the 'branding' branch — auto-deploy will handle the rest!"
echo ""
echo "📂 Useful paths:"
echo "   App:    $APP_DIR"
echo "   Logs:   $APP_DIR/storage/logs/laravel.log"
echo "   Nginx:  /var/log/nginx/okami_branding_*.log"
echo "   Config: /etc/nginx/sites-available/okami-branding"
echo ""

