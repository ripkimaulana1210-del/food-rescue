<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('users', 'password')) {
            DB::table('users')
                ->whereNull('password')
                ->update(['password' => Hash::make(Str::random(32))]);

            Schema::table('users', function (Blueprint $table) {
                $table->string('password')->nullable(false)->change();
            });
        }

        $columns = [];

        if (Schema::hasColumn('users', 'google_id')) {
            $columns[] = 'google_id';
        }

        if (Schema::hasColumn('users', 'avatar')) {
            $columns[] = 'avatar';
        }

        if ($columns) {
            Schema::table('users', function (Blueprint $table) use ($columns) {
                $table->dropColumn($columns);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'password')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('password')->nullable()->change();
            });
        }

        if (!Schema::hasColumn('users', 'google_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('google_id')->nullable()->unique()->after('email');
            });
        }

        if (!Schema::hasColumn('users', 'avatar')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('avatar')->nullable()->after('google_id');
            });
        }
    }
};
