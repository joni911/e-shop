# ROUTES & FUNGSI — DAFTAR LENGKAP (334 route · semua controller)

> File lengkap: seluruh HTTP route hasil `php artisan route:list --except-vendor` dan semua method publik per controller. Ringkasan per domain: lihat `ROUTES_FUNCTIONS.md`.

## DAFTAR ROUTE (URL → Controller)

```
GET|HEAD / ................................................................................ routes/web.php:63
GET|HEAD CreatePhoto ............................................. photo.buat › barangController@create_photo
GET|HEAD administrasi ..................................... administrasi.index › AdministrasiController@index
POST administrasi ..................................... administrasi.store › AdministrasiController@store
GET|HEAD administrasi/create ............................ administrasi.create › AdministrasiController@create
GET|HEAD administrasi/{administrasi} ........................ administrasi.show › AdministrasiController@show
PUT|PATCH administrasi/{administrasi} .................... administrasi.update › AdministrasiController@update
DELETE administrasi/{administrasi} .................. administrasi.destroy › AdministrasiController@destroy
GET|HEAD administrasi/{administrasi}/edit ................... administrasi.edit › AdministrasiController@edit
GET|HEAD administrasi_list ..................... administrasi_list.index › AdministrasiDetailController@index
POST administrasi_list ..................... administrasi_list.store › AdministrasiDetailController@store
GET|HEAD administrasi_list/create ............ administrasi_list.create › AdministrasiDetailController@create
GET|HEAD administrasi_list/{administrasi_list} ... administrasi_list.show › AdministrasiDetailController@show
PUT|PATCH administrasi_list/{administrasi_list} administrasi_list.update › AdministrasiDetailController@update
DELETE administrasi_list/{administrasi_list} administrasi_list.destroy › AdministrasiDetailController@dest…
GET|HEAD administrasi_list/{administrasi_list}/edit administrasi_list.edit › AdministrasiDetailController@ed…
GET|HEAD api/user ......................................................................... routes/api.php:17
GET|HEAD barang ....................................................... barang.index › barangController@index
POST barang ....................................................... barang.store › barangController@store
GET|HEAD barang/create .............................................. barang.create › barangController@create
GET|HEAD barang/{barang} ................................................ barang.show › barangController@show
PUT|PATCH barang/{barang} ............................................ barang.update › barangController@update
DELETE barang/{barang} .......................................... barang.destroy › barangController@destroy
GET|HEAD barang/{barang}/edit ........................................... barang.edit › barangController@edit
GET|HEAD daftar_peserta ................................ daftar_peserta.index › DaftarPesertaController@index
POST daftar_peserta ................................ daftar_peserta.store › DaftarPesertaController@store
GET|HEAD daftar_peserta/create ....................... daftar_peserta.create › DaftarPesertaController@create
GET|HEAD daftar_peserta/{daftar_pesertum} ................ daftar_peserta.show › DaftarPesertaController@show
PUT|PATCH daftar_peserta/{daftar_pesertum} ............ daftar_peserta.update › DaftarPesertaController@update
DELETE daftar_peserta/{daftar_pesertum} .......... daftar_peserta.destroy › DaftarPesertaController@destroy
GET|HEAD daftar_peserta/{daftar_pesertum}/edit ........... daftar_peserta.edit › DaftarPesertaController@edit
GET|HEAD dashboard .............................................. dashboard.index › DashboardController@index
POST dashboard .............................................. dashboard.store › DashboardController@store
GET|HEAD dashboard/create ..................................... dashboard.create › DashboardController@create
GET|HEAD dashboard/{dashboard} .................................... dashboard.show › DashboardController@show
PUT|PATCH dashboard/{dashboard} ................................ dashboard.update › DashboardController@update
DELETE dashboard/{dashboard} .............................. dashboard.destroy › DashboardController@destroy
GET|HEAD dashboard/{dashboard}/edit ............................... dashboard.edit › DashboardController@edit
POST email/resend .............................. verification.resend › Auth\VerificationController@resend
GET|HEAD email/verify ................................ verification.notice › Auth\VerificationController@show
GET|HEAD email/verify/{id}/{hash} .................. verification.verify › Auth\VerificationController@verify
GET|HEAD file_teknis ......................................... file_teknis.index › FileTeknisController@index
POST file_teknis ......................................... file_teknis.store › FileTeknisController@store
GET|HEAD file_teknis/create ................................ file_teknis.create › FileTeknisController@create
GET|HEAD file_teknis/{file_tekni} .............................. file_teknis.show › FileTeknisController@show
PUT|PATCH file_teknis/{file_tekni} .......................... file_teknis.update › FileTeknisController@update
DELETE file_teknis/{file_tekni} ........................ file_teknis.destroy › FileTeknisController@destroy
GET|HEAD file_teknis/{file_tekni}/edit ......................... file_teknis.edit › FileTeknisController@edit
GET|HEAD foto/barang/{id} .......................................... photo.edit › barangController@edit_photo
GET|HEAD home ............................................................. home › TenderHomeController@index
GET|HEAD jenis_kontrak .................................. jenis_kontrak.index › jenis_kontrakController@index
POST jenis_kontrak .................................. jenis_kontrak.store › jenis_kontrakController@store
GET|HEAD jenis_kontrak/create ......................... jenis_kontrak.create › jenis_kontrakController@create
GET|HEAD jenis_kontrak/{jenis_kontrak} .................... jenis_kontrak.show › jenis_kontrakController@show
PUT|PATCH jenis_kontrak/{jenis_kontrak} ................ jenis_kontrak.update › jenis_kontrakController@update
DELETE jenis_kontrak/{jenis_kontrak} .............. jenis_kontrak.destroy › jenis_kontrakController@destroy
GET|HEAD jenis_kontrak/{jenis_kontrak}/edit ............... jenis_kontrak.edit › jenis_kontrakController@edit
GET|HEAD jenis_pengadaan ............................ jenis_pengadaan.index › jenis_pengadaanController@index
POST jenis_pengadaan ............................ jenis_pengadaan.store › jenis_pengadaanController@store
GET|HEAD jenis_pengadaan/create ................... jenis_pengadaan.create › jenis_pengadaanController@create
GET|HEAD jenis_pengadaan/{jenis_pengadaan} ............ jenis_pengadaan.show › jenis_pengadaanController@show
PUT|PATCH jenis_pengadaan/{jenis_pengadaan} ........ jenis_pengadaan.update › jenis_pengadaanController@update
DELETE jenis_pengadaan/{jenis_pengadaan} ...... jenis_pengadaan.destroy › jenis_pengadaanController@destroy
GET|HEAD jenis_pengadaan/{jenis_pengadaan}/edit ....... jenis_pengadaan.edit › jenis_pengadaanController@edit
GET|HEAD katagori .......................................... katagori.index › katagori_barangController@index
POST katagori .......................................... katagori.store › katagori_barangController@store
GET|HEAD katagori/create ................................. katagori.create › katagori_barangController@create
GET|HEAD katagori/{katagori} ................................. katagori.show › katagori_barangController@show
PUT|PATCH katagori/{katagori} ............................. katagori.update › katagori_barangController@update
DELETE katagori/{katagori} ........................... katagori.destroy › katagori_barangController@destroy
GET|HEAD katagori/{katagori}/edit ............................ katagori.edit › katagori_barangController@edit
GET|HEAD komen .................................................... komen.index › TenderKomenController@index
POST komen .................................................... komen.store › TenderKomenController@store
GET|HEAD komen/create ........................................... komen.create › TenderKomenController@create
GET|HEAD komen/{koman} .............................................. komen.show › TenderKomenController@show
PUT|PATCH komen/{koman} .......................................... komen.update › TenderKomenController@update
DELETE komen/{koman} ........................................ komen.destroy › TenderKomenController@destroy
GET|HEAD komen/{koman}/edit ......................................... komen.edit › TenderKomenController@edit
GET|HEAD komentar ................................................. komentar.index › komentarController@index
POST komentar ................................................. komentar.store › komentarController@store
GET|HEAD komentar/create ........................................ komentar.create › komentarController@create
GET|HEAD komentar/{komentar} ........................................ komentar.show › komentarController@show
PUT|PATCH komentar/{komentar} .................................... komentar.update › komentarController@update
DELETE komentar/{komentar} .................................. komentar.destroy › komentarController@destroy
GET|HEAD komentar/{komentar}/edit ................................... komentar.edit › komentarController@edit
GET|HEAD koreksi .................................................... koreksi.index › KoreksiController@index
POST koreksi .................................................... koreksi.store › KoreksiController@store
GET|HEAD koreksi/create ........................................... koreksi.create › KoreksiController@create
GET|HEAD koreksi/{koreksi} ............................................ koreksi.show › KoreksiController@show
PUT|PATCH koreksi/{koreksi} ........................................ koreksi.update › KoreksiController@update
DELETE koreksi/{koreksi} ...................................... koreksi.destroy › KoreksiController@destroy
GET|HEAD koreksi/{koreksi}/edit ....................................... koreksi.edit › KoreksiController@edit
GET|HEAD login ................................................... login › Auth\LoginController@showLoginForm
POST login ................................................................... Auth\LoginController@login
POST logout ........................................................ logout › Auth\LoginController@logout
GET|HEAD managemen .............................................. managemen.index › ManagemenController@index
POST managemen .............................................. managemen.store › ManagemenController@store
GET|HEAD managemen/create ..................................... managemen.create › ManagemenController@create
GET|HEAD managemen/{manageman} .................................... managemen.show › ManagemenController@show
PUT|PATCH managemen/{manageman} ................................ managemen.update › ManagemenController@update
DELETE managemen/{manageman} .............................. managemen.destroy › ManagemenController@destroy
GET|HEAD managemen/{manageman}/edit ............................... managemen.edit › ManagemenController@edit
GET|HEAD metode_pengadaan .......................... metode_pengadaan.index › MetodePengadaanController@index
POST metode_pengadaan .......................... metode_pengadaan.store › MetodePengadaanController@store
GET|HEAD metode_pengadaan/create ................. metode_pengadaan.create › MetodePengadaanController@create
GET|HEAD metode_pengadaan/{metode_pengadaan} ......... metode_pengadaan.show › MetodePengadaanController@show
PUT|PATCH metode_pengadaan/{metode_pengadaan} ..... metode_pengadaan.update › MetodePengadaanController@update
DELETE metode_pengadaan/{metode_pengadaan} ... metode_pengadaan.destroy › MetodePengadaanController@destroy
GET|HEAD metode_pengadaan/{metode_pengadaan}/edit .... metode_pengadaan.edit › MetodePengadaanController@edit
GET|HEAD p_admin ...................................... p_admin.index › PenilaianAdministrasiController@index
POST p_admin ...................................... p_admin.store › PenilaianAdministrasiController@store
GET|HEAD p_admin/create ............................. p_admin.create › PenilaianAdministrasiController@create
GET|HEAD p_admin/{p_admin} .............................. p_admin.show › PenilaianAdministrasiController@show
PUT|PATCH p_admin/{p_admin} .......................... p_admin.update › PenilaianAdministrasiController@update
DELETE p_admin/{p_admin} ........................ p_admin.destroy › PenilaianAdministrasiController@destroy
GET|HEAD p_admin/{p_admin}/edit ......................... p_admin.edit › PenilaianAdministrasiController@edit
GET|HEAD p_kualifikasi ........................... p_kualifikasi.index › PenilaianKualifikasiController@index
POST p_kualifikasi ........................... p_kualifikasi.store › PenilaianKualifikasiController@store
GET|HEAD p_kualifikasi/create .................. p_kualifikasi.create › PenilaianKualifikasiController@create
GET|HEAD p_kualifikasi/{p_kualifikasi} ............. p_kualifikasi.show › PenilaianKualifikasiController@show
PUT|PATCH p_kualifikasi/{p_kualifikasi} ......... p_kualifikasi.update › PenilaianKualifikasiController@update
DELETE p_kualifikasi/{p_kualifikasi} ....... p_kualifikasi.destroy › PenilaianKualifikasiController@destroy
GET|HEAD p_kualifikasi/{p_kualifikasi}/edit ........ p_kualifikasi.edit › PenilaianKualifikasiController@edit
GET|HEAD p_peserta .............................. p_peserta.index › PenilaianPenawaranPesertaController@index
POST p_peserta .............................. p_peserta.store › PenilaianPenawaranPesertaController@store
GET|HEAD p_peserta/create ..................... p_peserta.create › PenilaianPenawaranPesertaController@create
GET|HEAD p_peserta/{p_pesertum} ................... p_peserta.show › PenilaianPenawaranPesertaController@show
PUT|PATCH p_peserta/{p_pesertum} ............... p_peserta.update › PenilaianPenawaranPesertaController@update
DELETE p_peserta/{p_pesertum} ............. p_peserta.destroy › PenilaianPenawaranPesertaController@destroy
GET|HEAD p_peserta/{p_pesertum}/edit .............. p_peserta.edit › PenilaianPenawaranPesertaController@edit
GET|HEAD p_teknis .......................................... p_teknis.index › PenilaianTeknisController@index
POST p_teknis .......................................... p_teknis.store › PenilaianTeknisController@store
GET|HEAD p_teknis/create ................................. p_teknis.create › PenilaianTeknisController@create
GET|HEAD p_teknis/{p_tekni} .................................. p_teknis.show › PenilaianTeknisController@show
PUT|PATCH p_teknis/{p_tekni} .............................. p_teknis.update › PenilaianTeknisController@update
DELETE p_teknis/{p_tekni} ............................ p_teknis.destroy › PenilaianTeknisController@destroy
GET|HEAD p_teknis/{p_tekni}/edit ............................. p_teknis.edit › PenilaianTeknisController@edit
GET|HEAD password/confirm ................. password.confirm › Auth\ConfirmPasswordController@showConfirmForm
POST password/confirm ............................................ Auth\ConfirmPasswordController@confirm
POST password/email ................... password.email › Auth\ForgotPasswordController@sendResetLinkEmail
GET|HEAD password/reset ................ password.request › Auth\ForgotPasswordController@showLinkRequestForm
POST password/reset ................................ password.update › Auth\ResetPasswordController@reset
GET|HEAD password/reset/{token} ................. password.reset › Auth\ResetPasswordController@showResetForm
GET|HEAD pekerjaan_berjalan .................... pekerjaan_berjalan.index › PekerjaanBerjalanController@index
POST pekerjaan_berjalan .................... pekerjaan_berjalan.store › PekerjaanBerjalanController@store
GET|HEAD pekerjaan_berjalan/create ........... pekerjaan_berjalan.create › PekerjaanBerjalanController@create
GET|HEAD pekerjaan_berjalan/{pekerjaan_berjalan} . pekerjaan_berjalan.show › PekerjaanBerjalanController@show
PUT|PATCH pekerjaan_berjalan/{pekerjaan_berjalan} pekerjaan_berjalan.update › PekerjaanBerjalanController@upd…
DELETE pekerjaan_berjalan/{pekerjaan_berjalan} pekerjaan_berjalan.destroy › PekerjaanBerjalanController@de…
GET|HEAD pekerjaan_berjalan/{pekerjaan_berjalan}/edit pekerjaan_berjalan.edit › PekerjaanBerjalanController@…
GET|HEAD pemeriksaan ........................................ pemeriksaan.index › PemeriksaanController@index
POST pemeriksaan ........................................ pemeriksaan.store › PemeriksaanController@store
GET|HEAD pemeriksaan/create ............................... pemeriksaan.create › PemeriksaanController@create
GET|HEAD pemeriksaan/{pemeriksaan} ............................ pemeriksaan.show › PemeriksaanController@show
PUT|PATCH pemeriksaan/{pemeriksaan} ........................ pemeriksaan.update › PemeriksaanController@update
DELETE pemeriksaan/{pemeriksaan} ...................... pemeriksaan.destroy › PemeriksaanController@destroy
GET|HEAD pemeriksaan/{pemeriksaan}/edit ....................... pemeriksaan.edit › PemeriksaanController@edit
GET|HEAD penawaran .............................................. penawaran.index › PenawaranController@index
POST penawaran .............................................. penawaran.store › PenawaranController@store
GET|HEAD penawaran/create ..................................... penawaran.create › PenawaranController@create
GET|HEAD penawaran/{penawaran} .................................... penawaran.show › PenawaranController@show
PUT|PATCH penawaran/{penawaran} ................................ penawaran.update › PenawaranController@update
DELETE penawaran/{penawaran} .............................. penawaran.destroy › PenawaranController@destroy
GET|HEAD penawaran/{penawaran}/edit ............................... penawaran.edit › PenawaranController@edit
GET|HEAD penawaran_file ................................ penawaran_file.index › PenawaranFileController@index
POST penawaran_file ................................ penawaran_file.store › PenawaranFileController@store
GET|HEAD penawaran_file/create ....................... penawaran_file.create › PenawaranFileController@create
GET|HEAD penawaran_file/{penawaran_file} ................. penawaran_file.show › PenawaranFileController@show
PUT|PATCH penawaran_file/{penawaran_file} ............. penawaran_file.update › PenawaranFileController@update
DELETE penawaran_file/{penawaran_file} ........... penawaran_file.destroy › PenawaranFileController@destroy
GET|HEAD penawaran_file/{penawaran_file}/edit ............ penawaran_file.edit › PenawaranFileController@edit
GET|HEAD penawaran_peserta ....................... penawaran_peserta.index › PenawaranPesertaController@index
POST penawaran_peserta ....................... penawaran_peserta.store › PenawaranPesertaController@store
GET|HEAD penawaran_peserta/create .............. penawaran_peserta.create › PenawaranPesertaController@create
GET|HEAD penawaran_peserta/{penawaran_pesertum} .... penawaran_peserta.show › PenawaranPesertaController@show
PUT|PATCH penawaran_peserta/{penawaran_pesertum} penawaran_peserta.update › PenawaranPesertaController@update
DELETE penawaran_peserta/{penawaran_pesertum} penawaran_peserta.destroy › PenawaranPesertaController@destr…
GET|HEAD penawaran_peserta/{penawaran_pesertum}/edit penawaran_peserta.edit › PenawaranPesertaController@edit
GET|HEAD penawaran_peserta_file ......... penawaran_peserta_file.index › PenawaranPesertaFileController@index
POST penawaran_peserta_file ......... penawaran_peserta_file.store › PenawaranPesertaFileController@store
GET|HEAD penawaran_peserta_file/create penawaran_peserta_file.create › PenawaranPesertaFileController@create
GET|HEAD penawaran_peserta_file/{penawaran_peserta_file} penawaran_peserta_file.show › PenawaranPesertaFileC…
PUT|PATCH penawaran_peserta_file/{penawaran_peserta_file} penawaran_peserta_file.update › PenawaranPesertaFil…
DELETE penawaran_peserta_file/{penawaran_peserta_file} penawaran_peserta_file.destroy › PenawaranPesertaFi…
GET|HEAD penawaran_peserta_file/{penawaran_peserta_file}/edit penawaran_peserta_file.edit › PenawaranPeserta…
GET|HEAD pengalaman ..................................... pengalaman.index › PengalamanTenderController@index
POST pengalaman ..................................... pengalaman.store › PengalamanTenderController@store
GET|HEAD pengalaman/create ............................ pengalaman.create › PengalamanTenderController@create
GET|HEAD pengalaman/{pengalaman} .......................... pengalaman.show › PengalamanTenderController@show
PUT|PATCH pengalaman/{pengalaman} ...................... pengalaman.update › PengalamanTenderController@update
DELETE pengalaman/{pengalaman} .................... pengalaman.destroy › PengalamanTenderController@destroy
GET|HEAD pengalaman/{pengalaman}/edit ..................... pengalaman.edit › PengalamanTenderController@edit
GET|HEAD peralatan .............................................. peralatan.index › PeralatanController@index
POST peralatan .............................................. peralatan.store › PeralatanController@store
GET|HEAD peralatan/create ..................................... peralatan.create › PeralatanController@create
GET|HEAD peralatan/{peralatan} .................................... peralatan.show › PeralatanController@show
PUT|PATCH peralatan/{peralatan} ................................ peralatan.update › PeralatanController@update
DELETE peralatan/{peralatan} .............................. peralatan.destroy › PeralatanController@destroy
GET|HEAD peralatan/{peralatan}/edit ............................... peralatan.edit › PeralatanController@edit
GET|HEAD periksa ............................................ periksa.index › PenilaianTenderController@index
POST periksa ............................................ periksa.store › PenilaianTenderController@store
GET|HEAD periksa/create ................................... periksa.create › PenilaianTenderController@create
GET|HEAD periksa/{periksa} .................................... periksa.show › PenilaianTenderController@show
PUT|PATCH periksa/{periksa} ................................ periksa.update › PenilaianTenderController@update
DELETE periksa/{periksa} .............................. periksa.destroy › PenilaianTenderController@destroy
GET|HEAD periksa/{periksa}/edit ............................... periksa.edit › PenilaianTenderController@edit
GET|HEAD perubahan .............................................. perubahan.index › PerubahanController@index
POST perubahan .............................................. perubahan.store › PerubahanController@store
GET|HEAD perubahan/create ..................................... perubahan.create › PerubahanController@create
GET|HEAD perubahan/{perubahan} .................................... perubahan.show › PerubahanController@show
PUT|PATCH perubahan/{perubahan} ................................ perubahan.update › PerubahanController@update
DELETE perubahan/{perubahan} .............................. perubahan.destroy › PerubahanController@destroy
GET|HEAD perubahan/{perubahan}/edit ............................... perubahan.edit › PerubahanController@edit
GET|HEAD peserta .................................................... peserta.index › PesertaController@index
POST peserta .................................................... peserta.store › PesertaController@store
GET|HEAD peserta/create ........................................... peserta.create › PesertaController@create
GET|HEAD peserta/tender/{id} ................................ peserta.tender › PesertaController@show_peserta
GET|HEAD peserta/{id}/file_tender/{pid} .................. peserta.file › PesertaController@show_file_peserta
GET|HEAD peserta/{pesertum} ........................................... peserta.show › PesertaController@show
PUT|PATCH peserta/{pesertum} ....................................... peserta.update › PesertaController@update
DELETE peserta/{pesertum} ..................................... peserta.destroy › PesertaController@destroy
GET|HEAD peserta/{pesertum}/edit ...................................... peserta.edit › PesertaController@edit
POST photoStore .............................................. photo.simpan › barangController@photoStore
GET|HEAD register ................................... register › Auth\RegisterController@showRegistrationForm
POST register .......................................................... Auth\RegisterController@register
GET|HEAD sanggahan ................................................ sanggahan.index › SanggahController@index
POST sanggahan ................................................ sanggahan.store › SanggahController@store
GET|HEAD sanggahan/create ....................................... sanggahan.create › SanggahController@create
GET|HEAD sanggahan/{sanggahan} ...................................... sanggahan.show › SanggahController@show
PUT|PATCH sanggahan/{sanggahan} .................................. sanggahan.update › SanggahController@update
DELETE sanggahan/{sanggahan} ................................ sanggahan.destroy › SanggahController@destroy
GET|HEAD sanggahan/{sanggahan}/edit ................................. sanggahan.edit › SanggahController@edit
GET|HEAD send ............................................................ send › StatusTenderController@send
POST send_hasil ............................................... send.hasil › PesertaController@send_hasil
GET|HEAD shops ..................................................... shops.index › UserBarangController@index
POST shops ..................................................... shops.store › UserBarangController@store
GET|HEAD shops/add/{id} ................................................ shops.add › UserBarangController@add
GET|HEAD shops/create ............................................ shops.create › UserBarangController@create
GET|HEAD shops/{shop} ................................................ shops.show › UserBarangController@show
PUT|PATCH shops/{shop} ............................................ shops.update › UserBarangController@update
DELETE shops/{shop} .......................................... shops.destroy › UserBarangController@destroy
GET|HEAD shops/{shop}/edit ........................................... shops.edit › UserBarangController@edit
GET|HEAD status_tender ................................... status_tender.index › StatusTenderController@index
POST status_tender ................................... status_tender.store › StatusTenderController@store
GET|HEAD status_tender/create .......................... status_tender.create › StatusTenderController@create
GET|HEAD status_tender/{status_tender} ..................... status_tender.show › StatusTenderController@show
PUT|PATCH status_tender/{status_tender} ................. status_tender.update › StatusTenderController@update
DELETE status_tender/{status_tender} ............... status_tender.destroy › StatusTenderController@destroy
GET|HEAD status_tender/{status_tender}/edit ................ status_tender.edit › StatusTenderController@edit
GET|HEAD syarat ....................................................... syarat.index › SyaratController@index
POST syarat ....................................................... syarat.store › SyaratController@store
GET|HEAD syarat/create .............................................. syarat.create › SyaratController@create
GET|HEAD syarat/{syarat} ................................................ syarat.show › SyaratController@show
PUT|PATCH syarat/{syarat} ............................................ syarat.update › SyaratController@update
DELETE syarat/{syarat} .......................................... syarat.destroy › SyaratController@destroy
GET|HEAD syarat/{syarat}/edit ........................................... syarat.edit › SyaratController@edit
GET|HEAD syarat_detail ................................... syarat_detail.index › SyaratDetailController@index
POST syarat_detail ................................... syarat_detail.store › SyaratDetailController@store
GET|HEAD syarat_detail/create .......................... syarat_detail.create › SyaratDetailController@create
GET|HEAD syarat_detail/{syarat_detail} ..................... syarat_detail.show › SyaratDetailController@show
PUT|PATCH syarat_detail/{syarat_detail} ................. syarat_detail.update › SyaratDetailController@update
DELETE syarat_detail/{syarat_detail} ............... syarat_detail.destroy › SyaratDetailController@destroy
GET|HEAD syarat_detail/{syarat_detail}/edit ................ syarat_detail.edit › SyaratDetailController@edit
GET|HEAD tahapan .................................................... tahapan.index › TahapanController@index
POST tahapan .................................................... tahapan.store › TahapanController@store
GET|HEAD tahapan/create ........................................... tahapan.create › TahapanController@create
GET|HEAD tahapan/{tahapan} ............................................ tahapan.show › TahapanController@show
PUT|PATCH tahapan/{tahapan} ........................................ tahapan.update › TahapanController@update
DELETE tahapan/{tahapan} ...................................... tahapan.destroy › TahapanController@destroy
GET|HEAD tahapan/{tahapan}/edit ....................................... tahapan.edit › TahapanController@edit
GET|HEAD tenagaahli ........................................... tenagaahli.index › TenagaAhliController@index
POST tenagaahli ........................................... tenagaahli.store › TenagaAhliController@store
GET|HEAD tenagaahli/create .................................. tenagaahli.create › TenagaAhliController@create
GET|HEAD tenagaahli/{tenagaahli} ................................ tenagaahli.show › TenagaAhliController@show
PUT|PATCH tenagaahli/{tenagaahli} ............................ tenagaahli.update › TenagaAhliController@update
DELETE tenagaahli/{tenagaahli} .......................... tenagaahli.destroy › TenagaAhliController@destroy
GET|HEAD tenagaahli/{tenagaahli}/edit ........................... tenagaahli.edit › TenagaAhliController@edit
GET|HEAD tender_admin ........................................... tender_admin.index › tenderController@index
POST tender_admin ........................................... tender_admin.store › tenderController@store
GET|HEAD tender_admin/create .................................. tender_admin.create › tenderController@create
GET|HEAD tender_admin/syarat/{id} ........................ tender_admin.syarat › tenderController@show_syarat
GET|HEAD tender_admin/tahapan/{id} ..................... tender_admin.tahapan › tenderController@show_tahapan
GET|HEAD tender_admin/{tender_admin} .............................. tender_admin.show › tenderController@show
PUT|PATCH tender_admin/{tender_admin} .......................... tender_admin.update › tenderController@update
DELETE tender_admin/{tender_admin} ........................ tender_admin.destroy › tenderController@destroy
GET|HEAD tender_admin/{tender_admin}/edit ......................... tender_admin.edit › tenderController@edit
GET|HEAD tender_file ......................................... tender_file.index › TenderFileController@index
POST tender_file ......................................... tender_file.store › TenderFileController@store
GET|HEAD tender_file/create ................................ tender_file.create › TenderFileController@create
GET|HEAD tender_file/{tender_file} ............................. tender_file.show › TenderFileController@show
PUT|PATCH tender_file/{tender_file} ......................... tender_file.update › TenderFileController@update
DELETE tender_file/{tender_file} ....................... tender_file.destroy › TenderFileController@destroy
GET|HEAD tender_file/{tender_file}/edit ........................ tender_file.edit › TenderFileController@edit
GET|HEAD tender_file_detail ..................... tender_file_detail.index › TenderFileDetailController@index
POST tender_file_detail ..................... tender_file_detail.store › TenderFileDetailController@store
GET|HEAD tender_file_detail/create ............ tender_file_detail.create › TenderFileDetailController@create
GET|HEAD tender_file_detail/{tender_file_detail} .. tender_file_detail.show › TenderFileDetailController@show
PUT|PATCH tender_file_detail/{tender_file_detail} tender_file_detail.update › TenderFileDetailController@upda…
DELETE tender_file_detail/{tender_file_detail} tender_file_detail.destroy › TenderFileDetailController@des…
GET|HEAD tender_file_detail/{tender_file_detail}/edit tender_file_detail.edit › TenderFileDetailController@e…
GET|HEAD tender_home ......................................... tender_home.index › TenderHomeController@index
POST tender_home ......................................... tender_home.store › TenderHomeController@store
GET|HEAD tender_home/create ................................ tender_home.create › TenderHomeController@create
GET|HEAD tender_home/{tender_home} ............................. tender_home.show › TenderHomeController@show
PUT|PATCH tender_home/{tender_home} ......................... tender_home.update › TenderHomeController@update
DELETE tender_home/{tender_home} ....................... tender_home.destroy › TenderHomeController@destroy
GET|HEAD tender_home/{tender_home}/edit ........................ tender_home.edit › TenderHomeController@edit
GET|HEAD tender_persyarat ........................ tender_persyarat.index › TenderPersyaratanController@index
POST tender_persyarat ........................ tender_persyarat.store › TenderPersyaratanController@store
GET|HEAD tender_persyarat/create ............... tender_persyarat.create › TenderPersyaratanController@create
GET|HEAD tender_persyarat/{tender_persyarat} ....... tender_persyarat.show › TenderPersyaratanController@show
PUT|PATCH tender_persyarat/{tender_persyarat} ... tender_persyarat.update › TenderPersyaratanController@update
DELETE tender_persyarat/{tender_persyarat} . tender_persyarat.destroy › TenderPersyaratanController@destroy
GET|HEAD tender_persyarat/{tender_persyarat}/edit .. tender_persyarat.edit › TenderPersyaratanController@edit
GET|HEAD tender_persyaratan_file ...... tender_persyaratan_file.index › TenderPersyaratanFileController@index
POST tender_persyaratan_file ...... tender_persyaratan_file.store › TenderPersyaratanFileController@store
GET|HEAD tender_persyaratan_file/create tender_persyaratan_file.create › TenderPersyaratanFileController@cre…
GET|HEAD tender_persyaratan_file/{tender_persyaratan_file} tender_persyaratan_file.show › TenderPersyaratanF…
PUT|PATCH tender_persyaratan_file/{tender_persyaratan_file} tender_persyaratan_file.update › TenderPersyarata…
DELETE tender_persyaratan_file/{tender_persyaratan_file} tender_persyaratan_file.destroy › TenderPersyarat…
GET|HEAD tender_persyaratan_file/{tender_persyaratan_file}/edit tender_persyaratan_file.edit › TenderPersyar…
GET|HEAD test ................................................................... StatusTenderController@test
GET|HEAD testmail ........................................................................ routes/web.php:142
GET|HEAD validasi_file ................................... validasi_file.index › ValidasiFileController@index
POST validasi_file ................................... validasi_file.store › ValidasiFileController@store
GET|HEAD validasi_file/create .......................... validasi_file.create › ValidasiFileController@create
GET|HEAD validasi_file/{validasi_file} ..................... validasi_file.show › ValidasiFileController@show
PUT|PATCH validasi_file/{validasi_file} ................. validasi_file.update › ValidasiFileController@update
DELETE validasi_file/{validasi_file} ............... validasi_file.destroy › ValidasiFileController@destroy
GET|HEAD validasi_file/{validasi_file}/edit ................ validasi_file.edit › ValidasiFileController@edit
Showing [330] routes
```

