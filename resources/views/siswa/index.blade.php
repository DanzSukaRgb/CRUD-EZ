@extends('layout.app')

@section('konten')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-gradient">Daftar Siswa</h2>
        <a href="{{ route('Siswa.create') }}" class="btn btn-primary shadow-sm rounded-pill px-4">
            <i class="bi bi-plus-circle me-2"></i> Tambah Siswa
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card border-0 shadow-lg">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th scope="col" class="ps-4 py-3 rounded-start">No</th>
                            <th scope="col" class="py-3">Nama</th>
                            <th scope="col" class="py-3">Jenis Kelamin</th>
                            <th scope="col" class="py-3">Kelas</th>
                            <th scope="col" class="pe-4 py-3 rounded-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswas as $siswa)
                            <tr class="border-bottom">
                                <td class="ps-4">{{ $loop->iteration }}</td>
                                <td class="fw-semibold">{{ $siswa->nama }}</td>
                                <td>
                                    <span class="badge {{ $siswa->jenis_kelamin == 'Laki-laki' ? 'bg-info' : 'bg-pink' }} rounded-pill px-3 py-1">
                                        {{ $siswa->jenis_kelamin }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark rounded-pill px-3 py-1">
                                        {{ $siswa->kelas }}
                                    </span>
                                </td>
                                <td class="pe-4">
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('Siswa.edit', $siswa->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 delete-btn"
                                                data-id="{{ $siswa->id }}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-exclamation-circle fs-4"></i>
                                    <p class="mt-2 mb-0">Belum ada data siswa.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Include SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<style>
    .text-gradient {
        background: linear-gradient(45deg, #3b82f6, #8b5cf6);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .bg-pink {
        background-color: #ec4899;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(59, 130, 246, 0.05);
    }

    .rounded-start {
        border-top-left-radius: 0.5rem !important;
        border-bottom-left-radius: 0.5rem !important;
    }

    .rounded-end {
        border-top-right-radius: 0.5rem !important;
        border-bottom-right-radius: 0.5rem !important;
    }

    .btn-outline-primary:hover {
        background-color: rgba(59, 130, 246, 0.1);
    }

    .btn-outline-danger:hover {
        background-color: rgba(220, 53, 69, 0.1);
    }
</style>

<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Delete confirmation with SweetAlert2
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const siswaId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data siswa akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-lg',
                        confirmButton: 'rounded-pill px-4',
                        cancelButton: 'rounded-pill px-4'
                    },
                    buttonsStyling: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create a form and submit it
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = `/Siswa/${siswaId}`;

                        const csrf = document.createElement('input');
                        csrf.type = 'hidden';
                        csrf.name = '_token';
                        csrf.value = document.querySelector('meta[name="csrf-token"]').content;

                        const method = document.createElement('input');
                        method.type = 'hidden';
                        method.name = '_method';
                        method.value = 'DELETE';

                        form.appendChild(csrf);
                        form.appendChild(method);
                        document.body.appendChild(form);
                        form.submit();

                        // Show success message
                        Swal.fire({
                            title: 'Dihapus!',
                            text: 'Data siswa telah dihapus.',
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'rounded-lg'
                            }
                        });
                    }
                });
            });
        });

        // Show success message if exists
        @if(session('success'))
            Swal.fire({
                title: 'Sukses!',
                text: '{{ session('success') }}',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false,
                customClass: {
                    popup: 'rounded-lg'
                }
            });
        @endif
    });
</script>
@endsection
