<?php

namespace Modules\Order\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Modules\Order\Database\Factories\OrderFactory;
use Modules\Order\Enums\OrderStatus;
use Modules\Order\Exceptions\OrderMissingOrderLinesException;
use Modules\Payment\Models\Payment;
use Modules\Product\CartItem;
use Modules\Product\CartItemCollection;

class Order extends Model
{
    /** @use HasFactory<OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total_in_cents',
    ];

    protected $casts = [
        'user_id'           => 'integer',
        'total_in_cents'    => 'integer',
        'status'            => OrderStatus::class,
    ];

    protected static function newFactory(): OrderFactory
    {
        return new OrderFactory;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(OrderLine::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function lastPayment(): HasOne
    {
        return $this->payments()->one()->latest();
    }

    public function url(): string
    {
        return route('orders.show', $this);
    }

    /**
     * @param int $userId
     * @return self
     */
    public static function startForUser(int $userId): self
    {
        return self::make([
            'user_id'   => $userId,
            'status'    => OrderStatus::PENDING,
        ]);
    }

    /**
     * @param CartItemCollection<CartItem> $cartItems
     * @return void
     */
    public function addLinesFromCartItems(CartItemCollection $cartItems): void
    {
        foreach ($cartItems->items() as $item) {
            $this->lines->push(OrderLine::make([
                'product_id'                => $item->product->id,
                'product_price_in_cents'    => $item->product->priceInCents,
                'quantity'                  => $item->quantity
            ]));
        }

        $this->total_in_cents = $this->lines->sum(fn(OrderLine $line) => $line->product_price_in_cents);
    }

    /**
     * @return void
     * @throws OrderMissingOrderLinesException
     */
    public function fulfill(): void
    {
        if($this->lines->isEmpty()) {
            throw new OrderMissingOrderLinesException($this);
        }
        $this->status = OrderStatus::COMPLETED;
        $this->save();
        $this->lines()->saveMany($this->lines);
    }
}
