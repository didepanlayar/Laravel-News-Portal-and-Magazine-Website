<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class LocalizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function backendIndex()
    {
        $languages = Language::all();
        $translatedValues = [];

        foreach ($languages as $language) {
            $path = lang_path($language->language . "/backend.php");

            if (file_exists($path)) {
                $trans = Lang::get('backend', [], $language->language);
                $translatedValues[$language->language] = is_array($trans) ? $trans : [];
            } else {
                $translatedValues[$language->language] = [];
            }
        }

        return view('admin.localizations.backend', compact('languages', 'translatedValues'));
    }

    /**
     * Display a listing of the resource.
     */
    public function frontendIndex()
    {
        $languages = Language::all();
        $translatedValues = [];

        foreach ($languages as $language) {
            $path = lang_path($language->language . "/frontend.php");

            if (file_exists($path)) {
                $trans = Lang::get('frontend', [], $language->language);
                $translatedValues[$language->language] = is_array($trans) ? $trans : [];
            } else {
                $translatedValues[$language->language] = [];
            }
        }

        return view('admin.localizations.frontend', compact('languages', 'translatedValues'));
    }

    /**
     * Generate string of the resource.
     */
    public function generateString(Request $request)
    {
        try {
            $directory = $request->directory;
            $language = $request->language;
            $fileName = $request->file;

            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

            $localizationStrings = [];

            // Iterate over each file in the directory
            foreach ($files as $file) {
                if ($file->isDir()) {
                    continue;
                }

                $contents = file_get_contents($file->getPathname());

                preg_match_all('/__\([\'"](.+?)[\'"]\)/', $contents, $matches);

                if (!empty($matches[1])) {
                    foreach ($matches[1] as $match) {
                        $localizationStrings[$match] = $match;
                    }
                }
            }

            $phpArray = "<?php\n\nreturn " . var_export($localizationStrings, true) . ";\n";

            // Create a language subfolder if it doesn't already exist
            if (!File::isDirectory(lang_path($language))) {
                File::makeDirectory(lang_path($language), 0755, true);
            }

            // Save to file
            file_put_contents(lang_path($language . '/' . $fileName . '.php'), $phpArray);

            toast(__('Generate successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $e) {
            toast($e, 'error')->width('350')->timerProgressBar();
        }

        return redirect()->back();
    }
}
