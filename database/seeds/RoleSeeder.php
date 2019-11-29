<?php

use Illuminate\Database\Seeder;
use App\Repositories\RolesRepository;

class RoleSeeder extends Seeder
{
    protected $roleRepository;

    public function __construct(RolesRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    private $data = [
        'admin',
        'sub_admin'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!$this->roleRepository->first()) {
            foreach ($this->data as $item) {
                $this->roleRepository->create([
                    'name' => $item
                ]);
            }
        }
    }
}
