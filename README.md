# Evitenic Block CSS Gutenberg

Scoped responsive CSS editor for Gutenberg blocks.

## Features

- Scoped CSS per block
- Responsive breakpoints
- Live editor preview
- Fullscreen CSS editor
- Custom breakpoint management
- Regenerate CSS ID
- Automatic frontend rendering
- Automatic editor rendering
- Generated CSS file per page/post
- Optimized frontend performance

---

# Installation

## Install via WordPress Admin

1. Build plugin ZIP

```bash
npm run build:all
npm run zip
```

2. Open WordPress Admin

```txt
Plugins → Add New Plugin → Upload Plugin
```

3. Upload generated ZIP file

4. Activate plugin

---

## Install via FTP

Copy plugin folder into:

```txt
wp-content/plugins/
```

Example:

```txt
wp-content/plugins/evitenic-block-css-gutenberg
```

Then activate plugin from WordPress admin panel.

---

# Development

## Requirements

- Node.js 18+
- npm
- WordPress 6+
- PHP 8.0+

---

## Install Dependencies

```bash
npm install
```

---

## Development Mode

Watch editor assets:

```bash
npm run start
```

Watch admin settings assets:

```bash
npm run start:admin
```

Watch all assets:

```bash
npm run start:all
```

---

## Production Build

Build editor assets:

```bash
npm run build
```

Build admin assets:

```bash
npm run build:admin
```

Build all assets:

```bash
npm run build:all
```

---

## Build Plugin ZIP

Generate installable WordPress plugin ZIP:

```bash
npm run zip
```

Generated file:

```txt
evitenic-block-css-gutenberg.zip
```

---

# Usage

1. Open Gutenberg editor
2. Select any block
3. Open:

```txt
Block Settings → Evitenic Block CSS
```

4. Write CSS

Example:

```css
selector {
  background: red;
  color: white;
}
```

The `selector` keyword will automatically be replaced with a unique scoped class.

---

# Responsive Example

Desktop:

```css
selector {
  padding: 100px;
}
```

Mobile:

```css
selector {
  padding: 20px;
}
```

---

# Breakpoints

Custom responsive breakpoints can be managed from:

```txt
Settings → Evitenic Block CSS
```

You can:

- Add breakpoints
- Remove breakpoints
- Reorder breakpoints
- Change min/max width types
- Customize breakpoint values

---

# Regenerate CSS ID

Each block automatically receives a unique scoped CSS class.

Example:

```txt
evitenic-css-a1b2c3d4
```

If you duplicate blocks, reuse patterns, or copy sections between pages/templates, you can regenerate the CSS ID from:

```txt
Block Settings → Evitenic Block CSS → Regenerate ID
```

This will generate a new unique scoped class for the selected block.

---

# Generated CSS Files

CSS is automatically compiled into static generated CSS files per post/page.

Example:

```txt
uploads/evitenic-block-css/post-15.css
uploads/evitenic-block-css/post-24.css
```

This architecture improves frontend performance because CSS does not need to be compiled dynamically on every request.

Benefits:

- Faster frontend rendering
- Better browser caching
- No runtime block parsing on frontend
- Optimized CSS delivery

---

# Site Editor & Template Support

The plugin stores scoped classes directly inside native Gutenberg block attributes.

This means scoped classes continue to work correctly in:

- Posts
- Pages
- Patterns
- Synced Patterns
- Site Editor
- Template Editor
- Template Parts

You do not need to manually add classes or worry about missing scoped classes when using Full Site Editing (FSE).

---

# Notes

- CSS is automatically scoped per block
- CSS is automatically generated per page/post
- CSS is automatically rendered on frontend
- CSS is automatically rendered inside editor
- Frontend uses generated static CSS files for better performance
- Editor uses live runtime CSS injection for hot reload preview

---

# License

GPL v2 or later
