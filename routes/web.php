<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\HomeController;

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

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación
require __DIR__.'/auth.php';

// Ruta de login personalizada (si necesitas mantenerla)
Route::post('/login', function (Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],  // Asegúrate que coincide con tu formulario
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->remember)) {  // Incluye el "remember me"
        $request->session()->regenerate();
        return redirect()->route('dashboard');  // Redirección directa
    }

    return back()->withErrors([
        'email' => 'Las credenciales proporcionadas no son correctas.',
    ])->onlyInput('email');
})->name('login.post');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Gestión de empleados
    Route::prefix('empleados')->group(function () {
        Route::get('/', function () {
            $employees = [
                ['id' => 1, 'name' => 'Ana Torres', 'position' => 'Gerente de RRHH', 'department' => 'Recursos Humanos', 'hire_date' => '2015-03-10', 'remaining_vacation_days' => 15],
                ['id' => 2, 'name' => 'Luis Méndez', 'position' => 'Analista de Nómina', 'department' => 'Nómina', 'hire_date' => '2018-07-01', 'remaining_vacation_days' => 10],
                ['id' => 3, 'name' => 'María López', 'position' => 'Asistente Administrativo', 'department' => 'Administración', 'hire_date' => '2020-01-20', 'remaining_vacation_days' => 8],
            ];
            return view('employees.index', compact('employees'));
        })->name('employees.index');

        Route::get('/experiencias', function () {
            return view('employees.experiences', [
                'experiences' => [
                    ['company' => 'Empresa A', 'position' => 'Desarrollador', 'start_date' => '2019-01-01', 'end_date' => '2020-12-31'],
                    ['company' => 'Empresa B', 'position' => 'Analista de Datos', 'start_date' => '2021-01-01', 'end_date' => null],
                ]
            ]);
        })->name('employees.experiences');
    });

    // Módulos del sistema
    Route::view('/vacaciones', 'vacaciones.index')->name('vacaciones.index');
    Route::view('/constancias', 'constancias.index')->name('constancias.index');
    Route::view('/permisos', 'permisos.index')->name('permisos.index');
    Route::view('/honorarios', 'honorarios.index')->name('honorarios.index');
    Route::view('/metas', 'metas.index')->name('metas.index');
    Route::view('/transporte', 'transporte.index')->name('transporte.index');

    // Reportes
    Route::prefix('reportes')->group(function () {
        Route::view('/tecnologia', 'reportestecnologia.index')->name('reportestecnologia.index');
        Route::view('/generales', 'reportesgenerales.index')->name('reportesgenerales.index');
        Route::get('/generales/{type}', function ($type) {
            return view('reportesgenerales.report_detail', compact('type'));
        })->name('reportesgenerales.report_detail');
    });

    // Usuarios
    Route::view('/users', 'users.index')->name('users.index');

    // Perfil de usuario
    Route::prefix('profile')->group(function () {
        Route::get('/', function () {
            return view('profile.show', [
                'user' => Auth::user(),
                'last_login' => Auth::user()->last_login_at ? Carbon::parse(Auth::user()->last_login_at)->format('d/m/Y H:i') : 'Nunca'
            ]);
        })->name('profile.show');

        Route::get('/edit', function () {
            return view('profile.edit', ['user' => Auth::user()]);
        })->name('profile.edit');

         Route::get('/destroy', function () {
            return view('profile.destroy', ['user' => Auth::user()]);
        })->name('profile.destroy');




        Route::patch('/', function (Illuminate\Http\Request $request) {
            // Lógica para actualizar el perfil del usuario
            return redirect()->route('profile.edit')->with('status', 'Perfil actualizado correctamente.');
        })->name('profile.update');
    });



    // Home alternativo
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
