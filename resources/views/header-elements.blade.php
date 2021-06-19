<div class="header-elements">
    <div class="header-elements">
        @if (\App\Helpers\Utility::getSession('isAdmin')=='1')
            <span><i class="icon-user-lock mr-2"></i><strong>SUPER-ADMIN</strong></span>
        @else
            <span><i
                    class="icon-office mr-2"></i><strong>{{\App\Helpers\Utility::getSession('runit_kode')}} - {{strtoupper(\App\Helpers\Utility::getSession('runit_nama'))}}</strong></span>
        @endif
    </div>
</div>
