# 🏗️ ToolNova Render Deployment - Architecture Overview

## System Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                         RENDER.COM                              │
│                    (Free Tier Container)                        │
├─────────────────────────────────────────────────────────────────┤
│                                                                 │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │  DOCKER CONTAINER (port 10000)                          │  │
│  │                                                          │  │
│  │  ┌──────────────────────────────────────────────────┐   │  │
│  │  │ SUPERVISOR (Process Manager)                     │   │  │
│  │  │                                                  │   │  │
│  │  │  ├─ PHP-FPM (PHP 8.2)                           │   │  │
│  │  │  │  └─ Executes PHP code                        │   │  │
│  │  │  │  └─ Handles business logic                   │   │  │
│  │  │  │  └─ Manages database connections             │   │  │
│  │  │  │                                              │   │  │
│  │  │  └─ NGINX (Web Server)                          │   │  │
│  │  │     ├─ Receives HTTP requests                  │   │  │
│  │  │     ├─ Routes to PHP-FPM                       │   │  │
│  │  │     ├─ Serves static files                     │   │  │
│  │  │     └─ Manages SSL (free from Render)         │   │  │
│  │  │                                                  │   │  │
│  │  └──────────────────────────────────────────────────┘   │  │
│  │                                                          │  │
│  │  ┌──────────────────────────────────────────────────┐   │  │
│  │  │ /app (Application Files)                         │   │  │
│  │  │                                                  │   │  │
│  │  │  ├─ app/                    (PHP code)         │   │  │
│  │  │  ├─ routes/                 (Routing)         │   │  │
│  │  │  ├─ public/                 (Web root)        │   │  │
│  │  │  │  └─ build/               (Built assets)    │   │  │
│  │  │  ├─ resources/              (Source files)    │   │  │
│  │  │  ├─ storage/                (Writable)        │   │  │
│  │  │  ├─ bootstrap/cache/        (Writable)        │   │  │
│  │  │  └─ database/               (SQLite)          │   │  │
│  │  │     └─ database.sqlite      (Data!)           │   │  │
│  │  │                                                  │   │  │
│  │  └──────────────────────────────────────────────────┘   │  │
│  │                                                          │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                 │
└─────────────────────────────────────────────────────────────────┘
         ↑ HTTP/HTTPS (port 10000)
         │ (Render forwards to your domain)
         │
      https://your-app-name.onrender.com
```

---

## Request Flow Diagram

```
Browser Request
    │
    ├─ HTTPS Request
    │   (Render handles SSL)
    │
    ↓
┌─────────────────────┐
│   NGINX (Reverse    │  - Receives HTTP request
│   Proxy / Web       │  - Checks if static file
│   Server)           │  - If yes: serves directly
│                     │  - If no: forwards to PHP-FPM
└──────────┬──────────┘
           │ FastCGI Request
           ↓
┌─────────────────────┐
│   PHP-FPM           │  - Executes PHP code
│ (Application        │  - Loads Laravel framework
│  Runtime)           │  - Matches route
│                     │  - Runs controller
│                     │  - Queries database
│                     │  - Builds response
└──────────┬──────────┘
           │ Response
           ↓
┌─────────────────────┐
│   NGINX             │  - Receives PHP response
│ (Web Server)        │  - Adds headers
│                     │  - Compresses (gzip)
│                     │  - Sends to browser
└──────────┬──────────┘
           │ HTTPS Response
           ↓
       Browser
    (Renders page)
```

---

## Build Process (One-Time)

```
Your GitHub Repository
         │
         ├─ Source code (app/)
         ├─ Frontend (resources/)
         ├─ Config (config/)
         └─ Dockerfile ← Render reads this
         
Render builds:
         │
         ├─ Stage 1: Frontend Build
         │   ├─ npm install
         │   ├─ npm run build
         │   └─ Output: public/build/
         │
         └─ Stage 2: PHP Build
             ├─ Copy Stage 1 assets
             ├─ Install PHP + extensions
             ├─ composer install --no-dev
             ├─ Set permissions
             ├─ Configure services
             └─ Output: Docker image (~400MB)
             
Docker Image
         │
         └─ Uploaded to Render
             └─ Reused for deployments
