<?php

namespace App\Services;

use App\Http\Resources\BrandsResource;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\HomePageResource;
use App\Http\Resources\pagesResource;
use App\Http\Resources\ProductResources;
use App\Http\Resources\TypesResources;
use App\Http\Resources\TypeWithCategories;
use App\Repositories\BrandsRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SettingsRepository;
use App\Repositories\TypeRepository;
use App\Traits\ApiResponse;
use Exception;

class pagesServices
{
    use ApiResponse;
    protected $brandRepo, $settingsRepo,$productRepo,$categoryRepo,$typeRepo;
    public function __construct(
        BrandsRepository $brandRepo,
        SettingsRepository $settingsRepo,
        ProductRepository $productRepo,
    ) {
        $this->brandRepo = $brandRepo;
        $this->settingsRepo = $settingsRepo;
        $this->productRepo = $productRepo;
    }
    public function home()
    {
        try {
            $heroSection = $this->settingsRepo->getDataHome();
            $sec2 = $this->settingsRepo->getDataHomeSec2();

            $saleValue = $sec2 ? $sec2->value : null;
            $saleParts = $saleValue ? explode('_', $saleValue) : null;

            $productsBySale = $this->productRepo->getProductsBySale($saleParts);

            $data = [
                'heroSection' => new HomePageResource($heroSection),
                'sectionSale' => [
                    'sale' => $saleParts ? (float) $saleParts[0] : null,
                    'type' => $saleParts ? $saleParts[1] : null,
                    'products' => ProductResources::collection($productsBySale)
                ]
            ];

            return $this->success($data, 'show home success');
        } catch (Exception $e) {
            return $this->fail('fail in show list ' . $e->getMessage());
        }
    }
}