## FUNGSI PER CONTROLLER (public method → baris)

### `AdministrasiController`

- `index()` — baris 20
- `create()` — baris 30
- `store()` — baris 41
- `show()` — baris 61
- `edit()` — baris 80
- `update()` — baris 92
- `destroy()` — baris 103

### `AdministrasiDetailController`

- `index()` — baris 20
- `create()` — baris 30
- `store()` — baris 41
- `upfile()` — baris 87
- `show()` — baris 97
- `edit()` — baris 119
- `update()` — baris 131
- `destroy()` — baris 142

### `Auth/ConfirmPasswordController`

- `__construct()` — baris 36

### `Auth/LoginController`

- `__construct()` — baris 36

### `Auth/RegisterController`

- `__construct()` — baris 41
- `send()` — baris 81

### `Auth/VerificationController`

- `__construct()` — baris 36

### `DaftarPesertaController`

- `index()` — baris 19
- `create()` — baris 29
- `store()` — baris 40
- `send()` — baris 53
- `show()` — baris 74
- `edit()` — baris 85
- `update()` — baris 97
- `destroy()` — baris 108

### `DashboardController`

- `index()` — baris 18
- `create()` — baris 30
- `store()` — baris 41
- `show()` — baris 52
- `edit()` — baris 84
- `update()` — baris 96
- `destroy()` — baris 107

