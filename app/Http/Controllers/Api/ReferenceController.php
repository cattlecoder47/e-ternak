<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiUtils;
use App\Helpers\Utility;
use App\Http\Controllers\Controller;
use App\Models\Api\R_jeniskontrak;
use App\Models\Api\R_jid;
use App\Models\Api\R_jinsentif;
use App\Models\Api\R_satuan;
use App\Models\Api\R_typelog;
use App\Models\Api\R_unit;
use App\Models\Api\Sys_role;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReferenceController extends Controller
{

    # ------------------------------------------------------------------- #
    # -----------------------Api Untuk Sys Role-------------------------- #
    # ------------------------------------------------------------------- #

    public function AddSysRole(Request $request): JsonResponse
    {
        try {
            $sys_role               = new Sys_role();
            $sys_role->sysrole_kode = ApiUtils::GetNextId('sys_role');
            if (!empty($request->sysrole_nama)) {
                $sys_role->sysrole_nama = $request->sysrole_nama;
            }
            $sys_role->save();
            return Utility::giveResponse(201, '00',
                'TAMBAH ROLE SUKSES');
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99',
                'TAMBAH ROLE GAGAL', $e->getMessage());
        }
    }

    public function UpdateSysRole(Request $request, $id): JsonResponse
    {
        try {
            if (Sys_role::where('sysrole_kode', $id)->exists()) {
                $sys_role               = Sys_role::find($id);
                $sys_role->sysrole_kode = $id;
                if (!empty($request->sysrole_nama)) {
                    // Jika request empty string maka tidak ada perubahan data
                    $sys_role->sysrole_nama = is_null($request->sysrole_nama) ? $sys_role->sysrole_nama : $request->sysrole_nama;
                }
                $sys_role->save();
                return Utility::giveResponse(200, '00', 'UPDATE ROLE SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'UPDATE ROLE GAGAL! ROLE TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE ROLE GAGAL', $e->getMessage());
        }
    }

    public function DeleteSysRole($id): JsonResponse
    {
        try {
            if (Sys_role::where('sysrole_kode', $id)->exists()) {
                $sys_role               = Sys_role::find($id);
                $sys_role->sysrole_kode = $id;
                $sys_role->delete();
                return Utility::giveResponse(202, '00', 'HAPUS ROLE SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'HAPUS ROLE GAGAL! ROLE TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE ROLE GAGAL', $e->getMessage());
        }
    }

    public function GetSysRole(): JsonResponse
    {
        try {
            $sys_role = Sys_role::get();
            return Utility::giveResponse(200, '00', 'GET ROLE SUKSES', $sys_role);
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'GET ROLE GAGAL', $e->getMessage());
        }
    }

    # ------------------------------------------------------------------- #
    # -----------------------Api Untuk R Satuan-------------------------- #
    # ------------------------------------------------------------------- #

    public function AddRSatuan(Request $request): JsonResponse
    {
        try {
            $r_satuan               = new R_satuan();
            $r_satuan->rsatuan_kode = ApiUtils::GetNextId('r_satuan');
            if (!empty($request->rsatuan_nama)) {
                $r_satuan->rsatuan_nama = $request->rsatuan_nama;
            }
            $r_satuan->save();
            return Utility::giveResponse(201, '00',
                'TAMBAH SATUAN SUKSES');
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99',
                'TAMBAH SATUAN GAGAL', $e->getMessage());
        }
    }

    public function UpdateRSatuan(Request $request, $id): JsonResponse
    {
        try {
            if (R_satuan::where('rsatuan_kode', $id)->exists()) {
                $r_satuan               = R_satuan::find($id);
                $r_satuan->rsatuan_kode = $id;
                if (!empty($request->rsatuan_nama)) {
                    // Jika request empty string maka tidak ada perubahan data
                    $r_satuan->rsatuan_nama = is_null($request->rsatuan_nama) ? $r_satuan->rsatuan_nama : $request->rsatuan_nama;
                }
                $r_satuan->save();
                return Utility::giveResponse(200, '00', 'UPDATE SATUAN SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'UPDATE SATUAN GAGAL! SATUAN TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE SATUAN GAGAL', $e->getMessage());
        }
    }

    public function DeleteRSatuan($id): JsonResponse
    {
        try {
            if (R_satuan::where('rsatuan_kode', $id)->exists()) {
                $r_satuan               = R_satuan::find($id);
                $r_satuan->rsatuan_kode = $id;
                $r_satuan->delete();
                return Utility::giveResponse(202, '00', 'HAPUS SATUAN SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'HAPUS SATUAN GAGAL! SATUAN TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE SATUAN GAGAL', $e->getMessage());
        }
    }

    public function GetRSatuan(): JsonResponse
    {
        try {
            $r_satuan = R_satuan::get();
            return Utility::giveResponse(200, '00', 'GET SATUAN SUKSES', $r_satuan);
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'GET SATUAN GAGAL', $e->getMessage());
        }
    }

    # ------------------------------------------------------------------- #
    # ------------------------Api Untuk R Unit--------------------------- #
    # ------------------------------------------------------------------- #

    public function AddRUnit(Request $request): JsonResponse
    {
        try {
            $r_unit             = new R_unit();
            $r_unit->runit_kode = ApiUtils::GetNextId('r_unit');
            if (!empty($request->runit_nama)) {
                $r_unit->runit_nama = $request->runit_nama;
            }
            if (!empty($request->runit_alamat)) {
                $r_unit->runit_alamat = $request->runit_alamat;
            }
            if (!empty($request->runit_pimpinan)) {
                $r_unit->runit_pimpinan = $request->runit_pimpinan;
            }
            $r_unit->runit_create_at = Carbon::parse(now())->format('Y-m-d H:m:s');
            $r_unit->save();
            return Utility::giveResponse(201, '00',
                'TAMBAH UNIT SUKSES');
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99',
                'TAMBAH UNIT GAGAL', $e->getMessage());
        }
    }

    public function UpdateRUnit(Request $request, $id): JsonResponse
    {
        try {
            if (R_unit::where('runit_kode', $id)->exists()) {
                $r_unit             = R_unit::find($id);
                $r_unit->runit_kode = $id;
                // Jika request empty string maka tidak ada perubahan data
                if (!empty($request->runit_nama)) {
                    $r_unit->runit_nama = is_null($request->runit_nama) ? $r_unit->runit_nama : $request->runit_nama;
                }
                if (!empty($request->runit_alamat)) {
                    $r_unit->runit_alamat = is_null($request->runit_alamat) ? $r_unit->runit_alamat : $request->runit_alamat;
                }
                if (!empty($request->runit_pimpinan)) {
                    $r_unit->runit_pimpinan = is_null($request->runit_pimpinan) ? $r_unit->runit_pimpinan : $request->runit_pimpinan;
                }
                $r_unit->save();
                return Utility::giveResponse(200, '00', 'UPDATE UNIT SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'UPDATE UNIT GAGAL! UNIT TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE UNIT GAGAL', $e->getMessage());
        }
    }

    public function DeleteRUnit($id): JsonResponse
    {
        try {
            if (R_unit::where('runit_kode', $id)->exists()) {
                $r_unit             = R_unit::find($id);
                $r_unit->runit_kode = $id;
                $r_unit->delete();
                return Utility::giveResponse(202, '00', 'HAPUS UNIT SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'HAPUS UNIT GAGAL! UNIT TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE UNIT GAGAL', $e->getMessage());
        }
    }

    public function GetRUnit(): JsonResponse
    {
        try {
            $r_unit = R_unit::get();
            return Utility::giveResponse(200, '00', 'GET UNIT SUKSES', $r_unit);
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'GET UNIT GAGAL', $e->getMessage());
        }
    }

    # -------------------------------------------------------------------------- #
    # -----------------------Api Untuk R Jenis Kontrak-------------------------- #
    # -------------------------------------------------------------------------- #

    public function AddRJenisKontrak(Request $request): JsonResponse
    {
        try {
            $r_jeniskontrak                     = new R_jeniskontrak();
            $r_jeniskontrak->rjeniskontrak_kode = ApiUtils::GetNextId('r_jeniskontrak');
            if (!empty($request->rjeniskontrak_nama)) {
                $r_jeniskontrak->rjeniskontrak_nama = $request->rjeniskontrak_nama;
            }
            $r_jeniskontrak->save();
            return Utility::giveResponse(201, '00',
                'TAMBAH JENIS KONTRAK SUKSES');
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99',
                'TAMBAH JENIS KONTRAK GAGAL', $e->getMessage());
        }
    }

    public function UpdateRJenisKontrak(Request $request, $id): JsonResponse
    {
        try {
            if (R_jeniskontrak::where('rjeniskontrak_kode', $id)->exists()) {
                $r_jeniskontrak                     = R_jeniskontrak::find($id);
                $r_jeniskontrak->rjeniskontrak_kode = $id;
                if (!empty($request->rjeniskontrak_nama)) {
                    // Jika request empty string maka tidak ada perubahan data
                    $r_jeniskontrak->rjeniskontrak_nama = is_null($request->rjeniskontrak_nama) ? $r_jeniskontrak->rjeniskontrak_nama : $request->rjeniskontrak_nama;
                }
                $r_jeniskontrak->save();
                return Utility::giveResponse(200, '00', 'UPDATE JENIS KONTRAK SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'UPDATE JENIS KONTRAK GAGAL! JENIS KONTRAK TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE JENIS KONTRAK GAGAL', $e->getMessage());
        }
    }

    public function DeleteRJenisKontrak($id): JsonResponse
    {
        try {
            if (R_jeniskontrak::where('rjeniskontrak_kode', $id)->exists()) {
                $r_jeniskontrak                     = R_jeniskontrak::find($id);
                $r_jeniskontrak->rjeniskontrak_kode = $id;
                $r_jeniskontrak->delete();
                return Utility::giveResponse(202, '00', 'HAPUS JENIS KONTRAK SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'HAPUS JENIS KONTRAK GAGAL! JENIS KONTRAK TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE JENIS KONTRAK GAGAL', $e->getMessage());
        }
    }

    public function GetRJenisKontrak(): JsonResponse
    {
        try {
            $r_jeniskontrak = R_jeniskontrak::get();
            return Utility::giveResponse(200, '00', 'GET JENIS KONTRAK SUKSES', $r_jeniskontrak);
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'GET JENIS KONTRAK GAGAL', $e->getMessage());
        }
    }

    # -------------------------------------------------------------------------- #
    # -------------------------Api Untuk R Type Log----------------------------- #
    # -------------------------------------------------------------------------- #

    public function AddRTypeLog(Request $request): JsonResponse
    {
        try {
            $r_typelog                = new R_typelog();
            $r_typelog->rtypelog_kode = ApiUtils::GetNextId('r_typelog');
            if (!empty($request->rtypelog_nama)) {
                $r_typelog->rtypelog_nama = $request->rtypelog_nama;
            }
            $r_typelog->save();
            return Utility::giveResponse(201, '00',
                'TAMBAH TIPE LOG SUKSES');
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99',
                'TAMBAH TIPE LOG GAGAL', $e->getMessage());
        }
    }

    public function UpdateRTypeLog(Request $request, $id): JsonResponse
    {
        try {
            if (R_typelog::where('rtypelog_kode', $id)->exists()) {
                $r_typelog                = R_typelog::find($id);
                $r_typelog->rtypelog_kode = $id;
                if (!empty($request->rtypelog_nama)) {
                    // Jika request empty string maka tidak ada perubahan data
                    $r_typelog->rtypelog_nama = is_null($request->rtypelog_nama) ? $r_typelog->rtypelog_nama : $request->rtypelog_nama;
                }
                $r_typelog->save();
                return Utility::giveResponse(200, '00', 'UPDATE TIPE LOG SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'UPDATE TIPE LOG GAGAL! TIPE LOG TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE TIPE LOG GAGAL', $e->getMessage());
        }
    }

    public function DeleteRTypeLog($id): JsonResponse
    {
        try {
            if (R_typelog::where('rtypelog_kode', $id)->exists()) {
                $r_typelog                = R_typelog::find($id);
                $r_typelog->rtypelog_kode = $id;
                $r_typelog->delete();
                return Utility::giveResponse(202, '00', 'HAPUS TIPE LOG SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'HAPUS TIPE LOG GAGAL! TIPE LOG TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE TIPE LOG GAGAL', $e->getMessage());
        }
    }

    public function GetRTypeLog(): JsonResponse
    {
        try {
            $r_typelog = R_typelog::get();
            return Utility::giveResponse(200, '00', 'GET TIPE LOG SUKSES', $r_typelog);
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'GET TIPE LOG GAGAL', $e->getMessage());
        }
    }

    # -------------------------------------------------------------------------- #
    # ----------------------------Api Untuk R Jid------------------------------- #
    # -------------------------------------------------------------------------- #

    public function AddRJid(Request $request): JsonResponse
    {
        try {
            $r_jid            = new R_jid();
            $r_jid->rjid_kode = ApiUtils::GetNextId('r_jid');
            if (!empty($request->rjid_nama)) {
                $r_jid->rjid_nama = $request->rjid_nama;
            }
            $r_jid->save();
            return Utility::giveResponse(201, '00',
                'TAMBAH JENIS IDENTITAS SUKSES');
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99',
                'TAMBAH JENIS IDENTITAS GAGAL', $e->getMessage());
        }
    }

    public function UpdateRJid(Request $request, $id): JsonResponse
    {
        try {
            if (R_jid::where('rjid_kode', $id)->exists()) {
                $r_jid            = R_jid::find($id);
                $r_jid->rjid_kode = $id;
                if (!empty($request->rjid_nama)) {
                    // Jika request empty string maka tidak ada perubahan data
                    $r_jid->rjid_nama = is_null($request->rjid_nama) ? $r_jid->rjid_nama : $request->rjid_nama;
                }
                $r_jid->save();
                return Utility::giveResponse(200, '00', 'UPDATE JENIS IDENTITAS SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'UPDATE JENIS IDENTITAS GAGAL! JENIS IDENTITAS TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE JENIS IDENTITAS GAGAL', $e->getMessage());
        }
    }

    public function DeleteRJid($id): JsonResponse
    {
        try {
            if (R_jid::where('rjid_kode', $id)->exists()) {
                $r_jid            = R_jid::find($id);
                $r_jid->rjid_kode = $id;
                $r_jid->delete();
                return Utility::giveResponse(202, '00', 'HAPUS JENIS IDENTITAS SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'HAPUS JENIS IDENTITAS GAGAL! JENIS IDENTITAS TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE JENIS IDENTITAS GAGAL', $e->getMessage());
        }
    }

    public function GetRJid(): JsonResponse
    {
        try {
            $r_jid = R_jid::get();
            return Utility::giveResponse(200, '00', 'GET JENIS IDENTITAS SUKSES', $r_jid);
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'GET JENIS IDENTITAS GAGAL', $e->getMessage());
        }
    }

    # -------------------------------------------------------------------------------- #
    # ----------------------------Api Untuk R Jinsentif------------------------------- #
    # -------------------------------------------------------------------------------- #

    public function AddRJInsentif(Request $request): JsonResponse
    {
        try {
            $r_jinsentif                  = new R_jinsentif();
            $r_jinsentif->rjinsentif_kode = ApiUtils::GetNextId('r_jinsentif');
            if (!empty($request->rjinsentif_nama)) {
                $r_jinsentif->rjinsentif_nama = $request->rjinsentif_nama;
            }
            $r_jinsentif->save();
            return Utility::giveResponse(201, '00',
                'TAMBAH JENIS INSENTIF SUKSES');
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99',
                'TAMBAH JENIS INSENTIF GAGAL', $e->getMessage());
        }
    }

    public function UpdateRJInsentif(Request $request, $id): JsonResponse
    {
        try {
            if (R_jinsentif::where('rjinsentif_kode', $id)->exists()) {
                $r_jinsentif                  = R_jinsentif::find($id);
                $r_jinsentif->rjinsentif_kode = $id;
                if (!empty($request->rjinsentif_nama)) {
                    // Jika request empty string maka tidak ada perubahan data
                    $r_jinsentif->rjinsentif_nama = is_null($request->rjinsentif_nama) ? $r_jinsentif->rjinsentif_nama : $request->rjinsentif_nama;
                }
                $r_jinsentif->save();
                return Utility::giveResponse(200, '00', 'UPDATE JENIS INSENTIF SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'UPDATE JENIS INSENTIF GAGAL! JENIS INSENTIF TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE JENIS INSENTIF GAGAL', $e->getMessage());
        }
    }

    public function DeleteRJInsentif($id): JsonResponse
    {
        try {
            if (R_jinsentif::where('rjinsentif_kode', $id)->exists()) {
                $r_jinsentif                  = R_jinsentif::find($id);
                $r_jinsentif->rjinsentif_kode = $id;
                $r_jinsentif->delete();
                return Utility::giveResponse(202, '00', 'HAPUS JENIS INSENTIF SUKSES');
            } else {
                return Utility::giveResponse(404, '01', 'HAPUS JENIS INSENTIF GAGAL! JENIS INSENTIF TIDAK DITEMUKAN');
            }
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'UPDATE JENIS INSENTIF GAGAL', $e->getMessage());
        }
    }

    public function GetRJInsentif(): JsonResponse
    {
        try {
            $r_jinsentif = R_jinsentif::get();
            return Utility::giveResponse(200, '00', 'GET JENIS INSENTIF SUKSES', $r_jinsentif);
        } catch (Exception $e) {
            return Utility::giveResponse(500, '99', 'GET JENIS INSENTIF GAGAL', $e->getMessage());
        }
    }


}
