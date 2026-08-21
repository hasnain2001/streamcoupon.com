<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\View\Component;
use App\Models\Language;
use App\Models\Category;
use App\Models\Store;
use App\Models\Blog;

class Navbar extends Component
{
      public $langs;
    public $currentLang;
    public $allcategories;
    public $populorstores;
    public $navblogs;
    /**
     * Create a new component instance.
     */

    public function __construct()
    {
        // Get the current locale
        $currentLocale = App::getLocale();

        // Get current language
        $language = Language::where('code', $currentLocale)->first();

        // Fallback language ID
        $languageId = $language ? $language->id : 10;

        // Get all languages
        $this->langs = Language::all();

        // Set the current language model
        $this->currentLang = $language;

        // Get all categories
        $this->allcategories = Category::all();

        // Get top/popular stores based on current language
        $this->populorstores = Store::where('language_id', $languageId)
            ->where('top_store', '>', 0)
            ->where('status', 'enable')
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();
        $this->navblogs = Blog::where('language_id', $languageId)
            ->where('top_blog', '>', 0)
            ->where('status', 1)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();    
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
