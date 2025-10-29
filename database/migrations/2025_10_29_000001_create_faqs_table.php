<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Insert some default FAQs
        DB::table('faqs')->insert([
            ['question' => 'How do I request a quote?', 'answer' => 'Go to the Request a Quote page, fill in product details and quantities, then submit. Our sales team will follow up.', 'sort_order' => 1, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'What payment methods are accepted?', 'answer' => 'We accept bank transfers and other arrangements for corporate accounts. Contact sales for details', 'sort_order' => 2, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['question' => 'Can I request calibration services?', 'answer' => 'Yes — we provide calibration and maintenance for selected equipment. Please contact technical support for scheduling.', 'sort_order' => 3, 'is_active' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('faqs');
    }
};