### `DetailSyaratController`

- `index()` — baris 15
- `create()` — baris 25
- `store()` — baris 36
- `show()` — baris 47
- `edit()` — baris 58
- `update()` — baris 70
- `destroy()` — baris 81

### `FileTeknisController`

- `index()` — baris 22
- `create()` — baris 32
- `store()` — baris 43
- `fsmkk()` — baris 65
- `fkomit()` — baris 82
- `show()` — baris 106
- `edit()` — baris 124
- `update()` — baris 136
- `destroy()` — baris 147

### `HomeController`

- `__construct()` — baris 15
- `index()` — baris 25

### `JenisKontrakController`

- `index()` — baris 15
- `create()` — baris 25
- `store()` — baris 36
- `show()` — baris 47
- `edit()` — baris 58
- `update()` — baris 70
- `destroy()` — baris 81

### `JenisPengadaanController`

- `index()` — baris 15
- `create()` — baris 25
- `store()` — baris 36
- `show()` — baris 47
- `edit()` — baris 58
- `update()` — baris 70
- `destroy()` — baris 81

### `KoreksiController`

- `index()` — baris 17
- `create()` — baris 27
- `store()` — baris 38
- `show()` — baris 56
- `edit()` — baris 67
- `update()` — baris 79
- `destroy()` — baris 90

