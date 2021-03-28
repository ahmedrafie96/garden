<?php

namespace Tests\Unit;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function test_example()
    {
        $admin = Admin::factory()->make();
        $this->assertTrue(Admin::count()==1);
        $this->assertTrue(true);
    }
}
