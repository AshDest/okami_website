#!/bin/bash
# ============================================================
# 🌐 Setup Nginx + SSL for OKAMI Branding
# Run ONCE on the VPS as deploy user
#
# Usage:
#   ssh deploy@102.223.210.91
#   bash /var/www/okami_branding/scripts/setup-nginx-ssl.sh
# ============================================================

set -e

DOMAIN="okamisarl.org"
APP_DIR="/var/www/okami_branding"
NGINX_AVAILABLE="/etc/nginx/sites-available/okami-branding"
NGINX_ENABLED="/etc/nginx/sites-enabled/okami-branding"

GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m'

echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  🌐 OKAMI — Nginx + SSL Setup              ${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""

# ─── Step 1: Install HTTP-only config (needed for Certbot challenge) ────
echo -e "${YELLOW}📝 Step 1: Installing HTTP-only Nginx config...${NC}"

sudo tee "$NGINX_AVAILABLE" > /dev/null << 'EOF'
server {
    listen 80;
    listen [::]:80;
    server_name okamisarl.org www.okamisarl.org;

    root /var/www/okami_branding/public;
    index index.php index.html;

    client_max_body_size 50M;

    # Gzip
    gzip on;
    gzip_vary on;
    gzip_proxied any;
    gzip_comp_level 6;
    gzip_min_length 256;
    gzip_types text/plain text/css text/javascript application/javascript application/json application/xml image/svg+xml;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header X-XSS-Protection "1; mode=block" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;

    # Static assets
    location ~* \.(css|js|ico|gif|jpeg|jpg|png|webp|svg|woff|woff2|ttf|eot|otf)$ {
        expires 30d;
        add_header Cache-Control "public, immutable";
        access_log off;
        try_files $uri =404;
    }

    # Vite build assets
    location /build/ {
        expires 1y;
        add_header Cache-Control "public, immutable";
        access_log off;
        try_files $uri =404;
    }

    # Laravel
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # PHP-FPM
    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
        fastcgi_read_timeout 300;
    }

    # Deny dotfiles except .well-known
    location ~ /\.(?!well-known).* {
        deny all;
    }

    access_log /var/log/nginx/okami_branding_access.log;
    error_log  /var/log/nginx/okami_branding_error.log;
}
EOF

echo "✅ HTTP config written"

# ─── Step 2: Enable the site ───────────────────────────────
echo -e "${YELLOW}🔗 Step 2: Enabling site...${NC}"
sudo ln -sf "$NGINX_AVAILABLE" "$NGINX_ENABLED"

# Remove default site if it conflicts
if [ -f /etc/nginx/sites-enabled/default ]; then
    echo "  Removing default site..."
    sudo rm -f /etc/nginx/sites-enabled/default
fi

echo "✅ Site enabled"

# ─── Step 3: Test & reload Nginx ───────────────────────────
echo -e "${YELLOW}🔄 Step 3: Testing & reloading Nginx...${NC}"
sudo nginx -t
if [ $? -ne 0 ]; then
    echo -e "${RED}❌ Nginx config test failed! Fix errors above.${NC}"
    exit 1
fi
sudo systemctl reload nginx
echo "✅ Nginx reloaded"

# ─── Step 4: Test HTTP access ──────────────────────────────
echo -e "${YELLOW}🧪 Step 4: Testing HTTP access...${NC}"
HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" "http://$DOMAIN" 2>/dev/null || echo "000")
if [ "$HTTP_CODE" = "200" ]; then
    echo "✅ http://$DOMAIN → HTTP 200 OK"
elif [ "$HTTP_CODE" = "000" ]; then
    echo -e "${YELLOW}⚠️  Could not reach http://$DOMAIN (DNS might not be pointing here yet)${NC}"
    echo "   Make sure your DNS A record for $DOMAIN points to this server's IP"
    echo "   Continuing anyway..."
else
    echo -e "${YELLOW}⚠️  http://$DOMAIN returned HTTP $HTTP_CODE${NC}"
    echo "   Continuing anyway..."
fi
echo ""

# ─── Step 5: SSL with Certbot ──────────────────────────────
echo -e "${YELLOW}🔒 Step 5: Setting up SSL with Certbot...${NC}"
echo ""
echo "Running: certbot --nginx -d $DOMAIN -d www.$DOMAIN"
echo ""

sudo certbot --nginx -d "$DOMAIN" -d "www.$DOMAIN" --non-interactive --agree-tos --email contact@okamisarl.org --redirect

if [ $? -eq 0 ]; then
    echo ""
    echo "✅ SSL certificate installed!"
else
    echo ""
    echo -e "${RED}⚠️  Certbot failed. Possible causes:${NC}"
    echo "   - DNS not pointing to this server yet"
    echo "   - Port 80 blocked by firewall"
    echo ""
    echo "   You can retry manually later:"
    echo "   sudo certbot --nginx -d $DOMAIN -d www.$DOMAIN"
    echo ""
    echo "   To check DNS:"
    echo "   dig +short $DOMAIN"
    echo "   dig +short www.$DOMAIN"
fi

# ─── Step 6: Final reload ──────────────────────────────────
echo -e "${YELLOW}🔄 Step 6: Final reload...${NC}"
sudo systemctl reload php8.2-fpm
sudo systemctl reload nginx
echo "✅ Services reloaded"
echo ""

# ─── Done ───────────────────────────────────────────────────
echo -e "${GREEN}============================================${NC}"
echo -e "${GREEN}  ✅ SETUP COMPLETE!                         ${NC}"
echo -e "${GREEN}============================================${NC}"
echo ""
echo "🌐 Teste ton site :"
echo "   http://$DOMAIN"
echo "   https://$DOMAIN"
echo "   https://www.$DOMAIN"
echo ""

