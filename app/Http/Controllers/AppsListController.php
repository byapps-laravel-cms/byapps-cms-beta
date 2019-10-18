<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AppsListData;
use Yajra\Datatables\Datatables;

class AppsListController extends Controller
{
    //
    public function getIndex()
    {
        return view('appslist');
    }

    public function getAppsListData()
    {
    $appslistData = AppsListData::select('idx', 'app_id', 'app_ver', 'byapps_ver', 'app_process', 'app_name', 'server_group', 'apps_type', 'script_popup');

    return Datatables::of($appslistData)
            ->setRowId(function($appslistData) {
                return $appslistData->idx;
            })
            ->editColumn('app_id', function($eloquent) {
                return $eloquent->app_id;
            })
            ->editColumn('app_name', function($eloquent) {
                return $eloquent->app_name;
            })
            ->editColumn('app_ver', function($eloquent) { 
                return $eloquent->app_ver;
            })
            ->editColumn('app_process', function($eloquent) {
                switch($eloquent->app_process){
                    case 1: return "개발준비중";
                    break;
                    case 2: return "개발진행중";
                    break;
                    case 3: return "심사중";
                    break;
                    case 4: return "등록거부";
                    break;
                    case 5: return "재심사중";
                    break;
                    case 6: return "등록대기";
                    break;
                    case 7: return "등록완료";
                    break;
                    case 8: return "서비스중지";
                    break;
                    case 9: return "기간만료";
                    break;
                    case 10: return "서비스유효";
                    break;
                    default: return "";
                }

            })
            ->editColumn('server_group', function($eloquent) {
                return $eloquent->server_group."그룹";
            })

            ->editColumn('apps_type', function($eloquent) {
                return  $eloquent->apps_type;
            })
            ->editColumn('script_popup', function($eloquent) {
                return $eloquent->script_popup;
            })
            ->make(true);

    }

    public function getSingleData($idx)
    {
    $appslistData = AppsListData::where('idx', $idx)->first();

    return view('appslist')->with('appslistData', $appslistData);
    }
}
