<?php

use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminAgentsController;
use App\Http\Controllers\Admin\AdminSlidersController;
use App\Http\Controllers\Admin\AdminStatesController;
use App\Http\Controllers\Admin\AdminCitiesController;
use App\Http\Controllers\Admin\AdminAreasController;
use App\Http\Controllers\Admin\AdminProjectsController;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminFloorsController;
use App\Http\Controllers\Admin\AdminUnitsController;
use App\Http\Controllers\Admin\AdminBlogsController;
use App\Http\Controllers\Admin\AdminSubmittedUnitsController;
use App\Http\Controllers\frontend\UnitsController;
use App\Http\Controllers\frontend\SubmittedUnitsController;
use App\Http\Controllers\frontend\BlogsController;
use App\Http\Controllers\frontend\CommentsController;
use App\Http\Controllers\frontend\NewsLetterController;
use App\Http\Controllers\Auth\GoogleController;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/units',[UnitsController::class,'index'])->name('units');
Route::get('/units/orderby',[UnitsController::class,'index'])->name('units.orderby');
Route::get('/units/per-page/',[UnitsController::class,'perpageitems']);
Route::get('/units/smart-search',[UnitsController::class,'smart_search'])->name('units.smart-search');
Route::get('/unit/view/{id}',[UnitsController::class,'show'])->name('unit.show');
Route::get('/unit/rate/{id}',[UnitsController::class,'rate'])->name('unit.rate');

Route::get('/blogs',[BlogsController::class,'index'])->name('blogs');
Route::get('/blog/show/{id}',[BlogsController::class,'show'])->name('blog.show');
Route::post('/post/comment',[CommentsController::class,'store'])->name('comment.post');
Route::get('/load_more-comment',[CommentsController::class,'index'])->name('load.comments');


Route::get('/about-us',[HomeController::class,'about_us'])->name('about_us');
Route::get('/contact-us',[HomeController::class,'contact'])->name('contact');
Route::get('/terms-conditions',[HomeController::class,'terms_conditions']);
Route::get('/privacy-policy',[HomeController::class,'privacy_policy']);
Route::post('/message-send',[HomeController::class,'messageSend'])->name('message.send');
Route::post('/newsletter-subscribe',[NewsLetterController::class,'store'])->name('subscribe');


Route::get('/auth/facebook', function () {
    return Socialite::driver('facebook')->redirect();
})->name('auth.facebook');

Route::get('/auth/facebook/callback', function () {
    $facebookUser = Socialite::driver('facebook')->stateless()->user();

    $user = User::firstOrCreate(
        ['email' => $facebookUser->getEmail()],
        [
            'name' => $facebookUser->getName(),
            'password' => bcrypt(Str::random(16)), // Dummy password
            'facebook_id' => $facebookUser->getId()
        ]
    );

    Auth::login($user);

    return redirect('/'); // or wherever you want
});

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/unit/submit/form',[SubmittedUnitsController::class,'create'])->name('unit.form');
    Route::get('city/find/{id}', [SubmittedUnitsController::class, 'city_find']);
    Route::get('area/find/{id}', [SubmittedUnitsController::class, 'area_find']);
    Route::post('/unit/formsubmit',[SubmittedUnitsController::class,'store'])->name('unit.formsubmit');
    Route::get('/my/units',[SubmittedUnitsController::class,'index'])->name('user.units');    
    Route::get('/myunits/per-page/',[SubmittedUnitsController::class,'perpageitems']);    
    Route::get('/myunit/edit/{id}',[SubmittedUnitsController::class,'edit'])->name('user.unit.update');    
    Route::get('/myunit/view/{id}',[SubmittedUnitsController::class,'show'])->name('user.unit.show');
    Route::post('/myunit/update/{id}',[SubmittedUnitsController::class,'update'])->name('unit.updateformsubmit');    
    Route::get('/myunit/delete/{id}',[SubmittedUnitsController::class,'destroy'])->name('user.unit.delete');    
});

