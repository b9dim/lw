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
        Schema::table('cases', function (Blueprint $table) {
            // إضافة indexes لتحسين أداء الاستعلامات
            if (!$this->indexExists('cases', 'cases_client_id_index')) {
                $table->index('client_id', 'cases_client_id_index');
            }
            if (!$this->indexExists('cases', 'cases_lawyer_id_index')) {
                $table->index('lawyer_id', 'cases_lawyer_id_index');
            }
            if (!$this->indexExists('cases', 'cases_status_index')) {
                $table->index('status', 'cases_status_index');
            }
            if (!$this->indexExists('cases', 'cases_created_at_index')) {
                $table->index('created_at', 'cases_created_at_index');
            }
        });
        
        Schema::table('inquiries', function (Blueprint $table) {
            if (!$this->indexExists('inquiries', 'inquiries_case_id_index')) {
                $table->index('case_id', 'inquiries_case_id_index');
            }
            if (!$this->indexExists('inquiries', 'inquiries_client_id_index')) {
                $table->index('client_id', 'inquiries_client_id_index');
            }
            if (!$this->indexExists('inquiries', 'inquiries_reply_created_at_index')) {
                $table->index(['reply', 'created_at'], 'inquiries_reply_created_at_index');
            }
        });
        
        Schema::table('ratings', function (Blueprint $table) {
            if (!$this->indexExists('ratings', 'ratings_status_index')) {
                $table->index('status', 'ratings_status_index');
            }
            if (!$this->indexExists('ratings', 'ratings_client_id_index')) {
                $table->index('client_id', 'ratings_client_id_index');
            }
            if (!$this->indexExists('ratings', 'ratings_created_at_index')) {
                $table->index('created_at', 'ratings_created_at_index');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cases', function (Blueprint $table) {
            $table->dropIndex('cases_client_id_index');
            $table->dropIndex('cases_lawyer_id_index');
            $table->dropIndex('cases_status_index');
            $table->dropIndex('cases_created_at_index');
        });
        
        Schema::table('inquiries', function (Blueprint $table) {
            $table->dropIndex('inquiries_case_id_index');
            $table->dropIndex('inquiries_client_id_index');
            $table->dropIndex('inquiries_reply_created_at_index');
        });
        
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropIndex('ratings_status_index');
            $table->dropIndex('ratings_client_id_index');
            $table->dropIndex('ratings_created_at_index');
        });
    }

    /**
     * Check if index exists
     */
    private function indexExists(string $table, string $index): bool
    {
        $connection = Schema::getConnection();
        $databaseName = $connection->getDatabaseName();
        
        if ($connection->getDriverName() === 'sqlite') {
            $result = $connection->select(sprintf(
                "PRAGMA index_list('%s')",
                str_replace("'", "''", $table)
            ));

            foreach ($result as $row) {
                $name = $row->name ?? $row->Name ?? null;

                if ($name === $index) {
                    return true;
                }
            }

            return false;
        }

        if ($connection->getDriverName() === 'pgsql') {
            $result = $connection->select(
                "SELECT 1 FROM pg_indexes WHERE tablename = ? AND indexname = ?",
                [$table, $index]
            );
            return !empty($result);
        } else {
            $result = $connection->select(
                "SHOW INDEX FROM {$table} WHERE Key_name = ?",
                [$index]
            );
            return !empty($result);
        }
    }
};