### `ManagemenController`

- `index()` — baris 18
- `create()` — baris 28
- `file1()` — baris 40
- `file2()` — baris 59
- `file3()` — baris 79
- `file4()` — baris 98
- `file5()` — baris 118
- `store()` — baris 137
- `show()` — baris 179
- `edit()` — baris 194
- `update()` — baris 210
- `ufile1()` — baris 258
- `ufile2()` — baris 277
- `ufile3()` — baris 297
- `ufile4()` — baris 316
- `ufile5()` — baris 336
- `destroy()` — baris 362

### `MetodePengadaanController`

- `index()` — baris 15
- `create()` — baris 28
- `store()` — baris 41
- `show()` — baris 62
- `edit()` — baris 73
- `update()` — baris 88
- `destroy()` — baris 108

### `PekerjaanBerjalanController`

- `index()` — baris 18
- `create()` — baris 28
- `store()` — baris 39
- `show()` — baris 69
- `edit()` — baris 83
- `update()` — baris 99
- `destroy()` — baris 125

### `PemenangTenderController`

- `index()` — baris 16
- `create()` — baris 26
- `store()` — baris 37
- `show()` — baris 48
- `edit()` — baris 59
- `update()` — baris 71
- `destroy()` — baris 82

### `PemeriksaanControll`

