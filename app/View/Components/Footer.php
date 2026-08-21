<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\App;
use App\Models\Language;
use App\Models\Category;
use App\Models\Store;
use App\Models\Blog;


class Footer extends Component
{
    public $langs;
    public $currentLang;
    public $allcategories;
    public $populorstores;
    public $footerblogs;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
      $currentLocale = App::getLocale();
        $language = Language::where('code', $currentLocale)->first();
        $languageId = $language ? $language->id : 10;
        $this->langs = Language::all();
        $this->currentLang = $language;
        $this->allcategories = Category::all();
        $this->populorstores = Store::where('language_id', $languageId)
            ->where('top_store', '>', 0)
            ->where('status', 'enable')
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();
        $this->footerblogs = Blog::where('language_id', $languageId)
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
        return view('components.footer');
    }
}
