<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void { Schema::create('membership_levels',function(Blueprint $t){$t->id();$t->string('name')->unique();$t->decimal('fee',10,2);$t->unsignedInteger('validity_months')->default(12);$t->text('benefits')->nullable();$t->boolean('is_active')->default(true);$t->timestamps();}); } public function down(): void { Schema::dropIfExists('membership_levels'); } };
