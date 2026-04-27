# ✅ ToolNova Render Deployment - Pre-Flight Checklist

**Project:** ToolNova  
**Target Platform:** Render  
**Deployment Date:** [DATE]  
**Deployed By:** [YOUR NAME]

---

## 📋 Pre-Deployment Phase

### Code Repository
- [ ] All code committed to git
- [ ] No uncommitted changes: `git status` shows clean
- [ ] `.env` is in `.gitignore`
- [ ] `.gitignore` prevents committing sensitive files
- [ ] Branch is up to date with remote

### Dependencies
- [ ] `composer.lock` is committed (not in .gitignore)
- [ ] `package-lock.json` is committed (not in .gitignore)
- [ ] Local build succeeds: `npm run build`
- [ ] PHP dependencies install: `composer install`
- [ ] No deprecated package warnings

### Laravel Configuration
- [ ] `.env.example` updated with all required vars
- [ ] `.env` has all vars from `.env.example`
- [ ] `APP_KEY` is set (run: `php artisan key:generate`)
- [ ] No hardcoded secrets in config files
- [ ] `config/database.php` defaults to SQLite
- [ ] `config/cache.php` uses file driver
- [ ] `config/session.php` uses file driver

### Database Migrations
- [ ] At least one migration exists: `ls database/migrations/`
- [ ] All migration files have proper syntax
- [ ] Migrations tested locally: `php artisan migrate`
- [ ] Seeders exist (if initial data needed)
- [ ] Database schema documented

### Frontend Assets
- [ ] `npm run build` completes without errors
- [ ] `public/build/` directory created
- [ ] `public/build/manifest.json` exists
- [ ] Tailwind CSS compiles: check `public/build/assets/app-*.css`
- [ ] JavaScript bundle exists: check `public/build/assets/app-*.js`
- [ ] No broken image paths in views
- [ ] Font files properly referenced
- [ ] CDN links work (if used)

### Docker Files
- [ ] `Dockerfile` exists in project root
- [ ] `.dockerignore` exists
- [ ] `docker/entrypoint.sh` exists and is executable
- [ ] `docker/nginx.conf` exists
- [ ] `docker/default.conf` exists
- [ ] `docker/supervisord.conf` exists
- [ ] Files have Unix line endings (LF, not CRLF)

**Check line endings on Windows:**
```bash
# In Git Bash or WSL:
file Dockerfile
# Should show: Dockerfile: ASCII text
# NOT: Dockerfile: ASCII text, with CRLF line terminators
```

### File Permissions
- [ ] `storage/` directory writable locally
- [ ] `bootstrap/cache/` directory writable locally
- [ ] No 000 permissions on any Laravel directories

### Code Quality
- [ ] No `var_dump()` or `dd()` in production code
- [ ] No `exit()` or `die()` in routes
- [ ] No direct file system operations without error handling
- [ ] Error handling in models/controllers
- [ ] No infinite loops in config files

---

## 🔧 Render Configuration Phase

### Render Service Creation
- [ ] Service created on Render (type: Web Service)
- [ ] Dockerfile selected as build method
- [ ] Correct branch selected (usually `main`)
- [ ] Region selected (closest to users)

### Environment Variables Set
- [ ] `APP_NAME` = `ToolNova`
- [ ] `APP_ENV` = `production`
- [ ] `APP_KEY` = `base64:...` (from artisan key:generate)
- [ ] `APP_DEBUG` = `false`
- [ ] `APP_URL` = `https://your-render-domain.onrender.com`
- [ ] `DB_CONNECTION` = `sqlite`
- [ ] `SESSION_DRIVER` = `file`
- [ ] `CACHE_STORE` = `file`
- [ ] `LOG_LEVEL` = `error` (change to `debug` if troubleshooting)
- [ ] `QUEUE_CONNECTION` = `sync`
- [ ] No spaces around `=` in variable values

### Build Configuration
- [ ] **Build Command** set to:
  ```
  npm install && npm run build && composer install --no-dev
  ```
- [ ] **Start Command** set to:
  ```
  /entrypoint.sh supervisord -c /etc/supervisor/conf.d/supervisord.conf
  ```
- [ ] Build timeout is sufficient (usually auto-configured)

### Plan Selection
- [ ] **Free** plan selected (if eligible)
- [ ] Understand free tier limitations:
  - 750 hours per month (about 31 days continuous)
  - Spins down after 15 minutes of inactivity
  - 0.5 GB RAM
  - No persistence between deployments (except database)

---

## 🚀 Initial Deployment Phase

### Pre-Deployment Verification
- [ ] All files committed: `git status` is clean
- [ ] Latest version pushed: `git push origin main`
- [ ] Render service connected to correct repository
- [ ] Render webhook enabled for auto-deploy

### Deployment Execution
- [ ] Click **Deploy** in Render dashboard
- [ ] Monitor **Build Logs** tab
- [ ] Wait for "Successfully deployed" message
- [ ] First deployment takes 5-15 minutes

### Build Logs Review
- [ ] Build starts: `Building Docker image...`
- [ ] NPM dependencies install successfully
- [ ] Composer dependencies install successfully
- [ ] Build completes: `Successfully pushed docker image`
- [ ] No critical errors (warnings are usually OK)

