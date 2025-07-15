<?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::table('participations', function (Blueprint $table) {
//             //
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::table('participations', function (Blueprint $table) {
//             //
//         });
//     }
// };


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeRoleToParticipationsTable extends Migration
{
    public function up()
    {
        Schema::table('participations', function (Blueprint $table) {
            $table->enum('typeRole', ['principal', 'secondaire']);
        });
    }

    public function down()
    {
        Schema::table('participations', function (Blueprint $table) {
            $table->dropColumn('typeRole');
        });
    }
}