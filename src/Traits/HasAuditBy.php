<?php

namespace Avi\AuditBy\Traits;

use Avi\AuditBy\Contracts\AuditUserResolver;

trait HasAuditBy
{
    protected static function bootHasAuditBy(): void
    {
        static::creating(function ($model) {
            if ($id = self::userId()) {
                $model->created_by ??= $id;
                $model->updated_by ??= $id;
            }
        });

        static::updating(function ($model) {
            if ($id = self::userId()) {
                $model->updated_by = $id;
            }
        });

        static::deleting(function ($model) {
            if (!self::usesSoftDeletes($model)) {
                return;
            }

            if (method_exists($model, 'isForceDeleting') && $model->isForceDeleting()) {
                return;
            }

            if ($id = self::userId()) {
                $model->deleted_by = $id;
                $model->saveQuietly();
            }
        });
    }

    protected static function userId(): ?int
    {
        return app(AuditUserResolver::class)->resolve();
    }

    protected static function usesSoftDeletes($model): bool
    {
        return in_array(
            'Illuminate\Database\Eloquent\SoftDeletes',
            class_uses_recursive($model)
        );
    }
}
