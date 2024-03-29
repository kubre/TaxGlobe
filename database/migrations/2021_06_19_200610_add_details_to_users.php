<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 25)->nullable()->unique();
            $table->string('profession')->nullable();
            $table->string('bio', 255)->nullable();
            $table->enum('gender', ['Male', 'Female', 'Transgender', 'Other'])->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('area')->nullable();
            $table->string('professional_email')->nullable();
            $table->string('contact')->nullable();
            $table->string('whatsapp_contact')->nullable();
            $table->unsignedBigInteger('points')->default(0);
            $table->unsignedSmallInteger('role')->default(User::ROLE_USER);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'profession', 'username', 'gender', 'address', 'city', 'state', 'area', 'professional_email', 'contact', 'whatsapp_contact', 'following_count', 'followers_count', 'points', 'role',
            ]);
            $table->dropSoftDeletes();
        });
    }
}
