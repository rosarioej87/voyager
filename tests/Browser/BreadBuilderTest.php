<?php

namespace Voyager\Admin\Tests\Browser;

use Laravel\Dusk\Browser as DuskBrowser;
use Voyager\Admin\Manager\Breads as BreadManager;

class BreadBuilderTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_fake()
    {
        $this->assertTrue(true);
    }

    /*public function test_can_browse_breads()
    {
        $user = new \Illuminate\Foundation\Auth\User();
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = bcrypt('password');
        $user->save();

        resolve(BreadManager::class)->deleteBread('users');
        $this->browse(function (DuskBrowser $browser) use ($user) {
            $browser->loginAs($user)
                    ->visitRoute('voyager.bread.index')
                    ->waitForText('users')
                    ->assertSee(__('voyager::generic.add_type', [type => __('voyager::generic.bread') ]));
        });
    }

    public function test_can_create_user_bread()
    {
        resolve(BreadManager::class)->deleteBread('users');
        $this->browse(function (DuskBrowser $browser) {
            $browser->visitRoute('voyager.bread.create', 'users')
                ->assertSee(__('voyager::builder.new_breads_prop_warning'));
        });
    }*/
}
