# 🌐 Check Domain Availability with PHP and JS

A simple and educational project to check domain availability using raw PHP for backend and JavaScript for frontend interaction. It uses WHOIS queries directly via socket connections — no external APIs required.

> ⚠️ For learning purposes only. WHOIS servers may block repeated queries or change response formats.

---

## 🚀 Features

- Checks domain availability using WHOIS
- Pure PHP backend (no frameworks)
- JavaScript-based frontend
- Support for `.com`, `.net`, `.org`, `.info`
- Easily extendable

---

## 📦 Requirements

- PHP ≥ 7.4
- A web server (e.g. Apache, Nginx, or use `php -S`)
- Internet connection (to reach WHOIS servers)

---

## 🧪 Supported Extensions

| Extension | WHOIS Server |
|-----------|--------------|
| `.com`    | whois.crsnic.net |
| `.net`    | whois.crsnic.net |
| `.org`    | whois.publicinterestregistry.net |
| `.info`   | whois.afilias.net |

---

### 🖼️ Screenshots

#### 🔍 Search UI
![Search](/screenshots/base.png?raw=true "Search")

#### ✅ Available domain
![Available](/screenshots/ok.png?raw=true "Search ok")

#### ❌ Unavailable or invalid domain
![Unavailable](/screenshots/error.png?raw=true "Search error")