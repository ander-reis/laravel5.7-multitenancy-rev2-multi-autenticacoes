<?php
declare(strict_types=1);

namespace App\Tenant;

use App\Models\Company;

class TenantManager
{
    private $tenant;

    /**
     * @return Company
     */
    public function getTenant(): ?Company
    {
        return $this->tenant;
    }

    /**
     * @param Company $tenant
     * @return void
     */
    public function setTenant(?Company $tenant): void
    {
        $this->tenant = $tenant;
    }
}
