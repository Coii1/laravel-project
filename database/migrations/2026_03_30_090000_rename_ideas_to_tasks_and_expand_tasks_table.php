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
        if (Schema::hasTable('ideas') && !Schema::hasTable('tasks')) {
            Schema::rename('ideas', 'tasks');
        }

        if (!Schema::hasTable('tasks')) {
            return;
        }

        Schema::table('tasks', function (Blueprint $table) {
            if (!Schema::hasColumn('tasks', 'title')) {
                $table->string('title')->default('Untitled task')->after('id');
            }

            if (!Schema::hasColumn('tasks', 'due_date')) {
                $table->date('due_date')->nullable()->after('description');
            }

            if (!Schema::hasColumn('tasks', 'status')) {
                $table->string('status')->default('todo')->after('due_date');
            }

            if (!Schema::hasColumn('tasks', 'priority')) {
                $table->string('priority')->default('medium')->after('status');
            }

            if (!Schema::hasColumn('tasks', 'position')) {
                $table->unsignedInteger('position')->default(0)->after('priority');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasTable('tasks')) {
            return;
        }

        Schema::table('tasks', function (Blueprint $table) {
            if (Schema::hasColumn('tasks', 'position')) {
                $table->dropColumn('position');
            }

            if (Schema::hasColumn('tasks', 'priority')) {
                $table->dropColumn('priority');
            }

            if (Schema::hasColumn('tasks', 'status')) {
                $table->dropColumn('status');
            }

            if (Schema::hasColumn('tasks', 'due_date')) {
                $table->dropColumn('due_date');
            }

            if (Schema::hasColumn('tasks', 'title')) {
                $table->dropColumn('title');
            }
        });

        if (!Schema::hasTable('ideas')) {
            Schema::rename('tasks', 'ideas');
        }
    }
};