```

---

## File Permissions Architecture

```
/app                           (755 - Read only to app)
├─ bootstrap/cache/            (777 - PHP-FPM writes here)
│  └─ For: Cached config
│
├─ storage/                    (777 - PHP-FPM writes here)
│  ├─ logs/                    (Session logs)
│  └─ framework/               (Cache, sessions)
│
├─ database/                   (777 - PHP-FPM writes here)
│  └─ database.sqlite          (SQLite database)
│
└─ public/                     (755 - Web server reads)
   └─ build/                   (Vite-built assets)
      ├─ assets/app-xxxx.css
      └─ assets/app-xxxx.js
```

---

## Configuration Caching Strategy

```
WITHOUT Caching (slow):
  Request → Read config files from disk
          → Parse .env file
          → Compile routes
          → Each request: repeated work
          
WITH Caching (fast):
  Initial Build:
    → php artisan config:cache
    → php artisan route:cache
    → Creates: bootstrap/cache/config.php
    → Creates: bootstrap/cache/routes.php
    
  Each Request:
    → Loads pre-compiled PHP
    → No disk I/O needed
    → ~10x faster
```

---

## Database Architecture

```
SQLite (File-based, no server needed)
│
├─ Location: /app/database/database.sqlite
├─ Size: Grows as data added
│
├─ Advantages:
│  ├─ ✅ No external database needed
│  ├─ ✅ Free tier compatible
│  ├─ ✅ Simple setup
│  ├─ ✅ Backups are just files
│  └─ ✅ Great for < 1GB data
│
├─ Limitations:
│  ├─ ⚠️ Not suitable for > 10GB
│  ├─ ⚠️ Limited concurrent writes
│  └─ ⚠️ No built-in replication
│
└─ Migrations:
   ├─ Run on deployment
   ├─ Create tables
   ├─ Track schema version
   └─ Reversible (rollback)
```

---

## Session & Cache Architecture

```
SESSION DRIVER: FILE
├─ Stores: /app/storage/framework/sessions/
├─ Format: One file per session
├─ Cleanup: Laravel auto-deletes old sessions
├─ Advantages:
│  ├─ ✅ No database needed
│  ├─ ✅ Fast
│  └─ ✅ Works with single container
└─ Use case: Perfect for Render free tier

CACHE STORE: FILE
├─ Stores: /app/storage/framework/cache/
├─ Format: Serialized PHP objects
├─ TTL: Automatic cleanup
├─ Advantages:
│  ├─ ✅ No Redis needed
│  ├─ ✅ Free
│  └─ ✅ Works well for tools
└─ Use case: Cache query results, computations
```

---

## Deployment Sequence

```
User Pushes Code
      │
      └─→ GitHub Webhook
             │
             └─→ Render receives push event
                  │
                  ├─ [1] Checkout code
                  │
                  ├─ [2] Read Dockerfile
                  │
                  ├─ [3] Build Docker Image
                  │    └─ npm install
                  │    └─ npm run build
                  │    └─ composer install
                  │    └─ Set permissions
                  │    └─ Configure services
                  │
                  ├─ [4] Start Container
                  │    └─ entrypoint.sh runs
                  │    └─ Clear/cache config
                  │    └─ Run migrations
                  │    └─ Set permissions
                  │
                  ├─ [5] Start Services
                  │    └─ supervisord starts
                  │    └─ PHP-FPM starts
                  │    └─ Nginx starts
                  │
                  ├─ [6] Health Check
                  │    └─ Render calls /health
                  │    └─ Gets OK response
                  │
                  └─→ ✅ LIVE!
                  
Nginx listens on :10000
Render forwards traffic
App available at your domain
```

---

## Multi-Stage Docker Build

```
Why two stages?

Stage 1: Node Build Environment (Node 22)
   ├─ Purpose: Compile frontend assets
   ├─ npm install (all packages)
   ├─ npm run build (Vite compilation)
   ├─ Output: public/build/
   └─ Size: ~800MB (heavy, lots of node_modules)
   
Stage 2: PHP Production Environment (PHP 8.2)
   ├─ Copy built assets from Stage 1
   ├─ Install only PHP runtime (no node_modules)
   ├─ composer install --no-dev (only needed packages)
   ├─ Final size: ~400MB (lean, optimized)
   └─ Output: Ready to run container
   
