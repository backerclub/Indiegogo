<?php

namespace BackerClub\IndiegogoApiClient\Entity;

use BackerClub\IndiegogoApiClient\AbstractEntity;
use DateTime;

class Perk extends AbstractEntity
{
    private int      $id;
    private string   $campaignSlug;
    private int      $amount;
    private string   $description;
    private int      $numberClaimed;
    private int      $numberAvailable;
    private DateTime $estimatedDeliveryDate;
    private bool     $shippingAddressRequired;
    private string   $label;
    private          $validationErrors;
    private bool     $featured;
    private int      $nonTaxDeductibleAmount = 0;
    private string   $perkType;
    /**
     * Items exist when the Perk belongs to an Order.
     *
     * @var Item[]
     */
    private array $items;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCampaignSlug(): string
    {
        return $this->campaignSlug;
    }

    public function setCampaignSlug(string $campaignSlug): void
    {
        $this->campaignSlug = $campaignSlug;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getNumberClaimed(): int
    {
        return $this->numberClaimed;
    }

    public function setNumberClaimed(int $numberClaimed): void
    {
        $this->numberClaimed = $numberClaimed;
    }

    /**
     * Is the quantity of this perk limited?
     * If numberAvailable is not set then this perk has unlimited quantity available.
     */
    public function hasLimitedAvailability(): bool
    {
        return isset($this->numberAvailable);
    }

    /**
     * The remaining quantity of this perk that's available (max - claimed)
     */
    public function getRemainingAvailable(): int
    {
        return $this->getNumberAvailable() - $this->getNumberClaimed();
    }

    /**
     * The Maximum quantity of this perk that's available (claimed + unclaimed)
     */
    public function getNumberAvailable(): int
    {
        return $this->numberAvailable;
    }

    public function setNumberAvailable(int $numberAvailable): void
    {
        $this->numberAvailable = $numberAvailable;
    }

    public function getEstimatedDeliveryDate(): DateTime
    {
        return $this->estimatedDeliveryDate;
    }

    public function setEstimatedDeliveryDate(string $estimatedDeliveryDate): void
    {
        $this->estimatedDeliveryDate = new DateTime($estimatedDeliveryDate);
    }

    public function isShippingAddressRequired(): bool
    {
        return $this->shippingAddressRequired;
    }

    public function setShippingAddressRequired(bool $shippingAddressRequired): void
    {
        $this->shippingAddressRequired = $shippingAddressRequired;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function getValidationErrors(): mixed
    {
        return $this->validationErrors;
    }

    public function setValidationErrors(mixed $validationErrors): void
    {
        $this->validationErrors = $validationErrors;
    }

    public function isFeatured(): bool
    {
        return $this->featured;
    }

    public function setFeatured(bool $featured): void
    {
        $this->featured = $featured;
    }

    public function getNonTaxDeductibleAmount(): int
    {
        return $this->nonTaxDeductibleAmount;
    }

    public function setNonTaxDeductibleAmount(int $nonTaxDeductibleAmount): void
    {
        $this->nonTaxDeductibleAmount = $nonTaxDeductibleAmount;
    }

    public function getPerkType(): string
    {
        return $this->perkType;
    }

    public function setPerkType(string $perkType): void
    {
        $this->perkType = $perkType;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array|object[]|Item[] $items
     */
    public function setItems(array $items): void
    {
        $this->items = array_map(
            fn($item) => $item instanceof Item
                ? $item
                : new Item((object)$item),
            $items
        );
    }
}
