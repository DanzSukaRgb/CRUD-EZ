@extends('layout.app')

@section('konten')
<div
    class="table-responsive"
>
    <table
        class="table table-striped table-hover table-borderless table-primary align-middle"
    >
        <thead class="table-light">
            <caption>
                Table Name
            </caption>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @foreach ($siswas as $siswa)
            <tr
                class="table-primary"
            >
                <td scope="row">$loop->iteration</td>
                <td>$siswa->nama</td>
                <td>$siswa->jenis_kelamin</td>
                <td>$siswa->kelas</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>

        </tfoot>
    </table>
</div>

