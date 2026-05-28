# Cross-browser & device testing checklist

Use this checklist before staging UAT and production launch. Test on real devices where possible.

## Browsers (latest stable + one version back)

- [ ] Safari (macOS / iOS)
- [ ] Chrome (desktop & Android)
- [ ] Firefox (desktop)
- [ ] Edge (desktop)

## Pages to verify

- [ ] Home (`/`)
- [ ] About (`/about`)
- [ ] Services (`/services`) — accordion open/close
- [ ] News (`/news`) — listing and article detail
- [ ] Contact (`/contact`) — form validation and success message
- [ ] Footer newsletter signup
- [ ] Admin login (`/admin`)

## Responsive breakpoints

- [ ] Mobile (~375px width)
- [ ] Tablet (~768px)
- [ ] Desktop (1280px+)

## Accessibility spot checks

- [ ] Keyboard navigation through main nav and contact form
- [ ] Visible focus rings on links and buttons
- [ ] Skip link jumps to main content
- [ ] Form errors announced / visible

## Performance spot checks

- [ ] CSS/JS load (no 404 on `/build/` assets)
- [ ] Images lazy-load below the fold
- [ ] No layout shift on hero load

## Sign-off

| Tester | Date | Notes |
|--------|------|-------|
| | | |
