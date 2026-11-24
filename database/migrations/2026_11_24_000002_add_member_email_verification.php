<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void { Schema::table('members', function(Blueprint $t){$t->timestamp('email_verified_at')->nullable();$t->string('email_verification_token',64)->nullable();}); }
 public function down(): void {Schema::table('members',fn(Blueprint $t)=>$t->dropColumn(['email_verified_at','email_verification_token']));}
};
