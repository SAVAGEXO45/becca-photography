# BECCA PHOTOGRAPHY – Premium Editorial & Fine Art Photography Platform

A modern, high-end photography business platform and atelier designed for **BECCA PHOTOGRAPHY**. Crafted with an editorial fashion aesthetic, luxury typography, asymmetrical layouts, authentic human-centered storytelling, a complete client booking engine, and an administrator management console.

---

## Brand Identity & Aesthetic
- **Brand Name**: `BECCA PHOTOGRAPHY`
- **Tagline**: *"Every Moment Deserves to Be Remembered."*
- **Studio Coordinates**: The Foundry Studio, 14 Victoria Island Arts District, Lagos
- **Primary Contact**: `SAVAGEXO@GMAIL.COM` | `+234 812 345 6789`
- **Visual Direction**: Editorial luxury magazine aesthetic, generous white space, restrained warm tones (#0f1013 obsidian, #c5a880 warm gold, #faf9f6 linen), Cormorant Garamond serif headings paired with Plus Jakarta Sans body typography.

---

## 100% Authentic Client Photography Integration
All 10 photographs provided by the client have been organized, categorized, and embedded across the website without distortion, artificial cropping, or replacement:
1. **Aura in White** (`photo-01-aura-in-white.jpg`) – Studio hoodie editorial in warm studio light *(Hero showcase)*
2. **Monochrome Contours** (`photo-02-monochrome-contours.jpg`) – SAVAGE XO bucket hat & textured knit vest *(Fashion portfolio)*
3. **The Art of Detail** (`photo-03-fabric-and-form.jpg`) – Macro textile weave & cyan-blue typography *(Landscape detail)*
4. **Emerald Geometry** (`photo-04-emerald-geometry.jpg`) – Bespoke emerald shorts lookbook series *(Studio series)*
5. **Brutalist Serenity** (`photo-05-brutalist-serenity.jpg`) – Concrete architectural urban portrait *(Outdoor series)*
6. **Direct Perspective** (`photo-06-direct-perspective.jpg`) – Dynamic streetwear gesture *(Urban lifestyle)*
7. **Golden Hour Avenue** (`photo-07-avenue-portrait.jpg`) – Tree canopy daylight street portrait *(Outdoor portrait)*
8. **Framed Perspective** (`photo-08-framed-perspective.jpg`) – Foreground blur framing coral floral jersey *(Creative editorial)*
9. **Horizon of Form** (`photo-09-horizon-of-form.jpg`) – Wide architectural landscape *(Outdoor fashion)*
10. **The Focused Gaze** (`photo-10-the-focused-gaze.jpg`) – Hypnotic eye contact portraiture *(Portraiture)*

All images are persisted in both `storage/app/public/photos/` and `public/storage/photos/`.

---

## Key Features & Page Breakdown

### 1. Homepage (`/`)
- **Hero Section**: Editorial masthead, large photography display with interactive expand view, "Explore Portfolio" and "Book a Session" CTAs.
- **Featured Work**: Editorial grid highlighting client's photographs with category badges and lightbox trigger.
- **About Becca**: Artistic approach, gear details, and diptych photo arrangement.
- **Photography Services**: Transparent pricing cards (₦120,000 – ₦850,000) with deliverables and direct booking links.
- **Featured Portfolio Asymmetrical Layout**: Architectural pairing of vertical lookbook portraits and wide landscape compositions.
- **Client Testimonials**: Authentic feedback from creative directors, models, and private clients.
- **Contact & Booking CTA**: Direct invitation to begin collaboration.

### 2. Portfolio Archive (`/portfolio` & `/portfolio/{slug}`)
- **Masonry Layout**: True aspect-ratio masonry gallery preserving natural vertical and horizontal dimensions.
- **Category Filter Tabs**: All Works, Fashion Photography, Portrait Photography, Studio Photography, Outdoor Photography, Lifestyle Photography, Wedding Photography, Birthday Photography, Event Photography.
- **Full-Screen Lightbox**: Alpine.js powered modal with next/previous keyboard & click navigation, gear details, shoot location, and captions.
- **Single Work Spotlight**: Detailed metadata table (Client, Native Resolution, Aspect Ratio, Camera Gear, Archived Date) and related works.

### 3. About Page (`/about`)
- The story behind BECCA PHOTOGRAPHY, founder introduction, and core artistic pillars: *Authentic Human Presence*, *Mastery of Tone & Texture*, and *Enduring Editorial Pacing*.

### 4. Services Page (`/services` & `/services/{slug}`)
- Comprehensive package breakdowns for Portrait Sessions, Fashion Lookbooks, Studio Sessions, Outdoor Shoots, Wedding Coverage, Birthday Celebrations, and Event Coverage.
- 4-phase session journey timeline: Consultation, The Shoot, Proofing & Curation, and Fine Art Delivery.

### 5. Booking Engine (`/book`, `/booking-confirmation/{ref}`, `/track-booking`)
- Service package selector with live price calculation.
- Date picker and time slot selection.
- Client contact and photoshoot location fields.
- Additional creative requirements / moodboard textarea.
- Generates unique reference code (e.g. `BP-2026-X892`).
- Dedicated Client Tracker (`/track-booking`) to lookup booking status anytime.

### 6. Contact Page (`/contact`)
- Direct studio email: `SAVAGEXO@GMAIL.COM`
- Studio phone: `+234 812 345 6789`
- Studio address: The Foundry Studio, 14 Victoria Island Arts District, Lagos.
- Interactive contact form saving inquiries to the database.

### 7. Administrator Management Console (`/admin`)
- **Dashboard Overview**: Metrics, pending booking alerts, unread inquiries counter, quick actions.
- **Manage Bookings**: Status changes (`pending`, `confirmed`, `completed`, `cancelled`), studio internal notes, search, and delete.
- **Manage Photographs**: File upload with auto-aspect ratio calculation, category assignment, homepage hero toggle, and metadata editor.
- **Manage Categories**: Create, edit, and reorder portfolio categories.
- **Manage Services & Pricing**: Edit rates, deliverables, turnaround times, and package feature checklists.
- **Manage Testimonials**: Curate client reviews, star ratings, and project references.
- **Customer Inquiries**: Read messages, mark as read/unread, and record studio follow-up notes.
- **Studio Settings**: Update brand tagline, email (`SAVAGEXO@GMAIL.COM`), telephone, address, social media handles, and artist biography.

---

## Default Administrator Credentials
- **Sign In URL**: `/admin/login`
- **Email**: `admin@beccaphotography.com` or `savagexo@gmail.com`
- **Password**: `admin123`

---

## Quick Start & Local Execution

```bash
# 1. Navigate to the project directory
cd C:\Users\USER\.gemini\antigravity\scratch\becca-photography

# 2. Start the local Laravel development server
php artisan serve

# 3. Compile or watch frontend assets
npm run build
# or for live watch during development:
npm run dev

# 4. Run automated test suite
php artisan test
```
