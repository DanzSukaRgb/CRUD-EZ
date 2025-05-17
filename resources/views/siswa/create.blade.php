@extends('layout.app')

@section('title', 'Tambah Data Siswa')

@section('konten')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 fw-semibold">
                            <i class="bi bi-person-plus me-2"></i>Tambah Data Siswa
                        </h4>
                        <a href="{{ route('Siswa.index') }}" class="btn btn-light btn-sm rounded-pill">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('Siswa.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        @method('POST')

                        <!-- Nama -->
                        <div class="mb-4">
                            <label for="nama" class="form-label fw-medium">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-person-fill text-primary"></i>
                                </span>
                                <input type="text" name="nama" class="form-control py-2"
                                       value="{{ old('nama') }}" placeholder="Masukkan nama siswa" required>
                            </div>
                            <div class="invalid-feedback">
                                Harap masukkan nama siswa
                            </div>
                        </div>

                        <!-- Kelas -->
                        <div class="mb-4">
                            <label for="kelas" class="form-label fw-medium">Kelas</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-mortarboard-fill text-primary"></i>
                                </span>
                                <input type="text" name="kelas" class="form-control py-2"
                                       value="{{ old('kelas') }}" placeholder="Contoh: X IPA 1" required>
                            </div>
                            <div class="invalid-feedback">
                                Harap masukkan kelas siswa
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-4">
                            <label for="jenis_kelamin" class="form-label fw-medium">Jenis Kelamin</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">
                                    <i class="bi bi-gender-ambiguous text-primary"></i>
                                </span>
                                <select name="jenis_kelamin" class="form-select py-2" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="invalid-feedback">
                                Harap pilih jenis kelamin
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="reset" class="btn btn-outline-secondary px-4 rounded-pill">
                                <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                <i class="bi bi-save me-1"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 1rem;
        overflow: hidden;
    }

    .card-header {
        border-radius: 0 !important;
    }

    .form-control, .form-select {
        border-left: 0;
        padding-left: 0.5rem;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: none;
        border-color: #dee2e6;
    }

    .input-group-text {
        border-right: 0;
    }
</style>

<script>
    // Bootstrap validation script
    (function() {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endsection
