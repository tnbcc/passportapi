<?php

namespace App\Http\Controllers\Admin;
header("Access-Control-Allow-Origin:*");
header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With, Origin');
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Excel;

class ExcelController extends Controller
{
    public function index()
    {
    return view('admin.excel.index');
    }
    public function exports(Request $request)
    {
        //$types = $request->input('types', 1);

        $users = Admin::select('name','login_count','create_ip')->get();

       /* if (!$users->count()) {
            return json([
                'code' => '201',
                'status' => 'error',
                'msg' => '暂无数据',
            ]);
        }

        if ($types != 1) {
            return json([
                'code' => 200,
                'status' => 'success',
                'msg' => '导出成功'
            ]);
        }*/
        $cellData['title'] = ['表头'];
        $cellData['columns'] = ['A1', 'B1', 'C1']; // 表头列名
        $cellData['body'] = $users;
        Excel::create(iconv('utf-8', 'gbk', '文件名'), function ($excel) use ($cellData) {
            $excel->sheet('score', function ($sheet) use ($cellData) {
                // 表头插入
                $sheet->appendRow(1, $cellData['title']);
                $sheet->appendRow(2, $cellData['columns']);

                // 填充数据
                $sheet->rows($cellData['body']);

                // 设置列宽
                $sheet->setWidth(array(
                    "A1" => '50px',
                     "B1" => '100px',
                     "C1" => '150px',
                ));

                // 冻结表头
                $sheet->setFreeze('A3');

                // 横向 合并单元格 A1 到 C1
                $sheet->mergeCells("A1:C1");

                // 纵向合并
                $sheet->setMergeColumn(array(
                    'columns' => array('B'),  // 列数
                    // 行数，一个二维数组
                    'rows' => array(
                        array(3, 5),
                        array(6, 14),
                        array(15, 23),
                    )
                ));

                // 字体居中
                $sheet->cells("A1:C23", function ($cells) {
                    $cells->setAlignment('center');
                    $cells->setValignment('center');
                });
            });
        })->export('xls', ['Set-Cookie' => 'fileDownload=true; path=/']);

    }
}
