<?php

namespace Avi\AuditBy\Resolvers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Avi\AuditBy\Contracts\AuditUserResolver;

class CompositeResolver implements AuditUserResolver
{
    public function resolve(): ?int
    {
        foreach (config('audit-by.sources', []) as $source) {
            $id = match ($source['driver'] ?? null) {
                'auth'     => $this->fromAuth($source),
                'session'  => $this->fromSession($source),
                'callback' => $this->fromCallback($source),
                default    => null,
            };

            if ($id) {
                return (int) $id;
            }
        }

        return null;
    }

    protected function fromAuth(array $config): ?int
    {
        foreach ($config['guards'] ?? [] as $guard) {
            if (Auth::guard($guard)->check()) {
                return Auth::guard($guard)->id();
            }
        }

        return null;
    }

    protected function fromSession(array $config): ?int
    {
        foreach ($config['keys'] ?? [] as $key) {
            $value = data_get(Session::all(), $key);

            if (is_numeric($value)) {
                return (int) $value;
            }
        }

        return null;
    }

    protected function fromCallback(array $config): ?int
    {
        return isset($config['resolver']) && is_callable($config['resolver'])
            ? (int) call_user_func($config['resolver'])
            : null;
    }
}
