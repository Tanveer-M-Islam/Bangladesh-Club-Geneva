<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_title',
        'page_subtitle',
        'hero_image_path',
        'news_items',
    ];

    protected $casts = [
        'news_items' => 'array',
    ];

    /**
     * Fetch Open Graph (OG) metadata for a given URL and cache it.
     */
    public static function getLinkPreview($url)
    {
        if (empty($url)) {
            return ['title' => 'Invalid URL', 'image' => null, 'description' => '', 'source' => 'Unknown'];
        }

        $cacheKey = 'news_preview_' . md5($url);

        return \Illuminate\Support\Facades\Cache::remember($cacheKey, now()->addDays(7), function () use ($url) {
            try {
                $response = \Illuminate\Support\Facades\Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Language' => 'en-US,en;q=0.5',
                ])->withoutVerifying()->timeout(8)->get($url);
                
                $html = $response->body();

                // Simple regex extraction for OG tags
                preg_match('/<meta[^>]*property=["\']og:title["\'][^>]*content=["\']([^"\']+)["\']/i', $html, $titleMatch);
                preg_match('/<meta[^>]*property=["\']og:image["\'][^>]*content=["\']([^"\']+)["\']/i', $html, $imageMatch);
                preg_match('/<meta[^>]*property=["\']og:description["\'][^>]*content=["\']([^"\']+)["\']/i', $html, $descMatch);
                preg_match('/<meta[^>]*property=["\']og:site_name["\'][^>]*content=["\']([^"\']+)["\']/i', $html, $siteMatch);

                // Fallbacks
                if (empty($titleMatch)) {
                    preg_match('/<title[^>]*>([^<]+)<\/title>/i', $html, $titleMatch);
                }
                
                $imageUrl = $imageMatch[1] ?? null;
                
                // Ultimate Fallback: Grab the first significant image from the page body if OG fails
                if (empty($imageUrl)) {
                    if (preg_match_all('/<img[^>]+src=["\']([^"\']+)["\']/i', $html, $imgMatches)) {
                        foreach ($imgMatches[1] as $imgSrc) {
                            // Ignore tracking pixels, tiny icons, logos
                            if (str_contains($imgSrc, 'logo') || str_contains($imgSrc, 'icon') || str_contains($imgSrc, 'pixel')) continue;
                            if (strlen($imgSrc) > 10) {
                                $imageUrl = $imgSrc;
                                break;
                            }
                        }
                    }
                }

                $host = parse_url($url, PHP_URL_HOST);
                $sourceName = $siteMatch[1] ?? null;
                
                // Clean up source name (e.g., 'www.facebook.com' -> 'Facebook')
                if (empty($sourceName) && $host) {
                    $cleanHost = str_replace('www.', '', strtolower($host));
                    $sourceName = ucfirst(explode('.', $cleanHost)[0]);
                }

                $title = $titleMatch[1] ?? null;
                if (empty($title) || strtolower(trim($title)) === 'error' || stripos($title, 'security check') !== false || stripos($title, 'attention required') !== false) {
                    $title = $sourceName . ' Post';
                }

                // Fix relative image URLs
                if ($imageUrl && !filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                    $parsedUrl = parse_url($url);
                    $scheme = $parsedUrl['scheme'] ?? 'https';
                    $imageUrl = $scheme . '://' . $host . '/' . ltrim($imageUrl, '/');
                }
                
                // Default Facebook image fallback if scraper is blocked
                if (empty($imageUrl) && strtolower($sourceName) === 'facebook') {
                    $imageUrl = 'https://upload.wikimedia.org/wikipedia/commons/b/b8/2021_Facebook_icon.svg';
                }

                return [
                    'title' => $title,
                    'image' => $imageUrl,
                    'description' => $descMatch[1] ?? '',
                    'source' => $sourceName
                ];
            } catch (\Exception $e) {
                return [
                    'title' => parse_url($url, PHP_URL_HOST) ?? 'External Link',
                    'image' => null,
                    'description' => '',
                    'source' => parse_url($url, PHP_URL_HOST) ?? 'Unknown'
                ];
            }
        });
    }
}
