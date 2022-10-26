<?php

namespace Tests\Builders;

use Domain\Entities\PurchaseItem;

class PurchaseItemBuilder
{
    protected $attributes = [];

    public function setPurchaseIdentifier($purchaseIdentifier = null): self
    {
        $this->attributes['purchase_identifier'] = $purchaseIdentifier;
        return $this;
    }

    public function setProductId($productId = null): self
    {
        $this->attributes['product_id'] = $productId;
        return $this;
    }

    public function setProductName($productName = null): self
    {
        $this->attributes['product_name'] = $productName;
        return $this;
    }

    public function setProductBrand($productBrand = null): self
    {
        $this->attributes['product_brand'] = $productBrand;
        return $this;
    }

    public function setProductAmount($productAmount = null): self
    {
        $this->attributes['product_amount'] = $productAmount;
        return $this;
    }

    public function setTenantId($tenantId = null): self
    {
        $this->attributes['tenant_id'] = $tenantId;
        return $this;
    }


    public function create($quantity = null)
    {
        return PurchaseItem::factory($quantity)->create($this->attributes);
    }

    public function make($quantity = null)
    {
        return PurchaseItem::factory($quantity)->make($this->attributes);
    }
}
