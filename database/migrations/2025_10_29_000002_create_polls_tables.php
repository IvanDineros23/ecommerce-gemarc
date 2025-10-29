<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('question');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('poll_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_id')->constrained('polls')->cascadeOnDelete();
            $table->string('text');
            $table->integer('votes_count')->default(0);
            $table->timestamps();
        });

        Schema::create('poll_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poll_id')->constrained('polls')->cascadeOnDelete();
            $table->foreignId('option_id')->constrained('poll_options')->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('ip_address')->nullable();
            $table->timestamps();
        });

        // Create a sample poll
        $pollId = DB::table('polls')->insertGetId([
            'title' => 'Welcome Poll',
            'question' => 'How did you hear about us?',
            'is_active' => 1,
            'sort_order' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('poll_options')->insert([
            ['poll_id' => $pollId, 'text' => 'Search engine', 'votes_count' => 0, 'created_at'=>now(), 'updated_at'=>now()],
            ['poll_id' => $pollId, 'text' => 'Social media', 'votes_count' => 0, 'created_at'=>now(), 'updated_at'=>now()],
            ['poll_id' => $pollId, 'text' => 'Friend/Colleague', 'votes_count' => 0, 'created_at'=>now(), 'updated_at'=>now()],
            ['poll_id' => $pollId, 'text' => 'Other', 'votes_count' => 0, 'created_at'=>now(), 'updated_at'=>now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('poll_votes');
        Schema::dropIfExists('poll_options');
        Schema::dropIfExists('polls');
    }
};
