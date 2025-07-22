<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdvertisementUpdateRequest;
use App\Models\Advertisement;
use App\Traits\FileUploadTrait;

class AdvertisementController extends Controller
{
    use FileUploadTrait;

    /**
     * Apply middleware or inject service dependencies.
     */
    public function __construct()
    {
        $this->middleware(['permission:Read Advertisement,admin'])->only('index');
        $this->middleware(['permission:Update Advertisement,admin'])->only('update');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertisement = Advertisement::first() ?? new Advertisement();

        return view('admin.settings.advertisement', compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdvertisementUpdateRequest $request)
    {
        $advertisement = Advertisement::first() ?? new Advertisement();
        $home_top = $this->fileUpload($request, 'home_top_ad_image', $advertisement->home_top_ad_image ? 'uploads/' . $advertisement->home_top_ad_image : null);
        $home_bottom = $this->fileUpload($request, 'home_bottom_ad_image', $advertisement->home_bottom_ad_image ? 'uploads/' . $advertisement->home_bottom_ad_image : null);
        $archive_bottom = $this->fileUpload($request, 'archive_bottom_ad_image', $advertisement->archive_bottom_ad_image ? 'uploads/' . $advertisement->archive_bottom_ad_image : null);
        $news_bottom = $this->fileUpload($request, 'news_bottom_ad_image', $advertisement->news_bottom_ad_image ? 'uploads/' . $advertisement->news_bottom_ad_image : null);
        $sidebar = $this->fileUpload($request, 'sidebar_ad_image', $advertisement->sidebar_ad_image ? 'uploads/' . $advertisement->sidebar_ad_image : null);

        Advertisement::updateOrCreate(
            ['id' => 1],
            [
                'home_top_ad_url' => $request->home_top_ad_url,
                'home_top_ad_image' => !empty($home_top) ? $home_top : $advertisement->home_top_ad_image,
                'home_top_ad_status' => $request->home_top_ad_status == 1 ? 1 : 0,
                'home_bottom_ad_url' => $request->home_bottom_ad_url,
                'home_bottom_ad_image' => !empty($home_bottom) ? $home_bottom : $advertisement->home_bottom_ad_image,
                'home_bottom_ad_status' => $request->home_bottom_ad_status == 1 ? 1 : 0,
                'archive_bottom_ad_url' => $request->archive_bottom_ad_url,
                'archive_bottom_ad_image' => !empty($archive_bottom) ? $archive_bottom : $advertisement->archive_bottom_ad_image,
                'archive_bottom_ad_status' => $request->archive_bottom_ad_status == 1 ? 1 : 0,
                'news_bottom_ad_url' => $request->news_bottom_ad_url,
                'news_bottom_ad_image' => !empty($news_bottom) ? $news_bottom : $advertisement->news_bottom_ad_image,
                'news_bottom_ad_status' => $request->news_bottom_ad_status == 1 ? 1 : 0,
                'sidebar_ad_url' => $request->sidebar_ad_url,
                'sidebar_ad_image' => !empty($sidebar) ? $sidebar : $advertisement->sidebar_ad_image,
                'sidebar_ad_status' => $request->sidebar_ad_status == 1 ? 1 : 0,
            ]
        );

        toast(__('Advertisement updated successfully'), 'success')->width('350')->timerProgressBar();

        return redirect()->route('admin.settings.advertisements');
    }
}
