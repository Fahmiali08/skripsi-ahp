<li class="nav-header text-white pl-3">Data</li>
<li class="nav-item">
    <a href="{{route('administrator/student')}}" class="nav-link text-white d-none">
         <i class="nav-icon far fa-image"></i>
        <p>Siswa</p>
    </a>
    <a href="{{route('administrator/criteria')}}" class="nav-link text-white">
         <i class="nav-icon fas fa-clipboard-list"></i>
        <p>Kriteria</p>
    </a>
    <a href="{{route('administrator/alternative')}}" class="nav-link text-white">
         <i class="nav-icon fas fa-clipboard-list"></i>
        <p>Alternatif</p>
    </a>
</li>

<li class="nav-header text-white">Analisa</li>
<li class="nav-item">
    <a href="{{route('administrator/criteria_analyst')}}" class="nav-link text-white">
        <i class="nav-icon fas fa-grip-lines"></i>
        <p>Kriteria</p>
    </a>
    <a href="{{route('administrator/alternative_analyst')}}" class="nav-link text-white">
         <i class="nav-icon fas fa-align-justify"></i>
        <p>Alternatif</p>
    </a>
</li>

<li class="nav-header text-white">Laporan</li>
<li class="nav-item">
    <a href="{{route('administrator/criteria_analyst_result')}}" class="nav-link text-white">
        <i class="nav-icon far fa-clone"></i>
        <p>
        Hasil Perbandingan Kriteria
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('administrator/alternative_analyst_result')}}" class="nav-link text-white">
        {{-- <i class="nav-icon fas fa-columns"></i> --}}
        <i class="nav-icon fas fa-coins"></i>
        <p>
        Hasil Perbandingan Alternatif
        </p>
    </a>
</li>
<li class="nav-item">
    <a href="{{route('administrator/ranking')}}" class="nav-link text-white">
        <i class="nav-icon fas fa-chart-line"></i>
        <p>
        Ranking
        </p>
    </a>
</li>
<li class="nav-header text-white">MISCELLANEOUS</li>
<li class="nav-item">
    <a href="https://adminlte.io/docs/3.0" class="nav-link text-white">
        <i class="nav-icon fas fa-file"></i>
        <p>Documentation</p>
    </a>
</li>
