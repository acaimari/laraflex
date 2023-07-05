<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 150)->default('Admin');
            $table->string('username', 50);
            $table->char('countries_id', 25)->nullable();
            $table->char('password', 60)->default(Hash::make('password'));
            $table->string('email')->default('admin@laraflex.org');
            $table->timestamp('date')->useCurrent();
            $table->string('avatar', 70)->nullable()->default('/storage/default/user_avatar_default.jpg');
            $table->string('cover', 70)->nullable();
            $table->enum('status', ['pending', 'active', 'suspended', 'delete'])->default('active');
            $table->enum('role', ['normal', 'admin'])->default('normal');
            $table->enum('permission', ['all', 'none'])->default('none');
            $table->rememberToken()->nullable();
            $table->string('token', 80)->nullable();
            $table->string('confirmation_code', 125)->nullable();
            $table->timestamps();
        });

        // Insertar el usuario administrador
        DB::table('users')->insert([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => '$2y$10$pVDpzH6qL3eUcOtO0TdKauu6/M21pGwvq/YaKW0GDPZSV7kyq..au',
            'email' => 'admin@admin.com',
            'date' => now(),
            'avatar' => '/storage/default/user_avatar_default.jpg',
            'cover' => null,
            'status' => 'active',
            'role' => 'admin',
            'permission' => 'all',
            'remember_token' => null,
            'token' => null,
            'confirmation_code' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
