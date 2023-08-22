<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, ShouldAutoSize, WithMapping, WithHeadings
{
    use Exportable;

    private $collections;

    public function __construct($collections)
    {
        $this->collections = $collections;
    }

    public function collection()
    {
        // TODO: Implement collection() method.
        return $this->collections;
    }

    public function headings(): array
    {
        // TODO: Implement headings() method.
        return [
            'STT',
            'Tên',
            'Tên đăng nhập',
            'Địa chỉ',
            'SĐT',
        ];
    }

    public function map($row): array
    {
        // TODO: Implement map() method.
        return [
            'id' => $row->id,
            'name' => $row->name,
            'username' => $row->username,
            'address' => $row->address,
            'phone' => $row->phone,
        ];
    }
}
