# 🚀 Guide de Déploiement — OKAMI Branding Site

## Architecture

```
Local (ton PC)
    │
    ├── git push origin branding
    │
    ▼
GitHub (branche branding)
    │
    ├── GitHub Actions déclenché automatiquement
    │
    ▼
VPS Debian (102.223.210.91)
    │
    ├── SSH → pull → install → build → cache → reload
    │
    ▼
https://okamisarl.org ✅
```

---

## 📋 Prérequis

| Élément | Statut |
|---------|--------|
| VPS Debian avec IP 102.223.210.91 | ✅ |
| PHP 8.2 + Nginx + Node.js installés | ✅ |
| Certbot installé | ✅ |
| Utilisateur `deploy` configuré | ✅ |
| GitHub Secrets configurés | ✅ |

---

## Étape 1 : Configuration en local

### 1.1 — Vérifier la structure des fichiers

Assure-toi que ces fichiers existent dans ton projet :

```
.github/workflows/deploy-branding.yml   ← Workflow GitHub Actions
scripts/nginx-okami-branding.conf        ← Config Nginx
scripts/first-deploy-branding.sh         ← Script premier déploiement
scripts/sudoers-deploy                   ← Permissions sudo pour deploy
```

### 1.2 — Créer la branche branding et pousser

```bash
# Si tu n'es pas déjà sur la branche branding
git checkout -b branding

# Ajouter tous les fichiers
git add -A
git commit -m "🚀 Setup deployment pipeline for branding site"

# Pousser sur GitHub
git push -u origin branding
```

---

## Étape 2 : Configuration sur GitHub

### 2.1 — Vérifier les Secrets

Va dans **Settings → Secrets and variables → Actions** de ton repo.

Vérifie que ces secrets existent :

| Secret | Valeur |
|--------|--------|
| `VPS_HOST` | `102.223.210.91` |
| `VPS_USERNAME` | `deploy` |
| `VPS_SSH_KEY` | Clé SSH privée complète (commence par `-----BEGIN`) |
| `VPS_PORT` | `22` |

### 2.2 — Vérifier que le workflow est détecté

Après le push, va dans l'onglet **Actions** du repo. Tu devrais voir le workflow "🌐 Deploy Branding Site". Il ne se déclenchera que sur des push vers la branche `branding`.

---

## Étape 3 : Premier déploiement sur le VPS

### 3.1 — Se connecter au VPS

```bash
ssh deploy@102.223.210.91
```

### 3.2 — Configurer les permissions sudo pour l'utilisateur deploy

```bash
# Créer le fichier sudoers pour deploy
sudo tee /etc/sudoers.d/deploy-okami << 'EOF'
deploy ALL=(ALL) NOPASSWD: /usr/bin/chown -R www-data\:www-data /var/www/okami_branding/*
deploy ALL=(ALL) NOPASSWD: /usr/bin/chmod -R 775 /var/www/okami_branding/*
deploy ALL=(ALL) NOPASSWD: /bin/systemctl reload php8.2-fpm
deploy ALL=(ALL) NOPASSWD: /bin/systemctl reload nginx
deploy ALL=(ALL) NOPASSWD: /usr/sbin/nginx -t
deploy ALL=(ALL) NOPASSWD: /usr/bin/certbot *
deploy ALL=(ALL) NOPASSWD: /usr/bin/cp /var/www/okami_branding/scripts/* /etc/nginx/sites-available/*
deploy ALL=(ALL) NOPASSWD: /usr/bin/ln -sf /etc/nginx/sites-available/* /etc/nginx/sites-enabled/*
deploy ALL=(ALL) NOPASSWD: /usr/bin/mkdir -p /var/www/okami_branding
deploy ALL=(ALL) NOPASSWD: /usr/bin/bash -c *
deploy ALL=(ALL) NOPASSWD: /usr/bin/rm -rf /var/www/okami_branding
deploy ALL=(ALL) NOPASSWD: /usr/bin/tee *
EOF

sudo chmod 440 /etc/sudoers.d/deploy-okami
```

### 3.3 — Configurer la clé SSH GitHub (si pas déjà fait)

```bash
# Vérifier si une clé SSH existe
ls -la ~/.ssh/

# Si pas de clé, en générer une
ssh-keygen -t ed25519 -C "deploy@okamisarl.org"

# Afficher la clé publique
cat ~/.ssh/id_ed25519.pub
```

➡️ Copie la clé publique et ajoute-la dans **GitHub → Settings → SSH keys** (ou dans les Deploy Keys du repo).

### 3.4 — Tester la connexion GitHub

```bash
ssh -T git@github.com
# Devrait afficher : "Hi USERNAME! You've successfully authenticated..."
```

### 3.5 — Modifier le script avec l'URL de ton repo

```bash
# Avant d'exécuter le script, modifie l'URL du repo
# Remplace YOUR_GITHUB_USERNAME par ton vrai username GitHub
```

### 3.6 — Transférer et exécuter le script de premier déploiement

**Option A — Exécuter depuis local via SCP :**

```bash
# Depuis ton PC local
scp scripts/first-deploy-branding.sh deploy@102.223.210.91:/tmp/
ssh deploy@102.223.210.91 "chmod +x /tmp/first-deploy-branding.sh && /tmp/first-deploy-branding.sh"
```

**Option B — Faire le premier déploiement manuellement :**

