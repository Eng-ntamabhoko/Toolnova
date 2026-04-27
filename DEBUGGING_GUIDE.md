# 🔍 ToolNova Render Deployment - Debugging Guide

## Quick Diagnosis Flowchart

```
❌ Application Error?
├─ Port 10000?
│  └─ Check Render's network configuration
├─ 500 Error?
│  ├─ Check APP_KEY is set
│  ├─ Check database exists
│  └─ Review logs for stack trace
├─ 404 Error?
│  ├─ Verify route exists
│  └─ Check routing configuration
├─ Timeout?
│  ├─ Migrations taking too long
│  └─ Render free tier resource limits
└─ Styling broken?
   ├─ npm run build failed
   └─ CSS not loading
```

---

## 🔗 Access Render Logs

### Web Dashboard
1. Go to https://dashboard.render.com
2. Select your service: `toolnova`
3. Click **"Logs"** tab
4. Real-time logs appear automatically
5. Can't see logs? Service may not be running

### Log Levels
- 🟢 **Green:** Normal operation
- 🟡 **Yellow/Orange:** Warnings (usually non-critical)
- 🔴 **Red:** Errors (investigate!)

---

## ❌ Common Errors & Solutions

### Error 1: No Application Encryption Key

```
RuntimeException: No application encryption key has been specified.
```

**Cause:** `APP_KEY` environment variable not set

**Solution:**

1. Generate locally:
```bash
php artisan key:generate
```

2. Copy output (format: `base64:xxx...`)

3. Add to Render:
   - Dashboard → Your Service → Settings
   - Environment → Add Variable
   - Key: `APP_KEY`
   - Value: Paste the key
   - Click Save

4. Redeploy:
   - Dashboard → Deploy → Manual Deploy

---

### Error 2: Database File Not Found

```
SQLSTATE[HY000]: General error: unable to open database file
```

**Cause:** Database migrations didn't run or SQLite file not created

**Solution:**

1. Check build logs for migration errors:
   ```
   Running database migrations...
   ```

2. If migrations skipped, manually trigger:
   - Render Settings → Change one environment variable
   - Redeploy (this usually triggers migrations again)

3. Verify in logs:
   ```
   Migrating: 2026_03_11_000001_create_tools_table
   Migrated: 2026_03_11_000001_create_tools_table
   ```

---

### Error 3: Permission Denied on Storage

```
failed to open stream: Permission denied at /app/storage/...
```

**Cause:** Storage directory not writable

**Solution:**

Already handled in Dockerfile, but verify:
1. In Dockerfile: `chmod -R 777 /app/storage`
2. In entrypoint.sh: `chmod -R 777 /app/storage`

If still failing:
- Manually set permissions in entrypoint:
```bash
docker/entrypoint.sh  # Add before supervisord starts
```

---

### Error 4: NPM Build Failed

```
Error: Failed to build CSS/JavaScript
...build exited with code 1
```

**Cause:** Frontend build error (Tailwind, Vite, etc.)

**Solution:**

1. Test locally:
```bash
npm install
npm run build
```

2. Check for errors in output

3. Common issues:
   - Missing `tailwind.config.js`
   - Wrong import syntax in CSS
   - Missing dependencies in `package.json`

4. Fix locally, commit, push to redeploy

---

### Error 5: Composer Dependency Conflict

```
Your requirements could not be resolved to an installable set of packages
```

**Cause:** PHP package incompatibility

**Solution:**

1. Test locally:
```bash
composer install
```

2. Check `composer.json` for:
   - Conflicting version constraints
   - Packages that don't support PHP 8.2

3. Update problematic packages:
```bash
composer update problematic/package
```

4. Commit `composer.lock`, push to redeploy

---

### Error 6: 502 Bad Gateway

```
502 Bad Gateway - The server is temporarily unavailable
```

**Cause:** PHP-FPM crashed or not running

**Solution:**

