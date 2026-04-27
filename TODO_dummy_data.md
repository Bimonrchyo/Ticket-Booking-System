# TODO: Perluasan Data Dummy

## Progress

- [x] Analisis struktur database dan relasi
- [x] Baca semua file model, migration, dan seeder
- [ ] Update DatabaseSeeder.php dengan data dummy lengkap
- [ ] Jalankan migrate:fresh --seed
- [ ] Verifikasi hasil

## Rencana Data Dummy

### Companies (7)

- PT Kereta Api Indonesia (approved)
- Lion Air Group (approved)
- PO Sinar Jaya (approved)
- Pelni Nusantara (approved)
- Garuda Indonesia (approved)
- New Startup Travel (pending)
- Rejected Company Ltd (rejected)

### Users (12)

- 1 Superadmin
- 6 Admin (1 per company approved)
- 5 Regular users

### Lokasi (15)

Jakarta, Bandung, Surabaya, Yogyakarta, Denpasar, Medan, Makassar, Semarang, Malang, Palembang, Lombok, Balikpapan, Padang, Solo, Manado

### Transportasi (16)

- 4 Kereta (KAI Eksekutif, KAI Bisnis, KAI Ekonomi, Argo Bromo)
- 4 Pesawat (Garuda 737, Lion Air A320, Batik Air, Citilink)
- 4 Bus (PO Haryanto, PO Sinar Jaya, PO Pahala Kencana, PO Lorena)
- 4 Kapal (Pelni KM. Dobonsolo, Pelni KM. Kelud, ASDP Ferry, Express Bahari)

### Jadwal (40+)

- Variasi rute antar 15 kota
- Waktu: pagi, siang, sore, malam
- Harga: Rp50rb - Rp2jt
- Stok: 10-200

### Pemesanan (15+)

- Status: pending, paid, canceled, completed
- Kursi bervariasi

### Pembayaran (10+)

- Metode: transfer, gopay, ovo, dana, kartu_kredit
- Status: paid, pending, rejected