Result:
   ✅ Small final image (no unused dependencies)
   ✅ Fast startup (no compilation needed)
   ✅ Secure (no build tools in production)
   ✅ Efficient (only runtime included)
```

---

## Error Handling Flow

```
User visits app
      │
      ├─ No error
      │  └─→ App responds normally
      │     └─→ Logs: Access log only
      │
      └─ Error occurs
         ├─ Development (APP_DEBUG=true)
         │  └─→ Shows detailed error page
         │     └─→ Not for production!
         │
         └─ Production (APP_DEBUG=false)
            ├─ User sees: Generic error page
            ├─ Server logs: Full error details
            ├─ Logs location: /app/storage/logs/
            └─→ Never exposes: Stack traces, code paths
```

---

## Monitoring & Health

```
Render Monitoring
    │
    ├─ Every 30 seconds:
    │  └─ GET /health endpoint
    │     ├─ Status 200? ✅ App healthy
    │     └─ No response? ⚠️ Mark unhealthy
    │
    ├─ Memory monitoring
    │  ├─ < 300MB: ✅ Good
    │  ├─ 300-450MB: ⚠️ Warning
    │  └─ > 450MB: ❌ Out of memory
    │
    ├─ CPU monitoring
    │  ├─ < 50%: ✅ Good
    │  ├─ 50-80%: ⚠️ Warning
    │  └─ > 80%: ❌ Overloaded
    │
    └─ Crash detection
       ├─ If crash: Auto-restart container
       ├─ If persistent: Mark service as down
       └─ Notification: To dashboard
```

---

## Security Layers

```
Layer 1: Browser
  ├─ HTTPS enforced (Render free SSL)
  └─ Content-Security-Policy header

Layer 2: Nginx (Web Server)
  ├─ Hidden files blocked (.env, .git)
  ├─ Security headers added
  ├─ Request validation
  └─ Rate limiting (optional)

Layer 3: Laravel Application
  ├─ CSRF protection on forms
  ├─ SQL injection prevention
  ├─ XSS protection
  ├─ Auth middleware
  └─ Encryption for passwords/tokens

Layer 4: File System
  ├─ No write permissions for web server
  ├─ Storage writes by PHP-FPM only
  ├─ Config files not accessible via web
  └─ Database file protected
```

---

## Scaling Considerations (Future)

```
Current (Free Tier):
  ├─ 1 Container
  ├─ Single instance
  ├─ Spins down after 15 min inactivity
  └─ 0.5GB RAM, shared CPU

If you outgrow:
  ├─ Upgrade to Paid Tier
  │  ├─ Always on
  │  ├─ More RAM
  │  └─ Dedicated CPU
  │
  ├─ Add database
  │  ├─ Switch to PostgreSQL
  │  ├─ Handle more connections
  │  └─ Better scalability
  │
  ├─ Add Redis
  │  ├─ Cache layer
  │  ├─ Session store
  │  └─ Queue backend
  │
  └─ Add CDN
     ├─ CloudFlare
     ├─ Serve assets globally
     └─ Reduce load
```

---

## Data Flow Summary

```
User Input
    ↓
Browser
    ↓
HTTPS Request (encrypted)
    ↓
Render Proxy
    ↓
Nginx (Port 10000)
    ↓
PHP-FPM
    ↓
Laravel App
    ↓
Controllers/Models
    ↓
Database (SQLite)
    ↓
Data Retrieved
    ↓
Laravel Response
    ↓
PHP-FPM
    ↓
Nginx
    ↓
HTTPS Response (encrypted)
    ↓
Browser
    ↓
HTML Rendered + CSS/JS Applied
    ↓
User sees webpage
```

---

## Key Takeaway

Your ToolNova app follows this architecture:

```
Frontend Layer (Vite + Tailwind)
        │ Build time
        ↓
Static Assets (CSS, JS, images)
        │ Served by Nginx
        ↓
Backend Layer (Laravel + PHP)
        │ Request-response
        ↓
Database Layer (SQLite)
        │ Data persistence
        ↓
Complete Application
```

All running in a single Docker container on Render's infrastructure. Simple, efficient, and scalable when you need it!

---

**This architecture is production-ready and will serve ToolNova users reliably.**
