
php artisan make:controller Api/Auth/AuthController
php artisan make:request Auth/LoginRequest
php artisan make:request Auth/RegisterRequest
php artisan make:resource Auth/AuthResource

// nuxt data fetching (search)

// Database Seeder
    \App\Models\User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => Hash::make('12345678')
        ]);

// php artisan migrate:fresh --seed