Route::prefix('admin')->name('admin.')->group(function(){

    // Routes that require an authenticated admin user
    Route::middleware('admin')->group(function(){
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');


        //Admin Customers Routes start
        Route::get('/users',[AdminUsersController::class,'index'])->name('users');
        Route::get('/user-delete/{id}',[AdminUsersController::class,'delete'])->name('user.delete');
        Route::get('/user-deleteall',[AdminUsersController::class,'deleteall'])->name('users.delete');
        //Admin Customers Routes end

        //Admin Agents Routes

        Route::get('/agents', [AdminAgentsController::class, 'index'])->name('agents');
        Route::post('/agents/store',[AdminAgentsController::class,'register'])->name('agent.register');
        Route::get('/agent/remove/{id}',[AdminAgentsController::class,'remove'])->name('agent.remove');
        Route::get('/agent/removeall/',[AdminAgentsController::class,'removeall'])->name('agents.remove');

        //Admin Agents Routes end

        //Admin Slider Routes

        Route::get('/sliders', [AdminSlidersController::class, 'index'])->name('sliders');
        Route::post('/sliders/store',[AdminSlidersController::class,'store'])->name('slider.store');
        Route::get('/slider/delete/{id}',[AdminSlidersController::class,'delete'])->name('slider.delete');

        //Admin Slider Routes end


        //Admin States Routes

        Route::get('/states', [AdminStatesController::class, 'index'])->name('states');
        Route::post('/states/store',[AdminStatesController::class,'store'])->name('state.store');
        Route::get('/state/delete/{id}',[AdminStatesController::class,'delete'])->name('state.delete');

        //Admin States Routes end

        //Admin Cities Routes

        Route::get('/cities', [AdminCitiesController::class, 'index'])->name('cities');
        Route::post('/city/store',[AdminCitiesController::class,'store'])->name('city.store');
        Route::get('/city/delete/{id}',[AdminCitiesController::class,'delete'])->name('city.delete');

        //Admin Cities Routes end        


        //Admin Areas Routes

        Route::get('/areas', [AdminAreasController::class, 'index'])->name('areas');
        Route::post('/area/store',[AdminAreasController::class,'store'])->name('area.store');
        Route::get('/area/delete/{id}',[AdminAreasController::class,'delete'])->name('area.delete');

        //Admin Areas Routes end 

        //Admin Projects Routes

        Route::get('/projects', [AdminProjectsController::class, 'index'])->name('projects');
        Route::get('/project/floors/{id}', [AdminProjectsController::class, 'floors'])->name('project.floors');
        Route::get('/project/units/{id}', [AdminProjectsController::class, 'units'])->name('project.units');
        Route::get('/project/city/find/{id}', [AdminProjectsController::class, 'city_find']);
        Route::get('/project/area/find/{id}', [AdminProjectsController::class, 'area_find']);
        Route::post('/project/store',[AdminProjectsController::class,'store'])->name('project.store');
        Route::post('/project/edit/{id}',[AdminProjectsController::class,'update'])->name('project.update');
        Route::get('/project/delete/{id}',[AdminProjectsController::class,'delete'])->name('project.delete');
        Route::get('/project/all/delete/',[AdminProjectsController::class,'deleteall'])->name('projects.delete');

        //Admin Projects Routes end

        //Admin Floors Routes

        Route::get('/floors', [AdminFloorsController::class, 'index'])->name('floors');
        Route::get('/project/maxfloor/find/{id}',[AdminFloorsController::class,'floor_find']);
        Route::post('/floor/store',[AdminFloorsController::class,'store'])->name('floor.store');
        Route::post('/floor/update/{id}',[AdminFloorsController::class,'update'])->name('floor.update');
        Route::get('/floor/units/{id}',[AdminFloorsController::class,'units'])->name('floor.units');
        Route::get('/floor/delete/{id}',[AdminFloorsController::class,'delete'])->name('floor.delete');
        Route::get('/floors/all/delete',[AdminFloorsController::class,'deleteall'])->name('floors.delete');
        

        //Admin Floors Routes end

        //Admin units Routes

        Route::get('/units', [AdminUnitsController::class, 'index'])->name('units');
        Route::get('/floor/find/{id}', [AdminUnitsController::class, 'floor_find']);
        Route::get('/maxarea/find/{id}', [AdminUnitsController::class, 'area_find']);
        Route::post('/unit/store',[AdminUnitsController::class,'store'])->name('unit.store');
        Route::post('/unit/update/{id}',[AdminUnitsController::class,'update'])->name('unit.update');
        Route::get('/unit/brochure/viewpdf/{id}', [AdminUnitsController::class, 'viewPDF'])->name('unit.brochure.view');
        Route::get('/unit/delete/{id}',[AdminUnitsController::class,'delete'])->name('unit.delete');
        Route::get('/units/all/delete',[AdminUnitsController::class,'deleteall'])->name('units.delete');
        
        //Admin units Routes end

        //Admin userunits Routes start
        Route::get('/userunits',[AdminSubmittedUnitsController::class,'index'])->name('userunits');
        Route::get('/userunit-delete/{id}',[AdminSubmittedUnitsController::class,'destroy'])->name('userunit.delete');
        Route::get('/userunits-remove',[AdminSubmittedUnitsController::class,'destroyall'])->name('userunits.delete');
        //Admin userunits Routes end

        //Admin blogs Routes start
        Route::get('/blogs',[AdminBlogsController::class,'index'])->name('blogs');        
        Route::post('/blog/store',[AdminBlogsController::class,'store'])->name('blog.store');        
        Route::get('/blog/comments/{id}',[AdminBlogsController::class,'comments'])->name('blog.comments');        
        Route::get('/blog/comment/delete/{id}',[AdminBlogsController::class,'comment_delete'])->name('blog.comment.delete');        
        Route::get('/blog/delete/{id}',[AdminBlogsController::class,'delete'])->name('blog.delete');        
        Route::get('/blogs/delete',[AdminBlogsController::class,'deleteall'])->name('blogs.delete');        
        //Admin blogs Routes end        

        Route::get('/rates',[AdminUnitsController::class,'ratedunits'])->name('ratedunits');
        Route::get('/rate/delete/{id}',[AdminUnitsController::class,'ratedunitdelete'])->name('ratedunit.delete');
        Route::get('/rate/delete-all',[AdminUnitsController::class,'ratedunitsdelete'])->name('ratedunits.delete');
        Route::get('/newsletters',[AdminController::class,'newsletters'])->name('newsletter');
        Route::get('/newsletter/delete/{id}',[AdminController::class,'newsletterdelete'])->name('newsletter.delete');
        Route::get('/newsletters/delete',[AdminController::class,'newsletterdeleteall'])->name('newsletters.delete');

        Route::get('/messages',[AdminController::class,'messages'])->name('messages');
        Route::get('/message/status/update/{id}',[AdminController::class,'changestatus']);
        Route::get('/message/delete/{id}',[AdminController::class,'delete'])->name('message.delete');
        Route::get('/messages/delete',[AdminController::class,'deleteall'])->name('messages.delete');

        Route::get('/settings', [AdminSettingsController::class,'index'])->name('settings');
        Route::post('/settings/store', [AdminSettingsController::class,'store'])->name('settings.store');
        Route::post('/settings/update', [AdminSettingsController::class,'update'])->name('settings.update');
        Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    });

    // Routes for login and logout that require the user to NOT be authenticated
    Route::middleware('admin_auth')->group(function(){
        Route::get('/login', [AdminController::class, 'showLoginForm'])->middleware('admin_token')->name('login');
        Route::post('/login', [AdminController::class, 'login'])->name('login');
    });
});

Route::get('/test',function(){

    return dd(base_path());
});

require __DIR__.'/auth.php';