### Deployment Logs Review
- [ ] Entrypoint script runs: `ToolNova - Render Deployment Starting`
- [ ] Config cache created: `Caching configuration...`
- [ ] Migrations run: `Running database migrations...`
- [ ] Services start: `php-fpm` and `nginx` spawned
- [ ] No error messages (warnings OK)

---

## ✨ Post-Deployment Testing Phase

### Access Application
- [ ] Visit `https://your-app-name.onrender.com`
- [ ] Page loads without 500 error
- [ ] Homepage content displays correctly
- [ ] Styling loads (Tailwind CSS applied)
- [ ] Layout looks correct on desktop

### Functionality Testing
- [ ] Home page renders correctly
- [ ] Tools page accessible: `/tools`
- [ ] All tool categories display
- [ ] Navigation works
- [ ] Links don't have 404 errors
- [ ] Static assets load (images, CSS, JS)

### Database Testing
- [ ] Database file created: `database/database.sqlite`
- [ ] Tables exist (check via migrations)
- [ ] Can read from database
- [ ] Can write to database (if applicable)

### Error Testing
- [ ] Access a non-existent route: `/nonexistent`
- [ ] Should show 404, NOT 500
- [ ] Check error logs for issues
- [ ] No blank pages or generic errors

### Performance Testing
- [ ] Page loads in < 3 seconds
- [ ] No timeout errors
- [ ] Assets load properly
- [ ] Database queries complete

### Security Testing
- [ ] No sensitive data in error messages
- [ ] `APP_DEBUG=false` (no stack traces to users)
- [ ] Security headers present: `X-Frame-Options`, etc.
- [ ] HTTPS enforced (Render provides free SSL)

---

## 🐛 Troubleshooting Phase (if issues found)

### If 500 Error Appears

1. [ ] Check logs in Render dashboard
2. [ ] Look for error message starting with `Error:`
3. [ ] Cross-reference with "Debugging 500 Errors" section in RENDER_DEPLOYMENT_GUIDE.md
4. [ ] Fix locally
5. [ ] Commit and push code
6. [ ] Render auto-redeploys

### If Build Fails

1. [ ] Check **Build Logs** for specific error
2. [ ] Common causes:
   - [ ] Composer dependency conflict
   - [ ] NPM build error (CSS/JS syntax)
   - [ ] Missing PHP extensions
3. [ ] Fix locally and test:
   ```bash
   npm run build
   composer install
   ```
4. [ ] Commit and push
5. [ ] Check build logs again

### If Deploy Hangs

1. [ ] Wait at least 10 minutes (first deploy is slow)
2. [ ] Check if process is actually running: `supervisord` should be running
3. [ ] If stuck after 15 minutes:
   - [ ] Cancel deployment
   - [ ] Check logs for errors
   - [ ] Fix and redeploy

### If Database Not Working

1. [ ] Verify `DB_CONNECTION=sqlite` in environment
2. [ ] Check migrations ran in logs
3. [ ] Verify database file exists
4. [ ] Check for permission errors in logs
5. [ ] Rerun migrations: May need to redeploy

---

## 📊 Monitoring Phase

### Set Up Monitoring
- [ ] Enable Render analytics
- [ ] Check CPU usage (should be < 50%)
- [ ] Check memory usage (should be < 300MB)
- [ ] Check error logs daily first week

### Health Check
- [ ] Render calls `/health` endpoint
- [ ] Should return 200 OK
- [ ] Check if this endpoint works

### Logging
- [ ] Monitor storage usage (SQLite file)
- [ ] Archive old logs if needed
- [ ] Set up log alerts (optional)

### Backups
- [ ] Database file location: `/app/database/database.sqlite`
- [ ] Plan backup strategy (manual or automated)
- [ ] Document backup process

---

## 🎯 Production Sign-Off

### Final Verification
- [ ] All core features work
- [ ] No 500 errors in first 24 hours
- [ ] Performance acceptable
- [ ] Database operations successful
- [ ] Logs show no critical errors

### Documentation
- [ ] Update README with deployment info
- [ ] Document environment variables
- [ ] Create runbook for common tasks
- [ ] Document backup procedure

### Team Communication
- [ ] Notify team of live deployment
- [ ] Share production URL
- [ ] Document how to access logs
- [ ] Create escalation procedure for issues

---

## 📝 Deployment Notes

```
Service Name: 
Deployment Date: 
Deployed By: 
Production URL: 
APP_KEY: 
Notes:
```

---

## ✅ Deployment Complete

- [ ] All checkboxes above are checked
- [ ] Application is running in production
- [ ] Team is notified
- [ ] Monitoring is active
- [ ] Backups are configured

**Deployment Status:** ✅ SUCCESS  
**Sign-Off Date:** ____________  
**Sign-Off By:** ____________

---

## 📱 Quick Reference: Common Commands After Deployment

```bash
# Clear and rebuild caches
php artisan config:clear && php artisan config:cache

# Run migrations (if needed)
php artisan migrate --force

# Create database tables
php artisan migrate --force

# Seed database (if seeders exist)
php artisan db:seed

# Check application status
curl https://your-app.onrender.com/health

# View logs in Render dashboard
# Settings → Logs
```

---

**This checklist must be completed before marking deployment as successful.**
