# Modular Laravel 12 

## Struture
```md
- ✅ Product Module
    - ✅ Product
    - ✅ Cart Items
- ✅ Order Module
    - ✅ Order
    - ✅ Order Line
- ⌛ Payment Module
    - ⌛ Payment Processor
- ✅ Shipping Module
    - ✅ Shipping Model
    - ⌛ Processes Shipments
```

## Little Tips
- In Modular Architecture, is common to use a PascalCase, like `Modules\Order\Database\Migrations`
- See [questions.md](questions.md) for common architectural decisions and patterns

---

## Learning Notes

### Lesson: Basic Checkout Implementation

**Modular Architecture Patterns Applied:**

1. **Cross-Module Dependencies**
   - Order module depends on: `Payment` (PayBuddy) and `Product` (Product model)
   - Dependencies are imported via namespaces: `use Modules\Payment\PayBuddy`
   - Each module exposes public contracts (models, services) for others to consume

2. **Module Self-Containment**
   - Each module owns its routes: `modules/Order/routes.php`
   - Each module owns its HTTP layer: `modules/Order/Http/Controllers/`, `modules/Order/Http/Request/`
   - Each module owns its tests: `modules/Order/Tests/`

3. **Shared Services Pattern**
   - `PayBuddy` lives in Payment module but is used by Order module
   - Static factory method (`::make()`) for easy instantiation across modules
   - Mocking external services keeps modules testable without real API dependencies

4. **Testing in Modular Architecture**
   - Tests use factories from other modules: `ProductFactory::new()` (Product module)
   - Tests verify cross-module interactions (Order creates OrderLines from Products)
   - Each module's tests stay in its own directory but can reference other modules
