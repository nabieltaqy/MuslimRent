<!-- resources/views/pdf_template.blade.php -->
<h1>Laporan Peminjaman</h1>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Peminjam</th>
            <th>Tanggal Pinjam</th>
            <th>Nama Unit</th>
            <th>Penalty</th>
            <!-- tambahkan kolom lainnya sesuai kebutuhan -->
        </tr>
    </thead>
    <tbody>
        @foreach ($borrows as $borrow)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $borrow->borrower->name }}</td>
                <td>{{ $borrow->borrow_date }}</td>
                <td>{{ $borrow->unit->nama_unit }}</td>
                <td>{{ $borrow->penalty }}</td>
                <!-- tambahkan data lainnya -->
            </tr>
        @endforeach
    </tbody>
</table>
