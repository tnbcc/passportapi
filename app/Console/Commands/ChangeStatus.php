<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
class ChangeStatus extends Command
{
    protected $signature = 'passport:change-adminstatus';

    protected $description = '每5分钟改变id为2的管理员状态';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        //$adminId = $this->ask('输入管理员 id');

        $admin = Admin::find(2);

        if (!$admin) {
            return $this->error('用户不存在');
        }

       Admin::where('id',2)->update([
          'status'=>2
       ]);
        $this->info('修改成功OK');
    }
}
