<?php

namespace Avi\AuditBy\Contracts;

interface AuditUserResolver
{
    public function resolve(): ?int;
}
