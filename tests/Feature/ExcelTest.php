<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class ExcelTest extends TestCase
{
  public function setUp(): void
  {
    parent::setUp();
    $this->artisan('migrate:fresh --seed');
    $this->validator = $this->app['validator'];
    $this->app->make(PermissionRegistrar::class)->registerPermissions();
    $this->be(User::role('Admin')->first());
  }

  /**
   * Test if the screen to edit a user is vissable for the employee
   *
   * @return void
   */
  public function test_excel_upload_screen_can_be_loaded()
  {
    $this->assertAuthenticated();
    $response = $this->get(route('excel.importScreen'));
    $response->assertStatus(200);
  }

  /**
   * Test if the screen to edit a user is blocked if it has no errors
   *
   * @return void
   */
  public function test_upload_succes()
  {
    $this->assertAuthenticated();
    $response = $this->post(route('excel.importFile'), [
      'file' => new UploadedFile(Storage::path('../testFiles/normalImport.xlsx'), 'normalImport.xlsx',false,false,true),
    ]);

    $response->assertSessionHasNoErrors();
  }

  public function test_upload_failed_wrong_headers()
  {
    $this->assertAuthenticated();
    $response = $this->post(route('excel.importFile'), [
      'file' => new UploadedFile(Storage::path('../testFiles/wrongHeaderImport.xlsx'), 'wrongHeaderImport.xlsx',false,false,true),
    ]);

    $response->assertSessionHasErrors();
  }

  public function test_upload_failed_wrong_file_extension()
  {
    $this->assertAuthenticated();
    $response = $this->post(route('excel.importFile'), [
      'file' => new \Symfony\Component\HttpFoundation\File\UploadedFile(Storage::path('../testFiles/wrongFile.png'), 'wrongFile.png',false,false,true),
    ]);

    $response->assertSessionHasErrors();
  }
}
