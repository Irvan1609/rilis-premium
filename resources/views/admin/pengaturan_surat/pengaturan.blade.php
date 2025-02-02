@include('admin.pengaturan_surat.asset_tinymce', ['height' => 250])

@extends('admin.layouts.index')

@section('title')
    <h1>
        Daftar Surat
        <small>{{ $action }} Pengaturan Surat</small>
    </h1>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('surat_master') }}">Daftar Surat</a></li>
    <li class="active">{{ $action }} Pengaturan Surat</li>
@endsection

@section('content')
    @include('admin.layouts.components.notifikasi')

    {!! form_open($formAksi, 'id="validasi"') !!}
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#header" data-toggle="tab">Header</a></li>
            <li><a href="#footer" data-toggle="tab">Footer</a></li>
            <li><a href="#alur" data-toggle="tab">Alur Surat</a></li>
            <li><a href="#tte" data-toggle="tab">Pengaturan TTE</a></li>
            <li><a href="#lainnya" data-toggle="tab">Lainnya</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="header">

                @include('admin.pengaturan_surat.kembali')

                <div class="box-body">
                    <div class="form-group">
                        <label>Tinggi Header Surat</label>
                        <div class="input-group">
                            <input type="number" name="tinggi_header" class="form-control input-sm required" min="0"
                                max="100" step="0.01" value="{{ $pengaturanSurat['tinggi_header'] }}" />
                            <span class="input-group-addon input-sm">cm</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Template Header Surat</label>
                        <textarea name="header_surat" class="form-control input-sm editor required">{{ $pengaturanSurat['header_surat'] }}</textarea>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="footer">

                @include('admin.pengaturan_surat.kembali')

                <div class="box-body">
                    <div class="form-group">
                        <label>Tinggi Footer Surat</label>
                        <div class="input-group">
                            <input type="number" name="tinggi_footer" class="form-control input-sm required" min="0"
                                max="100" step="0.01" value="{{ $pengaturanSurat['tinggi_footer'] }}" />
                            <span class="input-group-addon input-sm">cm</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Template Footer Surat</label>
                        <textarea name="{{ setting('tte') == 1 ? 'footer_surat_tte' : 'footer_surat' }}"
                            class="form-control input-sm editor required">{{ setting('tte') == 1 ? $pengaturanSurat['footer_surat_tte'] : $pengaturanSurat['footer_surat'] }}</textarea>
                    </div>
                </div>

            </div>

            <div class="tab-pane" id="alur">

                @include('admin.pengaturan_surat.kembali')

                <div class="box-body">
                    <div class="alert alert-warning alert-dismissible">
                        <h4><i class="icon fa fa-warning"></i> Info Penting!</h4>
                        Menonaktifkan verifikasi akan mempengaruhi log surat maka pastikan bahwa benar surat ingin diarsipkan semua.
                    </div>
                    
                    <div class="form-group">
                        <label>Verifikasi {{ $ref_jabatan->where('id', '=', 2)->first()->nama }}</label>
                        <div class="input-group col-xs-12 col-sm-8">
                            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons" style="padding: 0px;">
                                <label
                                    class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label @active($alur['verifikasi_sekdes'] == 1) @disabled(!$sekdes)">
                                    <input type="radio" name="verifikasi_sekdes" class="form-check-input" value="1"
                                        autocomplete="off" @checked($alur['verifikasi_sekdes'] == 1 && $sekdes)
                                        @disabled(!$sekdes)>Ya</label>
                                <label
                                    class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label @active($alur['verifikasi_sekdes'] == 0) @disabled(!$sekdes)">
                                    <input type="radio" name="verifikasi_sekdes" class="form-check-input" value="0"
                                        autocomplete="off" @checked($alur['verifikasi_sekdes'] == 0 && $sekdes) @disabled(!$sekdes)>Tidak
                                </label>
                            </div>
                        </div>
                        <span class="help-block text-red @display(!$sekdes)">User
                            {{ $ref_jabatan->where('id', '=', 2)->first()->nama }} belum tersedia</span>
                    </div>
                </div>

                <div class="box-body">
                    <div class="form-group">
                        <label>Verifikasi {{ $ref_jabatan->where('id', '=', 1)->first()->nama }}</label>
                        <div class="input-group col-xs-12 col-sm-8">
                            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons" style="padding: 0px;">
                                <label
                                    class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label @active($alur['verifikasi_kades'] == 1) @disabled(setting('tte') == 1 || !$kades)">
                                    <input type="radio" name="verifikasi_kades" class="form-check-input" value="1"
                                        autocomplete="off" @checked($alur['verifikasi_kades'] == 1)
                                        @disabled(setting('tte') == 1 || !$kades)>Ya</label>
                                <label
                                    class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label @active($alur['verifikasi_kades'] == 0) @disabled(setting('tte') == 1 || !$kades)">
                                    <input type="radio" name="verifikasi_kades" class="form-check-input" value="0"
                                        autocomplete="off" @checked($alur['verifikasi_kades'] == 0) @disabled(setting('tte') == 1 || !$kades)>Tidak
                                </label>
                            </div>
                        </div>
                        <span class="help-block text-red @display(!$kades)">User
                            {{ $ref_jabatan->where('id', '=', 1)->first()->nama }} belum tersedia</span>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="tte">

                @include('admin.pengaturan_surat.kembali')

                <div class="box-body">
                    @if (!$kades)
                        <div class="callout callout-danger">
                            <p>Pengaturan modul TTE hanya bisa aktif jika user <strong>Kepala
                                    {{ setting('sebutan_desa') }}</strong> sudah dibuat dan aktif.</p>
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="alert alert-warning alert-dismissible">
                            <h4><i class="icon fa fa-warning"></i> Info Penting!</h4>
                            Modul TTE ini hanya sebuah simulasi untuk persiapan penerapan TTE di OpenSID dan hanya berlaku
                            untuk surat yang menggunakan TinyMCE
                        </div>
                        <label>Aktifkan Modul TTE</label>

                        <div class="input-group col-xs-12 col-sm-8">
                            <div class="btn-group col-xs-12 col-sm-8" data-toggle="buttons" style="padding: 0px;">
                                <label
                                    class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label @active($tte['tte'] == 1) @disabled(!$kades)">
                                    <input type="radio" name="tte" class="form-check-input" value="1"
                                        autocomplete="off" @checked($tte['tte'] == '1')
                                        @disabled(!$kades)>Ya</label>
                                <label
                                    class="btn btn-info btn-flat btn-sm col-xs-6 col-sm-5 col-lg-3 form-check-label @active($tte['tte'] == 0) @disabled(!$kades)">
                                    <input type="radio" name="tte" class="form-check-input" value="0"
                                        autocomplete="off" @checked($tte['tte'] == '0')
                                        @disabled(!$kades)>Tidak
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>URL API Server TTE</label>
                        <input type="text" name="tte_api" class="form-control input-sm"
                            value="{{ $tte['tte_api'] }}" @disabled(!$kades)>
                    </div>
                    <div class="form-group">
                        <label>Username Login TTE</label>
                        <input type="text" name="tte_username" class="form-control input-sm"
                            value="{{ $tte['tte_username'] }}" @disabled(!$kades)>
                    </div>
                    <div class="form-group">
                        <label>Password Login TTE</label>
                        <input type="password" name="tte_password" class="form-control input-sm"
                            value="{{ $tte['tte_password'] }}" @disabled(!$kades)>
                    </div>

                </div>


            </div>

            <div class="tab-pane" id="lainnya">
                @include('admin.pengaturan_surat.kembali')
                <div class="box-body">
                    <div class="form-group">
                        <label>Jenis Font Bawaan </label>
                        <div class="row">
                            <div class="col-lg-4 col-md-7 col-sm-12">
                                <select class="select2 form-control" name="font_surat">
                                    @foreach ($fonts as $font)
                                        <option value="{{ $font }}" @selected($font === $pengaturanSurat['font_surat'])>
                                            {{ $font }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="reset" class="btn btn-social btn-danger btn-sm"><i class="fa fa-times"></i>
                    Batal</button>
                <button type="submit" class="btn btn-social btn-info btn-sm pull-right"><i class="fa fa-check"></i>
                    Simpan</button>
            </div>
        </div>
    </div>
    </form>
    @include('admin.pengaturan_surat.info')
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            ganti_tte();
            $('input[name="tte"]').on('change', function(e) {
                if (!$(this).is(':disabled')) {
                    ganti_tte()
                }
            });

            function ganti_tte() {
                if (!$('input[name="tte"]').is(':disabled')) {
                    var tte = $('input[name="tte"]').filter(':checked').val();
                    if (tte == 1) {
                        $('input[name="tte_api"]').attr("disabled", false).attr("required", true);
                        $('input[name="tte_password"]').attr("disabled", false).attr("required", true);
                        $('input[name="tte_username"]').attr("disabled", false).attr("required", true);
                    } else {
                        $('input[name="tte_api"]').attr("disabled", true).attr("required", false);
                        $('input[name="tte_password"]').attr("disabled", true).attr("required", false);
                        $('input[name="tte_username"]').attr("disabled", true).attr("required", false);
                    }
                }
            }
        });
    </script>
@endpush
