<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OverviewController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Tools\CvBuilderController;
use App\Services\AnalyticsService;
use Illuminate\Http\Request;

Route::get('/', function () {
    $latestUpdates = \App\Models\SiteUpdate::where('is_published', true)
        ->where('is_featured_on_home', true)
        ->orderBy('sort_order')
        ->orderBy('published_at', 'desc')
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

    return view('home', compact('latestUpdates'));
});

Route::get('/tools', function () {
    $tools = [
        [
            'name' => 'Age Calculator',
            'slug' => 'age-calculator',
            'description' => 'Calculate exact age in years, months, days and more.',
            'category' => 'Calculators',
        ],
        [
            'name' => 'Word Counter',
            'slug' => 'word-counter',
            'description' => 'Count words, characters, sentences and reading time instantly.',
            'category' => 'Text Tools',
        ],
        [
            'name' => 'Password Generator',
            'slug' => 'password-generator',
            'description' => 'Generate strong random passwords for accounts and apps.',
            'category' => 'Security',
        ],
        [
            'name' => 'JSON Formatter',
            'slug' => 'json-formatter',
            'description' => 'Format, validate and minify JSON data online.',
            'category' => 'Developer Tools',
        ],
        [
            'name' => 'QR Code Generator',
            'slug' => 'qr-code-generator',
            'description' => 'Create QR codes for links, text and more.',
            'category' => 'Utility Tools',
        ],
        [
            'name' => 'Image Compressor',
            'slug' => 'image-compressor',
            'description' => 'Reduce image file size for web, email and uploads.',
            'category' => 'Image Tools',
        ],
        [
            'name' => 'Image Resizer',
            'slug' => 'image-resizer',
            'description' => 'Resize images by width and height for digital use.',
            'category' => 'Image Tools',
        ],
        [
            'name' => 'Percentage Calculator',
            'slug' => 'percentage-calculator',
            'description' => 'Calculate percentages, increase and decrease quickly.',
            'category' => 'Calculators',
        ],
        [
            'name' => 'Discount Calculator',
            'slug' => 'discount-calculator',
            'description' => 'Calculate discounts, sale price and savings.',
            'category' => 'Calculators',
        ],
        [
            'name' => 'Loan Calculator',
            'slug' => 'loan-calculator',
            'description' => 'Estimate loan payments, total interest and repayment.',
            'category' => 'Calculators',
        ],
        [
            'name' => 'Base64 Encoder / Decoder',
            'slug' => 'base64-encoder-decoder',
            'description' => 'Encode text to Base64 or decode Base64 to text.',
            'category' => 'Developer Tools',
        ],
        [
            'name' => 'Text Case Converter',
            'slug' => 'text-case-converter',
            'description' => 'Convert text into uppercase, lowercase and more.',
            'category' => 'Text Tools',
        ],
        [
            'name' => 'Random Name Generator',
            'slug' => 'random-name-generator',
            'description' => 'Generate names for characters, brands and projects.',
            'category' => 'Creative Tools',
        ],
        [
            'name' => 'Resume Builder',
            'slug' => 'resume-builder',
            'description' => 'Build an ATS-friendly resume with live preview.',
            'category' => 'Career Tools',
        ],
        [
            'name' => 'CV Builder',
            'slug' => 'cv-builder',
            'description' => 'Create a professional CV online with modern templates and PDF download.',
            'category' => 'Documents',
        ],
        [
            'name' => 'Invoice Generator',
            'slug' => 'invoice-generator',
            'description' => 'Create professional invoices for products and services.',
            'category' => 'Business Tools',
        ],
        [
            'name' => 'O-Level Lesson Plan Generator (TIE Format)',
            'slug' => 'lesson-plan-generator',
            'description' => 'Generate syllabus-based O-Level lesson plans in TIE format with editable preview and save support.',
            'category' => 'Documents',
        ],
    ];

    return view('tools.index', compact('tools'));
});
Route::get('/tools/age-calculator', function () {
    return view('tools.age-calculator');
});
Route::get('/tools/word-counter', function () {
    $comments = \App\Models\Comment::where('page_type', 'tool')
        ->where('page_slug', 'word-counter')
        ->where('status', 'approved')
        ->latest()
        ->get();

    return view('tools.word-counter', compact('comments'));
});
Route::get('/tools/password-generator', function () {
    $comments = \App\Models\Comment::where('page_type', 'tool')
        ->where('page_slug', 'password-generator')
        ->where('status', 'approved')
        ->latest()
        ->get();

    return view('tools.password-generator', compact('comments'));
});
Route::get('/tools/json-formatter', function () {
    $comments = \App\Models\Comment::where('page_type', 'tool')
        ->where('page_slug', 'json-formatter')
        ->where('status', 'approved')
        ->latest()
        ->get();

    return view('tools.json-formatter', compact('comments'));
});
Route::get('/tools/qr-code-generator', function () {
    $comments = \App\Models\Comment::where('page_type', 'tool')
        ->where('page_slug', 'qr-code-generator')
        ->where('status', 'approved')
        ->latest()
        ->get();

    return view('tools.qr-code-generator', compact('comments'));
});
Route::get('/tools/text-case-converter', function () {
    return view('tools.text-case-converter');
});
Route::get('/tools/image-compressor', function () {
    return view('tools.image-compressor');
});
Route::get('/tools/image-resizer', function () {
    return view('tools.image-resizer');
});
Route::get('/tools/percentage-calculator', function () {
    return view('tools.percentage-calculator');
});
Route::get('/tools/discount-calculator', function () {
    return view('tools.discount-calculator');
});
Route::get('/tools/loan-calculator', function () {
    return view('tools.loan-calculator');
});
Route::get('/tools/base64-encoder-decoder', function () {
    return view('tools.base64-encoder-decoder');
});
Route::get('/tools/random-name-generator', function () {
    return view('tools.random-name-generator');
});
Route::get('/tools/invoice-generator', function () {
    $comments = \App\Models\Comment::where('page_type', 'tool')
        ->where('page_slug', 'invoice-generator')
        ->where('status', 'approved')
        ->latest()
        ->get();

    return view('tools.invoice-generator', compact('comments'));
});
Route::get('/tools/resume-builder', function () {
    $comments = \App\Models\Comment::where('page_type', 'tool')
        ->where('page_slug', 'resume-builder')
        ->where('status', 'approved')
        ->latest()
        ->get();

    return view('tools.resume-builder', compact('comments'));
})->name('tools.resume-builder');
Route::get('/tools/cv-builder', [CvBuilderController::class, 'show'])->name('tools.cv-builder');
Route::post('/tools/cv-builder/download', [CvBuilderController::class, 'download'])->name('tools.cv-builder.download');
Route::post('/tools/cv-builder/pdf', [CvBuilderController::class, 'downloadPdf'])->name('tools.cv-builder.pdf');
Route::post('/tools/cv-builder/save', [CvBuilderController::class, 'save'])->middleware('auth')->name('tools.cv-builder.save');
Route::get('/dashboard/cvs/{cv}', [CvBuilderController::class, 'load'])->middleware('auth')->name('dashboard.cvs.load');
Route::delete('/dashboard/cvs/{cv}', [CvBuilderController::class, 'delete'])->middleware('auth')->name('dashboard.cvs.delete');
Route::get('/dashboard/cvs/{cv}/download', [CvBuilderController::class, 'downloadSavedCv'])->middleware('auth')->name('dashboard.cvs.download');
Route::post('/tools/resume-builder/pdf', [App\Http\Controllers\Tools\ResumeBuilderController::class, 'downloadPdf'])->name('tools.resume-builder.pdf');
Route::post('/track/tool-use', function (Request $request, AnalyticsService $analyticsService) {
    $validated = $request->validate([
        'tool_slug' => ['required', 'string', 'max:255'],
        'action_type' => ['required', 'string', 'max:50'],
        'meta' => ['nullable', 'array'],
    ]);

    $analyticsService->log(
        request: $request,
        actionType: $validated['action_type'],
        toolSlug: $validated['tool_slug'],
        meta: $validated['meta'] ?? null
    );

    return response()->json(['success' => true]);
})->name('track.tool-use');