```bash
# Sur le VPS, connecté en tant que deploy

# 1. Créer le répertoire
sudo mkdir -p /var/www/okami_branding
sudo chown deploy:deploy /var/www/okami_branding

# 2. Cloner le repo (remplace YOUR_GITHUB_USERNAME)
git clone -b branding git@github.com:YOUR_GITHUB_USERNAME/okami_website.git /var/www/okami_branding
cd /var/www/okami_branding

# 3. Installer les dépendances PHP
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# 4. Configurer .env
cp .env.example .env
php artisan key:generate
nano .env
# → Modifier : APP_ENV=production, APP_DEBUG=false, APP_URL=https://okamisarl.org
# → Configurer les paramètres MAIL_*

# 5. Base de données
touch database/database.sqlite
php artisan migrate --force

# 6. Installer Node.js et build
npm ci
npm run build

# 7. Cacher la config Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan storage:link

# 8. Permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

# 9. Nginx
sudo cp scripts/nginx-okami-branding.conf /etc/nginx/sites-available/okami-branding
sudo ln -sf /etc/nginx/sites-available/okami-branding /etc/nginx/sites-enabled/okami-branding

# Désactiver le site par défaut si nécessaire
# sudo rm /etc/nginx/sites-enabled/default

sudo nginx -t
sudo systemctl reload nginx

# 10. SSL
sudo certbot --nginx -d okamisarl.org -d www.okamisarl.org

# 11. Reload final
sudo systemctl reload php8.2-fpm
sudo systemctl reload nginx
```

### 3.7 — Configurer le .env de production

```bash
nano /var/www/okami_branding/.env
```

Valeurs essentielles :

```env
APP_NAME=OKAMI
APP_ENV=production
APP_DEBUG=false
APP_URL=https://okamisarl.org

DB_CONNECTION=sqlite
DB_DATABASE=/var/www/okami_branding/database/database.sqlite

MAIL_MAILER=smtp
MAIL_HOST=smtp.ton-provider.com
MAIL_PORT=587
MAIL_USERNAME=contact@okamisarl.org
MAIL_PASSWORD=ton_mot_de_passe
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contact@okamisarl.org
MAIL_FROM_NAME="OKAMI Sarl"
```

---

## Étape 4 : Vérification

### 4.1 — Tester le site

```bash
# Depuis le VPS
curl -I https://okamisarl.org
# Devrait retourner HTTP/2 200
```

Ouvre dans ton navigateur : https://okamisarl.org

### 4.2 — Vérifier SSL

```bash
# Vérifier le certificat
sudo certbot certificates
```

### 4.3 — Vérifier les logs en cas de problème

```bash
# Logs Laravel
tail -f /var/www/okami_branding/storage/logs/laravel.log

# Logs Nginx
sudo tail -f /var/log/nginx/okami_branding_error.log

# Logs PHP-FPM
sudo tail -f /var/log/php8.2-fpm.log
```

---

## Étape 5 : Déploiements automatiques (après le premier)

### Comment ça marche

```
1. Tu modifies du code en local
2. git add . && git commit -m "message"
3. git push origin branding
4. GitHub Actions se déclenche automatiquement
5. Le workflow se connecte au VPS via SSH
6. Il pull le code, installe, build, cache, reload
7. Le site est mis à jour en ~30-60 secondes ✅
```

### Suivre un déploiement

1. Va sur GitHub → onglet **Actions**
2. Clique sur le dernier run du workflow "🌐 Deploy Branding Site"
3. Clique sur le job **Deploy Branding** pour voir les logs en temps réel

### En cas d'échec du déploiement

1. Vérifie les logs dans GitHub Actions
2. Connecte-toi au VPS et vérifie :
   ```bash
   cd /var/www/okami_branding
   git status
   php artisan config:cache
   sudo nginx -t
   ```

---

## 📁 Fichiers créés

| Fichier | Rôle |
|---------|------|
| `.github/workflows/deploy-branding.yml` | Workflow CI/CD GitHub Actions |
| `scripts/nginx-okami-branding.conf` | Configuration Nginx production |
| `scripts/first-deploy-branding.sh` | Script premier déploiement (manuel) |
| `scripts/sudoers-deploy` | Permissions sudo pour l'utilisateur deploy |
| `DEPLOYMENT.md` | Ce guide |

---

## 🔧 Commandes utiles sur le VPS

```bash
# Redéployer manuellement (si GitHub Actions a un problème)
cd /var/www/okami_branding
git pull origin branding
composer install --no-dev --optimize-autoloader
npm ci && npm run build
php artisan config:cache && php artisan route:cache && php artisan view:cache
sudo chown -R www-data:www-data storage bootstrap/cache
sudo systemctl reload php8.2-fpm nginx

# Vider tous les caches Laravel
php artisan optimize:clear

# Voir l'état de Nginx
sudo systemctl status nginx

# Voir l'état de PHP-FPM
sudo systemctl status php8.2-fpm

# Renouveler le certificat SSL (auto via cron, mais au cas où)
sudo certbot renew --dry-run

# Voir l'espace disque
df -h
```

---

## ⚠️ Points d'attention

1. **Ne jamais mettre le .env dans Git** — il est dans .gitignore par défaut
2. **La base SQLite** doit être writable par www-data
3. **Certbot renouvelle automatiquement** les certificats via un cron/timer systemd
4. **Les assets Vite** sont compilés à chaque déploiement (npm run build)
5. **Si tu changes le .env sur le VPS**, relance `php artisan config:cache`

