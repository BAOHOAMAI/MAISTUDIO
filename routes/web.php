    <?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\Frontend\PageHomeController;
    use App\Http\Controllers\Frontend\AccountController;
    use App\Http\Controllers\Frontend\HistoryController;
    use App\Http\Controllers\Frontend\UserLoginController;
    use App\Http\Controllers\Frontend\SearchController;
    use App\Http\Controllers\Frontend\TopFilmController;
    use App\Http\Controllers\Frontend\PageGenreController;
    use App\Http\Controllers\Frontend\FilmController;
    use App\Http\Controllers\Frontend\FavouriteController;
    // ADMIN
    use App\Http\Controllers\Admin\AdminCategoryController;
    use App\Http\Controllers\Admin\AdminnController;
    use App\Http\Controllers\Admin\EpisodeController;
    use App\Http\Controllers\Admin\GenreController;
    use App\Http\Controllers\Admin\MovieController;
    use App\Http\Controllers\Admin\LeechMovieController;
    use App\Http\Controllers\HomeController;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider and all of them will
    | be assigned to the "web" middleware group. Make something great!
    |
    */

    //  KHÔNG CẦN LOGIN VẪN DÙNG ĐƯỢC


    Route::get('/', [PageHomeController::class, 'main'])->name('main');
    Route::get('/search', [SearchController::class, 'getSearch'])->name('search');
    Route::post('/search', [SearchController::class, 'postSearch'])->name('postsearch');
    Route::post('/search/filter', [SearchController::class, 'filterSearch'])->name('filter');

    Route::get('/film/{slug}', [FilmController::class, 'getFilm'])->name('film');

    Route::get('/watch/{slug}/{ep}', [FilmController::class, 'filmWatch'])->name('filmWatch');


    Route::group([
    'prefix' => 'member',
    ], function () {
    Route::get('/login', [UserLoginController::class, 'getLogin'])->name('userlogin');
    Route::post('/login', [UserLoginController::class, 'postLogin'])->name('postlogin');
    Route::post('/register', [UserLoginController::class, 'postRegister'])->name('post-register');
    });


    Route::group([
            'prefix' => 'TopFilm',
        ], function () {
            Route::get('/', [TopFilmController::class, 'getTopFilm'])->name('topall');
    });

    Route::group([
            'prefix' => 'category',
        ], function () {
            Route::get('/', [PageGenreController::class, 'getCategory'])->name('category');
            Route::get('/{slug}', [PageGenreController::class, 'categorySelect'])->name('categorySelect');
    });

    Route::group([
            'prefix' => 'genree',
        ], function () {
            Route::get('/{slug}', [PageGenreController::class, 'genreSelect'])->name('genreSelect');
    });


    // LOGINNN !! 
    
    Route::get('member/logout', [UserLoginController::class, 'logout'])->name('userlogout');
    Route::post('/watch/{slug}/{ep}/fetch', [FilmController::class, 'fetch_data_comment'])->name('fetchcom');
    Route::post('/film/{slug}/fetch', [FilmController::class, 'fetch_data'])->name('fetch');
    Route::post('/sendcomment', [FilmController::class, 'sendcomment'])->name('sendcomment');
    Route::post('/rating', [FilmController::class, 'rating'])->name('rating');
    Route::post('/favourite/add', [FavouriteController::class, 'addFavourite'])->name('addfavou');
    Route::post('/favourite/delete', [FavouriteController::class, 'destroy'])->name('deletefavou');


    Route::group([
            'middleware' => 'member',
        ], function () {
        Route::group([
            'prefix' => 'account',
        ], function () {
            Route::get('/', [AccountController::class, 'getAccount'])->name('account');
            Route::post('/update-user', [AccountController::class, 'updateUser'])->name('update-user');
            Route::get('/history', [HistoryController::class, 'getHistory'])->name('history');
            Route::get('/favourite', [FavouriteController::class, 'getFavourite'])->name('favourite');
            Route::post('/favourite/filter', [FavouriteController::class, 'filterFav'])->name('filfavourite');
        });

    });


    // ADMIN ROUTE
    Auth::routes();

        Route::get('admin/logout', [HomeController::class, 'logout'])->name('logout');
        Route::get('/home', [HomeController::class, 'index'])->name('home');   
        Route::get('/leech', [LeechMovieController::class, 'index'])->name('leech');   
        Route::get('/leech_detail/{slug}', [LeechMovieController::class, 'leech_detail'])->name('leech_detail');   
        Route::post('/addleech/{slug}', [LeechMovieController::class, 'leech_add'])->name('addleech');   
        Route::post('/getpage', [LeechMovieController::class, 'getpage'])->name('getpage');   

    Route::group([
            'middleware' => 'admin',
        ], function () {    

        Route::resource('admincategory', AdminCategoryController::class);
        Route::resource('genre', GenreController::class);
        Route::resource('movie', MovieController::class);
        Route::resource('episode', EpisodeController::class);
        Route::get('add-episode/{id}', [EpisodeController::class, 'add_episode'])->name('add_episode');
    });


