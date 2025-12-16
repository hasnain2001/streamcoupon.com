<?php

namespace App\Observers;

use App\Http\Controllers\SitemapController;

class SitemapObserver
{
    public function created($model)
    {
        (new SitemapController())->generate();
    }

    public function updated($model)
    {
        (new SitemapController())->generate();
    }

    public function deleted($model)
    {
        (new SitemapController())->generate();
    }
}
