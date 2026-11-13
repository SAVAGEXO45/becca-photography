<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Photo;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Users
        User::updateOrCreate(
            ['email' => 'admin@beccaphotography.com'],
            [
                'name' => 'Becca Admin',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'savagexo@gmail.com'],
            [
                'name' => 'Becca (Lead Photographer)',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        // 2. Categories
        $categoriesData = [
            [
                'name' => 'Fashion Photography',
                'slug' => 'fashion-photography',
                'description' => 'Editorial fashion campaigns, lookbooks, streetwear collections, and high-concept creative styling.',
                'order' => 1,
            ],
            [
                'name' => 'Portrait Photography',
                'slug' => 'portrait-photography',
                'description' => 'Intimate, expressive individual and personal branding portraits highlighting authentic character.',
                'order' => 2,
            ],
            [
                'name' => 'Studio Photography',
                'slug' => 'studio-photography',
                'description' => 'Controlled lighting, minimalist backdrops, and precision studio aesthetics.',
                'order' => 3,
            ],
            [
                'name' => 'Outdoor Photography',
                'slug' => 'outdoor-photography',
                'description' => 'Natural ambient light, architectural environments, and vivid urban streetscapes.',
                'order' => 4,
            ],
            [
                'name' => 'Lifestyle Photography',
                'slug' => 'lifestyle-photography',
                'description' => 'Candid motion, everyday luxury, modern subcultures, and organic storytelling.',
                'order' => 5,
            ],
            [
                'name' => 'Wedding Photography',
                'slug' => 'wedding-photography',
                'description' => 'Editorial, timeless wedding stories capturing raw tears, quiet glances, and grand celebrations.',
                'order' => 6,
            ],
            [
                'name' => 'Birthday Photography',
                'slug' => 'birthday-photography',
                'description' => 'Milestone celebrations and elevated birthday sessions designed to feel like luxury magazine features.',
                'order' => 7,
            ],
            [
                'name' => 'Event Photography',
                'slug' => 'event-photography',
                'description' => 'Private galas, creative launches, gallery openings, and bespoke social gatherings.',
                'order' => 8,
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cat) {
            $categories[$cat['slug']] = Category::updateOrCreate(['slug' => $cat['slug']], $cat);
        }

        // 3. User Photographs (10 Authentic Photographs Provided by User)
        $photosData = [
            [
                'category_slug' => 'studio-photography',
                'title' => 'Aura in White',
                'slug' => 'aura-in-white',
                'subtitle' => 'Studio Editorial Series',
                'description' => 'Warm, balanced studio portraiture showcasing crisp streetwear knitwear with relaxed confidence and rich skin tones.',
                'image_path' => 'photo-01-aura-in-white.jpg',
                'aspect_ratio' => 'portrait',
                'dimensions' => '744 x 1024',
                'client_name' => 'SAVAGE XO',
                'location' => 'Becca Photography Studio, VI',
                'camera_gear' => 'Sony A7 IV · 85mm f/1.4 GM',
                'is_featured' => true,
                'is_hero' => true,
                'display_order' => 1,
            ],
            [
                'category_slug' => 'fashion-photography',
                'title' => 'Monochrome Contours',
                'slug' => 'monochrome-contours',
                'subtitle' => 'Headwear & Knitwear Editorial',
                'description' => 'Sculptural studio lighting highlighting textural contrast between the black bucket hat embroidery and custom ribbed athletic vest.',
                'image_path' => 'photo-02-monochrome-contours.jpg',
                'aspect_ratio' => 'portrait',
                'dimensions' => '700 x 1024',
                'client_name' => 'SAVAGE XO',
                'location' => 'The Foundry Studio',
                'camera_gear' => 'Sony A7 IV · 50mm f/1.2 GM',
                'is_featured' => true,
                'is_hero' => false,
                'display_order' => 2,
            ],
            [
                'category_slug' => 'fashion-photography',
                'title' => 'The Art of Detail',
                'slug' => 'the-art-of-detail',
                'subtitle' => 'Macro Textile & Brand Identity',
                'description' => 'High-fidelity macro perspective capturing tactile fleece weave and crisp cyan-blue typography in soft directional light.',
                'image_path' => 'photo-03-fabric-and-form.jpg',
                'aspect_ratio' => 'landscape',
                'dimensions' => '1024 x 734',
                'client_name' => 'SAVAGE XO',
                'location' => 'Macro Suite / Studio A',
                'camera_gear' => 'Sony A7 IV · 90mm f/2.8 Macro',
                'is_featured' => true,
                'is_hero' => false,
                'display_order' => 3,
            ],
            [
                'category_slug' => 'fashion-photography',
                'title' => 'Emerald Geometry',
                'slug' => 'emerald-geometry',
                'subtitle' => 'Seasonal Lookbook Vol. 1',
                'description' => 'Editorial mid-shot emphasizing bespoke geometric side-ribbon detailing and rich forest emerald textiles against warm ochre.',
                'image_path' => 'photo-04-emerald-geometry.jpg',
                'aspect_ratio' => 'portrait',
                'dimensions' => '688 x 1024',
                'client_name' => 'SAVAGE XO',
                'location' => 'Studio Bay 2',
                'camera_gear' => 'Sony A7 IV · 70-200mm f/2.8 GM II',
                'is_featured' => true,
                'is_hero' => false,
                'display_order' => 4,
            ],
            [
                'category_slug' => 'outdoor-photography',
                'title' => 'Brutalist Serenity',
                'slug' => 'brutalist-serenity',
                'subtitle' => 'Architectural Urban Portrait',
                'description' => 'Harmonizing concrete brutalist geometry with delicate natural shadow patterns, featuring the signature grey athletic jersey #24.',
                'image_path' => 'photo-05-brutalist-serenity.jpg',
                'aspect_ratio' => 'portrait',
                'dimensions' => '683 x 1024',
                'client_name' => 'SAVAGE XO',
                'location' => 'Civic Arts Centre Courtyard',
                'camera_gear' => 'Sony A7 IV · 35mm f/1.4 GM',
                'is_featured' => true,
                'is_hero' => false,
                'display_order' => 5,
            ],
            [
                'category_slug' => 'lifestyle-photography',
                'title' => 'Direct Perspective',
                'slug' => 'direct-perspective',
                'subtitle' => 'Urban Energy & Expression',
                'description' => 'Dynamic foreground gesture and immediate viewer connection, capturing raw streetwear attitude in pristine afternoon light.',
                'image_path' => 'photo-06-direct-perspective.jpg',
                'aspect_ratio' => 'portrait',
                'dimensions' => '683 x 1024',
                'client_name' => 'SAVAGE XO',
                'location' => 'Victoria Island Urban Strip',
                'camera_gear' => 'Sony A7 IV · 50mm f/1.2 GM',
                'is_featured' => true,
                'is_hero' => false,
                'display_order' => 6,
            ],
            [
                'category_slug' => 'outdoor-photography',
                'title' => 'Golden Hour Avenue',
                'slug' => 'golden-hour-avenue',
                'subtitle' => 'Streetwear Street Silhouette',
                'description' => 'Candid moment of adjustment framed by tree canopies and warm backlighting, showing the graphic comic #24 jersey.',
                'image_path' => 'photo-07-avenue-portrait.jpg',
                'aspect_ratio' => 'portrait',
                'dimensions' => '683 x 1024',
                'client_name' => 'SAVAGE XO',
                'location' => 'Queens Drive, Ikoyi',
                'camera_gear' => 'Sony A7 IV · 85mm f/1.4 GM',
                'is_featured' => true,
                'is_hero' => false,
                'display_order' => 7,
            ],
            [
                'category_slug' => 'portrait-photography',
                'title' => 'Framed Perspective',
                'slug' => 'framed-perspective',
                'subtitle' => 'Creative Foreground Silhouette',
                'description' => 'Artistic and intimate in-camera framing creating gentle depth of field around the coral floral jersey and embroidered chest crest.',
                'image_path' => 'photo-08-framed-perspective.jpg',
                'aspect_ratio' => 'portrait',
                'dimensions' => '683 x 1024',
                'client_name' => 'SAVAGE XO',
                'location' => 'Ikoyi Garden Sanctuary',
                'camera_gear' => 'Sony A7 IV · 85mm f/1.4 GM',
                'is_featured' => true,
                'is_hero' => false,
                'display_order' => 8,
            ],
            [
                'category_slug' => 'outdoor-photography',
                'title' => 'Horizon of Form',
                'slug' => 'horizon-of-form',
                'subtitle' => 'Architectural Panorama',
                'description' => 'Expansive architectural composition balancing open human posture against repeating modernist window bays in baby-blue athletic attire.',
                'image_path' => 'photo-09-horizon-of-form.jpg',
                'aspect_ratio' => 'landscape',
                'dimensions' => '1024 x 683',
                'client_name' => 'SAVAGE XO',
                'location' => 'Modernist Pavilion Plaza',
                'camera_gear' => 'Sony A7 IV · 24-70mm f/2.8 GM II',
                'is_featured' => true,
                'is_hero' => false,
                'display_order' => 9,
            ],
            [
                'category_slug' => 'portrait-photography',
                'title' => 'The Focused Gaze',
                'slug' => 'the-focused-gaze',
                'subtitle' => 'Over-the-Shoulder Environmental Portrait',
                'description' => 'Hypnotic direct eye contact complemented by creamy bokeh and natural skylight, highlighting raw emotional resonance.',
                'image_path' => 'photo-10-the-focused-gaze.jpg',
                'aspect_ratio' => 'portrait',
                'dimensions' => '683 x 1024',
                'client_name' => 'SAVAGE XO',
                'location' => 'Marina Promenade, Lagos',
                'camera_gear' => 'Sony A7 IV · 85mm f/1.4 GM',
                'is_featured' => true,
                'is_hero' => false,
                'display_order' => 10,
            ],
        ];

        foreach ($photosData as $p) {
            $cat = $categories[$p['category_slug']] ?? null;
            Photo::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'category_id' => $cat?->id,
                    'title' => $p['title'],
                    'subtitle' => $p['subtitle'],
                    'description' => $p['description'],
                    'image_path' => $p['image_path'],
                    'aspect_ratio' => $p['aspect_ratio'],
                    'dimensions' => $p['dimensions'],
                    'client_name' => $p['client_name'],
                    'location' => $p['location'],
                    'shoot_date' => now()->subDays(rand(5, 60)),
                    'camera_gear' => $p['camera_gear'],
                    'is_featured' => $p['is_featured'],
                    'is_hero' => $p['is_hero'],
                    'display_order' => $p['display_order'],
                    'is_published' => true,
                ]
            );
        }

        // Set category cover images
        $categories['studio-photography']->update(['cover_image' => 'photo-01-aura-in-white.jpg']);
        $categories['fashion-photography']->update(['cover_image' => 'photo-02-monochrome-contours.jpg']);
        $categories['outdoor-photography']->update(['cover_image' => 'photo-05-brutalist-serenity.jpg']);
        $categories['lifestyle-photography']->update(['cover_image' => 'photo-06-direct-perspective.jpg']);
        $categories['portrait-photography']->update(['cover_image' => 'photo-10-the-focused-gaze.jpg']);
        $categories['wedding-photography']->update(['cover_image' => 'photo-08-framed-perspective.jpg']);
        $categories['birthday-photography']->update(['cover_image' => 'photo-04-emerald-geometry.jpg']);
        $categories['event-photography']->update(['cover_image' => 'photo-09-horizon-of-form.jpg']);

        // 4. Photography Services & Packages
        $servicesData = [
            [
                'name' => 'Portrait Sessions',
                'slug' => 'portrait-sessions',
                'tagline' => 'Soulful, expressive and iconic personal portraiture',
                'description' => 'Designed for creatives, executives, artists, and individuals seeking signature portraits that communicate presence, quiet authority, and timeless elegance.',
                'starting_price' => 120000,
                'price_label' => 'Starting at',
                'duration' => '1.5 to 2 Hours',
                'deliverables' => '15 Master Retouched High-Res Images',
                'turnaround_time' => '3 to 5 Business Days',
                'features' => [
                    'Studio or curated outdoor location',
                    '2 wardrobe styling changes',
                    'Professional lighting setup & direction',
                    'Private online preview & proofing gallery',
                    'Full commercial usage rights for portfolio & social',
                ],
                'cover_image' => 'photo-10-the-focused-gaze.jpg',
                'is_popular' => false,
                'order' => 1,
            ],
            [
                'name' => 'Fashion & Editorial Lookbooks',
                'slug' => 'fashion-editorial-lookbooks',
                'tagline' => 'High-fashion campaigns and brand lookbooks',
                'description' => 'Full-spectrum visual production for fashion brands, streetwear labels, and designers. We construct compelling narrative campaigns that resonate globally.',
                'starting_price' => 280000,
                'price_label' => 'Starting at',
                'duration' => 'Half-Day or Full-Day',
                'deliverables' => '35 Editorial Retouched Images + Detail Shots',
                'turnaround_time' => '5 to 7 Business Days',
                'features' => [
                    'Creative direction & moodboard development',
                    'Multi-model coordination & poses guidance',
                    'Texture, macro textile, and lifestyle lookbook coverage',
                    'Both web-optimized and print-ready TIFF deliverables',
                    'Lookbook layout consultation',
                ],
                'cover_image' => 'photo-02-monochrome-contours.jpg',
                'is_popular' => true,
                'order' => 2,
            ],
            [
                'name' => 'Studio Sessions',
                'slug' => 'studio-sessions',
                'tagline' => 'Controlled light, bespoke backdrops, pure artistry',
                'description' => 'Step into our dedicated studio space designed for intimate focus, sculptural strobe lighting, seamless paper backdrops, and creative shadow work.',
                'starting_price' => 150000,
                'price_label' => 'Starting at',
                'duration' => '2 Hours',
                'deliverables' => '20 Color-Graded & Retouched Masters',
                'turnaround_time' => '48 to 72 Hours',
                'features' => [
                    'Choice of seamless warm ochre, charcoal, or bone white backdrops',
                    'Up to 3 outfit changes',
                    'Live tethered shooting for instant monitor review',
                    'High-end skin retouching maintaining natural texture',
                    'Complimentary espresso & studio hospitality',
                ],
                'cover_image' => 'photo-01-aura-in-white.jpg',
                'is_popular' => false,
                'order' => 3,
            ],
            [
                'name' => 'Outdoor & Urban Photoshoots',
                'slug' => 'outdoor-urban-photoshoots',
                'tagline' => 'Natural ambient light and cinematic cityscapes',
                'description' => 'Using architectural landscapes, natural foliage, and dynamic urban backdrops to frame authentic, movement-rich photography.',
                'starting_price' => 140000,
                'price_label' => 'Starting at',
                'duration' => '2 Hours',
                'deliverables' => '25 High-Res Retouched Frames',
                'turnaround_time' => '3 to 5 Business Days',
                'features' => [
                    'Golden hour or overcast ambient lighting schedule',
                    'Curated locations (architectural, botanical, or seaside)',
                    'Environmental storytelling & candid pacing',
                    'High dynamic range natural color grading',
                    'Mobile preview on shoot day',
                ],
                'cover_image' => 'photo-05-brutalist-serenity.jpg',
                'is_popular' => false,
                'order' => 4,
            ],
            [
                'name' => 'Wedding Coverage',
                'slug' => 'wedding-coverage',
                'tagline' => 'Timeless, romantic editorial wedding storytelling',
                'description' => 'Documentary intimacy meets high-fashion poise. We document every tender tear, quiet handhold, and euphoric celebration with cinematic grace.',
                'starting_price' => 850000,
                'price_label' => 'Starting at',
                'duration' => 'Full Day (Up to 10 Hours)',
                'deliverables' => '350+ Retouched Highlights + Archival Gallery',
                'turnaround_time' => '2 to 3 Weeks (Sneak Peeks within 48h)',
                'features' => [
                    'Two lead photographers for complete multi-angle coverage',
                    'Pre-wedding editorial consultation & walkthrough',
                    'Sneak-peek highlight gallery delivered within 48 hours',
                    'Handmade linen heirloom photo box with 50 fine-art prints',
                    'Full personal print and digital reproduction rights',
                ],
                'cover_image' => 'photo-08-framed-perspective.jpg',
                'is_popular' => false,
                'order' => 5,
            ],
            [
                'name' => 'Birthday & Milestone Celebrations',
                'slug' => 'birthday-photography',
                'tagline' => 'Celebrate your milestone with bespoke magazine aesthetics',
                'description' => 'Elevate your birthday into an unforgettable visual campaign. Custom themes, luxury styling, and unforgettable portraits to commemorate your new chapter.',
                'starting_price' => 130000,
                'price_label' => 'Starting at',
                'duration' => '1.5 to 2 Hours',
                'deliverables' => '20 Retouched Celebration Portraits',
                'turnaround_time' => '3 Business Days',
                'features' => [
                    'Studio or venue session customized to your theme',
                    'Glamour lighting and creative props integration',
                    'Expedited turnaround ready for social media celebration',
                    'Print-ready high-resolution digital files',
                    'Complimentary behind-the-scenes video snippets',
                ],
                'cover_image' => 'photo-04-emerald-geometry.jpg',
                'is_popular' => false,
                'order' => 6,
            ],
            [
                'name' => 'Event & Gala Coverage',
                'slug' => 'event-coverage',
                'tagline' => 'Discreet, sophisticated documentation of private gatherings',
                'description' => 'For art gallery openings, luxury brand launches, private dinners, and cultural soirées that demand refined visual documentation without intrusive flash.',
                'starting_price' => 300000,
                'price_label' => 'Starting at',
                'duration' => '4 to 6 Hours',
                'deliverables' => '150+ Color-Corrected Event Highlights',
                'turnaround_time' => '4 Business Days',
                'features' => [
                    'Fast-paced candid guest & VIP documentation',
                    'Keynote, stage, and atmospheric venue interior captures',
                    'Press & media-ready web delivery portal',
                    'Same-evening social media highlight selects available',
                ],
                'cover_image' => 'photo-09-horizon-of-form.jpg',
                'is_popular' => false,
                'order' => 7,
            ],
        ];

        foreach ($servicesData as $s) {
            Service::updateOrCreate(['slug' => $s['slug']], $s);
        }

        // 5. Testimonials (authentic creative feedback reflecting genuine photography projects)
        $testimonials = [
            [
                'client_name' => 'Tola Adeleke',
                'client_role' => 'Creative Director',
                'client_company' => 'SAVAGE XO Worldwide',
                'review_text' => 'Becca captured the exact luxury streetwear essence we envisioned for our campaign. Her mastery of natural lighting, fabric textures, and model direction made the shoot seamless. Our collection imagery received acclaim across Lagos and London.',
                'rating' => 5,
                'project_type' => 'Fashion Lookbook & Campaign',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'client_name' => 'Damián Eze',
                'client_role' => 'Editorial Model & Stylist',
                'client_company' => 'Independent Creative',
                'review_text' => 'In front of Becca’s lens, you feel totally understood. She knows how to pull out raw emotion without forced posing. The architectural frames she composed with the concrete textures are among the best in my entire portfolio.',
                'rating' => 5,
                'project_type' => 'Urban Streetwear Editorial',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'client_name' => 'Dr. Kemi Balogun',
                'client_role' => 'Private Client',
                'client_company' => 'Executive Portrait Series',
                'review_text' => 'The calm atmosphere at the studio and Becca’s discerning eye gave me portraits that feel both commanding and deeply personal. She does not just take pictures; she crafts lasting visual identity.',
                'rating' => 5,
                'project_type' => 'Studio Portrait Session',
                'is_featured' => true,
                'order' => 3,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }

        // 6. Realistic Seed Bookings for Admin Demonstration
        $portraitService = Service::where('slug', 'portrait-sessions')->first();
        $fashionService = Service::where('slug', 'fashion-editorial-lookbooks')->first();
        $studioService = Service::where('slug', 'studio-sessions')->first();

        Booking::create([
            'booking_reference' => 'BP-2026-X892',
            'service_id' => $fashionService?->id,
            'service_name' => 'Fashion & Editorial Lookbooks',
            'client_name' => 'Emeka Okafor',
            'client_email' => 'emeka@atelierlagos.com',
            'client_phone' => '+234 803 111 2233',
            'preferred_date' => now()->addDays(5)->format('Y-m-d'),
            'preferred_time' => '10:00 AM',
            'photoshoot_location' => 'Becca Studio & Outdoor VI Arts District',
            'additional_requirements' => 'Launching our Autumn 2026 menswear drop. Looking for 4 model setups with a focus on relaxed tailoring and concrete architectural backdrops.',
            'status' => 'confirmed',
            'admin_notes' => 'Confirmed with client via call. Studio slot reserved. Assistant assigned.',
            'confirmed_at' => now()->subDay(),
        ]);

        Booking::create([
            'booking_reference' => 'BP-2026-M417',
            'service_id' => $portraitService?->id,
            'service_name' => 'Portrait Sessions',
            'client_name' => 'Zainab Bello',
            'client_email' => 'zainab.bello@consulting.ng',
            'client_phone' => '+234 809 444 5566',
            'preferred_date' => now()->addDays(8)->format('Y-m-d'),
            'preferred_time' => '02:30 PM',
            'photoshoot_location' => 'The Foundry Studio A',
            'additional_requirements' => 'Executive portraits for Forbes Africa feature and company rebrand. Minimalist warm background preferred.',
            'status' => 'pending',
            'admin_notes' => 'Awaiting schedule confirmation on client calendar.',
        ]);

        Booking::create([
            'booking_reference' => 'BP-2026-H104',
            'service_id' => $studioService?->id,
            'service_name' => 'Studio Sessions',
            'client_name' => 'Tariq Mensah',
            'client_email' => 'tariq@mensahcreative.com',
            'client_phone' => '+234 818 777 8899',
            'preferred_date' => now()->subDays(3)->format('Y-m-d'),
            'preferred_time' => '11:00 AM',
            'photoshoot_location' => 'Becca Studio',
            'additional_requirements' => 'Album cover and promotional artist portrait session.',
            'status' => 'completed',
            'admin_notes' => 'Session executed successfully. Raw proofs delivered. 20 final retouches delivered to client.',
            'completed_at' => now()->subDay(),
        ]);

        // 7. Seed Contact Messages
        ContactMessage::create([
            'name' => 'Folake Adeyemi',
            'email' => 'folake@vogueafrica.co',
            'phone' => '+234 802 333 4455',
            'subject' => 'Inquiry regarding cover story photoshoot',
            'service_interest' => 'Fashion & Editorial Lookbooks',
            'message' => 'Hello Becca, we have been following your streetwear campaign work with SAVAGE XO and would love to discuss booking you for an upcoming 8-page editorial feature shooting in Lagos next month.',
            'is_read' => true,
            'admin_notes' => 'Replied with pricing guide and portfolio PDF.',
        ]);

        ContactMessage::create([
            'name' => 'Chinedu Eze',
            'email' => 'chinedu.eze@gmail.com',
            'phone' => '+234 815 666 7788',
            'subject' => 'Weekend Studio Portrait Booking',
            'service_interest' => 'Studio Sessions',
            'message' => 'Good day, I would like to book a weekend session for my 30th birthday portrait. Do you provide grooming or styling recommendations prior to the shoot?',
            'is_read' => false,
        ]);

        // 8. Site Settings
        $settings = [
            'brand_name' => 'BECCA PHOTOGRAPHY',
            'brand_tagline' => 'Every Moment Deserves to Be Remembered.',
            'brand_bio' => 'A contemporary visual atelier specializing in high-end portraiture, editorial fashion, and timeless visual storytelling. We believe every frame should hold emotional depth, artistic elegance, and authentic human spirit.',
            'contact_email' => 'SAVAGEXO@GMAIL.COM',
            'contact_phone' => '+234 812 345 6789',
            'studio_address' => 'The Foundry Studio, 14 Victoria Island Arts District, Lagos',
            'opening_hours' => 'Tuesday – Sunday: 9:00 AM – 6:30 PM (Mondays by appointment)',
            'instagram' => '@beccaphotography',
            'twitter' => '@beccaphotos',
            'pinterest' => '@beccaphotography',
            'photographer_name' => 'Becca',
            'photographer_title' => 'Founder & Lead Visual Artist',
            'philosophy' => 'We reject mechanical poses and sterile clichés. Our work honors genuine expression, raw texture, architectural harmony, and the unspoken feeling that turns a fleeting second into an eternal memory.',
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::set($key, $val);
        }
    }
}
