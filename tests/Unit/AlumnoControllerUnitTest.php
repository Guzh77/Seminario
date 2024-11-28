<?php

namespace Tests\Unit;

use App\Models\Alumno;
use App\Http\Controllers\AlumnoController;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;
class AlumnoControllerUnitTest extends TestCase
{
 
    public function test_probar_validacion_falla_para_crear_Alumnos():void
    {
    
    $controller= new AlumnoController();
    $request=Request::create('/alumnos','POST',[
        'name' => '',
        'lastname' => '',
        'email' => '',
        'age' => ''
    ]);
    $this->expectException(ValidationException::class);
    
    $controller->store($request);
    }

    public function test_probar_validacion_correcta_para_crear_Alumnos():void
    {
    $controller= new AlumnoController();
    $request=Request::create('/alumnos','POST',[
        'name' => 'Kevin',
        'lastname' => 'Calix',
        'mail' => 'kCalix@unicah.edu',
        'age' => '20'
    ]);

    $response=$controller->store($request);
    $this->assertTrue($response->isRedirect(route('alumnos.index')));
    }


    public function test_probar_validacion_falla_para_correo_Alumnos():void
    {
    
    $controller= new AlumnoController();
    $request=Request::create('/alumnos','POST',[
        'name' => 'jose',
        'lastname' => 'sikaffy',
        'email' => '',
        'age' => '23'
    ]);
    $this->expectException(ValidationException::class);

    $controller->store($request);
    }
}
