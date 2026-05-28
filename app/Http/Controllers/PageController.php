<?php

namespace App\Http\Controllers;

use App\Enums\ServiceCategory;
use App\Models\FocusPillar;
use App\Models\HomeVideoSlide;
use App\Models\MissionSection;
use App\Models\NewsPost;
use App\Models\ServicePillar;
use App\Models\SiteSetting;
use Illuminate\View\View;

class PageController extends Controller
{
    protected function settings(): SiteSetting
    {
        return SiteSetting::current();
    }

    public function home(): View
    {
        $homeServices = ServicePillar::query()
            ->active()
            ->onHome()
            ->ordered()
            ->get();

        return view('pages.home', [
            'settings' => $this->settings(),
            'focusPillars' => FocusPillar::query()->active()->ordered()->get(),
            'homeVideoSlides' => HomeVideoSlide::query()->active()->ordered()->get(),
            'qualificationServices' => $homeServices->where('category', ServiceCategory::Qualification),
            'communityServices' => $homeServices->where('category', ServiceCategory::CommunityService),
            'uncategorizedServices' => $homeServices->filter(fn (ServicePillar $s) => $s->category === null),
            'latestNews' => NewsPost::query()->latestPublished()->limit(3)->get(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'settings' => $this->settings(),
            'sections' => MissionSection::query()->active()->ordered()->get(),
        ]);
    }

    public function services(): View
    {
        return view('pages.services', [
            'settings' => $this->settings(),
            'pillars' => ServicePillar::query()->active()->ordered()->get(),
        ]);
    }
}