Route::post('/comments', [App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// User Dashboard Routes
Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\DashboardController::class, 'profile'])->name('dashboard.profile');
    Route::get('/my-resumes', [App\Http\Controllers\DashboardController::class, 'resumes'])->name('dashboard.resumes');
    Route::get('/my-cvs', [App\Http\Controllers\DashboardController::class, 'cvs'])->name('dashboard.cvs');
    Route::get('/my-invoices', [App\Http\Controllers\DashboardController::class, 'invoices'])->name('dashboard.invoices');
    Route::get('/downloads', [App\Http\Controllers\DashboardController::class, 'downloads'])->name('dashboard.downloads');
    Route::get('/settings', [App\Http\Controllers\DashboardController::class, 'settings'])->name('dashboard.settings');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', OverviewController::class)->name('admin.overview');
    Route::get('/overview', OverviewController::class);
    Route::get('/tool-usage', [App\Http\Controllers\Admin\ToolUsageController::class, '__invoke'])->name('admin.tool-usage');

    Route::get('/traffic', [App\Http\Controllers\Admin\TrafficController::class, '__invoke'])->name('admin.traffic');
    Route::get('/countries', [App\Http\Controllers\Admin\CountriesController::class, '__invoke'])->name('admin.countries');
    Route::get('/devices', [App\Http\Controllers\Admin\DevicesController::class, '__invoke'])->name('admin.devices');
    Route::get('/referrers', [App\Http\Controllers\Admin\ReferrersController::class, '__invoke'])->name('admin.referrers');

    Route::resource('updates', App\Http\Controllers\Admin\UpdatesController::class)->names([
        'index' => 'admin.updates.index',
        'create' => 'admin.updates.create',
        'store' => 'admin.updates.store',
        'edit' => 'admin.updates.edit',
        'update' => 'admin.updates.update',
        'destroy' => 'admin.updates.destroy',
    ]);

    Route::get('/users', [App\Http\Controllers\Admin\UsersController::class, '__invoke'])->name('admin.users');
    Route::get('/tools', [App\Http\Controllers\Admin\ToolsController::class, '__invoke'])->name('admin.tools');
    Route::get('/contacts', [App\Http\Controllers\Admin\ContactController::class, '__invoke'])->name('admin.contacts');
    Route::get('/messages', [App\Http\Controllers\Admin\MessagesController::class, 'index'])->name('admin.messages.index');
    Route::get('/messages/{message}', [App\Http\Controllers\Admin\MessagesController::class, 'show'])->name('admin.messages.show');
    Route::get('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'edit'])->name('admin.settings');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingsController::class, 'update'])->name('admin.settings.update');

    // Comments management
    Route::get('/comments', [App\Http\Controllers\Admin\CommentsController::class, 'index'])->name('admin.comments');
    Route::get('/comments/{comment}', [App\Http\Controllers\Admin\CommentsController::class, 'show'])->name('admin.comments.show');
    Route::post('/comments/{comment}/approve', [App\Http\Controllers\Admin\CommentsController::class, 'approve'])->name('admin.comments.approve');
    Route::post('/comments/{comment}/reject', [App\Http\Controllers\Admin\CommentsController::class, 'reject'])->name('admin.comments.reject');
    Route::post('/comments/{comment}/notes', [App\Http\Controllers\Admin\CommentsController::class, 'updateNotes'])->name('admin.comments.notes');

    // Lesson Plan Management
    Route::resource('forms', App\Http\Controllers\Admin\FormsController::class)
        ->except(['show'])
        ->names([
            'index' => 'admin.forms.index',
            'create' => 'admin.forms.create',
            'store' => 'admin.forms.store',
            'edit' => 'admin.forms.edit',
            'update' => 'admin.forms.update',
            'destroy' => 'admin.forms.destroy',
        ]);

    Route::resource('subjects', App\Http\Controllers\Admin\SubjectsController::class)
        ->except(['show'])
        ->names([
            'index' => 'admin.subjects.index',
            'create' => 'admin.subjects.create',
            'store' => 'admin.subjects.store',
            'edit' => 'admin.subjects.edit',
            'update' => 'admin.subjects.update',
            'destroy' => 'admin.subjects.destroy',
        ]);

    Route::resource('topics', App\Http\Controllers\Admin\TopicsController::class)
        ->except(['show'])
        ->names([
            'index' => 'admin.topics.index',
            'create' => 'admin.topics.create',
            'store' => 'admin.topics.store',
            'edit' => 'admin.topics.edit',
            'update' => 'admin.topics.update',
            'destroy' => 'admin.topics.destroy',
        ]);

    Route::resource('subtopics', App\Http\Controllers\Admin\SubtopicsController::class)
        ->except(['show'])
        ->names([
            'index' => 'admin.subtopics.index',
            'create' => 'admin.subtopics.create',
            'store' => 'admin.subtopics.store',
            'edit' => 'admin.subtopics.edit',
            'update' => 'admin.subtopics.update',
            'destroy' => 'admin.subtopics.destroy',
        ]);

    Route::resource('syllabus-entries', App\Http\Controllers\Admin\SyllabusEntriesController::class)
        ->except(['show'])
        ->names([
            'index' => 'admin.syllabus-entries.index',
            'create' => 'admin.syllabus-entries.create',
            'store' => 'admin.syllabus-entries.store',
            'edit' => 'admin.syllabus-entries.edit',
            'update' => 'admin.syllabus-entries.update',
            'destroy' => 'admin.syllabus-entries.destroy',
        ]);
});

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::view('/about', 'pages.about')->name('about');

Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::view('/privacy-policy', 'pages.privacy-policy')->name('privacy');

Route::view('/terms', 'pages.terms')->name('terms');

use App\Http\Controllers\Tools\LessonPlanController;

Route::prefix('tools')->group(function () {
    Route::get('/lesson-plan-generator', [LessonPlanController::class, 'show'])->name('tools.lesson-plan.show');
    Route::get('/lesson-plan-generator/topics', [LessonPlanController::class, 'getTopics'])->name('tools.lesson-plan.topics');
    Route::get('/lesson-plan-generator/subtopics', [LessonPlanController::class, 'getSubtopics'])->name('tools.lesson-plan.subtopics');
    Route::get('/lesson-plan-generator/syllabus-entry', [LessonPlanController::class, 'getSyllabusEntry'])->name('tools.lesson-plan.syllabus-entry');
    Route::post('/lesson-plan-generator/generate-draft', [LessonPlanController::class, 'generateDraft'])->name('tools.lesson-plan.generate-draft');
    Route::post('/lesson-plan-generator/save-draft', [LessonPlanController::class, 'saveDraft'])->name('tools.lesson-plan.save-draft');
});
