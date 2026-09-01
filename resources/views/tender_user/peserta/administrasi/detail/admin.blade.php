{{-- Form upload dokumen administrasi per item (name = id administrasi) --}}
<input type="hidden" name="default" value="{{ $data->id }}">
<input type="hidden" name="peserta" value="{{ $peserta->id }}">

@forelse ($admin as $tf)
    <div class="row g-4 mb-4">
        <div class="col-12">
            <x-file :label="($tf->nama ?? 'Dokumen') . ' *'" name="{{ $tf->id }}" required accept=".pdf"
                    hint="{{ $tf->keterangan ?? 'Jenis file yang bisa diupload: PDF' }}"/>
            <input type="hidden" name="1{{ $tf->id }}" value="{{ $tf->tender_id }}">
            <input type="hidden" name="2{{ $tf->id }}" value="{{ $tf->nama }}">
            <input type="hidden" name="3{{ $tf->id }}" value="{{ $tf->id }}">
        </div>
    </div>
@empty
    <p class="text-muted">Belum ada dokumen administrasi yang ditentukan panitia.</p>
@endforelse
