<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin as Data;

class Admin extends Controller
{
    public function update($idx){
        $data = Data::find($idx);
        if(!$data) abort(404);
        if(!request()->has('permission')) abort(400);
        $permission = request()->input('permission');
        if($permission != 'all'){
            if(is_array($permission)) $permission = join('|',$permission);
            $permission = '|'.$permission.'|';
        }
        Data::where('idx','=',$idx)->update(['adminNMNew' => $permission]);
        return request()->ajax() ? response()->json(['success' => true], 200) : '';
    }
    public function list(){
        if(!request()->ajax()) return view();
        
    }
    public function detail($idx){
        try {
            $data['per'] = Data::find($idx,'adminNMNew')->adminNMNew;
        } catch (\Exception $e) {
            abort(404);
        }
        $type1 = [
            'list' => '목록',
            'detail' => '상세',
            'update' => '수정',
        ];
        $type2 = [
            'list' => '목록',
            'detail' => '상세',
        ];
        $type3 = [
            '' => '읽기',
            'send' => '쓰기',
        ];
        $data['pageList'] = [
            'appspay' => [
                'name' => '결제관리',
                'permission' => $type1],
            'promo' => [
                'name' => '프로모션',
                'permission' => $type1],
            'appsorder' => [
                'name' => '앱 접수',
                'permission' => $type1],
            'apps' => [
                'name' => '앱 목록',
                'permission' => $type1],
            'appsupdate' => [
                'name' => '업데이트 관리',
                'permission' => $type1],
            'apklist' => [
                'name' => 'APK 관리',
                'permission' => $type1],
            'cafe24token' => [
                'name' => 'Cafe24 앱 설치',
                'permission' => $type1],
            'push' => [
                'name' => '푸쉬 현황',
                'permission' => $type1],
            'appspointmember' => [
                'name' => '인증회원 관리',
                'permission' => $type1],
            'appspoint' => [
                'name' => '앱포인트 관리',
                'permission' => $type1],
            'pushtester' => [
                'name' => '테스터 관리',
                'permission' => $type1],
            'appendixorder' => [
                'name' => '부가서비스 관리',
                'permission' => $type1],
            'ma' => [
                'name' => 'MA 이용 업체',
                'permission' => $type1],
            'appsdownstat' => [
                'name' => '앱 설치 통계',
                'permission' => $type2],
            'appsstat' => [
                'name' => '앱 이용 통계',
                'permission' => $type2],
            'appssalestat' => [
                'name' => '앱 매출 통계',
                'permission' => $type2],
            'pushonoffstat' => [
                'name' => '푸쉬 허용 통계',
                'permission' => $type2],
            'userinfo' => [
                'name' => '회원 정보',
                'permission' => $type1],
            'qnamember' => [
                'name' => '회원 문의',
                'permission' => $type1],
            'qnanonmember' => [
                'name' => '비회원 문의',
                'permission' => $type1],
            'resellerinfo' => [
                'name' => '리셀러 정보',
                'permission' => $type1],
            'resellerpayment' => [
                'name' => '리셀러 정산',
                'permission' => $type1],
            'comment' => [
                'name' => '댓글',
                'permission' => $type3],
            'admin' => [
                'name' => '관리자 관리',
                'permission' => $type1],
        ];
        return view('admindetail')->with($data);
    }
}
