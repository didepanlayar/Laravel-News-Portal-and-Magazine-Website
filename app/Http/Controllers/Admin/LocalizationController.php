<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
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
            $directories = explode(',', $request->directory);
            $language = $request->language;
            $fileName = $request->file;

            $localizationStrings = [];
            
            foreach ($directories as $directory) {
                $directory = trim($directory);
                $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

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
            }

            $phpArray = "<?php\n\nreturn " . var_export($localizationStrings, true) . ";\n";

            // Create a language subfolder if it doesn't already exist
            if (!File::isDirectory(lang_path($language))) {
                File::makeDirectory(lang_path($language), 0755, true);
            }

            // Save to file
            file_put_contents(lang_path($language . '/' . $fileName . '.php'), $phpArray);

            toast(__('backend.Generate successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $e) {
            toast($e, 'error')->width('350')->timerProgressBar();
        }

        return redirect()->back();
    }

    /**
     * Update string of the resource.
     */
    public function updateString(Request $request)
    {
        try {
            $localizationStrings = trans($request->file, [], $request->language);
            $localizationStrings[$request->key] = $request->value;

            $phpArray = "<?php\n\nreturn " . var_export($localizationStrings, true) . ";\n";

            // Save to file
            file_put_contents(lang_path($request->language .'/'. $request->file . '.php'), $phpArray);  

            toast(__('backend.Translation updated successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $e) {
            toast($e, 'error')->width('350')->timerProgressBar();
        }

        return redirect()->back();
    }

    /**
     * Translate string of the resource.
     */
    public function translateString(Request $request)
    {
        try {
            $language = $request->language;

            // Get localization stings from file
            $localizationStrings = trans($request->file, [], $language);

            // Get key from localization strings
            $keyStrings = array_keys($localizationStrings);

            // Implode key strings
            $text = implode(' | ', $keyStrings);

            // Google Translate API
            $response = Http::withHeaders(
                [
                    'x-rapidapi-host' => 'google-translate113.p.rapidapi.com',
                    'x-rapidapi-key' => 'ca62ceed52msh22514d79fe76e9ep1f733djsne313e816d6f9',
                    'Content-Type' => 'application/json',
                ]
            )->post(
                'https://google-translate113.p.rapidapi.com/api/v1/translator/text',
                [
                    'from' => 'auto',
                    'to' => $language,
                    'text' => $text
                ]
            );

            // Get response
            $trans = json_decode($response->body())->trans;

            // Explode response
            $transStrings = explode(' | ', $trans);

            // Combine keys and values
            $updatedArray = array_combine($keyStrings, $transStrings);

            $phpArray = "<?php\n\nreturn " . var_export($updatedArray, true) . ";\n";

            // Save to file
            file_put_contents(lang_path($language .'/'. $request->file . '.php'), $phpArray);

            toast(__('backend.Translated successfully'), 'success')->width('350')->timerProgressBar();
        } catch (\Throwable $e) {
            toast($e, 'error')->width('350')->timerProgressBar();
        }

        return redirect()->back();
    }
}
