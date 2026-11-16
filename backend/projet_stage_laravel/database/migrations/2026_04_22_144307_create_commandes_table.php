<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('commandes', function (Blueprint $table) {
    $table->id();

    $table->unsignedInteger('user_id'); // 👈 IMPORTANT

    $table->foreign('user_id')
          ->references('id')
          ->on('users')
          ->onDelete('cascade');

    $table->string('statut')->default('en_attente');
    $table->decimal('total', 10, 2);
    $table->string('adresse_livraison')->nullable();
    $table->timestamps();
});
    }
    public function down() {
        Schema::dropIfExists('commandes');
    }
};