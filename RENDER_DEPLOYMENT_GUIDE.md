# 🚀 ToolNova - Complete Render Deployment Guide

## Table of Contents
1. [Prerequisites](#prerequisites)
2. [Render Setup Steps](#render-setup-steps)
3. [Environment Variables](#environment-variables)
4. [Pre-Deployment Checklist](#pre-deployment-checklist)
5. [Deploying to Render](#deploying-to-render)
6. [Debugging 500 Errors](#debugging-500-errors)
7. [Common Issues & Solutions](#common-issues--solutions)
8. [Production Best Practices](#production-best-practices)

---

## Prerequisites

Before deploying, ensure you have:

✅ A Render account (https://render.com) - Free tier available  
✅ Your code pushed to GitHub/GitLab  
✅ Docker installed locally for testing (optional but recommended)  
✅ A terminal/command prompt ready

---

## Render Setup Steps

### Step 1: Create a New Web Service on Render

1. Go to https://dashboard.render.com
2. Click **"New +"** → **"Web Service"**
3. Connect your GitHub/GitLab repository
4. Select the **ToolNova** repository
5. Fill in these details:

| Field | Value | Notes |
|-------|-------|-------|
| **Name** | `toolnova` | Can be anything unique |
| **Environment** | `Docker` | Must be Docker |
| **Region** | Choose closest to users | Free tier: limited regions |
| **Branch** | `main` | Or your deployment branch |

6. Click **"Create Web Service"**

---

### Step 2: Configure Environment Variables

After creating the service, go to **Settings** → **Environment**

#### Generate APP_KEY First (Do this locally):

```bash
cd c:\projects\toolnova
php artisan key:generate
```

Copy the output (starts with `base64:...`). You'll need this below.

#### Add Environment Variables:

Create each variable by clicking **"Add Environment Variable"**:

| Key | Value | Required |
|-----|-------|----------|
| `APP_NAME` | `ToolNova` | ✅ |
| `APP_ENV` | `production` | ✅ |
| `APP_KEY` | `base64:YOUR_KEY_HERE` | ✅ **Copy from artisan key:generate** |
| `APP_DEBUG` | `false` | ✅ |
| `APP_URL` | `https://your-app-name.onrender.com` | ✅ |
| `DB_CONNECTION` | `sqlite` | ✅ |
| `SESSION_DRIVER` | `file` | ✅ |
| `CACHE_STORE` | `file` | ✅ |
| `LOG_LEVEL` | `error` | ⚠️ Change to `debug` if troubleshooting |
| `QUEUE_CONNECTION` | `sync` | ✅ |

---

### Step 3: Configure Build & Deploy

Still in **Settings**:

#### Build Command:
```
npm install && npm run build && composer install --no-dev
```

#### Start Command:
```
/entrypoint.sh supervisord -c /etc/supervisor/conf.d/supervisord.conf
```

#### Plan (for free tier):
- Select **"Free"** plan
- Note: Free tier has 750 hours/month (about 31 days)

---

## Environment Variables

### Critical Variables Explained:

```
APP_KEY=base64:xxx...
    → Encryption key for sessions, passwords, etc.
    → Generate locally with: php artisan key:generate
    → NEVER commit to git, always use environment variables

APP_ENV=production
    → Tells Laravel this is production
    → Disables debug info that could leak security data

APP_DEBUG=false
    → MUST be false in production
    → Never show detailed error pages to users

DB_CONNECTION=sqlite
    → Uses SQLite database (file-based)
    → Stored at /app/database/database.sqlite
    → Works great for free tier (no external DB needed)

SESSION_DRIVER=file
    → Stores sessions in files (not database)
    → Works with SQLite without extra setup

CACHE_STORE=file
    → Stores cache in files (not Redis/Memcached)
    → Good for single-server deployments
```

---

## Pre-Deployment Checklist

Before pushing to Render, verify:

### Code Quality
- [ ] All database migrations are in `database/migrations/`
- [ ] No hardcoded credentials in config files
- [ ] `.env.example` is updated with all required variables
- [ ] `.env` is in `.gitignore` (don't commit it!)
- [ ] `composer.lock` is committed for consistent dependencies
- [ ] `package-lock.json` is committed

### Laravel Configuration
- [ ] Migrations exist for all tables
- [ ] Seeders defined (if needed for initial data)
- [ ] Routes defined in `routes/web.php`
- [ ] Controllers properly namespaced
- [ ] Models in `app/Models/`

### Frontend Build
- [ ] `npm run build` works locally without errors
- [ ] Tailwind CSS builds properly
- [ ] Alpine.js scripts work
- [ ] Static assets are in `public/` (images, fonts, etc.)

### Docker Configuration
- [ ] `Dockerfile` is in project root
- [ ] `.dockerignore` is configured
- [ ] `docker/` folder contains:
  - [ ] `entrypoint.sh`
  - [ ] `nginx.conf`
  - [ ] `default.conf`
  - [ ] `supervisord.conf`
- [ ] All files have correct line endings (LF, not CRLF on Windows)

### Database
- [ ] At least one migration exists
- [ ] No database connections to external MySQL/PostgreSQL
- [ ] SQLite is the default connection in `config/database.php`

### Storage & Cache
- [ ] `storage/` and `bootstrap/cache/` are writable
- [ ] No dependencies on external caching (Redis, Memcached)
- [ ] Session driver is `file` or `database`

---

## Deploying to Render

### Step 1: Prepare Your Code

```bash
# Make sure everything is committed
git status

# Push to your main branch
git add .
git commit -m "Prepare for Render deployment"
git push origin main
```

### Step 2: Monitor Deployment

1. Go to your Render service dashboard
2. You'll see "Building..." status
3. Click on "Deploy" → view build logs
4. This takes 5-10 minutes on first deployment

### Step 3: Check the Logs

After deployment, click **"Logs"** to see:

```
📝 ToolNova - Render Deployment Starting
🧹 Clearing application cache...
⚙️  Caching configuration...
🗄️  Running database migrations...
🔐 Setting storage permissions...
✅ Application initialization complete!
[supervisor] started with pid 1
[php-fpm] spawned: php-fpm (pid 47)
[nginx] spawned: nginx (pid 48)
```

### Step 4: Test Your App

```
https://your-app-name.onrender.com
```

If you see your homepage → **Deployment successful!** 🎉

---

## Debugging 500 Errors

### Check Logs Immediately

1. Go to Render Dashboard → Your Service
2. Click **"Logs"** tab
3. Look for error messages (red text)

### Common 500 Error Causes & Fixes:

#### 1. Missing APP_KEY
```
Error: No application encryption key has been specified
```
**Fix:** Generate and add APP_KEY to environment variables
```bash
php artisan key:generate
# Copy the output to APP_KEY variable in Render
```

#### 2. Missing Database Migrations
```
Error: SQLSTATE[HY000]: General error: no such table: users
```
**Fix:** Migrations didn't run. In Render:
- Go to **Settings** → **Environment**
- Change `LOG_LEVEL` from `error` to `debug`
- Redeploy to see what's happening

#### 3. Storage Permission Error
```
Error: failed to open stream: Permission denied
```
**Fix:** Already handled in Dockerfile, but verify:
- Lines in Dockerfile: `chmod -R 777 /app/storage`
- Lines in entrypoint.sh run on startup

#### 4. NPM Build Failed
```
Error: Command 'npm run build' failed during build
```
**Fix:** Check for missing dependencies:
```bash
# Locally test:
npm install
npm run build
```

#### 5. Composer Dependencies Missing
```
Error: Class not found
```
**Fix:** In Dockerfile build command, ensure:
```
composer install --no-dev --optimize-autoloader
```

### View Real-Time Logs

```bash
# SSH into Render container (if enabled):
# Or use Render's built-in logs
```

---

## Common Issues & Solutions

### Issue: "Failed to clear config cache"
**Solution:** This is just a warning, not critical. Continue deployment.

### Issue: "Database file not found"
**Solution:** Migrations should create it. Check migrations exist:
```bash
ls database/migrations/
```

### Issue: "CSS not loading, page looks broken"
**Solution:** Build stage may have failed:
1. Check build logs for `npm run build` errors
2. Verify Tailwind config exists: `tailwind.config.js`
3. Rebuild locally: `npm run build`

### Issue: "Timeout waiting for container to start"
**Solution:** 
- Increase memory: Render may need more than free tier provides
- Check if migrations are too slow
- Verify no infinite loops in config:cache

### Issue: Static files 404 errors
**Solution:** Ensure assets are built:
```bash
npm run build
# Commit public/build/ to git
git add public/build/
```

### Issue: "502 Bad Gateway"
**Solution:** 
- PHP-FPM may have crashed
- Check logs for segmentation faults
- Reduce memory usage:
  - Disable unnecessary Laravel features
  - Use file-based sessions (already done)

---

## Production Best Practices

### 1. Error Monitoring
Set up error tracking (Sentry recommended):
```bash
# Install Sentry
composer require sentry/sentry-laravel
php artisan sentry:publish

# Add to .env on Render:
SENTRY_LARAVEL_DSN=https://key@sentry.io/project
```

### 2. Health Check
Render will monitor `/health` endpoint (built into Dockerfile)

### 3. Database Backups
SQLite database needs manual backup:
- Download from Render → "Download" option
- Or set up automated backups (not free)

### 4. Secrets Management
Never commit `.env` files:
```bash
# Verify .env is in .gitignore
cat .gitignore | grep "^.env"
```

### 5. Regular Updates
Keep dependencies updated:
```bash
composer update --no-dev
npm update
```

### 6. Monitor Application
- Enable Render analytics
- Set up log alerts
- Monitor error rate

### 7. Disable Debug Mode in Production
```
APP_DEBUG=false
```

### 8. Rate Limiting
Add rate limiting to prevent abuse:
```php
// In routes/web.php
Route::middleware('throttle:60,1')->group(function () {
    // Your routes
});
```

---

## Redeploy After Changes

```bash
# Make changes locally
# Test thoroughly:
npm run build
php artisan serve

# Commit and push
git add .
git commit -m "Description of changes"
git push origin main

# Render automatically redeploys
```

---

## Support & Resources

- **Render Docs:** https://render.com/docs
- **Laravel Docs:** https://laravel.com/docs/12
- **Common Issues:** https://render.com/docs/troubleshooting
- **Render Discord:** Community support

---

## Next Steps After Successful Deployment

1. ✅ Test all tools work
2. ✅ Check database operations
3. ✅ Verify email sending (configure SMTP)
4. ✅ Set up custom domain
5. ✅ Enable auto-deploy on push
6. ✅ Set up monitoring
7. ✅ Plan backup strategy

---

**Questions?** Check the Render docs or reach out to support!
