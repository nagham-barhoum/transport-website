<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CarTypesController;
use App\Http\Controllers\EntsorgungController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UmzugeController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TransportsController;
use App\Http\Middleware\VisitMiddleware;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

Route::get('/svgs/home1', function () {
    return response()->view('layout.svgs.home1')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/home2', function () {
    return response()->view('layout.svgs.home2')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/home3', function () {
    return response()->view('layout.svgs.home3')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung1', function () {
    return response()->view('layout.svgs.entsorgung1')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung2', function () {
    return response()->view('layout.svgs.entsorgung2')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung3', function () {
    return response()->view('layout.svgs.entsorgung3')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung4', function () {
    return response()->view('layout.svgs.entsorgung4')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung5', function () {
    return response()->view('layout.svgs.entsorgung5')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung6', function () {
    return response()->view('layout.svgs.entsorgung6')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung7', function () {
    return response()->view('layout.svgs.entsorgung7')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung8', function () {
    return response()->view('layout.svgs.entsorgung8')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung9', function () {
    return response()->view('layout.svgs.entsorgung9')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung10', function () {
    return response()->view('layout.svgs.entsorgung10')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung11', function () {
    return response()->view('layout.svgs.entsorgung11')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung12', function () {
    return response()->view('layout.svgs.entsorgung12')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/entsorgung13', function () {
    return response()->view('layout.svgs.entsorgung13')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/transport1', function () {
    return response()->view('layout.svgs.transport1')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/transport2', function () {
    return response()->view('layout.svgs.transport2')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/transport3', function () {
    return response()->view('layout.svgs.transport3')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/transport4', function () {
    return response()->view('layout.svgs.transport4')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/transport5', function () {
    return response()->view('layout.svgs.transport5')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/transport6', function () {
    return response()->view('layout.svgs.transport6')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/home4', function () {
    return response()->view('layout.svgs.home4')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/home5', function () {
    return response()->view('layout.svgs.home5')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/home6', function () {
    return response()->view('layout.svgs.home6')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/home7', function () {
    return response()->view('layout.svgs.home7')->header('Content-Type', 'image/svg+xml');
});
Route::get('/svgs/menu', function () {
    return response()->view('layout.svgs.menu')->header('Content-Type', 'image/svg+xml');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/car_type/getAll',[CarTypesController::class,'index']);
Route::post('/feedback-email', [FeedbackController::class, 'feedbackEmail']);

Route::get('/umzugePdf1', [PDFController::class, 'ViewPdfTest']);

Route::post('/UmzugeRequest1', [UmzugeController::class, 'UmzugeRequest1']);

Route::get('/view-pdf-test', [PdfController::class, 'ViewPdfTest']);

Route::get('/entsorgung', [EntsorgungController::class, 'entsorgung']);

// view by id
Route::get('/viewentsorgung', [EntsorgungController::class, 'EntsorgungV2View']);

Route::post('/EntsorgungRequest', [EntsorgungController::class, 'EntsorgungRequest']);
Route::post('/EntsorgungV2Request', [EntsorgungController::class, 'EntsorgungV2Request']);

Route::get('/transport',[TransportsController::class,'index']);
Route::post('/TransportRequest', [TransportsController::class, 'TransportRequest']);

Route::get('/impressum', function () {
   return view('IMPRESSUM');
});

// start  umzuge
Route::get('/createumzuge', function () {
    return view('umzuge/umzuge');
});
Route::middleware([VisitMiddleware::class])->group(function () {
    Route::get('/', function () {
        return view('index');
    });



    Route::get('/umzugsfirma-Weil-am-Rhein', function () {
        return view('index');
     });
     Route::get('/umzugsunternehmen', function () {
        return view('index');
     });
     Route::get('/umzüge-lörrach', function () {
        return view('index');
     });
      Route::get('/transportdienstleistungen-waldshut-tiengen', function () {
         return view('index');
      });
      Route::get('/entrümpelungsdienst-freiburg', function () {
         return view('index');
      });
      Route::get('/professionelle-umzugsdienst', function () {
         return view('index');
      });
      Route::get('/schneller-und-sicherer-transport', function () {
         return view('index');
      });
      Route::get('/zuverlässige-entrümpelung-in-lörrach', function () {
         return view('index');
      });
      Route::get('/effiziente-bürorelokationen', function () {
         return view('index');
      });
      Route::get('/sichere-einlagerungslösungen', function () {
         return view('index');
      });

     Route::get('/umzugsunternehmen-weil-am-rhein', function () {
        return view('index');
     });
     Route::get('/günstige-umzüge-lörrach', function () {
        return view('index');
     });
     Route::get('/günstige-umzüge-freiburg', function () {
        return view('index');
     });
     Route::get('/günstige-umzüge-weil-am-rhein', function () {
        return view('index');
     });
     Route::get('/günstige-umzüge', function () {
        return view('index');
     });
     Route::get('/deutsche-umzugsfirma', function () {
        return view('index');
     });
     Route::get('/möbel-montage', function () {
        return view('index');
     });
     Route::get('/möbel-montage-lörrach', function () {
        return view('index');
     });
     Route::get('/möbel-montage-freiburg', function () {
        return view('index');
     });
     Route::get('/möbel-montage-weil-am-rhein', function () {
        return view('index');
     });
     Route::get('/küchenaufbau-lörrach', function () {
        return view('index');
     });
     Route::get('/küchenaufbau-freiburg', function () {
        return view('index');
     });
     Route::get('/küchenaufbau-weil-am-rhein', function () {
        return view('index');
     });
     Route::get('/umzug-dreiländereck-malerarbeiten-lörrach', function () {
        return view('index');
     });
     Route::get('/malerarbeiten-freiburg', function () {
        return view('index');
     });
     Route::get('/malerarbeiten-weil-am-rhein', function () {
        return view('index');
     });
     Route::get('/kosten-umzug', function () {
        return view('index');
     });
     Route::get('/kosten-malerarbeiten', function () {
        return view('index');
     });
     Route::get('/kosten-möbel-montage', function () {
        return view('index');
     });
     Route::get('/kosten-küchenaufbau', function () {
        return view('index');
     });
     Route::get('/umzugshelfer', function () {
        return view('index');
     });
     Route::get('/umzugshelfer-lörrach', function () {
        return view('index');
     });
     Route::get('/umzugshelfer-weil-am-rhein', function () {
        return view('index');
     });
     Route::get('/umzugshelfer-freiburg', function () {
        return view('index');
     });
     Route::get('/umzugshelfer-dreiländereck', function () {
        return view('index');
     });
     Route::get('/schnelles-angebot-umzug', function () {
        return view('index');
     });
     Route::get('/umzugsfirma-lörrach-kosten', function () {
        return view('index');
     });
     Route::get('/umzug-in-der-nähe', function () {
        return view('index');
     });
     Route::get('/umzugskartons', function () {
        return view('index');
     });
     Route::get('/umzugskartons-mieten', function () {
        return view('index');
     });
     Route::get('/umzugsunternehmen-lörrach-und-umgebung', function () {
        return view('index');
     });
     Route::get('/umzugsunternehmen-lörrach-kosten', function () {
        return view('index');
     });
     Route::get('/umzugsunternehmen-lörrach-preise', function () {
        return view('index');
     });
     Route::get('/günstige-umzugsfirma-lörrach-günstige-umzugsunternehmen-lörrach', function () {
        return view('index');
     });
     Route::get('/bekannte-umzugsfirma-lörrach', function () {
        return view('index');
     });
     Route::get('/umzugsfirma-lorrach', function () {
        return view('index');
     });
         Route::get('/{type}', function ($type) {
        // Define an array of specific words that should redirect to the blog page
        $file = File::get(storage_path('/app/blog.json'));
        $data = json_decode($file,true);
        $blog = collect(Arr::get($data, 'blogs', []))->first(function ($blog) use ($type) { return $blog['route'] === $type; });
        if ($blog) {
            return view('blogs.blog', compact('blog'));
        }
          abort(404);
    })->name('blog');
});






// umzug SEO

// Need SEO


// end umzuge
Route::group([
    'prefix' => 'commands',
], function () {
    Route::get('storageLink', function () {
        Artisan::call('storage:link', []);
        abort(404, '❌❌❌');
    });
});