1. Check logs for crashes:
   - Look for `segfault` or `Segmentation fault`
   - Look for `out of memory` errors

2. If out of memory:
   - Reduce logging
   - Disable unnecessary features
   - Consider paid tier

3. Redeploy and monitor:
```
tail -f logs in Render dashboard
```

---

### Error 7: Timeout During Build

```
Build timed out after 30 minutes
```

**Cause:** Build taking too long (slow Render infrastructure)

**Solution:**

1. Optimize build:
   - Use `--no-dev` in composer: Already done
   - Minimize npm packages: Check `package.json`
   - Use `npm ci` instead of `npm install`: Already done

2. Increase timeout:
   - Not available on free tier

3. Break into smaller commits:
   - Deploy smaller changes more frequently

---

### Error 8: CSS/Images Not Loading

```
404 Not Found
public/build/assets/app-xxx.css
```

**Cause:** Frontend build didn't complete or assets not pushed

**Solution:**

1. Verify locally:
```bash
npm run build
ls public/build/manifest.json
```

2. Commit build artifacts:
```bash
git add public/build/
git commit -m "Build frontend assets"
git push origin main
```

3. Check Dockerfile:
   - `COPY --from=build-frontend /app/public/build ./public/build`
   - Should copy from build stage

4. Redeploy

---

### Error 9: "Class Not Found"

```
Class 'App\Models\User' not found
```

**Cause:** Composer autoload not updated

**Solution:**

1. Composer scripts ran:
   - Should see in logs: `Generating autoload files`

2. If missing, clear cache:
   - In entrypoint.sh or redeploy

3. Check model file exists:
```bash
ls app/Models/User.php
```

---

### Error 10: Session Data Lost

```
Sessions not persisting between requests
```

**Cause:** Wrong session driver or storage issues

**Solution:**

1. Verify `SESSION_DRIVER=file` is set:
   - Check Render environment variables
   - Logs should show: `Using 'file' session driver`

2. Check storage permissions:
   - Should be `chmod 777`

3. Redeploy with correct settings

---

## 🔧 Advanced Debugging

### Enable Debug Mode (Temporary!)

⚠️ **Warning:** Only for troubleshooting, disable after!

1. In Render Settings → Environment:
   - Change `LOG_LEVEL` from `error` to `debug`
   - Change `APP_DEBUG` from `false` to `true`

2. Redeploy

3. Errors now show full stack traces

4. Review logs, find issue

5. **Change back to:**
   - `LOG_LEVEL=error`
   - `APP_DEBUG=false`

6. Redeploy again

### Check Container Health

```bash
# In Render logs, look for health check:
HEALTHCHECK --interval=30s ...
```

- If health check passes: Container running
- If health check fails: Service issue

### Monitor Resource Usage

Render Dashboard → Your Service → "Metrics"

```
CPU Usage: Should be < 50% during normal operation
Memory: Should be < 400MB (free tier limit 512MB)
```

If consistently high:
- Reduce logging
- Optimize database queries
- Consider paid tier

### Check Database Status

```bash
# In logs, look for migration lines:
Migrating: 2026_03_11_000001_create_...
Migrated: 2026_03_11_000001_create_...

# If no migrations show:
- Migrations may not exist
- Database may already be migrated
- Check database/migrations/ folder
```

---

## 🧪 Manual Testing Steps

### Test 1: Can You Reach the App?

```bash
# From your computer terminal:
curl https://your-app.onrender.com

# Should return HTML content (your homepage)
# If error, check:
# - Domain name correct
# - App actually deployed
# - Render service running
```

### Test 2: Check Health Endpoint

```bash
curl https://your-app.onrender.com/health

# Should return: OK
# If 404, check nginx config
```

### Test 3: Check Static Files

```bash
# Open browser dev tools (F12)
# Network tab
# Reload page
# Check CSS file:
# Should see file named app-xxx.css
# Status should be 200, not 404
```

### Test 4: Check Server Errors