- `index()` — baris 15
- `create()` — baris 25
- `store()` — baris 36
- `show()` — baris 47
- `edit()` — baris 58
- `update()` — baris 70
- `destroy()` — baris 81

### `PemeriksaanController`

- `index()` — baris 19
- `create()` — baris 29
- `store()` — baris 40
- `show()` — baris 73
- `edit()` — baris 84
- `penilaian()` — baris 96
- `update()` — baris 114
- `send()` — baris 154
- `destroy()` — baris 187

### `PenawaranController`

- `index()` — baris 20
- `create()` — baris 30
- `store()` — baris 41
- `show()` — baris 65
- `edit()` — baris 86
- `update()` — baris 98
- `destroy()` — baris 110

### `PenawaranFileController`

- `index()` — baris 21
- `create()` — baris 31
- `store()` — baris 42
- `show()` — baris 66
- `edit()` — baris 89
- `update()` — baris 101
- `destroy()` — baris 112

### `PenawaranPesertaController`

- `index()` — baris 21
- `create()` — baris 31
- `store()` — baris 42
- `show()` — baris 111
- `edit()` — baris 122
- `update()` — baris 134
- `destroy()` — baris 145

### `PenawaranPesertaFileController`

- `index()` — baris 16
- `create()` — baris 26
- `store()` — baris 37
- `show()` — baris 48
- `edit()` — baris 59
- `update()` — baris 71
- `destroy()` — baris 82

