<div>
    <div class="page-header page-header-light">
        <div class="page-header-content header-elements-md-inline">
            <div class="page-title d-flex">
                <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">User</span> - Log User
                </h4>
                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>
            @include('header-elements')

        </div>

        <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
            <div class="d-flex">
                <div class="breadcrumb">
                    <a href="{{url('/')}}/home" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
                    <a href="#" class="breadcrumb-item">User</a>
                    <span class="breadcrumb-item active">Log User</span>
                </div>

                <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
            </div>

        </div>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Log User</h5>
            </div>


            <div class="table-responsive">
                <input type="text" class="form-control" placeholder="&nbsp;Pencarian Berdasarkan Deksripsi Log"
                       wire:model="searchTerm"/>
                <table class="table" id="tData">
                    <thead>
                    <tr>
                        <th>Log ID</th>
                        <th>Tipe Log</th>
                        <th>Nama User</th>
                        <th>Deskripsi</th>
                        <th>Tgl Log</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($logs as $value)
                        <tr>
                            <td>{{ $value->sysuserlog_id }}</td>
                            <td>{{ $value->rtypelog_nama }}</td>
                            <td>{{ $value->sysuser_nama }}</td>
                            <td>{{ $value->sysuser_logdesk }}</td>
                            <td>{{\Carbon\Carbon::parse($value->sysuser_logcreate_at)->format('d-m-Y H:m:s')}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center"><strong>-- Data Tidak Tersedia --</strong></td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="card-footer bg-white d-sm-flex justify-content-sm-between align-items-sm-center">
                    {{$logs->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