```bash
# In browser
# Right-click → Inspect → Console
# Look for red errors
# Check Network tab for failed requests
```

### Test 5: Database Test

```bash
# Create a test route temporarily:
Route::get('/test-db', function () {
    return \App\Models\User::count();
});

# Visit: https://your-app.onrender.com/test-db
# Should return a number, not error
```

---

## 📊 Log File Analysis

### Example Successful Deployment Log:

```
Starting service...
ToolNova - Render Deployment Starting
Generating APP_KEY...
Clearing application cache...
Caching configuration...
Running database migrations...
Migrating: 2026_03_11_000001_create_tools_table
Migrated: 2026_03_11_000001_create_tools_table
Setting storage permissions...
Application initialization complete!
[supervisord] started with pid 1
[php-fpm] spawned: php-fpm (pid 47)
[nginx] spawned: nginx (pid 48)
```

### What to Look For:

✅ **Good signs:**
- No errors (red text)
- Migrations show "Migrated: ..."
- Both php-fpm and nginx spawned
- No "failed" messages

❌ **Bad signs:**
- `Error:` text
- `Exception` in stack trace
- `failed` or `could not`
- Service exits/crashes

---

## 🚨 Emergency Fixes

### If App Completely Broken:

1. **Immediate:** Set to maintenance mode
   ```bash
   # Add to routes/web.php:
   if (app()->isDownForMaintenance()) {
       return response('Under maintenance', 503);
   }
   ```

2. **Rollback:** Deploy previous working version
   ```bash
   git revert HEAD
   git push origin main
   # Render auto-redeploys
   ```

3. **Escalate:** Contact Render support
   - Dashboard → Help → Support

### If Database Corrupted:

1. **Backup current database:**
   - Download from Render
   - Store safely

2. **Reset database:**
   - In Render, redeploy with fresh migrations
   - Database file will be recreated

3. **Restore from backup:**
   - If needed, manually migrate

---

## 📈 Performance Debugging

### Slow Page Loads?

1. Check PHP-FPM:
   - Not enough workers
   - Slow queries
   - Memory limit hit

2. Optimize locally:
   ```bash
   # Profile with Laravel Debugbar
   composer require barryvdh/laravel-debugbar --dev
   ```

3. Check database:
   - Query count
   - Slow queries
   - Missing indexes

### High Memory Usage?

1. Check logs for memory leaks
2. Reduce logging level
3. Disable unnecessary features
4. Optimize queries with `->select()` limits

---

## 🎯 Systematic Troubleshooting Process

1. **Identify the problem:**
   - Read error message carefully
   - Check timestamp in logs
   - Understand what was happening

2. **Search this guide:**
   - Look for matching error
   - Read solution
   - Understand root cause

3. **Implement fix:**
   - Make change locally
   - Test locally: `php artisan serve`
   - Commit change

4. **Deploy fix:**
   - Push to main branch
   - Monitor Render logs
   - Wait for successful deploy

5. **Verify fix:**
   - Test in production
   - Check logs for errors
   - Monitor for 24 hours

6. **Document:**
   - What was wrong
   - What was the fix
   - How to prevent next time

---

## 📞 When to Contact Support

Contact Render support if:

- [ ] Your deployment keeps timing out
- [ ] Services randomly crash
- [ ] Persistent 5xx errors with no obvious cause
- [ ] Memory limits being hit constantly
- [ ] Need to increase plan/resources

Contact Laravel/PHP community if:

- [ ] Laravel-specific errors
- [ ] PHP extension issues
- [ ] Composer dependency problems

---

## ✅ Post-Debugging Verification

After fixing an issue:

1. [ ] Check logs show no new errors
2. [ ] Test core functionality works
3. [ ] No 500 errors when accessing pages
4. [ ] Database operations working
5. [ ] Static files loading
6. [ ] Page loads in reasonable time
7. [ ] Redeploy one more time to confirm stable

---

**Still stuck?** Review logs line by line, or reach out to the developer community!