### `PengalamanTenderController`

- `index()` — baris 19
- `create()` — baris 29
- `store()` — baris 40
- `pengalaman_file()` — baris 68
- `show()` — baris 92
- `edit()` — baris 106
- `update()` — baris 122
- `update_pengalaman_file()` — baris 153
- `destroy()` — baris 178

### `PenilaianAdministrasiController`

- `index()` — baris 17
- `create()` — baris 27
- `store()` — baris 38
- `show()` — baris 59
- `edit()` — baris 70
- `update()` — baris 82
- `destroy()` — baris 98

### `PenilaianKualifikasiController`

- `index()` — baris 17
- `create()` — baris 27
- `store()` — baris 38
- `show()` — baris 57
- `edit()` — baris 68
- `update()` — baris 80
- `destroy()` — baris 96

### `PenilaianPenawaranPesertaController`

- `index()` — baris 17
- `create()` — baris 27
- `store()` — baris 38
- `show()` — baris 58
- `edit()` — baris 69
- `update()` — baris 81
- `destroy()` — baris 97

### `PenilaianPesertaController`

- `index()` — baris 18
- `create()` — baris 28
- `store()` — baris 39
- `show()` — baris 59
- `edit()` — baris 70
- `update()` — baris 82
- `destroy()` — baris 93

