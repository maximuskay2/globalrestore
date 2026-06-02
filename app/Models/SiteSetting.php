<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name',
        'hero_headline',
        'hero_subheadline',
        'hero_cta_text',
        'hero_cta_url',
        'hero_background_path',
        'hero_background_paths',
        'video_slider_heading',
        'video_slider_description',
        'video_slider_cta_text',
        'video_slider_cta_url',
        'meta_description_default',
        'contact_email',
        'instagram_url',
        'x_url',
        'linkedin_url',
        'facebook_url',
        'footer_statement',
        'companies_house_number',
        'impact_stat_1_number',
        'impact_stat_1_label',
        'impact_stat_2_number',
        'impact_stat_2_label',
        'impact_stat_3_number',
        'impact_stat_3_label',
        'privacy_policy_url',
        'terms_url',
    ];

    protected $casts = [
        'hero_background_paths' => 'array',
    ];

    public static function current(): self
    {
        return static::query()->first() ?? static::query()->create([
            'site_name' => config('brand.name'),
            'hero_headline' => config('brand.hero.headline'),
            'hero_subheadline' => 'A UK Community Interest Company advancing climate action, green skills, and community resilience.',
            'meta_description_default' => 'Restore Global Initiative empowers UK communities through green skills, clean energy, and climate action.',
            'contact_email' => config('brand.contact.email'),
            'instagram_url' => config('brand.social.instagram'),
            'x_url' => config('brand.social.x'),
            'footer_statement' => config('brand.legal.footer_statement'),
            'companies_house_number' => null,
            'hero_cta_text' => 'Get Involved',
            'hero_cta_url' => null,
            'impact_stat_1_number' => '500+',
            'impact_stat_1_label' => 'Households supported through green skills outreach',
            'impact_stat_2_number' => '120+',
            'impact_stat_2_label' => 'Women engaged in climate & energy programmes',
            'impact_stat_3_number' => '80+',
            'impact_stat_3_label' => 'Young adults on pathways to clean energy careers',
            'video_slider_heading' => 'Our Work in Action',
            'video_slider_description' => 'Watch highlights from Restore Global Initiative programmes — green skills training, clean energy outreach, and community climate action making a difference across the UK.',
            'video_slider_cta_text' => 'Contact Us',
            'video_slider_cta_url' => null,
        ]);
    }

    public function heroCtaUrl(): string
    {
        return $this->resolveInternalRouteUrl($this->hero_cta_url, 'contact');
    }

    public function videoSliderCtaUrl(): string
    {
        return $this->resolveInternalRouteUrl($this->video_slider_cta_url, 'contact');
    }

    protected function resolveInternalRouteUrl(?string $url, string $routeName): string
    {
        if (blank($url)) {
            return route($routeName);
        }

        $path = parse_url($url, PHP_URL_PATH) ?? $url;
        $internalPath = route($routeName, [], false);

        if ($path === $internalPath || str_ends_with(rtrim($path, '/'), rtrim($internalPath, '/'))) {
            return route($routeName);
        }

        return $url;
    }

    public function heroBackgroundUrl(): ?string
    {
        return $this->heroBackgroundUrls()[0] ?? null;
    }

    /**
     * @return array<int, string>
     */
    public function heroBackgroundUrls(): array
    {
        /** @var Collection<int, string> $paths */
        $paths = collect($this->hero_background_paths)
            ->filter(fn (mixed $path): bool => is_string($path) && filled($path));

        if ($paths->isEmpty() && filled($this->hero_background_path)) {
            $paths = collect([$this->hero_background_path]);
        }

        return $paths
            ->map(fn (string $path): string => Storage::disk('public')->url($path))
            ->values()
            ->all();
    }

    /**
     * @return array<int, array{number: string, label: string}>
     */
    public function impactStats(): array
    {
        $stats = [];
        foreach ([1, 2, 3] as $i) {
            $number = $this->{"impact_stat_{$i}_number"};
            $label = $this->{"impact_stat_{$i}_label"};
            if (filled($number) && filled($label)) {
                $stats[] = ['number' => $number, 'label' => $label];
            }
        }

        return $stats;
    }
}
