# TODO: Update Seat Layout Indonesia Standard

**Current layouts in SeatLayoutSeeder.php:**

- kereta: 2-3 (A B | C D E), 5 seats/row
- bus: 2-2 (A B | C D), 4 seats/row
- pesawat: complex sections
- kapal: 2-2

**Progress:**

- [x] Update SeatLayoutSeeder.php
- [x] Update DatabaseSeeder.php transportasi kapasitas
- [x] Update TransportController.php store layouts
- [x] Update admin create.blade.php options
- [x] Update admin edit.blade.php options
- [x] `migrate:fresh --seed`
- [ ] Test detail-jadwal seat map
- [ ] `migrate:fresh --seed` + test

**Research needed:** Indonesia transport seat standards (KAI, Lion Air, PO Haryanto)

Proceed?
