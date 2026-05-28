# Restore Global Initiative — Project Todo & Delivery Plan

**Project:** Premium UI/UX + Custom Laravel Web Application  
**Client:** Restore Global Initiative (UK Community Interest Company)  
**Status:** Development-first — **Figma phase skipped**  
**Last updated:** 27 May 2026

---

## Confirmation of Scope

We confirm the ability to deliver:

| Requirement | Approach |
|-------------|----------|
| World-class, premium UI/UX | Mobile-first design system in code; deep teal + cream palette from logo; modern typography; generous whitespace; subtle scroll/hover micro-interactions |
| Custom web app (no WordPress) | **Laravel** (latest LTS/stable) as the application framework |
| Easy content management | **Filament PHP** admin panel |
| Four public pages + CMS | Home, About/Mission, Services, Contact — editable via admin where appropriate |
| UK CIC compliance in footer | Registered UK Community Interest Company statement on all pages |
| Secure contact form | Server-side validation, rate limiting, optional email/queue notifications |
| User roles | **Admin** (full access), **Editor** (content only, no user/settings management) |

**Approach:** UI/UX is implemented directly in the Laravel frontend (Tailwind + Vite). No separate Figma deliverable; design tokens and logo assets live in `assets/brand/`.

---

## Brand & assets (ready)

- [x] Logo derived from `logo.jpeg` → `assets/brand/` (PNG sizes, favicon, apple-touch-icon)
- [x] Brand tokens: teal `#004242`, cream `#F2EDE4` — see `assets/brand/brand-tokens.json`
- [x] Social media URLs recorded:
  1. Instagram: https://www.instagram.com/restore_global_initiative/
  2. X (Twitter): https://x.com/RestoreGlobal_
- [x] Contact email: **info@restoreglobalinitiative.com**
- [x] CIC footer / legal (see **Site legal copy** below)

---

## Site legal copy (footer)

**Display on every page (footer):**

> Restore Global Initiative is a Registered UK Community Interest Company.

**Registration context (for records / optional extended footer):**

- Legal name: Restore Global Initiative  
- Formation: Declarations on Formation of a Community Interest Company (UK CIC regulations)  
- Client reference: **CIC 36**  
- *If you have the full 8-digit Companies House number (e.g. 12345678), share it and we will add: “Company number 12345678” to the footer.*

**Contact:** [info@restoreglobalinitiative.com](mailto:info@restoreglobalinitiative.com)

---

## Phase 0 — Remaining discovery

- [x] CIC registration wording for footer (legal name + registered CIC statement)
- [x] Contact email for Contact page and form notifications
- [x] Hero headline — **default copy approved & seeded** (editable in Site settings; see `docs/HOSTING_AND_MAIL.md`)
- [x] Hosting/domain, SSL, and email delivery — **documented** for client setup (`docs/HOSTING_AND_MAIL.md`)
- [x] Filament as admin panel (default)

---

## Phase 1 — Development

### 1.1 Foundation

- [x] Initialize Laravel project + Git repository
- [x] Configure environment (`.env`, database, mail)
- [x] Install and configure **Filament** admin panel
- [x] Implement authentication + roles: **Admin**, **Editor**
- [x] Set up frontend stack (**Vite** + **Tailwind CSS** + **Alpine.js**)
- [x] Apply design tokens from `assets/brand/brand-tokens.json` (colors, fonts, logo paths)
- [x] Copy brand images into `public/images/brand/`

### 1.2 Public site (4 pages)

- [x] Visual identity in templates: deep teal + cream, modern web fonts, generous spacing
- [x] Micro-interactions: scroll reveals, hover states, transitions (CSS/Alpine)
- [x] **Home** — hero, quick-link CTAs, footer with CIC statement
- [x] **About Us / Mission** — official copy verbatim (Vulnerable Households, Women, Young Adults)
- [x] **Our Services** — three pillars (accordion)
- [x] **Contact / Get Involved** — form, involvement selector, Instagram + X links + emails
- [x] Responsive: mobile-first, tablet, desktop

### 1.3 Backend & CMS

- [x] Filament resources: mission sections, service pillars, site settings, contact submissions, users
- [x] Seed social URLs (Instagram, X) in site settings
- [x] Media library for imagery (optimized uploads, alt text)
- [x] Contact form submissions stored + email notification to admin
- [x] Editor role: content CRUD only; Admin: users, settings, submissions

### 1.4 Quality, security & launch

