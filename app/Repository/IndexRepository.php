<?php

namespace App\Repository;

use App\RepositoryInterface\IndexRepositoryInterface;
use Illuminate\Support\Facades\DB;

class IndexRepository implements IndexRepositoryInterface{
    
    public function getUser($username){
        $result = DB::table('sys_user')
                ->select('user_id', 'user_name', 'user_email', 'password')
                ->where('user_name', $username)
                ->get();
        
        // foreach ($result as $value) {
        //     $sql = "";        
        //     $sql .= "select sur.user_id, sur.role_id, sr.role_name ";
        //     $sql .= "from sys_user_role sur ";
        //     $sql .= "left join sys_role sr on sr.role_id = sur.role_id ";
        //     $sql .= "where sur.user_id= ".$value->user_id." ";
        //     $role = DB::select($sql);
            
        //     $value->role = $role;
        // }   

        return $result;
    }
}