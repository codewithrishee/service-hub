<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {

            // Service Images
            $table->string('image')->nullable()->after('description');
            $table->json('gallery')->nullable()->after('image');

            // Rating & Reviews
            $table->decimal('rating', 2, 1)->default(0)->after('duration');
            $table->unsignedInteger('review_count')->default(0)->after('rating');

            // Service Details
            $table->json('included')->nullable()->after('review_count');
            $table->json('excluded')->nullable()->after('included');
            $table->json('how_it_works')->nullable()->after('excluded');

            // Availability & Service Area
            $table->string('service_area')->nullable()->after('how_it_works');
            $table->string('availability')->nullable()->after('service_area');

            // Verification
            $table->boolean('verified')->default(false)->after('availability');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {

            $table->dropColumn([
                'image',
                'gallery',
                'rating',
                'review_count',
                'included',
                'excluded',
                'how_it_works',
                'service_area',
                'availability',
                'verified',
            ]);

        });
    }
};