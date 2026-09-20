<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\MessageBag;
use Illuminate\Http\Request;

View::share('errors', new MessageBag());
Auth::login(App\Models\User::find(1));

// 1. settings blade renders with contact info card
$sHtml = view('backend.settings', ['settings' => App\Models\Setting::first()])->render();
foreach (['Contact Information', 'contact_instagram', 'contact_phone', 'contact_email'] as $m) {
    echo (str_contains($sHtml, $m) ? 'PASS' : 'FAIL') . ": settings:$m\n";
}

// 2. homepage shows contact values from settings
$h = view('frontend.index')->render();
foreach (['@eshas_rokomaris2', 'contact-form__title', 'Send us a Message'] as $m) {
    echo (str_contains($h, $m) ? 'PASS' : 'FAIL') . ": home:$m\n";
}
echo (str_contains($h, 'https://instagram.com/eshas_rokomaris2') ? 'PASS' : 'FAIL') . ': home:instagram link built from handle' . "\n";

// 3. settings update persists contact info
$ctrl = app(App\Http\Controllers\admin\SettingsController::class);
$req = new Request();
$req->setMethod('POST');
$req->request->add([
    'currency' => 'BDT', 'language' => 'en',
    'delivery_charge' => 60, 'delivery_outside' => 120,
    'bkash_number' => '01700000000', 'nagad_number' => '01900000000',
    'contact_instagram' => '@newhandle', 'contact_facebook' => 'https://facebook.com/newpage',
    'contact_phone' => '+880 1711112222', 'contact_email' => 'test@example.com',
    'tax_percentage' => 0,
]);
$ctrl->update($req);
$s = App\Models\Setting::first();
echo "after update: insta={$s->contact_instagram} fb={$s->contact_facebook} phone={$s->contact_phone} email={$s->contact_email}\n";

// 4. homepage shows updated values + phone tel link
$h2 = view('frontend.index')->render();
echo (str_contains($h2, '@newhandle') ? 'PASS' : 'FAIL') . ': home:updated instagram' . "\n";
echo (str_contains($h2, 'https://instagram.com/newhandle') ? 'PASS' : 'FAIL') . ': home:updated instagram link' . "\n";
echo (str_contains($h2, 'href="tel:+8801711112222"') ? 'PASS' : 'FAIL') . ': home:tel link built from phone' . "\n";

// restore original values
$req->request->set('contact_instagram', '@eshas_rokomaris2');
$req->request->set('contact_facebook', 'https://facebook.com/');
$req->request->set('contact_phone', '+880 1XXXXXXXXX');
$req->request->set('contact_email', 'hello@example.com');
$ctrl->update($req);
echo "restored defaults\n";
echo "done\n";