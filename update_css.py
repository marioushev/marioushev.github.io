import re

with open('assets/css/style-code.css', 'r') as f:
    css = f.read()

# 1. Hero H1 Size
css = re.sub(r'(\.intro-text h1\s*\{[^}]*font-size:\s*)clamp\([^)]+\)', r'\1clamp(4rem, 10vw, 8rem)', css)

# 2. Remove all grid borders and backgrounds
css = re.sub(r'(?:\n\s*)?border[^:]*:\s*[^;]+var\(--border[^;]+;', '', css)
css = re.sub(r'(?:\n\s*)?border[^:]*:\s*1px solid var\(--border-mid\);', '', css)

# Fix empty brackets that might have been caused if they only had border (unlikely but just in case)
# 3. Project grid updates
# Find .project-grid and replace grid-template-columns, gap, background, border
css = re.sub(r'(\.project-grid\s*\{)([^}]+)(\})',
             r'\1\n  display: grid;\n  grid-template-columns: 1fr;\n  gap: 120px;\n  width: 100%;\n  max-width: 1400px;\n\3', css)

# Overwrite dynamic project-grid columns to be 1 column or 2 column for large screens
css = re.sub(r'(\.project-grid:has[^}]+\{\s*grid-template-columns:\s*[^;]+;\s*\})', r'/* \1 */', css)

# 4. Remove project-item background and hover background
css = re.sub(r'(\.project-item\s*\{[^}]*background:\s*)var\(--bg\)', r'\1transparent', css)
css = re.sub(r'(\.project-item:hover\s*\{[^}]*background:\s*)var\(--surface\)', r'\1transparent', css)

# 5. Make project images massive and full color
css = re.sub(r'(\.project-item-img-box img\s*\{[^}]*filter:\s*)grayscale\([^)]+\)', r'\1none', css)
css = re.sub(r'(\.project-item:hover \.project-item-img-box img\s*\{[^}]*filter:\s*)grayscale\([^)]+\)', r'\1none', css)
css = re.sub(r'(\.project-item:hover \.project-item-img-box img\s*\{[^}]*transform:\s*)scale\([^)]+\)', r'\1scale(1.01)', css)

# 6. Service grid
css = re.sub(r'(\.services-grid\s*\{)([^}]+)(\})',
             r'\1\n  display: grid;\n  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));\n  gap: 60px;\n\3', css)
css = re.sub(r'(\.service-card\s*\{[^}]*background:\s*)var\(--bg\)', r'\1transparent', css)
css = re.sub(r'(\.service-card:hover\s*\{[^}]*background:\s*)var\(--surface\)', r'\1transparent', css)

# 7. Proof stats
css = re.sub(r'(\.proof-stats\s*\{)([^}]+)(\})',
             r'\1\n  display: grid;\n  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));\n  gap: 60px;\n\3', css)
css = re.sub(r'(\.proof-stat\s*\{[^}]*background:\s*)var\(--bg\)', r'\1transparent', css)

# 8. Remove the pseudo-elements for project item indexes
css = re.sub(r'(\.project-item::before\s*\{)', r'\1\n  display: none;', css)

with open('assets/css/style-code.css', 'w') as f:
    f.write(css)

print("CSS updated.")
