<?php

use Illuminate\Support\Facades\Route;

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
Route::group(["middleware" => ['setLocale']], function () {
    Route::get('/', [\App\Http\Controllers\Home\HomeController::class, 'index'])->name('home.index');
    Route::prefix('/end-user')->name('end-user.')->group(function () {
        Route::resource('/get-code', \App\Http\Controllers\EndUser\GetCode\GetCodeController::class)->only(['store', 'index']);
    });
});

Route::group(["middleware" => ['setLocale']], function () {
    Route::post('/change-locale', [\App\Http\Controllers\System\Locale\LocaleController::class, 'changeLocale'])->name('change.locale');
    Route::group(["middleware" => ['guest']], function () {
        Route::get('/auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'index'])->name('auth.login.index');
        Route::post('/auth/login', [\App\Http\Controllers\Auth\LoginController::class, 'store'])->name('auth.login.store');
        Route::resource('/auth/register', \App\Http\Controllers\License\LicenseController::class)->only(['store', 'index']);
    });

    Route::group(["middleware" => ['auth']], function () {
        Route::post('/auth/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'store'])->name('auth.logout.store');
    });

    Route::prefix('/service')->name('service.')->group(function () {
        Route::prefix('/screen')->name('screen.')->group(function () {
            Route::get('/speaker/{meeting_hall_screen_code}', [\App\Http\Controllers\Service\Screen\SpeakerController::class, 'index'])->name('speaker.index');
            Route::get('/chair/{meeting_hall_screen_code}', [\App\Http\Controllers\Service\Screen\ChairController::class, 'index'])->name('chair.index');
            Route::get('/speaker/event/{meeting_hall_screen_code}', [\App\Http\Controllers\Service\Screen\SpeakerController::class, 'start'])->name('speaker.start');
            Route::get('/keypad/event/{meeting_hall_screen_code}',[ \App\Http\Controllers\Service\Screen\KeypadController::class, 'index'])->name('keypad.index');
            Route::get('/debate/{meeting_hall_screen_code}', [\App\Http\Controllers\Service\Screen\DebateController::class, 'index'])->name('debate.index');
            Route::get('/questions/{meeting_hall_screen_code}', [\App\Http\Controllers\Service\Screen\QuestionsController::class, 'index'])->name('questions.index');
            Route::get('/document/{meeting_hall_screen_code}', [\App\Http\Controllers\Service\Screen\DocumentController::class, 'index'])->name('document.index');
            Route::get('/timer/{meeting_hall_screen_code}', [\App\Http\Controllers\Service\Screen\TimerController::class, 'index'])->name('timer.index');
            Route::get('/questions/event/{meeting_hall_screen_code}', [\App\Http\Controllers\Service\Screen\QuestionsController::class, 'start'])->name('questions.start');
        });
        Route::prefix('/screen-board')->name('screen-board.')->group(function () {
            Route::get('/{code}', [\App\Http\Controllers\Service\ScreenBoardController::class, 'index'])->name('start');
            Route::post('/speaker-screen/{code}', [\App\Http\Controllers\Service\ScreenBoardController::class, 'speaker_screen'])->name('speaker-screen');
            Route::post('/chair-screen/{code}', [\App\Http\Controllers\Service\ScreenBoardController::class, 'chair_screen'])->name('chair-screen');
            Route::post('/keypad-screen/{code}', [\App\Http\Controllers\Service\ScreenBoardController::class, 'keypad_screen'])->name('keypad-screen');
            Route::post('/debate-screen/{code}', [\App\Http\Controllers\Service\ScreenBoardController::class, 'debate_screen'])->name('debate-screen');
            Route::post('/document-screen/{code}', [\App\Http\Controllers\Service\ScreenBoardController::class, 'document_screen'])->name('document-screen');
            Route::post('/timer-screen/{code}/{action}', [\App\Http\Controllers\Service\ScreenBoardController::class, 'timer_screen'])->name('timer-screen');
        });
        Route::get('/question-board/{code}', [\App\Http\Controllers\Service\QuestionBoardController::class, 'index'])->name('question-board.start');
        Route::get('/operator-board/{code}/{program_order}', [\App\Http\Controllers\Service\OperatorBoardController::class, 'index'])->name('operator-board.start');
        Route::group(["middleware" => ['auth']], function () {
            Route::get('/survey-report/{survey}', [\App\Http\Controllers\Service\Screen\SurveyController::class, 'index'])->name('survey-report.start');
            Route::get('/keypad-report/{keypad}', [\App\Http\Controllers\Service\Screen\KeypadController::class, 'index'])->name('keypad-report.start');
            Route::get('/debate-report/{debate}', [\App\Http\Controllers\Service\Screen\DebateController::class, 'index'])->name('debate-report.start');
        });
    });
});

// System routes
Route::get('/get-date-format', [\App\Http\Controllers\System\Setting\Variable\VariableController::class, 'getDateFormat'])->name('get-date-format');
Route::get('/get-time-format', [\App\Http\Controllers\System\Setting\Variable\VariableController::class, 'getTimeFormat'])->name('get-time-format');
// Sms verification routes
Route::group(["middleware" => ['auth', 'setLocale']], function () {
    Route::get('/sms-verification', [\App\Http\Controllers\Auth\VerificationController::class, 'index'])->name('portal.sms-verification.index');
    Route::get('/send-sms', [\App\Http\Controllers\Auth\VerificationController::class, 'resend_code'])->name('portal.send-sms.index');
    Route::post('/sms-verification', [\App\Http\Controllers\Auth\VerificationController::class, 'store'])->name('portal.sms-verification.store');
    Route::patch('/edit-phone', [\App\Http\Controllers\Auth\VerificationController::class, 'edit_phone'])->name('portal.phone.update');
});
Route::prefix('portal')->name('portal.')->group(function () {
    Route::group(["middleware" => ['auth', 'phone.verified', 'setLocale']], function () {
        // Main routes
        Route::get('/', [\App\Http\Controllers\Portal\DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/live-stats', [\App\Http\Controllers\Portal\LiveStatsController::class, 'index'])->name('live-stats.index');
        // Meeting routes
        Route::resource('/meeting', \App\Http\Controllers\Portal\Meeting\MeetingController::class)->except(['create']);
        Route::prefix('meeting')->name('meeting.')->group(function () {
            Route::resource('/{meeting}/document', \App\Http\Controllers\Portal\Meeting\Document\DocumentController::class)->except(['create']);
            Route::resource('/{meeting}/virtual-stand', \App\Http\Controllers\Portal\Meeting\VirtualStand\VirtualStandController::class)->except(['create']);
            Route::resource('/{meeting}/announcement', \App\Http\Controllers\Portal\Meeting\Announcement\AnnouncementController::class)->except(['create']);
            Route::get('/{meeting}/document/download/{document}', [\App\Http\Controllers\Portal\Meeting\Document\DocumentController::class, 'download'])->name('document.download');
            Route::resource('/{meeting}/participant', \App\Http\Controllers\Portal\Meeting\Participant\ParticipantController::class)->except(['create']);
            Route::get('/{meeting}/participant/{participant}/qr-code', [\App\Http\Controllers\Portal\Meeting\Participant\ParticipantController::class, 'qrCode'])->name('participant.qr-code');
            Route::get('/{meeting}/participant/{participant}/send-code-by-email', [\App\Http\Controllers\Portal\Meeting\Participant\ParticipantController::class, 'send_code_by_email'])->name('participant.send-code-by-email');
            Route::get('/{meeting}/participant/{participant}/send-code-via-sms', [\App\Http\Controllers\Portal\Meeting\Participant\ParticipantController::class, 'send_code_via_sms'])->name('participant.send-code-via-sms');
            Route::get('/{meeting}/participant/{participant}/survey/{survey}', [\App\Http\Controllers\Portal\Meeting\Participant\ParticipantController::class, 'showSurvey'])->name('participant.survey');
            Route::resource('/{meeting}/score-game', \App\Http\Controllers\Portal\Meeting\ScoreGame\ScoreGameController::class)->except(['create']);
            Route::prefix('/{meeting}/score-game/{score_game}')->name('score-game.')->group(function () {
                Route::get('/qr-code/{qr_code}/download', [\App\Http\Controllers\Portal\Meeting\ScoreGame\QRCode\QRCodeController::class,'download'])->name('qr-code-download');
                Route::get('/qr-code/{qr_code}/qr-code', [\App\Http\Controllers\Portal\Meeting\ScoreGame\QRCode\QRCodeController::class, 'qrCode'])->name('qr-code.qr-code');
                Route::resource('/qr-code', \App\Http\Controllers\Portal\Meeting\ScoreGame\QRCode\QRCodeController::class)->except(['create', 'show']);
            });
            Route::resource('/{meeting}/survey', \App\Http\Controllers\Portal\Meeting\Survey\SurveyController::class)->except(['create']);
            Route::prefix('/{meeting}/survey/{survey}')->name('survey.')->group(function () {
                Route::resource('/question', \App\Http\Controllers\Portal\Meeting\Survey\Question\QuestionController::class)->except(['create']);
                Route::prefix('/question/{question}')->name('question.')->group(function () {
                    Route::resource('/option', \App\Http\Controllers\Portal\Meeting\Survey\Question\Option\OptionController::class)->except(['create']);
                });
            });
            Route::prefix('{meeting}/report')->name('report.')->group(function () {
                Route::resource('/attendance', \App\Http\Controllers\Portal\Report\Attendance\AttendanceController::class)->only(['index', 'show']);
                Route::resource('/score-game', \App\Http\Controllers\Portal\Report\ScoreGame\ScoreGameController::class)->only(['index', 'show']);
                Route::resource('/question', \App\Http\Controllers\Portal\Report\Question\QuestionController::class)->only(['index', 'show']);
                Route::resource('/survey', \App\Http\Controllers\Portal\Report\Survey\SurveyController::class)->only(['index', 'show']);
                Route::get('/survey/{survey}/report',[\App\Http\Controllers\Portal\Report\Survey\SurveyController::class, 'showReport'])->name('survey');
                Route::get('/survey/{survey}/participants',[\App\Http\Controllers\Portal\Report\Survey\SurveyController::class, 'showParticipants'])->name('survey.participants');
                Route::resource('/keypad', \App\Http\Controllers\Portal\Report\Keypad\KeypadController::class)->only(['index', 'show']);
                Route::get('/keypad/{keypad}/participants',[\App\Http\Controllers\Portal\Report\Keypad\KeypadController::class, 'showParticipants'])->name('keypad.participants');
                Route::get('/keypad/{keypad}/report',[\App\Http\Controllers\Portal\Report\Keypad\KeypadController::class, 'showReport'])->name('keypad.question');
                Route::resource('/debate', \App\Http\Controllers\Portal\Report\Debate\DebateController::class)->only(['index', 'show']);
                Route::get('/debate/{debate}/participants',[\App\Http\Controllers\Portal\Report\Debate\DebateController::class, 'showParticipants'])->name('debate.participants');
                Route::get('/debate/{debate}/report',[\App\Http\Controllers\Portal\Report\Debate\DebateController::class, 'showReport'])->name('debate');
                Route::resource('/registration', \App\Http\Controllers\Portal\Report\Registration\RegistrationController::class)->only(['index']);
            });
            //Logs
            Route::prefix('{meeting}/log')->name('log.')->group(function () {
                Route::resource('/participant', \App\Http\Controllers\Portal\Log\Participant\ParticipantController::class)->only(['index', 'show']);
            });
            Route::resource('/{meeting}/hall', \App\Http\Controllers\Portal\Meeting\Hall\HallController::class)->except(['create']);
            Route::prefix('{meeting}/hall/{hall}/report')->name('hall.report.')->group(function () {
                Route::resource('/session', \App\Http\Controllers\Portal\Report\Session\SessionController::class)->only(['index', 'show']);
                Route::prefix('/session/{session}')->name('session.')->group(function () {
                    Route::resource('/question', \App\Http\Controllers\Portal\Report\Session\Question\QuestionController::class)->only(['index']);
                });
            });
            Route::prefix('/{meeting}/hall/{hall}')->name('hall.')->group(function () {
                Route::resource('/screen', \App\Http\Controllers\Portal\Meeting\Hall\Screen\ScreenController::class)->except(['create']);
                Route::resource('/program', \App\Http\Controllers\Portal\Meeting\Hall\Program\ProgramController::class)->except(['create']);

                Route::prefix('/program/{program}')->name('program.')->group(function () {
                    Route::resource('/debate', \App\Http\Controllers\Portal\Meeting\Hall\Program\Debate\DebateController::class)->except(['index', 'create']);
                    Route::get('/start-stop-debate-voting/{debate}', [\App\Http\Controllers\Portal\Meeting\Hall\Program\Debate\DebateController::class,'start_stop_voting'])->name('debate.start-stop-voting');
                    Route::prefix('/debate/{debate}')->name('debate.')->group(function () {
                        Route::resource('/team', \App\Http\Controllers\Portal\Meeting\Hall\Program\Debate\Team\TeamController::class)->except(['create']);
                    });
                    Route::resource('/chair', \App\Http\Controllers\Portal\Meeting\Hall\Program\Chair\ChairController::class)->except(['create']);
                    Route::resource('/session', \App\Http\Controllers\Portal\Meeting\Hall\Program\Session\SessionController::class)->except(['index', 'create']);
                    Route::get('/start-stop-session/{session}', [\App\Http\Controllers\Portal\Meeting\Hall\Program\Session\SessionController::class,'start_stop'])->name('session.start-stop');
                    Route::get('/start-stop-session-questions/{session}', [\App\Http\Controllers\Portal\Meeting\Hall\Program\Session\SessionController::class,'start_stop_questions'])->name('session.start-stop-questions');
                    Route::get('/start-stop-session-questions/{session}/{increment}', [\App\Http\Controllers\Portal\Meeting\Hall\Program\Session\SessionController::class,'edit_question_limit'])->name('session.edit-question-limit');
                    Route::prefix('/session/{session}')->name('session.')->group(function () {
                        Route::resource('/keypad', \App\Http\Controllers\Portal\Meeting\Hall\Program\Session\Keypad\KeypadController::class)->except(['index', 'create']);
                        Route::resource('/question', \App\Http\Controllers\Portal\Meeting\Hall\Program\Session\Question\QuestionController::class)->only(['destroy']);
                        Route::get('/start-stop-keypad-voting/{keypad}', [\App\Http\Controllers\Portal\Meeting\Hall\Program\Session\Keypad\KeypadController::class,'start_stop_voting'])->name('keypad.start-stop-voting');
                        Route::get('/resend-keypad-voting/{keypad}', [\App\Http\Controllers\Portal\Meeting\Hall\Program\Session\Keypad\KeypadController::class,'resend_voting'])->name('keypad.resend-voting');
                        Route::prefix('/keypad/{keypad}')->name('keypad.')->group(function () {
                            Route::resource('/option', \App\Http\Controllers\Portal\Meeting\Hall\Program\Session\Keypad\Option\OptionController::class)->except(['create']);
                        });
                    });
                });
            });
        });
        Route::get('/user/{user}/get-phone', [\App\Http\Controllers\Portal\User\UserController::class, 'get_phone'])->name('user.get-phone')->withoutMiddleware('phone.verified');
        Route::resource('/user-role', \App\Http\Controllers\Portal\User\Role\RoleController::class)->except(['create']);
        Route::resource('/user', \App\Http\Controllers\Portal\User\UserController::class)->except(['create']);
        Route::resource('/setting', \App\Http\Controllers\Portal\Setting\SettingController::class)->only(['index', 'update']);
        
        // Language routes
        Route::resource('/language', \App\Http\Controllers\Portal\Language\LanguageController::class);
        Route::get('/language/{language}/translations', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'translations'])->name('language.translations');
        Route::post('/language/{language}/translations', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'updateTranslation'])->name('language.translations.update');
        Route::post('/language/{language}/add-missing-keys', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'addMissingKeys'])->name('language.add-missing-keys');
        Route::post('/language/{language}/auto-translate', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'autoTranslate'])->name('language.auto-translate');
        Route::get('/language/{language}/list-empty-translations', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'listEmptyTranslations'])->name('language.list-empty-translations');
        Route::get('/language/{language}/export', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'export'])->name('language.export');
        Route::get('/language/{language}/export-excel', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'exportExcel'])->name('language.export-excel');
        Route::post('/language/{language}/import', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'import'])->name('language.import');
        Route::post('/language/{language}/import-csv', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'importCsv'])->name('language.import-csv');
        
        // AJAX routes for enhanced translation management
        Route::post('/language/{language}/save-original-text', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'saveOriginalText'])->name('language.save-original-text');
        Route::post('/language/{language}/auto-translate-key', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'autoTranslateKey'])->name('language.auto-translate-key');
        Route::delete('/language/{language}/delete-key', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'deleteKey'])->name('language.delete-key');
        Route::post('/language/{language}/translations-ajax', [\App\Http\Controllers\Portal\Language\LanguageController::class, 'updateTranslationAjax'])->name('language.translations.update-ajax');
        
        Route::get('/session-question-on-screen/{id}', [\App\Http\Controllers\Portal\Meeting\Hall\Program\Session\Question\QuestionController::class,'on_screen'])->name('session-question.on-screen');
    });
});

// Pusher Test Page
// Route::get('/test/pusher', function () {
//     return view('tests.pusher');
// });

Route::get('/test-locale', function () {
    // Session'dan locale'i kaldır
    session()->forget('locale');
    
    // Locale'i Türkçe'ye ayarla
    session()->put('locale', 'tr');
    app()->setLocale('tr');
    
    return "Locale: " . app()->getLocale() . "<br>" . 
           "Translation: " . __('common.live-stats') . "<br>" .
           "Session locale: " . session()->get('locale', 'not set');
});
