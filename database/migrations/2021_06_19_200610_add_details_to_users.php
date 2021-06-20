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
            $table->string('username', 25)->unique();
            $table->string('profession');
            $table->char('gender', 11);
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('area')->nullable();
            $table->string('professional_email')->nullable();
            $table->string('contact')->nullable();
            $table->string('whatsapp_contact')->nullable();
            $table->unsignedBigInteger('following_count')->nullable();
            $table->unsignedBigInteger('followers_count')->nullable();
            $table->unsignedBigInteger('points')->nullable();
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
