# 🎯 ToolNova Render Deployment - Quick Reference Card

## ⚡ 5-Minute Deployment

### Step 1: Build Frontend
```bash
cd c:\projects\toolnova
npm install && npm run build
```

### Step 2: Generate APP_KEY
```bash
php artisan key:generate
# Output: base64:XXXXX (copy this!)
```

### Step 3: Commit Code
```bash
git add .
git commit -m "Deploy to Render"
git push origin main
```

### Step 4: Render Setup
1. https://render.com → New Web Service
2. Connect GitHub → Select ToolNova
3. Name: `toolnova`
4. Environment: Docker
5. Create!

### Step 5: Add Variables
In Render Settings → Environment, add:
```
APP_NAME=ToolNova
APP_ENV=production
APP_KEY=base64:XXXXX (from Step 2)
APP_DEBUG=false
APP_URL=https://toolnova.onrender.com
DB_CONNECTION=sqlite
SESSION_DRIVER=file
CACHE_STORE=file
LOG_LEVEL=error
QUEUE_CONNECTION=sync
```

### Step 6: Build & Deploy
1. Settings → Build Command:
   ```
   npm install && npm run build && composer install --no-dev
   ```

2. Settings → Start Command:
   ```
   /entrypoint.sh supervisord -c /etc/supervisor/conf.d/supervisord.conf
   ```

3. Click Deploy → Wait 10 minutes → Check logs
4. Visit: https://toolnova.onrender.com

---

## 🔍 Troubleshooting Quick Map

| Error | Solution |
|-------|----------|
| **500 Error** | Check APP_KEY is set correctly |
| **No CSS/Styling** | Check `npm run build` worked locally |
| **Database Error** | Check migrations in logs |
| **Timeout** | First build is slow, wait 15 min |
| **502 Gateway** | PHP-FPM crashed, check logs |
| **404 Page Missing** | Check route exists in routes/web.php |
| **Permission Denied** | Already fixed in Dockerfile |

---

## 📋 Pre-Deployment Checklist (1 Minute)

- [ ] `npm run build` ✅
- [ ] `composer install` ✅
- [ ] All files committed ✅
- [ ] APP_KEY generated ✅
- [ ] Docker folder exists ✅
- [ ] Dockerfile in root ✅

---

## 🚀 Critical Environment Variables

```
APP_KEY          → From: php artisan key:generate
APP_ENV          → Always: production
APP_DEBUG        → Always: false
DB_CONNECTION    → Always: sqlite
SESSION_DRIVER   → Always: file
```

---

## 📊 Monitor These Metrics

```
Memory Usage    < 300MB (good)
CPU Usage       < 50%   (good)
Build Time      5-15 min (normal)
Error Logs      Should be empty
```

---

## 💻 Local Testing Commands

```bash
# Build frontend
npm run build

# Start server
php artisan serve

# Check migrations
php artisan migrate

# Generate key
php artisan key:generate

# Clear cache
php artisan config:cache
php artisan route:cache
```

---

## 🔗 Important Links

- Render Dashboard: https://dashboard.render.com
- Health Check: https://your-app.onrender.com/health
- Logs: Your Service → Logs tab
- Settings: Your Service → Settings tab

---

## 📁 Key Files Reference

| File | Purpose | Location |
|------|---------|----------|
| Dockerfile | Build instructions | Root |
| .dockerignore | Skip in build | Root |
| entrypoint.sh | Startup script | docker/ |
| nginx.conf | Web server config | docker/ |
| default.conf | App routing | docker/ |
| supervisord.conf | Process manager | docker/ |

---

## ⚠️ Common Mistakes to Avoid

❌ Forget to run `npm run build` locally  
❌ Don't commit `package-lock.json`  
❌ Hardcode APP_KEY in git  
❌ Set APP_DEBUG=true in production  
❌ Forget to set APP_KEY variable on Render  
❌ Use MySQL when SQLite is fine  
❌ Ignore build logs when it fails  

---

## ✅ Success Looks Like

```
Build: ✅ "Successfully pushed docker image"
Logs: ✅ "Application initialization complete!"
App: ✅ Loads at https://your-app.onrender.com
```

---

## 🎯 If Deploy Fails

1. **Check Build Logs** → Render Dashboard → Deploy
2. **Find Error Line** → Usually red text with "Error:"
3. **Fix Locally** → Make change and test
4. **Commit & Push** → git push origin main
5. **Render Auto-Redeploys** → Wait and check logs again

---

## 📞 Help Resources

- `RENDER_DEPLOYMENT_GUIDE.md` → Full guide
- `DEBUGGING_GUIDE.md` → Error solutions
- `DEPLOYMENT_CHECKLIST.md` → Complete checklist
- Render Docs → https://render.com/docs

---

**You've got this! 🚀**

Questions? Check the comprehensive guides or Render's documentation.
