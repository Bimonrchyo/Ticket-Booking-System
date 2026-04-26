# TODO: Update Seat Layout to Indonesia Standard + Seat Type Indicators

## Steps

- [x]   1. Update `database/seeders/SeatLayoutSeeder.php` — add seat_types, fix kereta to 2-3
- [x]   2. Update `app/Http/Controllers/TransportController.php` — sync layouts array with seat_types
- [x]   3. Fix `app/Http/Controllers/BookingController.php` — fix regex validation for up to F
- [x]   4. Update `resources/views/admin/create.blade.php` — update dropdown labels
- [x]   5. Update `resources/views/admin/edit.blade.php` — update dropdown labels
- [x]   6. Redesign `resources/views/user/detail-jadwal.blade.php` — Traveloka-style layout + seat type indicators
- [x]   7. Run seeder to update existing records
