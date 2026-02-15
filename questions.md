# Questions & Answers

## Should I use `foreignIdFor()` in modular architecture?

**Context:** I usually prefer `foreignIdFor()` in my Laravel projects because it's cleaner and more explicit.

**Question:** Is it a good practice to use `foreignIdFor()` in migrations when working with modular architecture?

**Answer:** No. In modular architecture, avoid using `foreignIdFor()` and `constrained()` in migrations.

**Why?**

1. **Creates code coupling** - Importing models from other modules creates a dependency at the code level
2. **Breaks module isolation** - Payment module shouldn't need to know about Order's implementation
3. **Migration order issues** - Requires strict migration execution order across modules

**Instead, use:**

```php
// ❌ Avoid (creates coupling)
use Modules\Order\Models\Order;

Schema::create('payments', function (Blueprint $table) {
    $table->foreignIdFor(Order::class);
    $table->foreignIdFor(User::class);
});

// ✅ Prefer (keeps modules decoupled)
Schema::create('payments', function (Blueprint $table) {
    $table->foreignId('order_id');
    $table->foreignId('user_id');
});
```

**Note:** The database-level dependency still exists (foreign key constraint if you add it later), but your code remains decoupled. This makes modules more portable and testable in isolation.