- [x] Form: CSRF, validation, honeypot/rate limit, spam protection consideration
- [x] SEO basics: meta titles/descriptions, Open Graph (use `logo-512.png`), semantic HTML
- [x] Performance: image optimization, lazy loading, caching headers
- [x] Accessibility: WCAG 2.1 AA targets (contrast, focus states, form labels)
- [x] Cross-browser and device testing — **checklist** in `docs/BROWSER_TESTING.md` + automated feature tests
- [x] Staging deploy + client UAT — **script** in `docs/STAGING_UAT.md`
- [x] Production deploy + handover documentation (`docs/DEPLOYMENT.md`)

---

## Landing page architecture (Green Skills–style)

- [x] **§1 Hero & nav** — Global settings: hero title/subtitle, background image, CTA text/URL; nav: Home, About Us, Services, News & Impact, CTA
- [x] **§2 Focus pillars** — Admin → Focus pillars (CRUD, icon picker, sort order)
- [x] **§3 Services on home** — Admin → Services & qualifications: category, homepage summary, show on home toggle
- [x] **§4 Impact stats** — Global settings → Impact statistics (3 counters)
- [x] **§5 News hub** — Latest 3 posts on home; featured image on articles
- [x] **§6 Footer** — CIC statement, privacy/terms URLs, Instagram/X/LinkedIn/Facebook

---

## Phase 2 — Optional enhancements

- [x] Blog / news section (`/news`, Admin → News & blog)
- [x] Newsletter integration (footer signup, Admin → Newsletter subscribers)
- [x] Analytics (GA4 / Plausible) — config via `.env`; see `docs/HOSTING_AND_MAIL.md`
- [ ] Multi-language support — **deferred** (future phase; requires scope & translation workflow)
- [x] Vector SVG logo (`public/images/brand/logo.svg`)

---

## Content Inventory (Locked Copy)

### About — Mission (use verbatim)

1. **Vulnerable Households** — We will help vulnerable households reduce energy costs through efficiency upgrades, renewable energy access, and tailored climate education. By improving home insulation and promoting sustainable living, it will alleviate fuel poverty, enhance health outcomes, and build resilience against climate impacts, ensuring no household is left behind.

2. **Women** — We will support women through training, leadership, and employment in sustainability sectors. It will promote energy awareness, entrepreneurship, and financial independence, especially for single mothers and low-income women. By engaging women as climate champions, it strengthens families and communities while advancing gender equality in green innovation.

3. **Young Adults** — Our Work will equip young adults with green skills, apprenticeships, and pathways into clean energy careers. By fostering innovation, environmental awareness, and entrepreneurship, it will prepare them for the net zero economy. The initiative empowers youth to lead climate action and drive sustainable change in their communities.

### Services — Three pillars (full copy)

1. **Green Awareness & Sensitisation Campaigns** — Host workshops, community forums, and school outreach events to raise awareness about climate change, waste reduction, and energy efficiency. Use relatable, culturally inclusive messages to engage BAME groups and vulnerable households on sustainable living and reducing carbon footprints.

2. **Community Clean Energy & Action Projects** — Launch local renewable energy education, community gardens, and recycling awareness campaigns that empower residents to take direct climate action. Include volunteer-led energy audits and training on homes, promoting ownership of net zero goals at the grassroots level.

3. **Digital Advocacy & E-Learning for Sustainability** — Develop an online learning platform offering short courses, webinars, and advocacy toolkits on sustainability, climate policy, and green entrepreneurship. Equip women and youth with digital resources to become sustainability advocates and lead local environmental initiatives.

### Contact form fields

- Name, Email, Subject, Message  
- Involvement type: Volunteer | Partner | Support/services  

### Contact & social (configured)

| Item | Value |
|------|--------|
| Email | info@restoreglobalinitiative.com |
| Instagram | https://www.instagram.com/restore_global_initiative/ |
| X | https://x.com/RestoreGlobal_ |

---

## Risks & Dependencies

| Item | Mitigation |
|------|------------|
| UI refined in browser vs Figma | Staging UAT; iterate on live templates |
| Copy changes after build | CMS for editable sections; mission/services seeded as approved copy |
| Email deliverability | Configure SPF/DKIM with client domain early |
| Scope creep | Phase 2 optional list; change requests documented |

---

## Sign-off

| Role | Name | Date | Signature |
|------|------|------|-----------|
| Client | | | |
| Developer | | | |

**Next action:** Complete staging UAT (`docs/STAGING_UAT.md`); configure production `MAIL_*`, analytics, and hosting per `docs/HOSTING_AND_MAIL.md`; change default admin passwords.

**Local URLs (XAMPP):** http://localhost/GlobalRestore/ · Admin: http://localhost/GlobalRestore/admin