### `PenilaianTeknisController`

- `index()` — baris 17
- `create()` — baris 27
- `store()` — baris 38
- `show()` — baris 57
- `edit()` — baris 68
- `update()` — baris 80
- `destroy()` — baris 95

### `PenilaianTenderController`

- `index()` — baris 17
- `create()` — baris 27
- `store()` — baris 38
- `show()` — baris 49
- `edit()` — baris 66
- `update()` — baris 78
- `destroy()` — baris 89

### `PeralatanController`

- `index()` — baris 18
- `create()` — baris 28
- `store()` — baris 39
- `peralatan_file()` — baris 61
- `show()` — baris 85
- `edit()` — baris 99
- `update()` — baris 115
- `update_peralatan_file()` — baris 138
- `destroy()` — baris 163

### `PerubahanController`

- `index()` — baris 17
- `create()` — baris 27
- `store()` — baris 38
- `show()` — baris 49
- `edit()` — baris 72
- `update()` — baris 84
- `destroy()` — baris 95

### `PesertaController`

- `index()` — baris 37
- `create()` — baris 47
- `store()` — baris 72
- `store()` — baris 73
- `getPeserta()` — baris 157
- `show()` — baris 163
- `show_peserta()` — baris 184
- `show_file_peserta()` — baris 200
- `send_hasil()` — baris 259
- `point_tender()` — baris 297
- `edit()` — baris 337
- `update()` — baris 363
- `destroy()` — baris 458

