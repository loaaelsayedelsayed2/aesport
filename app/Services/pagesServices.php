<?php

namespace App\Services;

use App\Http\Resources\BrandsResource;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\HomePageResource;
use App\Http\Resources\pagesResource;
use App\Http\Resources\ProductResources;
use App\Http\Resources\SportsResource;
use App\Http\Resources\TypesResources;
use App\Http\Resources\TypeWithCategories;
use App\Repositories\BrandsRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use App\Repositories\SettingsRepository;
use App\Repositories\SportsRepository;
use App\Repositories\TypeRepository;
use App\Traits\ApiResponse;
use Exception;

class pagesServices
{
    use ApiResponse;
    protected $brandRepo, $settingsRepo,$productRepo,$sportRepo,$typeRepo;
    public function __construct(
        BrandsRepository $brandRepo,
        SettingsRepository $settingsRepo,
        ProductRepository $productRepo,
        TypeRepository $typeRepo,
        SportsRepository $sportRepo
    ) {
        $this->brandRepo = $brandRepo;
        $this->settingsRepo = $settingsRepo;
        $this->productRepo = $productRepo;
        $this->typeRepo = $typeRepo;
        $this->sportRepo = $sportRepo;
    }
    public function home()
    {
        try {
            $heroSection = $this->settingsRepo->getDataHome();
            $sec2 = $this->settingsRepo->getDataHomeSec2();

            $saleValue = $sec2 ? $sec2->value : null;
            $saleParts = $saleValue ? explode('_', $saleValue) : null;

            $productsBySale = $this->productRepo->getProductsBySale($saleParts);
            $brand = $this->brandRepo->list();
            $types = $this->typeRepo->list();
            $sports = $this->sportRepo->list();

            $data = [
                'heroSection' => new HomePageResource($heroSection),
                'sectionSale' => [
                    'sale' => $saleParts ? (float) $saleParts[0] : null,
                    'type' => $saleParts ? $saleParts[1] : null,
                    'products' => ProductResources::collection($productsBySale),
                    ],
                'brand' => BrandsResource::collection($brand),
                'type' => TypesResources::collection($types),
                'sports' => SportsResource::collection($sports),
            ];

            return $this->success($data, 'show home success');
        } catch (Exception $e) {
            return $this->fail('fail in show list ' . $e->getMessage());
        }
    }
}
