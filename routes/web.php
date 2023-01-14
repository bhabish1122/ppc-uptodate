<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ImportantFormController;
// use Session;
// use Config;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::match(['get', 'post'], 'register', function(){
//     return redirect('/');
// });
// 
// 

// Route::get('/{lang}', function ($lang) {
	// if (!Session::has('locale'))
	// {
	// 	Session::put('locale',Config::get('np'));
	// }
	// App::setLocale(session('np'));
// $locale = App::getLocale();
// dd($locale);
//     App::setlocale($lang);
    // return Redirect()->back();
    
    // App::setlocale($lang);
    // session()->put('locale', $lang);
    // $ab = session()->get('locale');
    // App::setlocale($ab);
    // var_dump($ab); die();
    // return redirect()->back();
    // var_dump(session());
// })->name('lang.change');



Route::namespace('Web')->prefix('')->name('web.')->middleware(['web','setlocale'])->group(function(){
	Route::get('api/notice','ApiController@index')->name('api.notice.index');
	Route::get('api/notice/save','ApiController@store')->name('api.notice.store');
		Route::get('language/{lang}', 'HomeController@switchLang')->name('LangChange');
		Route::get('band/{lang}', 'HomeController@switchBand')->name('BandChange');
	// ------------------ All Report -----------------------
		Route::get('report', 'ReportController@indexAll')->name('report.all');
		
		Route::get('report/{page}', 'ReportController@index')->name('report.index');
		Route::get('report/{page}/detail/{slug}', 'ReportController@show')->name('report.show');

	// ------------------ About -----------------------
		// background
	    Route::get('about/background', 'AboutController@background')->name('about.background');
	    //vision & mission
	    Route::get('about/mission-vision', 'AboutController@MissionVision')->name('about.mission-vision');
	    //ourobjective
	    Route::get('about/our-objective', 'AboutController@Objective')->name('about.objective');
	    //organization-structure
	    Route::get('about/organization-structure', 'AboutController@organizationStructure')->name('about.organization-structure');// list-of-director-generals
	    Route::get('about/list-of-director-generals', 'AboutController@ListOfDirectorGeneral')->name('about.list-of-director-generals');
	    // Route::get('about/organization-structure/{id}', 'AboutController@ListOfDirectorGeneralShow')->name('about.list-of-director-generals.show');
	    // Route::get('about/list-of-director-generals/{id}', 'AboutController@ListOfDirectorGeneralShow')->name('about.list-of-director-generals.show');
	    // section-detail
	    Route::get('about/section-detail', 'AboutController@sectionDetail')->name('about.section-detail');
	    Route::get('about/section-detail/{id}', 'AboutController@ListOfDirectorGeneralShow')->name('about.list-of-director-generals.show');

	    Route::get('/about/office', 'OfficeController@index')->name('about.office.index');
		Route::get('/about/office/show/{id}', 'OfficeController@show')->name('about.office.show');

	// ------------------ All Division & Section -----------------------
		Route::get('division-section/{page}', 'DivisionSectionController@index')->name('division-section.index');

	// ------------------ All Notice -----------------------
		Route::get('notice/{page}', 'NoticeController@index')->name('notice.index');
		Route::get('notice/{page}/detail/{slug}', 'NoticeController@show')->name('notice.show');

	// ------------------ All Document -----------------------
		Route::get('document/{page}', 'DocumentController@index')->name('document.index');
		Route::get('document/{page}/detail/{slug}', 'DocumentController@show')->name('document.show');

		//important form
		Route::get("importantForm/{page}", ['App\Http\Controllers\Web\ImportantFormController', "index"])->name("important.form.index");
	
	// ------------------ Gallery -----------------------
		// video
		Route::get('gallery/video', 'GalleryVideoController@index')->name('gallery.video.index');
		// image
		Route::get('gallery', 'GalleryController@index')->name('gallery.folder');
		Route::get('gallery/{slug}', 'GalleryController@show')->name('gallery.show');

	// ------------------ Contact -----------------------
		Route::get('contact', 'ContactController@index')->name('contact');

		
	// ------------------ List of projects / programmes -----------------------
		Route::get('list-of-projects-programmes', 'ListOfProjectController@index')->name('list-of-projects-programmes');
		Route::get('list-of-projects-programmes/{slug}', 'ListOfProjectController@show')->name('list-of-projects-programmes.show');

	Route::get('/', 'HomeController@index')->name('welcome');
	Route::get('/rastriya-gaurav-ayojan/', 'HomeController@rastriyaAyojana')->name('rastriyaAyojana.index');
	Route::get('/about-us', 'HomeController@aboutUs')->name('aboutUs.detail');
	Route::get('/search/result', 'SearchController@search')->name('search.result');

	Route::get('/form', 'FormController@index')->name('form.index');
	Route::post('/form/store', 'FormController@store')->name('form.store');

	Route::get('/nagarik-wodapatra', 'NagarikWodapatraController@index')->name('nagarik-wodapatra.index');

	Route::get('/download', 'DownloadController@index')->name('download.index');

	Route::get('/year-program-&-budget', 'YearProgramController@index')->name('year-program-&-budget.index');
	
	Route::get('/sachibalaya', 'AboutController@sachibalaya')->name('sachibalaya');

	Route::get('about/bill', 'AboutController@bill')->name('about.bill');// list-of-director-generals
	


	
	
});


