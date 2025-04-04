@extends('layouts.app')

@section('contents')
<!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Perhitungan Anggaran</title>
        <style>
            input, select {
                margin: 10px 0;
                padding: 10px;
                width: 100%;
                border: none;
                border-radius: 5px;
                background-color: #e6e6fa;
                font-size: 16px;
            }
            .total-input {
                background-color: #f0f8ff;
                font-weight: bold;
            }
            button {
                background-color: #6a5acd;
                color: white;
                padding: 10px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                width: 100%;
                font-size: 16px;
            }
            button:hover {
                background-color: #5a4cac;
            }
            .warning {
                color: red;
                font-weight: bold;
                margin-top: 10px;
            }
        </style>
    </head>
    <body>

        <div class="container">
            <h1>Perhitungan Anggaran</h1>
            <form action="{{ route('konsumsis.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="jenis_konsumsi">Jenis Konsumsi:</label>
                <select id="jenis_konsumsi" name="jenis_konsumsi" onchange="hitungTotal()" required>
                    <option value="" disabled selected>Pilih jenis konsumsi</option>
                    <option value="Snack">Snack</option>
                    <option value="Nasi">Nasi</option>
                    <option value="Nasi + Snack">Nasi + Snack</option>
                </select>

                <label for="tanggal_pengadaan">Tanggal</label>
                <input type="date" id="tangal_pengadaan" name="tanggal_pengadaan" placeholder="Masukkan Tanggal" oninput="hitungTotal()">

                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" placeholder="Masukkan jumlah" oninput="hitungTotal()">

                <label for="harga">Harga</label>
                <input type="number" id="harga" name="harga" placeholder="Masukkan harga " oninput="hitungTotal()">

                <label for="pajakPersen">Pajak (%):</label>
                <input type="number" id="pajakPersen" name="pajak" placeholder="Masukkan persen pajak" oninput="hitungTotal()">

                <label for="anggaran">Anggaran:</label>
                <input type="number" id="anggaran" name="anggaran" placeholder="Masukkan anggaran" oninput="hitungTotal()">

                <label for="total">Total:</label>
                <input type="text" id="total" name="total" class="total-input" readonly>

                <div id="warning" class="warning" style="display: none;"></div>

                <button type="submit">Simpan</button>
            </form>
        </div>

        <script>
            function hitungTotal() {
                const jumlah = parseFloat(document.getElementById('jumlah').value) || 0;
                const harga = parseFloat(document.getElementById('harga').value) || 0;
                const pajakPersen = parseFloat(document.getElementById('pajakPersen').value) || 0;
                const anggaran = parseFloat(document.getElementById('anggaran').value) || 0;

                // Hitung total harga foto copy
                const totalHarga = jumlah * harga;

                // Hitung pajak berdasarkan persen
                const pajak = (pajakPersen / 100) * totalHarga;
                const total = totalHarga + pajak;

                // Update total ke input
                document.getElementById('total').value = total.toFixed(2);

                // Peringatan jika total melebihi anggaran
                const warningDiv = document.getElementById('warning');
                if (total > anggaran && anggaran > 0) {
                    warningDiv.innerHTML = 'Peringatan: Total melebihi anggaran!';
                    warningDiv.style.display = 'block';
                } else {
                    warningDiv.style.display = 'none';
                }
            }

            // Pratinjau gambar
            document.getElementById('bukti').addEventListener('change', function(event) {
                const files = event.target.files;
                const previewArea = document.getElementById('preview-area');

                // Reset area pratinjau
                previewArea.innerHTML = '';

                // Tampilkan pratinjau setiap gambar
                Array.from(files).forEach(file => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            previewArea.appendChild(img);
                        };
                        reader.readAsDataURL(file);
                    }
                });
            });
        </script>
    </body>
    </html>
@endsection