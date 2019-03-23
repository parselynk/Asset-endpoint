<?php

namespace Tests\Feature;

use App\Asset;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AssetTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /**
     * @test
     */
    public function admin_can_see_all_assets()
    {
        // genrate 5 groups, including their assets and users and their relations
        $groups = factory('App\Group', 5)->create();
        // all assets stored in database
        $assetsAmount = Asset::all()->count();
        // a new user generated and logs in as an admin (has no asset)
        $user = factory('App\User')->create(['role' => 0]);
        $this->actingAs($user);
        //verify the user is admin
        $this->assertTrue($user->isAdmin());
        //call API to retrive assets
        $response = json_decode($this->get('/api/assets')->getContent(), true);
        // admin gets all assets
        $this->assertCount($assetsAmount, $response);
    }

    /**
    * @test
    */
    public function user_only_sees_own_his_assets()
    {
        // genrate a group, including their assets and users and their relations
        $group = factory('App\Group', 5)->create();
        // all assets stored in database
        $allAssetsAmount = Asset::all()->count();
        // one of the assets' owners logs in
        $normalUser = $group->first()->users()->first();
        $this->actingAs($normalUser);
        //verify user is not admin
        $this->assertFalse($normalUser->isAdmin());
        //call API to retrive assets
        $normalUserAssets =  json_decode($this->get('/api/assets')->getContent(), true);
        // user only sees his assets
        $this->assertCount($normalUser->assets()->count(), $normalUserAssets);
        $this->assertTrue($allAssetsAmount > count($normalUserAssets));
    }
}