Auth::routes([
	'register' => true
]);
// Route::get('/home', 'HomeController@index')->name('home');
Route::namespace('Admin')->prefix('home')->name('admin.')->middleware(['auth'])->group(function(){
	Route::get('/', 'HomeController@index')->name('home');
	// password
	Route::get('/changepassword','HomeController@showChangePasswordForm')->name('password.index');
	Route::post('change/password/','HomeController@changePassword')->name('change.password');
	// form
	Route::get('/form/complain','FormController@index')->name('form.complain');
	Route::get('/form/suggestion','FormController@suggestion')->name('form.suggestion');
	Route::get('/form/report','FormController@report')->name('form.report');

	//important form
		// Route::get("form/importantForm", [ImportantFormController::class, "index"])->name('important.form');
		Route::get('importantForm/index','ImportantFormController@index')->name('important.form');
		Route::get('importantForm/create','ImportantFormController@create')->name('important.form.create');
		Route::post('importantForm/store', 'ImportantFormController@store')->name('important.form.store');
		
// config routes
		Route::resource('/config','ConfigController');
		Route::get('/config/status/{id}/{status}', 'ConfigController@status')->name('config.status');

	// ------------------ Start -----------------------
		// slider routes
		Route::resource('/welcome/slider','SliderController');
		Route::get('/welcome/slider/status/{id}/{status}', 'SliderController@status')->name('slider.status');
		//ajax
		Route::get('welcome/slider/search/list', 'SliderController@getSliderList')->name('getSliderList');

		// useful link
		Route::resource('/welcome/useful_link','UsefulLinkController');
		Route::get('/welcome/useful_link/status/{id}/{status}', 'UsefulLinkController@status')->name('useful_link.status');

		//ajax
		Route::get('welcome/useful_link/search/list', 'UsefulLinkController@getUsefulLinkList')->name('getUsefulLinkList');

		// about
		Route::resource('/welcome/about','AboutController');
		Route::get('/welcome/about/status/{id}/{status}', 'AboutController@status')->name('about.status');
		//ajax
		Route::get('welcome/about/search/list', 'AboutController@getAboutList')->name('getAboutList');

		// rastriya_gaurav_ayojana 
		Route::resource('/welcome/rastriya_gaurav_ayojana','RastriyaGauravAyojanaController');
		Route::get('/welcome/rastriya_gaurav_ayojana/status/{id}/{status}', 'RastriyaGauravAyojanaController@status');
		Route::post('/welcome/rastriya_gaurav_ayojana/{id}/update', 'RastriyaGauravAyojanaController@update');

		// contact 
		Route::resource('/welcome/contact','ContactController');
		Route::get('/welcome/contact/status/{id}/{status}', 'ContactController@status')->name('contact.status');

		// core_person 
		Route::resource('/welcome/core_person','CorePersonController');
		Route::get('/welcome/core_person/status/{id}/{status}', 'CorePersonController@status')->name('core_person.status');

		//ajax
		Route::get('welcome/core_person/search/list', 'CorePersonController@getCorePersonList')->name('getCorePersonList');
		// Route::post('/welcome/core_person/{id}/update', 'CorePersonController@update');

		// quick_menu 
		Route::resource('/welcome/quick_menu','QuickMenuController');
		Route::get('/welcome/quick_menu/status/{id}/{status}', 'QuickMenuController@status')->name('quick_menu.status');

		//ajax
		Route::get('welcome/quick_menu/search/list', 'QuickMenuController@getQuickMenuList')->name('getQuickMenuList');
		

	// ------------------ About us -----------------------
		// background_slider
		Route::resource('/about/bg_slider','BackgroundSliderController');
		Route::get('/about/background_slider/status/{id}/{status}', 'BackgroundSliderController@status')->name('bg_slider.status');
			//ajax
		Route::get('about/background_slider/search/list', 'BackgroundSliderController@getBackgroundSliderList')->name('getBackgroundSliderList');

		// background 
		Route::resource('/about/background','BackgroundController');
		Route::get('/about/background/status/{id}/{status}', 'BackgroundController@status')->name('background.status');
		
		//ajax
		Route::get('about/background/search/list', 'BackgroundController@getBackgroundList')->name('getBackgroundList');

		// vision 
		Route::resource('/about/vision','VisionController');
		Route::get('/about/vision/status/{id}/{status}', 'VisionController@status')->name('vision.status');
		//ajax
		Route::get('about/vision/search/list', 'VisionController@getVisionList')->name('getVisionList');

		// mission 
		Route::resource('/about/mission','MissionController');
		Route::get('/about/mission/status/{id}/{status}', 'MissionController@status')->name('mission.status');
		//ajax
		Route::get('about/mission/search/list', 'MissionController@getMissionList')->name('getMissionList');

		// objective 
		Route::resource('/about/objective','ObjectiveController');
		Route::get('/about/objective/status/{id}/{status}', 'ObjectiveController@status')->name('objective.status');
		//ajax
		Route::get('about/objective/search/list', 'ObjectiveController@getObjectiveList')->name('getObjectiveList');

		// organizational_structure 
		Route::resource('/about/organizational_structure','OrganizationalStructureController');
		Route::get('/about/organizational_structure/status/{id}/{status}', 'OrganizationalStructureController@status')->name('organizational_structure.status');
		//ajax
		Route::get('about/organizational_structure/search/list', 'OrganizationalStructureController@getOrganizationalStructureList')->name('getOrganizationalStructureList');

		// bill_sarwajanikaran 
		Route::resource('/about/bill_sarwajanikaran','BillSarwajanikaranController');
		Route::get('/about/bill_sarwajanikaran/status/{id}/{status}', 'BillSarwajanikaranController@status')->name('bill_sarwajanikaran.status');
		//ajax
		Route::get('about/bill_sarwajanikaran/search/list', 'BillSarwajanikaranController@getBillSarwajanikaranList')->name('getBillSarwajanikaranList');

		// section_detail 
		Route::resource('/about/section_detail','SectionDetailController');
		Route::get('/about/section_detail/status/{id}/{status}', 'SectionDetailController@status');
		Route::post('/about/section_detail/{id}/update', 'SectionDetailController@update');



	// --------Division and Sections------------------------------------

		// division_section planning program division coordination
		Route::resource('/division_section','DivisionSectionController');
		Route::get('/division_section/status/{id}/{status}', 'DivisionSectionController@status')->name('division_section.status');
		//ajax
		Route::get('division_section/search/list', 'DivisionSectionController@getDivisionSectionList')->name('getDivisionSectionList');


	// --------List of projects------------------------------------

		// list_of_project 
		Route::resource('/list_of_project','ListOfProjectController');
		Route::get('/list_of_project/status/{id}/{status}', 'ListOfProjectController@status');
		Route::post('/list_of_project/{id}/update', 'ListOfProjectController@update');

	// --------Notices------------------------------------

		// notice 
		Route::resource('/notice','NoticeController');
		Route::get('/notice/status/{id}/{status}', 'NoticeController@status')->name('notice.status');
		//ajax
		Route::get('notice/search/list', 'NoticeController@getNoticeList')->name('getNoticeList');

	// --------Documents------------------------------------

		// document 
		Route::resource('/document','DocumentController');
		Route::get('/document/status/{id}/{status}', 'DocumentController@status')->name('document.status');
		//ajax
		Route::get('document/search/list', 'DocumentController@getDocumentList')->name('getDocumentList');

	// --------Report------------------------------------

		// report 
		Route::resource('/report','ReportController');
		Route::get('/report/status/{id}/{status}', 'ReportController@status')->name('report.status');
		// Route::post('/report/{id}/update', 'ReportController@update');
		//ajax
		Route::get('report/search/list', 'ReportController@getReportList')->name('getReportList');

		// citizen_charter 
		Route::resource('/citizen_charter','CitizenCharterController');
		Route::get('/citizen_charter/status/{id}/{status}', 'CitizenCharterController@status')->name('citizen_charter.status');
		//ajax
		Route::get('citizen_charter/search/list', 'CitizenCharterController@getCitizenCharterList')->name('getCitizenCharterList');

	// --------Gallery------------------------------------
		// gallery  
		Route::resource('/gallery','GalleryController');
		Route::get('about/gallery/search/list', 'GalleryController@getGalleryList')->name('getGalleryList');

		Route::get('about/galleryhasimage/search/{id}/list', 'GalleryHasImageController@getGalleryHasImageList')->name('getGalleryHasImageList');
		Route::get('/gallery/status/{id}/{status}', 'GalleryController@status')->name('gallery.status');
		Route::post('/gallery/{id}/update', 'GalleryController@update');

		// gallery image
		Route::resource('/gallery/gallery_has_image','GalleryHasImageController');
		Route::get('/gallery/gallery_has_image/status/{id}/{status}', 'GalleryHasImageController@status')->name('gallery_has_image.status');
		Route::get('/gallery/gallery_has_image/{id}/create', 'GalleryHasImageController@create1')->name('gallery_has_image.create1');
		Route::post('/gallery/gallery_has_image/{id}/update', 'GalleryHasImageController@update');
		Route::get('/gallery/folder/{id}/create','GalleryHasImageController@folderTitle');
		// videogallery 
		Route::resource('/video-gallery','VideoGalleryController');
		Route::get('/video-gallery/status/{id}/{status}', 'VideoGalleryController@status')->name('video-gallery.status');
		//ajax
		Route::get('video-gallery/search/list', 'VideoGalleryController@getVideoGalleryList')->name('getVideoGalleryList');

});
Route::get('/lallal/alla/ssds/sds', 'TestController@index')->name('setLang');