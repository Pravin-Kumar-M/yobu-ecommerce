<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            if (!Schema::hasColumn('chat_messages', 'read_at_admin')) {
                $table->timestamp('read_at_admin')->nullable()->index()->after('message');
            }
            if (!Schema::hasColumn('chat_messages', 'read_at_user')) {
                $table->timestamp('read_at_user')->nullable()->index()->after('read_at_admin');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {
            if (Schema::hasColumn('chat_messages', 'read_at_admin')) {
                $table->dropColumn('read_at_admin');
            }
            if (Schema::hasColumn('chat_messages', 'read_at_user')) {
                $table->dropColumn('read_at_user');
            }
        });
    }
};
