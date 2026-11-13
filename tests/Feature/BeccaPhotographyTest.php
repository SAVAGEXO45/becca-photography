<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Photo;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class BeccaPhotographyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--force' => true]);
    }

    public function test_homepage_loads_successfully_and_displays_brand(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('BECCA PHOTOGRAPHY');
        $response->assertSee('Every Moment');
        $response->assertSee('Deserves to Be');
        $response->assertSee('Remembered.');
        $response->assertSee('Explore Portfolio');
        $response->assertSee('Book a Session');
        $response->assertSee('photo-01-aura-in-white.jpg');
    }

    public function test_portfolio_page_loads_and_displays_categories(): void
    {
        $response = $this->get('/portfolio');

        $response->assertStatus(200);
        $response->assertSee('Selected Portfolio');
        $response->assertSee('Fashion Photography');
        $response->assertSee('Portrait Photography');
        $response->assertSee('Studio Photography');
        $response->assertSee('Outdoor Photography');
    }

    public function test_portfolio_category_filter_works(): void
    {
        $response = $this->get('/portfolio?category=fashion-photography');

        $response->assertStatus(200);
        $response->assertSee('Monochrome Contours');
    }

    public function test_single_photo_detail_page_loads(): void
    {
        $photo = Photo::where('slug', 'aura-in-white')->first();
        $this->assertNotNull($photo);

        $response = $this->get('/portfolio/' . $photo->slug);

        $response->assertStatus(200);
        $response->assertSee($photo->title);
        $response->assertSee('SAVAGE XO');
        $response->assertSee('Sony A7 IV');
    }

    public function test_about_page_loads_with_artist_and_philosophy(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
        $response->assertSee('About BECCA PHOTOGRAPHY');
        $response->assertSee('Meet Becca');
        $response->assertSee('Authentic Human Presence');
    }

    public function test_services_page_loads_with_all_packages(): void
    {
        $response = $this->get('/services');

        $response->assertStatus(200);
        $response->assertSee('Services & Packages');
        $response->assertSee('Portrait Sessions');
        $response->assertSee('Fashion & Editorial Lookbooks');
        $response->assertSee('Studio Sessions');
        $response->assertSee('Wedding Coverage');
    }

    public function test_single_service_page_loads(): void
    {
        $service = Service::where('slug', 'portrait-sessions')->first();
        $this->assertNotNull($service);

        $response = $this->get('/services/' . $service->slug);

        $response->assertStatus(200);
        $response->assertSee($service->name);
        $response->assertSee('Reserve This Date');
    }

    public function test_booking_page_loads(): void
    {
        $response = $this->get('/book');

        $response->assertStatus(200);
        $response->assertSee('Book a Session');
        $response->assertSee('Select Photography Service');
    }

    public function test_booking_submission_creates_record_and_generates_reference(): void
    {
        $service = Service::first();

        $bookingData = [
            'service_id' => $service->id,
            'client_name' => 'Chioma Nwosu',
            'client_email' => 'chioma@example.com',
            'client_phone' => '+234 809 123 4567',
            'preferred_date' => now()->addDays(10)->format('Y-m-d'),
            'preferred_time' => '10:00 AM - Morning Light',
            'photoshoot_location' => 'Becca Studio, Victoria Island',
            'additional_requirements' => 'Brand launch editorial photoshoot with 3 outfit changes.',
        ];

        $response = $this->post('/book', $bookingData);

        $booking = Booking::where('client_email', 'chioma@example.com')->first();
        $this->assertNotNull($booking);
        $this->assertStringStartsWith('BP-', $booking->booking_reference);
        $this->assertEquals('pending', $booking->status);

        $response->assertRedirect(route('booking.confirmation', ['reference' => $booking->booking_reference]));
    }

    public function test_booking_tracking_finds_record(): void
    {
        $booking = Booking::first();
        $this->assertNotNull($booking);

        $response = $this->get('/track-booking?reference=' . $booking->booking_reference);

        $response->assertStatus(200);
        $response->assertSee($booking->booking_reference);
        $response->assertSee($booking->client_name);
    }

    public function test_contact_form_saves_inquiry_to_database(): void
    {
        $contactData = [
            'name' => 'Adewale Johnson',
            'email' => 'adewale@savagexo.com',
            'phone' => '+234 812 000 1122',
            'subject' => 'Campaign Shoot Inquiry',
            'service_interest' => 'Fashion & Editorial Lookbooks',
            'message' => 'We would love to book Becca for our next lookbook campaign in Lagos.',
        ];

        $response = $this->post('/contact', $contactData);

        $response->assertRedirect(route('contact'));
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'adewale@savagexo.com',
            'name' => 'Adewale Johnson',
        ]);
    }

    public function test_admin_login_authenticates_admin(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@beccaphotography.com',
            'password' => 'admin123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticated();
    }

    public function test_admin_dashboard_requires_auth(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect(route('admin.login'));
    }

    public function test_authenticated_admin_can_view_dashboard(): void
    {
        $admin = User::where('is_admin', true)->first();

        $response = $this->actingAs($admin)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Studio Atelier Dashboard');
        $response->assertSee('Total Photographs');
    }

    public function test_admin_can_update_booking_status(): void
    {
        $admin = User::where('is_admin', true)->first();
        $booking = Booking::where('status', 'pending')->first() ?? Booking::first();

        $response = $this->actingAs($admin)->patch('/admin/bookings/' . $booking->id . '/status', [
            'status' => 'confirmed',
            'admin_notes' => 'Confirmed via WhatsApp with client.',
        ]);

        $response->assertStatus(302);
        $booking->refresh();
        $this->assertEquals('confirmed', $booking->status);
        $this->assertEquals('Confirmed via WhatsApp with client.', $booking->admin_notes);
    }

    public function test_admin_can_manage_categories(): void
    {
        $admin = User::where('is_admin', true)->first();

        $response = $this->actingAs($admin)->post('/admin/categories', [
            'name' => 'Fine Art Black & White',
            'description' => 'Monochrome high contrast film aesthetics.',
            'order' => 10,
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', ['name' => 'Fine Art Black & White']);
    }

    public function test_admin_can_update_site_settings(): void
    {
        $admin = User::where('is_admin', true)->first();

        $response = $this->actingAs($admin)->post('/admin/settings', [
            'brand_name' => 'BECCA PHOTOGRAPHY',
            'brand_tagline' => 'Every Moment Deserves to Be Remembered.',
            'contact_email' => 'SAVAGEXO@GMAIL.COM',
            'contact_phone' => '+234 812 345 6789',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('site_settings', [
            'key' => 'contact_email',
            'value' => 'SAVAGEXO@GMAIL.COM',
        ]);
    }
}
