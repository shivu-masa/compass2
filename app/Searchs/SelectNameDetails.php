<?php
namespace App\Searchs;

use App\Models\Users\User;

class SelectNameDetails implements DisplayUsers
{
    public function resultUsers($keyword, $category, $updown, $gender, $role, $subjects)
    {
        // 性別フィルター
        $gender = is_null($gender) ? ['1', '2', '3'] : [$gender];

        // 権限フィルター
        $role = is_null($role) ? ['1', '2', '3', '4'] : [$role];

        $query = User::with('subjects');

        // キーワード検索（空でなければ実行）
        if (!empty($keyword)) {
        $query->where(function ($q) use ($keyword) {
            $q->where('over_name', 'like', '%' . $keyword . '%')
              ->orWhere('under_name', 'like', '%' . $keyword . '%')
              ->orWhere('over_name_kana', 'like', '%' . $keyword . '%')
              ->orWhere('under_name_kana', 'like', '%' . $keyword . '%');
        });
    }


        $query->whereIn('sex', $gender)
              ->whereIn('role', $role);


        if (!empty($subjects)) {
    $query->whereHas('subjects', function ($q) use ($subjects) {
        $q->whereIn('subjects.id', $subjects);
    });
}

        // 並び順
        $users = $query->orderBy('over_name_kana', $updown)->get();

        return $users;
    }
}
