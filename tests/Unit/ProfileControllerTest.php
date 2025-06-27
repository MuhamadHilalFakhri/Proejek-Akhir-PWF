<?php

namespace Tests\Unit;

use App\Http\Controllers\ProfileController;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Mockery;
use Tests\TestCase;
use App\Models\User;

class ProfileControllerTest extends TestCase
{
    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_edit_returns_view_with_user()
    {
        $user = Mockery::mock(User::class);

        $request = Mockery::mock(Request::class);
        $request->shouldReceive('user')->andReturn($user);

        $controller = new ProfileController();

        $response = $controller->edit($request);

        $this->assertEquals('profile.edit', $response->name());
        $this->assertArrayHasKey('user', $response->getData());
        $this->assertSame($user, $response->getData()['user']);
    }

    
    public function test_destroy_logs_out_and_deletes_user_and_redirects()
    {
        $user = Mockery::mock(User::class);
        $user->shouldReceive('delete')->once()->andReturn(true);

        $request = Mockery::mock(Request::class);
        $request->shouldReceive('validateWithBag')->once()->with('userDeletion', ['password' => ['required', 'current_password']]);
        $request->shouldReceive('user')->andReturn($user);
        $request->shouldReceive('session')->andReturnSelf();
        $request->shouldReceive('invalidate')->once();
        $request->shouldReceive('regenerateToken')->once();

        Auth::shouldReceive('logout')->once();

        $controller = new ProfileController();

        $response = $controller->destroy($request);

        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertEquals(url('/'), $response->getTargetUrl());
    }
}
