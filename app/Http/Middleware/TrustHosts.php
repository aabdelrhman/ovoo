<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustHosts as Middleware;

class TrustHosts extends Middleware
{
    /**
     * Get the host patterns that should be trusted.
     *
     * @return array<int, string|null>
     */
    public function hosts(): array
    {
        return [
            'localhost',
            'localhost:3000',
            'localhost:3001',
            'localhost:5000',
            'localhost:5173',
            'http://localhost:3000',
            'http://localhost:3001',
            'http://localhost:5000',
            'http://localhost:5173',
            $this->allSubdomainsOfApplicationUrl(),
        ];
    }
}
