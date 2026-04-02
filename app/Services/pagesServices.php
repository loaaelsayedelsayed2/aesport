<?php

namespace App\Services;

use App\Http\Resources\BrandsResource;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\HomePageResource;
use App\Http\Resources\pagesResource;
use App\Http\Resources\TypesResources;
use App\Http\Resources\TypeWithCategories;
use App\Repositories\BrandsRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SettingsRepository;
use App\Repositories\TypeRepository;
use App\Traits\ApiResponse;
use Exception;

class pagesServices
{
    use ApiResponse;
    protected $brandRepo, $settingsRepo;
    public function __construct(
        BrandsRepository $brandRepo,
        SettingsRepository $settingsRepo,
    ) {
        $this->brandRepo = $brandRepo;
        $this->settingsRepo = $settingsRepo;
    }
    public function home()
    {
        try {
            $heroSection = $this->settingsRepo->getDataHome();

            $data = [
                'heroSection' => new HomePageResource($heroSection) 
            ];

            return $this->success($data, 'show home success');
        } catch (Exception $e) {
            return $this->fail('fail in show list ' . $e->getMessage());
        }
    }
}