### `ProsesTenderController`

- `index()` — baris 16
- `create()` — baris 26
- `store()` — baris 37
- `show()` — baris 48
- `edit()` — baris 59
- `update()` — baris 71
- `destroy()` — baris 82

### `SanggahController`

- `index()` — baris 20
- `create()` — baris 34
- `store()` — baris 45
- `namaFile()` — baris 59
- `show()` — baris 82
- `edit()` — baris 116
- `update()` — baris 128
- `destroy()` — baris 139

### `StatusTenderController`

- `send()` — baris 18
- `index()` — baris 36
- `create()` — baris 49
- `store()` — baris 62
- `show()` — baris 83
- `edit()` — baris 94
- `update()` — baris 109
- `destroy()` — baris 129
- `test()` — baris 138

### `SyaratController`

- `index()` — baris 17
- `create()` — baris 27
- `store()` — baris 38
- `show()` — baris 56
- `edit()` — baris 68
- `update()` — baris 94
- `destroy()` — baris 111

### `SyaratDetailController`

- `index()` — baris 15
- `create()` — baris 25
- `store()` — baris 36
- `show()` — baris 47
- `edit()` — baris 58
- `update()` — baris 70
- `destroy()` — baris 81

### `TahapanController`

- `index()` — baris 20
- `create()` — baris 33
- `store()` — baris 46
- `show()` — baris 67
- `edit()` — baris 78
- `update()` — baris 93
- `destroy()` — baris 126

### `TenagaAhliController`

- `index()` — baris 19
- `create()` — baris 29
- `store()` — baris 40
- `tenaga_file()` — baris 64
- `show()` — baris 89
- `edit()` — baris 103
- `update()` — baris 119
- `update_tenaga_file()` — baris 144
- `destroy()` — baris 169

### `TenderFileController`

- `index()` — baris 12
- `create()` — baris 23
- `store()` — baris 34
- `show()` — baris 51
- `edit()` — baris 67
- `update()` — baris 85
- `destroy()` — baris 102

### `TenderHomeController`

- `__construct()` — baris 22
- `index()` — baris 26
- `create()` — baris 49
- `store()` — baris 60
- `show()` — baris 71
- `edit()` — baris 108
- `update()` — baris 134
- `destroy()` — baris 145

### `TenderKomenController`

- `index()` — baris 21
- `create()` — baris 31
- `store()` — baris 42
- `send_user()` — baris 70
- `send_admin()` — baris 84
- `show()` — baris 105
- `edit()` — baris 116
- `update()` — baris 128
- `destroy()` — baris 139

### `TenderPersyaratanController`

- `index()` — baris 18
- `create()` — baris 28
- `store()` — baris 39
- `show()` — baris 61
- `edit()` — baris 82
- `update()` — baris 105
- `destroy()` — baris 122

### `TenderPersyaratanFileController`

- `index()` — baris 17
- `create()` — baris 27
- `store()` — baris 38
- `show()` — baris 69
- `edit()` — baris 80
- `update()` — baris 92
- `destroy()` — baris 103

### `TenderStatusFilesController`

- `index()` — baris 16
- `create()` — baris 26
- `store()` — baris 37
- `show()` — baris 48
- `edit()` — baris 59
- `update()` — baris 71
- `destroy()` — baris 82

### `UserBarangController`

- `index()` — baris 15
- `create()` — baris 27
- `store()` — baris 38
- `show()` — baris 49
- `add()` — baris 53
- `edit()` — baris 64
- `update()` — baris 76
- `destroy()` — baris 87

### `ValidasiFileController`

- `index()` — baris 17
- `create()` — baris 27
- `store()` — baris 38
- `show()` — baris 58
- `edit()` — baris 69
- `update()` — baris 81
- `destroy()` — baris 92

### `barangController`

- `index()` — baris 21
- `create()` — baris 33
- `store()` — baris 46
- `create_photo()` — baris 73
- `edit_photo()` — baris 81
- `photoStore()` — baris 97
- `show()` — baris 127
- `edit()` — baris 147
- `update()` — baris 166
- `destroy()` — baris 201

### `jenis_kontrakController`

- `index()` — baris 15
- `create()` — baris 28
- `store()` — baris 41
- `show()` — baris 62
- `edit()` — baris 73
- `update()` — baris 88
- `destroy()` — baris 108

### `jenis_pengadaanController`

- `index()` — baris 15
- `create()` — baris 27
- `store()` — baris 39
- `show()` — baris 60
- `edit()` — baris 71
- `update()` — baris 85
- `destroy()` — baris 105

### `katagori_barangController`

- `index()` — baris 15
- `create()` — baris 26
- `store()` — baris 37
- `show()` — baris 52
- `edit()` — baris 63
- `update()` — baris 75
- `destroy()` — baris 86

### `komentarController`

- `index()` — baris 18
- `create()` — baris 28
- `store()` — baris 39
- `send()` — baris 57
- `show()` — baris 78
- `edit()` — baris 89
- `update()` — baris 101
- `destroy()` — baris 112

### `metode_pengadaanController`

- `index()` — baris 14
- `create()` — baris 24
- `store()` — baris 35
- `show()` — baris 46
- `edit()` — baris 57
- `update()` — baris 69
- `destroy()` — baris 80

### `tenderController`

- `index()` — baris 23
- `create()` — baris 38
- `store()` — baris 61
- `show()` — baris 93
- `show_tahapan()` — baris 97
- `show_syarat()` — baris 116
- `edit()` — baris 139
- `update()` — baris 174
- `destroy()` — baris 202
